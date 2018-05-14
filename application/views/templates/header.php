<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <!-- Normal CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/mainStyle.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/navigationBarStyle.css">
        
        <!-- FontAwesome library -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
        
        <!--Normal JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/webscript.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/login.js"></script>
    </head>
    <body>
      <main id="subcontent">
       <?= $admin_state ?>
      <!-- Desktop navbar -->
            <div class="d-none d-lg-block">
                <nav class="navbar navbar-expand-lg navbar-dark navbar-fixed-top" id="desknav">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        </button>
                        <!--Add picture here-->
                        <img src="<?php echo base_url(); ?>assets/images/FFF_Logo.png" class="pageIcon">
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <ul class="navbar-nav mr-auto">
                                <?= $big_selector?>
                            </ul>
                        </div>
                    </div>
                    <!--<button class="navLoginBtn" onclick="popoutLogin()"><img src="<?php echo base_url(); ?>assets/images/loginIcon.png" width="8%" class="loginIcon"> Login</button>-->
						<?= $large_state?>
                </nav>
            </div>
        
        <!-- Mobile navbar -->
        <div class="d-block d-lg-none">
            <nav class="navbar navbar-expand-lg navbar-dark" id="mobilenav">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup1" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!--Add picture here-->
                    <img src="<?php echo base_url(); ?>assets/images/FFF_Logo.png" width="4%" class="pageIcon">
                <?= $small_state ?>   
            </nav>
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
                    <div class="navbar-nav">
                        <?= $small_selector?>
                    </div>
                </div>
            </nav>
            
        </div>
		<input id="baseURL" type=hidden value="<?=base_url()?>">
		<div class="container-fluid">