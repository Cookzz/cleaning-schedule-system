<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/view_graph.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>
<body>  

<h2>Location's Rank</h2>

<div id="barRating" class="responsive" style="height: <?= $countOfRating*8?>%; width: 100%;">
	
</div>

<div id="pieDuty" class="responsive" style="height:600px; width: 100%;">
	
</div>

<!--hidden value for external js file-->
<textarea id="cleaners_string" style="display:none"><?= $cleaners_string?></textarea>
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>