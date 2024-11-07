<?php
// Incluir el archivo de conexión a la base de datos
require_once "connect.php";
session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    try {
        $conn = getConnect();

        $query = "SELECT * FROM users WHERE id = ?";

        $statement = $conn->prepare($query);

        $statement->bind_param("i", $userId);

        $statement->execute();

        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $username = $userData['username'];
            $email = $userData['email'];
            $img = $userData['img'];
        } else {
            echo 'No se encontró ningún usuario con el ID proporcionado';
        }
    } catch (Exception $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    } finally {
        $statement->close();
        $conn->close();
    }
} else {
    echo "No hay datos de usuario en el localStorage";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userProfile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
    <title>| TotalFocus</title>
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
                                <a class="nav-link" href="index.php">Inicio <span class="sr-only"></span></a>
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

    <div class="container-xl px-4 mt-4">
        <form id="edit-profile" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Foto de perfil</div>
                        <div class="card-body text-center">
                            <img class="img-account-profile rounded border border-success mb-2"
                                src="<?php echo isset($img) ? $img : 'https://bootdey.com/img/Content/avatar/avatar1.png'; ?>"
                                alt="Foto de perfil">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-header">Cuenta</div>

                        <div class="card-body">
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Nombre</label>
                                    <input class="form-control" id="inputFirstName" type="text" name="username"
                                        placeholder="Enter your first name"
                                        value="<?php echo isset($username) ? $username : ''; ?> " disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Correo</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="relaxifi@relax.com"
                                        value="<?php echo isset($email) ? $email : ''; ?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="currentPassword">Contraseña Actual</label>
                                <input class="form-control" id="currentPassword" type="password" name="currentPassword"
                                    placeholder="Contraseña Actual">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="newPassword">Nueva Contraseña</label>
                                <input class="form-control" id="newPassword" type="password" name="newPassword"
                                    placeholder="Nueva Contraseña">
                            </div>
                            <button class="btn btn-success" type="submit">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="./js/editUser.js"></script>
    <script type="text/javascript" src="./js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

</body>

</html>