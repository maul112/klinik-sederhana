<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../../masuk/Create Account/create-account.php");
    exit;
}

if(!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];
$temp = mysqli_query($conn, "SELECT * FROM ulasan WHERE id = '$id'");
$hasil = mysqli_fetch_assoc($temp);    

if(isset($_POST["balas"])) {
    $reply = $_POST["reply"];
    mysqli_query($conn, "UPDATE ulasan SET reply = '$reply' WHERE id = '$id'");
    echo "<script>
            alert('Balasan telah terkirim');
            document.location.href = 'index.php';
    </script>";
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply</title>
    <style>
        * {
            font-family: sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: gray;
            display: flex;
            min-height: 100vh;
            min-width: 100vw;
        }

        .container {
            margin: auto;
            width: 70%;
            background-color: white;
            height: 60vh;
            padding: 2rem;
            border-radius: 2rem;
        }

        h1 {
            margin-top: 3rem;
        }

        label, input, button {
            display: block;
            font-size: 1rem;
        }

        label {
            margin-left: 2rem;
            margin-bottom: 2rem;
        }

        input {
            padding: 1rem 2rem;
            border-radius: 1rem;
            outline: none;
            border: 1px solid rgba(0,0,0,0.3);
            width: 90%;
            margin: auto;
        }
        
        button {
            padding: 8px 1rem;
            border: 1px solid rgba(0,0,0,0.3);
            border-radius: 1rem;
            margin: 1rem auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Username : <?= $hasil["username"]?></h2>
        <h4>Category : <?= $hasil["category"]?></h4>
        <p>Review : <?= $hasil["review"]?></p>
        <h1>Reply</h1>
        <form method="post">
            <label for="reply">Balasan</label>
            <input type="text" name="reply" id="reply">
            <button type="submit" name="balas">Kirim</button>
        </form>
    </div>
</body>
</html>