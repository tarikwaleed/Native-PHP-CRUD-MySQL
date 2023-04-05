<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../config/database.php';
require_once '../models/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User($pdo);
    $user_data = $user->getUser($email);

    if ($user_data && password_verify($password, $user_data['password'])) {
        $_SESSION['user']=$user_data;
        header('Location: ../views/profile.php');
        exit;
    } else {
        header('Location: ../views/login.php');
    }
}
