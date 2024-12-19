<?php

session_start();

if(isset($_SESSION["keluhan"])) {
    unset($_SESSION["keluhan"]);
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
$username = $_SESSION['username'];
$temp = mysqli_query($conn, "SELECT * FROM antrian WHERE username = '$username' AND status = 'upcoming'");
// var_dump(mysqli_num_rows($temp)); die;
if(mysqli_num_rows($temp) > 3) {
    $jumlah = 3;
} else {
    $jumlah = mysqli_num_rows($temp);
}
$appointment = mysqli_fetch_all($temp);
// var_dump($appointment[1]); die;

if(!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

// Poli yang akan ditampilkan
$poli = 'General';

// Query untuk mendapatkan data dokter beserta jadwalnya
$sql = "SELECT 
            dokter.id, 
            dokter.fullname, 
            dokter.username, 
            dokter.poli, 
            dokter.gambar, 
            GROUP_CONCAT(CONCAT(jadwal_dokter.hari_praktik, ' (', jadwal_dokter.jam_praktik, ')') SEPARATOR ', ') AS jadwal,
            MIN(jadwal_dokter.status) AS status 
        FROM dokter 
        JOIN jadwal_dokter ON dokter.id = jadwal_dokter.id_dokter 
        WHERE dokter.poli = '$poli'
        GROUP BY dokter.id";

// Eksekusi query dan cek hasilnya
$result = $conn->query($sql);  
if (!$result) {
    die("Query error: " . $conn->error);
}

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
$nama = ($cekGambar === '')? 'profile/Vector.png' : $fotoProfile;

$countMedCart = mysqli_query($conn, "SELECT username FROM med_cart WHERE username = '$username' AND status = 'unpaid'");
$countMCUCart = mysqli_query($conn, "SELECT username FROM mcu WHERE username = '$username' AND status = 'unpaid'");
$countLabCart = mysqli_query($conn, "SELECT username FROM laboratory WHERE username = '$username' AND status = 'unpaid'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0; 
        }

        .container {
            margin: auto;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 6rem;
        }

        .navbar ion-icon {
            padding: 1rem;
            color: gray;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            margin: 0 1rem;
            width: 2.5rem;
            height: 2.5rem;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 50%;
            cursor: pointer;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px; /* Space between notification and profile */
        }

        .navbar-nav img {
            width: 3rem;
            height: 3rem;
            border-radius: 2rem;
        }

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

        .cart-icon {
            height: 30px;
            cursor: pointer;
        }

        

        .banner-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 4rem;
        }

        .banner-header h2 {
            color: #333;
            margin: 0;
        }

        .banner-header a {
            text-decoration: none;
            color: black;
            font-weight: 600;
            background-clip: content-box;
        }

        a {
            text-decoration: none;
            color: white;
            padding: 0.7rem;
            border-radius: 1rem;
            transition: 0.3s;
        }

        a:link {
            color: black;
        } 

        a:visited {
            color: #92A3FD;
        }

        a:active, a:focus {
            text-decoration: none;
            outline: none;
        }

        .header h1 {
            margin: 0;
        }

        .tabs {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            text-align: center;
        }

        .tab a:hover {
            background-color: #98bee9;
            color: black;
            text-decoration: none;
        }

        .tab.active {
            -webkit-text-fill-color: #4A90E2;
            border-bottom: 2px solid #4A90E2;
            font-weight: bold;
        } 

        #upcoming-appointments {
            margin: 0 50px;
        }

        .appointments {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            margin-top: 20px;
        }

        .appointment-card {
            background-color: #fff;
            border-radius: 15px;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(110, 19, 19, 0.1);
            padding: 10px;
            width: calc(27% - 20px);
        }

        .appointment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .appointment-header img {
            border-radius: 50%;
            margin: 0 20px;
            width: 100px;
            height: 100px;
        }

        .appointment-details {
            margin-right: 10px;
        }

        .appointment-details h2 {
            margin: 0;
            font-size: 18px;
        }

        .appointment-details .detail-container {
            display: flex;
            align-items: center;
        }

        .appointment-details .upcoming {
            color: #E59500;
            border: 2px;
            background-color: #f3e9d7;
            border-radius: 5px;
            padding: 2px 5px;
        }

        .appointment-details .completed {
            color: #18B23C;
            border: 2px;
            background-color: #e3f7e0;
            border-radius: 5px;
            padding: 2px 5px;
        }

        .appointment-details .spesialis {
            margin-right: 5px;
            color: #888;
        }

        .appointment-details .date-time {
            margin-top: 5px;
            color: #888;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn.cancel:hover {
            color: red;
            border: 2px solid red;
        }

        .btn.cancel {
            color: #888;
            border: 2px solid #888;
            font-weight: bold;
            border-radius: 2rem;
        }

        .btn.reschedule {
            background-color: #87baf4;
            color: #fff;
            font-weight: bold;
            border-radius: 2rem;
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
        }

        .btn a:hover {
            text-decoration: none;
        }

        /* other service */
        .services {
            margin: 40px 5rem;
        }

        h2 {
            margin-top: 20px;
            color: #333;
            margin-right: 1rem;
            margin-left: 2rem;
        }

        .service-icons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .rounded-image {
            border-radius: 200%;
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .no-hover {
            pointer-events: none;
        }

        .service-icon img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .service-icon h4 {
            font-size: 18px;
            text-align: center;
            margin: 5px 0;
            color: #333;
        }

        /* poli */
        .poli h2 {
            margin: 0 7rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 20px;
            margin: 0 7rem;
        }

        .card {
            display: flex;
            align-items: center;
            justify-content: center; /* Center the content horizontally */
            padding: 20px;
            background-color: white;
            border-radius: 20px;
            margin: 15px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            text-align: center; /* Center text */
            height: 6rem; /* Set a fixed height for the card */
        }

        .card:hover {
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
        }

        .card .content {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the content horizontally */
            justify-content: center; /* Center the content vertically */
        }

        a {
            text-decoration: none;
        }

        .card .content h2 {
            font-size: 20px;
            font-weight: 600;
            color: #2c2e3e;
            margin: 0; /* Remove default margin */
        }

        .card .content p {
            font-size: 16px;
            color: #737373;
            margin: 0; /* Remove default margin */
            margin-top: 5px; /* Add some space between h2 and p */
        }

        .card:hover .content h2 {
            color: #f4f4f9;
        }

        /* banner end */
        /* top doctor */
        .doctor-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .filters {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .filter-button {
            border: 1px solid #92A3FD;
            background-color: rgba(255, 255, 255, 0.252);
            padding: 10px 51px;
            margin: 0 20px;
            justify-content: space-evenly;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-button.active,
        .filter-button:hover {
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
            color: white;
        }

        .doctor-list {
            margin: 0 7rem;
            display: flex;
            flex-wrap: wrap;
        }

        .doctor-card {
            margin: 10px 10px;
            box-shadow: 0 4px 8px rgba(110, 19, 19, 0.1);
            width: calc(31% - 25px);
            background-color: #fff;
            border-radius: 15px;
            height: 12rem;
            padding: 10px;
            text-align: left;
            justify-content:space-between;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
        }

        .doctor-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }

        .doctor-info {
            flex: 1;
            margin: 0;
        }

        .doctor-card h2 {
            margin: 0;
            margin-top: 3px;
            font-size: 1.2em;
        }

        .doctor-card p {
            margin-top: 1px;
            color: #777;
            font-size: 0.9em;
        }

        .rating {
            display: flex;
            align-items: center;
        }

        .rating span:first-child {
            margin-right: 10px;
            color: #ffdd00;
        }

        /* kiat news */
        .news-section {
            background-color: white;
            padding: 50px 20px;
        }

        .news-section h2 {
            text-align: left;
            color: #333;
            margin: 10px 7rem;
        }
        h2 span {
            background: linear-gradient(90deg, #92A3FD, #9DCEFF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .news-container {
            margin: 0 7rem;
            display: flex;
            justify-content: space-between;
        }
        .news-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 350px;
            /* text-align: left; */
        }
        .news-card .date {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .news-card h3 {
            font-size: 20px;
            margin: 10px 0;
        }
        .news-card p {
            font-size: 16px;
            color: #555;
        }
        .news-card a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #92A3FD;
            font-weight: bold;
        }
        /* footer */
        footer {
            background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);
            color: #fff;
            padding: 40px 100px;
            text-align: center;
        }

        footer .contact-info {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        footer .contact-item {
            border-radius: 10px;
            margin: 15px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            border: 2px solid #00000039;
            box-sizing: border-box;
            flex: 1;
        }

        footer .contact-item img {
            margin: 10px;
        }

        footer p {
            margin: 10px;
            font-size: 13px;
        }

        footer h3 {
            font-size: 18px;
        }

        /* sidebar */
        .sidebar {
            position: fixed;
            left: -300px; /* Hidden by default */
            top: 0;
            width: 250px; /* Adjust width as needed */
            height: 100%;
            background-color: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease; /* Transition for smooth animation */
            z-index: 1000;
            overflow-y: auto;
            padding: 20px;
        }

        .sidebar.open {
            left: 0; /* Show sidebar when class .open is applied */
        }

        /* Sidebar logo styling */
        .sidebar .logo {
            text-align: center;
            margin: 20px 0;
        }

        .sidebar .logo img {
            width: 80px;
        }

        .sidebar .logo h2 {
            margin: 10px 0 0;
            font-size: 24px;
            color: #333;
        }

        /* Sidebar menu styling */
        .sidebar ul.menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul.menu li.menu-item {
            margin-bottom: 15px;
        }

        .sidebar ul.menu li.menu-item a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            display: block;
            transition: color 0.3s ease;
        }

        .sidebar ul.menu li.menu-item a:hover {
            color: #007BFF; /* Change to desired hover color */
        }

        .sidebar ul.menu li.menu-item.active a {
            font-weight: bold;
            color: #007BFF; /* Active link color */
        }
        .navbar {
            z-index: 1001; /* Make sure the navbar is above the sidebar */
        }

        .favorites-icon {
            width: 30px; /* Adjust the size of the icon */
            height: 30px;
            object-fit: contain;
            transition: transform 0.2s ease-in-out;
        }

        .favorites-icon:hover {
            transform: scale(1.1); /* Slight zoom effect on hover */
    }

    </style>
    <title>Homepage</title>
</head>
<body>
    <div class="navbar">
        <img src="assets/icons8-menu-50.png" alt="menu" id="sidebar-toggle">
        <div class="header-right">
            <div class="doctor-notification">
                <a href="notif">
                    <img src="assets/pngwing.com.png" alt="Notification" class="notification-icon">
                    <span class="notification-count"><?php echo count($todayAppointments); ?></span>
                </a>
                <a href="other services/cart/cart.php" class="cart-link">
                    <img src="assets/shopping-cart.png" alt="Cart" class="cart-icon">
                    <span class="notification-count"><?= mysqli_num_rows($countMedCart) + mysqli_num_rows($countMCUCart) + mysqli_num_rows($countLabCart) ?></span>
                </a>
                <a href="../homepage/other services/favorit.php" class="favorites-link">
                    <img src="assets/heart.jpg" alt="Favorites" class="favorites-icon">
                </a>
            </div>
            <div class="navbar-nav" style="background-image: url('<?php echo $nama?>');" onclick="document.location.href = 'profile/'"></div>
        </div>
    </div>
    <div id="upcoming-appointments">
        <div class="banner-header">
            <h2>UPCOMING APPOINTMENT</h2>
            <a href="Appointment/upcoming.php">SEE ALL</a>
        </div>
        <div class="appointments">
            <?php for($i = 0; $i < (int) $jumlah; $i++) :?>
            <div class="appointment-card">
                <div class="appointment-header">
                    <img src="other services/Doctors/doctor.png" alt="DR William Smith">
                    <div class="appointment-details">
                        <h2><?= $appointment[$i][7]?></h2>
                        <div class="detail-container">
                            <div class="spesialis"><?= $appointment[$i][6]?> |</div>
                            <div class="upcoming"><?= $appointment[$i][8]?></div>
                        </div>
                        <div class="date-time"><?= $appointment[$i][4]?> |  <?= $appointment[$i][5]?></div>
                    </div>
                </div>
                <div class="buttons">
                    <a href="Appointment/hapus.php?id=<?= $appointment[$i][0]?>" class="btn cancel pt-2">Cancel Booking</a>
                    <button class="btn reschedule"><a href="other services/book/book.php?id=<?= $appointment[$i][0]?>">Reschedule</a></button>
                </div>
            </div>
            <?php endfor?>
        </div>
    </div>
    <div class="container">
        <section class="services">
            <h2>OUR SERVICE</h2>
            <div class="service-icons">
                <div class="service-icon" onclick="window.location.href='other services/Doctors/indeks.php';">
                    <img src="assets/doctor-p.png" alt="doctor" class="rounded-image no-hover"> 
                    <br>
                    <h4>Doctor</h4>

                </div>
                <div class="service-icon" onclick="window.location.href='Appointment/upcoming.php';">
                    <img src="assets/appointment-p.png" alt="appointment"class="rounded-image no-hover">
                    <br>
                    <h4>Appointment</h4>
                </div>
                <div class="service-icon" onclick="window.location.href='other services/labolatory/labolatory.php';">
                    <img src="assets/labor-p.png" alt="labor" class="rounded-image no-hover">
                    <br>
                    <h4>Laboratory</h4>
                </div>                    
                <div class="service-icon" onclick="window.location.href='other services/MCU/indeks.php';">
                    <img src="assets/mcu-p.png" alt="mcu" class="rounded-image no-hover">
                    <br>
                    <h4>Medical Check Up</h4>
                </div>                    
                <div class="service-icon" onclick="window.location.href='fitur/Detail Clinic/detailClinic.php';">
                    <img src="assets/c-dets-p.png" alt="clinic detail"class="rounded-image no-hover">
                    <br>
                    <h4>Clinic Details</h4>
                </div>
                <div class="service-icon" onclick="window.location.href='other services/pharmacy/apotek1.php';">
                    <img src="assets/pharmacy-p.png" alt="pharmacy"class="rounded-image no-hover">
                    <br>
                    <h4>Pharmacy</h4>
                </div>
            </div>
        </section>
    </div>
    <div class="poli">
        <h2>POLI CLINIC</h2>
    <div class="grid" >
        <a href="other services/Doctors/indeks.php">
            <div class="card">
                <div class="content">
                    <h2>General</h2>
                    <p>General Polyclinic</p>
                </div>
            </div>
        </a>
        <a href="other services/Doctors/Gastroenteritis/indeks.php">
            <div class="card">
                <div class="content">
                    <h2>Gastroenteritis</h2>
                    <p>Gastroenteritis Polyclinic </p>
                </div>
            </div>
        </a>
        <a href="other services/Doctors/Cardiologist/indeks.php">
            <div class="card">
                <div class="content">
                    <h2>Cardiologist</h2>
                    <p>Cardiologist Polyclinic</p>
                </div>
            </div>
        </a>
        <a href="other services/Doctors/Orthopaedic/indeks.php">
            <div class="card">
                <div class="content">
                    <h2>Orthopaedic</h2>
                    <p>Orthopaedic Polyclinic
                    </p>
                </div>
            </div>
        </a>
        <a href="other services/Doctors/Dentist/indeks.php">
            <div class="card">
                <div class="content">
                    <h2>Dentist</h2>
                    <p>Dentist Polyclinic</p>
                </div>
            </div>
        </a>
        <a href="other services/Doctors/Otology/indeks.php">
            <div class="card">
                <div class="content">
                    <h2>Otology</h2>
                    <p>Otology Polyclinic</p>
                </div>
            </div>
        </a> 
    </div>
    <section class="top-doctors">
            <h2>DETAILS DOCTORS</h2>
            <div class="filters">
                <a href="other services/Doctors/indeks.php"><button class="filter-button active">General</button></a>
                <a href="other services/Doctors/Gastroenteritis/indeks.php"><button class="filter-button">Gastroenteritis</button></a>
                <a href="other services/Doctors/Cardiologist/indeks.php"><button class="filter-button">Cardiologist</button></a>
                <a href="other services/Doctors/Orthopaedic/indeks.php"><button class="filter-button">Orthopaedic</button></a>
                <a href="other services/Doctors/Dentist/indeks.php"><button class="filter-button">Dentist</button></a>
                <a href="other services/Doctors/Otology/indeks.html"><button class="filter-button">Otology</button></a>
            </div>
            <div class="doctor-list">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Path gambar dokter di folder userProfile
                        $gambarDokter = empty($row['gambar']) ? 'profile/Vector.png' : "../userProfile/" . htmlspecialchars($row['gambar']);
                        ?>
                        <div class="doctor-card">
                            <img src="<?php echo $gambarDokter; ?>" alt="<?php echo htmlspecialchars($row['fullname']); ?>">
                            <div class="doctor-info">
                                <a href="../../book/book.php?poly=Cardiologist&dokter=<?php echo urlencode($row['username']); ?>">
                                    <h2><?php echo htmlspecialchars($row['fullname']); ?></h2>
                                </a>
                                <p><?php echo htmlspecialchars($row['poli']); ?></p>
                                <p>Jadwal: <?php echo htmlspecialchars($row['jadwal']); ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Tidak ada dokter tersedia untuk kategori ini.</p>";
                }
                $conn->close();
                ?>
            </div>
        </section>
        <div class="news-section">
            <h2>KIAT <span>NEWS</span></h2>
            <div class="news-container">
                <div class="news-card" style="background-color: #9ecaf586;">
                    <div class="date">10 Desember 2024</div>
                    <h3>Mata Katarak: Penyebab, Gejala, dan Cara Mengobati</h3>
                    <p>katarak adalah penyebab utama kebutaan di dunia dan Indonesia. Data WHO 2002 menunjukkan 47,8% dari 37 juta orang buta menderita katarak, dengan jumlah penderita mencapai 94 juta pada 2020. Di Indonesia, 1,6 juta dari 8 juta orang dengan gangguan penglihatan pada 2017 mengalami kebutaan akibat katarak. Oleh karena itu penting untuk memahami gejala, penyebab, serta cara pengobatan dan pencegahan katarak.</p>
                    <a href="fitur/kiat news/index.php">READ MORE</a>
                </div>
                <div class="news-card" style="background-color: #b2adea71;">
                    <div class="date">09 September 2022</div>
                    <h3>Helping Seniors Learn New Hobbies</h3>
                    <p>Lorem ipsum dolor sit amet, vel te doming repudiare, eum nihil voluptatum ne, tollit.</p>
                    <a href="#">READ MORE</a>
                </div>
                <div class="news-card" style="background-color: #9ecaf586;">
                    <div class="date">09 September 2022</div>
                    <h3>Helping Seniors Learn New Hobbies</h3>
                    <p>Lorem ipsum dolor sit amet, vel te doming repudiare, eum nihil voluptatum ne, tollit.</p>
                    <a href="#">READ MORE</a>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="assets/kitasehat.png" alt="Kita Sehat Logo">
            <h2>KITA SEHAT</h2>
            <p>Health Service</p>
        </div>
        <ul class="menu">
            <li class="menu-item active"><a href="#home">Home</a></li>
            <li class="menu-item"><a href="Appointment/upcoming.php">Appointment</a></li>
            <li class="menu-item"><a href="other services/Doctors/indeks.php">Doctors</a></li>
            <li class="menu-item"><a href="profile/index.php">Profile</a></li>
            <li class="menu-item"><a href="fitur/cs/cs.php">Customer Service</a></li>
        </ul>
    </div>
    <footer>
        <div class="contact-info" id="contact">
            <div class="contact-item">
                <img src="../landing page/assets/phone.png" alt="">
                <div class="contact-p">
                    <h4>+91-022-67570111</h4>
                    <p>Call us now</p>
                </div>
            </div>
            <div class="contact-item">
                <img src="../landing page/assets/email.png" alt="">
                <div class="contact-p">
                    <h4>kitasehat@gmail.com</h4>
                    <p>Drop us an email</p>
                </div>
            </div>
            <div class="contact-item">
                <img src="../landing page/assets/location.png" alt="">
                <div class="contact-p">
                    <h4>Kenanga Ave. No. 34 Block H</h4>
                    <p>Our location</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>