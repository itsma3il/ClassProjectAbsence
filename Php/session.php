<?php
    // Paths updated
    include('config.php');
    session_start();
    if (!isset($_SESSION['username']))
    {
        header("location: ./authentication.php");
        exit();
    }
?>