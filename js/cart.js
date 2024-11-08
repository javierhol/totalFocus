
let logout = document.getElementById('logout');
let login = document.getElementById('login');
let wishlist = document.getElementById('wishlist');
let cart = document.querySelectorAll('#cart');
let profile = document.getElementById('profile');
let si = document.getElementById('si');

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
            window.location.href = 'cart.html';
        }
    });
});


si.addEventListener('click', function () {
    alert('¡Gracias por tu compra!');
});