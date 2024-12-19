<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Menghapus berita berdasarkan ID
    $sql = "DELETE FROM kiat_news WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php"); // Kembali ke halaman daftar berita
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
