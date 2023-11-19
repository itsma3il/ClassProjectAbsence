<?php
  include('sideBar.php');
  include('session.php');
  if(isset($_GET['cin'])){
    $cin = $_GET['cin'];
    $sql = "SELECT *  FROM stagiaire 
            WHERE cin = ? ";
        $stmt =  $pdo_conn->prepare($sql);
        $stmt -> bindParam(1,$cin);
        $stmt->execute();
        $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);
  }


  $sql = "CALL ShowAbsenceHours(?)";
  $stmt = $pdo_conn->prepare($sql);
  $stmt->bindParam(1, $cin);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $hoursWithJustification = $result['Hours With Justification'];
  $hoursWithoutJustification = $result['Hours Without Justification'];

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ofppt WFS205</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/avertissement.css">
  <link rel="stylesheet" href="../assets/css/sidebarmenu.css">
  <link rel="stylesheet" href="../assets/css/profileStagiaire.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <?php include('sideBarDATA.php')?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="d-none d-md-none d-lg-block">
              <!-- Form -->
              <form action="#">
        
                <div class="input-groupC ">
                  <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                  <span class="input-group-append">
                    <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                      </svg>
                    </button>
                  </span>
                </div>
              </form>
            </ul>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="./authentication-login.php" class="btn btn-primary">sign out</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <?php include("searchlink.php") ?>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  body -->
            <div class="card-body shadow-sm p-3 mb-5 rounded-4 text-white ProfileCard">
                  <div class="container">
                              <div class="col-12  ">
                                    <h1 class="text-white"><strong><?php echo $stagiaire['nom'] ?></strong></h1>
                                    <h1 class="text-white"><strong><?php echo $stagiaire['prenom'] ?></strong></h1>
                              </div>

                              <div class="row">
                                    <ul class="list-inline">
                                          <li class="list-inline-item">Cin: <strong><?php echo $stagiaire['cin'] ?></strong></li>
                                          <li class="list-inline-item">Né le: <strong><?php echo $stagiaire['dateNaissance'] ?></strong></li>
                                          <li class="list-inline-item">Annee: <strong><?php echo $stagiaire['Niveau'] ?></strong></li>
                                          <li class="list-inline-item">Groupe: <strong><?php echo $stagiaire['groupe'] ?></strong></li>
                                          <li class="list-inline-item">Telephone: <strong>0<?php echo $stagiaire['NTelephone'] ?></strong></li>
                                    </ul>
                              </div>

                        <div class="row ">
                            
                            <div class="col p-3 mt-1 me-2 rounded-4 Note">
                                <!-- First div -->
                                <h1 class="text-white"><strong><?php echo $stagiaire['noteDisciplinaire'] ?></strong></h1>
                                <h4 class="text-white">la Note Desciplinaire</h4>
                            </div>

                            <div class="col p-3 mt-1 me-2 rounded-4 NoJustifier">
                                <!-- Second div -->
                                    <h1 class="text-white"><strong><?php echo $hoursWithoutJustification?></strong><span>Hr</span></h1>
                                    <h4 class="text-white">heures absent non Justifier</h4>
                            </div>

                            <div class="col p-3 mt-1 me-2 rounded-4 Justifier">
                                <!-- Third div -->
                                <h1 class="text-white"><strong><?php echo $hoursWithJustification?></strong><span>Hr</span></h1>
                                <h4 class="text-white">heures absent justifier</h4>
                            </div>

                        </div>
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
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/listeStagiaires.js"></script>
</body>

</html>