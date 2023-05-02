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

.players-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.player-card {
    width: 300px;
    background-color: #f0f0f0;
    border-radius: 5px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}


</style>

</head>

<body>
    
<nav>
    <a href="profile.php">Player Profile</a>
    <a href="add_user.php">Create New User</a>
</nav>


<h1> Meet the Players!</h1>

<?php
require_once('dbc.php');

$query = "SELECT * FROM players";
$result = mysqli_query($dbc, $query);
?>

<div class="players-container">
    <?php while ($row = mysqli_fetch_array($result)) : ?>
        <div class="player-card">
            <h2><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h2>
            <img src="/images/<?php echo $row['image']; ?>" alt="<?php echo $row['firstname'] . ' ' . $row['lastname']; ?>">
            <p>Age: <?php echo $row['age']; ?></p>
            <p>USTA Ranking: <?php echo $row['ranking']; ?></p>
            <p>Availability:</p>
            <ul>
                <?php
                if ($row['mon']) echo "<li>Monday</li>";
                if ($row['tue']) echo "<li>Tuesday</li>";
                if ($row['wed']) echo "<li>Wednesday</li>";
                if ($row['thu']) echo "<li>Thursday</li>";
                if ($row['fri']) echo "<li>Friday</li>";
                ?>
            </ul>
        </div>
    <?php endwhile; ?>
</div>



</body>

</html>
<?php
include('footer.php');
?>
