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

<style>

img {width: 200px}

</style>

</head>

<body>
    
<nav>
    <a href="match_player.php">Find a Match</a>
</nav>

<h1> Welcome To Your Profile</h1>

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['username'];
    echo ('<p>You are logged in as ' . $user_name . '</p>');
} else {
    echo "You are not logged in. Please <a href='login.php'>login</a> to view your profile.";
    exit();
}

require_once('dbc.php');

IF (isset($_POST['submit'])) {

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $ranking = $_POST["ranking"];
    $image_name = $_POST['hidden'];

    $mon = isset($_POST["mon"])?1:0;
    $tue = isset($_POST["tue"])?1:0;
    $wed = isset($_POST["wed"])?1:0;
    $thu = isset($_POST["thu"])?1:0;
    $fri = isset($_POST["fri"])?1:0;

    if ($_FILES['picture']['name'] != '')   {

    $image_name = $_FILES['picture']['name'];
    $target = 'D:\xampp\htdocs\images\\' . $image_name;
    move_uploaded_file($_FILES['picture']['tmp_name'], $target);

    }

    $query = "UPDATE players
    SET firstname = '$firstname', lastname = '$lastname', age = '$age', ranking = '$ranking', mon = '$mon', tue = '$tue', wed = '$wed', thu = '$thu', fri = '$fri', image = '$image_name'
    WHERE id = $user_id;";

    mysqli_query($dbc, $query);

    echo "<p>Form Updated</p>";

}

$query = "SELECT firstname, lastname, age, ranking, mon, tue, wed, thu, fri, image FROM players WHERE id = $user_id";

$result = mysqli_query($dbc, $query);

$row = mysqli_fetch_array($result);
$mon = $row['mon'];
$tue = $row['tue'];
$wed = $row['wed'];
$thu = $row['thu'];
$fri = $row['fri'];

echo "<img src=/images" . $row['image'] . ">";

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <label>Select an image to upload <input type="file" name="picture"></label><br>
    <input type="hidden" name=hidden values=<?= $row['image'] ?>>
    <label>Player First Name: <input type=text name=firstname value=<?= $row['firstname']?> required></label><br>   
    <label>Player Last Name: <input type=text name=lastname value=<?= $row['lastname']?> required></label><br>
    <label>Player Age: <input type=text name=age value=<?= $row['age']?> required></label><br>
    <label>Player USTA Ranking: <input type=number min = 1 max = 7 step="0.5" name=ranking required value=<?= $row['ranking']?>></label><br> 
    <label>Availability to play: Monday  <input type=checkbox name=mon <?php if ($mon){echo "checked";}?>></label> 
    <label> Tuesday <input type=checkbox name=tue <?php if ($tue){echo "checked";}?>></label>
    <label> Wednesday <input type=checkbox name=wed <?php if ($wed){echo "checked";}?>></label>
    <label> Thursday <input type=checkbox name=thu <?php if ($thu){echo "checked";}?>></label>
    <label> Friday <input type=checkbox name=fri <?php if ($fri){echo "checked";}?>></label>
    <label><br><input type=submit name=submit value="Submit Player"></label>

</form>

</body>

</html>
<?php
include('footer.php');
?>
