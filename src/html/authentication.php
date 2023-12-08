<?php
session_start();

include('./Php/config.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $Password = $_POST["Password"];
    $_SESSION["username"] = $username;
    $error = "";

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
      } else {
        $error = "Invalid login credentials.";
      }
    } else {
      $error = "Both username and password are required.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <title>Authentification</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap">

  <link rel="stylesheet" href="../assets/css/authentification.css" />
  <style>
    * {
      font-family: "Plus Jakarta Sans", "Poppins", sans-serif;
    }
    .error-message {
        width: 320px;
        padding: 12px;
        background: #FCE8DB;
        border-radius: 8px;
        border: 1px solid #EF665B;
        box-shadow: 0px 0px 5px -3px #111;
    }
    .error__title {
      font-weight: 500;
      font-size: 14px;
      color: #71192F;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="./authentication.php" method="post" class="sign-in-form">

          <h2 class="title">Sign in</h2>
          <!-- Display errors here -->
          <?php
          if (!empty($error)) {
            echo '<div class="error-message">';
            echo '<div class="error__title">'.$error.'</div>';
            echo '</div>';
          }
          ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" placeholder="Username" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="exampleInputPassword1" name="Password" placeholder="Password" />
          </div>
          <input type="submit" name="submit" value="Login" class="btn solid" />
        </form>
        <form action="#" class="sign-up-form">
          <h2 class="title">About us</h2>
          <p class="social-text">Bienvenue sur notre plateforme de Système de Gestion d'Absence pour ISTA NTIC SYBA,
            nous simplifions la gestion des absences pour créer un environnement d'apprentissage optimal.
            Notre solution offre un suivi précis, des notifications automatisées, des rapports personnalisés,
            et s'intègre facilement aux systèmes existants. Engagés envers l'excellence éducative,
            notre équipe est là pour répondre à vos besoins.</p>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <img src="./../assets/images/logos/dark-logo.png" class="image" alt="">
          <p>
            Systeme De Gestion D'Absence
          </p>
          <button class="btn transparent" id="sign-up-btn">
            About us
          </button>
        </div>
        <img src="./../assets/images/logos//register.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <img src="./../assets/images/logos/dark-logo.png" class="image" alt="">
          <p>
            Systeme De Gestion D'Absence
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="./../assets/images/logos//log.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="../assets/js/authentification.js"></script>
</body>

</html>