<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

$username = $_SESSION["username"];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['allTotal'])) {
    $total = $_SESSION['allTotal'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Payment</title>
    <link rel="stylesheet" href="styles-confirm.css">
</head>
<body>
    <div class="container">
        <div class="confirmation-box">
            <div class="icon">
                <img src="confirmation-icon.png" alt="Confirmation Icon">
            </div>
            <div class="confirmation-message">
                <h2>Your Payment Has Been Confirmed</h2>
                <!-- Menampilkan data keluhan, dokter, tanggal, dan jam -->
                <p>Your amount of payment </p>
                <p><strong>Rp<?= isset($total)? number_format($total, 0, ',', '.') : 0 ?></strong></p>
                <button class="view-appointment-btn" onclick="window.location.href='../../Appointment/upcoming.php';">Go To Appointment</button>
            </div>
        </div>
    </div>
</body>
</html>

<?php unset($_SESSION['allTotal']); ?>