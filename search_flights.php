<?php
// Database connection
$servername = "localhost:3307";  // Host
$username = "root";              // MySQL username (default in XAMPP is 'root')
$password = "";                  // MySQL password (default in XAMPP is empty)
$dbname = "db";              // Database name (replace with your DB name)

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values
$from = $to = $date = $passengers = $time = "";
$flights = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['from'], $_GET['to'], $_GET['date'], $_GET['passengers'], $_GET['time'])) {
    $from = htmlspecialchars($_GET['from']);
    $to = htmlspecialchars($_GET['to']);
    $date = htmlspecialchars($_GET['date']);
    $passengers = htmlspecialchars($_GET['passengers']);
    $time = htmlspecialchars($_GET['time']);

    // Prepare the SQL query based on the user's input
    $sql = "SELECT * FROM lennot WHERE LähtöKaupunki LIKE ? AND KohdeKaupunki LIKE ? AND LentoPäivämäärä = ? AND Aikaväli = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssss", $from, $to, $date, $time);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();

        // Check if any flights match the query
        if ($result->num_rows > 0) {
            // Fetch all flights from the result
            while ($row = $result->fetch_assoc()) {
                $flights[] = $row;
            }
        } else {
            $flights[] = "No flights found for the given search criteria.";
        }
    }
}

?>