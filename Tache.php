<?php
class Task {
    private $title;
    private $description;
    private $status;

    // Constructeur
    public function __construct($title, $description, $status) {
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
    }

    
    // Méthodes pour accéder aux propriétés
    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }

    // Méthodes pour modifier les propriétés
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
