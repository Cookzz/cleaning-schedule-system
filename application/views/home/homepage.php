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

<h2 class="homeTitle">Welcome to FFF's Cleaning Schedule Website!</h2><hr class="homeHr"/>
<!-- Slideshow container -->
<div class="slideshow-container">
  <!-- Full-width images with number and caption text -->
  <div class="homepageSlides slideFade">
    <div class="slideNumberText">1 / 3</div>
    <img src="<?= base_url()?>assets/images/schedulepage.png" class="sliderImage">
  </div>

  <div class="homepageSlides slideFade">
    <div class="slideNumberText">2 / 3</div>
    <img src="<?= base_url()?>assets/images/completeddutiespage.png" class="sliderImage">
  </div>

  <div class="homepageSlides slideFade">
    <div class="slideNumberText">3 / 3</div>
    <img src="<?= base_url()?>assets/images/dutypage.png" class="sliderImage">
  </div>

  <!-- Next and previous buttons -->
  <a id="prevSlide" class="prevSlide">&#10094;</a>
  <a id="nextSlide" class="nextSlide">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span id="slideDot1" class="slideDot"></span> 
  <span id="slideDot1" class="slideDot"></span> 
  <span id="slideDot1" class="slideDot"></span>
</div>

<div class="container-fluid">
    <h3 class="topic">About Us</h3><hr class="topicHr"/>
    <div class="content">
        What our website generally does is to provide a system for organizations especially schools and colleges in order for them to have a digitized system in keeping cleaner's schedules: when and where they should work and attend their tasks.
    </div>
    
</div>

</body>
</html>