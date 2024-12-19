<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
$keluhan = $_GET["keluhan"];
$username = $_SESSION["username"];
$dokter = $_GET["dokter"];
$no = $_GET['no'];
$temp = mysqli_query($conn, "SELECT * FROM antrian WHERE dokter = '$dokter' AND keluhan = '$keluhan' AND username = '$username'");
$hasil = mysqli_fetch_assoc($temp);
$poly = $hasil["poly"];
$temp1 = mysqli_query($conn, "SELECT * FROM antrian WHERE poly = '$poly' AND status = 'upcoming'");
$hasil2 = mysqli_fetch_all($temp1);
$nomor = count($hasil2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Print Queue</title>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <input type="submit" class="cetak" value="PRINT QUEUE">
            <input type="submit" class="nomor" value="<?= $no?>">
        </div>
        <div class="container-login">
            <div class="navbar">
                <a href="../../Appointment/upcoming.php">Next</a>
            </div>
            <div class="container-form">
                <h1 class="titled">Klinik Kita Sehat</h1>
                <div class="inputfield">
                    <form method="post">
                        <div class="nama">
                            Nama : <input type="text" id="nama" required readonly value="<?= $hasil["fullname"]?>">
                        </div>
                        <div class="keluhan">
                            Keluhan : <input type="text" id="keluhan" required readonly value="<?= $hasil["keluhan"]?>">
                        </div>
                        <div class="keluhan">
                            Nama Dokter : <input type="text" id="keluhan" required readonly value="<?= $hasil["dokter"]?>">
                        </div>
                        <div class="poly">
                            Poly : <input type="text" id="poly" required readonly value="<?= $hasil["poly"]?>">
                        </div>
                        </div>
                        <div class="times">
                            Jam : <input type="text" id="time" required readonly value="<?= $hasil["hour"]?>">
                        </div>
                        <div class="tanggal">
                            Tanggal : <input type="text" id="tanggal" required readonly value="<?= $hasil["date"]?>">
                        </div>
                        <input type="submit" name="submit" id="print" class="button" value="PRINT">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("print").addEventListener('click' ,function() {
            print();
        })
    </script>
</body>
</html>
