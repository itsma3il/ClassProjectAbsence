<?php
// Paths updated
$servername = "localhost";
$username = "abseqhjc_root";
$password ="vHW[y.Z6+%Tw";
$db ="abseqhjc_absenceprojet";

try{
      $pdo_conn = new PDO("mysql:host=$servername;dbname=$db",$username,$password);
      $pdo_conn->setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
}
catch(PDOException $e){
      echo "Connection Failed : ".$e->getMessage();
}

?>
