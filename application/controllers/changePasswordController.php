<?php
	class changePasswordController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function changePassword()
		{
			$this->load->model("main_model");
			$this->load->library('session');
			
			if((isset($_POST['oldPassword'])) && (isset($_POST['newPassword'])))
			{
				$oldPassword = $_POST['oldPassword'];
				$newPassword = $_POST['newPassword'];
				$uid = $_SESSION['uid'];
				
				$uid = array("id" => $uid);
				$get_query = $this->main_model->get_specify_data("user_password","user_password",$uid,"users");
				$originalPassword = $get_query->row_array()['user_password'];
				if($originalPassword == $oldPassword)
				{
					if($originalPassword == $newPassword)
					{
						echo("The New Password Cannot Same with Old Password");
					}
					else
					{
						$newPassword = array("user_password" => $newPassword);
						$uid = $_SESSION['uid'];
						$query = $this->main_model->update_data("id",$uid,$newPassword,"users");
						echo(true);
					}
				}
				else
				{
					echo("Incorrect Old Password");
				}
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	