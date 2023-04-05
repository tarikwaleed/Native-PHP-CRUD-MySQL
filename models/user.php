<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    function getUser($email)
    {

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }

    function editUser($id, $email, $password, $image_new_name)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE users SET email = ?, password = ?, image_path = ? WHERE id = ?");
            $stmt->execute([$email, $password, $image_new_name, $id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function deleteUser($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
