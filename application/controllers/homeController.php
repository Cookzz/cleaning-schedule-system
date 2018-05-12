<?php
	class HomeController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function viewNav()
		{
			$this->load->library('session');
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
                                <a class="deskLoginBtn dropdown-toggle" id="deskLogin" data-toggle="dropdown"><img src="'.base_url().'assets/images/'.$user_picture.'" width="30px" class="loginIcon">'.$user_name.'</a>
                                <ul class="dropdown-menu dropdown-lr pull-left profile-settings" role="menu">
                                    <div class="text-center">
                                        <h4 class="settingtitle"><b>User Settings</b></h4>
                                    </div>
                                    <form id="ajax-login-form" role="form" autocomplete="off">
                                            <button class="settings" id="setting1">Settings</button>
                                            <button class="settings" id="setting2" onclick="modalPop(1)">Change Password</button>
                                            <button class="settings" id="setting3" onclick="logout()">Logout</button>
                                    </form>
                                </ul>
                            </li>
                        </ul>';
				
				$data['small_state'] = '<button class="mobileLoginBtn" onclick="logout()">'.$user_name.'</button>';
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
                            <li class="nav-item dropdown" id="deskDropDown">
                                <a class="nav-link dropdown-toggle active" id="deskToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Stuff
                                </a>
                                <div class="dropdown-menu" aria-labelledby="deskToggle" id="deskMenu">
                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewStuffLocationPage">Stuff</a>
								    <a class="dropdown-item" href="'.base_url().'HomeController/viewSubStuffPage">Substuff</a>
								    <a class="dropdown-item" href="'.base_url().'HomeController/viewDutyPage">Duty</a>
                                </div>
                            </li>
				            <a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSetSpecialDutyPage">Special Duty</a>
				            <a class="nav-item nav-link active" href="'.base_url().'HomeController/viewPendingDutyPage">Attendance</a>'.$extra_selector."";
											
										
					$data["small_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
												<li class="nav-item dropdown" id="mobileDropDown">
                                                    <a class="nav-link dropdown-toggle active" id="mobileToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Stuff
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="mobileToggle" id="mobileMenu">
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewStuffLocationPage">Stuff</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewSubStuffPage">Substuff</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewDutyPage">Duty</a>
                                                    </div>
                                                </li>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSetSpecialDutyPage">Special Duty</a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewPendingDutyPage">Attendance</a>'.$extra_selector."";
				}
				elseif($_SESSION['user_access_level'] == 3)
				{
					$data["big_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
											<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
											<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewOwnDutyPage">Duty</a>
											<a class="nav-item nav-link active" href="forum.php">Special Stuff</a>
											<a class="nav-item nav-link active" href="#">Contact Us</a>';
										
					$data["small_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewOwnDutyPage">Duty</a>
												<a class="nav-item nav-link active" href="#">Special Stuff</a>
												<a class="nav-item nav-link active" href="#">Contact Us</a>';
				}
				elseif($_SESSION['user_access_level'] == 4)
				{
					$data["big_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
											<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
											<li class="nav-item dropdown" id="deskDropDown">
                                                <a class="nav-link dropdown-toggle active" id="deskToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Stuff
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="deskToggle" id="deskMenu">
                                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewStuffLocationPage">Stuff</a>
                                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewSubStuffPage">Substuff</a>
                                                    <a class="dropdown-item" href="'.base_url().'HomeController/viewDutyPage">Duty</a>
                                                </div>
                                            </li>
											<a class="nav-item nav-link active" href="forum.php">Special Stuff</a>
											<a class="nav-item nav-link active" href="#">Contact Us</a>';
										
					$data["small_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage">Home<span class="sr-only">(current)</span></a>
												<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewSchedulePage">Schedule</a>
												<li class="nav-item dropdown" id="mobileDropDown">
                                                    <a class="nav-link dropdown-toggle active" id="mobileToggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Stuff
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="mobileToggle" id="mobileMenu">
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewStuffLocationPage">Stuff</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewSubStuffPage">Substuff</a>
                                                        <a class="dropdown-item" href="'.base_url().'HomeController/viewDutyPage">Duty</a>
                                                    </div>
                                                </li>
												<a class="nav-item nav-link active" href="#">Special Stuff</a>
												<a class="nav-item nav-link active" href="#">Contact Us</a>';
				}
			}
			
			$this->load->view('templates/header',$data);
			if(Empty($_SESSION['uid']))
			{
				$this->load->view("templates/popupforms");
			}
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
		
		public function viewStuffLocationPage($page = 'stuff')
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
				$query = $this->main_model->get_data_order("*","stuff","stuff");
				$data['stuffs'] = $query->result_array();
				
				$this->viewNav();
				if(($_SESSION['user_access_level'] == 2) || ($_SESSION['user_access_level'] == 1))
				{
					$this->load->view('supervisor/'.$page,$data);
				}
				$this->load->view('templates/footer');
			}
		}
		
		public function viewSubStuffPage($page = 'sub_stuff')
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
				$query = $this->main_model->get_data_order("*","sub_stuff","sub_stuff");
				$data['sub_stuffs'] = $query->result_array();
				
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
				
				$query = $this->main_model->get_data_order("*","duty_stuff","duty");
				$data['duties'] = $query->result_array();
				
				$query = $this->main_model->get_data_order("*","stuff","stuff");
				$data['stuffs'] = $query->result_array();
				
				$query = $this->main_model->get_data_order("*","sub_stuff","sub_stuff");
				$data['sub_stuffs'] = $query->result_array();
				
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
				
				$get_stuff_query = $this->main_model->get_data_order("*","stuff","stuff");
				$data['stuffs'] = $get_stuff_query->result_array();
				
				$week_number = array("week_number" => date("W"));
				$get_morning_schedule_query = $this->main_model->get_specify_data("*","stuff",$week_number,"morning_schedule");
				$data['morning_schedules'] = $get_morning_schedule_query->result_array();
				
				$get_afternoon_schedule_query = $this->main_model->get_specify_data("*","stuff",$week_number,"afternoon_schedule");
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
				
				$get_stuff_query = $this->main_model->get_data_order("*","stuff","stuff");
				$data['stuffs'] = $get_stuff_query->result_array();
				
				$week_number = array("week_number" => ((date("W"))+1));
				$get_morning_schedule_query = $this->main_model->get_specify_data("*","stuff",$week_number,"morning_schedule");
				$data['morning_schedules'] = $get_morning_schedule_query->result_array();
				
				$get_afternoon_schedule_query = $this->main_model->get_specify_data("*","stuff",$week_number,"afternoon_schedule");
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
				
				$get_stuff_query = $this->main_model->get_data_order("*","stuff","stuff");
				$data['stuffs'] = $get_stuff_query->result_array();
					
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
				$get_pending_query = $this->main_model->get_specify_data("*","pending_duty_stuff",$cleaner,"pending_duty");
				$pending_duties = $get_pending_query->result_array();
				$pending_duty_count = $get_pending_query->num_rows();
				
				$pending_duties_group = array();
				
				foreach($pending_duties as $pending_duty)
				{
					$pending_duties_group[$pending_duty['pending_duty_stuff']][]= $pending_duty;
				}
				//______________
				
				//Select complete duty from complete table
				$cleaner = array("complete_duty_cleaner" => $user_id."_".$user_name , "complete_duty_date" => date("Y/m/d"));
				$get_complete_query = $this->main_model->get_specify_data("*","complete_duty_stuff",$cleaner,"complete_duty");
				$complete_duties = $get_complete_query->result_array();
				$complete_duty_count = $get_complete_query->num_rows();
				
				$complete_duties_group = array();
				
				foreach($complete_duties as $complete_duty)
				{
					$complete_duties_group[$complete_duty['complete_duty_stuff']][]= $complete_duty;
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
				$orderBy = ("pending_duty_cleaner asc,pending_duty_stuff asc");
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
				$orderBy = ("complete_duty_cleaner asc,complete_duty_stuff asc");
				$query = $this->main_model->get_specify_data2("*",$orderBy,$date,"complete_duty");	
			
				$data['complete_duties'] = $query->result_array();
				$data['link'] = "HomeController/viewAllCompleteDutyPage";
				$data['link_word'] = "View all completed duty";
				$data['title'] = "Today's Completed Duty";
				
				
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
				}
				else
				{
					$time = "afternoon";
				}
				
				$date = array("pending_duty_date !=" => date("Y/m/d"));
				$orderBy = ("pending_duty_cleaner asc,pending_duty_stuff asc");
				$query = $this->main_model->get_specify_data2("*",$orderBy,$date,"pending_duty");	
			
				$data['pending_duties'] = $query->result_array();
				$data["time"] = $time;
				$data['link'] = "HomeController/viewPendingDutyPage";
				$data['link_word'] = "Back to today pending duty";
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
				
				$orderBy = ("complete_duty_cleaner,complete_duty_stuff");
				$query = $this->main_model->get_data_order("*",$orderBy,"complete_duty");	
			
				$data['complete_duties'] = $query->result_array();
				$data['link'] = "HomeController/viewCompleteDutyPage";
				$data['link_word'] = "Back to today complete duty";
				$data['title'] = "All Completed Duty";
				
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
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	