<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le champ de recherche n'est pas vide
    if (!empty($_POST['search'])) {
        // Inclure le fichier de configuration de la base de données
        require_once 'config.php';

        try {
            // Connexion à la base de données en utilisant PDO
            $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparer la requête SQL pour rechercher les tâches
            $search_term = $_POST['search'];
            $query = "SELECT * FROM taches WHERE titre LIKE :search OR description LIKE :search";
            $statement = $conn->prepare($query);
            $search_param = "%" . $search_term . "%";
            $statement->bindParam(':search', $search_param);
            $statement->execute();

            // Afficher les résultats de la recherche
            echo '<h3>Résultats de la recherche pour : ' . $search_term . '</h3>';
            echo '<div class="task-list">';
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="task">';
                echo '<h4>' . $row['titre'] . '</h4>';
                echo '<p>' . $row['description'] . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez entrer un terme de recherche.";
    }
}

