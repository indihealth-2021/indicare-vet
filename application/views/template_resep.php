<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.png">
    <title><?php echo $title ?></title>
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/adminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/dashboard/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/font-awesome.min.css');?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/style.css');?>"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css" integrity="sha512-siwe/oXMhSjGCwLn+scraPOWrJxHlUgMBMZXdPe2Tnk3I0x3ESCoLz7WZ5NTH6SZrywMY+PB1cjyqJ5jAluCOg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dashboard/css/dataTables.bootstrap4.min.css');?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
            <?php $this->load->view($view); ?>
   
   <!--  <div class="wrapper">

      
        <div class="d-inline-flex">
            <div class="col-md-2 mb-5">
                <div class="invoice-logo">
                    <img src="<?php echo base_url('assets/dashboard/img/logo.png');?>" width="120" height="auto" alt="logo">
                </div>
            </div>
            <div class="col-md-8 text-center" align="center">
                <p class="text-black">
                <h4><strong>Puskesmas Dago</strong></h4></br>
                <h5>Jl. Ir. H. Juanda No.360, Dago, Kec. Coblong, Kota Bandung, 40135</h5>
                <h5>Telp. (022) 253 3539</h5>
                <h5>Kota Bandung</h5>
                </p>
            </div>
            <div class="col-md-2 text-right" align="right">
                <div class="invoice-logo">
                    <img src="<?php echo base_url('assets/dashboard/img/logo.png');?>" width="120" height="auto" alt="logo">
                </div>
            </div>
        </div>
       
        <div>
        </div>
        <div>

                <style>
                    
                    .d-inline-flex {
                        display: inline-flex;
                    }
                    .mb-5 {
                        margin-bottom: 2.2rem;
                    }       
                    hr {
                        margin-top: -200px; border-bottom: 2px solid #000
                    }        
                </style>


            </div> -->

</body>
<script type="text/javascript">window.onload = function () {
    window.print();
}</script>
</html>