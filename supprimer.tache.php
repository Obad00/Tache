<?php
// Vérifier si l'identifiant de la tâche est défini dans l'URL
if (isset($_GET['id'])) {
    // Inclure le fichier de configuration de la base de données
    require_once 'config.php';

    try {
        // Connexion à la base de données en utilisant PDO
        $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL pour sélectionner la tâche avec l'identifiant spécifié
        $query = "SELECT * FROM taches WHERE id = :id";
        $statement = $conn->prepare($query);
        // Liaison de la valeur de l'identifiant depuis l'URL
        $statement->bindParam(':id', $_GET['id']);
        // Exécution de la requête de sélection
        $statement->execute();
        // Récupération de la tâche à supprimer
        $task = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérifier si la tâche existe
        if ($task) {
            // Vérifier si le formulaire de confirmation de suppression a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Préparer la requête SQL pour supprimer la tâche
                $deleteQuery = "DELETE FROM taches WHERE id = :id";
                $deleteStatement = $conn->prepare($deleteQuery);
                // Liaison de la valeur de l'identifiant depuis l'URL
                $deleteStatement->bindParam(':id', $_GET['id']);
                // Exécution de la requête de suppression
                if ($deleteStatement->execute()) {
                    // Rediriger vers la page d'affichage des tâches après la suppression réussie
                    header("Location: afficher.taches.php");
                    exit();
                } else {
                    echo "Erreur lors de la suppression de la tâche.";
                }
            }
            // Affichage du formulaire de confirmation de la suppression
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Confirmation de suppression</title>
                <script>
                    // Fonction de confirmation de la suppression
                    function confirmDelete() {
                        return confirm("Êtes-vous sûr de vouloir supprimer cette tâche ?");
                    }
                </script>
            </head>
            <body>
                <h2>Confirmation de suppression</h2>
                <p>Êtes-vous sûr de vouloir supprimer la tâche "<?php echo $task['titre']; ?>" ?</p>
                <form action="supprimer.tache.php?id=<?php echo $_GET['id']; ?>" method="post" onsubmit="return confirmDelete()">
                    <button type="submit">Supprimer</button>
                    <a href="afficher.taches.php">Annuler</a>
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "La tâche spécifiée n'existe pas.";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Si l'identifiant de la tâche n'est pas défini dans l'URL, affichez un message d'erreur
    echo "Identifiant de tâche non spécifié.";
}
