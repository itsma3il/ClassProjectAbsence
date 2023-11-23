<?php
      include('sideBar.php');
      include('session.php');
      include("searchlink.php")
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
  <link rel="stylesheet" href="../assets/css/profileStagiaire.css">
  <link rel="stylesheet" href="../assets/css/calender.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/popup.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <?php include('sideBarDATA.php') ?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="d-none d-md-none d-lg-block">
              <!-- Search Bar for Header -->
              <form action="#">
                <div class="input-group ">
                  <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                  <span class="input-group-append">
                    <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                      </svg>
                    </button>
                  </span>
                </div>
              </form>
            </ul>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="./authentication-login.html" class="btn btn-primary">sign out</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="profile.html">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  body -->
        <!-- Liste Stagiaires Supprimée -->
        <h1 class="card-title fs-8 fw-bold  text-dark my-4">
          Liste des Stagiaires Supprimée:
        </h1>
        <!-- Search Bar for Stagiaires Supprimée -->
        
        <form action="#">
          <div class="input-group my-3 position-relative">
              <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
            <span class="input-group-append">
              <div class="position-absolute top-0 end-0 w-auto text-end ">
                <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                  </svg>
                </button>
              </div>
            </span>
          </div>
        </form>
        <div class="card-body">
          <!-- table -->
            <div class="table-responsive rounded border border-light shadow-sm">
              <table class="table table-hover">
                <thead class="bg-gray-2 table-light text-left">
                  <tr>
                    <th class="min-width-220 py-3 px-4 font-weight-medium">
                      CIN
                    </th>
                    <th class="min-width-150 py-3 px-4 font-weight-medium">
                      Stagiaires
                    </th>
                    <th class="min-width-120 py-3 px-4 font-weight-medium">
                      Date Supprimée
                    </th>
                    <th class="min-width-120 py-3 px-4 font-weight-medium">
                      Raison
                    </th>
                    <th class="min-width-120 py-3 px-4 font-weight-medium">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">EEE123123</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Nome Prenom 1</span>
                      <br>
                      <span class="text-grey">ID110</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Jan 13,2023</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Abandonner</span>
                    </td>
                    <td class="border-bottom py-3 px-4">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-link text-primary">
                          <!-- restore -->
                          <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                            
                            <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                            32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                            192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                            495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                            53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                            0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">EEE123123</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Nome Prenom 1</span>
                      <br>
                      <span class="text-grey">ID110</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Jan 13,2023</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Abandonner</span>
                    </td>
                    <td class="border-bottom py-3 px-4">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-link text-primary">
                          <!-- restore -->
                          <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                            
                            <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                            32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                            192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                            495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                            53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                            0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">EEE123123</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Nome Prenom 1</span>
                      <br>
                      <span class="text-grey">ID110</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Jan 13,2023</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Abandonner</span>
                    </td>
                    <td class="border-bottom py-3 px-4">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-link text-primary">
                          <!-- restore -->
                          <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                            
                            <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                            32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                            192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                            495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                            53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                            0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">EEE123123</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Nome Prenom 1</span>
                      <br>
                      <span class="text-grey">ID110</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Jan 13,2023</span>
                    </td>
                    <td class="border-bottom fw-bold py-3 px-4">
                      <span class="text-dark">Abandonner</span>
                    </td>
                    <td class="border-bottom py-3 px-4">
                      <div class="d-flex align-items-center">
                        <button class="btn btn-link text-primary">
                          <!-- restore -->
                          <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                            
                            <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                            32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                            192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                            495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                            53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                            0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto rounded-pill my-3" style="background-color: #1e905b;">
          <button class="btn text-light" type="button" onclick="toggle_overlay()">Ajouter Stagiaire</button>
        </div>
            <h1 class="card-title fs-8 fw-bold  text-dark my-4">
              Liste des avertissements Supprimée:
            </h1>
            <!-- Liste Avertissement Supprimée -->
            <div class="row mt-4 ">
              <div class="col-7">
                <div class="card-body">
                  <!-- table -->
                    <div class="table-responsive rounded border border-light shadow-sm">
                      <table class="table table-hover">
                        <thead class="bg-gray-2 table-light text-left">
                          <tr>
                            <th class="min-width-220 py-3 px-4 font-weight-medium">
                              Avertissement
                            </th>
                            <th class="min-width-150 py-3 px-4 font-weight-medium">
                              Stagiaire
                            </th>
                            <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Date Supprimée
                            </th>
                            <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Blame</span>
                              <br>
                              <span class="text-grey">05/10/23</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Nome Prenom 1</span>
                              <br>
                              <span class="text-grey">ID110</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">01/01/2023</span>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- restore -->
                                  <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                                    
                                    <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                                    32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                                    192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                                    495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                                    53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                                    0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Avertissement</span>
                              <br>
                              <span class="text-grey">05/10/23</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Nome Prenom 1</span>
                              <br>
                              <span class="text-grey">ID110</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">11/02/2023</span>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- restore -->
                                  <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                                    
                                    <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                                    32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                                    192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                                    495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                                    53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                                    0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Mise En Garde</span>
                              <br>
                              <span class="text-grey">05/10/23</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Nome Prenom 1</span>
                              <br>
                              <span class="text-grey">ID110</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">05/11/2023</span>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- restore -->
                                  <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                                    
                                    <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                                    32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                                    192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                                    495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                                    53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                                    0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Exclusion 2j</span>
                              <br>
                              <span class="text-grey">05/10/23</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">Nome Prenom 1</span>
                              <br>
                              <span class="text-grey">ID110</span>
                            </td>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">25/11/2023</span>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- restore -->
                                  <svg xmlns="http://www.w3.org/2000/svg" height="1.3em" viewBox="0 0 512 512">
                                    
                                    <path d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9V168c0 13.3 10.7 24 24 24H134.1c21.4 0
                                    32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192
                                    192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2
                                    495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181
                                    53c-13.3 0-24 10.7-24 24V256c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6
                                    0-33.9l-65-65V152c0-13.3-10.7-24-24-24z"/>
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
              <!-- Historique (log) -->
              <div class="col-5">
                <div class="card-body">
                  <!-- table -->
                    <div class="table-responsive rounded border border-light shadow-sm">
                      <table class="table table-hover">
                        <thead class="bg-gray-2 table-light text-left">
                          <tr>
                            <th class="min-width-220 py-3 px-4 font-weight-medium fs-5">
                              Journal d'activités D'utilisateur
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">- Username a crée le profile de Stagiaire: Drai Badre EEE123123 le 14/03/2023 à 10h30.</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">- Username a supprimé le Stagiaire: Drai Badre EEE123123 le 14/03/2023 à 10h30.</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">- Username a restauré le Stagiaire: Drai Badre EEE123123 le 14/03/2023 à 10h30.</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom fw-bold py-3 px-4">
                              <span class="text-dark">- Username a supprimé le Stagiaire: Drai Badre EEE123123 le 14/03/2023 à 10h30.</span>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                </div>
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

<div class="overlay-add-stagiaire" id="overlay-add-stagiaire">
  <div class="overlay-add-stagiaire-content" id="overlay-add-stagiaire-content">
    <form action="" class="layoutAjouter">
        <label>Nom</label>
        :<input type="text" id="nom-overlay">

        <label>Prenom</label>
        :<input type="text" id="prenom-overlay"><br>

        <label>CIN</label>
        :<input type="text" id="cin-overlay">

        <label>Groupe</label>
        :<input type="text" id="groupe-overlay"><br>

        <label>Annee</label>
        :<input type="text" id="annee-overlay">

        <label>DateNaissance</label>
        :<input type="date" id="datenaissance-overlay"><br>

        <label>Note</label>
        :<input type="number" id="note-overlay"><br>
        
        <button class="button-confirm" id="button-confirm" onclick="toggle_overlay()"><svg fill="#fff" height="16px" width="16px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492" xml:space="preserve" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M484.128,104.478l-16.116-16.116c-5.064-5.068-11.816-7.856-19.024-7.856c-7.208,0-13.964,2.788-19.028,7.856 L203.508,314.81L62.024,173.322c-5.064-5.06-11.82-7.852-19.028-7.852c-7.204,0-13.956,2.792-19.024,7.852l-16.12,16.112 C2.784,194.51,0,201.27,0,208.47c0,7.204,2.784,13.96,7.852,19.028l159.744,159.736c0.212,0.3,0.436,0.58,0.696,0.836 l16.12,15.852c5.064,5.048,11.82,7.572,19.084,7.572h0.084c7.212,0,13.968-2.524,19.024-7.572l16.124-15.992 c0.26-0.256,0.48-0.468,0.612-0.684l244.784-244.76C494.624,132.01,494.624,114.966,484.128,104.478z"></path> </g> </g> </g></svg></button>
        <button class="button-cancel" id="button-cancel" onclick="toggle_overlay()"><svg fill="#fff" height="16px" width="16px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492" xml:space="preserve" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052 L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116 c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"></path> </g> </g> </g></svg></button>
    </form>
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
  <script src="../assets/js/calender.js"></script>
  <script src="../assets/js/popup.js"></script>
</body>

</html>