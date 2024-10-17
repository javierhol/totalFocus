document.addEventListener('DOMContentLoaded', function () {

    let form = document.getElementById('login-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado de envío de formulario

        let email = document.getElementById('email').value;
        let pass = document.getElementById('password').value;
        let errorMessage = document.getElementById('errorMessage');

        // Validaciones
        if (email === '' || pass === '') {
            errorMessage.innerHTML = 'Por favor complete todos los campos';
            return;
        }

        let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(email)) {
            errorMessage.innerHTML = 'El email no es válido';
            return;
        }

        // Si pasa las validaciones, limpiamos cualquier mensaje de error
        errorMessage.innerHTML = '';

        // Crear FormData a partir del formulario
        let formData = new FormData(form);

        // Hacer la petición con fetch
        fetch('signin.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    swal(
                        'Error',
                        data.message,
                        'error'
                    );
                } else {
                    localStorage.setItem('id', data.user.id);
                    swal(
                        'Inicio de sesión exitoso',
                        '¡Bienvenido!',
                        'success'
                    ).then(() => {
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 500);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMessage.innerHTML = 'Ocurrió un error al procesar el inicio de sesión';
            });
    });
}); 
