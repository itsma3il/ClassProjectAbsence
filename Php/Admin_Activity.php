<?php
$sql = "SELECT * FROM logs ORDER BY `Timestamp` DESC";
$stmt =  $pdo_conn->prepare($sql);
$stmt->execute();
$activites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="table-responsive table-container rounded border border-light shadow-sm" style="max-height:400px;overflow-y: scroll;">
      <table class="table table-hover align-middle" id="dataTable">
            <thead class="bg-gray-2 text-left fixed-thead">
                  <tr>
                        <th class="min-width-220 py-3 px-4 font-weight-medium">
                              User
                        </th>
                        <th class="min-width-150 py-3 px-4 font-weight-medium">
                              Action
                        </th>
                        <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Cin de Stagiaire
                        </th>
                        <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Date
                        </th>
                  </tr>
            </thead>
            <tbody>
                  <?php if (!empty($activites)) : ?>
                        <?php foreach ($activites as $activite) : ?>
                              <tr>
                                    <?php
                                    // remove the @ from the username
                                    $usernameParts = explode('@', $activite['Username']);
                                    $name = isset($usernameParts[0]) ? $usernameParts[0] : $activite['Username'];

                                    $stagiaireCin = $activite['StagiaireCin'];
                                    $StagiaireName = "SELECT nom, prenom FROM stagiaire WHERE cin = ?";
                                    $stmt = $pdo_conn->prepare($StagiaireName);
                                    $stmt->execute([$stagiaireCin]);
                                    $stagiaireInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                                    if (!$stagiaireInfo) {
                                          $DeletedStagiaireName = "SELECT nom, prenom FROM deletedstagiaire WHERE cin = ?";
                                          $stmt = $pdo_conn->prepare($DeletedStagiaireName);
                                          $stmt->execute([$stagiaireCin]);
                                          $deletedStagiaireInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                                          if ($deletedStagiaireInfo) {
                                                $fullName = $deletedStagiaireInfo['nom'] . ' ' . $deletedStagiaireInfo['prenom'];
                                                echo "<td class='border-bottom fw-bold py-3 px-4'>
                                       <span class='text-dark'>$name </span>";
                                                "</td>";

                                                echo "<td class='border-bottom fw-bold py-3 px-4'>
                                      <span class='text-dark'><b>{$activite['Action']}</b> {$fullName} </span>";
                                                "</td>";

                                                echo "<td class='border-bottom fw-bold py-3 px-4'>
                                      <span class='text-dark'> {$stagiaireCin}</span>";
                                                "</td>";

                                                echo "<td class='border-bottom fw-bold py-3 px-4'>
                                      <span class='text-dark'>" . date('Y-m-d', strtotime($activite['Timestamp'])) . " à " . date('H:i:s', strtotime($activite['Timestamp'])) . ".</span>";
                                                "</td>";
                                          }
                                    } else {
                                          $fullName = $stagiaireInfo['nom'] . ' ' . $stagiaireInfo['prenom'];
                                          echo "<td class='border-bottom fw-bold py-3 px-4'>
                                       <span class='text-dark'>$name </span>";
                                          "</td>";

                                          echo "<td class='border-bottom fw-bold py-3 px-4'>
                                      <span class='text-dark'><b>{$activite['Action']}</b> {$fullName} </span>";
                                          "</td>";

                                          echo "<td class='border-bottom fw-bold py-3 px-4'>
                                      <span class='text-dark'> {$stagiaireCin}</span>";
                                          "</td>";

                                          echo "<td class='border-bottom fw-bold py-3 px-4'>
                                      <span class='text-dark'>" . date('Y-m-d', strtotime($activite['Timestamp'])) . " à " . date('H:i:s', strtotime($activite['Timestamp'])) . ".</span>";
                                          "</td>";
                                    }
                                    ?>

                              </tr>
                        <?php endforeach; ?>
                  <?php else : ?>
                        <tr>
                              <td colspan="4">No deleted avertissements available.</td>
                        </tr>
                  <?php endif; ?>
            </tbody>
      </table>
</div>