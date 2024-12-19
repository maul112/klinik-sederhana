<?php
session_start();

$_SESSION["from"] = "mcu";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Check Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container-mcu">
        <header>
            <h1>MEDICAL CHECK UP</h1>
        </header>
        <div class="grid" >
            <a href="indeks-hearth.php">
                <div class="card">
                    <div class="icon"><img src="assets-mcu/hearth.png" alt="Heart icon"></div>
                    <div class="content">
                        <h2>Heart</h2>
                        <p>Heart health check</p>
                    </div>
                </div>
            </a>
            <a href="indeks-children.php">
                <div class="card">
                    <div class="icon"><img src="assets-mcu/children.png" alt="Children icon"></div>
                    <div class="content">
                        <h2>Children</h2>
                        <p>Health screening for children</p>
                    </div>
                </div>
            </a>
            <a href="index-travelling.php">
                <div class="card">
                    <div class="icon"><img src="assets-mcu/traveling.png" alt="Travelling icon"></div>
                    <div class="content">
                        <h2>Travelling</h2>
                        <p>Health screening for travel needs</p>
                    </div>
                </div>
            </a>
            <a href="indeks-eldery.php">
                <div class="card">
                    <div class="icon"><img src="assets-mcu/eldery.png" alt="Elderly icon"></div>
                    <div class="content">
                        <h2>Elderly</h2>
                        <p>Health screening for the elderly</p>
                    </div>
                </div>
            </a>
            <a href="indeks-prewed.php">
                <div class="card">
                    <div class="icon"><img src="assets-mcu/pre-wedding.png" alt="Pre-Wedding icon"></div>
                    <div class="content">
                        <h2>Pre-Wedding</h2>
                        <p>Health screening of prospective couples</p>
                    </div>
                </div>
            </a>
            <a href="indeks-general.php">
                <div class="card">
                    <div class="icon"><img src="assets-mcu/general mcu.png" alt="General MCU icon"></div>
                    <div class="content">
                        <h2>General MCU</h2>
                        <p>Basic and advanced health screening</p>
                    </div>
                </div>
            </a> 
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
