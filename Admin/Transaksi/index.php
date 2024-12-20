<?php
session_start();

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data transaksi dan gabungkan dengan tabel medicine
$query = "SELECT 
    med_cart.id as id_transaksi,
    medicine.medname AS nama_medicine,
    med_cart.qty as jumlah,
    SUM(med_cart.qty*medicine.harga) as total_harga,
    med_cart.waktu_transaksi as tanggal_transaksi
FROM 
    med_cart
JOIN medicine ON medicine.id = med_cart.med_id
GROUP BY med_cart.med_id";
$hasil = mysqli_query($conn, $query);

if (!$hasil) {
    die("Error pada query: " . mysqli_error($conn) . " Query: " . $query);
}

// Periksa sesi login
if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="../kitasehat logo 1.png" alt="Logo">
            <h1>KITA SEHAT</h1>
            <p>HEALTH SERVICE</p>
        </div>
        <a href="../Dashboard/index.php"><button class="sidebar-btn">Dashboard</button></a>
        <a href="../Medical Check Up/index.php"><button class="sidebar-btn">Medical Check Up</button></a>
        <a href="../Account/Admin Account.php"><button class="sidebar-btn">Account</button></a>
        <a href="../Labolatory/index.php"><button class="sidebar-btn">Laboratory</button></a>
        <a href="../Pharmacy/farmasi.php"><button class="sidebar-btn">Pharmacy</button></a>
        <a href="../Review/index.php"><button class="sidebar-btn">Review</button></a>
        <a href="../Kiat news/index.php"><button class="sidebar-btn">Kiat News</button></a>
        <a href="#"><button class="sidebar-btn active">Transaksi</button></a>
        <a href="../Visit Report MCU/index.php"><button class="sidebar-btn">Visit Report MCU</button></a>
        <a href="../Visit Report LAB/index.php"><button class="sidebar-btn">Visit Report LAB</button></a>
    </div>
    <!-- Konten Utama -->
    <div class="main-content">
        <div class="container">
            <div class="header">
                <button class="sidebar-toggle"><img src="../Dashboard/hamburger-sidebar.svg" alt="Menu"></button>
                <h1>Transaksi</h1>
                <p></p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Medicine</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_assoc($hasil)) : ?>
                        <tr>
                            <td><?= $data['id_transaksi'] ?></td>
                            <td><?= htmlspecialchars($data['nama_medicine']) ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td>Rp <?= number_format($data['total_harga'], 2, ',', '.') ?></td>
                            <td><?= $data['tanggal_transaksi'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>