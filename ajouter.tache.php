<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    
    // Préparer la requête SQL d'insertion
    $query = "INSERT INTO taches (titre, description, statut) VALUES (:titre, :description, :statut)";
    
    // Exécuter la requête préparée
    $statement = $conn->prepare($query);
    $statement->bindParam(':titre', $titre);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':statut', $statut);
    
    if ($statement->execute()) {
        // Rediriger vers la page d'accueil ou une autre page après l'ajout réussi
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la tâche.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajouter.css">
    <title>Document</title>
</head>
<body>
    <header>
       <div classe="nav">
       <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="afficher.taches.php">Tâches</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Deconnexion</a></li>
            </ul>
        </nav>
       </div>
    </header>
<section id="add-task-section">
    <h2>Ajouter une nouvelle tâche</h2>
    <form action="ajouter_tache.php" method="POST">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" required><br><br>
        
        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>
        
        <label for="statut">Statut :</label><br>
        <select id="statut" name="statut" required>
            <option value="à faire">À faire</option>
            <option value="en cours">En cours</option>
            <option value="terminée">Terminée</option>
        </select><br><br>
        
        <button type="submit">Ajouter la tâche</button>
    </form>
</section>

</body>
</html>