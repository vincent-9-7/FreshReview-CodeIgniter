<!-- 这里是controller -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$data['error']= "";
		$data['email'] = '';
		$this->load->helper('form');
		$this->load->helper('url');

		
		$this->load->view('template/header');

		// 1/2 如果还没登陆，展示 login view
		if (!$this->session->userdata('logged_in'))
		{
			// 1.5/2 如果用户选中了remember me
			if (get_cookie('FRremember')) { // check if user activate the "remember me" feature  
				echo '<script>console.log("already remember me");</script>';

				$email = get_cookie('FRemail'); //get the username from cookie
				$password = get_cookie('FRpassword'); //get the username from cookie
				echo '<script>console.log("cookie email is: '.$email.'");</script>';
				echo '<script>console.log("cookie password is: '.$password.'");</script>';

				if($email == 'admin@fr.com') {
					if($this->user_model->login($email, $password)=='admin') {
						$user_data = array(
							'email' => $email,
							'name' => 'admin',
							'password' => $password,
							'authLevel' => 'admin',
							'logged_in' => true 	//create session variable
						);
						$this->session->set_userdata($user_data); //set user status to login in session
						redirect('Admin');
					}
				}
				else {
					if ( $this->user_model->login($email, $password)!="wrong password"
								&& $this->user_model->login($email, $password)!="email not exist"
								&& $this->user_model->login($email, $password)!="admin")//check username and password correct
						{
							$userId = $this->user_model->login($email, $password);
							$user_data = array(
								'email' => $email,
								'userId' => $userId,
								'password' => $password,
								'authLevel' => 'user',
								'logged_in' => true 	//create session variable
							);
							$this->session->set_userdata($user_data); //set user status to login in session
							redirect('Welcome');
						}
					}
			}
			else {
				echo '<script>console.log("first time login");</script>';

				$this->load->view('login_view', $data); //if user has not login ask user to login
				$this->load->view('template/static-footer');
			}

		}
		// 2/2 如果已经登陆，展示 home view
		else{
			echo '<script>console.log("already login");</script>';
			// redirect('Login');
			redirect('Welcome');
		}	
	}

	
	public function check_login_func()
	{
		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
		$this->load->helper('url');

		$this->load->view('template/header');

		$email = $this->input->post('email'); //getting email from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //check remember
		//打印输入的账户和密码：
		echo '<script>console.log("Input email is: '.$email.'");</script>';
		echo '<script>console.log("password is: '.$password.'");</script>';
		echo '<script>console.log("Remember: '.$remember.'");</script>';


		//1/2如果还没登陆过
		if(!$this->session->userdata('logged_in')){	

			// 1/4 检测 admin 密码是否匹配
			if ( $this->user_model->login($email, $password)=='admin') {
				$user_data = array(
					'email' => $email,
					'name' => 'admin',
					'password' => $password,
					'authLevel' => 'admin',
					'logged_in' => true 	//create session variable
				);
				$this->session->set_userdata($user_data);

				if($remember) {
					set_cookie("FRemail",$email,'604800');
					set_cookie("FRpassword",$password,'604800');
					set_cookie("FRremember",$remember,'604800');
				}

				redirect('Admin'); // direct Admin page
			}

			// 2/4 如果密码错误，email保留
			else if($this->user_model->login($email, $password)=='wrong password') {
				//🌟如果密码输入错误，email不消失，重新输入密码即可
				$data['error']= "<div class=\"alert alert-danger text-center\" role=\"alert\"> Incorrect passwrod! Please try again.</div>";
				$data['email'] = $email;
				$this->load->view('login_view',$data);	
				$this->load->view('template/static-footer');
			}

			// 3/4 如果 email 不存在
			else if($this->user_model->login($email, $password)=='email not exist') {
				$data['error']= "<div class=\"alert alert-danger text-center\" role=\"alert\"> Email not exist! Please <a href=\" ".base_url()."Register\" class=\"alert-link\">register</a> your account.</div>";
				$data['email'] = '';
				$this->load->view('login_view',$data);	
				$this->load->view('template/static-footer');
			}
			// 4/4 User密码正确，UserModel返回userId 存储email和userId到session
			else{
				// echo '<script>console.log("'.$this->user_model->login($email, $password).'");</script>';
				$loginArray = $this->user_model->login($email, $password);
				$array_values = array_values($loginArray); 
				$userName = $array_values[0];
				$userId = $array_values[1];
				// $userId = $this->user_model->login($email, $password);
				$user_data = array(
					'email' => $email,
					'name' => $userName,
					'password' => $password,
					'userId' => $userId,
					'authLevel' => 'user',
					'logged_in' => true 	//create session variable
				);
				$this->session->set_userdata($user_data); //set user status to login in session

				// 存储604800s -> 7days 的cookie
				if($remember) {
					set_cookie("FRemail",$email,'7200');
					set_cookie("FRname",$userName,'7200');
					set_cookie("FRpassword",$password,'7200');
					set_cookie("FRremember",$remember,'7200');
				}
				redirect('Welcome');
			}
		}

		//2/2如果已经登陆，直接跳转首页
		else{
			{
				redirect('Welcome'); 
			}
			// $this->load->view('template/footer');
		}
	}

	public function Logout()
	{
		$this->load->helper('url'); //这是我自己加的，重定向
		$this->session->unset_userdata('logged_in','userId','email','name','authLevel');
		$this->session->sess_destroy();

		// setcookie("email", "", time()-3600);
		delete_cookie("FRemail");
		delete_cookie("FRname");
		delete_cookie("FRpassword");
		delete_cookie("FRremember");
		redirect('Welcome'); // redirect user back to login
	}
}
?>
