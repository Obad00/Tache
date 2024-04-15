<?php
// Inclure le fichier de configuration de la base de données
require_once 'config.php';

try {
    // Connexion à la base de données en utilisant PDO
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête SQL pour sélectionner toutes les tâches
    $query = "SELECT * FROM taches";
    $statement = $conn->query($query);

    echo '<head>
             <link rel="stylesheet" type="text/css" href="afficher.css">
          </head>';
     // Afficher la navigation
     echo '<nav>';
     echo '<ul>';
     echo '<li><a href="index.php">Accueil</a></li>';
     echo '<li><a href="afficher.taches.php">Tâches</a></li>';
     echo '<li><a href="#">Profil</a></li>';
     echo '<li><a href="#">Deconnexion</a></li>';
     echo '</ul>';
     echo '</nav>';

    // Afficher les tâches
    echo '<h2>Toutes les tâches</h2>';
    echo '<div class="task-list">';
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="task">';
        echo '<h3>' . $row['titre'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p>Statut : ' . $row['statut'] . '</p>';
         //les boutons Modifier et Supprimer avec les liens appropriés
         echo '<a href="modifier.tache.php?id=' . $row['id'] . '">Modifier</a><br>';
         echo '<a href="supprimer.tache.php?id=' . $row['id'] . '">Supprimer</a>';
        echo '</div>';
    }
    echo '</div>';
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
