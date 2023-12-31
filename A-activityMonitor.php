<?php
// Paths updated
include('./Php/sideBar.php');
include('./Php/session.php');

$user = $_SESSION["username"];

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
    <div class="container-fluid d-flex flex-column gap-3">
      <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
          <div class="row align-items-center">
            <div class="col-9">
              <h4 class="fw-semibold mb-8">Surveillance d'Activité</h4>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="./index.php">Accueil</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">Surveillance d'Activité</li>
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
        <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4 active" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
              <i class="ti ti-user-circle me-2 fs-6"></i>
              <span class="d-none d-md-block">Mes Activités</span>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false" tabindex="-1">
              <i class="ti ti-bell me-2 fs-6"></i>
              <span class="d-none d-md-block">Activités des Autres Utilisateurs</span>
            </button>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-pane fade active show" id="pills-account" aria-labelledby="pills-account-tab" tabindex="1">
            <!-- SG activity -->
            <?php include('./Php/SG_Activity.php'); 
            ?>
          </div>
          <div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="2">
            <!-- Search Bar for activity -->
            <form action="#">
              <div class="input-group  position-relative mb-4">
                <input class="form-control rounded-3" type="text" value="" id="searchInput1" oninput="searchTable()" placeholder="Rechercher">
                <span class="input-group-append">
                  <div class="position-absolute top-0 end-0 w-auto text-end ">
                    <button class="btn ms-n10 rounded-0 rounded-end" type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                      </svg>
                    </button>
                  </div>
                </span>
              </div>
            </form>
            <!-- Admin activity -->
            <?php include('./Php/Admin_Activity.php') ?>
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
  <?php

  if (isset($_SESSION['import_error'])) {
    echo "<script>alert('" . $_SESSION['import_error'] . "');</script>";

    // Clear the session variable
    unset($_SESSION['import_error']);
  }
  ?>

  <script>
    function searchTable2() {
      var input, filter, table, tbody, tr, td, i, j, txtValue;
      input = document.getElementById('searchInput1');
      filter = input.value.trim().toUpperCase();
      table = document.getElementById('dataTable');
      tbody = table.querySelector('tbody');
      tr = tbody.getElementsByTagName('tr');
      var noResultsRow = document.getElementById('noResultsRow');

      if (!noResultsRow) {
        // Create a new row for displaying no results
        noResultsRow = tbody.insertRow();
        noResultsRow.id = 'noResultsRow';

        var cell = noResultsRow.insertCell();
        cell.colSpan = table.rows[0].cells.length; // Span the entire row
        cell.textContent = 'Aucun résultat correspondant trouvé.';

      }

      var showNoResults = true; // Assume no results initially

      for (i = 0; i < tr.length; i++) {
        let rowDisplay = 'none';

        for (j = 0; j < tr[i].getElementsByTagName('td').length; j++) {
          td = tr[i].getElementsByTagName('td')[j];

          if (td) {
            txtValue = td.textContent || td.innerText;

            if (txtValue.trim().toUpperCase().includes(filter)) {
              rowDisplay = '';
              showNoResults = false; // There is at least one result
              break;
            }
          }
        }

        tr[i].style.display = rowDisplay;
      }

      // Toggle visibility of the no results row
      noResultsRow.style.display = showNoResults ? '' : 'none';
    }
  </script>


</body>

</html>