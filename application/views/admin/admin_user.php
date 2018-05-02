<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/user.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

</head>
<body>  

<h2>User</h2><hr/>

<!--This this admin user page body-->
<!--This this sidebar button-->
<div class="navbar-header">
	<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
		<i class="glyphicon glyphicon glyphicon-play"></i>
		<span>Toggle Sidebar</span>
	</button>
</div> 

<!--This this the from to insert new user record, it include two table-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!--First table is form table, allow admin to insert new user record-->
	<table>
		<tr><td>New User:</td><td>User Name</td><td>User IC.No / Passport.No</td></tr>
		<tr>
		<td></td>
		<td><input id="newUserNameField" type="text" value="" name="newUserName"></td>
		<td><input id="newUserICField" type="text" value="" name="newUserIC" maxlength=12></td>
		<td><input id="IC" type="radio" name="IcOrPassport" value="1" checked>IC/No<br><input id="Passport" type="radio" name="IcOrPassport" value="2">Passport/No</td>
		<td><select id="newUserPositionField"><?php foreach($positions as $position):?><option value="<?php echo($position["position_name"])?>"><?php echo($position["position_name"])?></option><?php endforeach; ?></select></td>
		<td><input style="float:right"type="submit" value="Add"></td>
		</tr>
		<tr>
		<td></td>
		<td id="UsernameErrorMessage"></td>
		<td id="UserICErrorMessage"></td>
		</tr>
	</table>
<!--This second table to display the user table information-->
	<table id="user_table" border="1">
		<thead>
			<tr>
				<th>User ID</th>
				<th>User Name</th>
				<th>User Password</th>
				<th>User IC/No></th>
				<th>User Email</th>
				<th>User Position</th>
				<th>User Access Level</th>
				<th>Join Date</th>
				<th>Update</th>
				<th>Delete</th>
			</tr>
		</thead>
		<!--This table will for loop each the record of user data to display <tr></tr>-->
		<tbody id="user_table_body">
			<?php foreach($users as $user):?>
			<tr id="<?php echo $user["id"];?>">
				<!--the td will output the user table data row by row-->
				<td id="<?php echo $user["id"];?>_user_id" contenteditable="true" ><?php echo $user["user_id"];?></td>
				<td id="<?php echo $user["id"];?>_user_name"><?php echo $user["user_name"];?></td>
				<td id="<?php echo $user["id"];?>_user_password" contenteditable="true"><?php echo $user["user_password"];?></td>
				<td id="<?php echo $user["id"];?>_user_IC" contenteditable="true"><?php echo $user["user_IC"];?></td>
				<td id="<?php echo $user["id"];?>_user_email" contenteditable="true"><?php echo $user["user_email"];?></td>
				<td><select id="<?php echo $user["id"];?>_user_position"><option value="<?php echo $user["user_position"];?>"><?php echo $user["user_position"];?></option><?php foreach($positions as $position):?><option value="<?php echo($position["position_name"])?>"><?php echo($position["position_name"])?></option><?php endforeach; ?></select></td>
				<td id="<?php echo $user["id"];?>_user_access_level"><?php echo $user["user_access_level"];?></td>
				<td id="<?php echo $user["id"];?>_join_date"><?php echo $user["join_date"];?></td>
				<td><button id="<?php echo $user["id"];?>update" class="update btn btn-default" type="button">Update</button></td>
				<td><button id="<?php echo $user["id"];?>delete" class="delete btn btn-default" type="button">Delete</button></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		<!--This is the end of foreach-->
	</table>
</form>
<!--This is the end of form element-->
		
<p><a href="<?php echo base_url(); ?>adminHomeController/viewMainPage">Back</a></p>

<!--Hidden value to pass to external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">

</body>
</html>