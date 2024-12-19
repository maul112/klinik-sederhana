<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

if(isset($_GET["balik"])) {
    header("Location: farmasi.php");
    exit;
}

if(isset($_POST["hapus"])) {
    $id = $_POST["id"];
    mysqli_query($conn, "DELETE FROM medicine WHERE id = '$id'");
    header("Location: farmasi.php");
    exit;
}

if(!isset($_POST["id"])) {
    header("Location: farmasi.php");
    exit;
}

$id = $_POST["id"];
$temp = mysqli_query($conn, "SELECT * FROM medicine WHERE id = '$id'");
$result = mysqli_fetch_assoc($temp);

if(isset($_POST["editt"])) {
    $id = $_POST["id"];
    $newName = $_POST["medname"];
    $newCategory = $_POST["category"];
    $newStock = $_POST["stock"];
    mysqli_query($conn, "UPDATE medicine SET
            medname = '$newName',
            category = '$newCategory',
            stock = '$newStock'
            WHERE id = '$id'
    ");
    header("Location: farmasi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div id="obatForm" class="modal" style="display: block;">
        <div class="modal-content">
            <h2>Edit Medicines</h2>
            <form id="newobatForm" method="post">
                <label for="obatName">Medicine Name:</label>
                <input type="hidden" name="id" value="<?= $result["id"]?>">
                <input type="text" id="obatName" name="medname" required value="<?= $result["medname"]?>"><br>
                <label for="obatCategory">Category:</label>
                <select id="obatCategory" name="category" required>
                    <option value="<?= $result["category"]?>"><?= $result["category"]?></option>
                    <option value="Pills">Pills</option>
                    <option value="Syrup">Syrup</option>
                    <option value="External Medications">External Medication</option>
                </select><br>
                <label for="stock">Stock:</label>
                <input type="text" id="stock" name="stock" required value="<?= $result["stock"]?>"><br>
                <button type="submit" name="editt">Save</button>
            </form>
        </div>
    </div>
</body>
</html>