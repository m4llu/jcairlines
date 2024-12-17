<?php
include 'db_connection.php'; // Ensure this points to the correct file

try {
    // Initialize PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch unique cities from both LähtöKaupunki and KohdeKaupunki
    $sql = "
        SELECT DISTINCT LähtöKaupunki AS city_name FROM lennot
        UNION
        SELECT DISTINCT KohdeKaupunki AS city_name FROM lennot
        ORDER BY city_name ASC;
    ";
    $stmt = $pdo->query($sql);

    // Fetch results as an associative array
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set header and return JSON response
    header('Content-Type: application/json');
    echo json_encode($cities);
} catch (PDOException $e) {
    // Handle errors and return them as JSON
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>
