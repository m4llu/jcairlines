<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JC Airlines</title>
    <link rel="stylesheet" href="style.css">
    <!-- AOS CSS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

</head>
<body>
    <nav data-aos="fade-down">
        <img src="logo.svg" alt="JC Airlines Logo">
        <ul>
            <li><a href="index.php">Etusivu</a></li>
            <li><a href="search_flights.php">Etsi lentoja</a></li>
            <li><a href="manage_booking.php">Hallitse varauksia</a></li>
        </ul>
    </nav>
    <div class="content-wrapper">
        <h1 data-aos="zoom-in">fade right</h1>
        <p data-aos="fade-left">fade left</p>
        <div class="form-container" data-aos="fade-up">
        <form action="search_flights.php" method="GET">
            <input type="text" name="from" placeholder="Mistä?" required>
            <input type="text" name="to" placeholder="Minne?" required>
            <input type="date" name="date" required>
            <select name="passengers" required>
                <option value="1">1 Aikuinen</option>
                <option value="2">2 Aikuista</option>
                <option value="1-child">1 Aikuinen, 1 Lapsi</option>
            </select>
            <select name="time" required>
                <option value="morning">Aamulento</option>
                <option value="day">Päivälento</option>
                <option value="evening">Iltalento</option>
            </select>
            <br>
            <button type="submit">Etsi lentoja</button>
        </form>
    </div>
    </div>
    <?php
$servername = "localhost:3307";  // Host
$username = "root";         // MySQL username (default in XAMPP is 'root')
$password = "";             // MySQL password (default in XAMPP is empty)
$dbname = "db";    // Database name (replace with your DB name)

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

    <script>
    AOS.init({
        duration: 1000, // Animation duration in ms
        easing: 'ease-in-out', // Easing function
        once: true // Whether animations should happen only once
    });
</script>

</body>
</html>
