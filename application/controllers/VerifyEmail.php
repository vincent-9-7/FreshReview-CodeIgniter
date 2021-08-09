<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerifyEmail extends CI_Controller {

	public function index()
	{	
		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();

		$email = $_SERVER['QUERY_STRING']; //获取query
		echo '<script>console.log("Query is: '.$email.'");</script>';

		if($this->User_model->verify_email($email)=='success'){
			$data['kind'] = 'Email';
			$this->load->view('template/header');
			$this->load->view('users/verify_sucss_view',$data);
			$this->load->view('template/static-footer');
		}
		else{
			$this->load->view('template/static-footer');
		}
	}

}
?>
