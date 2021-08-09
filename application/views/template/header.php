<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Fresh Review</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url();?>assets/img/good.ico" rel="icon" type="image/x-icon">
  
  <!-- https://www.flaticon.com/free-icon/rating_1484560?term=review&page=1&position=78&page=1&position=78&related_id=1484560&origin=search -->
  <!-- https://www.flaticon.com/free-icon/positive-vote_1533908?term=good&page=1&position=11&page=1&position=11&related_id=1533908&origin=search -->
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet"> -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url();?>assets/css/home.css" rel="stylesheet">

  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Google Recaptcha -->
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <!-- Mapbox Api -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.2.0/mapbox-gl.css' rel='stylesheet' />

  <!-- Stripe Pay -->
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="https://js.stripe.com/v3/"></script>

  <!-- Rating -->
  <!-- <script src="https://use.fontawesome.com/5ac93d4ca8.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap4-rating-input.js"></script> -->

  <!-- =======================================================
  * Template Name: Ninestars - v2.3.1
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- Font Awesome -->
  <!-- <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    rel="stylesheet"
  /> -->
  <!-- MDB -->
    <!-- <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css"
    rel="stylesheet"
  /> -->
  <!-- MDB -->
  <!-- <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"
  ></script> -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top py-2">
    <div class="container-fluid d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light ml-2"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/home.svg" alt="home"></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
          <!-- <li><a href="#services">Items</a></li> -->
          <li><a href="<?php echo base_url();?>UserItemList">Start Review</a></li>
          <!-- <li><a href="<?php echo base_url();?>Join">Join Us</a></li> -->
          <!-- <li><a href="#contact">Join Us</a></li> -->

          <li>
            <!-- 如果没登陆，无Profile -->
            <?php if(!$this->session->userdata('logged_in')) : ?>
             
            <?php endif; ?>
            
            <!-- 如果已登陆，显示profile -->
            <?php if($this->session->userdata('logged_in')) : ?>
              <a href="<?php echo base_url();?>Profile">Profile</a>
            <?php endif; ?>
          </li>

          <li class="get-started">
            <!-- 如果没登陆，显示Register,跳转到Register.php Controller -->
            <?php if(!$this->session->userdata('logged_in')) : ?>
              <a href="<?php echo base_url();?>Register">Register</a>
            <?php endif; ?>
            
            <!-- 如果已登陆，消失 -->
            <?php if($this->session->userdata('logged_in')) : ?>
                
            <?php endif; ?>
          </li>

          <li class="get-started">
            <!-- 如果没登陆，显示Login in,跳转到Login.php Controller -->
            <?php if(!$this->session->userdata('logged_in')) : ?>
              <a href="<?php echo base_url();?>Login">Log In</a>
            <?php endif; ?>
            
            <!-- 如果已登陆，显示Log out -->
            <?php if($this->session->userdata('logged_in')) : ?>
                <a href="<?php echo base_url(); ?>Login/Logout">Logout</a>
            <?php endif; ?>
          </li>
        </ul>
      </nav>
      <!-- .nav-menu -->

    </div>
  </header><!-- End Headerr -->