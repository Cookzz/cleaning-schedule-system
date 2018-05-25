<?php
	class subTaskController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function setNewSubTask($page = 'task')
		{
			$this->load->model("main_model");

			
			if(isset($_POST['newSubTask']))
			{
				$newSubTask = $_POST['newSubTask'];
				if($newSubTask == NULL)
				{
					echo(false);
				}
				elseif(ctype_space($newSubTask))
				{
					echo(false);
				}
				else
				{		
					$data = array('sub_task' => $newSubTask);
					$get_query = $this->main_model->get_specify_data("sub_task","sub_task_id",$data,"sub_task");
					$result = $get_query->num_rows();
					
					if($result >= 1)
					{
						echo(false);
					}
					else
					{
						$data = array("sub_task"=>$newSubTask);
						$table = "sub_task";
						$insert_query = $this->main_model->insert_data($table,$data);
						
						$get_query = $this->main_model->get_data_order("*","sub_task","sub_task");
						$sub_tasks_data = $get_query->result_array();
						echo json_encode($sub_tasks_data);
					}
					
				}
				
			}
				
		}
		
		public function deleteSubTask()
		{
			if(isset($_POST['sub_task_id']))
			{
				$sub_task_id = $_POST['sub_task_id'];
				$this->load->model("main_model");
				$data = array("sub_task_id"=>$sub_task_id);
				
				$get_task_query = $this->main_model->get_specify_data("sub_task","sub_task_id",$data,"sub_task");
				$row = $get_task_query->row();
				$sub_task = $row->sub_task;
				
				$duty_data = array("duty_sub_task"=>$sub_task);
				$delete_duty_query = $this->main_model->delete_data("duty",$duty_data);
				$delete_query = $this->main_model->delete_data("sub_task",$data);
				
				$get_query = $this->main_model->get_data_order("*","sub_task","sub_task");
				$sub_task_data = $get_query->result_array();
				echo json_encode($sub_task_data);
			}
		}
		
		public function updateSubTaskData()
		{
			$this->load->model("main_model");
			if((isset($_POST['update_sub_task'])) && (isset($_POST['sub_task_id'])))
			{
				$update_sub_task = trim($_POST['update_sub_task']);
				$sub_task_id = ($_POST['sub_task_id']);
				$data = array('sub_task' => $update_sub_task);
				$query = $this->main_model->get_specify_data("sub_task","sub_task_id",$data,"sub_task");
				$check_sub_task_row = $query->num_rows();
				
				$data = array('sub_task_id' => $sub_task_id);
				$get_query = $this->main_model->get_specify_data("sub_task","sub_task_id",$data,"sub_task");
				$row = $get_query->row();
				$original_sub_task = $row->sub_task;
			
			//	print_r($update_task);
					
				if($check_sub_task_row >= 1)
				{
					echo($original_sub_task);
				}
				else
				{
					//check new User ID format
					if($update_sub_task == NULL)
					{
						echo($original_sub_task);
					}
					elseif(!preg_match('/^[a-zA-Z0-9\s]+$/', $update_sub_task))
					{
						echo($original_sub_task);
					}
					elseif(empty($update_sub_task))
					{
						echo($original_sub_task);
					}
					else
					{	
						$data = array('sub_task' => $update_sub_task);			
						$update_query = $this->main_model->update_data("sub_task_id",$sub_task_id,$data,"sub_task");
					
						$duty_data = array("duty_sub_task"=>$update_sub_task);
						$update_duty_query = $this->main_model->update_data("duty_sub_task",$original_sub_task,$duty_data,"duty");
						
						echo("Update Success");
					}
				}
			}	
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	