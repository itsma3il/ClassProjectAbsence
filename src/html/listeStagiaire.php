<?php
    include('sideBar.php');
    include('session.php');
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
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><b>Menu</b></span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="btn btn-toggle nav-small-cap ">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><b>Liste Stagiaires</b></span>
            </li>
            
            <li class="sidebar-item">
                <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#year1-collapse" aria-expanded="false">
                  <a class="btn sidebar-link" aria-expanded="false">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                        <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z"/>
                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z"/>
                      </svg>
                    </span>
                    <span class="hide-menu" >1ere annee</span><i class="dropdown-toggle"></i>
                  </a>
                </li>

                <div class="collapse" id="year1-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small filieres-adjst">

                    <li class="nav-small-cap">
                      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                      <span class="hide-menu"><b>Filieres</b></span>
                    </li>
                    
                    <li class="sidebar-item">
                      <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dd-filieres-collapse" aria-expanded="false">
                        <a class="btn sidebar-link" aria-expanded="false">
                          <span class="hide-menu">Developement digital</span>
                          <span><i class="dropdown-toggle"></i></span>
                        </a>
                      </li>
      
                      <div class="collapse" id="dd-filieres-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                          <li>
                            <ul class="filiere-classes">
                            <?php foreach ($devGroups as $group) : ?>
                                <li><a href="./listeStagiaire.php?groupe=<?php echo $group ?>"><?= $group ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                          </li>
                          
                        </ul>
                      </div>
                    </li>

                    <li class="sidebar-item">
                      <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#id-filieres-collapse" aria-expanded="false">
                        <a class="btn sidebar-link" aria-expanded="false">
                          <span class="hide-menu">Infrastructure digital</span><i class="dropdown-toggle"></i>
                        </a>
                      </li>
      
                      <div class="collapse" id="id-filieres-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                          
                          <li>
                            <ul class="filiere-classes">
                            <?php foreach ($idGroups as $group) : ?>
                                <li><a href="./listeStagiaire.php?groupe=<?php echo $group ?>"><?= $group ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                          </li>
                          
                        </ul>
                      </div>
                    </li>

                  </ul>
                </div>
              </li>

              <li class="sidebar-item">
                <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#year2-collapse" aria-expanded="false">
                  <a class="btn sidebar-link" aria-expanded="false">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-sidebar-reverse" viewBox="0 0 16 16">
                        <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z"/>
                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z"/>
                      </svg>
                    </span>
                    <span class="hide-menu">2eme annee</span><i class="dropdown-toggle"></i>
                  </a>
                </li>

                <div class="collapse" id="year2-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small filieres-adjst">

                    <li class="nav-small-cap">
                      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                      <span class="hide-menu">Filieres</span>
                    </li>
                    
                    <li class="sidebar-item">
                      <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#wfs-filieres-collapse" aria-expanded="false">
                        <a class="btn sidebar-link" aria-expanded="false">
                          <span class="hide-menu">Web Full Stack</span><i class="dropdown-toggle"></i>
                        </a>
                      </li>
      
                      <div class="collapse" id="wfs-filieres-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                          
                          <li>
                            <ul class="filiere-classes">
                            <?php foreach ($wfsGroups as $group) : ?>
                                <li><a href="./listeStagiaire.php?groupe=<?php echo $group ?>"><?= $group ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                          </li>
                          
                        </ul>
                      </div>
                    </li>

                    <li class="sidebar-item">
                      <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#am-filieres-collapse" aria-expanded="false">
                        <a class="btn sidebar-link" aria-expanded="false">
                          <span class="hide-menu">Application Mobile</span><i class="dropdown-toggle"></i>
                        </a>
                      </li>
      
                      <div class="collapse" id="am-filieres-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                          
                          <li>
                            <ul class="filiere-classes">
                            <?php foreach ($amGroups as $group) : ?>
                                <li><a href="./listeStagiaire.php?groupe=<?php echo $group ?>"><?= $group ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                          </li>
                          
                        </ul>
                      </div>
                    </li>

                  </ul>
                </div>
              </li>
          </ul>
          
        </nav>
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
              <!-- Form -->
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
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
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
        <div class="card-body shadow-sm p-3 mb-5 bg-body rounded">
            <h5 class="card-title fw-semibold mb-4"><div class="d-flex p-4 justify-content-between">
              <h2 class="card-title text-dark">Liste Des Stagiaire</h2>
              <h2 class="card-title text-dark">Dev105</h2>
              <h2 class="card-title text-dark">nombres stagiaires 24</h2>
            </div></h5>
            <!-- <div  style="height: calc(100vh - 250px); width: 100%;"> -->
                
                <form action="#">
                    <table class="table">
                      <thead class="bg-gray-2 text-left">
                        <tr class="">
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">CIN</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Nom</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Prenom</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Date Absence</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Nombre Heures</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Justification</th>
                          <th scope="min-width-220 py-3 px-4 font-weight-medium">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="font-weight-bold">
                          <th scope="row">1</th>
                          <td>EE65652</td>
                          <td>drai</td>
                          <td><input type="date"id="datepicker" class="datepicker p-2 bg-light rounded border-0"></td>      
                          <td><input min="0" type="number" id="typeNumber"  class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td><input min="0" type="text" id="typetext" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td>
                            <button type="button" id="submit" class="btn btn-primary btn-sm" disabled>submit</button>
                            <a href="./profileStagiaire.html" class="btn btn-success btn-sm ms-1 p-1">profile</a>
                          </td>
                        </tr>
                        <tr class="font-weight-bold">
                          <th scope="row">1</th>
                          <td>EE65652</td>
                          <td>drai</td>
                          <td><input type="date"id="datepicker" class="datepicker p-2 bg-light rounded border-0"></td>      
                          <td><input min="0" type="number" id="typeNumber" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td><input min="0" type="text" id="typetext" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td>
                              <button type="button" id="submit" class="btn btn-primary btn-sm" disabled>submit</button>
                              <a href="./profileStagiaire.html" class="btn btn-success btn-sm ms-1 p-1">profile</a>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td>EE65652</td>
                          <td>drai</td>
                          <td><input type="date"id="datepicker" class="datepicker p-2 bg-light rounded border-0"></td>      
                          <td><input min="0" type="number" id="typeNumber" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td><input min="0" type="text" id="typetext" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td>
                              <button type="button" id="submit" class="btn btn-primary btn-sm" disabled>submit</button>
                              <a href="./profileStagiaire.html" class="btn btn-success btn-sm ms-1 p-1">profile</a>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td>EE65652</td>
                          <td>drai</td>
                          <td><input type="date"id="datepicker" class="datepicker p-2 bg-light rounded border-0"></td>      
                          <td><input min="0" type="number" id="typeNumber" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td><input min="0" type="text" id="typetext" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td>
                              <button type="button" id="submit" class="btn btn-primary btn-sm"  disabled>submit</button>
                              <a href="./profileStagiaire.html" class="btn btn-success btn-sm ms-1 p-1">profile</a>
                          </td>
                        </tr>
                        <tr>
                          <th scope="row">1</th>
                          <td>EE65652</td>
                          <td>drai</td>
                          <td><input type="date"id="datepicker" class="datepicker p-2 bg-light rounded border-0"></td>      
                          <td><input min="0" type="number" id="typeNumber" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td><input min="0" type="text" id="typetext" class="bg-light p-1 rounded border-0 enable" disabled/></td>
                          <td>
                              <button type="button" id="submit" class="btn btn-primary btn-sm" disabled>submit</button>
                              <a href="./profileStagiaire.html" class="btn btn-success btn-sm ms-1 p-1">profile</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </form>
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
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/listeStagiaires.js"></script>
</body>

</html>