<?php
// StatisticsManager.php

class StatisticsManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getTotalTasksCount() {
        $query = $this->db->query("SELECT COUNT(*) FROM taches");
        return $query->fetchColumn();
    }

    public function getTodoTasksCount() {
        $query = $this->db->query("SELECT COUNT(*) FROM taches WHERE statut = 'à faire'");
        return $query->fetchColumn();
    }


    public function getCompletedTasksCount() {
        $query = $this->db->query("SELECT COUNT(*) FROM taches WHERE statut = 'terminée'");
        return $query->fetchColumn();
    }

    public function getInProgressTasksCount() {
        $query = $this->db->query("SELECT COUNT(*) FROM taches WHERE statut = 'en cours'");
        return $query->fetchColumn();
    }
}

