<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<h1>Edit User</h1>";


require_once '../config/database.php';
require_once '../models/user.php';

$old_email = $_GET['email'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $image_new_name = '';
    if (isset($_FILES['image']) and !empty($_FILES['image']['name'])) {
        $imagename = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $ext = pathinfo($imagename)['extension'];
        $image_new_name = dirname(__DIR__) . "/images/" . time() . ".$ext";
        move_uploaded_file($tmp_name, $image_new_name);
    }
    $user = new User($pdo);
    $result = $user->editUser($old_email, $email, $image_new_name);
    var_dump($result);
    if ($result) {
        header('Location: ../views/dashboard.php');
    } else {
        echo "Failed to edit user";
    }
}
