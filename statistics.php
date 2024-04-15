<!-- statistics.php -->
<?php
// Inclure la classe StatisticsManager
require_once 'StatisticsManager.php';

// Instancier un gestionnaire de statistiques
$statisticsManager = new StatisticsManager($conn);

// Afficher les statistiques
echo '<p>Nombre total de tâches : ' . $statisticsManager->getTotalTasksCount() . '</p>';
echo '<p>Nombre de tâches à faire : ' . $statisticsManager->getTodoTasksCount() . '</p>';
echo '<p>Nombre de tâches terminées : ' . $statisticsManager->getCompletedTasksCount() . '</p>';
echo '<p>Nombre de tâches en cours : ' . $statisticsManager->getInProgressTasksCount() . '</p>';
?>
