<?php
include('config.php');
  if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["submit"])) {
    $cin = $_GET['cin'];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $groupe = $_POST["groupe"];
    $Niveau = $_POST["Niveau"];
    $dateNaissance = $_POST["dateNaissance"];
    $noteDisciplinaire = $_POST["noteDisciplinaire"];

    $sql = "UPDATE stagiaire SET nom = ? , prenom = ?, groupe= ?,Niveau=?, dateNaissance=?, noteDisciplinaire= ?   WHERE cin = ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $nom);
    $stmt->bindParam(2, $prenom);
    $stmt->bindParam(3, $groupe);
    $stmt->bindParam(4, $Niveau);
    $stmt->bindParam(5, $dateNaissance);
    $stmt->bindParam(6, $noteDisciplinaire);
    $stmt->bindParam(7, $cin);
    $stmt->execute();

    header("Location: ./profileStagiaire.php?cin=$cin");
        exit();
}
?>