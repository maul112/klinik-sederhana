<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$temp = mysqli_query($conn, "SELECT * FROM medicine");
$hasil = mysqli_fetch_all($temp);

if(isset($_POST["addmed"])) {
    $medname = $_POST["medname"];
    $category = $_POST["category"];
    $stock = $_POST["stock"];
    mysqli_query($conn, "INSERT INTO medicine VALUES ('', '$medname', '$category', '$stock')");
    header("Location: edit.php?balik=gas");
    exit;
}

if(isset($_POST["filter"]) && $_POST["filtername"] !== "") {
    $filtername = $_POST["filtername"];
    $filterTemp = mysqli_query($conn, "SELECT * FROM medicine WHERE category = '$filtername'");
    $hasil = mysqli_fetch_all($filterTemp);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy</title>
    <link rel="stylesheet" href="farmasi.css">
</head>
<body>
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="../kitasehat logo 1.png" alt="Logo">
            <h1>KITA SEHAT</h1>
            <p>HEALTH SERVICE</p>
        </div>
        <a href="../Dashboard/index.php"><button class="sidebar-btn">Dashboard</button></a>
        <a href="../Medical Check Up/index.php"><button class="sidebar-btn">Medical Check Up</button></a>
        <a href="../Account/Admin Account.php"><button class="sidebar-btn">Account</button></a>
        <a href="../Labolatory/index.php"><button class="sidebar-btn">Laboratory</button></a>
        <a href="#"><button class="sidebar-btn active">Pharmacy</button></a>
        <a href="../Review/index.php"><button class="sidebar-btn">Review</button></a>
        <a href="../Kiat news/index.php"><button class="sidebar-btn">Kiat News</button></a>
        <a href="../Transaksi/index.php"><button class="sidebar-btn">Transaksi</button></a>
        <a href="../Visit Report MCU/index.php"><button class="sidebar-btn">Visit Report MCU</button></a>
        <a href="../Visit Report LAB/index.php"><button class="sidebar-btn">Visit Report LAB</button></a>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="header">
                <button class="sidebar-toggle"><img src="../Dashboard/hamburger-sidebar.svg" alt=""></button>
                <h1>Pharmacy</h1>
                <button class="add-pdf" onclick="openForm()">+ Add Medicine</button>
            </div>
            <hr>
            <div class="category">
                <form method="post">
                    <select id="categoryFilter" name="filtername" class="category-button">
                        <option value="">Category</option>
                        <option value="Pills">Pills</option>
                        <option value="Syrup">Syrup</option>
                        <option value="External Medications">External Medications</option>
                    </select>
                    <button name="filter" type="submit" class="filterbtn">Set Filter</button>
                </form>

            </div>
            <div id="tableContainer">
                <table>
                    <thead>
                        <tr>
                            <th>MEDICINE NAME</th>
                            <th>CATEGORY</th>
                            <th>STOCK</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach($hasil as $data) : ?>
                        <tr data-category="Syrup">
                            <td><?= $data[1]?></td>
                            <td><?= $data[2]?></td>
                            <td><?= $data[3]?></td>
                            <td>
                                <form action="edit.php" method="post" class="form-btn">
                                    <input type="hidden" value="<?= $data[0]?>" name="id">
                                    <button type="submit" name="edit" class="btn btn-save">Edit</button>
                                    <button type="submit" name="hapus" class="btn btn-delete">Hapus</button>
                                </form> 
                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form for Adding New Doctor -->
        <div id="obatForm" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeForm()">&times;</span>
                <h2>Add Medicines</h2>
                <form id="newobatForm" method="post">
                    <label for="obatName">Medicine Name:</label>
                    <input type="text" id="obatName" name="medname" required><br>
                    <label for="obatCategory">Category:</label>
                    <select id="obatCategory" name="category" required>
                        <option value="">Category</option>
                        <option value="Pills">Pills</option>
                        <option value="Syrup">Syrup</option>
                        <option value="External Medications">External Medication</option>
                    </select><br>
                    <label for="stock">Stock:</label>
                    <input type="text" id="stock" name="stock" required><br>
                    <button type="submit" name="addmed">Add Medicines</button>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
