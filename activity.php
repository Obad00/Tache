<!-- activity.php -->
<?php
// Inclure la classe ActivityManager
require_once 'ActivityManager.php';

// Instancier un gestionnaire d'activités
$activityManager = new ActivityManager($conn);

// Récupérer les dernières activités
$activities = $activityManager->getRecentActivity();

// Afficher les dernières activités
echo '<ul>';
foreach ($activities as $activity) {
    echo '<li>' . $activity['description'] . ' - ' . $activity['cree_le'] . '</li>';
}
echo '</ul>';
?>
