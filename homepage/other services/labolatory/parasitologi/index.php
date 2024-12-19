<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$temp = mysqli_query($conn, "SELECT * FROM lab_data WHERE kategori = 'Parasitology'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LABORATORY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>LABORATORY</h1>
        </header>
        <div class="filters">
            <a href="../mikrobiologi/indeks.php"><button class="filter-button">Mikrobiology</button></a>
            <a href="../anatomi/indeks.php"><button class="filter-button">Anatomy</button></a>
            <a href="../blood/indeks.php"><button class="filter-button">Blood</button></a>
            <a href="../biomolekuler/indeks.php"><button class="filter-button">Biomolekuler</button></a>
            <a href="../patology/indeks.php"><button class="filter-button">Patology</button></a>
            <a href="../parasitologi/index.php"><button class="filter-button active">Parasitology</button></a>
        </div>
        <div class="cards">
            <?php while($data = mysqli_fetch_assoc($temp)) : ?>
            <div class="card">
                <a href="../book.php?laboratory=<?= $data['id'] ?>">
                    <h2><?php echo htmlspecialchars($data['paket']); ?></h2>
                </a>
                <ul>
                    <?php
                    // Mengambil deskripsi sebagai array
                    $deskripsi_items = explode(', ', $data['deskripsi']);
                    foreach ($deskripsi_items as $item) {
                        echo '<li>' . htmlspecialchars($item) . '</li>';
                    }
                    ?>
                </ul>
                <p class="price">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
