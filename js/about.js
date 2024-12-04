//Funcion que aplica las animaciones de las habilidades
let proyectos = 0;
let clientes = 0;
let cursos = 0;
let intervalProyectos = null;
let intervalclientes = null;
let intervalCursos = null;

let logout = document.getElementById("logout");
let login = document.getElementById("login");
let wishlist = document.getElementById("wishlist");
let cart = document.querySelectorAll("#cart");
let profile = document.getElementById("profile");
let buy = document.getElementById("buy");

const id = localStorage.getItem("id");

if (id) {
  logout.style.display = "block";
  wishlist.style.display = "block";
  profile.style.display = "block";
  buy.style.display = "block";
  login.style.display = "none";
} else {
  logout.style.display = "none";
  wishlist.style.display = "none";
  profile.style.display = "none";
  buy.style.display = "none";
}

/** logout function **/
logout.addEventListener("click", function () {
  localStorage.clear();
  window.location.href = "index.php";
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

function animacionNumeros() {
  var numeros = document.getElementById("numeros");
  var distancia_numeros =
    window.innerHeight - numeros.getBoundingClientRect().top;
  if (distancia_numeros >= 200 && proyectos == 0) {
    intervalo = setInterval(actualizarContador, 60);
  }
}

function actualizarContador() {
  // Verificamos si hemos llegado a 50
  if (proyectos <= 50) {
    // Mostramos el valor actual del contador en el elemento con id "contador"
    document.getElementById("contProyectos").textContent = proyectos;
    // Incrementamos el contador en 1
    proyectos++;
  } else {
    // Si hemos llegado a 50, detenemos el intervalo
    clearInterval(intervalProyectos);
  }
  // Verificamos si hemos llegado a 30
  if (clientes <= 30) {
    // Mostramos el valor actual del contador en el elemento con id "contador"
    document.getElementById("contClientes").textContent = clientes;
    // Incrementamos el contador en 1
    clientes++;
  } else {
    // Si hemos llegado a 50, detenemos el intervalo
    clearInterval(intervalclientes);
  }
  // Verificamos si hemos llegado a 40
  if (cursos <= 40) {
    // Mostramos el valor actual del contador en el elemento con id "contador"
    document.getElementById("contCursos").textContent = cursos;
    // Incrementamos el contador en 1
    cursos++;
  } else {
    // Si hemos llegado a 50, detenemos el intervalo
    clearInterval(intervalCursos);
  }
}
//detecto el scrolling para aplicar la animacion de la barra de habilidades
window.onscroll = function () {
  animacionNumeros();
  animacionesSkills();
};
let visible = false;

function abrirCerrarMenu() {
  if (visible == false) {
    document.getElementById("nav").className = "responsive";
    visible = true;
  } else {
    document.getElementById("nav").className = "";
    visible = false;
  }
}

function animacionesSkills() {
  var skills = document.getElementById("sobremi");
  var distancia_skills =
    window.innerHeight - skills.getBoundingClientRect().top;
  if (distancia_skills >= 400) {
    document.getElementById("dw").className = " progreso dw";
    document.getElementById("dg").className = " progreso dg";
    document.getElementById("bd").className = " progreso bd";
    document.getElementById("md").className = " progreso md";
  }
}
