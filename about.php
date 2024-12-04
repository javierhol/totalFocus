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
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
  <link rel='stylesheet' href='css/about.css'>
  <link rel='stylesheet' href='css/wishlist.css'>
  <link rel='stylesheet' type='text/css' href='css/card-shop.css' />
  <link href='css/font-awesome.min.css' rel='stylesheet' />
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

              <li class='nav-item active'>
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
              <a href='buys.php' id="buy">
                <i class='fa fa-money' aria-hidden='true'></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
  </div>

  <section id='nosotros'>
    <div class='contenido'>
      <div class='fila'>
        <div class='col'>
          <h2 class='titulo-seccion'>Sobre <span class='resaltado'>nosotros</span></h2>
          <p>Somos una empresa apasionada por la fotografía y la tecnología, dedicada a ofrecer una
            experiencia única a nuestros clientes a través de productos de alta calidad y servicios
            personalizados.</p>

          <div class='skills'>
            <p> <span class='punto'></span> Amplia experiencia en e-commerce fotográfico</p>
            <div class='barra-skill'>
              <div class='progreso' id='dw'>
                <span>95%</span>
              </div>
            </div>

            <p> <span class='punto'></span> Asesoría personalizada para fotógrafos</p>
            <div class='barra-skill'>
              <div class='progreso' id='dg'>
                <span>90%</span>
              </div>
            </div>

            <p> <span class='punto'></span> Compromiso con la innovación en productos fotográficos</p>
            <div class='barra-skill'>
              <div class='progreso' id='bd'>
                <span>85%</span>
              </div>
            </div>

            <p> <span class='punto'></span> Sostenibilidad en todas nuestras operaciones</p>
            <div class='barra-skill'>
              <div class='progreso' id='md'>
                <span>80%</span>
              </div>
            </div>
          </div>

        </div>
        <div class='col'>
          <div class='circulo-principal'></div>
          <img src='images/cam1.png' alt=''>
        </div>
      </div>
    </div>
  </section>

  <!-- sección articulos -->
  <section id='articulos'>
    <div class='contenido'>
      <h2 class='titulo-seccion'>Artículos sobre <span class='resaltado'>fotografía</span></h2>
      <div class='fila'>
        <div class='col'>
          <div class='numero-curso'>
            .01
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>técnicas de iluminación</span>
          </h3>
          <hr>
          <p>Aprende cómo sacar el mejor provecho de la luz natural y artificial en tus sesiones fotográficas
            para obtener resultados espectaculares.</p>
          <button class='btn-primary' onclick="window.location.href="
            https://www.dpreview.com/articles/123456789/lighting-tips">LEER
            MÁS</button>
        </div>
        <div class='col'>
          <div class='numero-curso'>
            .02
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>composición fotográfica</span>
          </h3>
          <hr>
          <p>Descubre los secretos de la composición fotográfica y cómo aplicar la regla de los tercios y el
            equilibrio visual en tus imágenes.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://www.flickr.com/groups/photography/articles/composition-tips'">LEER
            MÁS</button>
        </div>
        <div class='col'>
          <div class='numero-curso'>
            .03
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>fotografía nocturna</span>
          </h3>
          <hr>
          <p>Sumérgete en el mundo de la fotografía nocturna y aprende cómo capturar impresionantes imágenes
            de paisajes urbanos de noche.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://photographyblogger.com/2023/11/30/night-photography-tips'">LEER
            MÁS</button>
        </div>
        <div class='col'>
          <div class='numero-curso'>
            .04
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>edición fotográfica</span>
          </h3>
          <hr>
          <p>Domina las mejores técnicas de edición fotográfica para mejorar la calidad de tus imágenes con
            herramientas profesionales.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://www.photoeditors.com/how-to-edit-photos-for-beginners'">LEER
            MÁS</button>
        </div>
      </div>

      <!-- Separación para los nuevos artículos -->
      <div class='fila'>
        <div class='col'>
          <div class='numero-curso'>
            .05
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>fotografía de retratos</span>
          </h3>
          <hr>
          <p>Aprende las mejores técnicas para capturar retratos impresionantes, desde la iluminación hasta la
            poses y el enfoque.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://www.diyphotography.net/how-to-photograph-portraits-like-a-pro/'">LEER
            MÁS</button>
        </div>
        <div class='col'>
          <div class='numero-curso'>
            .06
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>fotografía de paisaje</span>
          </h3>
          <hr>
          <p>Descubre cómo capturar paisajes naturales con la mejor luz, composición y equipo para obtener
            imágenes espectaculares.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://www.photographytalk.com/how-to-photograph-landscapes-like-a-pro'">LEER
            MÁS</button>
        </div>
        <div class='col'>
          <div class='numero-curso'>
            .07
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>fotografía en blanco y negro</span>
          </h3>
          <hr>
          <p>Conoce las técnicas para crear impactantes fotos en blanco y negro, y cómo los contrastes y
            sombras pueden dar vida a tus imágenes.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://www.digital-photography-school.com/black-and-white-photography-tips/'">LEER
            MÁS</button>
        </div>
        <div class='col'>
          <div class='numero-curso'>
            .08
          </div>
          <h3 class='titulo-curso'>
            Artículo sobre <span class='resaltado'>fotografía de comida</span>
          </h3>
          <hr>
          <p>Aprende a capturar imágenes deliciosas de alimentos utilizando luz, ángulos y composición
            adecuados para obtener fotos atractivas.</p>
          <button class='btn-primary'
            onclick="window.location.href='https://www.foodphotographyacademy.com/blog/food-photography-tips-and-tricks'">LEER
            MÁS</button>
        </div>
      </div>
    </div>

  </section>

  <!-- numeros -->
  <section id='numeros'>
    <div class='contenido'>
      <div class='fila'>
        <div class='col'>
          <span class='mas'>+</span>
          <div class='num' id='contProyectos'>0</div>
          <div class='texto'>
            <strong>PRODUCTOS</strong> <br>VENDIDOS
          </div>
        </div>
        <div class='col'>
          <span class='mas'>+</span>
          <div class='num' id='contClientes'>0</div>
          <div class='texto'>
            <strong>CLIENTES</strong> <br>SATISFECHOS
          </div>
        </div>
        <div class='col'>
          <span class='mas'>+</span>
          <div class='num' id='contCursos'>0</div>
          <div class='texto'>
            NUMERO <br> <strong>DE DISTRIBUIDORES</strong>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- sección clientes satisfechos -->
  <section id='clientes'>
    <div class='contenido'>
      <div class='fila'>
        <div class='col'>
          <div class='circulo-principal'></div>
          <img src='images/cam2.png' alt=''>
        </div>
        <div class='col col-historia'>
          <h2 class='titulo-seccion'>Clientes <br> <span class='resaltado subir'>satisfechos</span></h2>
          <div class='cliente'>
            <img src='images/cliente1.jpg' alt=''>
            <div class='info-cliente'>
              <h3>Lucas R.</h3>
              <div class='estrellas'>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star'></i>
                <p> 'La mejor tienda online para fotógrafos. Encontré todo lo que necesitaba y el
                  servicio de atención al cliente fue excelente.'</p>
              </div>
            </div>
          </div>
          <div class='cliente'>
            <img src='images/cliente2.jpg' alt=''>
            <div class='info-cliente'>
              <h3>Matt Q.</h3>
              <div class='estrellas'>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star'></i>
                <p> 'Mi primera compra de equipo fotográfico fue en esta tienda y no podría estar más
                  satisfecho. Recomiendo totalmente esta tienda.' </p>
              </div>
            </div>
          </div>
          <div class='cliente'>
            <img src='images/cliente3.jpg' alt=''>
            <div class='info-cliente'>
              <h3>Nina J.</h3>
              <div class='estrellas'>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star relleno'></i>
                <i class='fa-solid fa-star'></i>
                <p> 'Un sitio de confianza para comprar cámaras y accesorios. El envío fue rápido y el
                  servicio al cliente increíble. ¡Volveré seguro!'</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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

  <script src="js/about.js"></script>
</body>

</html>