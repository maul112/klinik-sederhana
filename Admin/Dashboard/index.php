<?php

session_start();

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
$temp = mysqli_query($conn, "SELECT * FROM antrian WHERE status = 'upcoming'");
$jml = mysqli_fetch_all($temp);

$temp2 = mysqli_query($conn, "SELECT * FROM mcu WHERE status = 'upcoming'");
$jml2 = mysqli_fetch_all($temp2);

$temp3 = mysqli_query($conn, "SELECT * FROM laboratory WHERE status = 'upcoming'");
$jml3 = mysqli_fetch_all($temp3);

if(isset($_POST["search"])) {
    $keyword = $_POST["keyword"];
    if($keyword !== "") {
        $cariData = mysqli_query($conn, "SELECT * FROM antrian WHERE fullname LIKE '%$keyword%' OR poly LIKE '%$keyword%' AND status = 'upcoming'");
        $jml = mysqli_fetch_all($cariData);
    }
}

if(isset($_POST["searchmcu"])) {
    $keyword = $_POST["keywordmcu"];
    if($keyword !== "") {
        $cariData = mysqli_query($conn, "SELECT * FROM mcu WHERE fullname LIKE '%$keyword%' OR title LIKE '%$keyword%' AND status = 'upcoming'");
        $jml2 = mysqli_fetch_all($cariData);
    }
}

if(isset($_POST["searchlab"])) {
    $keyword = $_POST["keywordlab"];    
    if($keyword !== "") {
        $cariData = mysqli_query($conn, "SELECT * FROM laboratory WHERE fullname LIKE '%$keyword%' OR title LIKE '%$keyword%' AND status = 'upcoming'");
        $jml3 = mysqli_fetch_all($cariData);
    }
}

if(isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_unset();
    session_destroy();
    echo "<script>
        alert('Anda berhasil Log Out');
        document.location.href = '../../masuk/Sign in Page/sign-in.php';
    </script>";
    exit;
}

// Ambil data transaksi dan totalnya
$query = "SELECT tanggal_transaksi, SUM(total_harga) AS total_harga 
          FROM transaksi 
          GROUP BY tanggal_transaksi 
          ORDER BY tanggal_transaksi";
$result = mysqli_query($conn, $query);

// Array untuk menyimpan data grafik
$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['tanggal_transaksi']; // Menyimpan tanggal
    $data[] = (int) $row['total_harga']; // Menyimpan total transaksi
}

// Mengonversi array ke format JSON agar bisa digunakan oleh Chart.js
$labels = json_encode($labels);
$data = json_encode($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="../kitasehat logo 1.png" alt="Logo">
            <h1>KITA SEHAT</h1>
            <p>HEALTH SERVICE</p>
        </div>
        <a href="#"><button class="sidebar-btn active">Dashboard</button></a>
        <a href="../Medical Check Up/index.php"><button class="sidebar-btn">Medical Check Up</button></a>
        <a href="../Account/Admin Account.php"><button class="sidebar-btn">Account</button></a>
        <a href="../Labolatory/index.php"><button class="sidebar-btn">Laboratory</button></a>
        <a href="../Pharmacy/farmasi.php"><button class="sidebar-btn">Pharmacy</button></a>
        <a href="../Review/index.php"><button class="sidebar-btn">Review</button></a>
        <a href="../Kiat news/index.php"><button class="sidebar-btn">Kiat News</button></a>
        <a href="../Transaksi/index.php"><button class="sidebar-btn">Transaksi</button></a>
        <a href="../Visit Report MCU/index.php"><button class="sidebar-btn">Visit Report MCU</button></a>
        <a href="../Visit Report LAB/index.php"><button class="sidebar-btn">Visit Report LAB</button></a>
    </div>
    <div class="main-content">
        <header>
            <button class="sidebar-toggle"><img src="hamburger-sidebar.svg" alt=""></button>
            <h2>Welcome back, Admin</h2>
            <a href="index.php?logout=true" class="logout">Log Out</a>
        </header>
        <div class="requests-section">
        <div class="row">
        <div class="card mt-4">
        <div class="card-header" style="background: linear-gradient(45deg,  #92A3FD , #9DCEFF); color: #fff; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); border-radius: 3px; padding: 20px">
            Grafik Transaksi
        </div>

            <div class="card-body">
                <canvas id="transaksiChart" width="700" height="200"></canvas>
            </div>
        </div>
        </div>
        </div>

    <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        const transaksiChart = new Chart(ctx, {
            type: 'line', // Jenis grafik: garis
            data: {
                labels: <?php echo $labels; ?>, // Tanggal transaksi
                datasets: [{
                    label: 'Total Transaksi (Rp)', // Label untuk grafik
                    data: <?php echo $data; ?>, // Total harga per tanggal
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang area grafik
                    borderColor: 'rgba(75, 192, 192, 1)', // Warna garis grafik
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true, // Responsif terhadap ukuran layar
                scales: {
                    y: {
                        beginAtZero: true, // Mulai dari angka 0
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString(); // Format mata uang
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            font: {
                                size: 14 // Ukuran font untuk legenda
                            }
                        }
                    }
                }
            }
        });
    </script>
        <div class="requests-section">
            <h1>Appointment</h1>
            <h3>Your Requests</h3>
            <div class="request-summary">
                <div><?= count($jml)?> Total Upcoming Requests</div>
            </div>
            <form action="" class="form" method="post">
                <input type="text" placeholder="Search" name="keyword" class="search-field" autocomplete="off">
                <button type="submit" name="search" class="search-btn">Search</button>
            </form>
            <div class="requests-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Keluhan</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jml as $jm) :?>
                        <tr>
                            <td><?= $jm[2]?></td>
                            <td><?= $jm[3]?></td>
                            <td><?= $jm[4]?></td>
                            <td><?= $jm[5]?></td>
                            <td><?= $jm[6]?></td>
                            <td><?= $jm[7]?></td>
                            <td><?= $jm[8]?></td>
                            <td><button class="action-btn"><a href="complete.php?id=<?= $jm[0]?>" onclick="return confirm('Apakah anda yakin ingin mengubah status pasien');">complete</a></button></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="requests-section">
            <h1>MEDICAL CHECK UP</h1>
            <h3>Your Requests</h3>
            <div class="request-summary">
                <div><?= count($jml2)?> Total Upcoming Requests</div>
            </div>
            <form action="" class="form" method="post">
                <input type="text" placeholder="Search" name="keywordmcu" class="search-field" autocomplete="off">
                <button type="submit" name="searchmcu" class="search-btn">Search</button>
            </form>
            <div class="requests-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Nama Paket</th>
                            <th>Harga Paket</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jml2 as $jm) :?>
                        <tr>
                            <td><?= $jm[2]?></td>
                            <td><?= $jm[3]?></td>
                            <td><?= $jm[4]?></td>
                            <td><?= $jm[5]?></td>
                            <td><button class="action-btn"><a href="hapusmcu.php?id=<?= $jm[0]?>" onclick="return confirm('Apakah anda yakin ingin mengubah status pasien');">complete  </a></button></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="requests-section">
            <h1>LABORATORY</h1>
            <h3>Your Requests</h3>
            <div class="request-summary">
                <div><?= count($jml3)?> Total Upcoming Requests</div>
            </div>
            <form action="" class="form" method="post">
                <input type="text" placeholder="Search" name="keywordlab" class="search-field" autocomplete="off">
                <button type="submit" name="searchlab" class="search-btn">Search</button>
            </form>
            <div class="requests-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Nama Paket</th>
                            <th>Harga Paket</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jml3 as $jm) :?>
                        <tr>
                            <td><?= $jm[2]?></td>
                            <td><?= $jm[3]?></td>
                            <td><?= $jm[4]?></td>
                            <td><?= $jm[5]?></td>
                            <td><button class="action-btn"><a href="hapuslab.php?id=<?= $jm[0]?>" onclick="return confirm('Apakah anda yakin ingin mengubah status pasien');">complete  </a></button></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="p.js"></script>
</body>
</html>