<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/rating.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>  

<h2>Rating</h2><hr/>

<!--This form got two table, one is to let user to insert new stuff, one is to display the stuff table-->
<center>
	<form id="rating" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<select id="stuff">
			<?php foreach($stuffs as $stuff):?>
				<option value="<?= $stuff["stuff"]?>"><?= $stuff["stuff"]?></option>
			<?php endforeach;?>
		</select>
		<br />
		<a id="bad" href="#" style="font-size:200%;">&#x1F641;Bad</a>
		<a id="normal" href="#" style="font-size:200%;">&#x1F642;Average</a>
		<a id="good" href="#" style="font-size:200%;">&#x1F603;Good</a>
		<br />
		<br />
		<br />
		<br />
		<button type="button" id="fixStuff">Fix Location</button>
		<input type="text" id="staff_id" placeholder="Enter a staff ID to fix or unfix the location">
	</form>
</center>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>