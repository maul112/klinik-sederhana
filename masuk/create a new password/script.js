let eye = document.getElementById('eye');
let header = document.getElementsByTagName('h1');
let passwordType = document.getElementById('password');
eye.addEventListener('click', function() {
    if (eye.getAttribute('name') === "eye-off-outline") {
        eye.setAttribute('name','eye-outline');
        passwordType.setAttribute('type', 'text');
    }
    else {
        eye.setAttribute('name','eye-off-outline');
        passwordType.setAttribute('type', 'password');
    }
});

const email = document.getElementById('email');
const password = document.getElementById('password');
const showEmail = document.getElementById('showEmail');
const showPassword = document.getElementById('showPassword');

showEmail.innerHTML = email.value;
showPassword.innerHTML = password.value;