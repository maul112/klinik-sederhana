<?php

session_start();

$username = $_SESSION['username'];

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

$temp = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($temp);
$fullname = $hasil["fullname"];
$harga = $_GET["harga"];
$title = $_GET["title"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Interface</title>
    <link rel="stylesheet" href="styles-payment.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=USD"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1100px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
        }

        .back-button {
            background: none;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .divider {
            border: none;
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }

        .payment-options h2 {
            margin-bottom: 20px;
        }

        .options {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .option {
            background-color: #f4f4f4;
            border: none;
            padding: 5px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5x;
        }

        .option:hover {
            background-color: #e0e0e0;
        }

        .option img {
            width: 100px;
            height: auto;
        }

        #card-section, #qris-section {
            display: none;
        }

        .charges {
            margin-bottom: 20px;
        }

        .charge-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 18px;
        }

        .continue-button-container {
            text-align: center;
            margin-top: 20px;
        }

        .continue-button {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .continue-button:hover {
            background-color: #0056b3;
        }

        #payment-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #card-element {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #card-errors {
            color: #fa755a;
            margin-top: 10px;
        }

        .pay-button {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #28a745;
            color: white;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pay-button:hover {
            background-color: #218838;
        }

        @media (max-width: 1000px) {
            .option img {
                width: 75px;
            }
        }

        @media (max-width: 600px) {
            .option img {
                width: 50px;
            }

            .continue-button {
                font-size: 16px;
                padding: 10px 15px;
            }

            .pay-button {
                font-size: 16px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <button class="back-button">BACK</button>
        </div>
        <hr class="divider">
        <div class="payment-options">
            <h2>Payment options</h2>
            <div class="options">
                <button class="option" id="card-option"><img src="../../pembayaran/card.png" alt="Credit Card"></button>
                <button class="option" id="qris-option"><img src="../../pembayaran/qris.png" alt="Qris"></button>
                <button class="option" id="apple-pay-option"><img src="../../pembayaran/applepay.png" alt="Apple Pay"></button>
                <button class="option" id="paypal-option"><img src="../../pembayaran/paypal.png" alt="PayPal"></button>
            </div>
        </div>
        
        <div id="qris-section">
            <h2>QRIS Payment</h2>
            <p>Scan the QR code with your QRIS-compatible app to make the payment.</p>
            <div id="qris-code-container"></div>
        </div>
        

        <div id="card-section">
            <h2>Credit Card/Debit Card</h2>
            <form id="payment-form">
                <div class="form-group">
                    <label for="name">Name on Card</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <div id="card-element"></div>
                </div>
                <div id="card-errors" role="alert"></div>
            </form>
        </div>

        <div class="charges">
            <div class="charge-item">
                <span>Service Charge</span>
                <span>Rp <?= $harga?></span>
            </div>
            <hr class="divider">
            <div class="total-amount">
                <span>Total amount</span>
                <span>Rp <?= $harga?></span>
            </div>
        </div>
        <div class="continue-button-container">
            <form method="post" action="confirm.php">
                <input type="hidden" name="harga" value="<?= $harga?>">
                <input type="hidden" name="title" value="<?= $title?>">
                <button class="continue-button" type="submit" name="konfirmasi">CONTINUE</button>
            </form>
        </div>
    </div>

    <script>
        // Set your publishable key
        var stripe = Stripe('your-publishable-key-here');
        var elements = stripe.elements();

        var style = {
            base: {
                color: "#32325d",
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }

        // Show appropriate section based on payment option selected
        document.getElementById('qris-option').addEventListener('click', function() {
            document.getElementById('qris-section').style.display = 'block';
            document.getElementById('card-section').style.display = 'none';

    async function createQrisCharge() {
        const response = await fetch('https://api.xendit.co/qr_codes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Basic ' + btoa('YOUR_SECRET_API_KEY:')
            },
            body: JSON.stringify({
                external_id: 'your-external-id',
                type: 'DYNAMIC',
                callback_url: 'https://yourwebsite.com/callback',
                amount: 650000
            })
        });
        const data = await response.json();
        return data.qr_code_url;
    }

    createQrisCharge().then(qrCodeUrl => {
        document.getElementById('qris-code-container').innerHTML = `<img src="${qrCodeUrl}" alt="QRIS Code">`;
    });

    document.getElementById('qris-option').addEventListener('click', function() {
        document.getElementById('qris-section').style.display = 'block';
        document.getElementById('card-section').style.display = 'none';
    });

        });

        document.getElementById('card-option').addEventListener('click', function() {
            document.getElementById('qris-section').style.display = 'none';
            document.getElementById('card-section').style.display = 'block';
        });

        document.getElementById('apple-pay-option').addEventListener('click', function() {
            document.getElementById('qris-section').style.display = 'none';
            document.getElementById('card-section').style.display = 'none';
        });

        document.getElementById('paypal-option').addEventListener('click', function() {
            document.getElementById('qris-section').style.display = 'none';
            document.getElementById('card-section').style.display = 'none';
        });
    </script>
</body>
</html>
