<?php
	class adminHomeController extends CI_Controller
	{	
		public function __construct()
        {
                parent::__construct();
                date_default_timezone_set("Asia/Kuala_Lumpur");
        }
		
		public function viewNav()
		{
			$this->load->library('session');
			if(Empty($_SESSION['uid']) &&(Empty($_SESSION['user_access_level'])))
			{
				$data['large_state']='<button class="deskLoginBtn" id="deskLogin" onclick="popoutLogin()"><img src="'.base_url().'assets/images/loginIcon.png" width="8%" class="loginIcon"> Login</button>';  
				$data['small_state'] = '<button class="mobileLoginBtn" onclick="popoutLogin()">Login</button>';
                $data["admin_state"] = "<div>";
				$data["main_page_controller"] = "HomeController/viewHomePage";
				$data["big_selector"] = '<a class="nav-link active">FFF Cleaning System<span class="sr-only">(current)</span></a>';									
				$data["small_selector"] = '<a class="nav-link active">FFF Cleaning System<span class="sr-only">(current)</span></a>';
			}
			else
			{
				if($_SESSION['user_access_level'] == 1)
				{
					//$data['large_state']='<button class="navLoginBtn" onclick="logout()"><img src="'.base_url().'assets/images/loginIcon.png" width="8%" class="loginIcon">Admin Logout</button>';  
					$data['large_state'] = '
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="deskLoginBtn dropdown-toggle" id="deskLogin" data-toggle="dropdown">ADMIN PROFILE</a>
                                <ul class="dropdown-menu dropdown-lr pull-left profile-settings" role="menu">
                                    <div class="text-center">
                                        <h4 class="settingtitle"><b>User Settings</b></h4>
                                    </div>
                                        <button class="settings" id="setting1">Settings</button>
                                        <button class="settings" id="setting2" onclick="modalPop(1)">Change Password</button>
                                        <button class="settings" id="setting3" onclick="logout()">Logout</button>
                                </ul>
                            </li>
                        </ul>';
					
					$data['small_state'] = '
                    <div class="nav-item dropdown">
                      <a class="mobileLoginBtn dropdown-toggle" id="adminProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ADMIN PROFILE
                      </a>
                      <div class="dropdown-menu" aria-labelledby="adminProfile" id="settingsMenu">
                        <h2 class="dropdown-header">User Settings</h2>
                        <button class="dropdown-item" type="button">Settings</button>
                        <button class="dropdown-item" type="button" onclick="modalPop(1)">Change Password</button>
                        <button class="dropdown-item" type="button" onclick="logout()">Logout</button>
                      </div>
                    </div>';
                    $data["admin_state"] = "<div id='content'>";
					$data["main_page_controller"] = "adminHomeController/viewMainPage";
					$data["big_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage" id="nav1">View As Supervisor<span class="sr-only">(current)</span></a>';									
					$data["small_selector"] = '<a class="nav-item nav-link active" href="'.base_url().'HomeController/viewMainPage" id="n-nav1">View As Supervisor<span class="sr-only">(current)</span></a>';
				}
			}
			
			$this->load->view('templates/header',$data);
			if(Empty($_SESSION['uid']))
			{
				$this->load->view("templates/popupforms");
			}
			
		}
		public function viewMainPage($page = 'admin_mainpage')
		{
			$this->load->library('session');
			if(empty($_SESSION['user_access_level']))
			{
				redirect("HomeController/viewHomePage");
			}
			if($_SESSION['user_access_level'] != 1)
			{
				redirect("HomeController/viewHomePage");
			}	
			
			if(Empty($_SESSION['uid']))
			{
				redirect("HomeController/viewHomePage");
			}
			else
			{
				$this->viewNav();
				$this->load->view("templates/sidenav");
                $this->load->view("templates/popupforms");
				$this->load->view('admin/'.$page);
				$this->load->view('templates/footer');
			}
		}
		
		public function viewUserPage()
		{	
			$this->load->library('session');
			if(empty($_SESSION['user_access_level']))
			{
				redirect("HomeController/viewHomePage");
			}
			if($_SESSION['user_access_level'] != 1)
			{
				redirect("HomeController/viewHomePage");
			}
			
			$this->load->model("main_model");		
			$page = 'admin_user';
			

			$query = $this->main_model->get_data_order("*","id","users");	
			
			$get_position_query = $this->main_model->get_data("*","position");
			
			$data['positions'] = $get_position_query->result_array();
			$data['users'] = $query->result_array();
			
			$this->viewNav();
			$this->load->view("templates/sidenav");
			$this->load->view('admin/'.$page,$data);
			$this->load->view('templates/footer',$data);
		}
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	