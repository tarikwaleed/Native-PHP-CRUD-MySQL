<?php

require_once '../config/database.php';
require_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image_new_name = '';

    if (isset($_FILES['image']) and !empty($_FILES['image']['name'])) {
        $imagename = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($imagename)['extension'];
        $image_new_name = dirname(__DIR__) . "/images/" . time() . ".$ext";
        move_uploaded_file($tmp_name, $image_new_name);
    }

    $user = new User($pdo);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $result = $user->createUser($email, $hashed_password, $image_new_name);

    if ($result) {
        header('Location: ../views/login.php');
    } else {
        echo "Failed to create user";
    }
}
