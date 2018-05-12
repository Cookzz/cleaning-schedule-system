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
				$file_name = $_FILES['userImage']['name'];

				$exts = preg_split("[/\\.]", $file_name) ; 
				$n = count($exts)-1; 
				$exts = $exts[$n]; 
				
				$ran = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
				$new_image_name = $ran.".".$exts;
				
				$directory = './assets/images/';
				$imageLocation = $new_image_name;
				move_uploaded_file ($tmp_name,$directory.$new_image_name);	
					
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