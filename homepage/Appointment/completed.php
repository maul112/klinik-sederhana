<?php
session_start();

unset($_SESSION['allTotal']);

$username = $_SESSION["username"];

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil antrian dengan status 'completed' untuk pengguna yang sedang aktif
$temp = mysqli_query($conn, "SELECT * FROM antrian WHERE username = '$username' AND status = 'completed'");

$mcu = mysqli_query($conn, "SELECT * FROM mcu WHERE username = '$username' AND status = 'completed'");
$lab = mysqli_query($conn, "SELECT * FROM laboratory WHERE username = '$username' AND status = 'completed'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                <div class="tab"><a href="upcoming.php">Upcoming</a></div>
                <div class="tab active"><a href="completed.php">Completed</a></div>
                <div class="tab"><a href="visitReport.php">Visit Report</a></div>
            </div>
        </div>
        <?php if(mysqli_num_rows($temp) != 0) : ?>
        <h3 style="margin-top: 1rem;">Poly</h3>
        <div class="appointments">
            <?php while($data = mysqli_fetch_assoc($temp)) :?>
            <div class="appointment-card">
                <div class="appointment-header">
                    <img src="../../userProfile/<?php $dokterUsername = $data['dokter']; echo mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM dokter WHERE username = '$dokterUsername'"))['gambar']?? '' ?>" alt="dokter">
                    <div class="appointment-details">
                        <h2><?= $data["dokter"]?></h2>
                        <div class="detail-container">
                            <div class="spesialis"><?= $data["poly"]?> |</div>
                            <div class="completed"><?= $data["status"]?></div>
                        </div>
                        <div class="date-time"><?= $data["date"]?> | <?= $data["hour"]?></div>
                    </div>
                </div>
                <!-- <button class="btn bookAgain"><a href="../other services/book/book.php?id=<?= $data["id"]?>">Book Again</a></button> -->
                <button class="btn bookAgain"><a href="../other services/Doctors/indeks.php">Book Again</a></button>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif ?>
        <?php if(mysqli_num_rows($mcu) != 0) : ?>
            <h3 style="margin-top: 1rem;">MCU</h3>
            <div id="upcoming-appointments" class="appointments">
                <?php while($data = mysqli_fetch_assoc($mcu)) :?>
                <div class="appointment-card">
                    <div class="appointment-header">
                        <h1><?= $data['no_antrian'] ?></h1>
                        <div class="appointment-details">
                            <h2><?= $data["title"]?></h2>
                            <div class="detail-container">
                                <div class="completed"><?= $data["status"]?></div>
                            </div>
                            <div class="date-time"><?= explode(" ", $data["date"])[0]?> | <?= explode(" ", $data["date"])[1]?></div>
                        </div>
                    </div>
                    <button class="btn bookAgain"><a href="../other services/MCU/indeks.php">Book Again</a></button>
                </div>
                <?php endwhile?>
            </div>
        <?php endif?>
        <?php if(mysqli_num_rows($lab) != 0) : ?>
            <h3 style="margin-top: 1rem;">Laboratory</h3>
            <div id="upcoming-appointments" class="appointments">
                <?php while($data = mysqli_fetch_assoc($lab)) :?>
                <div class="appointment-card">
                    <div class="appointment-header">
                        <h1><?= $data['no_antrian'] ?></h1>
                        <div class="appointment-details">
                            <h2><?= $data["title"]?></h2>
                            <div class="detail-container">
                                <div class="completed"><?= $data["status"]?></div>
                            </div>
                            <div class="date-time"><?= explode(" ", $data["date"])[0]?> | <?= explode(" ", $data["date"])[1]?></div>
                        </div>
                    </div>
                    <button class="btn bookAgain"><a href="../other services/labolatory/labolatory.php">Book Again</a></button>
                </div>
                <?php endwhile?>
            </div>
        <?php endif?>
    </div>
</body>
</html>
