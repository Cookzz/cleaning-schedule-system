<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/stuff.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

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
	<table id="stuff_table" style="width:40%" border="1">
		<thead>
			<tr>
				<th>No.</th><th>Stuff Location</th><th>Update</th><th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1?><?php foreach($stuffs as $stuff):?>
			<tr>
				<td><?php echo $i ?></td><td id="<?php echo($stuff["stuff_id"])?>_stuff" contenteditable="true"><?php echo $stuff["stuff"]; ?></td>
				<td><button type="button" id="<?php echo $stuff["stuff_id"];?>_update" class="update">Update</button></td>
				<td><button type="button" id="<?php echo $stuff["stuff_id"];?>_delete" class="delete">Delete</button></td>
			</tr>
			<?php $i = $i+1?><?php endforeach; ?>	
		</tbody>
	</table>
	<!--This is the end of second table-->
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>