<?php
// Paths updated
// Include your database connection configuration
include('./Php/config.php');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Validate and sanitize user input
    $searchTerm = filter_input(INPUT_POST, 'searchTerm');

    if (!empty($searchTerm)) {
        $searchTermsArray = explode(' ', $searchTerm);
        $nom = $searchTermsArray[0] ?? '';
        $prenom = $searchTermsArray[1] ?? '';

        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT * FROM stagiaire WHERE (nom LIKE ? AND prenom LIKE ?) OR cin LIKE ? LIMIT 8 ";
        $stmt = $pdo_conn->prepare($sql);

        // Bind parameters
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

            // Output search results or "No results found."
            if ($numResults > 0) {
                
                foreach ($searchResults as $result) {
                    // Use htmlspecialchars to prevent XSS attacks
                    $escapedCin = htmlspecialchars($result['cin'], ENT_QUOTES, 'UTF-8');
                    echo "<a href='./profileStagiaire.php?cin={$escapedCin}' data-cin='{$escapedCin}'>{$result['nom']} {$result['prenom']} (CIN: {$escapedCin})</a><hr>";
                }
                
            } else {
                echo '<p>No results found.</p>';
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo '<p>Error retrieving search results.</p>';
            error_log('PDOException: ' . $e->getMessage());
        }
    } else {
        echo '<p>Please enter a search term.</p>';
    }
}
?>