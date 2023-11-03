<?php
session_start();

include('config.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $Password = $_POST["Password"];

        $sql = "SELECT * FROM user  WHERE username = ? and  pswrd = ?";
        $stmt = $pdo_conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $Password);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verify password
        if ($stmt->rowCount()>0) {
                    $_SESSION['id']=$resultat['id'];
                    $_SESSION['username']=$resultat['username'];
                    $_SESSION['pswrd']=$resultat['pswrd'];
                                          
                    header("location: ./index.html");
                    exit();
                    
        }
        else
        {
            echo "<div class='alert alert-danger'>Invalid login credentials.</div>";
        }
    }
}
?>