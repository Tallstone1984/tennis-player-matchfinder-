<?php
$page_title = 'Your Page Title';
include('header.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Find Match</title>
    <link rel="stylesheet" type="text/css" href="default.css">

    <style></style>
</head>

<body>
    
<nav>
    <a href="profile.php">Profile</a>
</nav>

<h1>Find Your Match</h1>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    echo "<p>Please log in to find a match.</p>";
    exit();
}

require_once('dbc.php');

?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <p>Select a day to find available players:</p>
    <label>Monday <input type="radio" name="day" value="mon"></label>
    <label>Tuesday <input type="radio" name="day" value="tue"></label>
    <label>Wednesday <input type="radio" name="day" value="wed"></label>
    <label>Thursday <input type="radio" name="day" value="thu"></label>
    <label>Friday <input type="radio" name="day" value="fri"></label>
    <br>
    <input type="submit" name="submit" value="Find Match">
</form>

<?php

if (isset($_POST['submit'])) {
    $day = $_POST['day'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT firstname, lastname, age, ranking FROM players WHERE $day = 1 AND id != $user_id";
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) > 0) {
        echo "<h2>Available Players:</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_array($data)) {
            echo "<li>" . $row['firstname'] . " " . $row['lastname'] . " (Age: " . $row['age'] . ", Ranking: " . $row['ranking'] . ")</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No players are available on the selected day.</p>";
    }
}

?>

</body>

</html>
<?php
include('footer.php');
?>