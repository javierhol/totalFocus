document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('edit-profile');
    let newPass = document.getElementById('newPassword');



    form.addEventListener('submit', function (event) {
        event.preventDefault();

        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

        if (newPass.value !== '' && !regex.test(newPass.value)) {
            swal("¡Contraseña inválida!",
                "La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.",
                "error");
            return;
        }

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
                        data.message,
                        "success"
                    ).then((value) => {
                        window.location.href = "login.html";
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



let logout = document.getElementById('logout');
let login = document.getElementById('login');
let wishlist = document.getElementById('wishlist');
let cart = document.querySelectorAll('#cart');
let profile = document.getElementById('profile');

const id = localStorage.getItem('id');

if(!id|| id === 'null'){
    window.location.href = 'index.php';
}

if (id) {
    logout.style.display = 'block';
    wishlist.style.display = 'block';
    profile.style.display = 'block';
    login.style.display = 'none';
}else{
    logout.style.display = 'none';
    wishlist.style.display = 'none';
    profile.style.display = 'none';
}

/** logout function **/
logout.addEventListener('click', function () {
    localStorage.clear();
    window.location.href = 'index.php';
    window.location.reload();
});

cart.forEach(function (element) {
    element.addEventListener('click', function () {
        event.preventDefault();
        if (!id) {
            swal(
                'Inicie sesión para agregar productos al carrito',
                '¡Bienvenido!',
                'warning'
            ).then(() => {
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 100);
            });
        }else{
            //delete the event.preventDefault() to redirect to the cart page
            window.location.href = 'cart.html';
        }
    });
});


const inputs = document.querySelectorAll('.input-field input');

inputs.forEach(input => {
  input.addEventListener('blur', () => {
    if (input.value.trim() !== "") {
      input.classList.add('filled');
    } else {
      input.classList.remove('filled');
    }
  });
});

const togglePassword = document.querySelector("#togglePassword");
const togglePassword2 = document.querySelector("#togglePassword2");
const password = document.querySelector("#currentPassword");
const password2 = document.querySelector("#newPassword");

togglePassword.addEventListener("click", function () {
  // Alternar el tipo de input entre 'password' y 'text'
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);
  
  // Cambiar el ícono de ojo cuando el campo sea visible u oculto
  this.src = type === "password" ? "images/eye2.svg" : "images/eye-slash2.svg";
});
togglePassword2.addEventListener("click", function () {
  // Alternar el tipo de input entre 'password' y 'text'
  const type = password2.getAttribute("type") === "password" ? "text" : "password";
  password2.setAttribute("type", type);
  
  // Cambiar el ícono de ojo cuando el campo sea visible u oculto
  this.src = type === "password" ? "images/eye2.svg" : "images/eye-slash2.svg";
});
