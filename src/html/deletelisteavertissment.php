<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["StagiaireCin"])) {
    $StagiaireCin  = $_GET["StagiaireCin"];

    $sql = "DELETE FROM avertissement WHERE StagiaireCin= ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $StagiaireCin);
    $stmt->execute();

    header("Location: ./index.php");
    exit();

}

if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["code"]) && isset($_GET["cin"])) {
    $code = $_GET["code"];
    $cin = $_GET["cin"];

    $sql = "DELETE FROM avertissement WHERE  code = ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $code);
    $stmt->execute();

    header("Location: ./profileStagiaire.php?cin=$cin");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["id"]) && isset($_GET["cin"])) {
    $id = $_GET["id"];
    $cin = $_GET["cin"];
    $sql = "DELETE FROM absence WHERE  AbsenceID = ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();

    header("Location: ./profileStagiaire.php?cin=$cin");
    exit();
}
?>