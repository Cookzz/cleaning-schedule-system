<?php
	class dutyController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		public function setNewDuty()
		{
			$this->load->model("main_model");
			
			if((isset($_POST['newDuty_task'])) && isset($_POST['newDuty_sub_task']))
			{	
				$table = "duty";
				
				$newDuty_task = ($_POST['newDuty_task']);
				$newDuty_sub_task = ($_POST['newDuty_sub_task']);
		
				if($newDuty_sub_task == "null")
				{
					echo(false);
				}
				else
				{
					$data = array('duty_task' => $newDuty_task , 'duty_sub_task' => $newDuty_sub_task);
					$get_query = $this->main_model->get_specify_data("*","duty_id",$data,$table,$data);
					$result = $get_query->num_rows();
					
					if($result >= 1)
					{
						echo(false);	
					}
					
					else
					{
						$data = array('duty_task' => $newDuty_task , 'duty_sub_task' => $newDuty_sub_task);
						$insert_query = $this->main_model->insert_data($table,$data);
							
						$get_query = $this->main_model->get_data_order("*","duty_task",$table);
						$duty_data = $get_query->result_array();
						echo json_encode($duty_data);
					}	
				}			
				
			}
				
		}
		
		public function deleteDuty()
		{
			if(isset($_POST['duty_id']))
			{
				$duty_id = $_POST['duty_id'];
				$this->load->model("main_model");
				$data = array("duty_id"=>$duty_id);
				$delete_query = $this->main_model->delete_data("duty",$data);
				
				$get_query = $this->main_model->get_data_order("*","duty_task","duty");
				$duty_data = $get_query->result_array();
				echo json_encode($duty_data);
			}
		}
	}
	
?>	
	
	
	
	
	
	
	
	
	
	
	