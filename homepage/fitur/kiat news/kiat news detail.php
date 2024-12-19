<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Berita - Klinik Kita Sehat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="sticky-top">
        <div class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a href="./index.html" class="navbar-brand d-flex align-items-center">
                    <img src="/KLINIK/klinik_kesehatan/homepage/fitur/sidebar/kitasehat.png" width="100" class="mr-auto" alt="Logo Klinik Kita Sehat" />
                    <div>
                        <h1 class="mb-1">Klinik Kita Sehat</h1>
                        <small>Kenanga Ave. No. 34 Block H</small>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container mt-5">
            <div class="row">
                <!-- Detail Berita -->
                <div class="col-md-9">
                <?php
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek parameter 'id'
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Perbarui jumlah views
    $sql_update = "UPDATE kiat_news SET views = views + 1 WHERE id = $id";
    mysqli_query($conn, $sql_update);

    // Ambil detail berita
    $sql = "SELECT * FROM kiat_news WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // Tampilkan detail berita
        echo "<div class='card shadow-sm rounded-3 mb-4'>";
        echo "<div class='card-body'>";
        echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
        echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($row['news_date']) . "</p>";
        echo "<p><strong>Jumlah Views:</strong> " . htmlspecialchars($row['views']) . "</p>";
        
        // Link Sumber (tambah pengecekan)
        if (!empty($row['source_link'])) {
            echo "<p><strong>Sumber:</strong> <a href='" . htmlspecialchars($row['source_link']) . "' target='_blank'>Klik di sini</a></p>";
        } else {
            echo "<p><strong>Sumber:</strong> Tidak tersedia</p>";
        }

        echo "<div class='d-flex justify-content-end mt-3 mb-4'>";
        echo "<h5 class='me-3'>Bagikan:</h5>";
        echo "<a href='https://www.facebook.com/sharer/sharer.php?u=" . urlencode($currentURL) . "' target='_blank' class='btn btn-sm btn-primary me-2'>Facebook</a>";
        echo "<a href='https://twitter.com/intent/tweet?url=" . urlencode($currentURL) . "&text=" . urlencode($row['title']) . "' target='_blank' class='btn btn-sm btn-info me-2'>Twitter</a>";
        echo "<a href='https://api.whatsapp.com/send?text=" . urlencode($row['title'] . " " . $currentURL) . "' target='_blank' class='btn btn-sm btn-success'>WhatsApp</a>";
        echo "</div>";
        echo "<p>" . nl2br(htmlspecialchars($row['description'])) . "</p>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>Berita tidak ditemukan.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>ID berita tidak valid.</div>";
}

mysqli_close($conn);
?>

                </div>

                <!-- Sidebar Berita Lain -->
                <div class="col-md-3">
                    <h5>Berita Lainnya</h5>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
                    $sql_sidebar = "SELECT id, title, news_date FROM kiat_news WHERE id != $id ORDER BY news_date DESC LIMIT 5";
                    $result_sidebar = mysqli_query($conn, $sql_sidebar);

                    if ($result_sidebar && mysqli_num_rows($result_sidebar) > 0) {
                        while ($sidebar_news = mysqli_fetch_assoc($result_sidebar)) {
                            echo "<div class='card mb-3'>";
                            echo "<div class='card-body'>";
                            echo "<h6 class='card-title'>" . htmlspecialchars($sidebar_news['title']) . "</h6>";
                            echo "<p><small>" . htmlspecialchars($sidebar_news['news_date']) . "</small></p>";
                            echo "<a href='kiat-news-detail.php?id=" . $sidebar_news['id'] . "' class='btn btn-sm btn-outline-primary'>Read More</a>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Tidak ada berita lainnya.</p>";
                    }

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
