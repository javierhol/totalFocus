// to get current year
function getYear() {
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

/** google_map js **/
function myMap() {
  var mapProp = {
    center: new google.maps.LatLng(40.416775, -3.70379), // Coordinates for Madrid, Spain
    zoom: 18,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}

/** logout hidden if no exits id in localstorage**/

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
logout.addEventListener("click", async function () {
  try {
    const response = await fetch("logout.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const result = await response.json();
    if (result.success) {
      localStorage.clear();
      alert(result.message);

      window.location.href = "index.php";
    } else {
      alert("Hubo un problema al cerrar la sesión.");
    }
  } catch (error) {
    console.error("Error al cerrar la sesión:", error);
  }
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
      window.location.href = "cart.php";
    }
  });
});
