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

// Cek jika data riwayat kesehatan ada
$riwayatData = mysqli_query($conn, "SELECT * FROM riwayat_kesehatan WHERE user_id = '$id'");
$riwayat = mysqli_fetch_assoc($riwayatData);
$riwayatExist = mysqli_num_rows($riwayatData) > 0;

if (isset($_POST["submitRiwayat"])) {
    $penyakit_kronis = $_POST["penyakit_kronis"];
    $alergi = $_POST["alergi"];
    $operasi = $_POST["operasi"];
    $rawat_inap = $_POST["rawat_inap"];
    $obat_saat_ini = $_POST["obat_saat_ini"];
    $terapi_saat_ini = $_POST["terapi_saat_ini"];

    if ($riwayatExist) {
        // Update data riwayat kesehatan jika sudah ada
        mysqli_query($conn, "UPDATE riwayat_kesehatan SET
            penyakit_kronis = '$penyakit_kronis',
            alergi = '$alergi',
            operasi = '$operasi',
            rawat_inap = '$rawat_inap',
            obat_saat_ini = '$obat_saat_ini',
            terapi_saat_ini = '$terapi_saat_ini'
            WHERE user_id = '$id'
        ");
    } else {
        // Insert data riwayat kesehatan jika belum ada
        mysqli_query($conn, "INSERT INTO riwayat_kesehatan 
            (user_id, penyakit_kronis, alergi, operasi, rawat_inap, obat_saat_ini, terapi_saat_ini) 
            VALUES ('$id', '$penyakit_kronis', '$alergi', '$operasi', '$rawat_inap', '$obat_saat_ini', '$terapi_saat_ini')
        ");
    }

    echo "<script>
            alert('Riwayat Kesehatan berhasil disimpan');
            document.location.href = '../';
          </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kesehatan</title>
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
            margin-top: 6rem;
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
        <h1>Riwayat Kesehatan</h1>
        <form method="post">
            <div class="form-group">
                <label for="penyakit_kronis">Penyakit Kronis:</label>
                <input type="text" name="penyakit_kronis" id="penyakit_kronis" value="<?php echo $riwayatExist ? $riwayat['penyakit_kronis'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="alergi">Alergi:</label>
                <input type="text" name="alergi" id="alergi" value="<?php echo $riwayatExist ? $riwayat['alergi'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="operasi">Riwayat Operasi:</label>
                <input type="text" name="operasi" id="operasi" value="<?php echo $riwayatExist ? $riwayat['operasi'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="rawat_inap">Rawat Inap:</label>
                <input type="text" name="rawat_inap" id="rawat_inap" value="<?php echo $riwayatExist ? $riwayat['rawat_inap'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="obat_saat_ini">Obat Saat Ini:</label>
                <input type="text" name="obat_saat_ini" id="obat_saat_ini" value="<?php echo $riwayatExist ? $riwayat['obat_saat_ini'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="terapi_saat_ini">Terapi Saat Ini:</label>
                <input type="text" name="terapi_saat_ini" id="terapi_saat_ini" value="<?php echo $riwayatExist ? $riwayat['terapi_saat_ini'] : ''; ?>">
            </div>
            <button type="submit" name="submitRiwayat">Simpan Riwayat Kesehatan</button>
        </form>
    </div>
</body>
</html>
