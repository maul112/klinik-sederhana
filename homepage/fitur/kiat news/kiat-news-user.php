<?php
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Query untuk mengambil semua berita
$sql = "SELECT * FROM kiat_news ORDER BY news_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiat News - User View</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="../kitasehat logo 1.png" alt="Logo">
            <h1>KITA SEHAT</h1>
            <p>HEALTH SERVICE</p>
        </div>
        <a href="../Dashboard/index.php"><button class="sidebar-btn">Dashboard</button></a>
        <a href="../Medical Check Up/index.php"><button class="sidebar-btn">Medical Check Up</button></a>
        <a href="../Doctors/index.php"><button class="sidebar-btn">Doctors</button></a>
        <a href="../Labolatory/index.php"><button class="sidebar-btn">Laboratory</button></a>
        <a href="../Visit report/visitReport.php"><button class="sidebar-btn">Visit Report</button></a>
        <a href="../Pharmacy/farmasi.php"><button class="sidebar-btn">Pharmacy</button></a>
        <a href="../Review/index.php"><button class="sidebar-btn">Review</button></a>
        <a href="#"><button class="sidebar-btn active">Kiat News</button></a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Kiat News</h1>
            <div id="newsContainer">
                <!-- Menampilkan berita -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='news-item'>";
                        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                        echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($row['news_date']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";

                        // Cek jika ada link sumber
                        if (!empty($row['source_link'])) {
                            echo "<p><strong>Sumber:</strong> <a href='" . htmlspecialchars($row['source_link']) . "' target='_blank'>Baca Selengkapnya</a></p>";
                        }
                        
                        echo "</div>";
                    }
                } else {
                    echo "<p>Tidak ada berita untuk ditampilkan.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
