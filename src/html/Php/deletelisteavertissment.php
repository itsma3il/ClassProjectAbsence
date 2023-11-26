<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["StagiaireCin"])) {
    $StagiaireCin  = $_GET["StagiaireCin"];

    

    $sql = "DELETE FROM avertissement WHERE StagiaireCin= ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $StagiaireCin);
    $stmt->execute();

    header("Location: ../index.php");
    exit();

}

if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["code"]) && isset($_GET["cin"])) {
    $code = $_GET["code"];
    $cin = $_GET["cin"];

    $sql = "DELETE FROM avertissement WHERE  code = ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $code);
    $stmt->execute();

    header("Location: ../profileStagiaire.php?cin=$cin");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["id"]) && isset($_GET["cin"])) {
    $calculateNoteSql = "CALL CalculateStudentNote(?)";
    $stmtCalculateNote = $pdo_conn->prepare($calculateNoteSql);
    $id = $_GET["id"];
    $cin = $_GET["cin"];
    $sql = "DELETE FROM absence WHERE  AbsenceID = ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $stmtCalculateNote->bindParam(1, $cin);
    $stmtCalculateNote->execute();

    header("Location: ../profileStagiaire.php?cin=$cin");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == 'GET' && isset($_GET["cin"]) && isset($_GET['groupe'])) {
    $cin = filter_input(INPUT_GET, 'cin', FILTER_SANITIZE_STRING);
    
    $sql = "DELETE FROM stagiaire WHERE cin = ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $cin);
    $stmt->execute();

    // Use proper concatenation for the URL parameter
    $redirectUrl = "../listeNotesGroup.php?groupe=" . urlencode($_GET['groupe']);
    header("Location: $redirectUrl");
    exit();
}

?>