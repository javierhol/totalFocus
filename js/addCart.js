document.addEventListener('DOMContentLoaded', function() {
    const cartButtons = document.querySelectorAll('.add-cart');
    const clearCart = document.querySelectorAll('.remove-btn');
    
    // Actualizar el contador del carrito en el icono
    function updateCartCount() {
      const cartCount = localStorage.getItem('cartCount') || 0;
      document.getElementById('cart-count').textContent = cartCount;
    }
  
    // Inicializa el contador al cargar la página
    updateCartCount();
  
    // Agregar productos al carrito
    cartButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const productData = { id: productId };
  
        fetch('add_cart.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(productData)
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Actualizar el contador del carrito
            let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;
            cartCount += 1;  // Incrementa la cantidad
            localStorage.setItem('cartCount', cartCount); // Guarda la cantidad actualizada
            updateCartCount();  // Refresca el contador en el icono
            alert('Producto agregado al carrito.');
          } else {
            alert('Hubo un error al agregar el producto.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });
    });

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
              let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;
              cartCount -= 1;  // Decrementa la cantidad
              localStorage.setItem('cartCount', cartCount); // Guarda la cantidad actualizada
              updateCartCount();  // Refresca el contador en el icono
              alert('Producto eliminado del carrito.');
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
  