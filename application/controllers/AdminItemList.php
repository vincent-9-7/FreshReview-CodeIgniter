<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminItemList extends CI_Controller {

	public function index()
	{	
		$this->load->model('Item_model');		//load item model
		$this->load->helper('form');
    $this->load->helper('url');
    $this->load->database();
  	$data['error']= "";

		$this->load->view('template/admin-header');
		// 1/2 如果还没登陆，展示 login view
		if (!$this->session->userdata('logged_in'))
		{
			// $data['emailerror']= "";
			// $data['nameerror']= "";
			// $data['passworderror']= "";
			$data['error']= "";
			// $data['email'] = '';
			// $data['name'] = '';
			// $this->load->view('login_view', $data); //if user has not login ask user to login
			// $this->load->view('template/static-footer');
			redirect('Welcome');
		}
		// 2/2 如果已经登陆，展示 item list view
		else{
			$this->load->view('admin/admin_item_list_view',$data);

			$this->load->view('template/static-footer');
			
		}	

	}





}
?>
