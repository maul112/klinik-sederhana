<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$temp = mysqli_query($conn, "SELECT * FROM mcu_data WHERE kategori = 'Travelling'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Check Up</title>
    <link rel="stylesheet" href="styles-travelling.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>MEDICAL CHECK UP</h1>
        </header>
        <div class="filters">
            <a href="indeks-hearth.php"><button class="filter-button">Heart</button></a>
            <a href="indeks-children.php"><button class="filter-button">Children</button></a>
            <a href="index-travelling.php"><button class="filter-button active">Travelling</button></a>
            <a href="indeks-eldery.php"><button class="filter-button">Eldery</button></a>
            <a href="indeks-prewed.php"><button class="filter-button">Pre-Wedding</button></a>
            <a href="indeks-general.php"><button class="filter-button">General MCU</button></a>
        </div>
        <div class="isi">
            <p>This package is still not available</p>
        </div>
    </div>
</body>
</html>
