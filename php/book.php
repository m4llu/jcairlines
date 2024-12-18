<?php
// Include the database connection
include 'db_connection.php';

$flight_id = $_POST['selectedFlightId'] ?? null;
$flight_class = $_POST['selectedFlightClass'] ?? null;
$error = '';
$flight = null;

if ($flight_id && $flight_class) {
  // Fetch the flight details from the database
  $sql = "
    SELECT LentoID AS id, LähtöKaupunki AS departure, KohdeKaupunki AS destination, LentoPäivämäärä AS flight_date, Aikaväli AS time_of_day, Kone AS plane, LipunHinta AS price, VapaatPaikat AS available_seats, Lähtöaika AS time
    FROM lennot 
    WHERE LentoID = '$flight_id'
  ";

  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $flight = $result->fetch_assoc();
  } else {
    $error = "Lentoa ei löytynyt.";
  }
} else {
  $error = "Virheelliset parametrit.";
}
?>

<!DOCTYPE html>
<html lang="fi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="JC Airlines - Varaa lento">
  <meta name="keywords" content="JC Airlines, Lento, Matka, Varaa, Lennot">
  <meta name="author" content="JC Airlines">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="7 days">

  <title>JC Airlines - Varaa Lento</title>
  <link rel="icon" href="../favicon.svg" sizes="any" type="image/svg+xml">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/buttons.css">
  <link rel="stylesheet" href="../css/popups.css">
</head>

<body>
  <main>
    <div class="booking-container">
      <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
      <?php elseif ($flight): ?>
        <h2>Varaa Lento</h2>
        <div class="flight-details">
          <p><strong>Lähtö:</strong> <?php echo htmlspecialchars($flight['departure']); ?></p>
          <p><strong>Kohde:</strong> <?php echo htmlspecialchars($flight['destination']); ?></p>
          <p><strong>Päivämäärä:</strong> <?php echo htmlspecialchars($flight['flight_date']); ?></p>
          <p><strong>Aika:</strong> <?php echo htmlspecialchars($flight['time']); ?></p>
          <p><strong>Kone:</strong> <?php echo htmlspecialchars($flight['plane']); ?></p>
          <p><strong>Hinta:</strong> <?php echo htmlspecialchars($flight['price']); ?> €</p>
          <p><strong>Vapaat Paikat:</strong> <?php echo htmlspecialchars($flight['available_seats']); ?></p>
          <p><strong>Luokka:</strong> <?php echo htmlspecialchars(ucfirst($flight_class)); ?></p>
        </div>
        <form action="confirm_booking.php" method="post">
          <input type="hidden" name="flight_id" value="<?php echo htmlspecialchars($flight['id']); ?>">
          <input type="hidden" name="flight_class" value="<?php echo htmlspecialchars($flight_class); ?>">
          <button class="primary metal" type="submit">Vahvista varaus</button>
        </form>
      <?php endif; ?>
    </div>
  </main>
</body>

</html>