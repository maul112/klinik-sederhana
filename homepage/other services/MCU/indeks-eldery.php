<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if (!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

// Inisialisasi sesi favorit jika belum ada
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// Cek jika ada aksi tambah atau hapus favorit
if (isset($_POST['toggle_favorite'])) {
    $mcu_id = $_POST['mcu_id'];

    // Cek apakah paket sudah ada di favorit
    if (in_array($mcu_id, $_SESSION['favorites'])) {
        // Jika sudah favorit, hapus dari favorit
        $_SESSION['favorites'] = array_diff($_SESSION['favorites'], [$mcu_id]);
    } else {
        // Jika belum favorit, tambahkan ke favorit
        $_SESSION['favorites'][] = $mcu_id;
    }
}

// Ambil data kategori Eldery
$temp = mysqli_query($conn, "SELECT * FROM mcu_data WHERE kategori = 'Eldery'");

if (!$temp) {
    die("Kueri gagal: " . mysqli_error($conn)); // Tambahkan debugging untuk kueri
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Check Up</title>
    <link rel="stylesheet" href="styles-eldery.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>MEDICAL CHECK UP</h1>
        </header>
        <div class="filters">
            <a href="indeks-hearth.php"><button class="filter-button">Heart</button></a>
            <a href="indeks-children.php"><button class="filter-button">Children</button></a>
            <a href="index-travelling.php"><button class="filter-button">Travelling</button></a>
            <a href="indeks-eldery.php"><button class="filter-button active">Eldery</button></a>
            <a href="indeks-prewed.php"><button class="filter-button">Pre-Wedding</button></a>
            <a href="indeks-general.php"><button class="filter-button">General MCU</button></a>
        </div>
        <div class="cards">
            <?php while($data = mysqli_fetch_assoc($temp)) : ?>
            <?php
                $mcu_id = $data['id'];
                
                // Cek apakah paket sudah menjadi favorit
                $is_favorite = in_array($mcu_id, $_SESSION['favorites']);
                $favorite_class = $is_favorite ? 'favorited' : ''; // Menambahkan kelas jika sudah favorit
            ?>
            <div class="card">
                <a href="./book.php?mcu=<?= $mcu_id ?>">
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

                <!-- Tombol favorit -->
                <form method="POST" action="">
                    <input type="hidden" name="mcu_id" value="<?php echo $mcu_id; ?>">
                    <button type="submit" name="toggle_favorite" class="favorite-button <?php echo $favorite_class; ?>">
                        <?php echo $is_favorite ? '❤ Remove from Favorites' : '❤ Add to Favorites'; ?>
                    </button>
                </form>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>