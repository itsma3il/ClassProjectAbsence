<?php
  include('./Php/sideBar.php');
  include('./Php/session.php');

  if (isset($_GET['groupe'])) {
      $groupe = $_GET['groupe'];
      $sql = "SELECT s.cin AS StagiaireCin,
      s.nom AS StagiaireNom,
      s.prenom AS StagiairePrenom,
      s.noteDisciplinaire AS noteDisciplinaire,
      COALESCE(SUM(a.nbHeures), 0) AS TotalNbHeures,
      av.nbrAvertis AS TotalAvertissements
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
    <!-- SIDEBAR AND NAVBAR  -->
    <?php include("SIDE&NAV.php") ?>
    <!--  Main CONTENT -->
    <div class="body-wrapper">      
      <div class="container-fluid">
        <!--  body -->
        <div class="card-body shadow-sm p-3 mb-5 bg-body rounded">
            <div class="d-flex p-4 justify-content-between">
              <h2 class="card-title text-dark">Liste Des Stagiaire</h2>
              <h2 class="card-title text-dark"><?php echo $groupe ?></h2>
              <h2 class="card-title text-dark">Nombres Stagiaires: <?php echo $numStagiaires ?></h2>
              <a href="./listeStagiaire.php?<?php echo http_build_query(['groupe' => $groupe]); ?>" class="border border-dark rounded-pill button text-dark p-1 px-3">Absence</a>
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
                          <td><?php echo $stagiaire['StagiaireCin'] ?></td>
                          <td><?php echo $stagiaire['StagiaireNom'] ?></td>
                          <td><?php echo $stagiaire['StagiairePrenom'] ?></td>
                          <td><?php echo $stagiaire['TotalNbHeures'] ?></td>
                          <td><?php echo $stagiaire['TotalAvertissements'] ?></td>
                          <td><?php echo $stagiaire['noteDisciplinaire'] ?></td>
                          <td>
                            <a href="./profileStagiaire.php?<?php echo http_build_query(['cin' => htmlspecialchars($stagiaire['StagiaireCin'], ENT_QUOTES, 'UTF-8')]); ?>" style="background-color: #0059a1;" class="btn text-light btn-sm">Profile</a>

                            <a href="./Php/deletelisteavertissment.php?<?php 
                                echo http_build_query([
                                    'cin' => htmlspecialchars($stagiaire['StagiaireCin'], ENT_QUOTES, 'UTF-8'),
                                    'groupe' => $groupe
                                ]);
                            ?>" style="background-color: #fe0a0a;color:white;" class="btn btn-sm">Supprimer</a>

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