<?php
require_once 'config.php';
require_once 'queries.php';
session_start();

$totalProducts = 0;
if (isset($_SESSION['user'])) {
  $userId = $_SESSION['user'];
  $totalProducts = getCartTotal($conn, $userId);
}

// Renderizar productos destacados
$featuredProducts = getProducts($conn, 3, 0);

// Renderizar productos en oferta
$discountedProducts = getProducts($conn, 3, 3);

// Renderizar productos recién llegados
$newArrivals = getProducts($conn, 3, 6);

$conn->close();

function renderProducts($products)
{
  if ($products->num_rows > 0) {
    while ($row = $products->fetch_assoc()) {
      echo "
            <div class='product-card'>
                <div class='badge'>Hot</div>
                <div class='product-tumb'>
                    <img src='{$row['img']}' alt=''>
                </div>
                <div class='product-details'>
                    <h4><a href=''>{$row['name']}</a></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                    <div class='product-bottom-details'>
                        <div class='product-price'>$" . number_format($row['price'], 2) . "</div>
                        <div class='product-links'>
                            <a href='javascript:void(0)' class='add-wishlist' data-id='{$row['id']}'  id='wishlist'><i class='fa fa-heart'></i></a>
                            <a href='javascript:void(0)' class='add-cart' data-id='{$row['id']}'><i class='fa fa-shopping-cart'></i></a>
                        </div>
                    </div>
                </div>
            </div>";
    }
  } else {
    echo "<p>No hay productos disponibles.</p>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset='utf-8' />
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <!-- Mobile Metas -->
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <!-- Site Metas -->
  <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
  <meta name='keywords' content='' />
  <meta name='description' content='' />
  <meta name='author' content='' />

  <title> | TotalFocus</title>

  <!-- bootstrap core css -->
  <link rel='stylesheet' type='text/css' href='css/bootstrap.css' />
  <link rel='stylesheet' type='text/css' href='css/card-shop.css' />

  <!-- fonts style -->
  <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap' rel='stylesheet'>

  <!-- font awesome style -->
  <link href='css/font-awesome.min.css' rel='stylesheet' />

  <!-- Custom styles for this template -->
  <link href='css/style.css' rel='stylesheet' />
  <!-- responsive style -->
  <link href='css/responsive.css' rel='stylesheet' />

</head>

<body>

  <div class='hero_area'>
    <!-- header section strats -->
    <header class='header_section'>
      <div class='container-fluid'>
        <nav class='navbar navbar-expand-lg custom_nav-container '>
          <a class='navbar-brand' href='index.html'>
            <img class="image-tittle" src="images/title.png" alt="Logo TotalFocus">
          </a>

          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent'
            aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class=''> </span>
          </button>

          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav  '>
              <li class='nav-item active'>
                <a class='nav-link' href='index.php'>Inicio <span class='sr-only'>( current )</span></a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='product.php'>Productos</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='contactMe.php'>Contacto</a>
              </li>
            </ul>
            <div class='user_optio_box'>
              <a href='login.html' id="login">
                <i class='fa fa-user' aria-hidden='true'></i>
              </a>
              <a href='' id="logout">
                <i class="fa fa-sign-out" aria-hidden='true'></i>
              </a>
              <a href='cart.php' id='cart'>
                <i class='fa fa-shopping-cart' aria-hidden='true'></i>
                <span id="cart-count" class="cart-count"><?php echo $totalProducts ?: 0; ?></span>
              </a>
              <a href='wishlist.php' id="wishlist">
                <i class='fa fa-heart' aria-hidden='true'></i>
              </a>
              <a href='userProfile.php' id="profile">
                <i class='fa fa-user-circle-o' aria-hidden='true'></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
      <ol class='carousel-indicators'>
        <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='3'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='4'></li>
      </ol>
      <div class='carousel-inner'>
        <div class='carousel-item active'>
          <img class='d-block w-100' src='images/slider-1.jpg' alt='First slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-2.jpg' alt='Second slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-3.jpg' alt='Third slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-4.jpg' alt='Third slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-5.jpg' alt='Third slide'>
        </div>
      </div>
      <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
        <span class='sr-only'>Previous</span>
      </a>
      <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
        <span class='carousel-control-next-icon' aria-hidden='true'></span>
        <span class='sr-only'>Next</span>
      </a>
    </div>

    <!-- end slider section -->
  </div>

  <!-- service section -->

  <section class='service_section'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-1.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Entrega Rapida
              </h5>
              <p>
                Confia en nosotros para una entrega rapida
              </p>
            </div>
          </div>
        </div>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-2.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Mejor Precio
              </h5>
              <p>
                Aqui encontraras los mejores precios
              </p>
            </div>
          </div>
        </div>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-3.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Mjeor Calidad
              </h5>
              <p>
                Productos de la mejor calidad
              </p>
            </div>
          </div>
        </div>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-4.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Soporte 24/7
              </h5>
              <p>
                Soporte 24/7 para cualquier duda
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class='product_section'>
    <div class='container'>
      <div class='product_heading'>
        <h2>Cámaras Destacadas</h2>
      </div>
      <div class='product_container'>
        <?php renderProducts($featuredProducts); ?>
      </div>
    </div>
  </section>

  <section class='product_section'>
    <div class='container'>
      <div class='product_heading'>
        <h2>Cámaras en Oferta</h2>
      </div>
      <div class='product_container'>
        <?php renderProducts($discountedProducts); ?>
      </div>
    </div>
  </section>

  <section class='product_section'>
    <div class='container'>
      <div class='product_heading'>
        <h2>Recien Llegados</h2>
      </div>
      <div class='product_container'>
        <?php renderProducts($newArrivals); ?>
      </div>
    </div>
  </section>



  <!-- contact section -->
  <section class='contact_section layout_padding'>
    <div class='container'>
      <div class='heading_container'>
        <h2>
          Contactanos
        </h2>
      </div>
      <div class='row'>
        <div class='col-md-6'>
          <div class='form_container'>
            <form action='' id="contact-form">
              <div>
                <input name="name" id="name" type="text" placeholder="Tu nombre" />
              </div>
              <div>
                <input type="email" name="email" id="email" placeholder="Tu correo" />
              </div>
              <div>
                <input type="text" name="theme" id="theme" placeholder="Pon tu un titulo" />
              </div>
              <div>
                <input type="text" name="message" id="message" class="message-box" placeholder="Expresate aqui..." />
              </div>
              <div class='btn_box'>
                <button>
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class='col-md-6 '>
          <div class='map_container'>
            <div class='map'>
              <div id='googleMap'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

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
  <!-- footer section -->

  <!-- jQery -->
  <script type='text/javascript' src='js/jquery-3.4.1.min.js'></script>
  <!-- popper js -->
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'
    integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'>
    </script>
  <!-- bootstrap js -->
  <script type='text/javascript' src='js/bootstrap.js'></script>
  <!-- custom js -->
  <script type='text/javascript' src='js/custom.js'></script>
  <script type='text/javascript' src='js/addCart.js' defer></script>
  <script type="text/javascript" src="js/contact.js"></script>
  <!-- Google Map -->
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap'>
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <!-- End Google Map -->

</body>

</html>

</html>