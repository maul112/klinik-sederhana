<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

$username = $_SESSION['username'];

// Cek jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: ../../../masuk/Create Account/create-account.php");
    exit;
}

if (isset($_GET["mcu"])) {
    $id = $_GET["mcu"];
    $hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mcu_data WHERE id = '$id'"));
} else {
    header("Location: ./indeks.php");
    exit;
}

if(isset($_POST['submit'])) {
    $mcuId = $_POST['id'];
    $getUser = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
    $getUser = mysqli_fetch_assoc($getUser);

    $getMCU = mysqli_query($conn, "SELECT * FROM mcu_data WHERE id = '$mcuId'");
    $getMCU = mysqli_fetch_assoc($getMCU);

    // ambil nomor antrian
    $tempDate = $_POST['date'];
    $title = $getMCU['paket'];
    $getNoAntrian = mysqli_query($conn, "SELECT * FROM mcu WHERE title = '$title' AND date LIKE '$tempDate%' ORDER BY date DESC LIMIT 1;");
    if(mysqli_num_rows($getNoAntrian) != 0) {
        $getNoAntrian = (int)mysqli_fetch_assoc($getNoAntrian)['no_antrian'] + 1;
    } else {
        $getNoAntrian = 1;
    }

    $fullname = $getUser['fullname'];
    $harga = $getMCU['harga'];
    $status = "unpaid";
    $date = $_POST['date'] . " " . $_POST['hour'];
    $cek = mysqli_query($conn, "INSERT INTO mcu VALUES (null, '$username', '$fullname', '$title', '$harga', '$status', '$date', '$getNoAntrian', null, null, null, null)");
    if($cek) {
        header("Location: ../cart/cart.php");
        exit;
    }
}

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
    <div class="header">
        <h1>MCU Appointment</h1>
    </div>
    <form method="post">
        <input type="hidden" name="id" value="<?= $hasil['id']?>">
        <div class="calendar">
            <h3>Select Date</h3>
            <input type="hidden" value="<?= $poli?>" name="poli">
            <input type="hidden" value="<?= $dokter?>" name="dokter">
            <input type="date" name="date">
        </div>
        <div class="time-slots">
            <h3>Select Time</h3>
            <select name="hour" id="time">
                <option selected disabled>Pilih Jam</option>
                <option value="09:30:00">09:30 AM</option>
                <option value="10:00:00">10:00 AM</option>
                <option value="10:30:00">10:30 AM</option>
                <option value="11:00:00">11:00 AM</option>
                <option value="11:30:00">11:30 AM</option>
                <option value="14:00:00">14:00 PM</option>
                <option value="14:30:00">14:30 PM</option>
                <option value="15:00:00">15:00 PM</option>
            </select>
        </div>
        <div class="next-btn">
            <button name="submit" type="submit">Next</button>
        </div>
    </form>
</div>

</body>
</html>
