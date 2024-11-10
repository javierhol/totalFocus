
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
            window.location.href = 'cart.php';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const clearCart = document.querySelectorAll('.remove-btn');
    // Eliminar productos del carrito

    clearCart.forEach(btn => {
        btn.addEventListener('click', function() {
          const productId = this.getAttribute('data-id');
          const productData = { id: productId };
    
          fetch('remove_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(productData)
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Actualizar el contador del carrito
            //   let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;
            //   cartCount -= 1;  // Decrementa la cantidad
            //   localStorage.setItem('cartCount', cartCount); // Guarda la cantidad actualizada
            //   updateCartCount();  // Refresca el contador en el icono
              alert('Producto eliminado del carrito.');
                window.location.reload();
            } else {
              alert('Hubo un error al eliminar el producto.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
        });
      });
  });
  