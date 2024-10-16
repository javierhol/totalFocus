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
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}






/** logout hidden if no exits id in localstorage**/

let logout = document.getElementById('logout');
let login = document.getElementById('login');
let wishlist = document.getElementById('wishlist');
let cart = document.querySelectorAll('#cart');
let si = document.getElementById('si');

const id = localStorage.getItem('id');

if (id) {
    logout.style.display = 'block';
    wishlist.style.display = 'block';
    login.style.display = 'none';
}else{
    logout.style.display = 'none';
    wishlist.style.display = 'none';
}

/** logout function **/
logout.addEventListener('click', function () {
    localStorage.removeItem('id');
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