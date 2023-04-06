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
    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
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

    function editUser($old_email, $email, $image_new_name)
    {
        var_dump($email);
        echo "<br>";
        var_dump($image_new_name);
        echo "<br>";
        try {
            $query = "update users  set email=:email, image_path=:image_path where email=:old_email";
            $stmt = $this->pdo->prepare($query);
            var_dump($stmt);
            echo "<br>";
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':old_email', $old_email, PDO::PARAM_STR);
            $stmt->bindParam(':image_path', $image_new_name, PDO::PARAM_STR);
            var_dump($stmt);

            $result = $stmt->execute();
            if (!$result) {
                $error = $stmt->errorInfo();
                echo "Error: {$error[2]} ({$error[0]})";
            } else {
                var_dump($stmt->rowCount());
            }
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    function deleteUser($email)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
