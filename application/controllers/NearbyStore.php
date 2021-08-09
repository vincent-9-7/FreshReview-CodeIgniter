<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NearbyStore extends CI_Controller {

	public function index()
	{	
    $this->load->view('template/header');
    $this->load->view('users/nearby_map_view');
    $this->load->view('template/static-footer');
  }
  

}
?>
