<?php
include('./Php/config.php');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $searchTerm = filter_input(INPUT_POST, 'searchTerm');

    if (!empty($searchTerm)) {
        $searchTermsArray = explode(' ', $searchTerm);
        $nom = $searchTermsArray[0] ?? '';
        $prenom = $searchTermsArray[1] ?? '';

        $sql = "SELECT * FROM stagiaire WHERE nom LIKE ? AND prenom LIKE ? OR cin LIKE ? LIMIT 8 ";
        $stmt = $pdo_conn->prepare($sql);

        $searchPatternNom = "%$nom%";
        $searchPatternPrenom = "%$prenom%";
        $searchPatternCin = "%$searchTerm%";
        $stmt->bindParam(1, $searchPatternNom);
        $stmt->bindParam(2, $searchPatternPrenom);
        $stmt->bindParam(3, $searchPatternCin); // Assuming cin is an exact match

        try {
            $stmt->execute();
            $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $numResults = $stmt->rowCount();

            if ($numResults > 0) {
                
                foreach ($searchResults as $result) {
                    $escapedCin = htmlspecialchars($result['cin'], ENT_QUOTES, 'UTF-8');
                    $resultHtml = "<a href='./profileStagiaire.php?cin={$escapedCin}' data-cin='{$escapedCin}'>{$result['nom']} {$result['prenom']} (CIN: {$escapedCin})</a><hr>";
                    echo $resultHtml;
                }
                
            } else {
                echo '<p>No results found.</p>';
            }
        } catch (PDOException $e) {
            echo '<p>Error retrieving search results.</p>';
            error_log('PDOException: ' . $e->getMessage());
        }
    } else {
        echo '<p>Please enter a search term.</p>';
    }
}
?>