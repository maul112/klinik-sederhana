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

$upcomingAppointmentsQuery = mysqli_query($conn, "SELECT * FROM antrian WHERE status = 'upcoming'");

if (!$upcomingAppointmentsQuery) {
    die('Query failed: ' . mysqli_error($conn));
}

$todayDate = date('Y-m-d');
$todayAppointmentsQuery = mysqli_query($conn, "SELECT * FROM antrian WHERE status = 'upcoming' AND date = '$todayDate'");

if (!$todayAppointmentsQuery) {
    die('Query failed: ' . mysqli_error($conn));
}

$upcomingAppointments = mysqli_fetch_all($upcomingAppointmentsQuery, MYSQLI_ASSOC);
$todayAppointments = mysqli_fetch_all($todayAppointmentsQuery, MYSQLI_ASSOC);

$ambil_data = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($ambil_data);
$cekGambar = $hasil['gambar'];
$fotoProfile = "../userProfile/" . $cekGambar;
$nama = ($cekGambar === '') ? 'profile/Vector.png' : $fotoProfile;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f5f5f5;
            margin: 1px;
            padding: 0; 
            overflow-y: auto;
        }
        .container {
            margin: auto;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            position: fixed;
            left: -300px; /* Hidden by default */
            top: 0;
            width: 250px; /* Adjust width as needed */
            height: 100%;
            background-color: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 1000;
            overflow-y: auto; /* Ensure content is scrollable */
            padding: 20px; /* Add some padding for better appearance */
        }


        /* Sidebar open state */
        .sidebar.open {
            left: 0;
        }

        /* Sidebar logo styling */
        .sidebar .logo {
            text-align: center;
            margin: 20px 0;
        }

        .sidebar .logo img {
            width: 100px;
        }

        .sidebar .logo h1 {
            margin: 10px 0 0;
            font-size: 20px;
            color: #333;
        }

        .sidebar .logo p {
            font-size: 10px;
            color: #333;
        }

        /* Sidebar button styling */
        .sidebar-btn {
            display: block;
            width: 100%;
            padding: 15px;
            margin-bottom: 5px;
            background-color: #fff;
            border: none;
            cursor: pointer;
            text-align: left;
            font-size: 16px;
            color: #333;
            border-radius: 5px;
        }

        .sidebar-btn.active, .sidebar-btn:hover {
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
            color: #fff;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f5f5f5;
            transition: margin-left 0.3s ease;
            width: 100%; /* Full width initially */
            margin-left: 0; /* No margin initially */
        }

        body.sidebar-open .main-content {
            margin-left: 300px; /* Shifted when sidebar is open */
            width: calc(100% - 250px); /* Adjusted width when sidebar is open */
        }

        .sidebar-toggle {
            display: inline-block;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            margin-right: 20px; /* Space to the right of the button */
        }

        /* Header Styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative; /* Necessary for positioning notifications */
        }

        /* Profile Image Styling */
        .profile-img {
            border-radius: 50%;
            margin: 0 20px;
            width: 80px;  /* Smaller size to match layout */
            height: 80px;
            object-fit: cover; /* Ensures the image fits without distortion */
            cursor: pointer;
            border: 2px solid #e0e0e0; /* Add border for better visibility */
        }

        /* Hover Effect for Profile Image */
        .profile-img:hover {
            opacity: 0.8;
            transform: scale(1.05); /* Slight zoom on hover */
            transition: all 0.3s ease;
        }

        /* Notification Styling */
        .profile-notification {
            position: relative;
            display: flex;
            align-items: center;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px; /* Space between notification and profile */
        }

        /* Doctor Notification */
        .doctor-notification {
            top: 0;
            left: -20px; /* Adjust positioning to align with the profile */
            display: flex;
            align-items: center;
        }

        .notification-count {
            position: relative;
            top: -20px;
            right: 20px;
            background-color: #9DCEFF;
            color: red;
            font-size: 14px;
            font-weight: bold;
            border-radius: 50%;
            padding: 4px 8px;
            min-width: 15px;
            height: 20px;
            text-align: center;
            line-height: 20px; /* Ensures number is centered */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add shadow for better visibility */
        }

        .notification-icon {
            width: 30px; /* Adjust size for visibility */
            height: 35px;
            margin-left: 10px;
        }

        /* Header Stats */
        .header-stats {
            display: flex;
            gap: 20px;
            align-items: flex-end;
        }

        .stat {
            padding: 10px 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }
            .profile-img {
                width: 60px;
                height: 60px;
            }
            .notification-icon {
                width: 20px;
                height: 20px;
            }
            .header-stats {
                gap: 10px;
                flex-wrap: wrap;
            }
        }


        .requests-section {
            margin-top: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-nav {
            background-color: red !important;
            border: 2px solid black; /* Tambahkan border hitam */
            width: 100px; /* Ukuran sementara */
            height: 100px; /* Ukuran sementara */
            color: white; /* Teks agar terlihat */
            text-align: center;
        }


        .request-summary {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .search-bar {
            width: 88%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            display: none;
        }

        .filter {
            padding: 10px;
            background-color: #e0f7fa;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
            font-size: 16px;
            color: #007bff;
        }

        .filter-remove {
            cursor: pointer;
            color: #ff0000;
            margin-left: 10px;
        }

        .requests-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .requests-table th, .requests-table td {
            padding: 15px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 16px;
        }

        .status-btn, .assign-btn, .action-btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .status-btn {
            background-color: #e0f7fa;
            color: #92A3FD;
        }

        .assign-btn {
            background-color: #f0f0f0;
            color: #333;
        }

        .action-btn {
            background-color: #92A3FD;
            color: #ffffff;
        }

        .patient-details {
            margin-top: 20px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .patient-details h3 {
            margin-top: 0;
        }

        .patient-info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .patient-info strong {
            display: inline-block;
            width: 150px;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            body.sidebar-open .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        .main-content .requests-section .form {
            display: flex;
            margin-bottom: 1rem;
        }

        .form input, .form .search-btn {
            display: block;
            padding: 0.7rem 0;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.4);
            font-size: 1rem;
        }

        .form input {
            flex: 8;
            padding-left: 2rem;
            margin-right: 2rem;
        }

        .form .search-btn {
            flex: 1;
            font-weight: 800;
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
            transition: 0.5s;
        }

        .form .search-btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="kitasehat logo 1.png" alt="Logo">
            <h1>KITA SEHAT</h1>
            <p>HEALTH SERVICE</p>
        </div>
        <a href="#"><button class="sidebar-btn active">Dashboard</button></a>
        <a href="#"><button class="sidebar-btn">Jadwal Doctor</button></a>
        <a href="#"><button class="sidebar-btn">Visit Report</button></a>
    </div>
    <div class="main-content">
        <header>
            <button class="sidebar-toggle"><img src="hamburger-sidebar.svg" alt=""></button>
            <h2>Notification</h2>
            <div class="header-right">
                <div class="doctor-notification">
                    <a href="notif.php">
                        <img src="pngwing.com.png" alt="Notification" class="notification-icon">
                        <span class="notification-count"><?php echo count($todayAppointments); ?></span>
                    </a>
                </div>
                <div class="profile-notification">
                    <a href="profile/profile.php">
                        <img src="<?php echo $nama ?>" alt="Profile Picture" class="profile-img">
                    </a>
                </div>
            </div>
        </header>

        <div class="requests-section">
            <div class="requests-table">
                <h2>Today's Appointments</h2>
                <table class="notification-table">
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Jam</th>
                            <th>Keluhan</th>
                            <th>Poli</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($todayAppointments as $appointment) : ?>
                        <tr>
                            <td><?= $appointment['fullname'] ?></td>
                            <td><?= $appointment['hour'] ?></td>
                            <td><?= $appointment['keluhan'] ?></td>
                            <td><?= $appointment['poly'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="p.js"></script>
</body>
</html>
