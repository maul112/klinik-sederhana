<?php
// Mulai sesi
session_start();

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Ambil kategori dan mcu_id dari URL parameter
$kategori = $_GET['kategori'];
$mcu_id = $_GET['mcu_id'];

// Query untuk mendapatkan detail paket atau kategori
if ($mcu_id) {
    // Jika mcu_id ada, tampilkan detail paket
    $query = "SELECT * FROM mcu_data WHERE id = '$mcu_id'";
} else {
    // Jika kategori ada, tampilkan paket berdasarkan kategori
    $query = "SELECT * FROM mcu_data WHERE kategori = '$kategori'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Detail Paket</title>
</head>
<body>
    <div class="container">
        <h1>Detail Paket</h1>
        <div class="mcu-list">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <div class="cards">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="card">
                            <h3><?php echo htmlspecialchars($row['paket']); ?></h3>
                            <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                            <p class="price">Harga: Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            <p>Kategori: <?php echo htmlspecialchars($row['kategori']); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Tidak ada paket di kategori ini.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
