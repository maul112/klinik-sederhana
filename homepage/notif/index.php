<?php
session_start();

// Ensure the user is logged in
if(!isset($_SESSION['username'])) {
    header("Location: ../create_account.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

// Get today's date and tomorrow's date
$todayDate = date('Y-m-d');
$tomorrowDate = date('Y-m-d', strtotime("+1 day"));

// Query for upcoming appointments for today and tomorrow (H and H+1)
$upcomingAppointmentsQuery = mysqli_query($conn, "SELECT * FROM antrian WHERE status = 'upcoming' AND (date = '$todayDate' OR date = '$tomorrowDate')");

if (!$upcomingAppointmentsQuery) {
    die('Query failed: ' . mysqli_error($conn));
}

$upcomingAppointments = mysqli_fetch_all($upcomingAppointmentsQuery, MYSQLI_ASSOC);

// Fetch user data (for profile picture, name, and user_id)
$ambil_data = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($ambil_data);
$cekGambar = $hasil['gambar'];
$fotoProfile = "../userProfile/" . $cekGambar;
$nama = ($cekGambar === '') ? 'profile/Vector.png' : $fotoProfile;
$user_id = $hasil['id'];  // Get user_id from user_data

// Check if health history is filled using user_id
$healthHistoryQuery = mysqli_query($conn, "SELECT * FROM riwayat_kesehatan WHERE user_id = '$user_id'");
$healthHistory = mysqli_fetch_assoc($healthHistoryQuery);
$healthHistoryReminder = empty($healthHistory) ? true : false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        /* General Reset and Font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .notification-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .notification-item {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .notification-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .notification-item p {
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }

        .appointment-time {
            font-weight: bold;
            color: #007bff;
        }

        .health-history-reminder {
            background-color: #9DCEFF;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            color: #d9534f;
            display: flex;
            align-items: center;
        }

        .health-history-reminder p {
            margin-left: 10px;
            font-weight: bold;
        }

        .notification-item .appointment-time {
            font-size: 18px;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Notifications</h2>

        <!-- Upcoming Appointments Notifications -->
        <div class="notification-title">Upcoming Appointments</div>
        <?php if (count($upcomingAppointments) > 0): ?>
            <?php foreach($upcomingAppointments as $appointment): ?>
                <div class="notification-item">
                    <p><strong>Patient:</strong> <?= $appointment['fullname'] ?></p>
                    <p><strong>Time:</strong> <span class="appointment-time"><?= $appointment['hour'] ?></span></p>
                    <p><strong>Complaint:</strong> <?= $appointment['keluhan'] ?></p>
                    <p><strong>Poli:</strong> <?= $appointment['poly'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No upcoming appointments for today or tomorrow.</p>
        <?php endif; ?>

        <!-- Health History Reminder -->
        <?php if ($healthHistoryReminder): ?>
            <div class="health-history-reminder">
                <i class="fa fa-exclamation-circle" style="font-size: 24px;"></i>
                <p><strong>Reminder :</strong> Isi riwayat kesehatan Anda untuk diagnosis yang lebih baik.</p>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>
