<?php
	class completeDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		public function deleteCompleteDutyData()
		{
			$this->load->model("main_model");
			if((isset($_POST['complete_duty_id']))) 
			{		
				$complete_duty_id = $_POST['complete_duty_id'];
				$data = array("complete_duty_id" => $complete_duty_id);
				$query = $this->main_model->delete_data("complete_duty",$data);
					
				echo (true);
			}	
		}
		
		public function updateCompleteDutyData()
		{
			$this->load->model("main_model");
			if((isset($_POST['complete_duty_comment'])) && (isset($_POST['complete_duty_id'])))
			{
				$complete_duty_id = $_POST['complete_duty_id'];
				$complete_duty_comment = $_POST['complete_duty_comment'];
				$data =array("complete_duty_comment" => $complete_duty_comment);
				
				$update_query = $this->main_model->update_data("complete_duty_id",$complete_duty_id,$data,"complete_duty");
				echo(true);
			}	
			else
			{
				echo("Update Incomplete");
			}
		}
	}