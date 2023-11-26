<?php
include('./config.php');

/* from profile */
if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["submit1"])) {
  $cin = $_GET['cin'];
  $date = $_POST["date"];
  $Distance = isset($_POST["Distance"]) ? $_POST['Distance'] : NULL;
  $nbHeures = $_POST["nbHeures"];
  $justification = $_POST["justification"];
  $justification = empty($justification) ? null : $justification;

  $calculateNoteSql = "CALL CalculateStudentNote(?)";
  $stmtCalculateNote = $pdo_conn->prepare($calculateNoteSql);

  // var_dump($_POST);

  $sql = "INSERT INTO `absence` (`AbsenceID`, `StagiaireCin`, `date`, `nbHeures`, `distance`, `justification`) VALUES (NULL, ?, ?, ?, ?, ?)";
      $stmt = $pdo_conn->prepare($sql);
      if (!empty($date) && !empty($nbHeures)) {
        $stmt->bindParam(1, $cin);
        $stmt->bindParam(2, $date);
        $stmt->bindParam(3, $nbHeures);
        $stmt->bindParam(4, $Distance);
        $stmt->bindParam(5, $justification);
        $stmt->execute();

        $stmtCalculateNote->bindParam(1, $cin);
        $stmtCalculateNote->execute();
        $result = $stmtCalculateNote->fetch(PDO::FETCH_ASSOC);
        header("Location: ../profileStagiaire.php?cin=$cin");
        exit();
      }
}

?>