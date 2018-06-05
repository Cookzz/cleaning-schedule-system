<?php
	class nextWeekScheduleController extends CI_Controller
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
				$nextWeek = strtotime('+1 week');
				$next_week_number = date('W', $nextWeek);
				
				$data = array("week_number" => $next_week_number);
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
								  'week_number' => $next_week_number);
								  
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
				$nextWeek = strtotime('+1 week');
				$next_week_number = date('W', $nextWeek);
				
				$data = array("week_number" => $next_week_number);
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
								  'week_number' => $next_week_number);
								  
					$table = 'afternoon_schedule';
					$this->main_model->insert_data($table ,$data);
				}
			}			
		}
		
		public function deleteMorningSchedule()
		{
			$this->load->model("main_model");
			$nextWeek = strtotime('+1 week');
			$next_week_number = date('W', $nextWeek);
			$data = array("week_number" => $next_week_number);
			$this->main_model->delete_data("morning_schedule",$data);
			echo(true);
		}
		
		public function deleteAfternoonSchedule()
		{
			$this->load->model("main_model");
			$nextWeek = strtotime('+1 week');
			$next_week_number = date('W', $nextWeek);
			$data = array("week_number" => $next_week_number);
			$this->main_model->delete_data("afternoon_schedule",$data);
			echo(true);
		}
		
		public function copyMorningSchedule()
		{
			$this->load->model("main_model");
			
			$nextWeek = strtotime('+1 week');
			$next_week_number = date('W', $nextWeek);
			
			$data = array("week_number" => $next_week_number);
			$this->main_model->delete_data("morning_schedule",$data);
			
			$week_number = array("week_number" => date("W"));
			$get_morning_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"morning_schedule");
			$morning_schedules = $get_morning_schedule_query->result_array();
			
			for($i=0;$i<sizeof($morning_schedules);$i++)
			{
				$task = $morning_schedules[$i]['task'];
				$monday = $morning_schedules[$i]['monday'];
				$tuesday = $morning_schedules[$i]['tuesday'];
				$wednesday = $morning_schedules[$i]['wednesday'];
				$thursday = $morning_schedules[$i]['thursday'];
				$friday = $morning_schedules[$i]['friday'];
				$saturday = $morning_schedules[$i]['saturday'];
				$sunday = $morning_schedules[$i]['sunday'];
				$remark = $morning_schedules[$i]['remark'];
					
				$data = array('task' => $task,
							  'monday' => $monday,
							  'tuesday' => $tuesday,
							  'wednesday' => $wednesday,
							  'thursday' => $thursday,
							  'friday' => $friday,
							  'saturday' => $saturday,
							  'sunday' => $sunday,
							  'remark' => $remark,
							  'week_number' => $next_week_number);
								  
				$table = 'morning_schedule';
				$this->main_model->insert_data($table ,$data);
			}
			
			echo(true);
		}
		
		public function copyAfternoonSchedule()
		{
			$this->load->model("main_model");
			
			$nextWeek = strtotime('+1 week');
			$next_week_number = date('W', $nextWeek);
				
			$data = array("week_number" => $next_week_number);
			$this->main_model->delete_data("afternoon_schedule",$data);
			
			$week_number = array("week_number" => date("W"));
			$get_afternoon_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
			$afternoon_schedules = $get_afternoon_schedule_query->result_array();
			
			for($i=0;$i<sizeof($afternoon_schedules);$i++)
			{
				$task = $afternoon_schedules[$i]['task'];
				$monday = $afternoon_schedules[$i]['monday'];
				$tuesday = $afternoon_schedules[$i]['tuesday'];
				$wednesday = $afternoon_schedules[$i]['wednesday'];
				$thursday = $afternoon_schedules[$i]['thursday'];
				$friday = $afternoon_schedules[$i]['friday'];
				$saturday = $afternoon_schedules[$i]['saturday'];
				$sunday = $afternoon_schedules[$i]['sunday'];
				$remark = $afternoon_schedules[$i]['remark'];
					
				$data = array('task' => $task,
							  'monday' => $monday,
							  'tuesday' => $tuesday,
							  'wednesday' => $wednesday,
							  'thursday' => $thursday,
							  'friday' => $friday,
							  'saturday' => $saturday,
							  'sunday' => $sunday,
							  'remark' => $remark,
							  'week_number' => $next_week_number);
								  
				$table = 'afternoon_schedule';
				$this->main_model->insert_data($table ,$data);
			}
			
			echo(true);
		}
	}
?>