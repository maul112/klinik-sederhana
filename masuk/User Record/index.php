<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Management</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
            --primary: #92A3FD;
            --secondary: #9DCEFF;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif; /* Menggunakan Poppins sebagai font utama */
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            background-color: #f5f5f5;
        }

        .navbar {
            width: 100%;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: flex-end;
            align-items: center;
            box-sizing: border-box;
        }

        .navbar a {
            text-decoration: none;
            margin-right: 1rem;
            color: #92a3df;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            height: calc(100% - 60px); /* 60px is the height of the navbar */
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            box-sizing: border-box;
            overflow-y: auto;
            justify-content: center; /* Center the container */
        }

        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 30px;
        }

        .profile-image {
            width: 150px; /* Increased size */
            height: 150px; /* Increased size */
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            text-align: center;
        }

        .profile-info h2 {
            margin-bottom: 5px;
            font-size: 1.5rem;
        }

        .record-details {
            flex-grow: 1;
            max-width: 600px; /* Adjusted width for better layout */
        }

        .record-details label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: center; /* Center the label */
        }

        .record-details textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .record-types {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            align-items: center; /* Center the buttons */
        }

        .record-types button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #eee;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
            font-size: 1rem;
            text-align: left;
            width: 100%; /* Full width button */
            max-width: 300px; /* Adjusted width for better layout */
        }

        .record-types button.active {
            background-color: #ccc;
        }

        .upload-button {
            padding: 0.8rem 2rem;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 5rem;
            background-image: linear-gradient(to right, var(--secondary), var(--primary));
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: auto;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        @media (max-width: 800px) {
            .container {
                width: 100%;
                padding: 20px;
                flex-direction: column;
                height: auto;
            }

            .record-types button {
                padding: 10px;
                margin: 5px 0;
            }

            .profile {
                flex-direction: column;
                align-items: flex-start;
                margin-right: 0;
                margin-bottom: 20px;
            }

            .profile-image {
                margin-bottom: 10px;
            }

            .profile-info {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">File Notes</a>
    </div>
    <div class="container">
        <div class="profile">
            <div class="profile-image">
                <img src="vector.png" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h2>Shamanta Shin</h2>
                <p>ID: @shamantashin</p>
            </div>
        </div>

        <div class="record-details">
            <label for="recordType">Type of Record:</label>
            <div class="record-types">
                <button id="reportButton" class="active">Profile Data</button>
                <button id="reportButton" class="active">Laporan Pemeriksaan</button>
                <button id="prescriptionButton">Rekomendasi Resep Obat</button>
                <button id="mcuButton">Hasil MCU</button>
            </div>
            <label for="recordDescription">Description Noted:</label>
            <textarea id="recordDescription" placeholder="Enter record description..."></textarea>

            <button class="upload-button">Upload Record</button>
            <p class="error"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportButton = document.getElementById('reportButton');
            const prescriptionButton = document.getElementById('prescriptionButton');
            const mcuButton = document.getElementById('mcuButton');
            const uploadButton = document.querySelector('.upload-button');
            const error = document.querySelector('.error');

            // Event listener for upload button
            uploadButton.addEventListener('click', () => {
                // Get data from form
                const recordTypeButton = document.querySelector('.record-types button.active');
                const recordType = recordTypeButton ? recordTypeButton.textContent : '';
                const recordDescription = document.getElementById('recordDescription').value;

                // Validation (add more validation as needed)
                if (!recordType || !recordDescription) {
                    error.textContent = "Please fill all fields.";
                    return;
                }

                // Handle form submission logic (replace with your own logic)
                // Example:
                const formData = new FormData();
                formData.append('recordType', recordType);
                formData.append('recordDescription', recordDescription);

                // Upload to server (replace with your own server-side logic)
                fetch('/upload', { // Replace with your server endpoint
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Handle successful submission
                        error.textContent = "Record uploaded successfully!";
                        // Clear form or perform other actions as needed
                    } else {
                        // Handle submission errors
                        error.textContent = "Upload failed. Please try again.";
                    }
                })
                .catch(() => {
                    error.textContent = "An error occurred during upload.";
                });
            });

            // Event listeners for record type buttons
            reportButton.addEventListener('click', () => {
                reportButton.classList.add('active');
                prescriptionButton.classList.remove('active');
                mcuButton.classList.remove('active');
            });

            prescriptionButton.addEventListener('click', () => {
                prescriptionButton.classList.add('active');
                reportButton.classList.remove('active');
                mcuButton.classList.remove('active');
            });

            mcuButton.addEventListener('click', () => {
                mcuButton.classList.add('active');
                reportButton.classList.remove('active');
                prescriptionButton.classList.remove('active');
            });
        });
    </script>
</body>
</html>
