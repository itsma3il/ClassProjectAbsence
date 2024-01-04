<?php
// Paths updated
include('./Php/sideBar.php');
include('./Php/session.php');
$user = $_SESSION["username"];
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
              <h4 class="fw-semibold mb-8">Gestion des donnees</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="./index.php">Accueil</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">Gestion des donnees</li>
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

      <div class="row mx-0">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">1</div>
            <div class="card-body">
              <h5 class="card-title">Effacer la Base de Données :</h5>
              <p class="card-text">
                Cette fonction permet de vider entièrement la base de données.
              </p>
              <button type="button" class="btn mb-1 justify-content-center align-items-baseline w-100 d-flex align-items-center waves-effect waves-light btn-danger">
                <i class="fs-5 ti ti-trash mx-1"></i>
                Vider
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">2</div>
            <div class="card-body">
              <h5 class="card-title">Télécharger le Modèle Excel :</h5>
              <p class="card-text">
                Utilisez cette option pour télécharger le modèle Excel préétabli.
              </p>
              <button type="button" class="btn mb-1 justify-content-center align-items-baseline w-100 d-flex align-items-center waves-effect waves-light btn-success">
                <i class="fs-5 ti ti-file-description mx-1"></i>
                Télécharger
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">3</div>
            <div class="card-body">
              <h5 class="card-title">Importer le Fichier Excel :</h5>
              <p class="card-text">
                Importez vos données en utilisant un fichier Excel grâce à cette fonction.
              </p>
              <form class="mt-3">
                <input class="form-control" type="file" id="formFile">
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">4</div>
            <div class="card-body">
              <h5 class="card-title">Exécuter l'Importation :</h5>
              <p class="card-text">
                Une fois le fichier sélectionné, exécutez l'importation des données.
              </p>
              <button type="button" class="justify-content-center align-items-baseline w-100 btn mb-1 btn-rounded btn-dark d-flex align-items-center waves-effect waves-light">
                <i class="fs-5 ti ti-file-check mx-1"></i>
                Exécuter
              </button>
            </div>
          </div>
        </div>

      </div>



    </div>
  </div>
  </div>
  <!-- footer -->
  <div class="py-6 px-6 text-center">
    <p class="mb-0 fs-4">Copyright By <a href="#" target="_blank" class="pe-1 text-primary text-decoration-underline">WFS205</a> 2023</p>
  </div>
  <?php include('scripts.php') ?>
  <script src="./assets/js/getGroups.js"></script>

  <script src="./assets/js/app.min.js"></script>


  <script src="./assets/js/validerAjouterStagiaireProfile.js"></script>
</body>

</html>