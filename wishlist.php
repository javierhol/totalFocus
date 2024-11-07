<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
    <title>| TotalFocus</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/wishlist.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" />
</head>

<body>

    <div class="hero_area">
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="index.php">
                        <img class="image-tittle" src="images/title.png" alt="Logo TotalFocus">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
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
    </div>


    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Deseos</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="product1.jpg" alt="Producto 1" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Producto 1</h5>
                        <p class="card-text">$24.99</p>
                        <button class="btn btn-danger">Eliminar de la Lista de Deseos</button>
                        <button class="btn btn-primary mt-2">Agregar al Carrito</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="product2.jpg" alt="Producto 2" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Producto 2</h5>
                        <p class="card-text">$19.99</p>
                        <button class="btn btn-danger">Eliminar de la Lista de Deseos</button>
                        <button class="btn btn-primary mt-2">Agregar al Carrito</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="product3.jpg" alt="Producto 3" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Producto 3</h5>
                        <p class="card-text">$39.99</p>
                        <button class="btn btn-danger">Eliminar de la Lista de Deseos</button>
                        <button class="btn btn-primary mt-2">Agregar al Carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>