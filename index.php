<?php
session_start();
require_once 'config.php';



// Inclure les fichiers requis
require_once 'TacheManager.php';
require_once 'Tache.php';

// Connexion à la base de données en utilisant PDO
try {
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Test de la connexion réussie
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
// Récupération des informations de l'utilisateur connecté
$user_id = $_SESSION['id'];
$query_user = "SELECT * FROM administrateurs WHERE id = :id";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bindParam(':id', $user_id);
try {
    $stmt_user->execute();
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
}
// Déterminer le statut de l'utilisateur
$user_status = ($user['administrateurs'] == 1) ? 'Administrateur' : 'Utilisateur';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Application de gestion de tâches</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur l'application de gestion de tâches</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="afficher.taches.php">Tâches</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="logout.php">Deconnexion</a></li>
            </ul>
        </nav>
        <p>Bienvenue, <?php echo $user['nom_utilisateur']; ?> (<?php echo $user_status; ?>)</p>
    </header>
    <main>
        <section id="search-section">
            <h2>Rechercher des tâches</h2>
            <form id="task-search-form" action="recherche.php" method="POST">
                <input type="text" id="search-input" name="search" placeholder="Rechercher...">
                <button type="submit">Rechercher</button>
            </form>
        </section>
        <section id="task-section">
            <h2>Mes tâches</h2>
            <?php include 'GestionnaireTaches.php'; ?>
        </section>

        <section id="statistics-section">
        <button id="add-task-btn" onclick="window.location.href='ajouter.tache.php'">Ajouter une tâche</button>
           <br>
           <br>
            <h2>Statistiques</h2>
            <?php include 'statistics.php'; ?>
        </section>
        <section id="activity-section">
            <h2>Dernières activités</h2>
            <?php include 'activity.php'; ?>
        </section>
    </main>
    <footer>
        <p>© 2024 - Tous droits réservés</p>
    </footer>

    <script src="app.js"></script>
</body>
</html>
