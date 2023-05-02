<?php
$page_title = 'Your Page Title';
include('header.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="utf-8">        
<title>Your Profile</title>
<link rel="stylesheet" type="text/css" href="default.css">

<style></style>

</head>

<body>
    


<h1>Sign Up</h1>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$username = $_POST['username'] ?? '';
$user_password = $_POST['user_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <label>Player First Name <input type=text name=firstname required value=<?= $firstname?>></label><br>
    <label>Player Last Name <input type=text name=lastname required value=<?= $lastname?>></label><br>
    <label>Player Username <input type=text name=username required value=<?= $username?>></label><br>
    <label>Password <input type="password" name="user_password" required></label><br>
    <label>Re-enter Password <input type="password" name="confirm_password" required></label><br>
    <input type=submit name=submit value="Create New User">
</form>

<?php

require_once('dbc.php');

if (isset($_POST['submit'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $password1 = trim($_POST['user_password']);
    $password2 = trim($_POST['confirm_password']);

    $errors = [];

    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if ($password1 !== $password2) {
        $errors[] = "Passwords do not match.";
    }
    if (count($errors) == 0) {
        $query = "SELECT * FROM players WHERE username = '$username'";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 0) {
            $password = sha1($password1);
            $query = "INSERT INTO players (firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$username', '$password');";
            mysqli_query($dbc, $query);

            $user_id = mysqli_insert_id($dbc);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;

            echo "Account Created for " . $firstname . " " . $lastname ;
            header('Location: main_page.php');
            mysqli_close($dbc);
            exit();
        } else {
            $errors[] = "Username already used.";
        }
    }

    foreach ($errors as $error) {
        echo "<p class='error'>$error</p>";
    }
}

?>
       
</body>

</html>

<?php
include('footer.php');
?>
