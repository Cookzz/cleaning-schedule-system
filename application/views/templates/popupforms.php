<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/popUpFormStyle.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/change_password.js"></script>
</head>
       <!--Login Modal-->
        <div id="loginForm" class="modal">
            <span onclick="document.getElementById('loginForm').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="container">
                   <center><img src="<?php echo base_url(); ?>assets/images/FFF_Logo.png" class="loginFormPic">
                       <p class="loginTitle">LOGIN INFO</p>
                    <label><h5>User ID</h5></label>
                    <input id="user_id_field" type="text" placeholder="Enter User ID e.g: 16123456" name="user_id" value="<?= $cookie_user_id?>" required>
                    

                    <label><h5>Password</h5></label></center>
                    <input id="password_field" type="password" placeholder="Enter Password e.g: @abc123" name="password" value="<?= $cookie_password?>" required>
                    <label class="rememberLabel"><input type="checkbox" id="remember" class="remember" <?php if(isset($_COOKIE["cookie_user_id"])){echo("checked");}?>>Remember Username & Password</label>
                    <center><label id="errorMessage"></label></center>

                    <div class="clearfix">
                        <button type="submit" class="loginbtn" name="login" value="Submit">Login</button>
                        <button type="button" onclick="document.getElementById('loginForm').style.display='none'" class="cancelbtn">Cancel</button>
                    </div>
                </div>
                <input id="next" name="next" type="button" value="Forgot Password?" onclick="signLogin(1)" formnovalidate>
            </form>
        </div>
        
        <!-- Forgot Password Modal-->
        <div id="forgotForm" class="modal">
            <span onclick="document.getElementById('forgotForm').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="container">
                   <span><button type="button" onclick="signLogin(0)" class="backbtn"><img src="<?php echo base_url(); ?>assets/images/backarrow.png" class="backarrowbtn"></button></span>
                    <center><img src="<?php echo base_url(); ?>assets/images/lockpicture.png" class="forgotPassPic">
                    <h2 class="forgotPassTitle">Forgot Password?</h2>
                        <p>Just type in your User ID and we will email a new password for you</p>
                    <label><h5>User ID</h5></label></center>
                    <input type="text" placeholder="Enter User ID e.g: 16123456" name="userid" required>

                    <div class="clearfix">
                        <button type="submit" class="forgotbtn" name="forgot" value="Submit">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Change Password Modal -->
       <div id="changePassForm" class="modal">
            <span onclick="document.getElementById('changePassForm').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="container">
                   <span><button type="button" onclick="modalPop(0)" class="backbtn"><img src="<?php echo base_url(); ?>assets/images/backarrow.png" class="backarrowbtn"></button></span>
                    <center><img src="<?php echo base_url(); ?>assets/images/password.png" class="changePassPic">
                    <h2 class="forgotPassTitle">Change Password</h2>
                        <p>Note: For best password protection, use at least one letter and a number for your new password (include uppercase)</p>
                    <label><h5>Old Password</h5></label>
                    <input type="text" id="oldPassword" placeholder="Enter your old passowrd" name="oldpass" required>    
                        
                    <label><h5>New Password</h5></label>
                    <input type="text" id="newPassword" placeholder="Enter new password" name="newpass" required>
                    
                    <label><h5>Confirm Password</h5></label></center>
                    <input type="text" id="confirmPassword" placeholder="Enter new password again" name="newpass2" required>
                    
                    <center><label id="changeError"></label></center>

                    <div class="clearfix">
                        <button type="submit" class="changebtn" name="change" value="Submit">Change</button>
                    </div>
                </div>
            </form>
        </div>