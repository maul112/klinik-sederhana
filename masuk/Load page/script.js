document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    const button = document.querySelector('button');
    button.innerHTML = '<div class="spinner"></div>';
    button.disabled = true;

    // Simulate a login request
    setTimeout(() => {
        button.innerHTML = 'Login';
        button.disabled = false;
    }, 2000);
});
