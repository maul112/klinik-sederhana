<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['keluhan'])) {
    $keluhan = $_SESSION["keluhan"];
} else {
    $keluhan = "";
}
$username = $_SESSION["username"];
if($keluhan === "kata kata rahasia wes pokoknya") {
    $keluhan = "kata kata rahasia wes pokoknya";
} else {
    // Query untuk mengambil data antrian berdasarkan keluhan dan username
    $dokter = $_GET['dokter'];
    $keluhan = $_GET['keluhan'];
    $username = $_SESSION['username'];
    $no = $_GET['no'];
    $temp = mysqli_query($conn, "SELECT * FROM antrian WHERE dokter = '$dokter' AND username = '$username' AND keluhan = '$keluhan'");
    $hasil = mysqli_fetch_assoc($temp);
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
                <h2>Your Appointment Has Been Confirmed</h2>
                <?php if($keluhan !== "kata kata rahasia wes pokoknya") :?>
                    <!-- Menampilkan data keluhan, dokter, tanggal, dan jam -->
                    <p>Your appointment with Dr. <?= $hasil["dokter"] ?> on <?= date("l, F j, Y", strtotime($hasil["date"])) ?> at <?= $hasil["hour"] ?></p>
                    <p><strong>Keluhan: </strong><?= $hasil["keluhan"] ?></p>
                    <button class="view-appointment-btn" onclick="window.location.href='../Print Queue/index.php?dokter=<?= $dokter ?>&keluhan=<?= $keluhan ?>&no=<?= $no ?>';">Print Your Queue</button>
                <?php else :?>
                    <!-- Jika keluhan adalah kata rahasia, tampilkan tombol untuk kembali ke dashboard -->
                    <button class="view-appointment-btn" onclick="window.location.href='../../index.php';">Back To Dashboard</button>
                <?php endif?>
            </div>
        </div>
    </div>
</body>
</html>
