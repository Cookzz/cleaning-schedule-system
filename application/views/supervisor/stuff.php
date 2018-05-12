<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/stuff.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>  

<h2>Stuff Location</h2><hr/>

<!--This form got two table, one is to let user to insert new stuff, one is to display the stuff table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--First table to display the form element like input box and button-->
	<table>
		<tr><td>New Stuff Location:</td><td><input id="newStuffField" type="text" value="" name="newStaff" maxlength="30"></td></tr>
		<tr><td colspan="3"><input style="float:right"type="submit" value="Add"></td></tr>
	</table>
	<!--This is the end of first table-->
	<!--Second Table is to output the data which by controller and delete,update button-->
	<table id="stuff_table" style="width:40%" class="table table-striped table-bordered" border="1">
		<thead>
			<tr>
				<th>No.</th><th>Stuff Location</th><th>Update</th><th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1?><?php foreach($stuffs as $stuff):?>
			<tr>
				<td><?php echo $i ?></td><td id="<?php echo($stuff["stuff_id"])?>_stuff" contenteditable="true"><?php echo $stuff["stuff"]; ?></td>
				<td><center><button type="button" id="<?php echo $stuff["stuff_id"];?>_update" class="update">Update</button></center></td>
				<td><center><button style="width:80px;height:30px" type="button" id="<?php echo $stuff["stuff_id"];?>_delete" class="w3-text-red fa fa-trash delete"></button></center></td>
			</tr>
			<?php $i = $i+1?><?php endforeach; ?>	
		</tbody>
	</table>
	<!--This is the end of second table-->
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>