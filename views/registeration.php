<?php

if (isset($_GET["errors"])) {
    $errors = json_decode($_GET["errors"], true);
}
if (isset($_GET["old"])) {
    $old_data = json_decode($_GET["old"], true);
}
?>


<!DOCTYPE html>
<?php
require_once '../views/navbar.php';
require_once '../views/footer.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add user </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1> Add user </h1>
        <form method="POST" action="../controllers/register.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" value="<?php if (isset($old_data['email'])) echo $old_data['email']; ?>" name='email' id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <span class="text-danger"> <?php if (isset($errors['email'])) echo $errors['email']; ?> </span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name='password' value="<?php if (isset($old_data['password'])) echo $old_data['password']; ?>" id="exampleInputPassword1">
                <span class="text-danger"> <?php if (isset($errors['password'])) echo $errors['password']; ?> </span>
            </div>
            <div class="mb-3">
                <label class="form-label">User Image </label>

                <input type="file" name="image">

            </div>
            <button type="submit" class="btn btn-primary">Save new user</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>