<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Periksa apakah user telah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../../masuk/Create Account/create-account.php");
    exit;
}

// Ambil username dan fullname dari session
$username = $_SESSION['username'];

// Periksa apakah ID kunjungan diberikan
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM antrian WHERE id = '$id'";
    $hasil = mysqli_fetch_assoc(mysqli_query($conn, $query));
} else {
    header("Location: ../upcoming.php");
    exit;
}

// Proses data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $hour = $_POST["hour"];
    $id = $_POST["id"];
    $date = $_POST['date'];

    // Update jam kunjungan
    // mysqli_query($conn, "UPDATE antrian SET
    //     hour = '$hour'
    //     WHERE id = '$id'
    // ");

    // Arahkan ke pembayaran setelah perubahan selesai
    
    header("Location: ../other services/book/PAYMENT.php?nsbasudjb=$id&kasdnkak=$hour&abfasjfjab=$date");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-submit {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .btn-submit button {
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Change Appointment Time</h1>
    </div>
    <form method="post">
        <input type="hidden" name="id" value="<?= $hasil['id'] ?>">
        <div class="mb-3">
            <label for="poli" class="form-label">Poli</label>
            <input type="text" id="poli" class="form-control" value="<?= $hasil['poly'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="dokter" class="form-label">Dokter</label>
            <input type="text" id="dokter" class="form-control" value="<?= $hasil['dokter'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea id="keluhan" class="form-control" rows="3" disabled><?= $hasil['keluhan'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="text" id="tanggal" name="date" class="form-control" value="<?= $hasil['pemeriksaan'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="hour" class="form-label">Jam</label>
            <select name="hour" id="hour" class="form-control">
                <option value="<?= $hasil['hour'] ?>"><?= $hasil['hour'] ?: 'Pilih jam' ?></option>
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
        <div class="btn-submit">
            <button type="submit">Proceed to Payment</button>
        </div>
    </form>
</div>

</body>
</html>
