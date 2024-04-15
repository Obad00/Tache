<?php
// Inclure le fichier de configuration
require_once 'config.php';

// Inclure la classe TaskManager
require_once 'TacheManager.php';
require_once 'Tache.php';

// Instancier un gestionnaire de tâches
$taskManager = new TaskManager($conn);

// Afficher les tâches à faire
echo '<div id="todo-list" class="task-list">';
echo '<h4>Tâches à faire</h4>';
foreach ($taskManager->getTasks('à faire') as $task) {
    echo '<div class="task">';
    echo '<h3>' . $task->getTitle() . '</h3>';
    echo '<p>' . $task->getDescription() . '</p>';
    // Autres détails de la tâche
    echo '</div>';
}
echo '</div>';


// Afficher les tâches en cours
echo '<div id="in-progress-list" class="task-list">';
echo '<h4>Tâches en cours</h4>';
foreach ($taskManager->getTasks('en cours') as $task) {
    echo '<div class="task">';
    echo '<h3>' . $task->getTitle() . '</h3>';
    echo '<p>' . $task->getDescription() . '</p>';
    // Autres détails de la tâche
    echo '</div>';
}
echo '</div>';

// Afficher les tâches terminées
echo '<div id="completed-list" class="task-list">';
echo '<h4>Tâches terminées</h4>';
foreach ($taskManager->getTasks('terminée') as $task) {
    echo '<div class="task">';
    echo '<h3>' . $task->getTitle() . '</h3>';
    echo '<p>' . $task->getDescription() . '</p>';
    // Autres détails de la tâche
    echo '</div>';
}
echo '</div>';
