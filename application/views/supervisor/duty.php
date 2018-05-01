<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/duty.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

</head>
<body>  

<h2>Duty</h2><hr/>

<!--This form got two table, one is to let user to insert new duty, one is to display the duty table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<!--First table to display the form element like input box and button-->
	<table>
		<tr><td>New Duty:</td>
		<td><select id="newDuty_stuff"><?php foreach($stuffs as $stuff):?><option value="<?php echo $stuff["stuff"]?>"><?php echo $stuff["stuff"]?></option><?php endforeach?></select></td>
		<td><select id="newDuty_sub_stuff"><?php foreach($sub_stuffs as $sub_stuff):?><option value="<?php echo $sub_stuff["sub_stuff"]?>"><?php echo $sub_stuff["sub_stuff"]?></option><?php endforeach?></select></td>
		</tr>
		<tr><td colspan="3"><input style="float:right"type="submit" value="Add"></td></tr>
	</table>
	<!--This is the end of first table-->
	<!--Second Table is to output the data which by controller and delete,update button-->
	<table id="duty_table" style="width:40%" border="1">
		<thead>
			<tr>
				<th>No.</th><th>Duty Stuff</th><th>Duty Sub Stuff</th><th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1?><?php foreach($duties as $duty):?>
			<tr>
				<td><?php echo $i ?></td>
				<td id="<?php echo($duty["duty_id"])?>_stuff"><?php echo $duty["duty_stuff"]; ?></td>
				<td id="<?php echo($duty["duty_id"])?>_sub_stuff"><?php echo $duty["duty_sub_stuff"]; ?></td>
				<td><button type="button" id="<?php echo $duty["duty_id"];?>_delete" class="delete">Delete</button></td>
			</tr>
			<?php $i = $i+1?><?php endforeach; ?>	
		</tbody>
	</table>
	<!--This is the end of second table-->
</form>

<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>