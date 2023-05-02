<?php
session_start();

$error_message = '';

if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
        require('dbc.php');

        $username = htmlspecialchars(trim($_POST['username']));
        $user_password = htmlspecialchars(trim($_POST['password']));
        $user_password = sha1($user_password);

        $query = "SELECT id, username FROM players WHERE username = '$username' AND password = '$user_password'";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
            $row = mysqli_fetch_array($data);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: main_page.php');
        } else {
            $error_message = '<p>Sorry, either your user name or password is invalid.</p>';
        }
    } else {
        $error_message = '<p>You must enter your username and password to log in.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="default.css">
</head>
<body>

<nav><a href=main_page.php>Home Page</a></nav>

<?php
if (!isset($_COOKIE['user_id'])) {
    echo $error_message;
    ?>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <label>Username <input type="text" name="username"></label><br>
        <label>Password <input type="password" name="password"></label><br>
        <input type="submit" value="Login" name="submit">
    </form>
    <?php
} else {
    echo('<p>You are logged in as ' . $_COOKIE['username'] . '</p>');
}
?>
</body>
</html>
