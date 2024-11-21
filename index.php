<?php
// Database connection settings
$servername = "localhost:3307";  // Host
$username = "root";              // MySQL username (default in XAMPP is 'root')
$password = "";                  // MySQL password (default in XAMPP is empty)
$dbname = "db";              // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$from = $to = $date = $passengers = $time = "";
$flights = [];

// Fetch all cities from the database for the 'from' and 'to' fields
$cities = [];
$sql_cities = "SELECT DISTINCT LähtöKaupunki FROM lennot";  // Adjust column name based on your DB structure
$result_cities = $conn->query($sql_cities);

if ($result_cities->num_rows > 0) {
    while ($row = $result_cities->fetch_assoc()) {
        $cities[] = $row['LähtöKaupunki'];  // Adjust field name as per your DB structure
    }
}

// Process form submission
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
            $flights[] = "Ei lentoja löydetty hakuehdoilla.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JC Airlines - Etsi Lentoja</title>
    <link rel="stylesheet" href="style.css">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</head>
<body>
    <div class="banner">
        <img src="sunset-plane.jpg" alt="JC Airlines Banner">
    </div>
    <nav data-aos="fade-down">
        <img src="logo.svg" alt="JC Airlines Logo">
        <ul>
            <li><a href="index.php">Etusivu</a></li>
            <li><a href="search_flights.php">Etsi lentoja</a></li>
            <li><a href="manage_booking.php">Hallitse varauksia</a></li>
        </ul>
    </nav>
    <main>
        <div class="form-container" data-aos="fade-up">
            <form action="index.php" method="GET">
                <!-- From city dropdown -->
                <select name="from" required>
                    <option value="">Mistä?</option>
                    <?php
                    // Populate the cities dynamically
                    foreach ($cities as $city) {
                        echo "<option value=\"$city\" " . ($city == $from ? 'selected' : '') . ">$city</option>";
                    }
                    ?>
                </select>

                <!-- To city dropdown -->
                <select name="to" required>
                    <option value="">Minne?</option>
                    <?php
                    // Populate the cities dynamically
                    foreach ($cities as $city) {
                        echo "<option value=\"$city\" " . ($city == $to ? 'selected' : '') . ">$city</option>";
                    }
                    ?>
                </select>

                <!-- Date input -->
                <input type="date" name="date" value="<?php echo $date; ?>" required>

                <!-- Passengers input -->
                <select name="passengers" required>
                    <option value="1" <?php echo ($passengers == '1' ? 'selected' : ''); ?>>1 Aikuinen</option>
                    <option value="2" <?php echo ($passengers == '2' ? 'selected' : ''); ?>>2 Aikuista</option>
                    <option value="1-child" <?php echo ($passengers == '1-child' ? 'selected' : ''); ?>>1 Aikuinen, 1 Lapsi</option>
                </select>

                <!-- Time of day selection -->
                <select name="time" required>
                    <option value="morning" <?php echo ($time == 'morning' ? 'selected' : ''); ?>>Aamulento</option>
                    <option value="day" <?php echo ($time == 'day' ? 'selected' : ''); ?>>Päivälento</option>
                    <option value="evening" <?php echo ($time == 'evening' ? 'selected' : ''); ?>>Iltalento</option>
                </select>
                
                <button type="submit">Etsi lentoja</button>
            </form>
        </div>

        <!-- Display search results -->
        <?php if (!empty($flights)): ?>
            <section class="search-results" data-aos="fade-up">
                <h2>Hakutulokset</h2>
                <?php if (is_array($flights)): ?>
                    <ul>
                        <?php foreach ($flights as $flight): ?>
                            <li>
                                <p><strong>Lähtöpaikka:</strong> <?php echo $flight['LähtöKaupunki']; ?></p>
                                <p><strong>Kohde:</strong> <?php echo $flight['KohdeKaupunki']; ?></p>
                                <p><strong>Päivämäärä:</strong> <?php echo $flight['LentoPäivämäärä']; ?></p>
                                <p><strong>Aikaväli:</strong> <?php echo $flight['Aikaväli']; ?></p>
                                <p><strong>Lipun hinta:</strong> €<?php echo $flight['LipunHinta']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><?php echo $flights; ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </main>

    <script>
        AOS.init({
            duration: 1000, // Animation duration in ms
            easing: 'ease-in-out', // Easing function
            once: true // Whether animations should happen only once
        });
    </script>
</body>
</html>
