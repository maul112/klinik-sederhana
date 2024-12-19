<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

if(!isset($_GET["id"])) {
    header("Location: ../apotek1.php");
    exit;
}

$id = $_GET["id"];

$temp = mysqli_query($conn, "SELECT * FROM medicine WHERE id = '$id'");
$hasil = mysqli_fetch_assoc($temp);

?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Klinik</title>

    

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./dist/plugin/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./dist/style.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
    </style>

    
    </head>
    <body>
        <header>
            <section class="py-2 text-center sticky-top">
                <div class="row py-lg-2">
                    <div class="col-lg-12 col-md-8 mx-auto">
                        <h1 class="font-bold bg-white pt-3 pb-3 justify-content-center align-items-center ">
                            <strong>Detail Product</strong>
                        </h1>
                    </div>
                </div>
            </section>
        </header>
    <main>

        <div class="product py-5 bg-light">
            <div class="container">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <div class="grid m-4 justify-content-center">
                                    <img id="main-image" class="image-preview w-100" src="../assets-farm/<?= $hasil["medgambar"]?>" alt="Product Image"/>
                                </div>
                            </div>
                            
                            <div class="col-7">
                                <div class="py-4 mx-4">
                                    <h5 class="mb-0"><?= $hasil["medname"]?></h5>
                                    <!-- <p class="card-text text-muted"><i>Per Pot.</i></p> -->
                                    <h6>Detail Produk</h6>
                                    <h6>Category</h6>
                                    <p class="card-text">
                                        <?= $hasil["category"]?>
                                    </p>
                                    <h6>Deskripsi</h6>
                                    <p class="card-text"><?= $hasil["deskripsi"]?></p>
                                    <strong class="text-primary">Rp<?= $hasil["harga"]?></strong>
                                    <div class="action-buttons-details mt-4">
                                        <button type="button" class="btn btn-primary"> </a>Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
            <a href="#">Back to top</a>
            </p>
            <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.!</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeImage(element) {
            document.getElementById('main-image').src = element.src;
        }
    </script>
</body>
</html>