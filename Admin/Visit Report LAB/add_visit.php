<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
// $temp = mysqli_query($conn, "SELECT * FROM antrian WHERE status = 'completed'");

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: ./");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM laboratory WHERE id = $id");

$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $saran = $_POST['saran'];
    $obat = $_POST['obat']; 
    $pemeriksaan = $_POST['pemeriksaan'];

    $query = "UPDATE laboratory SET saran = '$saran', obat = '$obat', visit = 'sudah', status = 'completed' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: ./");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Hasil Pemeriksaan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }

        .container {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form label {
            font-weight: bold;
            color: #495057;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="password"],
        form select,
        form textarea {
            padding: 10px;
            width: calc(100% - 20px); /* Mengurangi 20px untuk jarak kiri dan kanan */
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f8f9fa;
            color: #495057;
        }

        h2 {
            color: #17a2b8;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-green {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 48%; /* Mengatur lebar tombol */
            text-align: center;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .btn-red {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 48%; /* Mengatur lebar tombol */
            text-align: center;
        }

        .btn-red:hover {
            background-color: #c82333;
        }

        a.btn-red {
            display: inline-block;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Hasil Pemeriksaan</h2>
    <form action="" method="post">
        <label>Nama Pasien</label>
        <input type="text" name="nama" disabled value="<?= $row["fullname"]?>"></input>

        <label>Tanggal</label>
        <input type="text" name="date" disabled value="<?= $row["date"]?>"></input>

        <label>Saran Dokter</label>
        <textarea name="saran" rows="3" required placeholder="Masukkan Saran Anda"></textarea>

        <label>Resep Obat</label>
        <textarea name="obat" rows="3" required placeholder="Masukkan Resep Obat"></textarea>

        <div class="btn-container">
            <button type="submit" class="btn-green">Simpan</button>
            <button onclick="location.href='./'" class="btn-red">Batal</button>
        </div>
    </form>
</div>

</body>
</html>