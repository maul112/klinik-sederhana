document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        document.querySelector(".loader").style.display = 'none';
        document.location.href = '../../homepage/index.php';
    }, 3000);
});