<?php
  include('sideBar.php');
  include('session.php');
  include("searchlink.php");

  if (isset($_GET['groupe'])) {
      $groupe = $_GET['groupe'];
      $sql = "SELECT s.cin AS StagiaireCin,
      s.nom AS StagiaireNom,
      s.prenom AS StagiairePrenom,
      s.noteDisciplinaire AS noteDisciplinaire,
      COALESCE(SUM(a.nbHeures), 0) AS TotalNbHeures,
      COALESCE(COUNT(av.StagiaireCin), 0) AS TotalAvertissements
      FROM stagiaire s
      LEFT JOIN absence a ON s.cin = a.StagiaireCin
      LEFT JOIN avertissement av ON s.cin = av.StagiaireCin
      WHERE s.groupe = ?
      GROUP BY s.cin, s.nom, s.prenom;";
      $stmt =  $pdo_conn->prepare($sql);
      $stmt -> bindParam(1,$groupe);
      $stmt->execute();
      $stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $numStagiaires = $stmt->rowCount();
  }
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
  <link rel="stylesheet" href="../assets/css/listeStagiaires.css">

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
        <?php include('sideBarDATA.php') ?>
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
        
                <div class="input-group ">
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
              <a href="./sign_out.php" class="btn btn-primary">sign out</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="./profile.php" id="drop2" 
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
        <div class="card-body shadow-sm p-3 mb-5 bg-body rounded">
            <div class="d-flex p-4 justify-content-between">
              <h2 class="card-title text-dark">Liste Des Stagiaire</h2>
              <h2 class="card-title text-dark"><?php echo $groupe ?></h2>
              <h2 class="card-title text-dark">Nombres Stagiaires: <?php echo $numStagiaires ?></h2>
              <a href="./listeStagiaire.php?groupe=<?php echo $groupe ?>" class="border border-dark rounded-pill button text-dark p-1 px-3">Absence</a>
            </div>
            <!-- <div  style="height: calc(100vh - 250px); width: 100%;"> -->
                
                <form action="#">
                    <table class="table table-hover text-center">
                      <thead class="bg-gray-2 text-left">
                        <tr class="">
                          <th>CIN</th>
                          <th>Nom</th>
                          <th>Prenom</th>
                          <th>Nombre Absence</th>
                          <th>Avertissement</th>
                          <th>Note Discipline</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($stagiaires as $stagiaire) : ?>
                        <tr class="font-weight-bold">
                          <td c><?php echo $stagiaire['StagiaireCin'] ?></td>
                          <td><?php echo $stagiaire['StagiaireNom'] ?></td>
                          <td><?php echo $stagiaire['StagiairePrenom'] ?></td>
                          <td><?php echo $stagiaire['TotalNbHeures'] ?></td>
                          <td><?php echo $stagiaire['TotalAvertissements'] ?></td>
                          <td><?php echo $stagiaire['noteDisciplinaire'] ?></td>
                          <td>
                              <a href="./profileStagiaire.php?cin=<?php echo $stagiaire['StagiaireCin'] ?>" style="background-color: #1e905b;" class="btn text-light btn-sm">profile</a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </form>
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

</body>

</html>