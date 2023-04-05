<?php
session_start();
$user_email = $_SESSION['user']['email'];
$user_image_path = $_SESSION['user']['image_path'];
$root_dir = "/var/www/html";
$accurate_image_path = str_replace($root_dir, '', $user_image_path);


?>
<link rel="stylesheet" href="../styles.css">

<div class="profile">
    <div class="avatar-container">
        <img src="<?php echo $accurate_image_path; ?>" alt="Avatar" class="avatar">
    </div>
    <h1>Welcome, <?php echo $user_email; ?></h1>
    <a href="../controllers/logout.php" class="btn btn-danger">Logout</a>
</div>