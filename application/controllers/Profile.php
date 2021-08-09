<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{	
		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$data['emailerror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new email address.</div>";
		$data['nameerror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new name.</div>";
		$data['passworderror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new password.</div>";
		$data['error']= "";

		$this->load->view('template/header');
		// 1/2 如果还没登陆，展示 login view
		if (!$this->session->userdata('logged_in'))
		{
			$data['emailerror']= "";
			$data['nameerror']= "";
			$data['passworderror']= "";
			$data['error']= "";
			$data['email'] = '';
			$data['name'] = '';
	
			// $this->load->view('login_view', $data); //if user has not login ask user to login
			// $this->load->view('template/static-footer');
			redirect('Welcome');
			
		}
		// 2/2 如果已经登陆，展示 profile view
		else{
			if (get_cookie('FRremember')) {
				
				$emails = $this->session->userdata('email');
				$passwords = $this->session->userdata('password');
				$profileResult = $this->User_model->getProfile($emails,$passwords);

				if($profileResult['verify']=='true'){
					$data['verifyStatus'] = "<div class=\"alert alert-success text-center mb-0 \" role=\"alert\">Already Verify!</div>";

				}else {
					$data['verifyStatus'] = "<div class=\"alert alert-danger text-center  mb-0\" role=\"alert\">Email not Verify!</div>";
				}
				
				$data['email'] = $profileResult['email'];
				$data['name'] = $profileResult['name'];
				if($profileResult['phone'] != NULL) {
					$data['phoneNum'] = $profileResult['phone'];
				}else{
					$data['phoneNum'] = "-- --";
				}
			}else {
				$emails = $this->session->userdata('email');
				$passwords = $this->session->userdata('password');
				$profileResult = $this->User_model->getProfile($emails,$passwords);
				// echo '<script>console.log("profile: '.$profileResult['name'].'");</script>';
				// echo '<script>console.log("profile: '.$profileResult['email'].'");</script>';

				if($profileResult['verify']=='true'){
					$data['verifyStatus'] = "<div class=\"alert alert-success text-center mb-0 \" role=\"alert\">Already Verify!</div>";

				}else {
					$data['verifyStatus'] = "<div class=\"alert alert-danger text-center  mb-0\" role=\"alert\">Email not Verify!</div>";
				}
				$data['email'] = $profileResult['email'];
				$data['name'] = $profileResult['name'];
				if($profileResult['phone'] != NULL) {
					$data['phoneNum'] = $profileResult['phone'];
				}else{
					$data['phoneNum'] = "-- --";
				}
			}

			$this->load->view('profile_view',$data);
			$this->load->view('template/static-footer');
		}	

	}

	public function check_email_update_func() {

		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
    $this->load->helper('url');
		$this->load->view('template/header');

		$newEmail = $this->input->post('newEmail'); //getting email from login form

		if (get_cookie('FRremember')) {
			$emailSession = get_cookie('FRemail');
			$nameSession = get_cookie('FRname');
		
		} else {
			$emailSession = $this->session->userdata('email');
			$nameSession = $this->session->userdata('name');
		}

		$data['nameerror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new name.</div>";
		$data['passworderror']= "";

		// comsole log !! 打印输入的账户和密码(现在只是在错误密码的时候会打印）：
		echo '<script>console.log("input new email: '.$newEmail.'");</script>';
		echo '<script>console.log("email from session: '.$emailSession.'");</script>';

		//如果用户目前已经登陆
		if($this->session->userdata('logged_in')){

			// 1/3 如果新旧email相同
			if($newEmail==$emailSession) {
				$data['emailerror']= "<div class=\"alert alert-danger text-center  mb-0\" role=\"alert\">Email can't be same!</div>";
				$data['email'] = $emailSession;
				$data['name'] = $nameSession;

				$this->load->view('profile_view',$data);
			}

			// 2/3 如果修改email成功
			else if ( $this->User_model->editEmail($newEmail,$emailSession)=='success') {
				$data['emailerror']= "<div class=\"alert alert-success text-center mb-0 \" role=\"alert\">Update success!</div>";
				$data['email'] = $newEmail;
				$data['name'] = $nameSession;
				$user_data = array(
					'email' => $newEmail,
					'authLevel' => 'user',
					'logged_in' => true 	//create session variable
				);
				$this->session->set_userdata($user_data);
				set_cookie("FRemail",$newEmail,'604800');
				$this->load->view('profile_view',$data);
			}

			// 3/3 如果email已经存在
			else if( $this->User_model->editEmail($newEmail,$emailSession)=='email already exist') {
				$data['emailerror']= "<div class=\"alert alert-warning text-center mb-0 \" role=\"alert\">Email already exist!</div>";
				$data['email'] = $emailSession;
				$data['name'] = $nameSession;

				$this->load->view('profile_view',$data);
			}

			$this->load->view('template/static-footer');
		}
		
		else{
			redirect('Login'); //if user already logined direct user to Login-> home page
		}
		
	}


	public function check_name_update_func() {
		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
    $this->load->helper('url');
		$this->load->view('template/header');

		$newName = $this->input->post('newName'); //getting email from login form

		if (get_cookie('FRremember')) {
			$emailSession = get_cookie('FRemail');
			$nameSession = get_cookie('FRname');
		
		} else {
			$emailSession = $this->session->userdata('email');
			$nameSession = $this->session->userdata('name');
		}
		
		$data['emailerror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new email address.</div>";
		$data['passworderror']= "";

		// comsole log !! 打印输入的账户和密码(现在只是在错误密码的时候会打印）：
		echo '<script>console.log("input new name: '.$newName.'");</script>';
		echo '<script>console.log("name from session: '.$nameSession.'");</script>';

		//如果用户目前已经登陆
		if($this->session->userdata('logged_in')){
			// 1/3 如果新旧name相同
			if($newName==$nameSession) {
				$data['nameerror']= "<div class=\"alert alert-danger text-center  mb-0\" role=\"alert\">Name can't be same!</div>";
				$data['email'] = $emailSession;
				$data['name'] = $nameSession;

				$this->load->view('profile_view',$data);
			}

			// 2/3 如果修改name成功
			else if ( $this->User_model->editName($newName,$nameSession)=='success') {
				$data['nameerror']= "<div class=\"alert alert-success text-center mb-0 \" role=\"alert\">Update success!</div>";
				$data['email'] = $emailSession;
				$data['name'] = $newName;
				$user_data = array(
					'email' => $emailSession,
					'name' => $newName,
					'authLevel' => 'user',
					'logged_in' => true 	//create session variable
				);
				$this->session->set_userdata($user_data);
				set_cookie("FRname",$newName,'604800');
				$this->load->view('profile_view',$data);
			}

			// 3/3 如果name已经存在
			else if( $this->User_model->editName($newName,$nameSession)=='name already exist') {
				$data['nameerror']= "<div class=\"alert alert-warning text-center mb-0 \" role=\"alert\">Name already exist!</div>";
				$data['email'] = $emailSession;
				$data['name'] = $nameSession;

				$this->load->view('profile_view',$data);
			}

			$this->load->view('template/static-footer');
		}
		
		else{
			redirect('Login'); //if user already logined direct user to Login-> home page
		}

	}


	public function check_password_update_func() {
		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
    $this->load->helper('url');
		$this->load->view('template/header');

		$newPassword = $this->input->post('newPassword'); //getting email from login form

		if (get_cookie('FRremember')) {
			$emailSession = get_cookie('FRemail');
			$nameSession = get_cookie('FRname');
		
		} else {
			$emailSession = $this->session->userdata('email');
			$nameSession = $this->session->userdata('name');
		}
		
		$data['nameerror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new name.</div>";
		$data['emailerror']= "<div class=\"alert alert-light text-center mb-0 \" role=\"alert\">Please input a new email address.</div>";
		$data['passworderror'] = "";

		$data['error']= "";
		$data['email'] = "";
		$data['name'] ="";
		// comsole log !! 打印输入的账户和密码(现在只是在错误密码的时候会打印）：
		echo '<script>console.log("input new password: '.$newPassword.'");</script>';
		echo '<script>console.log("email from session: '.$emailSession.'");</script>';

		//如果用户目前已经登陆
		if($this->session->userdata('logged_in')){
	
			// 1/2 验证password强度
			$uppercase = preg_match('@[A-Z]@', $newPassword);
			$lowercase = preg_match('@[a-z]@', $newPassword);
			$number    = preg_match('@[0-9]@', $newPassword);
			$specialChars = preg_match('@[^\w]@', $newPassword);
			if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($newPassword) < 8 || strlen($newPassword) > 20) {
				$data['passworderror'] = 
				"<div class=\"alert alert-danger text-center\" role=\"alert\">
					Password Strength Low!
					<br>
					Your new password must be 8-20 characters long, and should include at least one upper case letter, one number, and one special character.
				</div>";
				$data['email'] = $emailSession;
				$data['name'] = $nameSession;
				$this->load->view('profile_view',$data);
			}
			// 
			else {
				// 2/2 如果修改password成功
			  if($this->User_model->editPassword($newPassword,$emailSession)=='success') {
					$data['passworderror']= "<div class=\"alert alert-success text-center mb-0 \" role=\"alert\">Update success!</div>";
					$data['email'] = $emailSession;
					$data['name'] = $nameSession;
					$this->load->view('profile_view',$data);
					set_cookie("FRpassword",$newPassword,'604800');
				}
			}

				$this->load->view('template/static-footer');
		}
		
		else{
			redirect('Login'); //if user already logined direct user to Login-> home page
		}



	}
}
?>
