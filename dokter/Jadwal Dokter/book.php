<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../create_account.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_POST['book_appointments'])) {
    $dokter = $_POST['dokter'];
    $poly = $_POST['poly'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $keluhan = $_POST['keluhan'];
    $nama_pasien = $_SESSION['username'];  // Nama pasien diambil dari sesi login

    $query = "INSERT INTO antrian (nama_pasien, dokter, poly, hari_praktik, jam_praktik, keluhan, status) 
              VALUES ('$nama_pasien', '$dokter', '$poly', '$hari', '$jam', '$keluhan', 'upcoming')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Appointment berhasil di-booking'); window.location.href='../../Dashboard Doctor/index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Book an Appointment</h1>
        </header>
        <form action="" method="post">
            <label for="dokter">Doctor:</label>
            <input type="text" name="dokter" value="<?= htmlspecialchars($_GET['dokter']) ?>" readonly required>
            
            <label for="poly">Specialization:</label>
            <input type="text" name="poly" value="<?= htmlspecialchars($_GET['poly']) ?>" readonly required>
            
            <label for="hari">Day:</label>
            <input type="text" name="hari" value="<?= htmlspecialchars($_GET['hari']) ?>" readonly required>
            
            <label for="jam">Time:</label>
            <input type="text" name="jam" value="<?= htmlspecialchars($_GET['jam']) ?>" readonly required>

            <label for="keluhan">Complaint:</label>
            <textarea name="keluhan" required></textarea>

            <button type="submit" name="book_appointment">Book Appointment</button>
        </form>
    </div>
</body>
</html>
