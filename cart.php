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

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

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
              <a href='cart.php' id='cart'>
                <i class='fa fa-shopping-cart' aria-hidden='true'></i>
                <span id="cart-count" class="cart-count">0</span>
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

  <?php
// Incluir archivo de conexión
require_once 'connect.php';

// Conectar a la base de datos
$conn = getConnect();

// Verificar si el usuario está en la sesión
session_start();
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    // Consulta para obtener los productos en el carrito del usuario actual
    // usando un JOIN entre las tablas cart y products
    $cart_query = "
      SELECT cart.quantity, products.id, products.name, products.price, products.img
      FROM cart
      INNER JOIN products ON cart.product_id = products.id
      WHERE cart.user_id = $userId";
      
    $cart_result = mysqli_query($conn, $cart_query);

    if ($cart_result) {
        $cart_items = mysqli_fetch_all($cart_result, MYSQLI_ASSOC);
    } else {
        echo 'Error en la consulta: ' . mysqli_error($conn);
    }
} else {
    echo 'No hay datos de usuario en la sesión';
}
?>


  <div class="cart-container">
    <h1>Shopping Cart</h1>

    <!-- Cart Items -->
    <div class="cart-items">
      <?php if (!empty($cart_items)): ?>
        <?php foreach ($cart_items as $item): ?>
          <div class="cart-item">
            <!-- Puedes obtener la imagen del producto de tu base de datos si tienes una columna para ello -->
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

    <!-- Cart Summary -->
    <div class="cart-summary">
      <?php
      // Calcular el subtotal y el total
      $subtotal = 0;
      $shipping = 5.00; // Precio de envío fijo
      if (!empty($cart_items)) {
        foreach ($cart_items as $item) {
          $subtotal += $item['price'] * $item['quantity'];
        }
      }
      $total = $subtotal + $shipping;
      ?>
      <h2>Resumen del Carrito</h2>
      <p>Subtotal: $<?= number_format($subtotal, 2); ?></p>
      <p>Envio: $<?= number_format($shipping, 2); ?></p>
      <p><strong>Total: $<?= number_format($total, 2); ?></strong></p>
      <button class="checkout-btn">Comprar</button>
    </div>
  </div>


  <script type="text/javascript" src="js/cart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> 

</body>

</html>