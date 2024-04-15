<?php
require_once 'TacheManager.php'; // Assure-toi que le nom du fichier correspond au nouveau nom de classe
require_once 'Tache.php'; // Assure-toi que le nom du fichier correspond au nouveau nom de classe

// Configuration de la base de données
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "Sqlobad64");
define("DBNAME", "gestion_taches_db");

// Connexion à la base de données en utilisant PDO
try {
    $conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Test de la connexion réussie
    //echo "Connected successfully";

    // Test de la connexion réussie
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
