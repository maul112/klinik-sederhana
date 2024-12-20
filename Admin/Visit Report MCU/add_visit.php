<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');
// $temp = mysqli_query($conn, "SELECT * FROM antrian WHERE status = 'completed'");

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: ./");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM mcu WHERE id = $id");

$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $saran = $_POST['saran'];
    $pemeriksaan = $_POST['pemeriksaan'];

    $medIds = $_POST['med_id'];
    $jumlahs = $_POST['jumlah'];
    $obat = "";

    $getUsername = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mcu WHERE id = '$id'"))['username'];

    for($i = 0; $i < count($medIds); $i++) {
        $medId = $medIds[$i];
        $jumlah = $jumlahs[$i];
        mysqli_query($conn, "INSERT INTO med_cart VALUES(null, '$medId', '$jumlah', '$getUsername', 'saran dokter', null)");
        $obat = $obat . $medId . ",";
    }

    $query = "UPDATE mcu SET saran = '$saran', visit = 'sudah', obat = '$obat', status = 'completed' WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: ./"); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$medData = mysqli_query($conn, "SELECT * FROM medicine");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Tambah Hasil Pemeriksaan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }

        .container {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form label {
            font-weight: bold;
            color: #495057;
        }

        form input[type="text"],
        form input[type="date"],
        form input[type="password"],
        form select,
        form textarea {
            padding: 10px;
            width: calc(100% - 20px); /* Mengurangi 20px untuk jarak kiri dan kanan */
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f8f9fa;
            color: #495057;
        }

        h2 {
            color: #17a2b8;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .btn-green {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 48%; /* Mengatur lebar tombol */
            text-align: center;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .btn-red {
            background-color: #dc3545;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 48%; /* Mengatur lebar tombol */
            text-align: center;
        }

        .btn-red:hover {
            background-color: #c82333;
        }

        a.btn-red {
            display: inline-block;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Hasil Pemeriksaan</h2>
    <form action="" method="post">
        <label>Nama Pasien</label>
        <input type="text" name="nama" disabled value="<?= $row["fullname"]?>"></input>
        <label>Tanggal</label>
        <input type="text" name="date" disabled value="<?= $row["date"]?>"></input>

        <label>Saran Dokter</label>
        <textarea name="saran" rows="3" required placeholder="Masukkan Saran Anda"></textarea>

        <label>Resep Obat</label>
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="krsTable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="krsBody">
                    <tr class="krs-row">
                        <td>1</td>
                        <td>
                            <select class="form-select" name="med_id[]" aria-label="Pilih Obat" onchange="updateSKS()" required>
                                <option value="" selected disabled required>Pilih Obat</option>
                                <?php foreach ($medData as $matkul) : ?>
                                    <option value="<?= $matkul["id"] ?>" data-sks="<?= $matkul['stock'] ?>"><?= $matkul["medname"] ?> | <?= $matkul['category'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input class="form-control" type="number" name="jumlah[]" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger removeBtn">Hapus</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary " id="addMataKuliah">Tambah Obat</button>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn-green">Simpan</button>
            <button onclick="location.href='./'" class="btn-red">Batal</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        // Fungsi untuk menambah baris baru
        $('#addMataKuliah').click(function() {
            let rowCount = $('#krsBody tr').length + 1;
            let newRow = $('.krs-row:first').clone();


            newRow.find('select').val('');
            newRow.find('input').val('');


            newRow.find('td:first').text(rowCount);


            $('#krsBody').append(newRow);
        });


        $(document).on('click', '.removeBtn', function() {
            if ($('#krsBody tr').length > 1) {
                $(this).closest('tr').remove();
                updateSKS();
                updateIPK();
            } else {
                alert('Anda harus memiliki setidaknya satu list obat.');
            }
        });
    });
</script>
</body>
</html>