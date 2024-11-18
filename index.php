<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JC Airlines</title>
		<link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="header">
        <img src="logo.svg" alt="JC Airlines Logo"> <!-- Replace with your logo path -->
    </div>

    <div class="form-container">
        <form action="search_flights.php" method="GET">
            <input type="text" name="from" placeholder="Mistä?" required>
            <input type="text" name="to" placeholder="Minne?" required>
            <input type="date" name="date" required>
            <select name="passengers" required>
                <option value="1">1 Aikuinen</option>
                <option value="2">2 Aikuista</option>
                <option value="1-child">1 Aikuinen, 1 Lapsi</option>
                <!-- Add more options as needed -->
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

    <div class="footer">
        <h3>Uudistamme F35 Lightning II koneidemme matkustamot</h3>
        <p>Uudistamme Euroopan-lennoillamme liikennöivien F35 Lightning II -koneiden matkustamot. Ensimmäisen uudistetulla matkustamolla lentävän koneen kyytiin pääset jo lokakuusta 2024 alkaen!</p>
        <a href="details.php">Lue lisää</a>
    </div>
</body>
</html>
