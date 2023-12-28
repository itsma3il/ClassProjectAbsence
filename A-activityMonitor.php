<?php
// Paths updated
include('./Php/sideBar.php');
include('./Php/session.php');

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

        <div class="card-body">
                  <div class="mb-4">
                    <h5 class="card-title fw-semibold">Recent Transactions</h5>
                    <p class="card-subtitle">How to Secure Recent Transactions</p>
                  </div>
                  <ul class="timeline-widget mb-0 position-relative mb-n5">
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe of $385.90</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1">Payment was made of $64.95 to Michael</div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New arrival recorded <a href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                      </div>
                    </li>
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                      <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                      <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                      </div>
                      <div class="timeline-desc fs-3 text-dark mt-n1">Payment Done</div>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <h5 class="card-title fw-semibold">Upcoming Activity</h5>
                  <p class="card-subtitle">Preparation for the Upcoming Activity</p>
                  <div class="mt-9 py-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary-subtle text-primary rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-map-pin fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">Trip to Singapore</h6>
                      <span class="fs-3">working on</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">12:00 AM</span>
                    </div>
                  </div>
                  <div class="py-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-danger-subtle text-danger rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-bookmark fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">Archived Data</h6>
                      <span class="fs-3">working on</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">3:52 PM</span>
                    </div>
                  </div>
                  <div class="py-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success-subtle text-success rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-microphone fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">Meeting with Client</h6>
                      <span class="fs-3">working on</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">4:50 PM</span>
                    </div>
                  </div>
                  <div class="py-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning-subtle text-warning rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-cast fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold ">Screening Task Team</h6>
                      <span class="fs-3">working on</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">5:10 PM</span>
                    </div>
                  </div>
                  <div class="pt-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-info-subtle text-info rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-mail fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">Send envelope to John</h6>
                      <span class="fs-3">working on</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">6:00 PM</span>
                    </div>
                  </div>
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
    <?php
    if (isset($_GET["ajouter"]) && $_GET["ajouter"] == "true") {
      echo "
    <script>
    iziToast.success({
      title: 'Stagiaire Ajouter',
      message: 'Le Stagiaire été Ajouter avec succès.',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight',
  });      
    </script>
  ";
    }
    if (isset($_GET["restoreAvertissement"]) && $_GET["restoreAvertissement"] == "true") {
      echo "
    <script>
    iziToast.success({
      title: 'Avertissement Restoré',
      message: 'Avertissement été Restoré avec succès.',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight',
  });      
    </script>
  ";
    }
    if (isset($_GET["restoreStagiaire"]) && $_GET["restoreStagiaire"] == "true") {
      echo "
    <script>
    iziToast.success({
      title: 'Stagiaire Restoré',
      message: 'Stagiaire été Restoré avec succès.',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight',
  });      
    </script>
  ";
    }
    if (isset($_GET['error']) && $_GET['error'] === 'true') {
      //echo "<script>alert('An error occurred.');</script>";
      echo "
    <script>
    iziToast.error({
      title: 'Error',
      message: 'An error occurred.',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight',
  });      
    </script>
  ";
    }
    if (isset($_GET["deleteDb"]) && $_GET["deleteDb"] == "true") {
      echo "
    <script>
    iziToast.success({
      title: 'Supprimi Database',
      message: 'Supprimi de la base de données avec succès.',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight',
  });      
    </script>
  ";
    }
    if (isset($_GET["importDb"]) && $_GET["importDb"] == "true") {
      echo "
    <script>
    iziToast.success({
      title: 'Import Stagaires',
      message: 'Importer les stagaires avec succès.',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight',
  });      
    </script>
  ";
    }

    if (isset($_SESSION['import_error'])) {
      echo "<script>alert('" . $_SESSION['import_error'] . "');</script>";
    
      // Clear the session variable
      unset($_SESSION['import_error']);
    }
    ?>
    <script src="./assets/js/validerAjouterStagiaireProfile.js"></script>
</body>
</html>