<?php
	class ScheduleController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function setMorningSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['schedule']))
			{
				$week_number = date('W');
				$data = array("week_number" => $week_number);
				$this->main_model->delete_data("morning_schedule",$data);
				//convert JSON_string back to JSON_object 
				$schedule = json_decode($_POST["schedule"], false);

				for($i=0;$i<sizeof($schedule->task);$i++)
				{
					$task = $schedule->task[$i];
					$monday = $schedule->monday[$i];
					$tuesday = $schedule->tuesday[$i];
					$wednesday = $schedule->wednesday[$i];
					$thursday = $schedule->thursday[$i];
					$friday = $schedule->friday[$i];
					$saturday = $schedule->saturday[$i];
					$sunday = $schedule->sunday[$i];
					$remark = $schedule->remark[$i];
					
					$data = array('task' => $task,
								  'monday' => $monday,
								  'tuesday' => $tuesday,
								  'wednesday' => $wednesday,
								  'thursday' => $thursday,
								  'friday' => $friday,
								  'saturday' => $saturday,
								  'sunday' => $sunday,
								  'remark' => $remark,
								  'week_number' => $week_number);
								  
					$table = 'morning_schedule';
					$this->main_model->insert_data($table ,$data);
				}
			}			
		}
		
		public function setAfternoonSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['schedule']))
			{
				$week_number = date('W');
				$data = array("week_number" => $week_number);
				$this->main_model->delete_data("afternoon_schedule",$data);
				//convert JSON_string back to JSON_object 
				$schedule = json_decode($_POST["schedule"], false);

				for($i=0;$i<sizeof($schedule->task);$i++)
				{
					$task = $schedule->task[$i];
					$monday = $schedule->monday[$i];
					$tuesday = $schedule->tuesday[$i];
					$wednesday = $schedule->wednesday[$i];
					$thursday = $schedule->thursday[$i];
					$friday = $schedule->friday[$i];
					$saturday = $schedule->saturday[$i];
					$sunday = $schedule->sunday[$i];
					$remark = $schedule->remark[$i];
					
					$data = array('task' => $task,
								  'monday' => $monday,
								  'tuesday' => $tuesday,
								  'wednesday' => $wednesday,
								  'thursday' => $thursday,
								  'friday' => $friday,
								  'saturday' => $saturday,
								  'sunday' => $sunday,
								  'remark' => $remark,
								  'week_number' => $week_number);
								  
					$table = 'afternoon_schedule';
					$this->main_model->insert_data($table ,$data);
				}
			}			
		}
		
		public function deleteMorningSchedule()
		{
			$this->load->model("main_model");
			$week_number = date('W');
			$data = array("week_number" => $week_number);
			$this->main_model->delete_data("morning_schedule",$data);
			echo(true);
		}
		
		public function deleteAfternoonSchedule()
		{
			$this->load->model("main_model");
			$week_number = date('W');
			$data = array("week_number" => $week_number);
			$this->main_model->delete_data("afternoon_schedule",$data);
			echo(true);
		}
	}
?>