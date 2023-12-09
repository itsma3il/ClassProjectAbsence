<?php
include('./Php/sideBar.php');
include('./Php/session.php');

if (isset($_GET['groupe'])) {
  if(!empty($_GET["groupe"])){
  $groupe = $_GET['groupe'];
  $sql = "SELECT * FROM stagiaire WHERE groupe = ? ";
  $stmt =  $pdo_conn->prepare($sql);
  $stmt->bindParam(1, $groupe);
  $stmt->execute();
  $stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
  

  if($stmt->rowCount()>0){
    $numStagiaires = $stmt->rowCount();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $groupe = $_GET['groupe'];
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
      $justification = filter_input(INPUT_POST, "justification_".$cin, FILTER_SANITIZE_STRING);
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

        header("Location: ./listeStagiaire.php?groupe=$groupe&insert=true");
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
  <?php include('styles.php') ?>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- SIDEBAR AND NAVBAR  -->
    <?php include("SIDE&NAV.php") ?>
    <!--  Main CONTENT -->
    <div class="body-wrapper">
      <div class="container-fluid ">
        <div class="container mb-5 ">
          <div class="position-relative">
            <div class="position-absolute d-flex justify-content-between gap-5 top-1 start-0" style="width: -webkit-fill-available;">
              <h2 class="card-title text-dark">Liste Des Stagiaires</h2>
              <h2 class="card-title text-dark"><?php echo $groupe ?></h2>
              <h2 class="card-title text-dark">Nombres Stagiaires: <?php echo $numStagiaires ?></h2>
              <div class="text-center p-1 border border-dark rounded-pill"  >
                <a style="width: 80px;" class="nav-link text-dark fw-bold" href="./listeNotesGroup.php?<?php echo http_build_query(['groupe' => $groupe]); ?>">
                  Infos
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body shadow-sm mt-5 bg-body rounded ">
          <div class="table-container">
            <table class="table table-hover text-center">
              <thead class="bg-gray-2 text-left fixed-thead">
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
              <tbody style="height: 300px; overflow-y: auto;">
                <?php foreach ($stagiaires as $stagiaire) : ?>
                  <form action="./listeStagiaire.php?groupe=<?php echo $stagiaire['groupe'] ?>" method="post">
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
                      <td><input required min="0" type="number" id="typeNumber" name="nbHeures_<?php echo $stagiaire['cin'] ?>" class="bg-light p-1 rounded border-0 enable" /></td>
                      <td><input min="0" type="text" id="typetext" name="justification_<?php echo $stagiaire['cin'] ?>" class="bg-light p-1 rounded border-0 enable" /></td>
                      <td><input min="0" type="checkbox" id="flexCheckDefault" name="Distance_<?php echo $stagiaire['cin'] ?>" class="form-check-input" /></td>
                      <td>
                        <a href="./profileStagiaire.php?cin=<?php echo $stagiaire['cin'] ?>" class="button Profile">Profile</a>
                        <button type="submit" id="submit" name="submit_<?php echo $stagiaire['cin'] ?>" class="button Submit">Submit</button>
                      </td>
                    </tr>
                  </form>
                <?php endforeach; ?>
              </tbody>
            </table>
            </form>
          </div>
        </div>
      </div>

      <!-- footer
            <?php // include('FOOTER.php') 
            ?> -->
    </div>
  </div>
  <?php include('scripts.php') ?>
  <?php
if (isset($_GET["insert"]) && $_GET["insert"] == "true") {
    echo "
        <script>
        iziToast.success({
          title: 'Absence Ajouter',
          message: 'Visitez le profil de ce stagiaire pour Modifier.',
          position:'topRight',
          maxWidth:'400px',
          progressBarColor: 'grey',
          transitionIn: 'fadeInLeft',
          transitionOut: 'fadeOutRight',
      });      
        </script>
    ";
}
?>
</body>

</html>

<?php 
}
else{
  header("location:authentication.php");
  exit();
}
}else{
  header("location:authentication.php");
  exit();
}
}else{
      header("location:authentication.php");
  exit();
    }
?>