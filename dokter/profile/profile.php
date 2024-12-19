<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if (!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

$username = $_SESSION["username"];

// Ambil data user dari database
$ambil_data = mysqli_query($conn, "SELECT * FROM dokter WHERE username = '$username'");
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
    mysqli_query($conn, "UPDATE dokter SET
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
            mysqli_query($conn, "UPDATE dokter SET gambar = '$namaGambar' WHERE id = '$id'");
            move_uploaded_file($tmpName, '../../userProfile/' . $namaGambar);
        } else {
            echo "<script>
                    alert('Format gambar tidak valid. Gunakan jpg, png, jpeg, svg, atau webp.');
                  </script>";
        }
    }

    echo "<script>
            alert('Data berhasil diubah');
            document.location.href = '../index.php';
          </script>";
}

// Ambil data user setelah perubahan
$ambil_data = mysqli_query($conn, "SELECT * FROM dokter WHERE username = '$username'");
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
    <title>Dokter Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container">
        <div class="profile">
            <div class="avatar-container">
                <!-- Perbaiki path gambar -->
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
                    <label for="poli">Poli:</label>
                    <input type="text" id="poli" name="poli" value="<?php echo $hasil['poli']; ?>">
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
