<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

$hasil = mysqli_query($conn, "SELECT * FROM user_data");

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Table</title>
    <link rel="stylesheet" href="style.css">
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
        <a href="#"><button class="sidebar-btn active">Account</button></a>
        <a href="../Labolatory/index.php"><button class="sidebar-btn">Laboratory</button></a>
        <a href="../Pharmacy/farmasi.php"><button class="sidebar-btn">Pharmacy</button></a>
        <a href="../Review/index.php"><button class="sidebar-btn">Review</button></a>
        <a href="../Kiat news/index.php"><button class="sidebar-btn">Kiat News</button></a>
        <a href="../Transaksi/index.php"><button class="sidebar-btn">Transaksi</button></a>
        <a href="../Visit Report MCU/index.php"><button class="sidebar-btn">Visit Report MCU</button></a>
        <a href="../Visit Report LAB/index.php"><button class="sidebar-btn">Visit Report LAB</button></a>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="header">
                <button class="sidebar-toggle"><img src="../Dashboard/hamburger-sidebar.svg" alt="Menu"></button>
                <h1>Account</h1>
                <p></p>
            </div>
            <hr>
            <!-- <div class="category-container">
                <select id="categoryFilter" class="category-select" onchange="filterCategory()">
                    <option value="all">Category</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div> -->
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>User Name</th>
                        <th>Email</th>
                        <!-- <th>Category</th> -->
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($data = mysqli_fetch_assoc($hasil)) :?>
                        <tr>
                        <td><input type="checkbox"></td>
                            <td><?php echo $data['username']?></td>
                            <td><?php echo $data['email']?></td>
                            <td><?php echo $data['password']?></td>
                        </tr>
                    <?php endwhile?>
                </tbody>
                <!-- <tbody>
                    <tr data-category="admin">
                        <td><input type="checkbox"></td>
                        <td>Wiwik Ainun Janah</td>
                        <td>wiwikainun017@gmail.com</td>
                        <td>Admin</td>
                        <td>youcan123</td>
                    </tr>
                    <tr data-category="user">
                        <td><input type="checkbox"></td>
                        <td>Fatimah Azzahra</td>
                        <td>ftmhzhr015@gmail.com</td>
                        <td>User</td>
                        <td>bymee016</td>
                    </tr>
                    <tr data-category="admin">
                        <td><input type="checkbox"></td>
                        <td>Yasmin Azzahra</td>
                        <td>yasminazhr186@gmail.com</td>
                        <td>Admin</td>
                        <td>gntraa023</td>
                    </tr>
                    <tr data-category="user">
                        <td><input type="checkbox"></td>
                        <td>Maharani Putri M</td>
                        <td>mhrnputri049@gmail.com</td>
                        <td>User</td>
                        <td>mdrtkl142</td>
                    </tr>
                    <tr data-category="user">
                        <td><input type="checkbox"></td>
                        <td>Siti Khoirul M</td>
                        <td>stkhoirul068@gmail.com</td>
                        <td>User</td>
                        <td>mzrah064</td>
                    </tr>
                    <tr data-category="user">
                        <td><input type="checkbox"></td>
                        <td>Dewi Masitoh T</td>
                        <td>dewimsth091@gmail.com</td>
                        <td>User</td>
                        <td>trmuji003</td>
                    </tr>
                </tbody> -->
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
