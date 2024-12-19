<?php

session_start();

date_default_timezone_set("Asia/Jakarta");

$username = $_SESSION["username"];

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
$temp = mysqli_query($conn, "SELECT * FROM antrian WHERE username = '$username' AND status = 'upcoming'");

$mcu = mysqli_query($conn, "SELECT * FROM mcu WHERE username = '$username' AND status = 'upcoming'");
$lab = mysqli_query($conn, "SELECT * FROM laboratory WHERE username = '$username' AND status = 'upcoming'");

$tanggalSekarang = date('d');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="appointment.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a href="../" class="back-button"><img src="back.png" alt="Back" style="width: 24px; height: 24px;"></a>
                <h1>APPOINTMENT</h1>
            </div>
            <div class="tabs">
                <div class="tab active"><a href="upcoming.php">Upcoming</a></div>
                <div class="tab"><a href="completed.php">Completed</a></div>
                <div class="tab"><a href="visitReport.php">Visit Report</a></div>
            </div>
        </div>
        <h3 style="margin-top: 1rem;">Poly</h3>
        <div id="upcoming-appointments" class="appointments">
            <?php while($data = mysqli_fetch_assoc($temp)) :?>
            <div class="appointment-card">
                <div class="appointment-header">
                    <img src="DR Williem Smith.png" alt="DR William Smith">
                    <div class="appointment-details">
                        <h2><?= $data["dokter"]?></h2>
                        <div class="detail-container">
                            <div class="spesialis"><?= $data["poly"]?> |</div>
                            <div class="upcoming"><?= $data["status"]?></div>
                        </div>
                        <div class="date-time"><?= $data["date"]?> | <?= $data["hour"]?></div>
                    </div>
                </div>
                <div class="buttons">
                    <a href="hapus.php?id=<?= $data["id"]?>" class="btn cancel pt-2">Cancel Booking</a>
                    <button class="btn reschedule"><a href="../other services/book/book.php?id=<?= $data["id"]?>">Reschedule</a></button>

                </div>
            </div>
            <?php endwhile?>
        </div>
        <?php if(mysqli_num_rows($mcu) != 0) : ?>
            <h3 style="margin-top: 1rem;">MCU</h3>
            <div id="upcoming-appointments" class="appointments">
                <?php while($data = mysqli_fetch_assoc($mcu)) :?>
                <div class="appointment-card">
                    <div class="appointment-header">
                        <h1>1</h1>
                        <div class="appointment-details">
                            <h2><?= $data["title"]?></h2>
                            <div class="detail-container">
                                <div class="upcoming"><?= $data["status"]?></div>
                            </div>
                            <div class="date-time"><?= explode(" ", $data["date"])[0]?> | <?= explode(" ", $data["date"])[1]?></div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="hapus.php?id=<?= $data["id"]?>" class="btn cancel pt-2">Cancel Booking</a>
                        <button class="btn reschedule"><a href="../other services/book/book.php?id=<?= $data["id"]?>">Reschedule</a></button>

                    </div>
                </div>
                <?php endwhile?>
            </div>
        <?php endif?>
        <?php if(mysqli_num_rows($mcu) != 0) : ?>
            <h3 style="margin-top: 1rem;">Laboratory</h3>
            <div id="upcoming-appointments" class="appointments">
                <?php while($data = mysqli_fetch_assoc($lab)) :?>
                <div class="appointment-card">
                    <div class="appointment-header">
                        <div class="appointment-details">
                            <h2><?= $data["title"]?></h2>
                            <div class="detail-container">
                                <div class="upcoming"><?= $data["status"]?></div>
                            </div>
                            <div class="date-time"><?= explode(" ", $data["date"])[0]?> | <?= explode(" ", $data["date"])[1]?></div>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="hapus.php?id=<?= $data["id"]?>" class="btn cancel pt-2">Cancel Booking</a>
                        <button class="btn reschedule"><a href="../other services/book/book.php?id=<?= $data["id"]?>">Reschedule</a></button>

                    </div>
                </div>
                <?php endwhile?>
            </div>
        <?php endif?>
    </div>
    <script src="appointment.js"></script>
</body>
</html>
