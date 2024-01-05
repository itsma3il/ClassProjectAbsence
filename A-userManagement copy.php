
<?php
include('./Php/config.php');
include('./Php/sideBar.php');
include('./Php/session.php');
$usernames = $_SESSION["username"];
$sqlSelect = "SELECT * FROM user";
$stmtSelect = $pdo_conn->prepare($sqlSelect);
$stmtSelect->execute();
$users = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST["ajouter"])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $username = $_POST['username'];
  $password = $_POST['password']; // Hash the password
  $email = $_POST['email'];
  $role = $_POST['role'];
  // Corrected SQL query with proper placeholders
  $sqlInsert = "INSERT INTO user (username, password, Email, Nom, prenom, Role) VALUES (?, ?, ?, ?, ?, ?)";
  $pdo_statement = $pdo_conn->prepare($sqlInsert);
  $pdo_statement->bindParam(1, $username);
  $pdo_statement->bindParam(2, $password);
  $pdo_statement->bindParam(3, $email);
  $pdo_statement->bindParam(4, $nom);
  $pdo_statement->bindParam(5, $prenom);
  $pdo_statement->bindParam(6, $role);
  $pdo_statement->execute();
  header("location:./A-userManagement.php?insert=true");
}
if (isset($_POST["modifier"])) {
    $user_id = $_POST['user_id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'] ;
    $sqlCheckUser = "SELECT * FROM user WHERE id = ?";
    $stmtCheckUser = $pdo_conn->prepare($sqlCheckUser);
    $stmtCheckUser->bindParam(1, $user_id);
    $stmtCheckUser->execute();
    $existingUser = $stmtCheckUser->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        // Update the user information
        $sqlUpdate = "UPDATE user SET username = ?, password = ?, Email = ?, Nom = ?, prenom = ?, Role = ? WHERE id = ?";
        echo $sqlUpdate;
        $pdo_statement = $pdo_conn->prepare($sqlUpdate);
        $pdo_statement->bindParam(1, $username);
        $pdo_statement->bindParam(2, $password);
        $pdo_statement->bindParam(3, $email);
        $pdo_statement->bindParam(4, $nom);
        $pdo_statement->bindParam(5, $prenom);
        $pdo_statement->bindParam(6, $role);
        $pdo_statement->bindParam(7, $user_id);

        if ($pdo_statement->execute()) {
            header("location:./A-userManagement.php?insert1=true");
        }
    } 
}
?>


<!DOCTYPE html>
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
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- SIDEBAR AND NAVBAR -->
    <?php include("SIDE&NAV.php") ?>
      <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8 text-center">Gestion des utilisateurs</h4>
            </div>
          </div>
        </div>
        <div class="container">

          <div class="card mt-3">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8 text-center">Liste des utilisateurs</h4>
                </div>
              </div>
            </div>
            <div class="card-body shadow-sm mt-3 bg-body rounded">
              <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                  <thead class="bg-light">
                    <tr class="align-middle">
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Email</th>
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Nom</th>
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Prenom</th>
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Username</th>
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Password</th>
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Role</th>
                      <th scope="col" class="min-width-220 py-3 px-4 font-weight-medium">Action</th>
                    </tr>
                  </thead>
                  <tbody style="max-height: 300px; overflow-y: auto;">
                    <?php foreach ($users as $user) : ?>
                      <tr class="align-middle">
                        <td><?php echo $user['Email'] ?></td>
                        <td><?php echo $user['Nom'] ?></td>
                        <td><?php echo $user['prenom'] ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['password'] ?></td>
                        <td><?php echo $user['Role'] ?></td>
                        <td class="align-middle">
                          <div class="d-flex justify-content-between">
                            <div><a href="./Php/deleteuser.php?id=<?php echo $user['id']; ?>" class="button delt" onclick="confirmDelete()">Supprimer</a></div>
                            <div>
                              <a href="A-userManagement.php?idm=<?php echo $user['id']; ?>" onclick="openPopup()"  name="m" class="button Submit">Modifier</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="card mt-3">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8 text-center">L'ajout d'un utilisateur</h4>
                </div>
              </div>
            </div>
            <div class="card-body shadow-sm mt-3 bg-body rounded">
              <!-- Add your form here -->
              <form action="A-userManagement.php" method="post">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                  </div>
                  <div class="col-md-6">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select form-control" id="role" name="role" required>
                      <option value="surveillant" class="bg-danger text-white">surveillant</option>
                      <option value="admin" class="bg-danger text-white">Admin</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" name="ajouter" onclick="addStagiaire()" class="button Submit">Ajouter</button>
                </div>

              </form>
            </div>
          </div>
          <div class="card mt-3" id="popup">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                <?php
                  if (isset($_GET['idm'])) {
                    $userId = $_GET['idm'];
                    $sqlSelectUser = "SELECT * FROM user WHERE id = ?";
                    $stmtSelectUser = $pdo_conn->prepare($sqlSelectUser);
                    $stmtSelectUser->bindParam(1, $userId);
                    $stmtSelectUser->execute();
                    $selectedUser = $stmtSelectUser->fetch(PDO::FETCH_ASSOC);
                    $nom1 = $selectedUser['Nom'];
                    $prenom1 = $selectedUser['prenom'];
                    $username1 = $selectedUser['username'];
                    $password1 = $selectedUser['password'];
                    $email1 = $selectedUser['Email'];
                    $role1 = $selectedUser['Role'];
                    $id1 = $selectedUser['id'];
                  ?>
                  <h4 class="fw-semibold mb-8 text-center">Modification d'utilisateur <?php echo $id1; ?></h4>
                </div>
              </div>
            </div>
            <div class="card-body shadow-sm mt-3 bg-body rounded" >>
              <form action="A-userManagement.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $id1; ?>">

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom1; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom1; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username1; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" value="<?php echo $password1; ?>" id="password" name="password" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email1; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select form-control" id="role" name="role" required>
                      <option value="surveillant" <?php echo ($role1 === 'surveillant') ? 'selected' : ''; ?>>Surveillant</option>
                      <option value="admin" <?php echo ($role1 === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                  <input type="submit" class="btn btn-success text-dark" name="modifier" value="Modifier">
                </div>
            
              </form>
            <?php } ?>

            </div>
          </div>
          <?php include('scripts.php') ?>
        <?php
        if (isset($_GET["insert"]) && $_GET["insert"] == "true") {
          echo "
            <script>
            iziToast.success({
              title: 'Lutilisateur Ajouter avec success',
              message: '',
              position:'topRight',
              maxWidth:'400px',
              progressBarColor: 'grey',
              transitionIn: 'fadeInLeft',
              transitionOut: 'fadeOutRight',
          });      
            </script>
        ";
            }
            if (isset($_GET["insert1"]) && $_GET["insert1"] == "true") {
              echo "
            <script>
            iziToast.success({
              title: 'Lutilisateur Modifier avec success',
              message: '',
              position:'topRight',
              maxWidth:'400px',
              progressBarColor: 'grey',
              transitionIn: 'fadeInLeft',
              transitionOut: 'fadeOutRight',
          });      
            </script>
        ";
            }
            if (isset($_GET["insert2"]) && $_GET["insert2"] == "true") {
              echo "
            <script>
            iziToast.error({
              title: 'Lutilisateur supprimee avec success',
              message: '',
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
          <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Copyright By <a href="#" target="_blank" class="pe-1 text-primary text-decoration-underline">WFS205</a> 2023</p>
          </div>
        </div>
        <!-- Make sure to replace the placeholder URLs with correct ones -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="./assets/js/getGroups.js"></script>
        <script src="./assets/js/popup.js"></script>
        <script>
          function confirmDelete() {
            // Display a confirmation dialog
            var isConfirmed = confirm("Are you sure you want to delete this user?");

            // Check if the user confirmed
            if (isConfirmed) {
              window.location.href = "./profileuser.php?delete=true";
            }
          }
          var popup = document.getElementById('popup');
    var overlay = document.getElementById('overlay');

    function openPopup() {
        popup.style.display = 'block';
        overlay.style.display = 'block';
    }

    function closePopup() {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    }
    overlay.addEventListener('click', closePopup);
        

</script>
</body>

</html>