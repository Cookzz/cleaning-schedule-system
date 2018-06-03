<?php
	class ratingController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function ratingMark()
		{
			if((isset($_POST['mark'])) && (isset($_POST["task"])))
			{
				$this->load->model("main_model");
				
				$task = $_POST["task"];
				$mark = $_POST["mark"];
				
				$rating_task = array("rating_task" => $task);
				$query = $this->main_model->get_specify_data("rating_mark","rating_id",$rating_task,"rating");
				$count = $query->num_rows();
				
				if($count > 0)
				{
					$original_mark = $query->row_array()['rating_mark'];
					$update_mark = $original_mark + $mark;
					$update_data = array("rating_mark" => $update_mark);
					$query = $this->main_model->update_data("rating_task",$task,$update_data,"rating");
				}
				else
				{
					$rating_data = array("rating_mark" => $mark , "rating_task" => $task);
					$query = $this->main_model->insert_data("rating",$rating_data);
				}
			}
		}
		
		public function check_staff_id()
		{
			if((isset($_POST['staff_id'])))
			{
				$this->load->model("main_model");
				
				$staff_id = $_POST["staff_id"];
				
				$user_id = array("user_id" => $staff_id);
				$query = $this->main_model->get_specify_data("user_access_level","user_id",$user_id,"users");
				$count = $query->num_rows();
				
				if($count > 0)
				{
					$user_access_level = $query->row_array()['user_access_level'];
					
					if($user_access_level < 4)
					{
						echo(true);
					}
					else
					{
						echo(false);
					}
				}
				else
				{
					echo(false);
				}
			}
		}
			
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	