document.addEventListener('DOMContentLoaded', function () {
    let form = document.getElementById('contact-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); 

        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let theme = document.getElementById('theme').value;
        let message = document.getElementById('message').value;

        if (name === '' || email === '' || theme === '' || message === '') {
            swal(
                'Por favor complete todos los campos',
                '¡Gracias!',
                'warning'
            );
            return;
        }

        let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(email)) {
            swal(
                'El email no es válido',
                '¡Gracias!',
                'warning'
            );
            return;
        }

        let formData = new FormData(form);

        fetch('contact.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    swal(
                        'Error al enviar el mensaje',
                        '¡Gracias!',
                        'error'
                    );
                } else {
                    swal(
                        'Mensaje enviado con éxito',
                        '¡Gracias!',
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
                swal(
                    'Error al enviar el mensaje',
                    '¡Gracias!',
                    'error'
                );
            });
    });
});