document.addEventListener("DOMContentLoaded", function () {
  const cartButtons = document.querySelectorAll(".add-cart");
  const addWhishList = document.querySelectorAll(".add-wishlist");

  const id = localStorage.getItem("id");

  // Agregar productos al carrito
  cartButtons.forEach((btn) => {
    btn.addEventListener("click", function () {
      if (!id) {
        swal(
          "¡Inicia sesión!",
          "Para agregar productos al carrito debes iniciar sesión.",
          "warning"
        ).then(() => {
          window.location.href = "login.html";
        });
        return;
      }
      const productId = this.getAttribute("data-id");
      const origin = this.getAttribute("data-origin") || "product";
      const productData = { id: productId, origin: origin };

      fetch("add_cart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(productData),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            swal(
              "¡Producto agregado!",
              "El producto ha sido agregado al carrito.",
              "success"
            ).then(() => {
              window.location.reload();
            });
          } else {
            alert("Hubo un error al agregar el producto.");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });
  // Agregar productos a la lista de deseos

  addWhishList.forEach((btn) => {
    btn.addEventListener("click", function () {
      if (!id) {
        swal(
          "¡Inicia sesión!",
          "Para agregar productos a la lista de deseos debes iniciar sesión.",
          "warning"
        ).then(() => {
          window.location.href = "login.html";
        });
        return;
      }
      const productId = this.getAttribute("data-id");
      const productData = { id: productId };

      fetch("add_wishlist.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(productData),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            swal(
              "¡Producto agregado!",
              "El producto ha sido agregado a la lista de deseos.",
              "success"
            ).then(() => {
              window.location.reload();
            });
          } else {
            swal("¡Producto ya agregado!", data.message, "warning");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  });
});
