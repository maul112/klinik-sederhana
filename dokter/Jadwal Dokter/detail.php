<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../create_account.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil ID dari URL
$id_jadwal = $_GET['id'] ?? null;

// Periksa apakah id_jadwal tersedia
if ($id_jadwal) {
    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM jadwal_dokter WHERE id_jadwal = ?");
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $result = $stmt->get_result();
    $jadwal = $result->fetch_assoc();
} else {
    $jadwal = null;
}

// Proses pembaruan data jadwal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $hari_praktik = $_POST['hari_praktik'];
    $jam_praktik = $_POST['jam_praktik'];
    $status = $_POST['status'];

    // Menggunakan prepared statement untuk pembaruan data
    $stmt_update = $conn->prepare("UPDATE jadwal_dokter SET hari_praktik = ?, jam_praktik = ?, status = ? WHERE id_jadwal = ?");
    $stmt_update->bind_param("sssi", $hari_praktik, $jam_praktik, $status, $id_jadwal);

    if ($stmt_update->execute()) {
        // Redirect setelah update berhasil
        header("Location: index.php?id=" . $id_jadwal);
        exit;
    } else {
        echo "<p>Gagal memperbarui jadwal dokter.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jadwal Dokter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
            display: block;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"], select {
            background-color: #f9f9f9;
        }

        button {
            background-color: #9DCEFF ;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #92A3FD;
        }

        .form-group input, .form-group select {
            width: calc(100% - 34px);
        }

        .form-group select {
            width: calc(100%);
        }

        .form-group input {
            margin-left: 10px;
        }

        .form-group label {
            width: 150px;
            display: inline-block;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Jadwal Dokter</h1>

        <?php if ($jadwal): ?>
            <form action="" method="POST">
                <div class="form-container">
                    <div class="form-group">
                        <label for="hari_praktik"><strong>Hari Praktik:</strong></label>
                        <input type="text" name="hari_praktik" value="<?= htmlspecialchars($jadwal['hari_praktik']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jam_praktik"><strong>Jam Praktik:</strong></label>
                        <input type="text" name="jam_praktik" value="<?= htmlspecialchars($jadwal['jam_praktik']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="status"><strong>Status:</strong></label>
                        <select name="status" required>
                            <option value="Available" <?= $jadwal['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                            <option value="Unavailable" <?= $jadwal['status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="update">Update Jadwal</button>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <p>Data jadwal tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>
