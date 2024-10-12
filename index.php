<?php include 'config.php';
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset='utf-8' />
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <!-- Mobile Metas -->
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
  <!-- Site Metas -->
  <link rel='icon' href='images/fevicon/fevicon.png' type='image/gif' />
  <meta name='keywords' content='' />
  <meta name='description' content='' />
  <meta name='author' content='' />

  <title>TotalFocus</title>

  <!-- bootstrap core css -->
  <link rel='stylesheet' type='text/css' href='css/bootstrap.css' />

  <!-- fonts style -->
  <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap' rel='stylesheet'>

  <!-- font awesome style -->
  <link href='css/font-awesome.min.css' rel='stylesheet' />

  <!-- Custom styles for this template -->
  <link href='css/style.css' rel='stylesheet' />
  <!-- responsive style -->
  <link href='css/responsive.css' rel='stylesheet' />

</head>

<body>

  <div class='hero_area'>
    <!-- header section strats -->
    <header class='header_section'>
      <div class='container-fluid'>
        <nav class='navbar navbar-expand-lg custom_nav-container '>
          <a class='navbar-brand' href='index.html'>
            <span>
              TotalFocus
            </span>
          </a>

          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent'
            aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class=''> </span>
          </button>

          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav  '>
              <li class='nav-item active'>
                <a class='nav-link' href='index.html'>Inicio <span class='sr-only'>( current )</span></a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='product.html'>Productos</a>
              </li>

              <li class='nav-item'>
                <a class='nav-link' href='contact.html'>Contacto</a>
              </li>
            </ul>
            <div class='user_optio_box'>
              <a href='/login.html'>
                <i class='fa fa-user' aria-hidden='true'></i>
              </a>
              <a href=''>
                <i class='fa fa-shopping-cart' aria-hidden='true'></i>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
      <ol class='carousel-indicators'>
        <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='3'></li>
        <li data-target='#carouselExampleIndicators' data-slide-to='4'></li>
      </ol>
      <div class='carousel-inner'>
        <div class='carousel-item active'>
          <img class='d-block w-100' src='images/slider-1.jpg' alt='First slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-2.jpg' alt='Second slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-3.jpg' alt='Third slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-4.jpg' alt='Third slide'>
        </div>
        <div class='carousel-item'>
          <img class='d-block w-100' src='images/slider-5.jpg' alt='Third slide'>
        </div>
      </div>
      <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
        <span class='sr-only'>Previous</span>
      </a>
      <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
        <span class='carousel-control-next-icon' aria-hidden='true'></span>
        <span class='sr-only'>Next</span>
      </a>
    </div>

    <style>
      /* Establecer una altura fija para las imágenes del carrusel */
      .carousel-item img {
        height: 900px;
        /* Ajusta la altura según tus necesidades */
        object-fit: cover;
        /* Ajusta la imagen para que cubra el contenedor sin distorsionarse */
        width: 100%;
        /* Asegura que la imagen ocupe todo el ancho */
      }
    </style>

    <!-- end slider section -->
  </div>

  <!-- service section -->

  <section class='service_section'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-1.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Fast Delivery
              </h5>
              <p>
                variations of passages of Lorem Ipsum available
              </p>
            </div>
          </div>
        </div>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='/images/feature-2.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Free Shiping
              </h5>
              <p>
                variations of passages of Lorem Ipsum available
              </p>
            </div>
          </div>
        </div>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-3.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                Best Quality
              </h5>
              <p>
                variations of passages of Lorem Ipsum available
              </p>
            </div>
          </div>
        </div>
        <div class='col-md-6 col-lg-3'>
          <div class='box '>
            <div class='img-box'>
              <img src='images/feature-4.png' alt=''>
            </div>
            <div class='detail-box'>
              <h5>
                24x7 Customer support
              </h5>
              <p>
                variations of passages of Lorem Ipsum available
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class='product_section '>
    <div class='container'>
      <div class='product_heading'>
        <h2>
          Top Sale Watches
        </h2>
      </div>
      <div class='product_container'>
        <div class='box'>
          <div class='box-content'>
            <div class='img-box'>
              <img src='images/w1.png' alt=''>
            </div>
            <div class='detail-box'>
              <div class='text'>
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class="like">
                <h6>
                  Favorite
                </h6>
                <div class="star_container">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-box">
            <a href="">
              Add To Cart
            </a>
          </div>
        </div>
        <div class="box">
          <div class="box-content">
            <div class="img-box">
              <img src="images/w2.png" alt="">
            </div>
            <div class="detail-box">
              <div class="text">
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class='like'>
                <h6>
                  Like
                </h6>
                <div class='star_container'>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                </div>
              </div>
            </div>
          </div>
          <div class='btn-box'>
            <a href=''>
              Add To Cart
            </a>
          </div>
        </div>
        <div class='box'>
          <div class='box-content'>
            <div class='img-box'>
              <img src='images/w3.png' alt=''>
            </div>
            <div class='detail-box'>
              <div class='text'>
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class="like">
                <h6>
                  Like
                </h6>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-box">
            <a href="">
              Add To Cart
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end product section -->


  <!-- product section -->

  <section class="product_section ">
    <div class="container">
      <div class="product_heading">
        <h2>
          Feature Watches
        </h2>
      </div>
      <div class="product_container">
        <div class="box">
          <div class="box-content">
            <div class="img-box">
              <img src="images/w4.png" alt="">
            </div>
            <div class="detail-box">
              <div class="text">
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class='like'>
                <h6>
                  Like
                </h6>
                <div class='star_container'>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                </div>
              </div>
            </div>
          </div>
          <div class='btn-box'>
            <a href=''>
              Add To Cart
            </a>
          </div>
        </div>
        <div class='box'>
          <div class='box-content'>
            <div class='img-box'>
              <img src='images/w5.png' alt=''>
            </div>
            <div class='detail-box'>
              <div class='text'>
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class="like">
                <h6>
                  Like
                </h6>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-box">
            <a href="">
              Add To Cart
            </a>
          </div>
        </div>
        <div class="box">
          <div class="box-content">
            <div class="img-box">
              <img src="images/w6.png" alt="">
            </div>
            <div class="detail-box">
              <div class="text">
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class='like'>
                <h6>
                  Like
                </h6>
                <div class='star_container'>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                </div>
              </div>
            </div>
          </div>
          <div class='btn-box'>
            <a href=''>
              Add To Cart
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end product section -->

  <!-- product section -->

  <section class='product_section '>
    <div class='container'>
      <div class='product_heading'>
        <h2>
          New Arrivals
        </h2>
      </div>
      <div class='product_container'>
        <div class='box'>
          <div class='box-content'>
            <div class='img-box'>
              <img src='images/w7.png' alt=''>
            </div>
            <div class='detail-box'>
              <div class='text'>
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class="like">
                <h6>
                  Like
                </h6>
                <div class="star_container">
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-box">
            <a href="">
              Add To Cart
            </a>
          </div>
        </div>
        <div class="box">
          <div class="box-content">
            <div class="img-box">
              <img src="images/w8.png" alt="">
            </div>
            <div class="detail-box">
              <div class="text">
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class='like'>
                <h6>
                  Like
                </h6>
                <div class='star_container'>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                </div>
              </div>
            </div>
          </div>
          <div class='btn-box'>
            <a href=''>
              Add To Cart
            </a>
          </div>
        </div>
        <div class='box'>
          <div class='box-content'>
            <div class='img-box'>
              <img src='images/w9.png' alt=''>
            </div>
            <div class='detail-box'>
              <div class='text'>
                <h6>
                  Men's Watch
                </h6>
                <h5>
                  <span>$</span> 300
                </h5>
              </div>
              <div class='like'>
                <h6>
                  Like
                </h6>
                <div class='star_container'>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                  <i class='fa fa-star' aria-hidden='true'></i>
                </div>
              </div>
            </div>
          </div>
          <div class='btn-box'>
            <a href=''>
              Add To Cart
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end product section -->

  <!-- contact section -->
  <section class='contact_section layout_padding'>
    <div class='container'>
      <div class='heading_container'>
        <h2>
          Contactanos
        </h2>
      </div>
      <div class='row'>
        <div class='col-md-6'>
          <div class='form_container'>
            <form action=''>
              <div>
                <input type='text' placeholder='Tu nombre' />
              </div>
              <div>
                <input type='text' placeholder='Tu telefono' />
              </div>
              <div>
                <input type='email' placeholder='Tu correo' />
              </div>
              <div>
                <input type='text' class='message-box' placeholder='Expresate aqui...' />
              </div>
              <div class='btn_box'>
                <button>
                  Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class='col-md-6 '>
          <div class='map_container'>
            <div class='map'>
              <div id='googleMap'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

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
  <!-- footer section -->

  <!-- jQery -->
  <script type='text/javascript' src='js/jquery-3.4.1.min.js'></script>
  <!-- popper js -->
  <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'
    integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'>
    </script>
  <!-- bootstrap js -->
  <script type='text/javascript' src='js/bootstrap.js'></script>
  <!-- custom js -->
  <script type='text/javascript' src='js/custom.js'></script>
  <!-- Google Map -->
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap'>
  </script>
  <!-- End Google Map -->

</body>

</html>