<?php
session_start(); // Début de la session

require_once 'config.php';

// Gestion de la création de compte
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification si l'email existe déjà
    $query_check_email = "SELECT * FROM administrateurs WHERE email = :email";
    $stmt_check_email = $conn->prepare($query_check_email);
    $stmt_check_email->bindValue(':email', $email);
    $stmt_check_email->execute();

    if ($stmt_check_email->rowCount() > 0) {
        $error_register = "Cet email est déjà utilisé.";
    } else {
        // Insertion du nouvel administrateur
        $query_insert_admin = "INSERT INTO administrateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)";
        $stmt_insert_admin = $conn->prepare($query_insert_admin);
        $stmt_insert_admin->bindValue(':email', $email);
        $stmt_insert_admin->bindValue(':mot_de_passe', $mot_de_passe);

        if ($stmt_insert_admin->execute()) {
            $success_register = "Compte créé avec succès. Connectez-vous maintenant.";
        } else {
            $error_register = "Une erreur s'est produite lors de la création du compte.";
        }
    }
}

// Gestion de la connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['register'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $query = "SELECT * FROM administrateurs WHERE email = :email AND mot_de_passe = :mot_de_passe";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':mot_de_passe', $mot_de_passe);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: index.php');
        exit();
    } else {
        $error_login = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error_login)): ?>
        <p style="color: red;"><?php echo $error_login; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" name="mot_de_passe" required>
        <br>
        <br>
        <button type="submit">Se Connecter</button>
    </form>
    <hr>
    <h2>Créer un compte administrateur</h2>
    <?php if (isset($error_register)): ?>
        <p style="color: red;"><?php echo $error_register; ?></p>
    <?php endif; ?>
    <?php if (isset($success_register)): ?>
        <p style="color: green;"><?php echo $success_register; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" required>
        <br>
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" name="mot_de_passe" required>
        <br>
        <br>
        <button type="submit" name="register">Créer un compte</button>
    </form>
</body>
</html>
