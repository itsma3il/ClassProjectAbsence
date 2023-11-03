<?php
$servername = "localhost";
$username = "root";
$password ="";
$db ="istaproject";

try{
      $pdo_conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
      $pdo_conn->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
      echo " Connected Successfully";
}catch(PDOException $e){
      echo "Connection Failed : ".$e->getMessage();
}

?>