<?php
include 'db_connection.php'; // Connection code

// Capture search parameters
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$departureDate = $_POST['departureDate'];
$returnDate = $_POST['returnDate']; // Optional for one-way
$passengers = $_POST['passengers'];
$time = $_POST['time'];

// Build the SQL query
$sql = "SELECT * FROM lennot 
        WHERE LähtöKaupunki = ? AND KohdeKaupunki = ? AND LentoPäivämäärä = ? AND Aikaväli = ? AND VapaatPaikat >= ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('sssii', $departure, $destination, $departureDate, $time, $passengers);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Display results
if ($result->num_rows > 0) {
    echo "<table border='1'>
          <tr><th>Lähtö</th><th>Kohde</th><th>Päivämäärä</th><th>Aikaväli</th><th>Kone</th><th>Hinta</th><th>Vapaat Paikat</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>{$row['LähtöKaupunki']}</td>
              <td>{$row['KohdeKaupunki']}</td>
              <td>{$row['LentoPäivämäärä']}</td>
              <td>{$row['Aikaväli']}</td>
              <td>{$row['Kone']}</td>
              <td>{$row['LipunHinta']}</td>
              <td>{$row['VapaatPaikat']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No flights found matching your criteria.";
}

$stmt->close();
$conn->close();
?>