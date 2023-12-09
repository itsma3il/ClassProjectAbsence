<?php
include('./Php/sideBar.php');
include('./Php/session.php');

try {
  if (isset($_GET['cin'])) {
      $cin = $_GET['cin'];
      $sql = "SELECT *  FROM stagiaire WHERE cin = ?";
      $stmt = $pdo_conn->prepare($sql);
      $stmt->bindParam(1, $cin);
      $stmt->execute();
      $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$stagiaire) {
          throw new Exception("Stagiaire does not exist.");
      }
  } else {
      throw new Exception("CIN parameter not set.");
  }
} catch (Exception $e) {
  echo "<script>alert('{$e->getMessage()}'); history.back();</script>";
  exit();
}

  if ($stmt->rowCount() > 0) {
$sql = "SELECT *  FROM absence 
          WHERE StagiaireCin = ? ";
$stmt =  $pdo_conn->prepare($sql);
$stmt->bindParam(1, $cin);
$stmt->execute();
$absence = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM avertissement WHERE StagiaireCin = ?";
$stmt = $pdo_conn->prepare($sql);
$stmt->bindParam(1, $cin);
$stmt->execute();

$avertissements = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  <?php include('styles.php') ?>
  <link rel="stylesheet" href="../assets/css/profileStagiaire.css">
  <link rel="stylesheet" href="../assets/css/ModifierStg.css">
</head>

<body  onload="getGroups()">
<?php
// Display alert using JavaScript if needed
/* if (isset($showAlert) && $showAlert) {
  echo '<div class="alert alert-danger" role="alert">
          Stagiaire does not exist.
        </div>';
} */
?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- SIDEBAR AND NAVBAR  -->
    <?php include("SIDE&NAV.php") ?>
    <!--  Main CONTENT -->
    <div class="body-wrapper">
      <div class="container-fluid">
        <!--  body -->
        <div class="container mb-5">
          <div class="position-relative">
            <div class="position-absolute top-0 start-0">
              <p>Stagiaires Listes<span class="text-dark fw-bold py-3"> > Stagiaires Details Page</span></p>
            </div>
            <div class="position-absolute top-0 end-0 w-auto text-end p-1 border border-dark rounded-pill">
              <a class="nav-link text-dark fw-bold" href="./listeNotesGroup.php?groupe=<?php echo $stagiaire['groupe'] ?>">
                <i>
                  <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </i>
                Retour
              </a>
            </div>
          </div>
        </div>
        <div class="card-body shadow-sm p-3 mb-5 rounded-4 text-white ProfileCard">
          <div class="container">
            <div class="col-12  ">
              <h1 class="text-white">
                <strong>
                  <?php echo $stagiaire['nom'] ?></br><?php echo $stagiaire['prenom'] ?>
                </strong>
              </h1>
            </div>

            <div class="row">
              <ul class="list-inline">
                <li class="list-inline-item">Cin: <strong><?php echo $stagiaire['cin'] ?></strong></li> 
                <li class="list-inline-item">Né le: <strong><?php echo $stagiaire['dateNaissance'] ?></strong></li>
                <li class="list-inline-item">Annee: <strong><?php echo $stagiaire['Niveau'] ?></strong></li>
                <li class="list-inline-item">Groupe: <strong  id="selectedgroupe" ><?php echo $stagiaire['groupe'] ?></strong></li>
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
                <h1 class="text-white"><strong><?php echo $hoursWithoutJustification ?></strong><span>Hr</span></h1>
                <h4 class="text-white">heures absent non Justifier</h4>
              </div>

              <div class="col p-3 mt-1 me-2 rounded-4 Justifier">
                <!-- Third div -->
                <h1 class="text-white"><strong><?php echo $hoursWithJustification ?></strong><span>Hr</span></h1>
                <h4 class="text-white">heures absent justifier</h4>
              </div>

            </div>
          </div>
        </div>
        <div class="row ">
          <!-- calender -->

          <!-- avertissement -->
          <div class="col">
            <div class="table-responsive rounded border border-light shadow-sm">
              <table class="table">
                <thead class="bg-gray-2 table-light text-left fixed-thead">
                  <tr>
                    <th class="min-width-150 py-3 px-4 font-weight-medium">
                      Date Avertissement
                    </th>
                    <th class="min-width-120 py-3 px-4 font-weight-medium">
                      Status
                    </th>
                    <th class="min-width-120 py-3 px-4 font-weight-medium">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($avertissements) { ?>
                    <?php foreach ($avertissements as $avertissement) { ?>
                      <tr>
                        <td class="border-bottom text-dark fw-bold py-3 px-4">
                          <p><?php echo $avertissement['DateAverti'] ?></p>
                        </td>
                        <td class="border-bottom py-3 px-4">
                          <span class="nadge py-1 px-3 text-sm font-weight-medium avertissementText">
                            <?php echo $avertissement['message'] ?>
                          </span>
                        </td>
                        <td class="border-bottom py-3 px-4">
                          <div class="d-flex align-items-center">
                            <a onclick="return confirm('are you sure')" href="./Php/deletelisteavertissment.php?code=<?php echo $avertissement['code']; ?>&cin=<?php echo $avertissement['StagiaireCin']; ?>">
                              <button class="btn btn-link text-primary">
                                <!-- delete -->
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                  <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                </svg>
                              </button>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php  }
                  } else { ?>
                    <tr>
                      <td colspan="3">No avertissements available.</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end avertissement -->
          <div class="col">
            <div class="row">
              <div id="popup" class="popup">
                <form action="./Php/UpdateStg.php?cin=<?php echo $cin ?>" method="post">
                  <div class="popupContent">
                    <div class="modifier">
                      <strong>Modifier Stagiaire</strong>
                    </div>
                    <div class="inputContainer">
                      <div class="inputs">
                        <div>
                          <label>Nom :</label><input class="ipt" type="text" name="nom" value="<?php echo $stagiaire['nom'] ?>">

  


                        </div>
                        <div id="groupContainer">
                          <label>Groupe:</label>
                          <select class="ipt" name="groupe" id="groupe" required>

                          </select>
                        </div>
                        <div>
                          <label>Annee:</label>
                          <select class="ipt" name="annee" id="annee" required onchange="getGroups()">
                            <?php
                            if ($stagiaire['Niveau'] == "1ere annee") {
                              echo "<option value='1ere annee' selected>1ere annee</option>
                                                  <option value='2eme annee' >2eme annee</option>";
                            } else {
                              echo "<option value='1ere annee' >1ere annee</option>
                                                  <option value='2eme annee' selected >2eme annee</option>";
                            };
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="inputs">
                        <div>
                          <label>Prenom:</label><input class="ipt" type="text" name="prenom" value="<?php echo $stagiaire['prenom'] ?>">
                        </div>
                        <div>
                          <label>DateNaissance:</label><input class="ipt" type="date" name="dateNaissance" value="<?php echo $stagiaire['dateNaissance'] ?>">
                        </div>
                        <div>
                          <label>Note:</label><input class="ipt" type="text" name="noteDisciplinaire" value="<?php echo $stagiaire['noteDisciplinaire'] ?>">

  

                        </div>
                      </div>
                    </div>
                    <div class="buttonCont">
                      <button class="button confirm" id="button-confirm" type="submit" name="submit">
                        <img src="../assets/images/Icons/Vector.svg" alt="">
                      </button>
                      <button class="button cancel" id="button-cancel" type="reset">
                        <img src="../assets/images/Icons/cross.svg" alt="">
                      </button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
            <div class="row">
              <div class="popup">
                <form action="./Php/insertAbsence.php?cin=<?php echo $cin ?>" method="post">
                  <div class="popupContent">
                    <div>
                      <strong>Ajouter Absence</strong>
                    </div>
                    <div class="inputContainer">
                      <div class="absenceContainer">
                        <span>
                          <label for="flexCheckDefault">Distance:</label> <input type="checkbox" name="Distance" class="form-check-input" id="flexCheckDefault">
                        </span>
                        <?php
                        $currentDate = date('Y-m-d');
                        echo '<input required type="date" name="date" class="ipt" value="' . $currentDate . '">';
                        ?>
                        <input class="ipt"  min="0" type="number" placeholder="NbrHeures" name="nbHeures" required>
      


                        <input class="ipt" type="text" placeholder="Justification" name="justification">
                      </div>
                    </div>
                    <div class="buttonCont">
                      <button class="button confirm" type="submit" name="submit1" id="button-confirm">
                        <img src="../assets/images/Icons/Vector.svg" alt="">
                      </button>
                      <button class="button cancel" type="reset" id="button-cancel">
                        <img src="../assets/images/Icons/cross.svg" alt="">
                      </button>
                    </div>
                  </div>
              </div>
              </form>
            </div>
          </div>

          <!-- table Absence -->
          <div class="row mt-4 ">
            <div class="col-12">
              <div class="card-body">
                <!-- table -->
                <div class="table-responsive rounded border border-light shadow-sm">
                  <table class="table table-hover">
                    <thead class="bg-gray-2 table-light text-left fixed-thead">
                      <tr>
                        <th class="min-width-220 py-3 px-4 font-weight-medium">
                          Date Absence
                        </th>
                        <th class="min-width-150 py-3 px-4 font-weight-medium">
                          Nombre Heures
                        </th>
                        <th class="min-width-120 py-3 px-4 font-weight-medium">
                          Justification
                        </th>
                        <th class="min-width-120 py-3 px-4 font-weight-medium">
                          Action
                        </th>

                    </thead>
                    <tbody>
                      <?php if (!empty($absence) && is_array($absence) && count($absence) > 0) : ?>
                        <?php foreach ($absence as $abs) : ?>
                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p><?php echo $abs['date'] ?></p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p><?php echo $abs['nbHeures'] ?></p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p><?php echo empty($abs['justification']) ? "Aucune" : $abs['justification']; ?></p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <a onclick="return confirm('are you sure')" href="./Php/deletelisteavertissment.php?id=<?php echo $abs['AbsenceID'] ?>&cin=<?php echo $abs['StagiaireCin'] ?>">
                                  <button class="btn btn-link text-primary">
                                    <!-- delete -->
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                      <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                    </svg>
                                  </button>
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="4">No absences available.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


        </div>

        <!-- footer -->
        <?php include('FOOTER.php') ?>
      </div>
    </div>


  </div>

  <?php include('scripts.php') ?>
  <script src="../assets/js/getGroups.js"></script>
<?php
if (isset($_GET["deleted"]) && $_GET["deleted"] == "true") {
  echo "
  <script>
  iziToast.error({
    title: 'Avertissement Supprimé',
    message: 'Visitez Votre profil pour restaurer.',
    position:'topRight',
    maxWidth:'400px',
    progressBarColor: 'grey',
    transitionIn: 'fadeInLeft',
    transitionOut: 'fadeOutRight'
});      
  </script>
";
}
if (isset($_GET["deletedAbsence"]) && $_GET["deletedAbsence"] == "true") {
  echo "
  <script>
  iziToast.error({
    title: 'Absence Supprimé',
    message: 'Ajouter un nouveau Absence en haut.',
    position:'topRight',
    maxWidth:'400px',
    progressBarColor: 'grey',
    transitionIn: 'fadeInLeft',
    transitionOut: 'fadeOutRight'
});      
  </script>
";
}

if (isset($_GET["updated"]) && $_GET["updated"] == "true") {
  echo "
  <script>
  iziToast.success({
    title: 'Stagiaire Modifié',
    message: 'Les modifications ont été enregistrées avec succès.',
    position:'topRight',
    maxWidth:'400px',
    progressBarColor: 'grey',
    transitionIn: 'fadeInLeft',
    transitionOut: 'fadeOutRight'
});      
  </script>
";
}

// les message d'error
if(isset($_GET["configNomPrenomMessage"]) && !empty($_GET["configNomPrenomMessage"])){
$configNomPrenomMessage=strip_tags($_GET["configNomPrenomMessage"]);
if (isset($_GET["updated"]) && $_GET["updated"] == "false") {
  echo "
  <script>
  iziToast.error({
    title: 'Stagiaire ne pas Modifié',
    message: '".$configNomPrenomMessage. "',
    position:'topRight',
    maxWidth:'400px',
    progressBarColor: 'grey',
    transitionIn: 'fadeInLeft',
    transitionOut: 'fadeOutRight'
});      
  </script>
";
}}

// les message d'error de insertion d'absence


  if (isset($_GET["insertAbs"]) && $_GET["insertAbs"] == "false") {
    echo "
    <script>
    iziToast.error({
      title: 'Insirer l`absence',
      message: 'l`absence ne pas insere!!!',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight'
  });      
    </script>
  ";
  }


  if (isset($_GET["insertAbs"]) && $_GET["insertAbs"] == "true") {
    echo "
    <script>
    iziToast.success({
      title: 'Insirer l`absence',
      message: 'l`absence bien insere',
      position:'topRight',
      maxWidth:'400px',
      progressBarColor: 'grey',
      transitionIn: 'fadeInLeft',
      transitionOut: 'fadeOutRight'
  });      
    </script>
  ";
  }

?>

</body>

</html>
<?php
  } else {
  header("location:authentication.php");
  exit();
  }
?>