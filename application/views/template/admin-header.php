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
  <link href="<?php echo base_url();?>assets/css/admin.css" rel="stylesheet">

  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Dropzone.js插件 -->
  <!-- <link href="<?php echo base_url();?>assets/css/dropzone.css" rel="stylesheet"> -->
  <!-- <script src='<?= base_url() ?>assets/js/dropzone.js' type='text/javascript'></script> -->
  <!-- Dropzone CDN -->
  <!-- 
  <link href='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css' type='text/css' rel='stylesheet'>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js' type='text/javascript'></script>
  -->

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container-fluid d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light ml-2"><a href="<?php echo base_url();?>Admin"><img src="<?php echo base_url();?>assets/img/admin.svg" alt="admin"></a></h1>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <!-- <li><a href="#services">Items</a></li> -->
          <li><a href="<?php echo base_url();?>AdminItemList">Item List</a></li>
          <li><a href="<?php echo base_url();?>Email">Email User</a></li>

          <li><a href="<?php echo base_url();?>Review">Review List</a></li>
          <li><a href="<?php echo base_url();?>Join">User List</a></li>
          <li ><a href="<?php echo base_url();?>">Check Income</a></li>


          <!-- <li><a href="#contact">Join Us</a></li> -->


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
  </header>
  <!-- End Headerr -->
