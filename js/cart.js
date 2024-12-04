let logout = document.getElementById("logout");
let login = document.getElementById("login");
let wishlist = document.getElementById("wishlist");
let cart = document.querySelectorAll("#cart");
let profile = document.getElementById("profile");
let checkout = document.querySelector(".checkout-btn");
const checkoutModal = document.getElementById("checkoutModal");
const checkoutBtn = document.querySelector(".checkout-btn");
const closeModal = document.querySelector(".close");
const confirmCheckout = document.getElementById("confirmCheckout");

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

document.addEventListener("DOMContentLoaded", function () {
  const clearCart = document.querySelectorAll(".remove-btn");
  // Eliminar productos del carrito

  clearCart.forEach((btn) => {
    btn.addEventListener("click", function () {
      const productId = this.getAttribute("data-id");
      const productData = { id: productId };

      fetch("remove_cart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(productData),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            swal(
              "¡Producto eliminado!",
              "El producto ha sido eliminado del carrito.",
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
});

//process the checkout false interactivity

checkout.addEventListener("click", function () {
  checkoutModal.style.display = "block";
});

closeModal.addEventListener("click", () => {
  checkoutModal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === checkoutModal) {
    checkoutModal.style.display = "none";
  }
});

// Manejar confirmación de compra
confirmCheckout.addEventListener("click", () => {
  const cardNumber = document.querySelector("#cardNumber").value;
  const cardName = document.querySelector("#cardName").value;
  const expirationDate = document.querySelector("#expirationDate").value;
  const cvv = document.querySelector("#cvv").value;
  const address = document.querySelector("#address").value;

  // Validar datos
  if (!cardNumber || !cardName || !expirationDate || !cvv || !address) {
    swal("Error", "Por favor, complete todos los campos.", "error");
    return;
  }

  // Enviar datos al servidor
  fetch("processCheckout.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      paymentInfo: {
        cardNumber,
        cardName,
        expirationDate,
        cvv,
        address,
      },
      cartItems,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        simulatePurchase();
      } else {
        alert(`Error: ${data.message}`);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Hubo un problema al procesar la compra.");
    });

  // Cerrar el modal después de confirmar
  checkoutModal.style.display = "none";
});

function simulatePurchase() {
  swal({
    title: "Procesando compra",
    text: "Espere un momento por favor...",
    imageUrl: "images/loader.gif",
    imageWidth: 150,
    imageHeight: 150,
    imageAlt: "Loading",
    showConfirmButton: false,
    allowOutsideClick: false,
  });
  setTimeout(() => {
    swal.close();
    swal(
      "¡Compra exitosa!",
      "Su compra ha sido procesada exitosamente.",
      "success"
    ).then(() => {
      window.location.reload();
    });
  }, 2000);
}
