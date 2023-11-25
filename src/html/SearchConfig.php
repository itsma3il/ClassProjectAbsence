<?php
// Include your database connection configuration
include('config.php');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Validate and sanitize user input
    $searchTerm = filter_input(INPUT_POST, 'searchTerm');

    if (!empty($searchTerm)) {
        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT * FROM stagiaire WHERE nom LIKE ? OR prenom LIKE ? OR cin LIKE ?";
        $stmt = $pdo_conn->prepare($sql);

        // Bind parameters
        $searchPattern = "%$searchTerm%";
        $stmt->bindParam(1, $searchPattern);
        $stmt->bindParam(2, $searchPattern);
        $stmt->bindParam(3, $searchPattern); // Assuming cin is an exact match

        try {
            $stmt->execute();
            $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $numResults = $stmt->rowCount();

            // Output search results or "No results found."
            if ($numResults > 0) {
                
                foreach ($searchResults as $result) {
                    // Use htmlspecialchars to prevent XSS attacks
                    $escapedCin = htmlspecialchars($result['cin'], ENT_QUOTES, 'UTF-8');
                    echo "<a href='profileStagiaire.php?cin={$escapedCin}' data-cin='{$escapedCin}'>{$result['nom']} {$result['prenom']} (CIN: {$escapedCin})</a><hr>";
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