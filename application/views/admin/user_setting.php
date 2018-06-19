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
<div class="navbar-header">
<!--This this sidebar button-->
	<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
		<span class="togglespan">Open/Close Admin Panel</span>
	</button>
</div>
<h2 class="pageTitle">User Setting</h2><hr class="pageTitleHr">

<div class="table-responsive">
<table class="userSettingsTable">
   <tr>
       <td colspan="2" class="profPicCol"><label class="profPicLabel">Profile Picture</label><hr></td>
   </tr>
    <tr>
		<td><img class="profilePicture" src="<?php echo base_url();?>assets/images/<?= $user_data["user_picture"]?>" width="100px"></td>
        <td><div class="previewCol"><b>Preview:</b> <div><img id="output"></div></div></td>
	</tr>
	<tr><td><input id="newImage" type="file" accept="image/*" name="image" onchange="loadImage(event)"></td>
	<td><button id="confirmUpload" style="display:none">Confirm Upload</button></td></tr>
	<tr>
	    <td colspan="2"><hr></td>
	</tr>
	<tr>
	    <td colspan="2"><label class="settingLabel">Other Settings</label><hr class="otherHr"></td>
	</tr>
	<tr class="userSettingList">
		<td><label>User ID:</label></td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_id"]?>"></td>
	</tr>
	<tr class="userSettingList">
		<td><label>User Name:</label></td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_name"]?>"></td>
	</tr>
	<tr class="userSettingList">
		<td><label>User Email:</label></td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_email"]?>"></td>
	</tr>
	<tr class="userSettingList">
		<td><label>User Position:</label></td>
		<td><input type="text" disabled="true" value="<?= $user_data["user_position"]?>"></td>
	</tr>
   <tr>
       <td colspan="2"><hr></td>
   </tr>
    </table>
    </div>
<br />
<div>

<br />
</div>

<!--hidden value for external js file-->
<input id="baseURL" type=hidden value="<?=base_url()?>">
</body>
</html>