<?php
// Inclure le fichier de configuration de la base de données
require_once 'config.php';

// Vérifier si l'identifiant de la tâche à modifier est présent dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'identifiant de la tâche depuis l'URL
    $taskId = $_GET['id'];

    try {
        // Connexion à la base de données en utilisant PDO
        $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si le formulaire de modification a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $taskId = $_POST['id'];
            $titre = htmlspecialchars($_POST['titre']);
            $description = htmlspecialchars($_POST['description']);
            $statut = $_POST['statut'];

            // Préparer la requête SQL de mise à jour de la tâche
            $query = "UPDATE taches SET titre = :titre, description = :description, statut = :statut WHERE id = :id";

            // Exécuter la requête préparée
            $statement = $conn->prepare($query);
            $statement->bindParam(':id', $taskId);
            $statement->bindParam(':titre', $titre);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':statut', $statut);

            if ($statement->execute()) {
                // Rediriger vers la page des taches après la modification réussie
                header("Location: afficher.taches.php");
                exit();
            } else {
                $errorMessage = "Erreur lors de la modification de la tâche.";
            }
        }

        // Préparer la requête SQL pour récupérer les informations de la tâche à modifier
        $query = "SELECT * FROM taches WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id', $taskId);
        $statement->execute();

        // Vérifier si la tâche existe
        if ($statement->rowCount() > 0) {
            // Récupérer les données de la tâche
            $task = $statement->fetch(PDO::FETCH_ASSOC);

            // Afficher le formulaire de modification
            include 'modifier.tache.form.php'; // Séparons le formulaire de la logique PHP pour une meilleure lisibilité
        } else {
            $errorMessage = "La tâche n'existe pas.";
        }
    } catch(PDOException $e) {
        $errorMessage = "Erreur : " . $e->getMessage();
    }
} else {
    $errorMessage = "L'identifiant de la tâche n'est pas spécifié.";
}

// Afficher les erreurs
if (isset($errorMessage)) {
    echo '<div class="error-message">' . $errorMessage . '</div>';
}
