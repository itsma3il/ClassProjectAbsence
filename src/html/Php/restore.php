<?php
    include('./config.php');
    /* restore an avertissemnt */
    if (isset($_GET['code'])) {
    $code=$_GET['code'];
    $sql = "select RestoreAvertissement(?)";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $code);
    $stmt->execute();

    header("location: ../profile.php");
    exit();
    }
    
    /* restore a stagaire */
    if (isset($_GET['cin'])) {
    $cin=$_GET['cin'];
    $sql = "select RestoreStagiaire(?)";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $cin);
    $stmt->execute();

    header("location: ../profile.php");
    exit();
    }

?>