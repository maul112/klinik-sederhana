<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM mcu WHERE id = $id");

$row = mysqli_fetch_assoc($result);

$username = $_SESSION['username'];
$result1 = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$row1 = mysqli_fetch_assoc($result1);

if (!$row1) {
    header("Location: visitReport.php"); 
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Kesehatan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 20px;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }

        .header {
            display: flex;
            align-items: center; /* Vertikal sejajar */
            justify-content: space-between; /* Spasi di antara elemen */
            /* margin-bottom: 20px; */
            padding: 10px 0;
        }

        .header img {
            max-width: 100px; /* Ukuran maksimum untuk logo */
            height: auto; /* Menyesuaikan tinggi sesuai proporsi logo */
            
        }
        .header .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            flex-grow: 1;
        }

        .header .address {
            font-size: 14px;
            color: #555;
            font-size:14px;
        }
        .header .text {
            text-align: left; /* Teks sejajar ke kiri */
        }

        .header .text h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .header .text p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }


        .section-title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .details span {
            font-weight: bold;
        }

        .content {
            margin-top: 20px;
        }

        .content ul {
            list-style-type: none;
            padding: 0;
        }

        .content ul li {
            margin-bottom: 10px;
        }

        hr {
            border: 1px solid #000;
            margin: 20px 0;
        }
        button {
            display: flex;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%; /* Mengatur lebar tombol */
            text-align: center; /* Menjaga teks tetap berada di tengah */
            justify-content: center; /* Menengahkan secara horizontal */
            align-items: center; /* Menengahkan secara vertikal */
        }
        a {
            text-decoration: none;
        }

        @media print {
            #cetak, #lanjut {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo kita sehat.png" alt="Logo">
            <div class="title">
                Klinik Kita Sehat
                <div class="address">Kenanga Ave No.34 Block H</div>
            </div>
        </div>
        
        <hr>

        <div class="section-title">Laporan Pemeriksaan Kesehatan</div>

        <div class="details">
            <p>Nama: <?= $row1["fullname"] ?></p>
            <p>Gender: <?= $row1["gender"] ?></p>
            <p>Tanggal Lahir: <?= $row1["dob"] ?></p>
            <p>Phone: <?= $row1["phone"] ?></p> <br>
        </div>

        <div class="content">
            <ul>
                <li>
                    <strong>Saran dari Dokter yaitu :<br>
                    <ul><?= $row["saran"] ?><br><br></ul>
                </li>
                <li>
                    <strong>Resep Obat : <br>
                    <ul><?= $row["obat"] ?><br><br></ul>
                </li>
                <li>
                    <strong>Jadwal Pemeriksaan Berikutnya : <br>
                    <ul><?= $row["pemeriksaan"] ?><br><br></ul>
                </li>
            </ul>
        </div>
        <button id="cetak" onclick="window.print()" style="background-color: #7A5AF8">Cetak PDF</button>
        <br>
        <button id="lanjut" style="background-color: #488fcb"><a href="lanjutvisit.php?id=<?= $row['id'] ?>">Lanjutkan Kunjungan</a></button>
    </div>
</body>
</html>
