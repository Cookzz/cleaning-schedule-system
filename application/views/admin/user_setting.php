<!DOCTYPE HTML>  
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/user_setting.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminUserSettingStyle.css">

</head>
<body>  

<h2 class="pageTitle">User Setting</h2><hr class="pageTitleHr">

<table>
   <tr>
       <td class="profPicRow"><label class="profPicLabel">Profile Picture</label><hr></td>
   </tr>
    <tr>
		<td><img class="profilePicture" src="<?php echo base_url();?>assets/images/<?= $user_data["user_picture"]?>" width="100px"></td>
	</tr>
	<tr><td><input id="newImage" type="file" accept="image/*" name="image" onchange="loadImage(event)"><hr></td></tr>
	<tr>
	    <td><label class="settingLabel">Other Settings</label><hr class="otherHr"></td>
	</tr>
	<tr>
		<td>User ID</td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_id"]?>"></td>
	</tr>
	<tr>
		<td>User Name</td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_name"]?>"></td>
	</tr>
	<tr>
		<td>User Email</td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_email"]?>"></td>
	</tr>
	<tr>
		<td>User Position</td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_position"]?>"></td>
	</tr>
   <tr>
       <td><hr></td>
   </tr>
    </table>
<br />
<div>

<br /><img id="output" width="300px"><button id="confirmUpload" style="display:none">Confirm Upload</button>
</div>

<!--hidden value for external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>