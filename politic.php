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
  <link rel='stylesheet' href='css/politic.css'>
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
    <!-- POLÍTICA DE PRIVACIDAD DE TOTALFOCUS -->
    <div>
      <div>
        <h1>Política de Privacidad de TotalFocus</h1>

        <h2>1. Quiénes Somos</h2>
        <p>TotalFocus (totalfocus.com) es una plataforma de comercio electrónico especializada en la venta de
          cámaras fotográficas y accesorios relacionados, ofreciendo productos de calidad para entusiastas y
          profesionales de la fotografía.</p>

        <h2>2. Comentarios</h2>
        <p>Cuando los usuarios dejan comentarios o reseñas en nuestro sitio, recopilamos la información
          proporcionada en el formulario correspondiente, además de la dirección IP del visitante y la cadena
          de agentes de usuario del navegador para ayudar a la detección de actividades no deseadas.</p>
        <p>Si tienes una imagen de perfil asociada a tu dirección de correo electrónico, esta puede mostrarse
          junto a tu comentario después de ser aprobado, mejorando la interacción en nuestra comunidad.</p>

        <h2>3. Medios</h2>
        <p>Al subir contenido multimedia, como imágenes de productos o fotografías, recomendamos evitar incluir
          datos de ubicación (GPS EXIF) en los archivos. Los visitantes del sitio podrían descargar y extraer
          esta información.</p>

        <h2>4. Cookies</h2>
        <p>Utilizamos cookies para mejorar tu experiencia de compra. Si decides dejar una reseña, puedes optar
          por guardar tu nombre, correo electrónico y otros datos en cookies para tu conveniencia en futuras
          interacciones.</p>
        <p>Asimismo, utilizamos cookies temporales para verificar si tu navegador acepta cookies y para
          almacenar información relacionada con tu inicio de sesión y preferencias de visualización.</p>

        <h2>5. Contenido Incrustado de Otros Sitios Web</h2>
        <p>Nuestro sitio puede incluir contenido incrustado (como vídeos de productos, imágenes o artículos) de
          otras fuentes. Este contenido se comporta de la misma manera que si visitaras directamente esos
          sitios.</p>
        <p>Es posible que estas fuentes recopilen datos sobre ti, utilicen cookies y rastreen tu interacción con
          el contenido incrustado, especialmente si tienes una cuenta y estás conectado a esos sitios.</p>

        <h2>6. Con Quién Compartimos tus Datos</h2>
        <p>Los datos recopilados en TotalFocus se utilizan exclusivamente para procesar pedidos y mejorar la
          experiencia del usuario. No compartimos tu información personal con terceros, excepto en casos
          necesarios para cumplir con la ley o para gestionar transacciones seguras.</p>

        <h2>7. Almacenamiento y Eliminación de Datos</h2>
        <p>Los comentarios, reseñas y sus metadatos se conservan indefinidamente para facilitar la gestión de la
          comunidad y mejorar la experiencia del cliente. Si tienes una cuenta en nuestro sitio, puedes
          solicitar la eliminación de tus datos personales en cualquier momento.</p>

        <h2>8. Uso de Datos</h2>
        <p>La información recopilada se utiliza para personalizar tu experiencia de compra, procesar pedidos,
          gestionar envíos y brindarte soporte al cliente. En TotalFocus nos comprometemos a garantizar la
          seguridad de tus datos en todo momento.</p>

        <h2>9. Contacto</h2>
        <p>Si tienes alguna pregunta o inquietud acerca de nuestra Política de Privacidad, puedes ponerte en
          contacto con nosotros a través del formulario de contacto disponible en nuestro sitio web.</p>

        <p class="last-version">Última actualización: 04/11/2024</p>
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

</body>

</html>