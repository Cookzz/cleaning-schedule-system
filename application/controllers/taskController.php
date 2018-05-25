<?php
	class taskController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function setNewTask()
		{
			$this->load->model("main_model");
			
			if(isset($_POST['newTask']))
			{
				$newTask = $_POST['newTask'];
				if($newTask == NULL)
				{
					echo(false);
				}
				elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $newTask))
				{
					echo(false);
				}
				elseif(ctype_space($newTask))
				{
					echo(false);
				}
				else
				{		
					$data = array('task' => $newTask);
					$get_query = $this->main_model->get_specify_data("task","task_id",$data,"task");
					$result = $get_query->num_rows();
					
					if($result >= 1)
					{
						echo(false);
					}
					else
					{
						$data = array("task"=>$newTask);
						$table = "task";
						$insert_query = $this->main_model->insert_data($table,$data);
						
						$data = array("task"=>$newTask,
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
						
						$get_query = $this->main_model->get_data_order("*","task","task");
						$task_data = $get_query->result_array();
						echo json_encode($task_data);
					}
					
				}
				
			}
				
		}
		
		public function deleteTask()
		{
			if(isset($_POST['task_id']))
			{
				$task_id = $_POST['task_id'];
				$this->load->model("main_model");
				
				$data = array("task_id"=>$task_id);
				
				$get_task_query = $this->main_model->get_specify_data("task","task_id",$data,"task");
				$row = $get_task_query->row();
				$task = $row->task;
				
				$duty_data = array("duty_task"=>$task);
				$delete_duty_query = $this->main_model->delete_data("duty",$duty_data);
				$delete_query = $this->main_model->delete_data("task",$data);
				
				$schedule_data = array("task"=>$task);
				$delete_schedule_query = $this->main_model->delete_data("morning_schedule",$schedule_data);
				$delete_schedule_query = $this->main_model->delete_data("afternoon_schedule",$schedule_data);
				
				$get_query = $this->main_model->get_data_order("*","task","task");
				$task_data = $get_query->result_array();
				echo json_encode($task_data);
			}
		}
		
		public function updateTaskData()
		{
			$this->load->model("main_model");
			if((isset($_POST['update_task'])) && (isset($_POST['task_id'])))
			{
				$update_task = trim($_POST['update_task']);
				$task_id = ($_POST['task_id']);
				$data = array('task' => $update_task);
				$query = $this->main_model->get_specify_data("task","task_id",$data,"task");
				$check_task_row = $query->num_rows();
				
				$data = array('task_id' => $task_id);
				$get_query = $this->main_model->get_specify_data("task","task_id",$data,"task");
				$row = $get_query->row();
				$original_task = $row->task;
			
			//	print_r($update_task);
					
				if($check_task_row >= 1)
				{
					echo($original_task);
				}
				else
				{
					//check new User ID format
					if($update_task == NULL)
					{
						echo($original_task);
					}
					elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $update_task))
					{
						echo($original_task);
					}
					elseif(empty($update_task))
					{
						echo($original_task);
					}
					else
					{	
						$data = array('task' => $update_task);			
						$update_query = $this->main_model->update_data("task_id",$task_id,$data,"task");
						
						$schedule_data = array("task"=>$update_task);
						$update_schedule_query = $this->main_model->update_data("task",$original_task,$data,"morning_schedule");
						$update_schedule_query = $this->main_model->update_data("task",$original_task,$data,"afternoon_schedule");
				
						$duty_data = array("duty_task"=>$update_task);
						$update_duty_query = $this->main_model->update_data("duty_task",$original_task,$duty_data,"duty");
					
						echo("Update Success");
					}
				}
			}	
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	