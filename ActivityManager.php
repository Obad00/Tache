<?php
// ActivityManager.php

class ActivityManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRecentActivity($limit = 5) {
        $query = $this->db->prepare("SELECT * FROM activites ORDER BY cree_le DESC LIMIT :limit");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
