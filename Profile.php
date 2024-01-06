<?php
// Paths updated
include('./Php/sideBar.php');
include('./Php/session.php');
$user = $_SESSION['username'];
if (isset($_POST['change_password'])) {
  $user = $_SESSION['username'];
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];
  
  $sql = "SELECT * FROM user WHERE username = ?";
  $stmt = $pdo_conn->prepare($sql);
  $stmt->bindParam(1, $user);
  $stmt->execute();
  $info = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($current_password == $info['password']) {
      if ($new_password == $confirm_password) {
          $update_sql = "UPDATE user SET password = ? WHERE username = ?";
          $update_stmt = $pdo_conn->prepare($update_sql);
          $update_stmt->bindParam(1, $new_password);
          $update_stmt->bindParam(2, $user);
          $update_stmt->execute();

          echo "<script>alert('Password changed successfully!')</script>";
      } else {
          echo "<script>alert('New password and confirm password do not match')</script>";
      }
  } else {
      echo "<script>alert('Current password does not match')</script>";
  }
}

if (isset($_POST['update_profile'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $username = $_POST['username'];
  $email = $_POST['email'];

  $user = $_SESSION['username'];

  $sql = "UPDATE user SET nom = ?, prenom = ?, username = ?, email = ? WHERE username = ?";
  $stmt = $pdo_conn->prepare($sql);
  $stmt->execute([$nom, $prenom, $username, $email, $user]);

  // Update the session with the new username
  $_SESSION['username'] = $username;
  $_SESSION['Nom'] = $nom;
  $_SESSION['prenom'] = $prenom;
  $_SESSION['email'] = $email;
  

  // Redirect back to the profile page
  header("Location: ./Profile.php");
  exit();
}

if (isset($_POST['change_avatar_color'])) {
  $avatar = $_POST['avatar'];
  
  $sql = "UPDATE user SET avatar = ? WHERE username = ?";
  $stmt = $pdo_conn->prepare($sql);
  $stmt->execute([$avatar, $user]);
  $_SESSION['avatar'] = $avatar;
  
  header("Location: ./Profile.php");
  exit();
}


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

    <div class="container-fluid">

      <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Paramètres du Compte</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="./index.php">Accueil</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">Paramètres du Compte</li>
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

      <div class="card">
        <div class="card-body">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
              <div class="row">
                <div class="col-lg-6 d-flex align-items-stretch">
                  <div class="card w-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <h5 class="card-title fw-semibold">Change Profile</h5>
                      <p class="card-subtitle mb-4">Change your profile color from here</p>
                      <div class="text-center">
                      <form action="./Profile.php" method="post">
                        <div class="avatar-container justify-content-center" class="img-fluid rounded-circle" data-initials="<?php echo extractInitials($_SESSION) ?>" data-width="120px" data-color="<?php echo $_SESSION["avatar"]  ?>"></div>
                        <form action="./Profile.php" method="post">
                        <div class="d-flex align-items-center justify-content-center my-4 px-5">
                          <input type="color" style="width: 150px;" id="avatar" name="avatar" class="form-control cursor-pointer  rounded rounded-pill" name="avatar" value="<?php echo $_SESSION['avatar'] ?>">
                        </div>
                        <p class="mb-0">Choisissez parmi les options de couleur en utilisant la palette ci-dessus.</p>
                        <button type="submit" name="change_avatar_color" class="btn btn-primary mt-3">Save</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col d-flex align-items-stretch">
                  <div class="card w-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <h5 class="card-title fw-semibold">Changer le Mot de Passe</h5>
                      <p class="card-subtitle mb-4">Pour changer votre mot de passe, veuillez confirmer ici.</p>
                      <form action="./Profile.php" method="post">
                          <div class="mb-4">
                              <label for="exampleInputPassword1" class="form-label fw-semibold">Current Password</label>
                              <input type="password" class="form-control" name="current_password" id="exampleInputPassword1" required>
                          </div>
                          <div class="mb-4">
                              <label for="exampleInputPassword2" class="form-label fw-semibold">New Password</label>
                              <input type="password" class="form-control" name="new_password" id="exampleInputPassword2" required>
                          </div>
                          <div class="">
                              <label for="exampleInputPassword3" class="form-label fw-semibold">Confirm Password</label>
                              <input type="password" class="form-control" name="confirm_password" id="exampleInputPassword3" required>
                          </div>
                          <button type="submit" class="btn btn-primary mt-3" name="change_password">Change Password</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                    <div class="card w-100 position-relative overflow-hidden mb-0">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold">Informations Personnelles</h5>
                            <p class="card-subtitle mb-4">Pour modifier vos informations personnelles, éditez et enregistrez à partir d'ici.</p>
                            <form method="post" action="./Profile.php">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="inputNom" class="form-label fw-semibold">Nom</label>
                                            <input type="text" class="form-control" id="inputNom" name="nom" placeholder="Votre nom" value="<?php echo $_SESSION['Nom'] ?>" >
                                        </div>
                                        <div class="mb-4">
                                            <label for="inputPrenom" class="form-label fw-semibold">Prenom</label>
                                            <input type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Votre prenom" value="<?php echo $_SESSION['prenom'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="inputEmail" class="form-label fw-semibold">Email</label>
                                            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="info@exemple.com"value="<?php echo $_SESSION['email'] ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="inputUsername" class="form-label fw-semibold">username</label>
                                            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Votre nom d'utilisateur" value="<?php echo $_SESSION['username'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                            <button type="submit" class="btn btn-primary" name="update_profile">Enregistrer</button>
                                            <button type="reset" class="btn bg-danger-subtle text-danger">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

</body>

</html>