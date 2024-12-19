<?php
session_start();

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek koneksi database
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Cek apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

// Ambil ID berita yang ingin diedit dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validasi ID berita
if ($id <= 0) {
    echo "ID berita tidak valid.";
    exit;
}

// Ambil data berita berdasarkan ID
$sql = "SELECT * FROM kiat_news WHERE id = $id";
$result = mysqli_query($conn, $sql);

// Periksa apakah data berita ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Berita tidak ditemukan.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['newsTitle']);
    $description = mysqli_real_escape_string($conn, $_POST['newsDescription']);
    $newsDate = mysqli_real_escape_string($conn, $_POST['newsDate']);
    $sourceLink = mysqli_real_escape_string($conn, $_POST['sourceLink']);

    // Validasi input
    if (!empty($title) && !empty($description) && !empty($newsDate) && filter_var($sourceLink, FILTER_VALIDATE_URL)) {
        // Update berita berdasarkan ID
        $updateSql = "UPDATE kiat_news 
                      SET title = '$title', 
                          description = '$description', 
                          news_date = '$newsDate', 
                          source_link = '$sourceLink' 
                      WHERE id = $id";

        if (mysqli_query($conn, $updateSql)) {
            header("Location: index.php"); // Redirect ke halaman admin setelah mengupdate berita
            exit;
        } else {
            echo "Terjadi kesalahan saat memperbarui data: " . mysqli_error($conn);
        }
    } else {
        echo "Pastikan semua data diisi dengan benar dan link sumber valid.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <style>
        /* Gaya sederhana untuk form */
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .form-container .cancel {
            background-color: #f44336;
            margin-left: 10px;
        }
        .form-container .cancel:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Berita</h2>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST">
            <label for="newsTitle">Judul Berita:</label>
            <input type="text" id="newsTitle" name="newsTitle" value="<?php echo htmlspecialchars($row['title']); ?>" required>

            <label for="newsDescription">Deskripsi:</label>
            <textarea id="newsDescription" name="newsDescription" rows="5" required><?php echo htmlspecialchars($row['description']); ?></textarea>

            <label for="newsDate">Tanggal Berita:</label>
            <input type="date" id="newsDate" name="newsDate" value="<?php echo htmlspecialchars($row['news_date']); ?>" required>

            <label for="sourceLink">Link Sumber:</label>
            <input type="url" id="sourceLink" name="sourceLink" value="<?php echo htmlspecialchars($row['source_link']); ?>" required>

            <button type="submit" name="submitNews">Update Berita</button>
            <button type="button" class="cancel" onclick="window.location.href='index.php';">Batal</button>
        </form>
    </div>
</body>
</html>
