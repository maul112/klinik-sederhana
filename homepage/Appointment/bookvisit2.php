<?php

session_start();

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../../masuk/Create Account/create-account.php");
    exit;
}

// Ambil ID dari URL
$idd = $_GET['id'] ?? null;

if (!$idd) {
    echo "ID tidak ditemukan!";
    exit;
}

// Ambil data dari database berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM antrian WHERE id = $idd");
$row = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}
$user = $row["username"];
$full = $row["fullname"];
// Proses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keluhan = $_POST['keluhan'];
    $hour = $_POST['hour'];

    // Validasi input
    if (!empty($keluhan) && !empty($hour)) {
        $dokter = $row['dokter'];
        $poly = $row['poly'];
        $date = $row['date'];

        // Insert data baru ke tabel antrian
        $query = "INSERT INTO antrian (username, fullname, dokter, poly, date, hour, keluhan, status) VALUES 
                  ('$user', '$full','$dokter', '$poly', '$date', '$hour', '$keluhan', 'upcoming')";
        mysqli_query($conn, $query);

        // Redirect ke halaman daftar antrian
        header("Location: upcoming.php");
        exit;
    } else {
        $error = "Semua data harus diisi!";
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Antrian Baru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 1.8rem;
            color: #333;
        }
        .btn {
            background-color: #28a745;
            color: white;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Buat Antrian Baru</h1>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <!-- Menampilkan data dokter, poli, dan date -->
        <div class="mb-3">
            <label for="dokter" class="form-label">Dokter</label>
            <input type="text" id="dokter" class="form-control" value="<?= $row['dokter'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="poly" class="form-label">Poli</label>
            <input type="text" id="poly" class="form-control" value="<?= $row['poly'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" id="date" class="form-control" value="<?= $row['pemeriksaan'] ?>" readonly>
        </div>

        <!-- Input untuk keluhan -->
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" rows="3"><?= $row['keluhan'] ?></textarea>
        </div>

        <!-- Input untuk jam -->
        <div class="mb-3">
            <label for="hour" class="form-label">Jam</label>
            <select name="hour" id="hour" class="form-select">
                <option value="">Pilih Jam</option>
                <option value="09:30 AM">09:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="11:30 AM">11:30 AM</option>
                <option value="14:00 PM">14:00 PM</option>
                <option value="14:30 PM">14:30 PM</option>
                <option value="15:00 PM">15:00 PM</option>
            </select>
        </div>

        <button type="submit" class="btn">Buat Antrian</button>
    </form>
</div>
</body>
</html>
