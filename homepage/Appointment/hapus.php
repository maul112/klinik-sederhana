<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if(isset($_GET["id"])) {
    if(isset($_GET['jenis'])) {
        if($_GET['jenis'] == "asdasmdajbdadnabbdasdnjab") {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM antrian WHERE id = '$id'");
        } elseif($_GET['jenis'] == "ksandbldakdNDKBdjBD") {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM mcu WHERE id = '$id'");
        } elseif($_GET['jenis'] == "kasjdbadnadjajdbadnjad") {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM laboratory WHERE id = '$id'");
        }
    }
}
header("Location: ./upcoming.php");
exit;