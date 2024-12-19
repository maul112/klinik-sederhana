<?php
// Mulai sesi
session_start();

unset($_SESSION['allTotal']);

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

// Redirect jika pengguna belum login
if (!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$username = $_SESSION['username'];

// Inisialisasi keranjang belanja
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == "deleteMCU") {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM mcu WHERE id = '$id' AND username = '$username'");
    header("Location: cart.php");
    exit;
}

if(isset($_POST['id']) && isset($_POST['action']) && $_POST['action'] == "deleteLab") {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM laboratory WHERE id = '$id' AND username = '$username'");
    header("Location: cart.php");
    exit;
}

// Tambah produk ke keranjang
if (isset($_POST['id']) && !isset($_POST['action'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Ambil detail produk dari database
    $result = mysqli_query($conn, "SELECT * FROM medicine WHERE id = '$id'");
    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
        $medId = $product['id'];

        // jika stok tidak 0
        if($product['stock'] > 0) {
            $medInCart = mysqli_query($conn, "SELECT * FROM med_cart WHERE username = '$username' AND med_id = '$medId'");
            if(mysqli_num_rows($medInCart) == 1) {
                incrementQty($medId, $conn, $username);
            } else {
                insertMedCart($medId, $conn, $username);
            }
        // jika 0
        } else {
            $_SESSION['error'] = "Stok habis.";
        }
    }

    // insertSession($_SESSION, $conn);

    header("Location: cart.php");
    exit;
}

// Proses tombol plus dan minus
if (isset($_POST['action']) && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $action = $_POST['action'];

    $medicineQty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT
                                                                    med_cart.qty AS quantity,
                                                                    medicine.stock as stock
                                                                    FROM med_cart
                                                                    JOIN medicine ON medicine.id = med_cart.med_id
                                                                    WHERE med_cart.username = '$username' AND med_cart.med_id = '$id'"));
    // var_dump($medicineQty); die;
    if($action === 'plus' && (int)$medicineQty['quantity'] < (int)$medicineQty['stock']) {
        // echo "tambah"; die;
        incrementQty($id, $conn, $username);
    } elseif ($action === 'minus' && $medicineQty['quantity'] > 1) {
        decrementQty($id, $conn, $username);
    } else {
        $_SESSION['error'] = $action === 'plus' ? "Stok tidak mencukupi." : deleteMedCart($id, $conn, $username);
    }

    // Cari item di keranjang
    // foreach ($_SESSION['cart'] as &$item) {
    //     if ($item['id'] === $id) {
    //         if ($action === 'plus' && $item['quantity'] < $item['stock']) {
    //             $item['quantity']++;
    //         } elseif ($action === 'minus' && $item['quantity'] > 1) {
    //             $item['quantity']--;
    //         } else {
    //             $_SESSION['error'] = $action === 'plus' ? "Stok tidak mencukupi." : "Quantity tidak bisa lebih rendah dari 1.";
    //         }
    //         break;
    //     }
    // }

    // insertSession($_SESSION, $conn);

    header("Location: cart.php");
    exit;
}

// Hitung total harga
// $totalPrice = array_sum(array_map(function ($item) {
//     return $item['price'] * $item['quantity'];
// }, $_SESSION['cart']));

$totalMed = mysqli_query($conn, "
                        SELECT
                        SUM(medicine.harga * med_cart.qty) as total
                        FROM med_cart
                        JOIN medicine ON medicine.id = med_cart.med_id
                        WHERE med_cart.status = 'unpaid'
                        GROUP BY med_cart.username
                        HAVING med_cart.username = '$username';
                        ");
if(mysqli_num_rows($totalMed) == 0) {
    $totalMed = 0;
} else {
    $totalMed = (int)mysqli_fetch_assoc($totalMed)['total'];
}

$totalMCU = mysqli_query($conn, "
                        SELECT
                        SUM(harga) as harga
                        FROM mcu
                        WHERE username = '$username' AND status = 'unpaid'
                        GROUP BY username
                    ");
if(mysqli_num_rows($totalMCU) == 0) {
    $totalMCU = 0;
} else {
    $totalMCU = (int)mysqli_fetch_assoc($totalMCU)['harga'];
}

$totalLab = mysqli_query($conn, "
                        SELECT
                        SUM(harga) as harga
                        FROM laboratory
                        WHERE username = '$username' AND status = 'unpaid'
                        GROUP BY username
                    ");
if(mysqli_num_rows($totalLab) == 0) {
    $totalLab = 0;
} else {
    $totalLab = (int)mysqli_fetch_assoc($totalLab)['harga'];
}

$totalPrice = $totalMed + $totalLab + $totalMCU;

// Ambil semua item di keranjang
$cartItemsData = mysqli_query($conn, "
    SELECT *, med_cart.qty*medicine.harga as price
    FROM med_cart
    JOIN medicine ON medicine.id = med_cart.med_id
    WHERE med_cart.username = '$username' AND med_cart.status = 'unpaid'
");
$cartItems = $cartItemsData;

$cartMCU = mysqli_query($conn, "SELECT * FROM mcu WHERE username = '$username' AND status = 'unpaid'");

$cartLab = mysqli_query($conn, "SELECT * FROM laboratory WHERE username = '$username' AND status = 'unpaid'");

// var_dump(mysqli_fetch_assoc($cartItems));

// var_dump($_SESSION['cart']);

// function insertSession($session, $conn) {
//     $username = $session['username'];
//     $cart = $session['cart'];
//     mysqli_query($conn, "DELETE FROM med_cart WHERE username = '$username'");
//     foreach($cart as $data) {
//         $medId = $data['id'];
//         $medQuantity = $data['quantity'];
//         mysqli_query($conn, "INSERT INTO med_cart VALUES (null, '$medId', '$medQuantity', '$username')");
//     }
// }

function incrementQty($medId, $conn, $username) {
    mysqli_query($conn, "UPDATE med_cart SET qty = qty + 1 WHERE med_id = '$medId' AND username = '$username'");
}

function decrementQty($medId, $conn, $username) {
    mysqli_query($conn, "UPDATE med_cart SET qty = qty - 1 WHERE med_id = '$medId' AND username = '$username'");
}

function insertMedCart($medId, $conn, $username) {
    mysqli_query($conn, "INSERT INTO med_cart VALUES (null, '$medId', '1', '$username')");
}

function deleteMedCart($medId, $conn, $username) {
    mysqli_query($conn, "DELETE FROM med_cart WHERE med_id = '$medId' AND username = '$username'");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .cart-item-quantity button {
            background-color: #ddd;
            border: 1px solid #ccc;
            padding: 5px;
            margin: 0 5px;
            cursor: pointer;
        }
        .cart-item-price {
            font-weight: bold;
        }
        .cart-item-remove {
            color: red;
            cursor: pointer;
        }
        .cart-item-remove:hover {
            text-decoration: underline;
        }
        .total-price {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-4">Your Cart</h1>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <h4 style="margin-top: 1rem;">Medicine</h4>
    <?php if (mysqli_num_rows($cartItems) != 0) : ?>
        <ul class="list-group">
            <?php while($item = mysqli_fetch_assoc($cartItems)): ?>
                <li class="cart-item list-group-item d-flex justify-content-between align-items-center">
                    <img src="../pharmacy/assets-farm/<?= $item['medgambar'] ?>" alt="<?= $item['medname'] ?>" class="img-fluid">
                    <div><?= $item['medname'] ?></div>
                    <div class="cart-item-quantity">
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="action" value="minus">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                        </form>
                        <span><?= $item['qty'] ?></span>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="action" value="plus">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                        </form>
                    </div>
                    <span>Rp<?= number_format($item['price'], 0, ',', '.') ?></span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>Your Medicine cart is empty.</p>
    <?php endif; ?>
    <h4 style="margin-top: 1rem;">MCU</h4>
    <?php if (mysqli_num_rows($cartMCU) != 0) : ?>
        <ul class="list-group">
            <?php while($item = mysqli_fetch_assoc($cartMCU)): ?>
                <li class="cart-item list-group-item d-flex justify-content-between align-items-center">
                    <div><?= $item['title']; ?></div>
                    <div class="cart-item-quantity">
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="action" value="deleteMCU">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                        </form>
                        <span>1</span>
                    </div>
                    <span>Rp<?= number_format($item['harga'], 0, ',', '.') ?></span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>Your MCU is empty.</p>
    <?php endif; ?>
    <h4 style="margin-top: 1rem;">Laboratory</h4>
    <?php if (mysqli_num_rows($cartLab) != 0) : ?>
        <ul class="list-group">
            <?php while($item = mysqli_fetch_assoc($cartLab)): ?>
                <li class="cart-item list-group-item d-flex justify-content-between align-items-center">
                    <div><?= $item['title']; ?></div>
                    <div class="cart-item-quantity">
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="action" value="deleteLab">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                        </form>
                        <span>1</span>
                    </div>
                    <span>Rp<?= number_format($item['harga'], 0, ',', '.') ?></span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>Your Laboratory is empty.</p>
    <?php endif; ?>
    <div class="total-price mt-3">
        <strong>Total: Rp<?= number_format($totalPrice, 0, ',', '.') ?></strong>
    </div>
    <form action="../pembayaran/PAYMENT.php" method="post" class="my-3">
        <button type="submit" class="btn btn-primary">Continue to Payment</button>
    </form>
</div>
</body>
</html>
