<?php
	class stuffController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function setNewStuff()
		{
			$this->load->model("main_model");
			
			if(isset($_POST['newStuff']))
			{
				$newStuff = $_POST['newStuff'];
				if($newStuff == NULL)
				{
					echo(false);
				}
				elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $newStuff))
				{
					echo(false);
				}
				elseif(ctype_space($newStuff))
				{
					echo(false);
				}
				else
				{		
					$data = array('stuff' => $newStuff);
					$get_query = $this->main_model->get_specify_data("stuff","stuff_id",$data,"stuff");
					$result = $get_query->num_rows();
					
					if($result >= 1)
					{
						echo(false);
					}
					else
					{
						$data = array("stuff"=>$newStuff);
						$table = "stuff";
						$insert_query = $this->main_model->insert_data($table,$data);
						
						$data = array("stuff"=>$newStuff,
										'monday'=>'NA',
										'tuesday'=>'NA',
										'wednesday'=>'NA',
										'thursday'=>'NA',
										'friday'=>'NA',
										'saturday'=>'NA',
										'sunday'=>'NA',
										'remark'=>'active',
										'week_number'=>date('W'));
						$table = "morning_schedule";
						$insert_query = $this->main_model->insert_data($table,$data);
						$table = "afternoon_schedule";
						$insert_query = $this->main_model->insert_data($table,$data);
						
						$get_query = $this->main_model->get_data_order("*","stuff","stuff");
						$stuff_data = $get_query->result_array();
						echo json_encode($stuff_data);
					}
					
				}
				
			}
				
		}
		
		public function deleteStuff()
		{
			if(isset($_POST['stuff_id']))
			{
				$stuff_id = $_POST['stuff_id'];
				$this->load->model("main_model");
				
				$data = array("stuff_id"=>$stuff_id);
				
				$get_stuff_query = $this->main_model->get_specify_data("stuff","stuff_id",$data,"stuff");
				$row = $get_stuff_query->row();
				$stuff = $row->stuff;
				
				$duty_data = array("duty_stuff"=>$stuff);
				$delete_duty_query = $this->main_model->delete_data("duty",$duty_data);
				$delete_query = $this->main_model->delete_data("stuff",$data);
				
				$schedule_data = array("stuff"=>$stuff);
				$delete_schedule_query = $this->main_model->delete_data("morning_schedule",$schedule_data);
				$delete_schedule_query = $this->main_model->delete_data("afternoon_schedule",$schedule_data);
				
				$get_query = $this->main_model->get_data_order("*","stuff","stuff");
				$stuff_data = $get_query->result_array();
				echo json_encode($stuff_data);
			}
		}
		
		public function updateStuffData()
		{
			$this->load->model("main_model");
			if((isset($_POST['update_stuff'])) && (isset($_POST['stuff_id'])))
			{
				$update_stuff = trim($_POST['update_stuff']);
				$stuff_id = ($_POST['stuff_id']);
				$data = array('stuff' => $update_stuff);
				$query = $this->main_model->get_specify_data("stuff","stuff_id",$data,"stuff");
				$check_stuff_row = $query->num_rows();
				
				$data = array('stuff_id' => $stuff_id);
				$get_query = $this->main_model->get_specify_data("stuff","stuff_id",$data,"stuff");
				$row = $get_query->row();
				$original_stuff = $row->stuff;
			
			//	print_r($update_stuff);
					
				if($check_stuff_row >= 1)
				{
					echo($original_stuff);
				}
				else
				{
					//check new User ID format
					if($update_stuff == NULL)
					{
						echo($original_stuff);
					}
					elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $update_stuff))
					{
						echo($original_stuff);
					}
					elseif(empty($update_stuff))
					{
						echo($original_stuff);
					}
					else
					{	
						$data = array('stuff' => $update_stuff);			
						$update_query = $this->main_model->update_data("stuff_id",$stuff_id,$data,"stuff");
						
						$schedule_data = array("stuff"=>$update_stuff);
						$update_schedule_query = $this->main_model->update_data("stuff",$original_stuff,$data,"morning_schedule");
						$update_schedule_query = $this->main_model->update_data("stuff",$original_stuff,$data,"afternoon_schedule");
				
						$duty_data = array("duty_stuff"=>$update_stuff);
						$update_duty_query = $this->main_model->update_data("duty_stuff",$original_stuff,$duty_data,"duty");
					
						echo("Update Success");
					}
				}
			}	
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	