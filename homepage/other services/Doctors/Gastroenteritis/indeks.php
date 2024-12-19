<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_klinik");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan user login
session_start();
if (!isset($_SESSION['username'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}

$username = $_SESSION['username'];

// Poli yang akan ditampilkan
$poli = 'Gastroenteritis';

// Query untuk mendapatkan data dokter beserta jadwalnya
$sql = "SELECT 
            dokter.id, 
            dokter.fullname, 
            dokter.username, 
            dokter.poli, 
            dokter.gambar, 
            GROUP_CONCAT(CONCAT(jadwal_dokter.hari_praktik, ' (', jadwal_dokter.jam_praktik, ')') SEPARATOR ', ') AS jadwal
        FROM dokter 
        JOIN jadwal_dokter ON dokter.id = jadwal_dokter.id_dokter 
        WHERE dokter.poli = '$poli'
        GROUP BY dokter.id";

if (isset($_POST['toggle_favorite'])) {
    $dokter_id = $_POST['dokter_id']; // Ambil dokter_id dari form

    // Periksa apakah dokter sudah ada di favorit
    $check_favorite = mysqli_query($conn, "SELECT * FROM favorites_dokter WHERE username = '$username' AND dokter_id = '$dokter_id'");
    
    if (mysqli_num_rows($check_favorite) > 0) {
        // Jika sudah favorit, hapus dari favorit
        mysqli_query($conn, "DELETE FROM favorites_dokter WHERE username = '$username' AND dokter_id = '$dokter_id'");
    } else {
        // Jika belum favorit, tambahkan ke favorit
        mysqli_query($conn, "INSERT INTO favorites_dokter (username, dokter_id) VALUES ('$username', '$dokter_id')");
    }
}

// Eksekusi query dan cek hasilnya
$result = $conn->query($sql);
if (!$result) {
    die("Query error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>DOCTORS</h1>
        </header>
        <div class="filters">
            <a href="../indeks.php"><button class="filter-button">General</button></a>
            <a href="../Gastroenteritis/indeks.php"><button class="filter-button active">Gastroenteritis</button></a>
            <a href="../Cardiologist/indeks.php"><button class="filter-button">Cardiologist</button></a>
            <a href="../Orthopaedic/indeks.php"><button class="filter-button">Orthopaedic</button></a>
            <a href="../Dentist/indeks.php"><button class="filter-button">Dentist</button></a>
            <a href="../Otology/indeks.php"><button class="filter-button">Otology</button></a>
        </div>
        <div class="doctor-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Path gambar dokter
                    $gambarDokter = empty($row['gambar']) ? 'profile/Vector.png' : "../../../../userProfile/" . htmlspecialchars($row['gambar']);

                    // Cek apakah dokter ini ada di favorit
                    $dokter_id = $row['id'];
                    $favorite_check = $conn->query("SELECT * FROM favorites_dokter WHERE username = '$username' AND dokter_id = '$dokter_id'");
                    $is_favorite = $favorite_check->num_rows > 0;
                    $favorite_class = $is_favorite ? 'favorited' : '';
                    ?>
                    <div class="doctor-card">
                        <img src="<?php echo $gambarDokter; ?>" alt="<?php echo htmlspecialchars($row['fullname']); ?>">
                        <div class="doctor-info">
                            <a href="../../book/book.php?poli=Cardiologist&dokter=<?php echo urlencode($row['username']); ?>">
                                <h2><?php echo htmlspecialchars($row['fullname']); ?></h2>
                            </a>
                            <p><?php echo htmlspecialchars($row['poli']); ?></p>
                            <p>Jadwal: <?php echo htmlspecialchars($row['jadwal']); ?></p>
                        </div>
                        <form method="POST" action="indeks.php">
                            <input type="hidden" name="dokter_id" value="<?php echo $dokter_id; ?>">
                            <button type="submit" name="toggle_favorite" class="favorite-button <?php echo $favorite_class; ?>">
                                <?php echo $is_favorite ? '❤️ Remove from Favorites' : '❤️ Add to Favorites'; ?>
                            </button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Tidak ada dokter tersedia untuk kategori ini.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
