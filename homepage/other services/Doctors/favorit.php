<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
$username = $_SESSION['username'];

// Ambil daftar dokter favorit dari tabel 'dokter_favorit'
$query = "SELECT * FROM dokter_favorit WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Ambil data dokter favorit berdasarkan ID dokter
$dokter_favorit = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dokterId = $row['dokter_id'];
    $dokterQuery = "SELECT * FROM dokter WHERE id = '$dokterId'";
    $dokterResult = mysqli_query($conn, $dokterQuery);
    $dokter_favorit[] = mysqli_fetch_assoc($dokterResult);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokter Favorit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dokter Favorit</h2>
        <?php if (empty($dokter_favorit)) : ?>
            <p>Anda belum memiliki dokter favorit.</p>
        <?php else : ?>
            <div class="dokter-list">
                <?php foreach ($dokter_favorit as $dokter) : ?>
                    <div class="dokter-card">
                        <img src="other services/Doctors/doctor.png" alt="<?= $dokter['nama'] ?>">
                        <div class="dokter-info">
                            <h3><?= $dokter['nama'] ?></h3>
                            <p><?= $dokter['spesialisasi'] ?> | <?= $dokter['jadwal'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
