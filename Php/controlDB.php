<?php
session_start();
include('config.php');
require '../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


//delete the database
if (isset($_POST["delete"])){
    $sql = "TRUNCATE TABLE stagiaire"; 
    $stmt = $pdo_conn->prepare($sql);
    $stmt->execute();
  
    header("location: ../profile.php?deleteDb=true");
    exit();
}

//install db
if (isset($_POST["install"])){

    $sql = "SELECT * FROM stagiaire";
    $stmt = $pdo_conn->query($sql);
    $stagiaireData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $spreadsheet = new Spreadsheet();

    $spreadsheet->getActiveSheet()->setTitle('Stagiaire Data');

    $spreadsheet->getActiveSheet()->setCellValue('A1', 'CIN');
    $spreadsheet->getActiveSheet()->setCellValue('B1', 'Nom');
    $spreadsheet->getActiveSheet()->setCellValue('C1', 'Prenom');
    $spreadsheet->getActiveSheet()->setCellValue('D1', 'Niveau');
    $spreadsheet->getActiveSheet()->setCellValue('E1', 'groupe');
    $spreadsheet->getActiveSheet()->setCellValue('F1', 'dateNaissance');
    $spreadsheet->getActiveSheet()->setCellValue('G1', 'NTelephone');
    $spreadsheet->getActiveSheet()->setCellValue('H1', 'noteDisciplinaire');

    $row = 2;
    foreach ($stagiaireData as $stagiaire) {
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $stagiaire['cin']);
        $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $stagiaire['nom']);
        $spreadsheet->getActiveSheet()->setCellValue('C' . $row, $stagiaire['prenom']);
        $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $stagiaire['Niveau']);
        $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $stagiaire['groupe']);
        $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $stagiaire['dateNaissance']);
        $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $stagiaire['NTelephone']);
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $stagiaire['noteDisciplinaire']);

        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $tempFile = tempnam(sys_get_temp_dir(), 'stagiaire_data') . '.xlsx';
    $writer->save($tempFile);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="stagiaire_data.xlsx"');
    header('Cache-Control: max-age=0');

    readfile($tempFile);
    unlink($tempFile);
    exit();
}

// import data
if (isset($_POST['import'])) {
    error_reporting(E_ERROR | E_PARSE);
    $file = $_FILES['excel_file']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($file);

        $worksheet = $spreadsheet->getActiveSheet();

        foreach ($worksheet->getRowIterator(2) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $data = [];
            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }
            
            $sql = "INSERT INTO stagiaire (cin, nom, prenom, Niveau, groupe, dateNaissance, NTelephone, noteDisciplinaire)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo_conn->prepare($sql);
            $stmt->execute($data);
        }

        header("location: ../profile.php?importDb=true");
        exit();
    } catch (Exception $e) {
        // Store error message in session
        $_SESSION['import_error'] = "Error: " . $e->getMessage();
        // Redirect back to the profile page
        header("location: ../profile.php");
        exit();
    }
}
?>