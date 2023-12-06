<?php
session_start();
    include('./config.php');
    include('userLogs.php');

    /* restore an avertissemnt */
    if (isset($_GET['code'])) {
    $code=$_GET['code'];
    $sql = "select RestoreAvertissement(?)";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $code);
    $stmt->execute();

    header("location: ../profile.php?restoreAvertissement=true");
    exit();
    }
    
    /* restore a stagaire */
    if (isset($_GET['cin'])) {
    $cin=$_GET['cin'];
    $sql = "select RestoreStagiaire(?)";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $cin);
    $stmt->execute();

    $user = $_SESSION["username"];
    $action = ' restauré le stagiaire';
    log_action($user, $cin, $action);

    header("location: ../profile.php?restoreStagiaire=true");
    exit();
    }

?>