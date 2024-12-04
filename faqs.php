<?php
require_once 'queries.php';
session_start();

// Inicializar variables
$totalProducts = 0;
$wishListItems = [];

if (isset($_SESSION['user'])) {
  $userId = $_SESSION['user']['id'];
  $totalProducts = getCartTotal($conn, $userId);
}

?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
  <title>| TotalFocus</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='css/faqs.css'>
  <link rel='stylesheet' href='css/wishlist.css'>
  <link rel='stylesheet' type='text/css' href='css/card-shop.css' />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class='hero_area'>
    <header class='header_section'>
      <div class='container-fluid'>
        <nav class='navbar navbar-expand-lg custom_nav-container '>
          <a class='navbar-brand' href='index.php'>
            <img class='image-tittle' src='images/title.png' alt='Logo TotalFocus'>
          </a>

          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent'
            aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class=''> </span>
          </button>

          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav  '>
              <li class='nav-item '>
                <a class='nav-link' href='index.php'>Inicio <span class='sr-only'>( current )</span></a>
              </li>

              <li class='nav-item '>
                <a class='nav-link' href='product.php'>Productos</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='contactMe.php'>Conocenos</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='contactMe.php'>Contactanos</a>
              </li>
            </ul>
            <div class='user_optio_box'>
              <a href='login.html' id='login'>
                <i class='fa fa-user' aria-hidden='true'></i>
              </a>
              <a href='' id='logout'>
                <i class='fa fa-sign-out' aria-hidden='true'></i>
              </a>
              <a href='cart.php' id='cart'>
                <i class='fa fa-shopping-cart' aria-hidden='true'></i>
                <span id='cart-count' class='cart-count'>
                  <?php echo $totalProducts ?: 0;
                  ?>
                </span>
              </a>
              <a href='wishlist.php' id='wishlist'>
                <i class='fa fa-heart' aria-hidden='true'></i>
              </a>
              <a href='userProfile.php' id='profile'>
                <i class='fa fa-user-circle-o' aria-hidden='true'></i>
              </a>
              <a href='buys.php' id="profile">
                <i class='fa fa-money' aria-hidden='true'></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
  </div>

  <main>
    <div class="faq-container">
      <h1>Preguntas Frecuentes</h1>
      <br><br>
      <div class="faq">
        <button class="accordion">¿Qué productos ofrece TotalFocus?<i class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>TotalFocus ofrece una amplia variedad de cámaras fotográficas, lentes, accesorios, y equipos de
            iluminación diseñados tanto para fotógrafos aficionados como profesionales.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Cómo puedo realizar una compra en TotalFocus?<i
            class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Para realizar una compra, simplemente selecciona los productos que deseas, añádelos al carrito de
            compras y procede a completar el proceso de pago. Puedes registrarte en nuestro sitio para
            guardar tus preferencias y facilitar futuras compras.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Cuáles son los métodos de pago aceptados en TotalFocus?<i
            class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Aceptamos tarjetas de crédito y débito, transferencias bancarias y servicios de pago en línea
            como PayPal. Nuestro sitio web utiliza sistemas de seguridad avanzados para proteger tus datos.
          </p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Ofrecen envíos internacionales?<i class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Sí, en TotalFocus realizamos envíos internacionales. Los costos y tiempos de entrega varían según
            el destino. Puedes consultar los detalles específicos durante el proceso de pago.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Cuál es la política de devoluciones y garantías?<i
            class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Ofrecemos una política de devoluciones de 30 días para productos no usados y en su empaque
            original. Además, todos nuestros productos cuentan con garantía de fábrica. Para más detalles,
            consulta nuestra sección de Términos y Condiciones.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Cómo puedo obtener asesoramiento sobre qué equipo comprar?<i
            class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Contamos con un equipo de expertos en fotografía que pueden asesorarte en la elección del equipo
            adecuado según tus necesidades. Puedes contactarnos a través de nuestro formulario en la página
            de soporte o mediante nuestro chat en vivo.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Puedo rastrear mi pedido?<i class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Sí, una vez que tu pedido haya sido enviado, recibirás un número de seguimiento que te permitirá
            rastrear el estado y ubicación de tu paquete en tiempo real.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Qué opciones de envío ofrecen?<i class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Ofrecemos varias opciones de envío, incluyendo envío estándar, exprés y entrega en el mismo día
            para ubicaciones específicas. Los costos varían según la opción seleccionada y el destino.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Cómo puedo contactar al soporte técnico?<i class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Si necesitas asistencia técnica, puedes comunicarte con nuestro equipo de soporte a través de
            correo electrónico, teléfono o nuestro chat en vivo. Estamos disponibles para ayudarte con
            cualquier consulta o problema.</p>
        </div>
      </div>
      <div class="faq">
        <button class="accordion">¿Qué promociones o descuentos ofrecen?<i class="fas fa-chevron-right"></i></button>
        <div class="panel">
          <p>Regularmente lanzamos promociones y descuentos exclusivos para nuestros clientes registrados.
            Asegúrate de suscribirte a nuestro boletín para no perderte nuestras ofertas especiales.</p>
        </div>
      </div>
    </div>
  </main>

  <!-- info section -->
  <section class="info_section layout_padding2">
    <div class="container">
      <div class="info_logo">
        <h2>
          Tiempo de fotografía
        </h2>
      </div>
      <div class="row">

        <div class="col-md-3">
          <div class="info_contact">
            <h5>
              Sobre la tienda
            </h5>
            <div>
              <div class="img-box">
                <img src="images/location-white.png" width="18px" alt="">
              </div>
              <p>
                España - Madrid
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/telephone-white.png" width="12px" alt="">
              </div>
              <a href="politic.php">Politica y Privacidad</a>
            </div>
            <div>
              <div class="img-box">
                <img src="images/envelope-white.png" width="18px" alt="">
              </div>
              <a href="faqs.php">FAQS</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_info">
            <h5>
              Informacion
            </h5>
            <p>
              Tiene como objetivo principal la satisfacción de nuestros clientes, ofreciendo productos de calidad y un
              servicio personalizado.
            </p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_insta">
            <h5>
              Instagram
            </h5>
            <div class="insta_container">
              <div class="row m-0">
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/slider-1.jpg" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/slider-2.jpg" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/slider-3.jpg" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/slider-4.jpg" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/slider-5.jpg" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/slider-2.jpg" alt="">
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_form ">
            <h5>
              Newsletter
            </h5>
            <form action="">
              <input type="email" placeholder="Enter your email">
              <button>
                Subscribe
              </button>
            </form>
            <div class="social_box">
              <a href="">
                <img src="images/fb.png" alt="">
              </a>
              <a href="">
                <img src="images/twitter.png" alt="">
              </a>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
              <a href="">
                <img src="images/youtube.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <section class='footer_section'>
    <div class='container'>
      <p>
        &copy;
        <span id='displayYear'></span> Todos los derechos reservados | Diseñado por
        <a href='#'>Miguel Sanz</a>
      </p>
    </div>
  </section>

  <!-- JavaScript para el acordeón FAQ -->
  <script>
    const accordions = document.querySelectorAll('.accordion');

    accordions.forEach(accordion => {
      accordion.addEventListener('click', function () {
        this.classList.toggle('active');
        const panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + 'px';
        }
      });
    });
  </script>

</body>

</html>