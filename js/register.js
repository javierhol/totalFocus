document.addEventListener('DOMContentLoaded', function () {

    let form = document.getElementById('register-form');
    let errorMessage = document.getElementById('errorMessage');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado de envío de formulario

        let username = document.getElementById('username').value;
        let email = document.getElementById('email').value;
        let pass = document.getElementById('password').value;

        // Validaciones
        if (username === '' || email === '' || pass === '') {
            errorMessage.innerHTML = 'Por favor complete todos los campos';
            return;
        }

        let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
        if (pass.length < 8 || !passRegex.test(pass)) {
            swal(
                'Error',
                'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número',
                'error'
            )
            return;
        }

        let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(email)) {
           swal(
                'Error',
                'El email no es válido',
                'error'
           )
            return;
        }

        // Si pasa las validaciones, limpiamos cualquier mensaje de error
        errorMessage.innerHTML = '';

        // Crear FormData a partir del formulario
        let formData = new FormData(form);

        // Hacer la petición con fetch
        fetch('signup.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    errorMessage.innerHTML = data.message;
                } else {
                   swal(
                        'Registro exitoso',
                        '¡Te has registrado correctamente!',
                        'success'
                   ).then(() => {
                        setTimeout(() => {
                            window.location.href = 'login.html';
                        }, 1000);
                   });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMessage.innerHTML = 'Ocurrió un error al procesar el registro';
            });
    });
});
