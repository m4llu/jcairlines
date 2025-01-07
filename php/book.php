<?php
// Include the database connection
include 'db_connection.php';

// Initialize variables
$error = '';
$flight = null;
$flight_id = $_POST['selectedFlightId'] ?? null;
$flight_class = $_POST['selectedFlightClass'] ?? null;

// Check if flight details are passed (on page load)
if ($flight_id && $flight_class) {
  $sql = "
  SELECT 
      LentoID AS id, 
      LähtöKaupunki AS departure, 
      KohdeKaupunki AS destination, 
      LentoPäivämäärä AS flight_date, 
      Aikaväli AS time_of_day, 
      Kone AS plane, 
      LipunHinta AS price, 
      VapaatPaikat AS available_seats
  FROM lennot
  WHERE LentoID = '$flight_id'
";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $flight = $result->fetch_assoc();
    } else {
        $error = "Lentoa ei löytynyt."; // Flight not found
    }
} else {
    $error = "Virheelliset tiedot. Lentotiedot puuttuvat."; // Flight details missing
}

// If form is submitted to confirm booking, validate customer info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_name'], $_POST['customer_email'], $_POST['customer_phone'], $_POST['ticket_quantity'])) {
    // Get customer data from form submission
    $customer_name = $_POST['customer_name'] ?? '';
    $customer_email = $_POST['customer_email'] ?? '';
    $customer_phone = $_POST['customer_phone'] ?? '';
    $ticket_quantity = intval($_POST['ticket_quantity'] ?? 0);

    // Check if customer info is complete
    if (!$customer_name || !$customer_email || !$customer_phone || !$ticket_quantity) {
        $error = "Virheelliset tiedot. Kaikki kentät ovat pakollisia."; // All fields are required
    }

    if (!$error) {
        // Encrypt email address
        $encrypted_email = password_hash($customer_email, PASSWORD_BCRYPT);

        if ($flight['available_seats'] >= $ticket_quantity) {
            // Reduce the available seats
            $updateSeatsSql = "
                UPDATE lennot 
                SET VapaatPaikat = VapaatPaikat - $ticket_quantity 
                WHERE LentoID = '$flight_id'
            ";
            if ($conn->query($updateSeatsSql) === TRUE) {
            // Insert booking into tilaukset table
            $insertBookingSql = "
                INSERT INTO tilaukset (LentoID, AsiakasNimi, AsiakasEmail, PaikkojenMaara, TilausPäivämäärä, MaksuTila)
                VALUES ('$flight_id', '$customer_name', '$encrypted_email', '$ticket_quantity', NOW(), 'Ei maksettu')
            ";
                // Generate email content (example, not sent)
                $emailContent = "
                <h2>Kiitos varauksestasi!</h2>
                <p><strong>Lentotiedot:</strong></p>
                <ul>
                    <li><strong>Kohde:</strong> {$flight['destination']}</li>
                    <li><strong>Päivämäärä:</strong> {$flight['flight_date']}</li>
                    <li><strong>Aika:</strong> {$flight['time_of_day']}</li>
                    <li><strong>Liput:</strong> $ticket_quantity</li>
                    <li><strong>Kokonaishinta:</strong> " . ($flight['price'] * $ticket_quantity) . " €</li>
                </ul>
                <p>Pidä tämä sähköposti tallessa varauksesi vahvistukseksi.</p>
            ";
            // mail($customer_email, "Varausvahvistus", $emailContent, "Content-Type: text/html; charset=UTF-8");
            echo "<div class='success-message'>";
            echo "<p>Varaus onnistui!</p>";
            echo "<div class='email-content'>" . $emailContent . "</div>";
            echo "<button class=\"primary metal\"><a href='../index.php' class='button back-home'>Palaa etusivulle</a></button>";
            echo "</div>";
            } else {
                $error = "Varaus epäonnistui: " . $conn->error;
            }
        } else {
            $error = "Paikkoja ei ole riittävästi tai tapahtui virhe: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fi">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="JC Airlines - Etsi lentoja">
    <meta name="keywords" content="JC Airlines, Lento, Matka, Halvat, Lennot">
    <meta name="author" content="JC Airlines">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="7 days">

    <title>JC Airlines - Varaa</title>
    <link rel="icon" href="favicon.svg" sizes="any" type="image/svg+xml">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/popups.css">
    <!-- AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@3.0.0-beta.4/dist/aos.js"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>
<body>
    <main id="book">
        <div class="booking-container">
          <div>
          <?php if ($error): ?>
            <div style="display: grid; place-items: center; height: 100vh;">
                <div style="text-align: center; display: flex; flex-direction: column; align-items: center; gap: 1rem;">
                    <p style="color: #DC3861; font-weight: bold;"><?php echo htmlspecialchars($error); ?></p>
                    <button class="primary metal"><a href="javascript:history.back()" style="text-decoration: none; color: #FFF;">Palaa takaisin</a> </button>
                </div>
            </div>
            <?php elseif ($flight): ?>
                <h2>Varaa Lento</h2>
                <div class="flight-details">
                    <p class="aircraft-name"><?php echo htmlspecialchars($flight['plane']); ?></p>
                    <p><strong>Lähtö:</strong> <?php echo htmlspecialchars($flight['departure']); ?></p>
                    <p><strong>Kohde:</strong> <?php echo htmlspecialchars($flight['destination']); ?></p>
                    <p><strong>Päivämäärä:</strong> <?php echo htmlspecialchars($flight['flight_date']); ?></p>
                    <p><strong>Aika:</strong> <?php echo htmlspecialchars($flight['time_of_day']); ?></p>
                    <p><strong>Hinta:</strong> <?php echo htmlspecialchars($flight['price']); ?> €</p>
                    <p><strong>Vapaat Paikat:</strong> <?php echo htmlspecialchars($flight['available_seats']); ?></p>
                </div>
            </div>
                <form action="book.php" method="post">
                    <input type="hidden" name="selectedFlightId" value="<?php echo htmlspecialchars($flight['id']); ?>">
                    <input type="hidden" name="selectedFlightClass" value="<?php echo htmlspecialchars($flight_class); ?>">

                    <label for="customer_name">Nimi:</label>
                    <input type="text" name="customer_name" id="customer_name" required>

                    <label for="customer_email">Sähköposti:</label>
                    <input type="email" name="customer_email" id="customer_email" required>

                    <label for="customer_phone">Puhelin:</label>
                    <input type="text" name="customer_phone" id="customer_phone" required>

                    <label for="ticket_quantity">Lippujen määrä:</label>
                    <input type="number" name="ticket_quantity" id="ticket_quantity" min="1" required>

                    <button type="submit" class="primary metal">Vahvista varaus</button>
                </form>
            <?php endif; ?>
        </div>
        <div class="planebanner">
            <img src="../assets/wing-background.webp" alt="Lentokone" class="airplane">
        </div>
    </main>
</body>

</html>
