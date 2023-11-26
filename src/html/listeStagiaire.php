<?php
    include('./Php/sideBar.php');
    include('./Php/session.php');

    if (isset($_GET['groupe'])) {
        $groupe = $_GET['groupe'];
        $sql = "SELECT * FROM stagiaire WHERE groupe = ? ";
        $stmt =  $pdo_conn->prepare($sql);
        $stmt -> bindParam(1,$groupe);
        $stmt->execute();
        $stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numStagiaires = $stmt->rowCount();
    }
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
      $groupe=$_GET['groupe'];
      $sql = "INSERT INTO `absence` (`AbsenceID`, `StagiaireCin`, `date`, `nbHeures`,`distance`, `justification`) VALUES (NULL, ?, ?, ?, ?, ?)";
      $stmt = $pdo_conn->prepare($sql);
    
      $calculateNoteSql = "CALL CalculateStudentNote(?)";
      $stmtCalculateNote = $pdo_conn->prepare($calculateNoteSql);
    
      foreach ($stagiaires as $stagiaire) {
          $cin = $stagiaire['cin'];
          $groupe = $stagiaire['groupe'];
          if (isset($_POST["submit_$cin"])) {
              $date = $_POST['date_' . $cin];
              $nbHeures = $_POST['nbHeures_' . $cin];
              $Distance = isset($_POST['Distance_' . $cin]) ? $_POST['Distance_' . $cin] : NULL;
              $justification = $_POST['justification_' . $cin];
              $justification = empty($justification) ? null : $justification;
              
              if (!empty($date) && !empty($nbHeures)) {
                  $stmt->bindParam(1, $cin);
                  $stmt->bindParam(2, $date);
                  $stmt->bindParam(3, $nbHeures);
                  $stmt->bindParam(4, $Distance);
                  $stmt->bindParam(5, $justification);
                  $stmt->execute();
                  
                  $stmtCalculateNote->bindParam(1, $cin);
                  $stmtCalculateNote->execute();
                  
                  header("Location: ./listeStagiaire.php?groupe=$groupe");
                  exit();
              }
          }
      }
    }

    /* var_dump($_POST); */

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
  <link rel="stylesheet" href="../assets/css/listeStagiaires.css">
  <link rel="stylesheet" href="../assets/css/sidebarmenu.css">
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
            <h5 class="card-title fw-semibold mb-4"><div class="d-flex p-4 justify-content-between">
              <h2 class="card-title text-dark">Liste Des Stagiaire</h2>
              <h2 class="card-title text-dark"><?php echo $groupe ?></h2>
              <h2 class="card-title text-dark">Nombres Stagiaires:  <?php echo $numStagiaires ?> </h2>
              <a href="./listeNotesGroup.php?groupe=<?php echo $groupe ?>" class="border border-dark rounded-pill text-dark button p-1 px-3">Infos</a>
            </div></h5>
            <!-- <div  style="height: calc(100vh - 250px); width: 100%;"> -->
                
                    <table class="table table-hover text-center">
                      <thead class="bg-gray-2 text-left">
                        <tr class="">
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">CIN</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Nom</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Prenom</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Date Absence</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Nombre Heures</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Justification</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Distance</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($stagiaires as $stagiaire) : ?>
                      <form action="./listeStagiaire.php?groupe=<?php echo $stagiaire['groupe']?>" method="post">
                        <tr class="font-weight-bold  align-items-center">
                              <th scope="row" name="cin"><?php echo $stagiaire['cin'] ?></th>
                              <td><?php echo $stagiaire['nom'] ?></td>
                              <td><?php echo $stagiaire['prenom'] ?></td>
                              <td>
                                    <?php
                                        $currentDate = date('Y-m-d');
                                        echo '<input required type="date" id="datepicker" name="date_' . $stagiaire['cin'] . '" class="datepicker p-2 bg-light rounded border-0" value="' . $currentDate . '">';
                                    ?>
                              </td>  
                              <td><input required min="0" type="number" id="typeNumber"  name="nbHeures_<?php echo $stagiaire['cin'] ?>" class="bg-light p-1 rounded border-0 enable" /></td>
                              <td><input min="0" type="text" id="typetext" name="justification_<?php echo $stagiaire['cin'] ?>" class="bg-light p-1 rounded border-0 enable" /></td>
                              <td><input min="0" type="checkbox" id="flexCheckDefault" name="Distance_<?php echo $stagiaire['cin'] ?>" class="form-check-input" /></td>
                              <td>
                              <button type="submit" id="submit" name="submit_<?php echo $stagiaire['cin'] ?>" class="button Submit" >Submit</button>
                                  <a href="./profileStagiaire.php?cin=<?php echo $stagiaire['cin'] ?>" class="button Profile">Profile</a>
                              </td>
                            </tr>
                          </form>
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
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/listeStagiaires.js"></script>
</body>

</html>