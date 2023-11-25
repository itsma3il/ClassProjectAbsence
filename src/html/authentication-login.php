<?php
session_start();

include('config.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $Password = $_POST["Password"];

        // Check if both username and password are not empty
        if (!empty($username) && !empty($Password)) {
            $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
            $stmt = $pdo_conn->prepare($sql);
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $Password);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify password
            if ($stmt->rowCount() > 0) {
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['username'] = $resultat['username'];
                $_SESSION['pswrd'] = $resultat['pswrd'];

                header("location: ./index.php");
                exit();
            } 
            else {
              echo '<div class="alert alert-danger" style="position: absolute; top: 0; left: 0; width: 100%; text-align: center; margin-bottom: 0;">Invalid login credentials.</div>';
          }
        } 
        else {
          echo '<div class="alert alert-danger" style="position: absolute; top: 0; left: 0; width: 100%; text-align: center; margin-bottom: 0;">Both username and password are required.</div>';
      }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Authentification</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="./../assets/images/logos/dark-logo.png" width="180" alt="">
                </a>
                <p class="text-center">Systeme De Gestion D'Absence</p>
                <form action="./authentication-login.php" method="post">
                <?php if (isset($_POST["submit"]) && isset($_GET['error'])) { ?>
                  <p class="error"><?php echo $_GET['error']; ?>
                <?php } ?>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="Password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary" name="submit" >Sign in</button>
                  </div>
                  <div class="d-flex align-items-center justify-content-center">
                    <!-- <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>