<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$username = $_SESSION["username"];
$ambil_data = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($ambil_data);
$id = $hasil['id'];

if (isset($_POST["ubah"])) {
    $newUsername = $_POST["username"];
    $newFullname = $_POST["fullname"];
    $newDob = $_POST["dob"];
    $newEmail = $_POST["email"];
    $newPhone = $_POST["phone"];
    $newGender = $_POST["gender"];

    // Update data user kecuali gambar
    $_SESSION['username'] = $newUsername;
    mysqli_query($conn, "UPDATE user_data SET
        username = '$newUsername',
        fullname = '$newFullname',
        dob = '$newDob',
        email = '$newEmail',
        phone = '$newPhone',
        gender = '$newGender'
        WHERE id = '$id'
    ");

    // Proses upload gambar
    if (!empty($_FILES["gambar"]["name"])) {
        $gambar = $_FILES["gambar"]["name"];
        $validExtention = ['jpg', 'png', 'jpeg', 'svg', 'webp'];
        $gambarExtention = explode('.', $gambar);
        $gambarExtention = strtolower(end($gambarExtention));
        $tmpName = $_FILES["gambar"]["tmp_name"];
        $unik = uniqid();
        $namaGambar = $unik . "." . $gambarExtention;

        if (in_array($gambarExtention, $validExtention)) {
            // Update gambar di database
            mysqli_query($conn, "UPDATE user_data SET gambar = '$namaGambar' WHERE id = '$id'");
            move_uploaded_file($tmpName, '../../userProfile/' . $namaGambar);
        } else {
            echo "<script>
                    alert('Format gambar tidak valid. Gunakan jpg, png, jpeg, svg, atau webp.');
                  </script>";
        }
    }

    echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
          </script>";
}

$riwayatData = mysqli_query($conn, "SELECT * FROM riwayat_kesehatan WHERE user_id = '$id'");
$riwayat = mysqli_fetch_assoc($riwayatData);
$riwayatExist = mysqli_num_rows($riwayatData) > 0;

// Ambil data user setelah perubahan
$ambil_data = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($ambil_data);

// Periksa apakah gambar ada atau tidak
$fotoProfile = "../../userProfile/" . $hasil['gambar'];
$defaultFoto = "Vector.png";
$nama = file_exists($fotoProfile) && !empty($hasil['gambar']) ? $fotoProfile : $defaultFoto;

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    echo "<script>
            alert('Logout berhasil');
            document.location.href = '../../masuk/Sign in Page/sign-in.php';
          </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 900px;
            text-align: center;
            margin-top: 1rem;
        }

        .profile {
            text-align: center;
        }


        .avatar-container {
            position: relative;
            display: inline-block;
        }

        .avatar-container .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .profile-img {
            border-radius: 50%;
            margin: 0 20px;
            width: 150px;    /* Ensure equal width and height for a perfect circle */
            height: 150px;   /* Ensure equal width and height for a perfect circle */
            object-fit: cover; /* Ensures image covers the area without distorting */
            cursor: pointer; 
        }

        h1 {
            text-transform: lowercase;
            color: #333;
            margin: 20px 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input, select#gender {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background: linear-gradient(to right, #92A3FD, #9DCEFF);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 2rem;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background: linear-gradient(to right, #92A3FD, #9DCEFF);
        }

        /* Riwayat Kesehatan Container */
        .riwayat-container {
            margin-top: 20px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            width: 95%;
            text-align: left;
            transition: box-shadow 0.3s ease;
        }

        .riwayat-container h2 {
            color: #333;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 3px solid #92A3FD;
            padding-bottom: 10px;
        }

        .riwayat-container p {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .riwayat-container p strong {
            color: #333;
            font-weight: bold;
            margin-right: 10px;
        }

        /* Icons for Riwayat Kesehatan */
        .riwayat-container .riwayat-item i {
            font-size: 22px;
            margin-right: 15px;
            color: #92A3FD;
            transition: color 0.3s ease;
        }

        /* Styling for links */
        .riwayat-container a {
            color: #92A3FD;
            margin-left: 17px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .riwayat-container a:hover {
            color: #9DCEFF;
        }

        /* Grid Layout for mobile responsiveness */
        .riwayat-container .riwayat-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f9ff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .riwayat-container .riwayat-item span {
            font-size: 16px;
            color: #555;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .button-container button {
            width: 48%;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="avatar-container">
                <div class="avatar" style="background-image: url('<?php echo $nama; ?>');"></div>
            </div>
            <form id="userForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="gambar">Pilih Foto:</label>
                    <input type="file" id="gambar" name="gambar">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $hasil['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo $hasil['fullname']; ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo $hasil['dob']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo $hasil['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $hasil['phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender">
                        <option value="<?php echo $hasil['gender']; ?>"><?php echo ucfirst($hasil['gender']); ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="riwayat-container">
                    <h2>Riwayat Kesehatan</h2>
                    <?php if ($riwayatExist): ?>
                        <div class="riwayat-item">
                            <i class="fas fa-heartbeat"></i>
                            <p><strong>Penyakit Kronis:</strong> <?php echo $riwayat['penyakit_kronis'] ?: 'Tidak ada'; ?></p>
                        </div>
                        <div class="riwayat-item">
                            <i class="fas fa-allergies"></i>
                            <p><strong>Alergi:</strong> <?php echo $riwayat['alergi'] ?: 'Tidak ada'; ?></p>
                        </div>
                        <div class="riwayat-item">
                            <i class="fas fa-syringe"></i>
                            <p><strong>Riwayat Operasi:</strong> <?php echo $riwayat['operasi'] ?: 'Tidak ada'; ?></p>
                        </div>
                        <div class="riwayat-item">
                            <i class="fas fa-hospital-alt"></i>
                            <p><strong>Rawat Inap:</strong> <?php echo $riwayat['rawat_inap'] ?: 'Tidak ada'; ?></p>
                        </div>
                        <div class="riwayat-item">
                            <i class="fas fa-pills"></i>
                            <p><strong>Obat Saat Ini:</strong> <?php echo $riwayat['obat_saat_ini'] ?: 'Tidak ada'; ?></p>
                        </div>
                        <div class="riwayat-item">
                            <i class="fas fa-notes-medical"></i>
                            <p><strong>Terapi Saat Ini:</strong> <?php echo $riwayat['terapi_saat_ini'] ?: 'Tidak ada'; ?></p>
                        </div>
                        <a href="riwayat kesehatan">Edit Riwayat Kesehatan</a>
                    <?php else: ?>
                        <p>Anda belum mengisi riwayat kesehatan. <a href="riwayat kesehatan">Klik di sini untuk mengisi.</a></p>
                    <?php endif; ?>
                </div>
                <div class="button-container">
                    <button type="submit" name="ubah">Ubah</button>
                    <button type="submit" name="logout">Log Out</button>
                </div>
            </form>
        </div>
    </div>
    <script src="script-profile.js"></script>
</body>
</html>
