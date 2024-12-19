<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$temp = mysqli_query($conn, "SELECT * FROM lab_data");
$hasil = mysqli_fetch_all($temp, MYSQLI_ASSOC);

if (isset($_POST["addmed"])) {
    $paket = $_POST["paket"];
    $deskripsi = $_POST["deskripsi"];
    $kategori = $_POST["kategori"];
    $harga = $_POST["harga"];
    
    // Sanitize input data to prevent SQL injection
    $paket = mysqli_real_escape_string($conn, $paket);
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);
    $kategori = mysqli_real_escape_string($conn, $kategori);
    $harga = mysqli_real_escape_string($conn, $harga);
    
    // Insert data into database
    $query = "INSERT INTO lab_data (paket, deskripsi, kategori, harga) VALUES ('$paket', '$deskripsi', '$kategori', '$harga')";
    mysqli_query($conn, $query);
    
    // Redirect back to the page after adding the packet
    header("Location: index.php?balik=gas");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory</title>
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
        <a href="../Account/Admin Account.php"><button class="sidebar-btn">Account</button></a>
        <a href="#"><button class="sidebar-btn active">Laboratory</button></a>
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
                <button class="sidebar-toggle"><img src="../Dashboard/hamburger-sidebar.svg" alt=""></button>
                <h1>LABORATORY</h1>
                <button class="add-pdf" onclick="openForm()">+ Add Packet</button>
            </div>
            <hr>
            <div class="category">
                <select id="categoryFilter" class="category-button" onchange="filterCategory()">
                    <option value="all">Category</option>
                    <option value="Mikrobiologi">Mikrobiologi</option>
                    <option value="Anatomy">Anatomy</option>
                    <option value="Blood">Blood</option>
                    <option value="Biomolekuler">Biomolekuler</option>
                    <option value="Patology">Patology</option>
                    <option value="Parasitology">Parasitology</option>
                </select>
            </div>
            <div id="tableContainer">
                <table>
                    <thead>
                        <tr>
                            <th>PACKET</th>
                            <th>DESCRIPTION</th>
                            <th>CATEGORY</th>
                            <th>PRICE</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach($hasil as $data) : ?>
                        <tr data-category="<?php echo htmlspecialchars($data['kategori']); ?>">
                            <td><?php echo htmlspecialchars($data['paket']); ?></td>
                            <td class="description">
                                <ul>
                                    <?php
                                    // Mengambil deskripsi sebagai array
                                    $deskripsi_items = explode(', ', $data['deskripsi']);
                                    foreach ($deskripsi_items as $item) {
                                        echo '<li>' . htmlspecialchars($item) . '</li>';
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td><?php echo htmlspecialchars($data['kategori']); ?></td>
                            <td><?php echo 'Rp ' . number_format($data['harga'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="packetForm" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeForm()">&times;</span>
                <h2>Add New Packet</h2>
                <form id="newPacketForm" method="post" action="index.php">
                    <label for="paket">Packet Name:</label>
                    <input type="text" id="paket" name="paket" required><br>
                    <label for="deskripsi">Description:</label>
                    <textarea id="deskripsi" name="deskripsi" required></textarea><br>
                    <label for="kategori">Category:</label>
                    <select id="kategori" name="kategori" required>
                        <option value="Mikrobiologi">Mikrobiologi</option>
                        <option value="Anatomy">Anatomy</option>
                        <option value="Blood">Blood</option>
                        <option value="Biomolekuler">Biomolekuler</option>
                        <option value="Patology">Patology</option>
                        <option value="Parasitology">Parasitology</option>
                    </select><br>
                    <label for="harga">Price:</label>
                    <input type="text" id="harga" name="harga" required><br>
                    <button type="submit" name="addmed">Add Packet</button>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>