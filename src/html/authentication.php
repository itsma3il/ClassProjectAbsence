
<?php
session_start();

include('./Php/config.php');
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $Password = $_POST["Password"];
        $_SESSION["username"] = $username;

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
                echo '<div class="error">
                        <div class="error__icon">
                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z" fill="#393a37"></path></svg>
                        </div>
                        <div class="error__title">Invalid login credentials.</div>
                      </div>';
            }
        } 
        else {
            echo '<div class="error">
                    <div class="error__icon">
                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z" fill="#393a37"></path></svg>
                    </div>
                    <div class="error__title">Both username and password are required.</div>
                  </div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
    <title>Authentification</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/authentification.css" />
    <style>
      .error {
        position: absolute;
        top:100px; /* Adjust as needed */
        left: 63%; /* Center horizontally */
        z-index: 3;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: start;
        width: 320px;
        padding: 12px;
        background: #FCE8DB;
        border-radius: 8px;
        border: 1px solid #EF665B;
        box-shadow: 0px 0px 5px -3px #111;
      }
      .error__icon {
        width: 20px;
        height: 20px;
        transform: translateY(-2px);
        margin-right: 8px;
      }
      .error__icon path {
        fill: #EF665B;
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
          <?php if (isset($_POST["submit"]) && isset($_GET['error'])) { ?>
                  <p class="error"><?php echo $_GET['error']; ?>
            <?php } ?>

            <h2 class="title">Sign in</h2>
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
