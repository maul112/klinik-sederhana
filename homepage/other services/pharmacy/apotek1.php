<?php

session_start();

$username = $_SESSION['username'];

date_default_timezone_set("Asia/Jakarta");

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Ambil data kategori dari tabel medicine
$categories = mysqli_query($conn, "SELECT DISTINCT category FROM medicine");
$medications = mysqli_query($conn, "SELECT id, medname, category FROM medicine");

if(isset($_POST['addToCart'])) {
    $now = date("Y-m-d H:i:s");
    
    // ambil obat dengan status saran dokter
    $saranDokter = mysqli_query($conn, "SELECT * FROM med_cart WHERE username = '$username' AND status = 'saran dokter'");
    $saranDokter = mysqli_fetch_all($saranDokter, MYSQLI_ASSOC);
    foreach($saranDokter as $obatDariCart) {
        // ambil stock obat
        $medId = $obatDariCart['med_id'];
        $medCartId = $obatDariCart['id'];
        $getMedStock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM medicine WHERE id = '$medId'"))['stock'];
        if($getMedStock < $medQty) {
            $medQty = $getMedStock;
        }
        mysqli_query($conn, "UPDATE med_cart SET status = 'unpaid' WHERE id = '$medCartId'");
    }
    header("Location: ../cart/cart.php");
    exit;
}

// obat saran dokter

$obatSaranDokter = mysqli_query($conn, "SELECT * FROM med_cart JOIN medicine ON medicine.id = med_cart.med_id WHERE username = '$username' AND status = 'saran dokter'");
$obatSaranDokter = mysqli_fetch_all($obatSaranDokter, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHARMACY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>PHARMACY</h1>
        </header>
        <div class="grid">
            <a href="pills.php">
                <div class="card">
                    <div class="icon"><img src="assets-farm/pills.png" alt="Pills icon"></div>
                    <div class="content">
                        <h2>Pills</h2>
                    </div>
                </div>
            </a>
            <a href="External Medicine.php">
                <div class="card">
                    <div class="icon"><img src="assets-farm/external.png" alt="External Medicine icon"></div>
                    <div class="content">
                        <h2>External Medicine</h2>
                    </div>
                </div>
            </a>
            <a href="syrup.php">
                <div class="card">
                    <div class="icon"><img src="assets-farm/syrup.png" alt="Syrup icon"></div>
                    <div class="content">
                        <h2>Syrup</h2>
                    </div>
                </div>
            </a>
            <a href="Other Medications.php">
                <div class="card">
                    <div class="icon"><img src="assets-farm/other.png" alt="Other Medications icon"></div>
                    <div class="content">
                        <h2>ALL Medications</h2>
                    </div>
                </div>
            </a>
            <div class="upload-section">
                <h2>Upload Your Prescription</h2>
            </div>
            <br>
            <div class="card upload-card" onclick="document.getElementById('uploadModal').style.display='block'">
                <div class="icon"><img src="assets-farm/recipe.png" alt="Prescription icon"></div>
                <div class="content">
                    <h2>Have a Prescription?</h2>
                    <p>Upload here, and get medicines delivered.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="uploadModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('uploadModal').style.display='none'">&times;</span>
            <h2>Add Medication to Cart</h2>
            <ul>
                <?php foreach($obatSaranDokter as $data) : ?>
                <li><?= $data['medname'] ?> | <?= $data['qty'] ?> buah</li>
                <?php endforeach ?>
            </ul>
            <form action="" method="post">
                <button type="submit" name="addToCart" class="btn btn-primary btn-full-width">Add to Cart</button>
            </form>
        </div>
    </div>

    <script>
        // Script to close modal if clicked outside of modal content
        window.onclick = function(event) {
            if (event.target == document.getElementById('uploadModal')) {
                document.getElementById('uploadModal').style.display = "none";
            }
        }
    </script>
</body>
</html>
