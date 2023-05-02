<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="default.css">
</head>

<body>

<header>Welcome to Match Finder</header>

<nav>
    <a href="main_page.php">Home Page</a>
    <?php
    session_start();
    if (isset($_SESSION['user_id'])): ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>

