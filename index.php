<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JC Airlines - Etsi Lentoja</title>
    <link rel="stylesheet" href="./css/style.css">
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
    <select id="departureSelect">
        <option value="">Select a city</option>
    </select>
    <button onclick="saveCitySelection('departureSelect', 'departure'); closePopup('departurePopup')">Save</button>
</div>

<div id="destinationPopup" class="popup">
    <h2>Mihin?</h2>
    <select id="destinationSelect">
        <option value="">Select a city</option>
    </select>
    <button onclick="saveCitySelection('destinationSelect', 'destination'); closePopup('destinationPopup')">Save</button>
</div>


  <div id="datePopup" class="popup">
    <h2>Milloin?</h2>
    <input type="date" placeholder="Select departure date">
    <input type="date" placeholder="Select return date">
    <button onclick="closePopup('datePopup')">Close</button>
  </div>

  <div id="passengerPopup" class="popup">
    <h2>Matkustajat?</h2>
    <input type="number" placeholder="Number of passengers">
    <button onclick="closePopup('passengerPopup')">Close</button>
  </div>

    <div class="banner">
        <img src="background.jpeg" alt="JC Airlines Banner">
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
           <form action="search_flights.php" method="post">
            <div class="input-container">
                <label for="departure">Mistä?</label>
                <input type="text" value="..." id="departure" readonly></input>            
            </div>
            <div class="input-container">
                <label for="destination">Mihin?</label>
                <input type="text" value="..." id="destination" readonly></input>            
            </div>
            <div class="input-container">
                <label for="date">Milloin?</label>
                <input type="text" value="..." id="date" readonly></input>            
            </div>
            <div class="input-container">
                <label for="passengers">Matkustajat</label>
                <input type="text" value="..." id="passengers" readonly></input>            
            </div>
            <div class="input-container">
                <label for="date">Ajankohta</label>
                <select name="time" id="time">
                    <option value="morning">Aamulento</option>
                    <option value="afternoon">Päivälento</option>
                    <option value="evening">Iltalento</option>
                </select>
            </div>
            <button type="submit">Etsi lentoja</button>
            </form>
        </div>
    </main>

    <script>
        AOS.init({
            duration: 1000, // Animation duration in ms
            easing: 'ease-in-out', // Easing function
            once: true // Whether animations should happen only once
        });
    </script>
    <script src="./js/script.js"></script>
    <script src="./js/select.js"></script>
</body>
</html>
