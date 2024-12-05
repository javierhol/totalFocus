document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("edit-profile");
  let newPass = document.getElementById("newPassword");
  let confirmPass = document.getElementById("confirmPassword");
  let img = document.getElementById("img");
  let address = document.getElementById("address");
  let fileInput = document.getElementById("file-input"),
    label = fileInput.nextElementSibling,
    labelText = label.querySelector("span"),
    labelRemove = document.querySelector("i.remove"),
    labelDefault = labelText.textContent;

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    // Verificar las contraseñas solo si se envía una nueva contraseña
    if (
      newPass.value !== "" &&
      !regex.test(newPass.value) &&
      confirmPass.value !== "" &&
      !regex.test(confirmPass.value)
    ) {
      swal(
        "¡Contraseña inválida!",
        "La contraseña debe contener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.",
        "error"
      );
      return;
    }

    // Verificar si las contraseñas coinciden solo si se envía una nueva contraseña
    if (newPass.value !== "" && newPass.value !== confirmPass.value) {
      swal(
        "¡Las contraseñas no coinciden!",
        "Por favor, intenta de nuevo.",
        "error"
      );
      return;
    }

    const formData = new FormData(form);
    console.log(JSON.stringify(Object.fromEntries(formData)));

    fetch("updateProfile.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          console.log(data.status);
          swal("¡Datos actualizados!", data.message, "success").then(
            (value) => {
              window.location.reload();
            }
          );
        } else if (data.status === "ok") {
          swal("¡Perfecto!", data.message, "success").then(() => {
            localStorage.clear();
            window.location.href = "login.html";
          });
        } else {
          swal(
            "¡" + data.message + "!",
            "Por favor, intenta de nuevo.",
            "error"
          );
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Ocurrió un error al procesar la solicitud.");
      });
  });

  // on file change
  fileInput.addEventListener("change", function (event) {
    let fileName = fileInput.value.split("\\").pop();
    if (fileName) {
      console.log(fileInput);
      labelText.textContent = fileName;
      labelRemove.style.display = "inline";
    } else {
      labelText.textContent = labelDefault;
      labelRemove.style.display = "none";
    }
  });

  // Remove file
  labelRemove.addEventListener("click", function (event) {
    fileInput.value = "";
    labelText.textContent = labelDefault;
    labelRemove.style.display = "none";
    console.log(fileInput);
  });
});

let logout = document.getElementById("logout");
let login = document.getElementById("login");
let wishlist = document.getElementById("wishlist");
let cart = document.querySelectorAll("#cart");
let profile = document.getElementById("profile");

const id = localStorage.getItem("id");

if (!id || id === "null") {
  window.location.href = "index.php";
}

if (id) {
  logout.style.display = "block";
  wishlist.style.display = "block";
  profile.style.display = "block";
  login.style.display = "none";
} else {
  logout.style.display = "none";
  wishlist.style.display = "none";
  profile.style.display = "none";
}

/** logout function **/
logout.addEventListener("click", function () {
  localStorage.clear();
  window.location.href = "index.php";
  window.location.reload();
});

cart.forEach(function (element) {
  element.addEventListener("click", function () {
    event.preventDefault();
    if (!id) {
      swal(
        "Inicie sesión para agregar productos al carrito",
        "¡Bienvenido!",
        "warning"
      ).then(() => {
        setTimeout(() => {
          window.location.href = "login.html";
        }, 100);
      });
    } else {
      //delete the event.preventDefault() to redirect to the cart page
      window.location.href = "cart.php";
    }
  });
});

const inputs = document.querySelectorAll(".input-field input");

inputs.forEach((input) => {
  input.addEventListener("blur", () => {
    if (input.value.trim() !== "") {
      input.classList.add("filled");
    } else {
      input.classList.remove("filled");
    }
  });
});

const togglePassword = document.querySelector("#togglePassword");
const togglePassword2 = document.querySelector("#togglePassword2");
const togglePassword3 = document.querySelector("#togglePassword3");
const password = document.querySelector("#currentPassword");
const password2 = document.querySelector("#newPassword");
const password3 = document.querySelector("#confirmPassword");

togglePassword.addEventListener("click", function () {
  // Alternar el tipo de input entre 'password' y 'text'
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  // Cambiar el ícono de ojo cuando el campo sea visible u oculto
  this.src = type === "password" ? "images/eye2.svg" : "images/eye-slash2.svg";
});
togglePassword2.addEventListener("click", function () {
  // Alternar el tipo de input entre 'password' y 'text'
  const type =
    password2.getAttribute("type") === "password" ? "text" : "password";
  password2.setAttribute("type", type);

  // Cambiar el ícono de ojo cuando el campo sea visible u oculto
  this.src = type === "password" ? "images/eye2.svg" : "images/eye-slash2.svg";
});
togglePassword3.addEventListener("click", function () {
  // Alternar el tipo de input entre 'password' y 'text'
  const type =
    password3.getAttribute("type") === "password" ? "text" : "password";
  password3.setAttribute("type", type);

  // Cambiar el ícono de ojo cuando el campo sea visible u oculto
  this.src = type === "password" ? "images/eye2.svg" : "images/eye-slash2.svg";
});
