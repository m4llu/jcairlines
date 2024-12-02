<?php
// Include the database connection
include 'php/db_connection.php';

$flights = [];
$error = '';
$departure = $destination = $dates = $time = $passengers = ''; // Default values to avoid undefined variable notices

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and validate form inputs
    $departure = $_POST['departure'] ?? null;
    $destination = $_POST['destination'] ?? null;
    $dates = $_POST['dates'] ?? null;
    $time = $_POST['time'] ?? null;
    $passengers = $_POST['passengers'] ?? null; // Passenger data as a string

    if (!$departure || !$destination || !$dates || !$time || !$passengers) {
        $error = "Täytä kaikki kentät.";
    } else {
        // Check if the dates field is valid
        if (!empty($dates) && strpos($dates, ' - ') !== false) {
            list($start_date, $end_date) = explode(' - ', $dates);
        } else {
            $error = "Virheellinen aikaväli.";
        }
    }

    // Query the database if no errors
    if (!$error) {
        $sql = "
            SELECT LähtöKaupunki AS departure, KohdeKaupunki AS destination, LentoPäivämäärä AS flight_date, Aikaväli AS time_of_day, Kone AS plane, LipunHinta AS price, VapaatPaikat AS available_seats 
            FROM lennot 
            WHERE LähtöKaupunki = '$departure'
            AND KohdeKaupunki = '$destination'
            AND LentoPäivämäärä BETWEEN '$start_date' AND '$end_date'
            AND Aikaväli = '$time'
        ";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $flights[] = $row;
            }
        } else {
            $error = "Hakua vastaavia lentoja ei löytynyt.";
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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/buttons.css">
    <link rel="stylesheet" href="./css/popups.css">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="departurePopup" class="popup">
        <h2>Mistä?</h2>
        <div>
            <select id="departureSelect">
                <option value="">Valitse lähtökaupunki</option>
            </select>
        </div>
        <footer>
            <button class="primary metal" onclick="saveCitySelection('departureSelect', 'departure'); closePopup('departurePopup')">Jatka</button>
        </footer>
    </div>

    <div id="destinationPopup" class="popup">
        <h2>Mihin?</h2>
        <div>
            <select id="destinationSelect">
                <option value="">Valitse kohdekaupunki</option>
            </select>
        </div>
        <footer>
            <button class="primary metal" onclick="saveCitySelection('destinationSelect', 'destination'); closePopup('destinationPopup')">Jatka</button>
        </footer>
    </div>


  <div id="datePopup" class="popup">
    <h2>Milloin?</h2>
    <div>
        <input type="date" id="date1" placeholder="Valitse lähtöpäivä">
        <input type="date" id="date2" placeholder="Valitse paluupäivä">
    </div>
    <footer>
        <button class="primary metal" onclick="saveDate('date1', 'date2', 'date')">Jatka</button>
    </footer>
  </div>

  <div id="passengerPopup" class="popup">
    <h2>Matkustajat?</h2>
    <ul>
    <li>
        <div>
            <h4>Aikuinen</h4>
        </div>
        <div class="passenger-control">
            <button onclick="decreasePassengerCount('adultCount')">-</button>
            <input type="number" id="adultCount" value="1" readonly>
            <button onclick="increasePassengerCount('adultCount')">+</button>
        </div>
    </li>
    <li>
        <div>
            <h4>Lapsi 12-15</h4>
        </div>
        <div class="passenger-control">
            <button onclick="decreasePassengerCount('child12to15Count')">-</button>
            <input type="number" id="child12to15Count" value="0" readonly>
            <button onclick="increasePassengerCount('child12to15Count')">+</button>
        </div>
    </li>
    <li>
        <div>
            <h4>Lapsi 2-11</h4>
        </div>
        <div class="passenger-control">
            <button onclick="decreasePassengerCount('child2to11Count')">-</button>
            <input type="number" id="child2to11Count" value="0" readonly>
            <button onclick="increasePassengerCount('child2to11Count')">+</button>
        </div>
    </li>
    <li>
        <div>
            <h4>Sylilapsi 0-2</h4>
        </div>
        <div class="passenger-control">
            <button onclick="decreasePassengerCount('infantCount')">-</button>
            <input type="number" id="infantCount" value="0" readonly>
            <button onclick="increasePassengerCount('infantCount')">+</button>
        </div>
    </li>

    </ul>
    <footer>
        <button class="primary metal" onclick="closePopup('passengerPopup')">Jatka</button>
    </footer>
  </div>

    <div class="banner">
        <img src="background.jpeg" alt="JC Airlines Banner">
    </div>
    <nav data-aos="fade-down">
        <img src="logo.svg" alt="JC Airlines Logo">
    </nav>
    <main>
        <div class="form-container" data-aos="fade-up">
           <form action="index.php" method="post">
            <div class="input-container">
                <label for="departure">Mistä?</label>
                <input type="text" value="..." id="departure" name="departure" readonly></input>            
            </div>
            <div class="input-container">
                <label for="destination">Mihin?</label>
                <input type="text" value="..." id="destination" name="destination" readonly></input>            
            </div>
            <div class="input-container">
                <label for="date">Milloin?</label>
                <input type="text" value="..." id="date" name="dates" readonly></input>            
            </div>
            <div class="input-container">
                <label for="passengers">Matkustajat</label>
                <input type="text" value="..." id="passengers" name="passengers" readonly></input>            
            </div>
            <div class="input-container">
                <label for="date">Ajankohta</label>
                <select name="time" id="time">
                    <option value="Aamu">Aamulento</option>
                    <option value="Päivä">Päivälento</option>
                    <option value="Ilta">Iltalento</option>
                </select>
            </div>
            <button class="primary metal" type="submit">Etsi lentoja</button>
            </form>
        </div>
        <div class="content">
            <div class="results-container" data-aos="fade-in">
                <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $error): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($flights)): ?>
                    <!-- Display Flights -->
                    <h3>Available Flights</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Departure</th>
                                <th>Destination</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Plane</th>
                                <th>Price (€)</th>
                                <th>Seats</th>
                            </tr>
                        </thead>
                        <tbody>
                        <div class="results-container">
    <?php foreach ($flights as $flight): ?>
        <div class="flight-result">
            <div class="header">
                <h3><?php echo $flight['departure'] . ' ➔ ' . $flight['destination']; ?></h3>
                <span><?php echo $flight['flight_date']; ?></span>
            </div>
            <div class="header">
                <h3><?php echo $flight['time_of_day']; ?> Flight</h3>
                <span><?php echo $flight['plane']; ?></span>
            </div>
            <div class="flight-classes">
                <div class="flight-class economy">Economy</div>
                <div class="flight-class business">Business</div>
                <div class="flight-class vip">VIP</div>
            </div>
            <div class="info-section">
                <ul>
                    <li><span>Luggage:</span> <span>2 x Checked Bags, 1 x Handbag</span></li>
                    <li><span>Seats Available:</span> <span><?php echo $flight['available_seats']; ?></span></li>
                </ul>
            </div>
            <div class="perks">
                <span>Lounge Access</span>
                <span>Priority Boarding</span>
                <span>In-flight Internet</span>
            </div>
        </div>
    <?php endforeach; ?>
</div>

                        </tbody>
                    </table>
                <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
                    <p class="error">Hakuehtoja täyttäviä lentoja ei löytynyt.</p>
                <?php endif; ?>

                <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !$error): ?>
                    <!-- Display Search Parameters -->
                    <div class="search-parameters">
                        <h3>Hakuehdot</h3>
                        <ul>
                            <li><strong>Departure:</strong> <?php echo htmlspecialchars($departure); ?></li>
                            <li><strong>Destination:</strong> <?php echo htmlspecialchars($destination); ?></li>
                            <li><strong>Date Range:</strong> <?php echo htmlspecialchars($dates); ?></li>
                            <li><strong>Time:</strong> <?php echo htmlspecialchars(ucfirst($time)); ?></li>
                            <li><strong>Passengers:</strong> <?php echo htmlspecialchars($passengers); ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>


            <section data-aos="slide-down">
                <h2>Tervetuloa JC Airlines</h2>
                <p>Me tarjoamme parhaat lennot ja palvelut matkustajillemme. Etsi lentoja, hallitse varauksia ja nauti matkasta kanssamme.</p>
            </section>
            <hr data-aos="slide-right">
            <section data-aos="zoom-out-up">
                jgzczgzxgzx
            </section>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
            <h4 class="footer-title">Yritys</h4>
            <ul>
                <li><a href="#">Ota yhteyttä</a></li>
                <li><a href="#">Hallinnoi varaustasi</a></li>
                <li><a href="#">Yhteydenottolomakkeet</a></li>
                <li><a href="#">Usein kysytyt kysymykset</a></li>
            </ul>
            </div>
            <div class="footer-column">
            <h4 class="footer-title">Lisäpalvelut</h4>
            <ul>
                <li><a href="#">Lisäpalvelut matkallesi</a></li>
                <li><a href="#">Autonvuokraukset</a></li>
                <li><a href="#">Lentokenttäkuljetus</a></li>
            </ul>
            </div>
            <div class="footer-column">
            <h4 class="footer-title">Seuraa meitä</h4>
            <ul>
                <li><a href="#">Uutiskirje</a></li>
                <li><a href="#">Mobiilisovellus</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
            </div>
            <div class="footer-column">
            <h4 class="footer-title">Käytännöt ja ehdot</h4>
            <ul>
                <li><a href="#">Käyttöehdot</a></li>
                <li><a href="#">Tietosuojaseloste</a></li>
                <li><a href="#">Muuta evästeasetuksia</a></li>
            </ul>
            </div>
        </div>
        <div class="footer-logo">
            <img src="logo.svg" alt="JC Airlines Logo">
        </div>
    </footer>


    <script>
        AOS.init({
            duration: 1000, // Animation duration in ms
            easing: 'ease-in-out', // Easing function
            once: false // Whether animations should happen only once
        });
    </script>
    <script src="./js/script.js"></script>
    <script src="./js/select.js"></script>
</body>
</html>
