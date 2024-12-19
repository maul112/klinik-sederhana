<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

$username = $_SESSION["username"];
$title = $_GET["title"];
$temp = mysqli_query($conn, "SELECT * FROM laboratory WHERE username = '$username' AND title = '$title' AND status = 'upcoming'");
$hasil = mysqli_fetch_all($temp);
$nomor = count($hasil);
$temp1 = mysqli_query($conn, "SELECT * FROM laboratory WHERE username = '$username' AND title = '$title' AND status = 'upcoming'");
$hasil1 = mysqli_fetch_assoc($temp1);
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
            <input type="submit" class="nomor" value="<?= $nomor?>">
        </div>
        <div class="container-login">
            <div class="navbar">
                <a href="../../../index.php">Next</a>
            </div>
            <div class="container-form">
                <h1 class="titled">Klinik Kita Sehat</h1>
                <div class="inputfield">
                    <form method="post">
                        <div class="nama">
                            Nama : <input type="text" id="nama" required readonly value="<?= $hasil1["fullname"]?>">
                        </div>
                        <div class="poly">
                            Nama Paket : <input type="text" id="poly" required readonly value="<?= $hasil1["title"]?>">
                        </div>
                        </div>
                        <div class="tanggal">
                            Harga : <input type="text" id="tanggal" required readonly value="<?= $hasil1["harga"]?>">
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
