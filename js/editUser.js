document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('edit-profile');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('updateProfile.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log(data.status);
                    swal("¡Datos actualizados!",
                        "Los datos se han actualizado correctamente.",
                        "success"
                    ).then((value) => {
                        window.href.location = "index.php";
                        localStorage.clear();
                    });
                } else {
                   swal("¡" + data.message + "!",
                        "Por favor, intenta de nuevo.",
                        "error")
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud.');
            });
    });
});