<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/view_graph.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/supervisorGraphStyle.css">
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>
<body>  

<h2>Graphs</h2>


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#ratingTab">Customer Total Ratings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#dutiesTab">Duties</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane container active" id="ratingTab">
    <div id="barRating" class="responsive" style="height: <?= $countOfRating*8?>%;">
    </div>
  </div>
  <div class="tab-pane container fade" id="dutiesTab">
        <div id="pieDuty" class="responsive">
        </div>
  </div>
</div>

<!--hidden value for external js file-->
<textarea id="cleaners_string" style="display:none"><?= $cleaners_string?></textarea>
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>