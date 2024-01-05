<?php
include('./config.php');


if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM user WHERE id= ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();


    header("Location:../A-userManagement.php?insert2=true");
    exit();

} ?>
