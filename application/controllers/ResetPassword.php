<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends CI_Controller {

	public function index()
	{	
		$this->load->model('User_model');		//load user model
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();

		// $email = $_SERVER['QUERY_STRING']; //获取query
		// echo '<script>console.log("Query is: '.$email.'");</script>';

		// if($this->User_model->verify_email($email)=='success'){

		// 	$this->load->view('template/header');
		// 	$this->load->view('users/verify_sucss_view');
		// 	$this->load->view('template/static-footer');
		// }
		// else{
		// 	$this->load->view('template/static-footer');
    // }

    $data['error'] = '';
    // $data['error']= "<div class=\"alert alert-danger text-center\" role=\"alert\"> Email not exist!</div>";

    $this->load->view('template/header');
    $this->load->view('users/reset_send_view',$data);
    // $this->load->view('users/reset_check_view');
    $this->load->view('template/static-footer');
  }
  
  // 产生随机uuid,这页没用上，register用了
  function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    echo '<script>console.log("'.$uuid.'");</script>';

    // Output the 36 character UUID.
    return $uuid;
  }

  // 发送uuid到邮箱的页面
  public function send_uuid_func() {
    $this->load->model('User_model');		//load user model
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
    $this->load->database();
    
    $email = $this->input->post('email'); //getting email

    // 如果能找到，发邮件（uuid）
    $uuid = $this->User_model->find_email($email);
    if ($uuid !='false') {

      $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mailhub.eait.uq.edu.au',
        'smtp_port' => 25,
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE ,
        'mailtype' => 'html',
        'starttls' => true,
        'newline' => "\r\n"
        );
      $newEmail = $email;
      $subject = "Reset Password -- FRESH REVIEW";
      $mes = nl2br("Please click this link to rest your password: https://infs3202-8c7673f1.uqcloud.net/FreshReview/ResetPassword/input_uuid_func \n Your Reset is: $uuid");
      $this->email->initialize($config);
      $this->email->from(get_current_user().'@student.uq.edu.au',get_current_user());
      $this->email->to($newEmail);
      // $this->email->cc($this->input->post('cc'));
      $this->email->subject($subject);
      $this->email->message($mes);
      $this->email->send();


      echo '<script>console.log("True");</script>';

      $data['error']= "<div class=\"alert alert-success text-center\" role=\"alert\"> Please check your email box!</div>";
      $this->load->view('template/header');
      $this->load->view('users/reset_send_view',$data);
      $this->load->view('template/static-footer');
    }

    // 找不到email
    else{
      echo '<script>console.log("ff");</script>';

      $data['error']= "<div class=\"alert alert-danger text-center\" role=\"alert\"> Email not exist!</div>";
      $this->load->view('template/header');
      $this->load->view('users/reset_send_view',$data);
      $this->load->view('template/static-footer');
    }
  }

  // 输入uuid的页面
  public function input_uuid_func() {
    $data['error'] = '';
    // $data['error']= "<div class=\"alert alert-danger text-center\" role=\"alert\"> Email not exist!</div>";
    $this->load->view('template/header');
    // $this->load->view('users/reset_send_view',$data);
    $this->load->view('users/reset_check_view',$data);
    $this->load->view('template/static-footer');
  }

  // 检查uuid是否正确的func
  public function check_uuid_func() {
    $this->load->model('User_model');		//load user model
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();


    $key = $this->input->post('key'); //getting email
    $newpassword = $this->input->post('newpassword'); //getting email

    // 如果修改成功
    if ( $this->User_model->check_uuid_password($newpassword, $key) =='success'){
      $data['error']= "<div class=\"alert alert-success text-center\" role=\"alert\">Reset Success!</div>";
      $this->load->view('template/header');
      // $this->load->view('users/reset_send_view',$data);
      $this->load->view('users/reset_check_view',$data);
      $this->load->view('template/static-footer');
    }
    else{
      $data['error']= "<div class=\"alert alert-danger text-center\" role=\"alert\">Reset Kay not valid!</div>";
      $this->load->view('template/header');
      $this->load->view('users/reset_check_view',$data);
      $this->load->view('template/static-footer');
    }
  }

}
?>
