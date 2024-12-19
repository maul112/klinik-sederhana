<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: ../../../masuk/Create Account/create-account.php");
    exit;
}

$mode;

if (isset($_GET["poli"]) || isset($_GET["dokter"])) {
    $poli = $_GET["poli"];
    $dokter = $_GET["dokter"];
    $mode = "insert";
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $mode = "change";
    $hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM antrian WHERE id = '$id'"));
}

if (isset($_POST["change"])) {
    $date = $_POST["date"];
    $hour = $_POST["hour"];
    $id = $_POST["id"];
    mysqli_query($conn, "UPDATE antrian SET
        date = '$date',
        hour = '$hour'
        WHERE id = '$id'
    ");
    header("Location: ../upcoming.php");
    exit;
}

if (isset($_POST["next"])) {
    $date = $_POST["date"];
    $hour = $_POST["hour"];
    $poli = $_POST["poli"];
    $dokter_nama = $_POST["dokter"]; // Nama dokter dari form
    $keluhan = $_POST["keluhan"];

    // Cari ID dokter berdasarkan nama
    $result = mysqli_query($conn, "SELECT id FROM dokter WHERE nama = '$dokter_nama'");
    $dokter_row = mysqli_fetch_assoc($result);

    if (!$dokter_row) {
        die("Dokter tidak ditemukan.");
    }

    $dokter_id = $dokter_row['id']; // Ambil ID dokter

    // Lakukan INSERT ke tabel antrian
    $query = "INSERT INTO antrian (date, hour, poli, dokter, keluhan)
              VALUES ('$date', '$hour', '$poli', $dokter_id, '$keluhan')";

    if (mysqli_query($conn, $query)) {
        header("Location: ../pembayaran/PAYMENT.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$paket = isset($_GET['paket']) ? $_GET['paket'] : '';
$harga = isset($_GET['harga']) ? $_GET['harga'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            color: #6cb3f5;
            margin-bottom: 30px;
        }

        .profile-card {
            background: linear-gradient(135deg, #e5edfe, #f0f4ff);
            padding: 20px;
            border-radius: 15px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details h2 {
            font-size: 1.5rem;
            color: #333;
            margin: 0;
        }

        .profile-details p {
            font-size: 1rem;
            color: #555;
            margin: 5px 0;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .stats div {
            flex: 1;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .calendar, .time-slots, .complaint {
            background: #f9fbfd;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .calendar h3, .time-slots h3, .complaint h3 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #6cb3f5;
        }

        .time-slots select, .calendar input, .complaint textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .next-btn button {
            width: 100%;
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            border: none;
            border-radius: 15px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                text-align: center;
            }

            .stats div {
                flex: 1 1 calc(50% - 10px);
            }

            .next-btn button {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <form method="post" action="../pembayaran/PAYMENT.php">
        <input type="hidden" name="paket" value="<?= htmlspecialchars($paket) ?>">
        <input type="hidden" name="harga" value="<?= htmlspecialchars($harga) ?>">
        
        <div class="calendar">
            <h3>Select Date</h3>
            <input type="date" name="date" required>
        </div>
        <div class="time-slots">
            <h3>Select Time</h3>
            <select name="hour" id="time" required>
                <option value="" disabled selected>Select Time</option>
                <option value="09:30 AM">09:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="11:30 AM">11:30 AM</option>
                <option value="14:00 PM">14:00 PM</option>
                <option value="14:30 PM">14:30 PM</option>
                <option value="15:00 PM">15:00 PM</option>
            </select>
        </div>
        <div class="next-btn">
            <button type="submit">Next</button>
        </div>
    </form>
</div>

</body>
</html>
