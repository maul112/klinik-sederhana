<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$temp = mysqli_query($conn, "SELECT * FROM medicine WHERE category = 'Pills'");

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
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
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
    <main>
        <header>
            <section class="py-2 text-center container">
                <div class="row py-lg-2">
                    <div class="col-1">
                        <a href="apotek1.html" class="text-decoration-none px-3 py-2 mt-4 d-block">Back</a>
                    </div>
                    <div class="col-10">
                        <h1 class="font-bold bg-white pt-3 pb-3 justify-content-center align-items-center ">
                            <strong>PILLS</strong>
                        </h1>
                    </div>
                </div>
            </section>
        </header>

        <div class="product py-5 bg-light">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-4 g-3 g-lg-3">
                    <!-- Start Product-->
                    <?php while($data = mysqli_fetch_assoc($temp)) : ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="detail medicine/index.php?id=<?= $data["id"]?>">
                                <img class="bd-placeholder-img card-img-top" src="assets-farm/<?= $data["medgambar"]?>" alt="Product Image"/>
                            </a>
                            <div class="card-body">
                                <a href="meds/sangobion.html" class="text-reset text-decoration-none"><h5 class="card-title mb-0"><?= $data["medname"]?></h5></a>
                                <!-- <small class="card-text text-muted"><i>Per Strip.</i></small> -->
                                <strong class="text-primary">Rp<?= $data["harga"]?></strong>
                                <div class="action-buttons mt-4">
                                <form method="post" action="../cart/cart.php">
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <button type="submit" class="btn btn-primary btn-full-width">Add to Cart</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile?>
                    <!-- <div class="col">
                        <div class="card shadow-sm">
                            <a href="meds/enervon.html">
                                <img class="bd-placeholder-img card-img-top" src="assets-farm/enervon.png" alt="Product Image"/>
                            </a>
                            <div class="card-body">
                                <a href="meds/enervon.html" class="text-reset text-decoration-none"><h5 class="card-title mb-0">Enervon-C 4 Tablet</h5></a>
                                <small class="card-text text-muted"><i>Per Strip.</i></small>
                                <strong class="text-primary">Rp.6.200-Rp.6.800</strong>
                                <div class="action-buttons mt-4">
                                    <button type="button" class="btn btn-primary btn-full-width" onclick="addToCart('Enervon-C 4 Tablet', 6500, 'assets-farm/enervon.png')">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <a href="meds/panadol.html">
                                <img class="bd-placeholder-img card-img-top" src="assets-farm/panadol.png" alt="Product Image"/>
                            </a>
                            <div class="card-body">
                                <a href="meds/panadol.html" class="text-reset text-decoration-none"><h5 class="card-title mb-0">Panadol Extra 10 Kaplet</h5></a>
                                <small class="card-text text-muted"><i>Per Strip.</i></small>
                                <strong class="text-primary">Rp.13.900-Rp.15.500</strong>
                                <div class="action-buttons mt-4">
                                    <button type="button" class="btn btn-primary btn-full-width" onclick="addToCart('Panadol Extra 10 Kaplet', 15500, 'assets-farm/panadol.png')">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- end product -->
                </div>
            </div>
        </div>
        <div class="cart-container" id="cartContainer">
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
    <script src="cart2.js"></script>
</body>
</html>