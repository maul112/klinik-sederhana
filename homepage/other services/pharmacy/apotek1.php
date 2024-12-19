<?php
// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Ambil data kategori dari tabel medicine
$categories = mysqli_query($conn, "SELECT DISTINCT category FROM medicine");
$medications = mysqli_query($conn, "SELECT id, medname, category FROM medicine");
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
            <form method="POST" action="../cart/cart.php">
                <label for="medication_name">Medication Name:</label>
                <select id="medication_name" name="medication_name" required>
                    <option value="">-- Select Medication --</option>
                    <?php while ($row = mysqli_fetch_assoc($medications)): ?>
                        <option value="<?= htmlspecialchars($row['id']) ?>">
                            <?= htmlspecialchars($row['medname']) ?> (<?= htmlspecialchars($row['category']) ?>)
                        </option>
                    <?php endwhile; ?>
                </select><br>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required><br>

                <button type="submit" class="btn btn-primary btn-full-width">Add to Cart</button>
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
