<?php
require_once 'queries.php';
session_start();

$totalProducts = 0;
if (isset($_SESSION['user'])) {
  $userId = $_SESSION['user']['id'];
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
                 <span class='product-catagory'>Stock: {$row['stock']}</span>
                    <h4><a href=''>{$row['name']}</a></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                    <div class='product-bottom-details'>
                        <div class='product-price'>$" . number_format($row['price'], 2) . "</div>
                        <div class='product-links'>
                            <a href='javascript:void(0)' id='wishlist' class='add-wishlist'><i class='fa fa-heart'></i></a>
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
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon/logo.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title> | TotalFocus</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />


  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <link rel='stylesheet' type='text/css' href='css/card-shop.css' />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <img class="image-tittle" src="images/title.png" alt="Logo TotalFocus">
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item active">
                <a class="nav-link" href="product.php">Productos</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='about.php'>Conocenos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contactMe.php">Contactanos</a>
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
              <a href='buys.php' id="buy">
                <i class='fa fa-money' aria-hidden='true'></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- product section -->
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

  <!-- end product section -->

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

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <script type="text/javascript" src="js/addCart.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>


</body>

</html>