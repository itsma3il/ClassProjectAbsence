<?php
include('./Php/sideBar.php');
include('./Php/session.php');

if (isset($_GET['groupe'])) {
    $groupe = $_GET['groupe'];
    $sql = "SELECT
        s.cin AS StagiaireCin,
        s.nom AS StagiaireNom,
        s.prenom AS StagiairePrenom,
        s.noteDisciplinaire AS noteDisciplinaire,
        COALESCE(SUM(a.nbHeures), 0) AS TotalNbHeures,
        COALESCE(av.nbrAvertis, 0) AS TotalAvertissements
        FROM stagiaire s
        LEFT JOIN absence a ON s.cin = a.StagiaireCin
        LEFT JOIN avertissement av ON s.cin = av.StagiaireCin
        WHERE s.groupe = ? 
        GROUP BY
        s.cin, s.nom, s.prenom, s.noteDisciplinaire, av.nbrAvertis;"; // Include av.nbrAvertis in GROUP BY
    $stmt =  $pdo_conn->prepare($sql);
    $stmt->bindParam(1, $groupe);
    $stmt->execute();
    $stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numStagiaires = $stmt->rowCount();

    if ($stmt->rowCount() > 0) {
        $numStagiaires = $stmt->rowCount();


?>
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Ofppt WFS205</title>
            <?php include('styles.php') ?>

        </head>

        <body>
            <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
                <!-- SIDEBAR AND NAVBAR  -->
                <?php include("SIDE&NAV.php") ?>
                <!--  Main CONTENT -->
                <div class="body-wrapper">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="position-absolute mx-4 d-flex align-content-center justify-content-between  printablediv" style="width: -moz-available;width: -webkit-fill-available;">
                                <h6 class="card-title lh-lg text-dark">Liste Des Stagiaires</h6>
                                <h6 class="card-title lh-lg text-dark"><?php echo $groupe ?></h6>
                                <h6 class="card-title lh-lg text-dark">Nombres Stagiaires: <?php echo $numStagiaires ?></h6>


                                <div class="text-center bg-dark rounded-pill align-self-center d-flex flex-nowrap flex-row gap-0 do-not-print" style="transform: scale(0.9);">
                                    <a style="width: 80px;" class="nav-link p-1 border border-dark border-4 btnInactive rounded-start-pill fw-bold" href="./listeStagiaire.php?<?php echo http_build_query(['groupe' => $groupe]); ?>">
                                        Absence
                                    </a>
                                    <a style="width: 80px;" class="nav-link p-1 border border-dark border-4 btnActive rounded-end-pill fw-bold" href="./listeNotesGroup.php?<?php echo http_build_query(['groupe' => $groupe]); ?>">
                                        Infos
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="card-body shadow-sm mt-5 bg-body rounded ">
                            <div class="table-container">
                                <form action="#">
                                    <table class="table table-hover align-middle printablediv">
                                        <thead class="bg-gray-2 text-left text-center  fixed-thead">
                                            <tr class="align-middle">
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium">CIN</th>
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium">Nom</th>
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium">Prenom</th>
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium">Nombre Absence</th>
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium">Avertissement</th>
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium">Note Disciplinire</th>
                                                <th scope="min-width-220 py-3 px-4 font-weight-medium" class="do-not-print">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="height: 300px; overflow-y: auto;">
                                            <?php foreach ($stagiaires as $stagiaire) : ?>
                                                <tr class="fw-bold text-center align-items-center">
                                                    <th scope="row" name="cin"><?php echo $stagiaire['StagiaireCin'] ?></th>
                                                    <td><?php echo $stagiaire['StagiaireNom'] ?></td>
                                                    <td><?php echo $stagiaire['StagiairePrenom'] ?></td>
                                                    <td><?php echo $stagiaire['TotalNbHeures'] ?> Hr</td>
                                                    <td><?php echo $stagiaire['TotalAvertissements'] ?></td>
                                                    <td><?php echo $stagiaire['noteDisciplinaire'] ?></td>
                                                    <td class="d-flex justify-content-end align-items-center flex-wrap do-not-print" style="width: 100px;">
                                                        <a href="./profileStagiaire.php?<?php echo http_build_query(['cin' => htmlspecialchars($stagiaire['StagiaireCin'], ENT_QUOTES, 'UTF-8')]); ?>" class="button Profile">Profile</a>
                                                        <a onclick="return confirm('Etes vous sur ?');" href="./Php/deletelisteavertissment.php?<?php echo http_build_query(['cin' => htmlspecialchars($stagiaire['StagiaireCin'], ENT_QUOTES, 'UTF-8'), 'groupe' => $groupe]); ?>" class="button delt ">Supprimer</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <span class="ImprimerBtn rounded-circle" onclick="printTable()">
                                <img src="../assets/images/icons/8324243_ui_essential_app_printer_device_icon.svg" width="30" style="filter:invert(1)" alt="Imprimer">
                                <span class="tooltip">Imprimer</span>
                            </span>
                        </div>

                        <!-- footer
            <?php // include('FOOTER.php') 
            ?> -->
                    </div>
                </div>
            </div>

            <?php include('scripts.php') ?>

            <?php
            if (isset($_GET["deleted"]) && $_GET["deleted"] == "true") {
                echo "
        <script>
        iziToast.error({
            title: 'Stagiaire Supprimé',
            message: 'Visitez Votre profil pour restaurer.',
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
        </body>

        </html>
<?php
    } else {
        header("location:authentication.php");
        exit();
    }
} else {
    header("location:authentication.php");
    exit();
} ?>