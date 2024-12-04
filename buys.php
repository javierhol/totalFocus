<?php
require_once 'queries.php';
session_start();

// Inicializar variables
$totalProducts = 0;
$buys = [];

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $totalProducts = getCartTotal($conn, $userId);
    $buys = getBuys($conn, $userId);

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
    <link rel='stylesheet' href='css/buys.css'>
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

                    <button class='navbar-toggler' type='button' data-toggle='collapse'
                        data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent'
                        aria-expanded='false' aria-label='Toggle navigation'>
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

    <h1><span class="blue">Mis Compras</span>
    </h1>

    <table class="container">
        <thead>
            <tr>
                <th>
                    <h1>Nombre Camara</h1>
                </th>
                <th>
                    <h1>Direccion</h1>
                </th>
                <th>
                    <h1>Cantidad</h1>
                </th>
                <th>
                    <h1>Fecha Compra</h1>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($buys)): ?>
                <?php foreach ($buys as $buy): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($buy['name']); ?></td>
                        <td><?php echo htmlspecialchars($buy['address']); ?></td>
                        <td><?php echo htmlspecialchars($buy['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($buy['shipping_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No has realizado compras aún.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>