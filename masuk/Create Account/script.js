document.addEventListener('DOMContentLoaded', function() {
    const eye = document.getElementById('eye');
    const passwordType = document.getElementById('password');

    eye.addEventListener('click', function() {
        if (eye.getAttribute('name') === "eye-off-outline") {
            eye.setAttribute('name','eye-outline');
            passwordType.setAttribute('type', 'text');
        } else {
            eye.setAttribute('name','eye-off-outline');
            passwordType.setAttribute('type', 'password');
        }
    });
});
