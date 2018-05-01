<?php
	class userSettingController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function newImageUpload()
		{
			$this->load->model("main_model");
			$this->load->library('session');
			if(isset($_FILES['userImage']))
			{		
				$tmp_name = $_FILES['userImage']['tmp_name'];
				$name = $_FILES["userImage"]["name"];
				$directory = './assets/images/';
				$imageLocation = $name;
				move_uploaded_file ($tmp_name,$directory.$name);	
					
				$user_picture = array('user_picture' => $imageLocation);
				$uid = $_SESSION['uid'];
				$query = $this->main_model->update_data("id",$uid,$user_picture,"users");
					
				echo("Upload Success");
				
			}	
			else
			{
				echo("Update Incomplete");
			}
		}
	}