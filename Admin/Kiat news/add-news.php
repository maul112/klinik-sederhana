<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek apakah form sudah disubmit
if (isset($_POST['submitNews'])) {
    $title = mysqli_real_escape_string($conn, $_POST['newsTitle']);
    $description = mysqli_real_escape_string($conn, $_POST['newsDescription']);
    $newsDate = mysqli_real_escape_string($conn, $_POST['newsDate']);
    $sourceLink = mysqli_real_escape_string($conn, $_POST['sourceLink']); // Menangkap input link sumber berita

    // Menyimpan data berita ke database, termasuk link sumber
    $sql = "INSERT INTO kiat_news (title, description, news_date, source_link) 
            VALUES ('$title', '$description', '$newsDate', '$sourceLink')";

    if (mysqli_query($conn, $sql)) {
        header("Location: kiat-news-admin.php"); // Redirect ke halaman admin setelah menambah berita
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
