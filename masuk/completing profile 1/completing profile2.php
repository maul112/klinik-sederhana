<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Complete</title>
    <style>
        /* General Styles */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif; 
        }
        body {
        margin: 0;
        background: linear-gradient(to right,#fff, #fff);
        display: flex;
        height: 100vh;
        align-items: center;
        justify-content: center;
        }


        /* Message Section */
        .message-section {
        flex: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        border-radius: 0 15px 15px 0;
        padding: 20px;
        }

        .message-card {
        text-align: center;
        max-width: 500px;
        background: #a4c2ff34;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease;
        }

        .icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin: 5px auto 20px auto;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .success-icon {
        width: 70px;
        height: 70px;
        }

        h2 {
        margin: 20px 0 10px;
        color: #a4c2ff;
        font-size: 24px;
        }

        p {
        color: #666;
        font-size: 16px;
        line-height: 1.5;
        }

        .loading-spinner {
        margin: 20px auto;
        width: 30px;
        height: 30px;
        border: 4px solid #ddd;
        border-top: 4px solid #a4c2ff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        }

        /* Spinner Animation */
        @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
        }

        /* Fade In Animation */
        @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
        }
    </style>
</head>
<body>
    <div class="message-section">
        <div class="message-card">
            <div class="icon-wrapper">
                <img src="congr.png" alt="Success Icon" class="success-icon">
            </div>
            <h2>Congratulations!</h2>
            <p>Your account is ready to use. You will be redirected to the Homepage in a few seconds...</p>
            <div class="loading-spinner"></div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                window.location.href = '../../homepage/index.php';
            }, 3000);
        });
    </script>
</body>
</html>
