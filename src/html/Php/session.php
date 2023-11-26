<?php
    include('config.php');
    session_start();
    if (!isset($_SESSION['username']))
    {
        header("location: ../html/authentication-login.php");
        exit();
    }
?>