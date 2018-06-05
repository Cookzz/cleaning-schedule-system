<?php
	class pendingDutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		public function deletePendingDutyData()
		{
			$this->load->model("main_model");
			if((isset($_POST['pending_duty_id']))) 
			{		
				$pending_duty_id = $_POST['pending_duty_id'];
				$data = array("pending_duty_id" => $pending_duty_id);
				$query = $this->main_model->delete_data("pending_duty",$data);
					
				echo (true);
			}	
		}
		
		public function updatePendingDutyData()
		{
			$this->load->model("main_model");
			if((isset($_POST['pending_duty_comment'])) && (isset($_POST['pending_duty_id'])))
			{
				$pending_duty_id = $_POST['pending_duty_id'];
				$pending_duty_comment = $_POST['pending_duty_comment'];
				
				$data =array("pending_duty_comment" => $pending_duty_comment);
				
				$update_query = $this->main_model->update_data("pending_duty_id",$pending_duty_id,$data,"pending_duty");
				echo(true);
			}	
			else
			{
				echo("Update Incomplete");
			}
		}
	}
?>