<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
} else {
    $id = $_GET["id"];
    mysqli_query($conn, "UPDATE antrian SET status = 'completed' WHERE id = '$id'");
    header("Location: index.php");
    exit;
}
?>