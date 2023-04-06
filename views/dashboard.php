<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";

require_once '../config/database.php';
require_once '../models/user.php';
require_once '../views/navbar.php';
require_once '../views/footer.php';
$user = new User($pdo);
$users_data = $user->getAllUsers();
$root_dir = "/var/www/html";
?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users_data as $user) : ?>
            <tr>
                <td><?php echo $user['email']; ?></td>
                <td><img src="<?php echo str_replace($root_dir, '', $user['image_path']) ?>" alt="User Avatar" width="50"></td>
                <td>
                    <a href="./edituser.php?email=<?php echo $user['email']; ?>" class="btn btn-primary">Edit</a>
                    <a href="../controllers/deleteuser.php?email=<?php echo $user['email']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>