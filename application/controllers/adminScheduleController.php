<?php
	class adminScheduleController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function updateMorningSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['mondayScheduleString']))
			{
				$mondaySchedule = json_decode($_POST["mondayScheduleString"], false);

				$morning_schedule_id = $mondaySchedule->morning_schedule_id;
				$stuff = $mondaySchedule->stuff;
				$monday = $mondaySchedule->monday;
				$tuesday = $mondaySchedule->tuesday;
				$wednesday = $mondaySchedule->wednesday;
				$thursday = $mondaySchedule->thursday;
				$friday = $mondaySchedule->friday;
				$saturday = $mondaySchedule->saturday;
				$sunday = $mondaySchedule->sunday;
				$remark = $mondaySchedule->remark;
				$week_number = $mondaySchedule->week_number;
					
				$data = array('stuff' => $stuff,
							  'monday' => $monday,
							  'tuesday' => $tuesday,
							  'wednesday' => $wednesday,
							  'thursday' => $thursday,
							  'friday' => $friday,
							  'saturday' => $saturday,
							  'sunday' => $sunday,
							  'remark' => $remark,
							  'week_number' => $week_number);
								  
				$this->main_model->update_data("morning_schedule_id",$morning_schedule_id,$data,"morning_schedule");
				
				echo("Update Success");
			}			
		}
		
		public function deleteMorningSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['morning_schedule_id']))
			{
				$morning_schedule_id = $_POST["morning_schedule_id"];
				
				$data = array("morning_schedule_id" => $morning_schedule_id);
				$this->main_model->delete_data("morning_schedule",$data);
			}			
		}
		
		public function updateAfternoonSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['afternoonScheduleString']))
			{
				$afternoonSchedule = json_decode($_POST["afternoonScheduleString"], false);

				$afternoon_schedule_id = $afternoonSchedule->afternoon_schedule_id;
				$stuff = $afternoonSchedule->stuff;
				$monday = $afternoonSchedule->monday;
				$tuesday = $afternoonSchedule->tuesday;
				$wednesday = $afternoonSchedule->wednesday;
				$thursday = $afternoonSchedule->thursday;
				$friday = $afternoonSchedule->friday;
				$saturday = $afternoonSchedule->saturday;
				$sunday = $afternoonSchedule->sunday;
				$remark = $afternoonSchedule->remark;
				$week_number = $afternoonSchedule->week_number;
					
				$data = array('stuff' => $stuff,
							  'monday' => $monday,
							  'tuesday' => $tuesday,
							  'wednesday' => $wednesday,
							  'thursday' => $thursday,
							  'friday' => $friday,
							  'saturday' => $saturday,
							  'sunday' => $sunday,
							  'remark' => $remark,
							  'week_number' => $week_number);
								  
				$this->main_model->update_data("afternoon_schedule_id",$afternoon_schedule_id,$data,"afternoon_schedule");
				
				echo("Update Success");
			}			
		}
		
		public function deleteAfternoonSchedule()
		{
			$this->load->model("main_model");
			if(isset($_POST['afternoon_schedule_id']))
			{
				$afternoon_schedule_id = $_POST["afternoon_schedule_id"];
				
				$data = array("afternoon_schedule_id" => $afternoon_schedule_id);
				$this->main_model->delete_data("afternoon_schedule",$data);
			}			
		}
		
	}