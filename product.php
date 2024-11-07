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

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
             
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contactanos</a>
              </li>
            </ul>
            <div class='user_optio_box'>
              <a href='login.html' id="login">
                <i class='fa fa-user' aria-hidden='true'></i>
              </a>
              <a href='' id="logout">
                <i class="fa fa-sign-out" aria-hidden='true'></i>
              </a>
              <a href='cart.html' id='cart'>
                <i class='fa fa-shopping-cart' aria-hidden='true'></i>
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
  </div>

  <!-- product section -->
  <?php
include 'connect.php';

$conn = getConnect();

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

function getProducts($conn, $limit, $offset) {
    $sql = "SELECT name, price, img FROM products LIMIT $limit OFFSET $offset";
    return $conn->query($sql);
}

?>

<section class='product_section '>
    <div class='container'>
        <div class='product_heading'>
            <h2>Cámaras Destacadas</h2>
        </div>
        <div class='product_container'>
            <?php
            $result = getProducts($conn, 3, 0); 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo " <div class='product-card'>
                  <div class='badge'>Hot</div>
                  <div class='product-tumb'>
                    <img src=" . $row['img'] . " alt=''>
                  </div>
                  <div class='product-details'>
                    <span class='product-catagory'>Women,bag</span>
                    <h4><a href=''>" . $row['name'] . "</a></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                    <div class='product-bottom-details'>
                      <div class='product-price'><small>$96.00</small>" . number_format($row['price'], 2) . "</div>
                      <div class='product-links'>
                        <a href=''><i class='fa fa-heart' id='wishlist'></i></a>
                        <a href=''><i class='fa fa-shopping-cart' id='cart'></i></a>
                      </div>
                    </div>
                  </div>
                </div>";
                }
            } else {
                echo '<p>No hay productos disponibles.</p>';
            }
            ?>
        </div>
    </div>
</section>

<section class='product_section '>
    <div class='container'>
        <div class='product_heading'>
            <h2>Cámaras en Oferta</h2>
        </div>
        <div class='product_container'>
            <?php
            $result = getProducts($conn, 3, 3);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo " <div class='product-card'>
              <div class='badge'>Ofert</div>
              <div class='product-tumb'>
                <img src=" . $row['img'] . " alt=''>
              </div>
              <div class='product-details'>
                <span class='product-catagory'>Women,bag</span>
                <h4><a href=''>" . $row['name'] . "</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                <div class='product-bottom-details'>
                  <div class='product-price'><small>$96.00</small>" . number_format($row['price'], 2) . "</div>
                  <div class='product-links'>
                    <a href=''><i class='fa fa-heart' id='wishlist'></i></a>
                    <a href=''><i class='fa fa-shopping-cart' id='cart'></i></a>
                  </div>
                </div>
              </div>
	          </div>";
                }
            } else {
                echo "<p>No hay más productos disponibles.</p>";
            }
            ?>
        </div>
    </div>
</section>

<section class='product_section '>
    <div class='container'>
        <div class='product_heading'>
            <h2>New Arrivals</h2>
        </div>
        <div class='product_container'>
            <?php
            $result = getProducts($conn, 3, 6); 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo " <div class='product-card'>
                  <div class='badge'>Newly</div>
                  <div class='product-tumb'>
                    <img src=" . $row['img'] . " alt=''>
                  </div>
                  <div class='product-details'>
                    <span class='product-catagory'>Women,bag</span>
                    <h4><a href=''>" . $row['name'] . "</a></h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
                    <div class='product-bottom-details'>
                      <div class='product-price'><small>$96.00</small>" . number_format($row['price'], 2) . "</div>
                      <div class='product-links'>
                        <a href=''><i class='fa fa-heart' id='wishlist'></i></a>
                        <a href=''><i class='fa fa-shopping-cart' id='cart'></i></a>
                      </div>
                    </div>
                  </div>
                </div>";
                }
            } else {
                echo "<p>No hay más productos disponibles.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php
// Cerrar la conexión
$conn->close();
?>


  <!-- end product section -->

  <!-- info section -->
  <section class="info_section layout_padding2">
    <div class="container">
      <div class="info_logo">
        <h2>
          Tiempo de fotografia
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
              <p>
                +34 1234567890
              </p>
            </div>
            <div>
              <div class="img-box">
                <img src="images/envelope-white.png" width="18px" alt="">
              </div>
              <p>
                totalfocus@gmail.com
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_info">
            <h5>
              Información
            </h5>
            <p>
            Tiene como objetivo principal la satisfacción de nuestros clientes, ofreciendo productos de calidad y un servicio personalizado.
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
                      <img src="images/1.jpg" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/w2.png" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/w3.png" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/w4.png" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/w5.png" alt="">
                    </div>
                  </a>
                </div>
                <div class="col-4 px-0">
                  <a href="">
                    <div class="insta-box b-1">
                      <img src="images/w6.png" alt="">
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
              Enterate de las novedades!
            </h5>
            <form action="">
              <input type="email" placeholder="Ingresa tu email">
              <button>
                Suscribete
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
  <section class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span>Todos los derechos reservados | Diseñado por
        <a href="https://html.design/">Miguel Sanz</a>
      </p>
    </div>
  </section>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>


</body>

</html>