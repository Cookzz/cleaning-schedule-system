<?php
	class scheduleFormController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function checkTaskLocation()
		{
			$this->load->model("main_model");
			
			if((isset($_POST['task'])) && (isset($_POST['time'])) && (isset($_POST['week'])))
			{
				$task = $_POST['task'];
				$time = $_POST['time'];
				$week = $_POST['week'];	
				if($week == "this")
				{
					$week_number = date("W");
					$schedule_id = $time."_schedule_id";
				}
				elseif($week == "next")
				{
					$nextWeek = strtotime('+1 week');
					$week_number = date('W', $nextWeek);
					$schedule_id = $time."_schedule_id";
				}
				$task = array("task" => $task , "week_number" => $week_number);
				$table = $time."_schedule";
				$get_query = $this->main_model->get_specify_data("*",$schedule_id,$task,$table);
				$row_count = $get_query->num_rows();
				
				if($row_count >=1 )
				{
					$schedule_data = $get_query->row_array();
					echo json_encode($schedule_data);
				}
				else
				{
					echo(false);
				}
			}
		}
		
		public function saveSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['schedule']))
			{
				//convert JSON_string back to JSON_object 
				$schedule = json_decode($_POST["schedule"], false);
					
				if($schedule->week == "this")
				{
					$week_number = date("W");
				}
				elseif($schedule->week == "next")
				{
					$nextWeek = strtotime('+1 week');
					$week_number = date('W', $nextWeek);
					print_r($week_number);
				}
				
				print_r($schedule->remark);
				
				$data = array('monday' => $schedule->monday,
							  'tuesday' => $schedule->tuesday,
							  'wednesday' => $schedule->wednesday,
							  'thursday' => $schedule->thursday,
							  'friday' => $schedule->friday,
							  'saturday' => $schedule->saturday,
							  'sunday' => $schedule->sunday,
							  'remark' => $schedule->remark);
							  
								  
				$table = $schedule->time."_schedule";
				$where_field = array("task" => $schedule->task ,"week_number" => $week_number);
				$this->main_model->update_data2($where_field,$data,$table);
				
				echo(true);
			}			
		}
		
		public function deleteSchedule()
		{
			$this->load->model("main_model");
			if((isset($_POST['task'])) && (isset($_POST['time'])) && (isset($_POST['week'])))
			{
				$task = $_POST['task'];
				$time = $_POST['time'];
				$week = $_POST['week'];
				if($week == "this")
				{
					$week_number = date("W");
					print_r($week_number);
				}
				elseif($week == "next")
				{
					$nextWeek = strtotime('+1 week');
					$week_number = date('W', $nextWeek);
				}

				$NA = "NA";
				
				$data = array('monday' => $NA,
							  'tuesday' => $NA,
							  'wednesday' => $NA,
							  'thursday' => $NA,
							  'friday' => $NA,
							  'saturday' => $NA,
							  'sunday' => $NA,
							  'remark' => "active");
								  
				$table = $time."_schedule";
				$where_field = array("task" => $task ,"week_number" => $week_number);
				$this->main_model->update_data2($where_field,$data,$table);
				
				$task = array("task" => $task,"week_number" => $week_number);
				$table = $time."_schedule";
				$get_query = $this->main_model->get_specify_data("*","schedule_id",$task,$table);
				
				$schedule_data = $get_query->row_array();
				echo json_encode($schedule_data);
			}			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	