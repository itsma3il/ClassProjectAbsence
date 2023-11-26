<?php
    include('./Php/config.php');
    include('./Php/session.php');
    include('./Php/sideBar.php');
    

    $sql="SELECT S.nom,S.prenom,S.groupe,S.cin,A.message,A.dateAverti,A.StagiaireCin,S.cin from stagiaire S 
          INNER JOIN avertissement A on S.cin=A.StagiaireCin
          order by dateAverti DESC";
    $stmt=$pdo_conn->prepare($sql);
    $stmt->execute();
    $donnees=$stmt->fetchAll();
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
        <div class="card-body">
          <!-- table -->
          <div class="rounded border border-light bg-white p-3 shadow-sm">
            <h5 class="card-title text-dark mb-4">
              Liste des avertissements
            </h5>
            <div class="table-responsive">
              <table class="table">
                <thead class="bg-gray-2 text-left">
                  <tr>
                    <th class="min-width-220 py-3 px-4 font-weight-medium">
                      Stagiaires
                    </th>
                    <th class="min-width-150 py-3 px-4 font-weight-medium">
                      Date Avertissement
                    </th>
                    <th class="min-width-120 py-3 px-4 font-weight-medium">
                      Status
                    </th>
                    <th class="py-3 px-4 font-weight-medium">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    if($stmt->rowCount()>0){
                      foreach($donnees as $donne){
                       
                    ?>
                  <tr>
                  <td class="border-bottom py-3 px-4 pl-2">
                      <a  href="./profileStagiaire.php?cin=<?php echo $donne['cin'] ?>" style="cursor:pointer">
                        <h5 class="font-weight-medium"><?=$donne["nom"]?> <?=$donne["prenom"]?> </h5>
                      </a>

                      <a  href="./listeStagiaire.php?groupe=<?php echo $donne['groupe'] ?>" style="cursor:pointer">
                        <p class="text-sm"><?=$donne["groupe"]?></p>
                      </a>
                      
                      </td>
                    
                    <td class="border-bottom py-3 px-4">
                      <p><?=$donne["dateAverti"]?></p>
                    </td>
                    <td class="border-bottom py-3 px-4">
                    <p class="py-1 px-3 text-sm font-weight-medium avertissementText">
                      <?=$donne["message"]?>
                      </p>
                    </td>

                    <td class="border-bottom py-3 px-4">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-link text-primary">
                          <!-- view -->
                          <a href="profileStagiaire.php?cin=<?php echo $donne['cin'] ?>"style="cursor:pointer" >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1em"
                            viewBox="0 0 576 512"
                          >
                            <path
                              d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"
                            />
                          </svg>
                          </a>
                        </button>
                        
                        <button class="btn btn-link text-primary">
                          <!-- delete -->
                          <a onclick="return confirm('are you sure')" href="./Php/deletelisteavertissment.php?StagiaireCin=<?php echo $donne['StagiaireCin'] ?>" >
                          <svg   xmlns="http://www.w3.org/2000/svg"
                                 height="1em"
                                 viewBox="0 0 448 512">
                         
                            <path    d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                           
                          </svg>
                          </a>
                        </button>
                     
                      </div>
                    </td>
                  </tr>
                  <?php
                    }
                  }
                  ?>

                </tbody>
              </table>
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
  <script src="../assets/js/dashboard.js"></script>

</body>

</html>