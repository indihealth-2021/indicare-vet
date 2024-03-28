<!DOCTYPE html>
<html>

<head>
  <title>Indicare Vet For Vet Clinic | Home - Sign in</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS only -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/tampilan.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/bootstrap.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/telemedicine/css/popupstyle.css'); ?>">
  <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
</head>

<body>
  <nav class=" nav navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class=" nav navbar-brand" href="<?php echo base_url('Home'); ?>">
          <img src="<?php echo base_url('assets/telemedicine/img/logo.png') ?>" width="140" height="70">
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav navbar-default navbar-right" id="navbarTogglerDemo02">
        <!-- <ul class="nav navbar-default navbar-right" style="padding-left: 100px">
                    <li class="nav-link">
                      <a href="<?php //echo base_url('Home');
                                ?>" style="text-decoration: none"><button type="button" class="btn btn-default navbar-btn"><i class="glyphicon glyphicon-user "></i>Home</button></a>
                    </li>
                    <li class="nav-link">
                      <a href="<?php //echo base_url('News');
                                ?>" style="text-decoration: none"><button type="button" class="btn btn-default navbar-btn"><i class="glyphicon glyphicon-user "></i>News</button></a>
                    </li>
                </ul> -->
        <form action="<?php echo base_url('login'); ?>" method="GET">
          <ul class="nav navbar-default navbar-right" style="padding-left: 920px;">
            <li class="nav-link ">
              <a class="menu-landing" href="<?php echo base_url('Home'); ?>">
                <button type="button" class="btn btn-default navbar-btn" style="font-weight: bold">Home</button></a>
            </li>
            <!-- <li class="nav-link ">
                      <a class="menu-landing" href="<?php echo base_url('News'); ?>">
                      <?php if ($menu_landing == 2) { ?>
                      <button type="button" class="btn btn-default navbar-btn active">News</button>
                      <?php } else { ?>
                      <button type="button" class="btn btn-default navbar-btn">News</button>
                      <?php } ?>
                      </a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing"  href="<?php echo base_url('register'); ?>">
                    <?php if ($menu_landing == 3) { ?>
                    <button type="button" class="btn btn-default navbar-btn active">Register</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-default navbar-btn">Register</button>
                    <?php } ?></a>
                    </li>
                    <li class="nav-link">
                    <a class="menu-landing" href="<?php echo base_url('Login'); ?>">
                    <?php if ($menu_landing == 4) { ?>
                    <button type="button" class="btn btn-default navbar-btn active">Login</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-default navbar-btn">Login</button>
                    <?php } ?></a>
                    </li> -->
            <!-- <li class="nav-link">
                    <select style="text-decoration: none; cursor: pointer;" class="form-control">
                      <option>Indonesia</option>
                        <option>English</option>
                    </select>
                    </li> -->

          </ul>
        </form>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="col-lg-12">
      <div class="row justify-content-md-center mt-12">
        <div class="col-lg-6" style="padding-left: 0px; padding-bottom: 50px">
          <div class="card-body col-lg-12 text-center mb-5" style="height: 480px;">
            <div class="card-body">
              <div class="card-body">
                <div class="card-body">
                  <h3>RUMAH SAKIT</h3>
                </div>
                Rumah sakit adalah institusi pelayanan kesehatan yang menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan rawat inap, rawat jalan dan gawat darurat
              </div>
            </div>
            <!--  <div class="card-body mt-2">
                            <img src="<?php //echo base_url('assets/telemedicine/img/picture_logo.png');
                                      ?>" style="width: 200px; height: auto">
                            <br>
                            <img src="<?php //echo base_url('assets/telemedicine/img/logo.png');
                                      ?>" style="width: 180px; height: auto;">
                        </div> -->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="col-lg-12">
            <div class="card-body col-lg-10 text-center mb-5" style="height: 480px">
              <img src="<?php echo base_url('assets/telemedicine/img/male.png') ?>" width="35%">
              <h2>WELCOME</h2>
              <div class="card-body">
                <form action="<?php echo base_url('Login/login') ?>" method="POST">
                  <?php if ($this->session->flashdata('msg_login')) {
                    echo '<div class="alert-danger border pb-1">' . $this->session->flashdata('msg_login') . '</div>';
                  } ?>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="email" placeholder="Username">
                  </div>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                    </div>
                    <input type="password" class="form-control" id="inlineFormInputGroup" name="password" placeholder="Password">
                  </div>
                  <div class="mb-3 text-right">
                    <a href="<?php echo base_url('ForgotPassword'); ?>">Forgot Password?</a>
                  </div>
                  <div class="form-group ">
                    <a href="<?php echo base_url('Login'); ?>" style="text-decoration: none;"><button type="submit" class="btn btn-primary align-center col-lg-12" style="height: 40px">LOGIN</button></a>
                  </div>
                  <div class="mb-3">
                    <h7>OR</h7>
                  </div>
                  <div class="form-group">
                    <a href="<?php echo base_url('register'); ?>" style="text-decoration: none">
                      <button type="button" class="btn btn-primary align-center col-lg-12" style="height: 40px">REGISTER</button></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--footer-->
  <footer class="footer pt-4 footer-baru" id="footer">
    <div class="col-md-11 mx-auto">
      <div class="col-lg-12 py-5">
        <div class="row">
          <div class="col-lg-3">
            <p class="font-12 text-powered">Powered By</p>
            <div class="row">
              <!--<img src="<?php echo base_url('assets/telemedicine/img/logo.png') ?>" class="ml-4 img-logo-footer">-->
              <img src="<?php echo base_url('assets/telemedicine/img/picture_logo.png') ?>" class="ml-4 img-logo-footer">
            </div>
          </div>
          <div class="col-lg-2">
            <p class="font-bold font-tele">Site Map</p>
            <div class="font-18">
              <span><a href="<?php echo base_url('Faq'); ?>" class="font-black">FAQ</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#beranda" class="font-black">Beranda</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#layanan" class="font-black">Layanan Kami</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#mitra-dokter-2" class="font-black">Mitra Dokter</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#news" class="font-black">Berita</a></span><br>
              <span><a href="<?php echo base_url('Home'); ?>#footer" class="font-black">Kontak</a></span>
            </div>
          </div>
          <div class="col-lg-5">
            <p class="font-bold font-tele">Hubungi Kami</p>
            <div class="font-black font-18">
              <span>PT. Inditek Global Medika Indihealth for Smart Health</span><br>
              <span>Jl. Tubagus Raya No.5B Kota Bandung</span><br>
              <span>Telp : +6222 250 1077</span><br>
              <span>Faks : +6222 251 4440</span><br>
              <span>Email : info@indihealth.com</span><br>
            </div>
          </div>
          <div class="col-lg-2 font-18 text-right">
            <p class="font-bold font-tele">Temukan Kami</p>
            <a href="#"><img src="<?php echo base_url('assets/telemedicine/img/playstore.png') ?>" class="img-playstore"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 text-center p-1" style="background: #01a9ac;">
      <span class="font-12 text-white font-droid">Version 1.0 Copyright © 2024. Indihealth. All rights reserved.</span>
    </div>
  </footer>

  <?php if ($this->session->flashdata('msg_regis')) {
    echo "<script>alert('" . $this->session->flashdata('msg_regis') . "')</script>";
  } ?>
  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script type="text/jscript" src="<?php echo base_url('assets/js/jquery.slim.js'); ?>"></script>
  <script type="text/jscript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.carousel').carousel();
    });
  </script>

</body>

</html>