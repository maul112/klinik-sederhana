<?php

session_start();

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(isset($_GET)) {
    $id = $_GET["id"];
    mysqli_query($conn, "DELETE FROM laboratory WHERE id = '$id'");
    header("Location: index.php");
    exit;
}

?>