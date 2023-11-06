<?php 
include('config.php');
$sql = "SELECT DISTINCT groupe FROM `stagiaire` WHERE groupe LIKE 'DEV%' 
        UNION 
        SELECT DISTINCT groupe FROM `stagiaire` WHERE groupe LIKE 'ID%' 
        UNION 
        SELECT DISTINCT groupe FROM `stagiaire` WHERE groupe LIKE 'WFS%' 
        UNION 
        SELECT DISTINCT groupe FROM `stagiaire` WHERE groupe LIKE 'AM%' 
        ORDER BY groupe ASC";

$stmt = $pdo_conn->prepare($sql);
$stmt->execute();
$groups = $stmt->fetchAll();

$devGroups = [];
$idGroups = [];
$wfsGroups = [];
$amGroups = [];

foreach ($groups as $row) {
    $groupe = $row['groupe'];
    if (strpos($groupe, 'DEV') === 0) {
        $devGroups[] = $groupe;
    } elseif (strpos($groupe, 'ID') === 0) {
        $idGroups[] = $groupe;
    } elseif (strpos($groupe, 'WFS') === 0) {
        $wfsGroups[] = $groupe;
    } elseif (strpos($groupe, 'AM') === 0) {
        $amGroups[] = $groupe;
    }
}

?>