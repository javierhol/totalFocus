document.addEventListener('DOMContentLoaded', function() {

    let form = document.getElementById('register-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        let username = document.getElementById('username').value;
        let email = document.getElementById('email').value;
        let pass = document.getElementById('password').value;
        let errorMessage = document.getElementById('errorMessage');

        if (username === '' || email === '' || pass === '') {
            errorMessage.innerHTML = 'Porfavor complete todos los campos';
            event.preventDefault();
            return;
        }
        
        if (pass.length < 8) {
            errorMessage.innerHTML = 'La contraseña debe tener al menos 8 caracteres';
            event.preventDefault();
            return;
        }

        let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(email)) {
            errorMessage.innerHTML = 'El email no es válido';
            event.preventDefault();
            return;
        }

        errorMessage.innerHTML = '';

        let formData = new FormData(form);
        console.log('entraa',formData);

        fetch('signup.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                errorMessage.innerHTML = data.error;
            } else {
                window.location.href = 'login.html';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
       

    });
});