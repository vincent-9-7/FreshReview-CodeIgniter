<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{	
		$this->load->database();
		if($this->session->userdata('name') == 'admin' ||get_cookie('FRemail')=='admin@fr.com') {
			$this->load->view('template/admin-header');
			$this->load->view('admin/admin_dashboard_view');
			$this->load->view('template/static-footer');
		}else{
			redirect('Welcome');
		}
    
	}
}
?>
