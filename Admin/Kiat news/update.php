<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek apakah form sudah disubmit untuk update berita
if (isset($_POST['submitNews'])) {
    $id = mysqli_real_escape_string($conn, $_POST['newsId']); // Mengambil ID berita
    $title = mysqli_real_escape_string($conn, $_POST['newsTitle']);
    $description = mysqli_real_escape_string($conn, $_POST['newsDescription']);
    $newsDate = mysqli_real_escape_string($conn, $_POST['newsDate']);
    $sourceLink = mysqli_real_escape_string($conn, $_POST['sourceLink']); // Link sumber berita

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
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    } else {
        echo "Pastikan semua data diisi dengan benar dan link sumber valid.";
    }
} else {
    echo "Form tidak disubmit dengan benar.";
}
?>
