<?php
require_once 'queries.php';
session_start();

// Inicializar variables
$totalProducts = 0;
$cartItems = [];


if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $totalProducts = getCartTotal($conn, $userId);
    $cartItems = getCartItems($conn, $userId);
}

echo "<script>console.log('Total Products: ', " . json_encode($totalProducts) . ");</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
  <title>| TotalFocus</title>
  <link rel="stylesheet" href="css/cart.css">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />


  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
  

  <link rel='stylesheet' type='text/css' href='css/card-shop.css' />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>

  <div class="hero_area">
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
              <li class="nav-item ">
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
                <span id="cart-count" class="cart-count"><?php echo $totalProducts ? : 0; ?></span>
              </a>
              <a href='wishlist.php' id="wishlist">
                <i class='fa fa-heart' aria-hidden='true'></i>
              </a>
              <a href='userProfile.php' id="profile">
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
    <!-- end header section -->
  </div>

<div class="cart-container">
    <h1>Shopping Cart</h1>
    <div class="cart-items">
      <?php if (!empty($cartItems)): ?>
        <?php foreach ($cartItems as $item): ?>
          <div class="cart-item">
            <img src="<?= $item['img']; ?>" alt="<?= $item['name']; ?>" class="cart-item-image">
            <div class="cart-item-details">
              <h3><?= $item['name']; ?></h3>
              <p>$<?= number_format($item['price'], 2); ?></p>
              <div class="cart-item-quantity">
                <label for="quantity-<?= $item['id']; ?>">Cantidad:</label>
                <input type="number" id="quantity-<?= $item['id']; ?>" value="<?= $item['quantity']; ?>" min="1">
              </div>
            </div>
            <button class="remove-btn" data-id="<?= $item['id']; ?>">Eliminar</button>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No tienes productos en tu carrito.</p>
      <?php endif; ?>
    </div>

    <div class="cart-summary">
      <?php
      $subtotal = array_reduce($cartItems, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
      $shipping = 5.00;
      $total = $subtotal + $shipping;
      $isCartEmpty = empty($cartItems); // Verificar si el carrito está vacío
      ?>
      <h2>Resumen del Carrito</h2>
      <p>Subtotal: $<?= number_format($subtotal, 2); ?></p>
      <p>Envio: $<?= number_format($shipping, 2); ?></p>
      <p><strong>Total: $<?= number_format($total, 2); ?></strong></p>
      <button 
        type="button" 
        class="checkout-btn <?= $isCartEmpty ? 'disabled-btn' : ''; ?>" 
        <?= $isCartEmpty ? 'disabled' : ''; ?> 
        title="<?= $isCartEmpty ? 'El carrito está vacío' : ''; ?>">
        Comprar
      </button>
    </div>
</div>


<!-- Modal -->
<div id="checkoutModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Información de Pago y Envío</h2>
    <form id="checkoutForm">
      <div>
        <label for="cardNumber">Número de Tarjeta</label>
        <input type="text" id="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX" required maxlength="16">
      </div>
      <div>
        <label for="cardName">Nombre del Titular</label>
        <input type="text" id="cardName" placeholder="Nombre en la tarjeta" required>
      </div>
      <div>
        <label for="expirationDate">Fecha de Expiración</label>
        <input type="month" id="expirationDate" required min="2024-01">
      </div>
      <div>
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" placeholder="XXX" required maxlength="3">
      </div>
      <div>
        <label for="address">Dirección de Envío</label>
        <input type="text" id="address" placeholder="Dirección completa" required>
      </div>
    </form>
    <button id="confirmCheckout">Confirmar Compra</button>
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
              Información
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

<script>
  const cartItems = <?= json_encode($cartItems); ?>;
</script>

  <script type="text/javascript" src="js/cart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

</body>

</html>