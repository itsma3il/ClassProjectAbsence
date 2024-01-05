<?php 
include('./config.php');

if (isset($_POST["ajouter"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password
    $email = $_POST['email'];
    $role = $_POST['role'];
    $avatar = $_POST['avatar'];
    // Corrected SQL query with proper placeholders
    $sqlInsert = "INSERT INTO user (username, password, Email, Nom, prenom, Role,avatar) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $pdo_statement = $pdo_conn->prepare($sqlInsert);
    $pdo_statement->bindParam(1, $username);
    $pdo_statement->bindParam(2, $password);
    $pdo_statement->bindParam(3, $email);
    $pdo_statement->bindParam(4, $nom);
    $pdo_statement->bindParam(5, $prenom);
    $pdo_statement->bindParam(6, $role);
    $pdo_statement->bindParam(7, $avatar);
    $pdo_statement->execute();
    header("location:../A-userManagement.php?insert=true");
  }

?>