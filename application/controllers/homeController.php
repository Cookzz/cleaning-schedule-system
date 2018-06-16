<?php
	class HomeController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function viewLoginForm($page = 'login')
		{
			if(!file_exists(APPPATH.'views/login/'.$page.'.php'))
			{
				show_404();
			}
			
			$data['title'] = 'Login Form';
			
			$this->load->view('login/'.$page,$data);
		}
		
		public function viewLoginValidation()
		{
			$this->load->model("main_model");
			
			if((isset($_POST['user_id']))&&(isset($_POST['passwords'])))
			{	
				$user_id = $_POST["user_id"];
				$password = $_POST["passwords"];
				$remember = $_POST["remember"];
				
				$inputErr = array();
				//vaidate username
				if($user_id == NULL)
				{
					$inputErr[] = $user_id;
				}
				else
				{
					$data = array('user_id' => $user_id);
					$query = $this->main_model->get_specify_data('*',"user_id",$data,"users");
					$result = $query->num_rows();
					
					if($result<=0)
					{
						$inputErr[] = $user_id;
					}
					else
					{
						//validate password
						if($password == NULL)
						{
							$inputErr[] = $password;
						}
						else
						{
							$data = array('user_id' => $user_id);
							$query = $this->main_model->get_specify_data("user_password","user_password",$data,"users");
							$result = $query->row()->user_password;
							if($result === $password)
							{
								
							}
							else
							{
								$inputErr[] = $password;
							}
						}
					}
				}	
		
				if(empty($inputErr))
				{	
					$this->load->library('session');
					$this->load->helper('cookie');
					
					
					//set cookie or remember me function
					if($remember == "true")
					{
						setcookie ("cookie_user_id", $user_id, time() + (10 * 365 * 24 * 60 * 60));
						setcookie ("cookie_password", $password, time() + (10 * 365 * 24 * 60 * 60));
					}
					if($remember == "false")
					{
						setcookie ("cookie_user_id", "");
						setcookie ("cookie_password", "");
					}
										
					//databases functions
					$data = array('user_id' => $user_id);
					$query = $this->main_model->get_specify_data("id","id",$data,"users");
					$uid = $query->row()->id;	
					
					$query = $this->main_model->get_specify_data("user_access_level","user_access_level",$data,"users");
					$user_access_level = $query->row()->user_access_level;
					
					$_SESSION['user_access_level'] = $user_access_level;
					$_SESSION['uid'] = $uid;
					
					$data = array('pending_duty_date' => date("Y/m/d"));
					$query = $this->main_model->get_specify_data("*","pending_duty_id",$data,"pending_duty");
					$pending_duty_rows = $query->num_rows();
					$data = array('complete_duty_date' => date("Y/m/d"));
					$query = $this->main_model->get_specify_data("*","complete_duty_id",$data,"complete_duty");
					$complete_duty_rows = $query->num_rows();
					
					if($pending_duty_rows <= 0 && $complete_duty_rows <=0 )
					{
						$day = strtolower(date("l"));
						$week = date("W");
						$week_number = array("week_number" => $week,"remark" => "active");
						
						//Select morning schedule and insert to pending order
						$query = $this->main_model->get_specify_data("*","task",$week_number,"morning_schedule");
						$schedule_results = $query->result_array();
						$morning_schedule_results_count = $query->num_rows();
						
						if($morning_schedule_results_count > 0)
						{
							foreach($schedule_results as $schedule_result)
							{
								$task = $schedule_result["task"];
								
								$data = array("duty_task"=>$task);
								$query = $this->main_model->get_specify_data("*","duty_task",$data,"duty");
								$duty_results = $query->result_array();
								$duty_number = $query->num_rows();
								if($duty_number != 0)
								{
									foreach($duty_results as $duty_result)
									{
										if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
										{
											$duty_sub_task = $duty_result['duty_sub_task'];
										
											$data = array("pending_duty_task"=>$task,
													"pending_duty_subtask"=>$duty_sub_task,
													"pending_duty_cleaner"=>$schedule_result[$day],
													"pending_duty_schedule"=>"morning",
													"pending_duty_date"=>date("Y/m/d"));
													
											$query = $this->main_model->insert_data("pending_duty",$data);
										}
										
									}
								}
								else
								{
									if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
									{										
										$data = array("pending_duty_task"=>$task,
												"pending_duty_subtask"=>"No any subtask",
												"pending_duty_cleaner"=>$schedule_result[$day],
												"pending_duty_schedule"=>"morning",
												"pending_duty_date"=>date("Y/m/d"));
												
										$query = $this->main_model->insert_data("pending_duty",$data);
									}
								}
								
							}
						}
						
						
						
						//Select afternoon schedule and insert to pending order
						$query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
						$schedule_results = $query->result_array();
						$afternoon_schedule_results_count = $query->num_rows();
						
						if($afternoon_schedule_results_count > 0)
						{
							foreach($schedule_results as $schedule_result)
							{
								$task = $schedule_result["task"];
								
								$data = array("duty_task"=>$task);
								$query = $this->main_model->get_specify_data("*","duty_task",$data,"duty");
								$duty_results = $query->result_array();
								$duty_number = $query->num_rows();
								if($duty_number != 0)
								{
									foreach($duty_results as $duty_result)
									{
										if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
										{
											$duty_sub_task = $duty_result['duty_sub_task'];
										
											$data = array("pending_duty_task"=>$task,
													"pending_duty_subtask"=>$duty_sub_task,
													"pending_duty_cleaner"=>$schedule_result[$day],
													"pending_duty_schedule"=>"afternoon",
													"pending_duty_date"=>date("Y/m/d"));
													
											$query = $this->main_model->insert_data("pending_duty",$data);
										}
										
									}
								}
								else
								{
									if((!empty($schedule_result[$day])) && ($schedule_result[$day] != "NA"))
									{
										$data = array("pending_duty_task"=>$task,
												"pending_duty_subtask"=>"Do not have any subtask currently",
												"pending_duty_cleaner"=>$schedule_result[$day],
												"pending_duty_schedule"=>"afternoon",
												"pending_duty_date"=>date("Y/m/d"));
												
										$query = $this->main_model->insert_data("pending_duty",$data);
									}
								}
								
							}
						}
						
						if($afternoon_schedule_results_count == 0 && $afternoon_schedule_results_count == 0)
						{
							$data = array("complete_duty_task"=>"This day don't have any duty",
									"complete_duty_date"=>date("Y/m/d"));
												
							$query = $this->main_model->insert_data("complete_duty",$data);
						}
						
						$new_remark = array("remark" => "active");
						$query = $this->main_model->update_data("remark","repair",$new_remark,"morning_schedule");
						$query = $this->main_model->update_data("remark","repair",$new_remark,"afternoon_schedule");
						
					}
					
					if($_SESSION['user_access_level'] ==1)
					{
						echo("adminHomeController/viewMainPage");
					}
					elseif($_SESSION['user_access_level'] ==2)
					{
						echo("HomeController/viewMainPage");
					}
					elseif($_SESSION['user_access_level'] ==3)
					{
						echo("HomeController/viewMainPage");
					}
					elseif($_SESSION['user_access_level'] ==4)
					{
						echo("HomeController/viewRatingPage");
					}	
				}
				else
				{
					echo(false);
					
				}
			}
		}
		
		public function viewLogout($page = 'homepage')
		{
			$this->load->library('session');
			unset($_SESSION['uid']);
			unset($_SESSION['user_access_level']);
			redirect("HomeController/viewHomePage");
		}
		
		public function viewNav()
		{
			$this->load->library('session');
			$this->load->helper('cookie');
			if((Empty($_SESSION['uid']))&&(Empty($_SESSION['user_access_level'])))
			{
				$data['large_state']='<button class="deskLoginBtn" onclick="popoutLogin()"><img src="'.base_url().'assets/images/loginIcon.png" width="30px" class="loginIcon"> Login</button>';  
				$data['small_state'] = '<button class="mobileLoginBtn" onclick="popoutLogin()">Login</button>';
                $data["admin_state"] = "<div>";
				$data["big_selector"] = '<a class="nav-link active" id="nav1">FFF Cleaning System<span class="sr-only">(current)</span></a>';							
				$data["small_selector"] = '<a class="nav-link active">FFF Cleaning System<span class="sr-only">(current)</span></a>';
			}
			else
			{
				$this->load->model("main_model");
				$data = array('id' => ($_SESSION['uid']));
				$query = $this->main_model->get_specify_data("*","user_name",$data,"users");	
				$row = $query->row();	
				$user_name = $row->user_name;
				$user_picture = $row->user_picture;

				$data['large_state'] = '
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="deskLoginBtn dropdown-toggle" id="deskLogin" data-toggle="dropdown"><img src="'.base_url().'assets/images/'.$user_picture.'" class="loginIcon">'.$user_name.'</a>
                                <ul class="dropdown-menu dropdown-lr profile-settings" role="menu">
                                    <div class="text-center">
                                        <h4 class="settingtitle"><b>User Settings</b></h4>
                                    </div>
                                    <form id="ajax-login-form" role="form" autocomplete="off">
                                            <button type="button" class="settings" id="setting1" onclick="javascript:window.location.href='."'".base_url().'HomeController/viewUserSetting'."'".'"'.'>User Settings</button>
                                            <button type="button" class="settings" id="setting2" onclick="modalPop(1)">Change Password</button>
                                            <button type="button" class="settings" id="setting3" onclick="logout()">Logout</button>
                                    </form>
                                </ul>
                            </li>
                        </ul>';
				
				$data['small_state'] = '
                    <div class="nav-item dropdown adminProfileDropdown">
						<a class="mobileLoginBtn dropdown-toggle" id="adminProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							ADMIN PROFILE
						</a>
						<div class="dropdown-menu" aria-labelledby="adminProfile" id="settingsMenu">
							<h2 class="dropdown-header">User Settings</h2>
							<button class="dropdown-item" type="button" onclick="javascript:window.location.href='."'".base_url().'HomeController/viewUserSetting'."'".'"'.'>User Settings</button>
							<button class="dropdown-item" type="button" onclick="modalPop(1)">Change Password</button>
							<button class="dropdown-item" type="button" onclick="logout()">Logout</button>
						</div>
					</div>';
				$data["admin_state"] = "<div>";
				
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					if($_SESSION['user_access_level'] == 1)
					{
						$extra_selector = '<a class="nav-item nav-link active" href="'.base_url().'adminHomeController/viewMainPage" id="nav4">Back To Admin Panel</a>';
					}
					else
					{
						$extra_selector = "";
					}
					
					$data["big_selector"] = '
                    <a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage" id="nav1">Home<span class="sr-only">(current)</span></a>
				        <a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
                            <li class="nav-item dropdown" id="taskDropDown">
                                <a class="nav-link dropdown-toggle active" id="taskToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    Task
                                </a>
                                <div class="dropdown-menu" aria-labelledby="taskToggle" id="taskMenu">
                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewTaskLocationPage">Task</a>
								    <a class="dropdown-item" href="'.base_url().'HomeController/viewSubTaskPage">Subtask</a>
								    <a class="dropdown-item" href="'.base_url().'HomeController/viewDutyPage">Duty</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" id="dutyDropDown">
                                <a class="nav-link dropdown-toggle active" id="dutyToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    Special Duties
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dutyToggle" id="dutyMenu">
                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewAllSpecialDutyPage">View Special Duties</a>
                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewSetSpecialDutyPage">New Special Duty</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" id="attendanceDropDown">
                                <a class="nav-link dropdown-toggle active" id="attendanceToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    Attendance
                                </a>
                                <div class="dropdown-menu" aria-labelledby="attendanceToggle" id="attendanceMenu">
                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewPendingDutyPage">Pending Duties</a>
                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewCompleteDutyPage">Completed Duties</a>
                                </div>
                            </li>
				            
							<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewGraphPage">Graph</a>'.$extra_selector."";
											
										
					$data["small_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
												<li class="nav-item dropdown" id="mobileTaskDropDown">
                                                    <a class="nav-link dropdown-toggle active" id="mobileTaskToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                                        Task
                                                    </a>
                                                    <div class="dropdown-menu mobileMenu" aria-labelledby="mobileTaskToggle" id="mobileTaskMenu">
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewTaskLocationPage">Task</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewSubTaskPage">Subtask</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewDutyPage">Duty</a>
                                                    </div>
                                                </li>
                                                <li class="nav-item dropdown" id="mobileDutyDropDown">
                                                    <a class="nav-link dropdown-toggle active" id="mobileDutyToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                                        Special Duties
                                                    </a>
                                                    <div class="dropdown-menu mobileMenu" aria-labelledby="mobileDutyToggle" id="mobileDutyMenu">
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewAllSpecialDutyPage">View Special Duties</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewSetSpecialDutyPage">Create New Special Duty</a>
                                                    </div>
                                                </li>
                                                <li class="nav-item dropdown" id="mobileAttendanceDropDown">
                                                    <a class="nav-link dropdown-toggle active" id="mobileAttendanceToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                                        Attendance
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="mobileAttendanceToggle" id="mobileAttendanceMenu">
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewPendingDutyPage">Pending Duties</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewSetSpecialDutyPage">Completed Duties</a>
                                                    </div>
                                                </li>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewGraphPage">Graph</a>'.$extra_selector."";
				}
				elseif($_SESSION['user_access_level'] == 3)
				{
					$data["big_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
											<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
											<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewOwnDutyPage">Duty</a>
											<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewOwnSpecialDuty">Special Task</a>';
										
					$data["small_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewOwnDutyPage">Duty</a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewOwnSpecialDuty">Special Task</a>';
				}
				elseif($_SESSION['user_access_level'] == 4)
				{
					$data["big_selector"] = '<span class="nav-link active">FFF Cleaning System</span>';
										
					$data["small_selector"] = '<a class="nav-item nav-link active" href="#">Rating<span class="sr-only">(current)</span></a>';
				}
			}
				
			if(isset($_COOKIE["cookie_user_id"])) 
			{
				$data["cookie_user_id"] = $_COOKIE["cookie_user_id"];
			}
			else
			{
				$data["cookie_user_id"] = '';
			}
			if(isset($_COOKIE["cookie_password"]))
			{
				$data["cookie_password"] = $_COOKIE['cookie_password'];
			}
			else
			{
				$data["cookie_password"] = '';
			}
				
			$this->load->view('templates/header',$data);
			$this->load->view("templates/popupforms",$data);
		}
		public function viewHomePage($page = 'homepage')
		{
			$this->load->library('session');
			
			if(!file_exists(APPPATH.'views/home/'.$page.'.php'))
			{
				show_404();
			}
			if((!Empty($_SESSION['uid'])) && (!Empty($_SESSION['user_access_level'])))
			{
				if($_SESSION['user_access_level'] == 2)
				{
					redirect("HomeController/viewMainPage");
				}
				elseif($_SESSION['user_access_level'] == 1)
				{
					redirect("adminHomeController/viewMainPage");
				}
			}
			else
			{	
				$this->load->library('session');
			
				$this->viewNav();
				$this->load->view('home/'.$page);
				$this->load->view('templates/footer');
			}
		}
		public function viewMainPage($page = 'mainpage')
		{
			if(!file_exists(APPPATH.'views/home/'.$page.'.php'))
			{
				show_404();
			}
			
			$this->load->library('session');
			$this->load->helper('cookie');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			else
			{
				$this->load->model("main_model");
				$query = $this->main_model->get_limit_date("*","special_duty_id DESC",5,"special_duty");
				$data['special_duties'] = $query->result_array();
				
				$this->viewNav();
				$this->load->view('home/'.$page,$data);
				$this->load->view('templates/footer');
			}
		}
		
		public function viewTaskLocationPage($page = 'task')
		{
			$this->load->library('session');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				$query = $this->main_model->get_data_order("*","task","task");
				$data['tasks'] = $query->result_array();
				
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}
				$this->load->view('templates/footer');
			}
		}
		
		public function viewSubTaskPage($page = 'sub_task')
		{
			$this->load->library('session');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				$query = $this->main_model->get_data_order("*","sub_task","sub_task");
				$data['sub_tasks'] = $query->result_array();
				
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}
				$this->load->view('templates/footer');
			}
		}
		
		public function viewDutyPage($page = 'duty')
		{
			$this->load->library('session');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				
				$query = $this->main_model->get_data_order("*","duty_task","duty");
				$data['duties'] = $query->result_array();
				
				$query = $this->main_model->get_data_order("*","task","task");
				$data['tasks'] = $query->result_array();
				
				$query = $this->main_model->get_data_order("*","sub_task","sub_task");
				$data['sub_tasks'] = $query->result_array();
				
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}	
				$this->load->view('templates/footer');
			}
		}
		
		public function viewSchedulePage($page = 'schedule')
		{
			$this->load->library('session');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			else
			{
				$this->load->model("main_model");
				
				$cleaner = array('id' => $_SESSION['uid']);
				$query = $this->main_model->get_specify_data("user_name","user_name",$cleaner,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$cleaner,"users");
				$user_id = $query->row()->user_id;
					
				$data['cleaner'] = $user_id."_".$user_name;
				$data['date'] = date("Y/m/d");
					
				$user_access_level = array("user_access_level" => 3);
				$get_cleaner_query = $this->main_model->get_specify_data("*","id",$user_access_level,"users");
				$data['cleaners'] = $get_cleaner_query->result_array();
				
				$get_task_query = $this->main_model->get_data_order("*","task","task");
				$data['tasks'] = $get_task_query->result_array();
				
				$week_number = array("week_number" => date("W"));
				$get_morning_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"morning_schedule");
				$data['morning_schedules'] = $get_morning_schedule_query->result_array();
				
				$get_afternoon_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
				$data['afternoon_schedules'] = $get_afternoon_schedule_query->result_array();
					
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}
				elseif($_SESSION['user_access_level'] == 3)
				{	
					$this->load->view('cleaner/'.$page,$data);
				}
				$this->load->view('templates/footer');
			}
		}
		
		public function viewNextWeekSchedulePage($page = 'next_week_schedule')
		{
			$this->load->library('session');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			else
			{
				$this->load->model("main_model");
				
				$cleaner = array('id' => $_SESSION['uid']);
				$query = $this->main_model->get_specify_data("user_name","user_name",$cleaner,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$cleaner,"users");
				$user_id = $query->row()->user_id;
					
				$data['cleaner'] = $user_id."_".$user_name;
				$data['date'] = date("Y/m/d");
					
				$user_access_level = array("user_access_level" => 3);
				$get_cleaner_query = $this->main_model->get_specify_data("*","id",$user_access_level,"users");
				$data['cleaners'] = $get_cleaner_query->result_array();
				
				$get_task_query = $this->main_model->get_data_order("*","task","task");
				$data['tasks'] = $get_task_query->result_array();
				
				$week_number = array("week_number" => ((date("W"))+1));
				$get_morning_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"morning_schedule");
				$data['morning_schedules'] = $get_morning_schedule_query->result_array();
				
				$get_afternoon_schedule_query = $this->main_model->get_specify_data("*","task",$week_number,"afternoon_schedule");
				$data['afternoon_schedules'] = $get_afternoon_schedule_query->result_array();
					
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}
				elseif($_SESSION['user_access_level'] == 3)
				{	
					$this->load->view('cleaner/'.$page,$data);
				}
				$this->load->view('templates/footer');
			}
		}
		
		public function viewScheduleFormPage($page = 'schedule_form')
		{
			$this->load->library('session');
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
					
				$user_access_level = array("user_access_level" => 3);
				$get_cleaner_query = $this->main_model->get_specify_data("*","id",$user_access_level,"users");
				$data['cleaners'] = $get_cleaner_query->result_array();
				$data['cleaners_string'] = json_encode($data['cleaners']);
				
				$get_task_query = $this->main_model->get_data_order("*","task","task");
				$data['tasks'] = $get_task_query->result_array();
					
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}
				$this->load->view('templates/footer');
			}
		}
		
		public function viewOwnDutyPage($page = "own_duty")
		{
			$this->load->library('session');
			
			$this->load->model("main_model");
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif( $_SESSION['user_access_level']!=3 )
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{	
				$user_id = array('id' => $_SESSION['uid']);
				$query = $this->main_model->get_specify_data("user_name","user_name",$user_id,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$user_id,"users");
				$user_id = $query->row()->user_id;
				
				//Select pending duty from pending table
				if(date("G") < 13)
				{
					$time = "morning";
				}
				else
				{
					$time = "afternoon";
				}
				$cleaner = array("pending_duty_cleaner" => $user_id."_".$user_name , "pending_duty_date" => date("Y/m/d"), "pending_duty_schedule" => $time);
				$get_pending_query = $this->main_model->get_specify_data("*","pending_duty_task",$cleaner,"pending_duty");
				$pending_duties = $get_pending_query->result_array();
				$pending_duty_count = $get_pending_query->num_rows();
				
				$pending_duties_group = array();
				
				foreach($pending_duties as $pending_duty)
				{
					$pending_duties_group[$pending_duty['pending_duty_task']][]= $pending_duty;
				}
				//______________
				
				//Select complete duty from complete table
				$cleaner = array("complete_duty_cleaner" => $user_id."_".$user_name , "complete_duty_date" => date("Y/m/d"));
				$get_complete_query = $this->main_model->get_specify_data("*","complete_duty_task",$cleaner,"complete_duty");
				$complete_duties = $get_complete_query->result_array();
				$complete_duty_count = $get_complete_query->num_rows();
				
				$complete_duties_group = array();
				
				foreach($complete_duties as $complete_duty)
				{
					$complete_duties_group[$complete_duty['complete_duty_task']][]= $complete_duty;
				}
				//________________
				
				
				$data["pending_duties"] = $pending_duties_group;
				$data["pending_duty_count"] = $pending_duty_count;
				$data["complete_duties"] = $complete_duties_group;
				$data["complete_duty_count"] = $complete_duty_count;
				
				$data["date"] = date("Y/m/d");
				
				$this->viewNav();
				$this->load->view('cleaner/'.$page,$data);
				$this->load->view('templates/footer');
			}
		}
		
		public function viewPendingDutyPage($page = "view_pending_duty")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				
				if(date("G") < 13)
				{
					$time = "morning";
				}
				else
				{
					$time = "afternoon";
				}
				
				$date = array("pending_duty_date" => date("Y/m/d") , "pending_duty_schedule" => $time);
				$orderBy = ("pending_duty_cleaner asc,pending_duty_task asc");
				$query = $this->main_model->get_specify_data2("*",$orderBy,$date,"pending_duty");	
			
				$data['pending_duties'] = $query->result_array();
				$data["time"] = $time;
				$data['link'] = "HomeController/viewDidnDutyPage";
				$data['link_word'] = "View Outstanding Work";
				$data['title'] = "Today's Pending Duty(".$time.")";
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewCompleteDutyPage($page = "view_complete_duty")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				
				if(date("G") < 13)
				{
					$time = "morning";
				}
				else
				{
					$time = "afternoon";
				}
				
				$date = array("complete_duty_date" => date("Y/m/d"));
				$orderBy = ("complete_duty_cleaner asc,complete_duty_task asc");
				$query = $this->main_model->get_specify_data2("*",$orderBy,$date,"complete_duty");	
			
				$data['complete_duties'] = $query->result_array();
				$data['link'] = "HomeController/viewAllCompleteDutyPage";
				$data['link_word'] = "View All Completed Duties";
				$data['title'] = "Today's Completed Duties";
				
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewDidnDutyPage($page = "view_pending_duty")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				
				if(date("G") < 13)
				{
					$time = "morning";
					$date = array("pending_duty_date !=" => date("Y/m/d"));
					$orderBy = ("pending_duty_date desc");
					$query = $this->main_model->get_specify_data2("*",$orderBy,$date,"pending_duty");	
				}
				else
				{
					$time = "afternoon";
					$date = array("pending_duty_date !=" => date("Y/m/d") , "pending_duty_date !=" => $time);
					$orderBy = ("pending_duty_date desc");
					$query = $this->main_model->get_specify_data2("*",$orderBy,$date,"pending_duty");	
				}
				
				$data['pending_duties'] = $query->result_array();
				$data["time"] = $time;
				$data['link'] = "HomeController/viewPendingDutyPage";
				$data['link_word'] = "Back to Today's Pending Duties";
				$data['title'] = "Outstanding Work";
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewAllCompleteDutyPage($page = "view_complete_duty")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				
				if(date("G") < 13)
				{
					$time = "morning";
				}
				else
				{
					$time = "afternoon";
				}
				
				$orderBy = ("complete_duty_cleaner,complete_duty_task");
				$query = $this->main_model->get_data_order("*",$orderBy,"complete_duty");	
			
				$data['complete_duties'] = $query->result_array();
				$data['link'] = "HomeController/viewCompleteDutyPage";
				$data['link_word'] = "Back to today's completed duties";
				$data['title'] = "All Completed Duties";
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewUserSetting($page = "user_setting")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			else
			{
				$this->load->model("main_model");
				
				$uid = $_SESSION['uid'];
				
				$uid = array("id" => $uid);
				$query = $this->main_model->get_specify_data("*","id",$uid,"users");
				$data['user_data'] = $query->row_array();
				
				$this->viewNav();
				$this->load->view('home/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewSetSpecialDutyPage($page = "set_special_duty")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{	
				$this->load->model("main_model");
				
				$user_access_level = array("user_access_level" => 3);
				$get_cleaner_query = $this->main_model->get_specify_data("*","id",$user_access_level,"users");
				$data['cleaners'] = $get_cleaner_query->result_array();
				
				$data['cleaners_string'] = json_encode($data['cleaners']);
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewAllSpecialDutyPage($page = "view_all_special_duties")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{	
				$this->load->model("main_model");
				
				$query = $this->main_model->get_data_order("*","special_duty_id","special_duty");				
				$data['special_duties'] = $query->result_array();
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
	
		public function viewSpecifySpecialDutyPage($special_duty_id = NULL)
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{	
				$this->load->model("main_model");
				
				$special_duty_id = array("special_duty_id"=>$special_duty_id);
				$query = $this->main_model->get_specify_data("*","special_duty_id",$special_duty_id,"special_duty");
				$data['special_duty'] = $query->row_array();
				
				$query = $this->main_model->get_specify_data("*","special_duty_cleaner",$special_duty_id,"special_duty_cleaner");
				$data['special_duty_cleaners'] = $query->result_array();
				
				$user_access_level = array("user_access_level" => 3);
				$get_cleaner_query = $this->main_model->get_specify_data("*","id",$user_access_level,"users");
				$data['cleaners'] = $get_cleaner_query->result_array();			
				$data['cleaners_string'] = json_encode($data['cleaners']);
				
				if(Empty($data['special_duty']))
				{
					show_404();
				}
				else
				{
					$this->viewNav();
					$this->load->view('supervisor/view_specify_special_duty.php',$data);
					$this->load->view('templates/footer');
				}
			}
			
		}
		
		public function viewOwnSpecialDuty($page = "own_special_duty")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif( $_SESSION['user_access_level']!=3 )
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{	
				$this->load->model("main_model");
				
				$user_id = array('id' => $_SESSION['uid']);
				
				$query = $this->main_model->get_specify_data("user_name","user_name",$user_id,"users");
				$user_name = $query->row()->user_name;
				$query = $this->main_model->get_specify_data("user_id","user_id",$user_id,"users");
				$user_id = $query->row()->user_id;
				
				$special_duty_date = array("special_duty_date" => date("Y-m-d"));
				$query = $this->main_model->get_specify_data("special_duty_id","special_duty_id",$special_duty_date,"special_duty");
				$special_duties_id = $query->result_array();
				
				$special_duties_id_array = array("default");
				foreach ($special_duties_id as $special_duty_id)
				{
					array_push($special_duties_id_array,$special_duty_id['special_duty_id']);
				}

				$cleaner = array("special_duty_cleaner"=> $user_id."_".$user_name);
				$query = $this->main_model->get_specify_data3("special_duty_id","special_duty_cleaner_id DESC",$cleaner,"special_duty_id",$special_duties_id_array,"special_duty_cleaner");
				$special_duties_id = $query->result_array();
				
				$special_duties_id_array = array("default");
				foreach ($special_duties_id as $special_duty_id)
				{
					array_push($special_duties_id_array,$special_duty_id['special_duty_id']);
				}
				
				$special_duty_date = array("special_duty_date" => date("Y-m-d"));
				$special_duties_id = array("special_duties_id" => $special_duties_id);
				$query = $this->main_model->get_specify_data3("*","special_duty_time ASC",$special_duty_date,"special_duty_id",$special_duties_id_array,"special_duty");
				$special_duties = $query->result_array();
				$special_duties_count = $query->num_rows();
				
				$data["special_duties"] = $special_duties;
				$data["special_duties_count"] = $special_duties_count;
				$data["date"] = date("Y/m/d");
				
				$this->viewNav();
				$this->load->view('cleaner/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewRatingPage($page = "rating")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif( $_SESSION['user_access_level']!=4 )
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{	
				$this->load->model("main_model");
				
				$query = $this->main_model->get_data_order("*","task","task");
				$data['tasks'] = $query->result_array();
				
				$this->viewNav();
				$this->load->view('customer/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
		
		public function viewGraphPage($page = "view_graph")
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			elseif($_SESSION['user_access_level'] == 3 || ($_SESSION['user_access_level'] == 4))
			{
				redirect("HomeController/viewMainPage");
			}
			else
			{
				$this->load->model("main_model");
				
				$query = $this->main_model->get_data("*","rating");
				$data['countOfRating'] = $query->num_rows();	
				
				$this->viewNav();
				$this->load->view('supervisor/'.$page,$data);
				$this->load->view('templates/footer');
			}
			
		}
	}
		
?>
	
	
	
	
	
	
	