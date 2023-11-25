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
            <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z" />
            <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z" />
          </svg>
        </span>
        <span class="hide-menu">1ere annee</span>
        <span class="dropdownToggle">
          <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
            <g id="chevron-down 1">
              <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
            </g>
          </svg>
        </span>
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
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
                </g>
              </svg>
            </span>
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
            <span class="hide-menu">Infrastructure digital</span>
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
                </g>
              </svg>
            </span>
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
            <path d="M12.5 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm0 3a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5zm.5 3.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1h5z" />
            <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2zM4 1v14H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h2zm1 0h9a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5V1z" />
          </svg>
        </span>
        <span class="hide-menu">2eme annee</span>
        <span class="dropdownToggle">
          <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
            <g id="chevron-down 1">
              <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z"/>
            </g>
          </svg>
        </span>
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
            <span class="hide-menu">Web Full Stack</span>
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
                </g>
              </svg>
            </span>
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
            <span class="hide-menu">Application Mobile</span>
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
                </g>
              </svg>
            </span>
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

        <li class="sidebar-item">
        <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#sr-filieres-collapse" aria-expanded="false">
          <a class="btn sidebar-link" aria-expanded="false">
            <span class="hide-menu">Reseaux et Systemes</span>
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
                </g>
              </svg>
            </span>
          </a>
        </li>

        <div class="collapse" id="sr-filieres-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

            <li>
              <ul class="filiere-classes">
                <?php foreach ($srGroups as $group) : ?>
                  <li><a href="./listeStagiaire.php?groupe=<?php echo $group ?>"><?= $group ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>

          </ul>
        </div>
        </li>

        <li class="sidebar-item">
        <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#cc-filieres-collapse" aria-expanded="false">
          <a class="btn sidebar-link" aria-expanded="false">
            <span class="hide-menu">Cloud Computing</span>
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z"/>
                </g>
              </svg>
            </span>
          </a>
        </li>

        <div class="collapse" id="cc-filieres-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

            <li>
              <ul class="filiere-classes">
                <?php foreach ($ccGroups as $group) : ?>
                  <li><a href="./listeStagiaire.php?groupe=<?php echo $group ?>"><?= $group ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>

          </ul>
        </div>
        </li>

        <li class="sidebar-item">
        <li class="sidebar-item align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#cs-filieres-collapse" aria-expanded="false">
          <a class="btn sidebar-link" aria-expanded="false">
            <span class="hide-menu">Cyber sécurité</span>
            <span class="dropdownToggle">
              <svg width="21" height="21" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                <g id="chevron-down 1">
                  <path id="Vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd" d="M5.12259 7.64685C5.44802 7.32141 5.97566 7.32141 6.3011 7.64685L10.7118 12.0576L15.1226 7.64685C15.448 7.32141 15.9757 7.32141 16.3011 7.64685C16.6265 7.97229 16.6265 8.49992 16.3011 8.82536L11.3011 13.8254C10.9757 14.1508 10.448 14.1508 10.1226 13.8254L5.12259 8.82536C4.79715 8.49992 4.79715 7.97229 5.12259 7.64685Z" />
                </g>
              </svg>
            </span>
          </a>
        </li>

        <div class="collapse" id="cs-filieres-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

            <li>
              <ul class="filiere-classes">
                <?php foreach ($csGroups as $group) : ?>
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