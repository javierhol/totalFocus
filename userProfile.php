<?php
// Incluir el archivo de conexión a la base de datos
require_once 'connect.php';
require_once 'queries.php';
session_start();

$totalProducts = 0;

if (isset($_SESSION['user'])) {
  $userId = $_SESSION['user']['id'];
  echo "<script>console.log('User: ', " . json_encode($userId) . ");</script>";
  $conn = getConnect();
  $totalProducts = getCartTotal($conn, $userId);

  try {


    $query = 'SELECT * FROM users WHERE id = ?';

    $statement = $conn->prepare($query);

    $statement->bind_param('i', $userId);

    $statement->execute();

    $result = $statement->get_result();

    if ($result->num_rows > 0) {
      $userData = $result->fetch_assoc();
      $username = $userData['username'];
      $email = $userData['email'];
      $img = $userData['img'];
      $address = $userData['address'];
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
  echo 'No hay datos de usuario en el localStorage';
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel='stylesheet' href='css/userProfile.css'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
    integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel='icon' href='images/fevicon/logo.png' type='image/gif' />
  <title>| TotalFocus</title>
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
                <a class='nav-link' href='index.php'>Inicio <span class='sr-only'></span></a>
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
                <span id="cart-count" class="cart-count"><?php echo $totalProducts ?: 0; ?></span>
              </a>
              <a href='wishlist.php' id='wishlist'>
                <i class='fa fa-heart' aria-hidden='true'></i>
              </a>
              <a href='userProfile.php' id='profile'>
                <i class='fa fa-user-circle-o' aria-hidden='true'></i>
              </a>
              <a href='buys.php' id='profile'>
                <i class='fa fa-money' aria-hidden='true'></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
  </div>

  <div class='container-xl px-4 mt-4'>
    <form id='edit-profile' method='POST' enctype='multipart/form-data'>
      <div class='row'>
        <div class='col-xl-4'>
          <div class='card mb-4 mb-xl-0'>
            <div class='card-header'>Foto de perfil</div>
            <div class='card-body text-center'>
              <img class='img-account-profile rounded border border-success mb-2'
                src="<?php echo isset($img) ? $img : 'https://bootdey.com/img/Content/avatar/avatar1.png'; ?>"
                alt='Foto de perfil'>

              <!-- boton upload img -->
              <div class="wrapper">
                <h2>Sube una imagen</h2>
                <input type="file" id="file-input" accept="image/png, image/jpeg" name="img">
                <label for="file-input">
                  <i class="fa fa-paperclip fa-2x"></i>
                  <span></span>
                </label>
                <i class="fa fa-times-circle remove"></i>
              </div>

            </div>
          </div>
        </div>
        <div class='col-xl-8'>
          <div class='card mb-4'>
            <div class='card-header'>Cuenta</div>

            <div class='card-body'>
              <div class='row gx-3 mb-3'>
                <div class='col-md-6'>
                  <label class='small mb-1' for='inputFirstName'>Nombre</label>
                  <input class='form-control' id='inputFirstName' type='text' name='username'
                    placeholder='Enter your first name' value="<?php echo isset($username) ? $username : ''; ?> "
                    disabled>
                </div>
                <div class='col-md-6'>
                  <label class='small mb-1' for='inputOrgName'>Correo</label>
                  <input class='form-control' id='email' type='email' name='email' placeholder='relaxifi@relax.com'
                    value="<?php echo isset($email) ? $email : ''; ?>" disabled>
                </div>
              </div>
              <div class='mb-3 input-field'>
                <label class='small mb-1' for='address'>Dirección</label>
                <input class='form-control ' id='address' type='text' name='address' value="<?php echo isset($address) ? $address : ''; ?>" placeholder='Calle 14 California '>
              </div>
              <div class='mb-3 input-field'>
                <label class='small mb-1' for='currentPassword'>Contraseña Actual</label>
                <input class='form-control ' id='currentPassword' type='password' name='currentPassword'
                  placeholder='Contraseña Actual'>
                <span class='toggle-password toggle'>
                  <img src='images/eye2.svg' alt='Mostrar/Ocultar' id='togglePassword'>
                </span>
              </div>
              <div class='mb-3 input-field'>
                <label class='small mb-1' for='newPassword'>Nueva Contraseña</label>
                <input class='form-control ' id='newPassword' type='password' name='newPassword'
                  placeholder='Nueva Contraseña'>
                <span class='toggle-password2 toggle'>
                  <img src='images/eye2.svg' alt='Mostrar/Ocultar' id='togglePassword2'>
                </span>
              </div>
              <div class='mb-3 input-field'>
                <label class='small mb-1' for='confirmPassword'>Confirma la contraseña</label>
                <input class='form-control ' id='confirmPassword' type='password' name='confirmPassword'
                  placeholder='Confirma tu Contraseña'>
                <span class='toggle-password3 toggle'>
                  <img src='images/eye2.svg' alt='Mostrar/Ocultar' id='togglePassword3'>
                </span>
              </div>
              <button class='btn btn-success' type='submit'>Guardar Cambios</button>
            </div>
          </div>
        </div>
      </div>
    </form>
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
  <script src='./js/editUser.js'></script>
  <script type='text/javascript' src='./js/custom.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js'></script>

</body>

</html>