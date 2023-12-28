<?php
// Paths updated
include('./Php/sideBar.php');
include('./Php/session.php');



$sql = "SELECT d.*,s.*  FROM deletedavertissement d inner join stagiaire s
                on d.StagiaireCin=s.cin ";
$stmt =  $pdo_conn->prepare($sql);
$stmt->execute();
$deletedAvrt = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user = $_SESSION["username"];
$sql = "SELECT * FROM logs where Username = ?  ORDER BY `Timestamp` DESC";
$stmt =  $pdo_conn->prepare($sql);
$stmt->bindParam(1, $user);
$stmt->execute();
$activites = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ofppt WFS205</title>
  <?php include('styles.php') ?>

  <link rel="stylesheet" href="./assets/css/Ajouter.css">
  <link rel="stylesheet" href="./assets/css/popup.css">


</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- SIDEBAR AND NAVBAR  -->
    <?php include("SIDE&NAV.php") ?>
    <!--  Main CONTENT -->

      <div class="container-fluid d-flex flex-column gap-3">

      <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
          <div class="card-body px-4 py-3">
            <div class="row align-items-center">
              <div class="col-9">
                <h4 class="fw-semibold mb-8">Account Setting</h4>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a class="text-muted text-decoration-none" href="./index.php">Accueil</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Account Setting</li>
                  </ol>
                </nav>
              </div>
              <div class="col-3">
                <div class="text-center mb-n5">
                  <img src="./assets/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                </div>
              </div>
            </div>
          </div>
        </div>

          <form action="./Php/controlDB.php" method="post" enctype="multipart/form-data">
          <div class="row m-0 my-5">
            <div class="col p-4 table-responsive table-container rounded border border-light shadow-sm">
              <h1 class="my-2">Base de donnée tooling </h1>

              <div class="row">
                <div class="col-12 card shadow-sm">
                  <h5 class="card-header text-dark bg-danger ">vider la base de donnée</h5>
                  <div class="card-body p-2">
                    <button type="submit" name="delete" onclick="alert('are you sure you wanna delete the DataBase?')" class="btn btn-danger">Supprimer</button>
                  </div>
                </div>

                <div class="col-12 card shadow-sm">
                  <h5 class="card-header text-dark bg-success">télécharger template excel </h5>
                  <div class="card-body p-2">
                    <button type="submit" class="btn btn-success" name="install">télécharger</button>
                  </div>
                </div>
                </form>
                <form action="./Php/controlDB.php" method="post" enctype="multipart/form-data">
                <div class="col-12 card shadow-sm">
                  <h5 class="card-header text-dark bg-info"> importer le fichier excel</h5>
                  <div class="card-body p-2">
                    <div class="input-group">
                      <input type="file" name="excel_file" accept=".xls, .xlsx" class="form-control" id="inputGroupFile02" required>
                      <label class="input-group-text bg-info text-white" for="inputGroupFile02">importer</label>
                    </div>
                    <button type="submit" class="btn btn-info mt-2" name="import">importer</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
          </div>
          <!-- footer -->
          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Copyright By <a href="#" target="_blank" class="pe-1 text-primary text-decoration-underline">WFS205</a> 2023</p>
          </div>
        </div>
      </div>
    </div>
    <?php include('scripts.php') ?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./assets/js/getGroups.js"></script>
    <script src="./assets/js/popup.js"></script>
    <script src="./assets/js/validerAjouterStagiaireProfile.js"></script>
</body>
</html>