<?php
session_start();

$_SESSION["from"] = "laboratory";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LABORATORY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>LABORATORY</h1>
        </header>
        <div class="grid" >
            <a href="mikrobiologi/indeks.php">
                <div class="card">
                    <div class="icon"><img src="1.png" alt="Mikrobiologi klinik icon"></div>
                    <div class="content">
                        <h2>Mikrobiologi</h2>
                    </div>
                </div>
            </a>
            <a href="anatomi/indeks.php">
                <div class="card">
                    <div class="icon"><img src="2.png" alt="Anotomy icon"></div>
                    <div class="content">
                        <h2>Anotomy</h2>
                    </div>
                </div>
            </a>
            <a href="blood/indeks.php">
                <div class="card">
                    <div class="icon"><img src="3.png" alt="Blood icon"></div>
                    <div class="content">
                        <h2>Blood</h2>
                    </div>
                </div>
            </a>
            <a href="biomolekuler/indeks.php">
                <div class="card">
                    <div class="icon"><img src="4.png" alt="Biomolekuler icon"></div>
                    <div class="content">
                        <h2>Biomolekuler</h2>
                    </div>
                </div>
            </a>
            <a href="patology/indeks.php">
                <div class="card">
                    <div class="icon"><img src="5.png" alt="Patology klinik icon"></div>
                    <div class="content">
                        <h2>Patology klinik</h2>
                    </div>
                </div>
            </a>
            <a href="parasitologi/index.php">
                <div class="card">
                    <div class="icon"><img src="6.png" alt="Parasitology icon"></div>
                    <div class="content">
                        <h2>Parasitology</h2>
                    </div>
                </div>
            </a> 
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
