document.addEventListener('DOMContentLoaded', () => {
    const createAccountButton = document.getElementById('create-account');
    const signInButton = document.getElementById('sign-in');

    createAccountButton.addEventListener('click', () => {
        window.location.href = './Create Account/create-account.html'; // Relative path to create-account.html
    });

    signInButton.addEventListener('click', () => {
        window.location.href = './Sign In Page/sign-in.html'; // Relative path to sign-in.html
    });
});
