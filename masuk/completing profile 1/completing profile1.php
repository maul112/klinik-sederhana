<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../create_account.php");
    exit;
}

$username = $_SESSION['username'];

if(isset($_POST['continue'])) {
    $temp = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
    $hasil = mysqli_fetch_all($temp);
    if(count($hasil) !== 1) {
        header("Location: ..//sign_in.php");
        exit;
    }
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    // update
    mysqli_query($conn, "UPDATE user_data SET fullname = '$fullname', dob = '$dob', phone = '$phone', gender = '$gender' WHERE username = '$username'");
    header("Location: completing profile2.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="profile-section">
            <div class="image-wrapper">
                <img src="Vector.png" alt="Default Photo" id="profilePic" class="profile-pic">
                <input type="file" id="fileInput" accept="image/*" hidden>
                <!-- Ganti ikon kamera ke gambar camera.png -->
                <span class="change-photo-icon" onclick="document.getElementById('fileInput').click();">
                    <img src="camera.png" alt="Change Photo Icon" class="camera-icon">
                </span>
            </div>
        </div>
        <div class="form-section">
            <form id="profileForm" method="post">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullname" placeholder="Enter your name" required>
                
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
                
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                
                <button type="submit" name="continue" class="btn-submit">Continue</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
