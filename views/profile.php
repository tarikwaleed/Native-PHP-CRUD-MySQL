<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("Location: login.php");
    exit;
}

// Retrieve the user's email from the session
$user_email = $_SESSION['user_email'];

// Open the users file and search for the line that contains the user's email
$users_file = fopen("users", "r");
while (($line = fgets($users_file)) !== false) {
    $fields = explode(":", $line);
    if ($fields[1] == $user_email) {
        // Extract the user's ID and image path
        $user_id = $fields[0];
        $user_image_path = $fields[3];
        break;
    }
}
fclose($users_file);

// Display the welcome header and the user's avatar
// echo "<img src='$user_image_path' alt='User Avatar'>";
?>
<link rel="stylesheet" href="styles.css">

<div class="profile">
    <div class="avatar-container">
        <img src="<?php echo $user_image_path; ?>" alt="Avatar" class="avatar">
    </div>
    <h1>Welcome, <?php echo $user_email; ?></h1>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>