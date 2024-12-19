<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM antrian WHERE id = $id");

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lanjutkan Kunjungan</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            width: 90%;
            max-width: 500px;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        label {
            font-size: 1.1rem;
            color: #555;
            display: block;
            margin-bottom: 1.5rem;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
        }

        button, a {
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-align: center;
        }

        .btn-green {
            background-color: #28a745;
            color: #fff;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .btn-red {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-red:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lanjutkan Kunjungan</h1>
        <form method="post">
            <label for="reply">Apakah Anda ingin melanjutkan kunjungan?</label>
            <div class="btn-container">
                <a href="bookvisit.php?id=<?= $row['id']?>" class="btn-green">Ya</a>
                <a href="visitReport.php" class="btn-red">Tidak</a>
            </div>
        </form>
    </div>
</body>
</html>
