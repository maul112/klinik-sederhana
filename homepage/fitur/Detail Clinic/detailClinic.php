<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'db_klinik');

if(!isset($_SESSION['username'])) {
    header("Location: ../masuk/Create Account/create-account.php");
    exit;
}

$username = $_SESSION['username'];
$ambil_data = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
$hasil = mysqli_fetch_assoc($ambil_data);
$nama = $hasil["fullname"];
$gambar = $hasil["gambar"];

$temp = mysqli_query($conn, "SELECT * FROM ulasan");

if(isset($_POST["add"])) {
    $username = $_SESSION['username'];
    $gambar = $_POST["gambar"];
    $rating = $_POST["rating"];
    $category = $_POST["category"];
    $review = $_POST["review"];
    mysqli_query($conn, "INSERT INTO ulasan VALUES ('', '$username', '$rating', '$category', '$review', '', '$gambar')");
}

// Handle reply from admin
if (isset($_POST["reply"])) {
    $review_id = $_POST['review_id'];
    $reply = $_POST['reply_text'];
    mysqli_query($conn, "UPDATE ulasan SET reply = '$reply' WHERE id = '$review_id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Kita Sehat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="detailClinic.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Clinic Kita Sehat</h1>
        </header>
        <div class="clinic-header">
            <div class="clinic-logo">
                <img src="logo kita sehat.png" alt="Clinic Kita Sehat Logo">
            </div>
            <div class="clinic-details">
                <h2>Clinic Kita Sehat</h2>
                <p>Kenanga Ave. No. 34 Block H</p>
            </div>
            <div class="clinic-stats">
                <div class="stat">
                    <span>500</span>
                    <p>Patient</p>
                </div>
                <div class="stat">
                    <span class="rating">
                        <svg class="star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f39c12" width="20px" height="20px">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        4.8
                    </span>
                    <p>Rating</p>
                </div>
            </div>
        </div>
        <div class="about-us">
            <h3>About Us</h3>
            <p>The “Kita Sehat” clinic is the bridge between discomfort and healing. We stand firm on it, keeping every step towards wellness never empty of loving support and care. The clinic is not just a place, but a place where hope meets treatment and every step to recovery is a miracle.</p>
        </div>
        <div class="working-info">
            <h3>Working Information</h3>
            <p>Monday - Friday, 08:00 AM - 21:00 PM</p>
            <p>13th Street. 47 W 13th St, New York, NY 10011, USA. 20 Cooper Square. 20 Cooper Square, New York</p>
        </div>
        <div class="reviews-header">
            <h3>Reviews</h3>
            <button id="add-review-btn" class="btn btn-primary">Add Review</button>
        </div>
        <div class="reviews">
            <div id="review-form" class="review-form hidden">
                <form id="reviewForm" method="post">
                    <div class="form-group">
                        <input type="hidden" name="gambar" value="<?= $gambar?>">
                        <label for="reviewer-name">Name:</label>
                        <input type="text" id="reviewer-name" class="form-control" readonly value="<?= $nama?>">
                    </div>
                    <div class="form-group">
                        <label for="review-rating">Rating:</label>
                        <select id="review-rating" name="rating" class="form-control" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review-category">Category:</label>
                        <select id="review-category" class="form-control" required name="category">
                            <option value="Service">Service</option>
                            <option value="Facilities">Facilities</option>
                            <option value="Staff">Staff</option>
                            <option value="Place">Place</option>
                            <option value="Medicine">Medicine</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review-text">Review:</label>
                        <textarea id="review-text" name="review" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <?php while($data = mysqli_fetch_assoc($temp)) : ?>
            <div class="review">
                <div class="review-header">
                    <div class="reviewer">
                        <img src="../../../userProfile/<?= $data["gambar"]?>" alt="Reviewer <?= $data["username"]?>">
                        <span><?= $data["username"]?></span>
                    </div>
                    <span class="rating">
                        <?php for($x = 0; $x < (int) $data["rating"]; $x++) : ?>
                        <svg class="star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#f39c12" width="20px" height="20px">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <?php endfor ?>
                    </span>
                </div>
                <div class="review-category">
                    Category: <?= $data["category"]?>
                </div>
                <p><?= $data["review"]?></p>

                <!-- Display Admin Reply (if any) -->
                <?php if (!empty($data["reply"])) : ?>
                    <div class="admin-reply">
                        <strong>Admin's Reply:</strong>
                        <p><?= htmlspecialchars($data["reply"]) ?></p>
                    </div>
                <?php endif; ?>

                <!-- Admin Reply Form -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 2): ?>
                    <form action="" method="POST">
                        <input type="hidden" name="review_id" value="<?= $data['id'] ?>">
                        <div class="form-group">
                            <textarea name="reply_text" class="form-control" placeholder="Write your reply here" required></textarea>
                        </div>
                        <button type="submit" name="reply" class="btn btn-secondary">Submit Reply</button>
                    </form>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>