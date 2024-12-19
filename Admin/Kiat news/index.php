<?php
session_start();

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Redirect jika belum login
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
    <title>Kiat News</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Fungsi untuk menampilkan form tambah berita
        function showAddNewsForm() {
            document.getElementById('addNewsForm').style.display = 'block';
        }

        // Fungsi untuk menyembunyikan form tambah berita
        function hideAddNewsForm() {
            document.getElementById('addNewsForm').style.display = 'none';
        }
    </script>
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
        <a href="../Kiat news/index.php"><button class="sidebar-btn active">Kiat News</button></a>
        <a href="#"><button class="sidebar-btn">Transaksi</button></a>
        <a href="../Visit Report MCU/index.php"><button class="sidebar-btn">Visit Report MCU</button></a>
        <a href="../Visit Report LAB/index.php"><button class="sidebar-btn">Visit Report LAB</button></a>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="header">
                <button class="sidebar-toggle"><img src="../Dashboard/hamburger-sidebar.svg" alt=""></button>
                <h1>Kiat News</h1>
                <!-- Tombol untuk Menambah Berita -->
                <button class="add-pdf" onclick="showAddNewsForm()">+ Add News</button>
            </div>
            
            <!-- Form untuk Menambah Berita -->
            <div id="addNewsForm" class="add-news-form" style="display: none;">
                <h2>Tambah Berita</h2>
                <form action="add-news.php" method="POST">
                    <label for="newsTitle">Judul Berita:</label>
                    <input type="text" id="newsTitle" name="newsTitle" required><br>

                    <label for="newsDescription">Deskripsi:</label>
                    <textarea id="newsDescription" name="newsDescription" rows="4" cols="50" required></textarea><br>

                    <label for="newsDate">Tanggal Berita:</label>
                    <input type="date" id="newsDate" name="newsDate" required><br>

                    <label for="sourceLink">Sumber Berita (URL):</label>
                    <input type="url" id="sourceLink" name="sourceLink" placeholder="https://contoh.com"><br>

                    <button type="submit" name="submitNews">Tambah Berita</button>
                    <button type="button" onclick="hideAddNewsForm()">Cancel</button>
                </form>
            </div>
            
            <!-- Tabel Menampilkan Berita -->
            <div id="tableContainer">
                <table>
                    <thead>
                        <tr>
                            <th>Judul Berita</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>View Count</th>
                            <th>Sumber</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="newsTableBody">
    <?php
    // Query untuk mengambil berita
    $sql = "SELECT id, title, description, news_date, views, source_link FROM kiat_news ORDER BY news_date DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars(substr($row['description'], 0, 50)) . "...</td>";
            echo "<td>" . htmlspecialchars($row['news_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['views']) . "</td>";
            echo "<td><a href='" . htmlspecialchars($row['source_link']) . "' target='_blank'>Lihat Sumber</a></td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <form action='delete.php' method='POST' style='display:inline;' onsubmit='return confirm(\"Yakin ingin menghapus data ini?\");'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Tidak ada berita.</td></tr>";
    }
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
