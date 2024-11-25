<?php
require_once 'queries.php';
session_start();

// Inicializar variables
$totalProducts = 0;
$wishListItems = [];

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
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
    </section>
    <script type='text/javascript' src='js/wishlist.js'></script>
    <script type='text/javascript' src='js/addCart.js'></script>
    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
</body>

</html>