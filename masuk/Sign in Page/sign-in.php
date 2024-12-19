<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Cek jika koneksi gagal
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_SESSION['username'])) {
    header("Location: ../../homepage/index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan user berdasarkan email dan password
    $query_user = "SELECT * FROM user_data WHERE LOWER(email) = LOWER('$email') AND password = '$password'";

    // Jalankan query
    $temp = mysqli_query($conn, $query_user);

    // Cek jika query gagal dijalankan
    if (!$temp) {
        echo "Error query: " . mysqli_error($conn);
        exit;
    }

    // Ambil hasil query
    $hasil = mysqli_fetch_assoc($temp);

    if (!$hasil) {
        echo "<script>
            alert('Anda belum terdaftar! Silahkan buat akun terlebih dahulu');
            document.location.href = '../Create Account/create-account.php';
        </script>";
        exit;
    }
    $_SESSION["username"] = $hasil['username'];
    $_SESSION["role"] = $hasil['role'];

    $query_dokter = "SELECT * FROM dokter WHERE email= LOWER('$email')";

    $result_dokter = mysqli_query($conn, $query_dokter);
    $dokter = mysqli_fetch_assoc($result_dokter);

    if ($dokter) {
        header("Location: ../../dokter/index.php");
        exit;
    }

    if ($hasil['role'] == '1') {
        header("Location: ../../homepage/index.php");
    } elseif ($hasil['role'] == '2') {
        header("Location: ../../Admin/Dashboard/index.php");
    } else {
        echo "<script>
            alert('Role tidak valid!');
            document.location.href = '../Create Account/create-account.php';
        </script>";
    }
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
        --primary: #92a3df;
        --secondary: #9dceff;
        --purple: #c58bf2;
        --pink: #eea4ce;
        --black: #1d1617;
        }

        * {
        margin: 0;
        padding: 0;
        border: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif; /* Menggunakan Poppins sebagai font utama */
        }

        .container {
        display: flex;
        height: 100vh;
        flex-wrap: wrap;
        }

        .gambar {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .gambar img {
        width: 20rem;
        height: 20rem;
        }

        /* navbar start */
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between; /* Jarak otomatis antara tombol kiri dan kanan */
            align-items: center;
            position: absolute;
            top: 15px;
            left: 0;
            padding: 10px;
            background: transparent; /* Pastikan tidak ada latar belakang */
        }

        .navbar .back-button {
            text-decoration: none;
            color: #92a3df;
            font-size: 1.2rem;
            font-weight: 600;
            margin-left: 1rem;
        }

        .navbar a:last-child {
            margin-right: 1rem;
            text-decoration: none;
            color: #92a3df;
            font-size: 1.2rem;
            font-weight: 600;
        }


        .navbar .back-button::before {
            content: '\f104'; /* Font Awesome icon for "Back" */
            font-family: FontAwesome;
            margin-right: 0.5rem;
        }

        /* navbar end */

        /* header start */
        .container-login {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        }

        .container-form {
        width: 70%;
        text-align: center;
        }

        .titled {
        text-align: center;
        margin-bottom: 20px;
        font-size: 2rem;
        font-weight: 700;
        }
        /* header end */

        /* input start */
        .inputfield {
        margin-top: 3rem;
        }

        .email, .password {
        padding: 5px 1rem;
        margin: 1.5rem 0;
        border-radius: 1rem;
        border: 1px solid gray;
        }

        .email input, .password input {
        width: 100%;
        outline: none;
        font-size: 1rem;
        }

        .password {
        position: relative;
        }

        ion-icon {
        font-size: 1.7rem;
        position: absolute;
        top: 0.3rem;
        right: 1rem;
        cursor: pointer;
        }

        .button {
        margin-top: 0.7rem;
        width: 100%;
        padding: 0.8rem;
        font-weight: 700;
        font-size: 1rem;
        border-radius: 5rem;
        background-image: linear-gradient(to right, var(--secondary), var(--primary));
        color: white;
        }

        .forgot {
        display: block;
        font-size: 0.9rem;
        text-decoration: none;
        text-align: center;
        margin: 1.5rem 0 2rem;
        background-clip: content-box;
        background: linear-gradient(to right, var(--pink), var(--purple));
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
        font-weight: 700;
        }

        hr {
        border: 1px solid var(--black);
        opacity: 40%;
        width: 90%;
        margin: auto;
        }

        .container-form p {
        text-align: center;
        position: relative;
        bottom: 0.7rem;
        background-color: white;
        width: 8rem;
        margin: auto;
        font-size: 0.9rem;
        }

        .social {
        display: flex;
        width: 80%;
        margin: auto;
        padding: 0 3rem;
        justify-content: space-between;
        }

        .social a {
        text-decoration: none;
        display: block;
        padding: 0.7rem;
        font-size: 1.5rem;
        border-radius: 1rem;
        width: 4rem;
        text-align: center;
        color: black;
        transition: 0.2s;
        }

        .social a:hover {
        border: 1px solid #1d1617bd;
        transform: scale(1.3);
        }
        /* input end */

    </style>
    <title>Sign In</title>
</head>
<body>
    <div class="container">
        <div class="gambar">
            <img src="gambar.jpg" alt="gambar">
        </div>
        <div class="container-login">
            <div class="navbar">
                <a href="../../landing page/indeks.php" class="back-button">Back</a>
                <a href="../Create Account/create-account.php">Create Account</a>
            </div>
            <div class="container-form">
                <h1 class="titled">Sign In</h1>
                <div class="inputfield">
                    <form method="post">
                        <div class="email">
                            <input type="email" id="username" name="email" placeholder="Email" required>
                        </div>
                        <div class="password">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <ion-icon name="eye-off-outline" id="eye"></ion-icon>
                        </div>
                        <input type="submit" class="button" name="submit" value="SIGN IN">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</body>
</html>
