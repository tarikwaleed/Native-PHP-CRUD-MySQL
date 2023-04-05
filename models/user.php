<?php

class User
{
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function createUser($email, $password, $image_new_name)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (email, password, image_path) VALUES (?, ?, ?)");
            $stmt->execute([$email, $password, $image_new_name]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
