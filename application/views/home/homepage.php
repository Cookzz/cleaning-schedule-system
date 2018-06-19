<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/loader.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/homePageStyle.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/homepage.js"></script>
</head>
<body>  

<div class="preloader" id="preloader">
	<div class="load">
		<div class="welcome">
			Loading...	
		</div>
		<br />
		<img class="loadingImage" src="<?= base_url()?>assets/images/FFF_Logo.png">
	</div>
</div>

<h2>Home Page</h2><hr/>
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="homepageSlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="<?= base_url()?>assets/images/FFF_Logo.png" style="width:100%">
    <div class="text">Caption Text</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="<?= base_url()?>assets/images/twittericon.png" style="width:100%">
    <div class="text">Caption Two</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="<?= base_url()?>assets/images/fbicon.png" style="width:100%">
    <div class="text">Caption Three</div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

</body>
</html>