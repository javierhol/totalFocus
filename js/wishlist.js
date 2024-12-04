let logout = document.getElementById("logout");
let login = document.getElementById("login");
let wishlist = document.getElementById("wishlist");
let cart = document.querySelectorAll("#cart");
let profile = document.getElementById("profile");
const clearWishlist = document.querySelectorAll(".delete-wishlist");

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

clearWishlist.forEach((btn) => {
  btn.addEventListener("click", function () {
    const productId = this.getAttribute("data-id");
    const productData = { id: productId };

    fetch("remove_wishlist.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(productData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          swal(
            "¡Producto eliminado!",
            "El producto ha sido eliminado de la lista de deseos.",
            "success"
          ).then(() => {
            window.location.reload();
          });
        } else {
          alert("Hubo un error al eliminar el producto.");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});
