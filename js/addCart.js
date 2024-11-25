document.addEventListener('DOMContentLoaded', function() {
    const cartButtons = document.querySelectorAll('.add-cart');
    const clearCart = document.querySelectorAll('.remove-btn');
    const addWhishList = document.querySelectorAll('.add-wishlist');
    const clearWishlist = document.querySelectorAll('.delete-wishlist');

    const id = localStorage.getItem('id');

    // Agregar productos al carrito
    cartButtons.forEach(btn => {
      btn.addEventListener('click', function() {

        if (!id) {
        swal(
          '¡Inicia sesión!',
          'Para agregar productos al carrito debes iniciar sesión.',
          'warning'
        ).then(() => {
          window.location.href = 'login.html';
        });
          return;
        }
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
            alert('Producto agregado al carrito.');
            window.location.reload();
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

      // Agregar productos a la lista de deseos

      addWhishList.forEach(btn => {
        btn.addEventListener('click', function() {

          if (!id) {
            swal(
              '¡Inicia sesión!',
              'Para agregar productos a la lista de deseos debes iniciar sesión.',
              'warning'
            ).then(() => {
              window.location.href = 'login.html';
            });
              return
          }
          const productId = this.getAttribute('data-id');
          const productData = { id: productId };
    
          fetch('add_wishlist.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(productData)
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Producto agregado a la lista de deseos.');
            } else {
              alert('Hubo un error al agregar el producto.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
        });
      });

      clearWishlist.forEach(btn => {
        btn.addEventListener('click', function() {
          const productId = this.getAttribute('data-id');
          const productData = { id: productId };
    
          fetch('remove_wishlist.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(productData)
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Producto eliminado de la lista de deseos.');
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
  