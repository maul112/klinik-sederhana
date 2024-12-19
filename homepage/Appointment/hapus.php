<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if(!isset($_GET["id"])) {
    header("Location: ../");
    exit;
} else {
    $id = $_GET["id"];
    mysqli_query($conn, "DELETE FROM antrian WHERE id = '$id'");
    header("Location: ../");
    exit;
}
?>