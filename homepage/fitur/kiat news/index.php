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
    <title>Kiat News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: left;
            padding: 20px 0;
        }
        .header h1 {
            font-size: 36px;
            margin: 0;
            color: #333;
        }
        .header h1 span {
            color: #9b8af7;
        }
        .content {
            text-align: left;
            margin-bottom: 20px;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background-color: #cce0ff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1;
            min-width: 280px;
            max-width: 300px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card h3 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        .card p {
            font-size: 14px;
            color: #666;
        }
        .card .date {
            font-size: 14px;
            color: #999;
            margin-bottom: 10px;
        }
        .card .read-more {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #fff;
            color: #666;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: background-color 0.2s, color 0.2s;
        }
        .card .read-more:hover {
            background-color: #9b8af7;
            color: #fff;
            border-color: #9b8af7;
        }
        @media (max-width: 768px) {
    .grid {
        flex-direction: column;
        align-items: center;
    }
    .card {
        max-width: 100%;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KIAT <span>NEWS</span></h1>
        </div>
        <div class="content">
    <p>
        Selamat datang di <strong>Kiat News Klinik Kita Sehat!</strong><br>
        Di edisi pertama ini, kami hadir dengan berbagai informasi kesehatan yang bermanfaat untuk Anda dan keluarga. Klinik Kita Sehat selalu berkomitmen untuk memberikan pelayanan kesehatan terbaik dan terpercaya, dan Kiat News adalah cara kami untuk berbagi pengetahuan, tips, serta informasi terbaru seputar dunia kesehatan.<br>
        Kami berharap artikel-artikel dalam Kiat News ini dapat membantu Anda menjaga kesehatan secara optimal dan memperkenalkan berbagai layanan yang kami tawarkan di klinik.<br>
        Dari tips kesehatan sehari-hari hingga informasi medis terkini, Kiat News hadir sebagai sumber referensi yang dapat diandalkan. Mari terus ikuti kami, dan temukan berbagai informasi yang dapat mendukung perjalanan sehat Anda bersama Klinik Kita Sehat!
    </p>
</div>

<div class="grid">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card' style='background-color: #d8c1ff;'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p><strong>Tanggal:</strong> " . $row['news_date'] . "</p>";
            echo "<p>" . substr($row['description'], 0, 100) . "...</p>"; // Menampilkan sebagian deskripsi
            echo "<a href='kiat news detail.php?id=" . $row['id'] . "' class='read-more'>Read More</a>"; // Link ke halaman detail
            echo "</div>";
        }
    } else {
        echo "<p>Tidak ada berita untuk ditampilkan.</p>";
    }
    ?>
    </div> <!-- Menutup div.card -->
</div> <!-- Menutup div.grid -->


</body>
</html>

