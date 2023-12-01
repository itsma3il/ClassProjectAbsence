<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["submit"])) {
    try {
        $sql = "INSERT INTO `stagiaire` (`cin`, `nom`, `prenom`, `Niveau`, `groupe`, `dateNaissance`, `NTelephone`, `noteDisciplinaire`) 
        VALUES (?,?,?,?,?,?,?,?);";
        $stmt = $pdo_conn->prepare($sql);

        $cin = $_POST['cin'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $annee = $_POST['annee'];
        $tele = $_POST['tele'];
        $groupe = $_POST['groupe'];
        $date = $_POST['date'];
        $note = $_POST['note'];

        $checkGroupSql = "SELECT COUNT(*) FROM `stagiaire` WHERE `groupe` = ?";
        $checkGroupStmt = $pdo_conn->prepare($checkGroupSql);
        $checkGroupStmt->bindParam(1, $groupe);
        $checkGroupStmt->execute();
        $groupExists = $checkGroupStmt->fetchColumn();

        if (!empty($nom) && !empty($prenom) && !empty($cin)) {
            if ($groupExists != 0) {
                $stmt->bindParam(1, $cin);
                $stmt->bindParam(2, $nom);
                $stmt->bindParam(3, $prenom);
                $stmt->bindParam(4, $annee);
                $stmt->bindParam(5, $groupe);
                $stmt->bindParam(6, $date);
                $stmt->bindParam(7, $tele);
                $stmt->bindParam(8, $note);
                $stmt->execute();
            } else {
                throw new Exception("Group does not exist.");
            }

            header("Location: ../profile.php?ajouter=true");
            exit();
        }
    } catch (Exception $e) {
      header("Location: ../profile.php?error=true");
      exit();}
}
?>
