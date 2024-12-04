<?php
require_once 'queries.php';
session_start();

// Inicializar variables
$totalProducts = 0;
$wishListItems = [];

if (isset($_SESSION['user'])) {
  $userId = $_SESSION['user']['id'];
  echo "<script>console.log('WishListItems: ', " . json_encode($userId) . ");</script>";
  $totalProducts = getCartTotal($conn, $userId);
  $wishListItems = getProductsWhislist($conn, $userId);


}
function renderProducts($products)
{
  if (!empty($products)) {
    foreach ($products as $row) {
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
                            <a href='javascript:void(0)' class='delete-wishlist' data-id='{$row['id']}' id='wishlist'><i class='fa fa-trash'></i></a>
                            <a href='javascript:void(0)' class='add-cart' data-id='{$row['id']}' data-origin='wishlist'><i class='fa fa-shopping-cart'></i></a>
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
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
  <title>| TotalFocus</title>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
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
                <a class='nav-link' href='about.php'>Conocenos</a>
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
  <h1 class='text-center mb-4'>Lista de Deseos</h1>
  <section class='product_section'>
    <div class='container'>
      <div class='product_container'>
        <?php renderProducts($wishListItems); ?>
      </div>
    </div>
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
  </section>
  <script type='text/javascript' src='js/wishlist.js'></script>
  <script type='text/javascript' src='js/addCart.js'></script>
  <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
</body>

</html>