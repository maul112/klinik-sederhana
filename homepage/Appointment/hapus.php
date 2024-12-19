<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if(isset($_GET["id"])) {
    if(isset($_POST['jenis'])) {
        if($_POST['jenis'] == "asdasmdajbdadnabbdasdnjab") {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM antrian WHERE id = '$id'");
        } elseif($_POST['jenis'] == "ksandbldakdNDKBdjBD") {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM mcu WHERE id = '$id'");
        } elseif($_POST['jenis'] == "kasjdbadnadjajdbadnjad") {
            $id = $_GET["id"];
            mysqli_query($conn, "DELETE FROM laboratory WHERE id = '$id'");
        }
    }
}
header("Location: ../");
exit;