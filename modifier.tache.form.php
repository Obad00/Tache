<head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="modifier.css">
                <title>Modifier la tâche</title>
            </head>
            <body>
                <h2>Modifier la tâche</h2>
                <form  method="POST">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <label for="titre">Titre :</label>
                    <input type="text" id="titre" name="titre" value="<?php echo $task['titre']; ?>"><br>
                    <label for="description">Description :</label>
                    <textarea id="description" name="description"><?php echo $task['description']; ?></textarea><br>
                    <label for="statut">Statut :</label>
                    <select id="statut" name="statut">
                        <option value="à faire" <?php echo ($task['statut'] === 'à faire') ? 'selected' : ''; ?>>À faire</option>
                        <option value="en cours" <?php echo ($task['statut'] === 'en cours') ? 'selected' : ''; ?>>En cours</option>
                        <option value="terminée" <?php echo ($task['statut'] === 'terminée') ? 'selected' : ''; ?>>Terminée</option>
                    </select><br>
                    <button type="submit">Enregistrer</button>
                </form>
            </body>