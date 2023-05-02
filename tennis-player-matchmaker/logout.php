<?php
session_start();


    setcookie('PHPSESSID', '', time() - 3600);
    $_SESSION = [];
    session_destroy();
    


header('Location: main_page.php');

?>
