<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/popUpFormStyle.css">
</head>
       <!--Login Modal-->
        <div id="loginForm" class="modal">
            <span onclick="document.getElementById('loginForm').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="container">
                    <label><b>User ID</b></label>
                    <input id="user_id_field" type="text" placeholder="Enter User ID e.g: 16123456" name="user_id" required>

                    <label><b>Password</b></label>
                    <input id="password_field" type="password" placeholder="Enter Password e.g: @abc123" name="password" required>
                    <label id="errorMessage"></label>
                    <br>
                    <input type="checkbox" checked="checked">Remember Username & Password

                    <div class="clearfix">
                        <button type="button" onclick="document.getElementById('loginForm').style.display='none'" class="cancelbtn">Cancel</button>
                       <button type="submit" class="loginbtn" name="login" value="Submit">Login</button>
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
                    
                    <label><b>Email Address</b></label>
                    <input type="text" placeholder="Enter Email e.g: abc123@gmail.com" name="email" required>

                    <div class="clearfix">
                        <button type="button" onclick="signLogin(0)" class="cancelbtn">Go Back</button>
                        <button type="submit" class="forgotbtn" name="forgot" value="Submit">Confirm</button>
                    </div>
                </div>
            </form>
        </div>