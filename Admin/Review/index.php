<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

// Ambil data ulasan
$temp = mysqli_query($conn, "SELECT * FROM ulasan");
$hasil = mysqli_fetch_all($temp);

// Statistik jumlah review per kategori
$categoryStatsQuery = mysqli_query($conn, "
    SELECT category, COUNT(*) as count 
    FROM ulasan 
    GROUP BY category
");

// Statistik rata-rata rating
$averageRatingQuery = mysqli_query($conn, "
    SELECT AVG(rating) as avg_rating 
    FROM ulasan
");
$averageRating = mysqli_fetch_assoc($averageRatingQuery)['avg_rating'];

// Statistik distribusi rating
$ratingDistributionQuery = mysqli_query($conn, "
    SELECT 
        CASE 
            WHEN rating >= 4 THEN 'Positive'
            WHEN rating = 3 THEN 'Neutral'
            ELSE 'Negative'
        END as rating_category, 
        COUNT(*) as count 
    FROM ulasan 
    GROUP BY rating_category
");

// Format data untuk frontend
$categoryStats = [];
while ($row = mysqli_fetch_assoc($categoryStatsQuery)) {
    $categoryStats[] = $row;
}

$ratingDistribution = [];
while ($row = mysqli_fetch_assoc($ratingDistributionQuery)) {
    $ratingDistribution[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Clinic</title>
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
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


.sidebar-btn.active,
.sidebar-btn:hover {
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

.container {
    width: 90%;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

h1 {
    font-size: 24px;
    color: #333;
}

.add-pdf {
    background-color: #7A5AF8;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
}

hr {
    border: 0;
    border-top: 1px solid #ddd;
    margin: 20px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    text-align: center;
    padding: 15px;
}

th {
    background-color: #f8f8f8;
    font-weight: normal;
    color: #6c757d;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
}

td {
    border-bottom: 1px solid #ddd;
    color: #495057;
    font-size: 14px;
}

input[type="checkbox"] {
    margin: 0;
}
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    background: linear-gradient(274.42deg, #92A3FD 0%, #9DCEFF 124.45%);

}
.btn.replay a {
    background-color: #87baf4;
    color: #fff;
    font-weight: bold;
    border-radius: 2rem;
}
.btn.replay:hover{
    text-decoration: none;
}

.stats-container {
    margin-top: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.stats-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.stat {
    flex: 1 1 48%; /* Agar dua bagian menempati 48% lebar dan sejajar */
    min-width: 300px; /* Ukuran minimum untuk menjaga responsivitas */
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.stat h3 {
    margin-bottom: 10px;
    font-size: 1.2rem;
}

.stat canvas {
    width: 100%;
    height: auto;
}

/* Tambahkan media query untuk tampilan mobile */
@media (max-width: 768px) {
    .stats-grid {
        flex-direction: column;
    }

    .stat {
        flex: 1 1 100%; /* Setiap elemen memenuhi lebar pada layar kecil */
    }
}

    </style>
    
</head>

<body>
    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="../kitasehat logo 1.png" alt="Logo">
            <h1>KITA SEHAT</h1>
            <p>HEALTH SERVICE</p>
        </div>
        <a href="../Dashboard/index.php"><button class="sidebar-btn">Dashboard</button></a>
        <a href="../Medical Check Up/index.php"><button class="sidebar-btn">Medical Check Up</button></a>
        <a href="../Account/Admin Account.php"><button class="sidebar-btn">Account</button></a>
        <a href="../Labolatory/index.php"><button class="sidebar-btn">Laboratory</button></a>
        <a href="../Visit report/visitReport.php"><button class="sidebar-btn">Visit Report</button></a>
        <a href="../Pharmacy/farmasi.php"><button class="sidebar-btn">Pharmacy</button></a>
        <a href="../Review/index.php"><button class="sidebar-btn <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>">Review</button></a>
        <a href="../Kiat news/index.php"><button class="sidebar-btn">Kiat News</button></a>
        <a href="../Visit Report MCU/index.php"><button class="sidebar-btn">Visit Report MCU</button></a>
        <a href="../Visit Report LAB/index.php"><button class="sidebar-btn">Visit Report LAB</button></a>
    </div>
    <div class="main-content">
        <div class="container">
            <div class="header">
                <button class="sidebar-toggle"><img src="../Dashboard/hamburger-sidebar.svg" alt=""></button>
                <h1>Review</h1>
                <p></p>
            </div>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>USERNAME</th>
                        <th>CATEGORY</th>
                        <th>DESCRIPTION</th>
                        <th style="width: 25%;">REPLY</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php foreach ($hasil as $data) : ?>
                        <tr>
                            <td><?= $data[1] ?></td>
                            <td><?= $data[3] ?></td>
                            <td><?= $data[4] ?></td>
                            <?php if ($data[5] === "") : ?>
                                <td class="buttons">
                                    <button class="btn replay"><a style="color: #fff;" href="reply.php?id=<?= $data[0] ?>">Add Reply</a></button>
                                </td>
                            <?php else : ?>
                                <td><p><?= $data[5] ?></p></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <!-- Bagian Statistik -->
            <!-- Bagian Statistik -->
            <div class="stats-container">
                <h2>Review Statistics</h2>
                <div class="stats-grid">
                    <!-- Rata-rata rating -->
                    <div class="stat">
                        <h3>Average Rating</h3>
                        <p><?= round($averageRating, 2) ?> / 5</p>
                    </div>

                    <!-- Review per kategori -->
                    <div class="stat">
                        <h3>Reviews per Category</h3>
                        <canvas id="categoryChart"></canvas>
                    </div>

                    <!-- Distribusi rating -->
                    <div class="stat">
                        <h3>Rating Distribution</h3>
                        <canvas id="ratingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data kategori
        const categoryLabels = <?= json_encode(array_column($categoryStats, 'category')) ?>;
        const categoryCounts = <?= json_encode(array_column($categoryStats, 'count')) ?>;

        // Chart untuk kategori
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: 'Reviews per Category',
                    data: categoryCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data distribusi rating
        const ratingLabels = <?= json_encode(array_column($ratingDistribution, 'rating_category')) ?>;
        const ratingCounts = <?= json_encode(array_column($ratingDistribution, 'count')) ?>;

        // Chart untuk distribusi rating
        const ratingCtx = document.getElementById('ratingChart').getContext('2d');
        new Chart(ratingCtx, {
            type: 'pie',
            data: {
                labels: ratingLabels,
                datasets: [{
                    label: 'Rating Distribution',
                    data: ratingCounts,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 205, 86, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // JavaScript untuk Toggle Sidebar
        document.querySelector('.sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
            document.querySelector('.main-content').classList.toggle('sidebar-open');
        });
        src="style.js"
    </script>
</body>

</html>
