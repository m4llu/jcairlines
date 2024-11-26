<?php
include 'db_connection.php'; // Ensure this points to the correct file

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch unique cities from the departure and destination columns
    $sql = "
        SELECT DISTINCT LähtöKaupunki AS city_name FROM lennot
        UNION
        SELECT DISTINCT KohdeKaupunki AS city_name FROM lennot
        ORDER BY city_name ASC;
    ";
    $stmt = $pdo->query($sql);
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return cities as JSON
    header('Content-Type: application/json');
    echo json_encode($cities);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}
?>
