<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $from = htmlspecialchars($_GET['from']);
    $to = htmlspecialchars($_GET['to']);
    $date = htmlspecialchars($_GET['date']);
    $passengers = htmlspecialchars($_GET['passengers']);
    $class = htmlspecialchars($_GET['class']);

    // Simulate a flight search (in real apps, query a database or API)
    echo "<h1>Hakutulokset</h1>";
    echo "<p>Lähtöpaikka: $from</p>";
    echo "<p>Kohde: $to</p>";
    echo "<p>Päivämäärä: $date</p>";
    echo "<p>Matkustajat: $passengers</p>";
    echo "<p>Luokka: $class</p>";
}
?>
