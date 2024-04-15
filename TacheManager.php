<?php
class TaskManager {
    // Attribut pour stocker la connexion à la base de données
    private $db;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

// Méthode pour récupérer les tâches en fonction de leur état
public function getTasks($status) {
    try {
        // Préparer la requête SQL en fonction de l'état de la tâche
        $query = "SELECT * FROM taches WHERE statut = :statut";
       // echo "SQL Query: " . $query; // Ajout de cet écho pour débogage
        $statement = $this->db->prepare($query);
        $statement->bindParam(':statut', $status);
        $statement->execute();

        // Afficher le nombre de lignes récupérées
        //echo "Number of rows: " . $statement->rowCount() . "<br>"; // Ajout de cet écho pour débogage

        // Récupérer les résultats de la requête
        $tasks = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
          //  var_dump($row); // Ajout de cet écho pour débogage
            $task = new Task($row['titre'], $row['description'], $row['statut']);
            $tasks[] = $task;
        }
        return $tasks;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
}