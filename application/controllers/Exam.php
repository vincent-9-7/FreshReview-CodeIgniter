<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam extends CI_Controller {

	public function index()
	{	
    // $this->load->view('template/header');
    // echo '<script>console.log("input new email: '.$newEmail.'");</script>';
    // echo '<script>console.log("test");</script>';
    
    // echo print “hello”;
    // echo echo “hello”;
    // echo "hello";
    // print "helll";
    // $00AA2 = 2;
    // echo 3/2;
    // echo strpos("conferEnce","E");
    // session_start();
    $_SESSION["aa"] = 1;
    // echo $_SESSION["aa"];
    unset($_SESSION["aa"]);
    printf("asda:%s",$_SESSION["aa"]);
    // echo $00AA2;
    // printf(%s,"hi");
    

  }
  

}
?>
