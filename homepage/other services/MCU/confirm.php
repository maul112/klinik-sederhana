<?php

session_start();

$username = $_SESSION['username'];

$table = $_SESSION["from"];

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

$temp = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($temp);
$fullname = $hasil["fullname"];

$harga = $_POST["harga"];
$title = $_POST["title"];

if(isset($_POST)) {
    $harga = $_POST["harga"];
    $title = $_POST["title"];
    mysqli_query($conn, "INSERT INTO mcu VALUES ('', '$username', '$fullname', '$title', '$harga', 'upcoming')");
    header("Location: print/index.php?title=" . $title);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation payment</title>
    <link rel="stylesheet" href="styles-confirm.css">
</head>
<body>
    <body>
        <div class="container">
            <div class="confirmation-box">
                <div class="icon">
                    <img src="../pembayaran/confirmation-icon.png" alt="Confirmation Icon">
                </div>
                <div class="confirmation-message">
                    <h2>Your Appointment Has Been Confirmed</h2>
                    <p>Your appointment with <?= $title?> succes</p>
                    <form method="post">
                        <input type="hidden" name="harga" value="<?= $harga?>">
                        <input type="hidden" name="title" value="<?= $title?>">
                        <button class="view-appointment-btn" onclick=" window.location.href='print/index.php';">print your queue</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>