<?php
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Ambil ID MCU dan kategori dari URL
$mcu_id = isset($_GET['id']) ? $_GET['id'] : null;
$kategori_mcu = isset($_GET['kategori']) ? $_GET['kategori'] : null;

// Query untuk mendapatkan detail MCU berdasarkan ID
if ($mcu_id) {
    $query_mcu = "SELECT * FROM mcu_data WHERE id = '$mcu_id'";
    $result_mcu = mysqli_query($conn, $query_mcu);

    if (mysqli_num_rows($result_mcu) > 0) {
        $mcu = mysqli_fetch_assoc($result_mcu);
    } else {
        echo "MCU tidak ditemukan.";
    }
}

// Jika kategori MCU dipilih, ambil daftar MCU dengan kategori yang sama
if ($kategori_mcu) {
    $query_mcu_by_kategori = "SELECT * FROM mcu_data WHERE kategori = '$kategori_mcu'";
    $result_mcu_by_kategori = mysqli_query($conn, $query_mcu_by_kategori);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail MCU</title>
</head>
<body>
    <?php if (isset($mcu)): ?>
        <h2><?= $mcu['paket'] ?></h2>
        <p>Deskripsi: <?= $mcu['deskripsi'] ?></p>
        <p>Kategori: <?= $mcu['kategori'] ?></p>
        <p>Harga: <?= number_format($mcu['harga'], 0, ',', '.') ?></p>
    <?php endif; ?>

    <?php if (isset($kategori_mcu)): ?>
        <h2>MCU Kategori: <?= $kategori_mcu ?></h2>
        <?php if (mysqli_num_rows($result_mcu_by_kategori) > 0): ?>
            <ul>
                <?php while ($mcu_kategori = mysqli_fetch_assoc($result_mcu_by_kategori)): ?>
                    <li>
                        <h3><?= $mcu_kategori['paket'] ?></h3>
                        <p>Deskripsi: <?= $mcu_kategori['deskripsi'] ?></p>
                        <p>Kategori: <?= $mcu_kategori['kategori'] ?></p>
                        <p>Harga: <?= number_format($mcu_kategori['harga'], 0, ',', '.') ?></p>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Belum ada MCU di kategori ini.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
