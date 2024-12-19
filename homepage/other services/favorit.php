<?php
// Mulai sesi
session_start();

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$username = $_SESSION['username']; // Ambil username pengguna dari sesi

// Query untuk mendapatkan daftar dokter favorit (sudah disesuaikan)
$query_dokter = "
    SELECT d.id, d.fullname AS nama, d.poli, 
           GROUP_CONCAT(CONCAT(jd.hari_praktik, ' (', jd.jam_praktik, ')') SEPARATOR ', ') AS jadwal
    FROM favorites_dokter df
    INNER JOIN dokter d ON df.dokter_id = d.id
    LEFT JOIN jadwal_dokter jd ON d.id = jd.id_dokter
    WHERE df.username = '$username'
    GROUP BY d.id
";
$result_dokter = mysqli_query($conn, $query_dokter);
// Query untuk mendapatkan daftar MCU favorit (sudah disesuaikan)
$query_mcu = "
    SELECT m.paket, m.deskripsi, m.harga, m.kategori, m.id
    FROM mcu_data m
    WHERE m.id IN ('" . implode(",", $_SESSION['favorites'] ?? []) . "')
";
$result_mcu = mysqli_query($conn, $query_mcu);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 40px auto;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            color: #2C3E50;
            margin-bottom: 20px;
            border-bottom: 2px solid #92A3FD;
            display: inline-block;
            padding-bottom: 5px;
        }

        .dokter-list, .mcu-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .dokter-item, .mcu-item {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dokter-item:hover, .mcu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        h3 {
            font-size: 1.5rem;
            color: #34495E;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            color: #7F8C8D;
            margin: 5px 0;
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #92A3FD;
            margin-top: 10px;
        }

        .price::before {
            content: "Rp ";
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #92A3FD;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #6a7ff5;
        }

        /* Empty State Styles */
        .empty-state {
            font-size: 1.2rem;
            color: #95A5A6;
            margin-top: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .container {
                width: 95%;
            }
        }
    </style>
    <title>Favorit - Dokter dan MCU</title>
</head>
<body>
    <div class="container">
        <h2>Favorit Dokter</h2>
        <?php if (mysqli_num_rows($result_dokter) > 0): ?>
            <div class="dokter-list">
                <?php while ($dokter = mysqli_fetch_assoc($result_dokter)): ?>
                    <div class="dokter-item">
                        <h3><?= $dokter['nama'] ?></h3>
                        <p>Poli: <?= $dokter['poli'] ?></p>
                        <p>Jadwal: <?= $dokter['jadwal'] ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Belum ada dokter favorit.</p>
        <?php endif; ?>

        <h2>Favorit MCU</h2>
        <?php if (mysqli_num_rows($result_mcu) > 0): ?>
            <div class="mcu-list">
                <?php while ($mcu = mysqli_fetch_assoc($result_mcu)): ?>
                    <div class="mcu-item">
                        <h3><?= $mcu['paket'] ?></h3>
                        <p>Deskripsi: <?= $mcu['deskripsi'] ?></p>
                        <p>Kategori: <?= $mcu['kategori'] ?></p>
                        <p>Harga: <?= number_format($mcu['harga'], 0, ',', '.') ?></p>       
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Belum ada MCU favorit.</p>
        <?php endif; ?>
    </div>
</body>
</html>