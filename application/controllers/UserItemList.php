<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserItemList extends CI_Controller {
	public function index()
	{	
		$this->load->model('Item_model');		//load item model
		$this->load->helper('form');
    $this->load->helper('url');
    $this->load->database();
  	$data['error']= "";
		$data['img']= "";
		$data['item']= "";
    
		$this->load->view('template/header');
		// 1/2 如果还没登陆，也能进，用ip评论
		if (!$this->session->userdata('logged_in'))
		{
			// redirect('Login');
			$this->load->view('users/user_item_list_view',$data);
			$this->load->view('template/static-footer');
		}
		// 2/2 如果已经登陆，展示 item list view
		else{
			$this->load->view('users/user_item_list_view',$data);
			$this->load->view('template/static-footer');			
		}	

	}


	// 2/3 展示写评论页面view
	public function user_review_func() {
		$this->load->model('Item_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');

		$this->load->view('template/header');

		$item = $_SERVER['QUERY_STRING']; //获取query
		echo '<script>console.log("Query: '.$item.'");</script>';
		
		$this->session->set_userdata(array('itemname' => $item)); 

		//1 传手机名称给view
		$data['item']= $item;
		//2 传图片路径给view
		$path = "uploads/admin/img/".$item.".png";
		if(file_exists($path)){
			// echo '<script>console.log("Rating: '.$path.'");</script>';
			$data['img']= "$item.png";
		}else{
			$path = "uploads/admin/img/".$item.".jpg";
			if(file_exists($path)){
				$data['img']= "$item.jpg";
			}
			else {
				$data['img']= "$item.jpeg";
			}
		}

		//如果用户目前已经登陆
		if($this->session->userdata('logged_in')){
			$this->load->view('users/user_add_review_view',$data);
			$this->load->view('template/static-footer');
		}
		
		else{
			// redirect('Login'); //if user already logined direct user to Login-> home page
			$this->load->view('users/user_add_review_view',$data);
			$this->load->view('template/static-footer');
		}
		
	}

	// 3/3 评论function，之后跳转 评论结果的view
	public function user_update_review_func() {

		$this->load->model('Item_model');
		$this->load->helper('form');
    $this->load->helper('url');
		$this->load->view('template/header');

		$anonymous = $this->input->post('anonymous');  //是否要匿名
		$item = $this->session->userdata('itemname'); //从session获取itemname
		$title = $this->input->post('title'); 
		$comment = $this->input->post('comment'); 
		$totalrating = $this->input->post('totalrating');
		$valuerating = $this->input->post('valuerating');
		$easyrating = $this->input->post('easyrating');
		$softwarerating = $this->input->post('softwarerating');
		$batteryrating = $this->input->post('batteryrating');
		$camerarating = $this->input->post('camerarating');
		$hardwarerating = $this->input->post('hardwarerating');

		echo '<script>console.log("anonymous: '.$anonymous.'");</script>';
		echo '<script>console.log("itemname: '.$item.'");</script>';
		// echo '<script>console.log("title: '.$title.'");</script>';
		// echo '<script>console.log("comment: '.$comment.'");</script>';
		// echo '<script>console.log("totalrating: '.$totalrating.'");</script>';
		// echo '<script>console.log("valuerating: '.$valuerating.'");</script>';
		// echo '<script>console.log("easyrating: '.$easyrating.'");</script>';
		// echo '<script>console.log("softwarerating: '.$softwarerating.'");</script>';
		// echo '<script>console.log("batteryrating: '.$batteryrating.'");</script>';
		// echo '<script>console.log("camerarating: '.$camerarating.'");</script>';
		// echo '<script>console.log("hardwarerating: '.$hardwarerating.'");</script>';
		// echo '<script>console.log("Total data: '.$total.'");</script>';

		$data['post'] = '';
		// 1/2 如果用户目前已经用账户登陆
		if($this->session->userdata('logged_in')){
			$ip = 'no ip';
			// $username = get_cookie('FRname'); //get the username from cookie
			$userId = $this->session->userdata('userId'); //从session获取user Id	

			if ($this->Item_model->userAddReview($ip,$userId,$item,$title,$comment,$totalrating,$valuerating,$easyrating,$softwarerating,$batteryrating,$camerarating,$hardwarerating,$anonymous)=='success') {
				$data['post'] = 'Thank You!';
				$this->load->view('users/comment_succ_view',$data);
				$this->load->view('template/static-footer');
			}else{
				$data['post'] = 'Review Faild!';
				$this->load->view('users/comment_succ_view',$data);
				$this->load->view('template/static-footer');
			}
		}
		
		// 2/2 没登陆的话用ip先注册再下单
		else{
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} 
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} 
			else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$this->session->set_userdata(array('ip' => $ip)); 
			echo '<script>console.log("IP: '.$ip.'");</script>';
			
			$userId = $this->user_model->addIpUser($ip);


			if ($this->Item_model->userAddReview($ip,$userId,$item,$title,$comment,$totalrating,$valuerating,$easyrating,$softwarerating,$batteryrating,$camerarating,$hardwarerating,$anonymous)=='success') {
				$data['post'] = 'Thank You!';
				$this->load->view('users/comment_succ_view',$data);
				$this->load->view('template/static-footer');
			}else{
				echo '<script>console.log("userId: '.$this->Item_model->userAddReview($ip,$userId,$item,$title,$comment,$totalrating,$valuerating,$easyrating,$softwarerating,$batteryrating,$camerarating,$hardwarerating,$anonymous).'");</script>';
				$data['post'] = 'Review Faild!';
				$this->load->view('users/comment_succ_view',$data);
				$this->load->view('template/static-footer');
			}
		}
		
	}

	// 4/4 显示所有review
	public function show_review_func() {
		$this->load->model('Item_model');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');

		$this->load->view('template/header');

		$item = $_SERVER['QUERY_STRING']; //获取query
		echo '<script>console.log("Query is: '.$item.'");</script>';
		
		$this->session->set_userdata(array('itemname' => $item)); 

		//1 传手机名称给view
		$data['item']= $item;
		//2 传图片路径给view
		$path = "uploads/admin/img/".$item.".png";
		if(file_exists($path)){
			// echo '<script>console.log("Rating: '.$path.'");</script>';
			$data['img']= "$item.png";
		}else{
			$path = "uploads/admin/img/".$item.".jpg";
			if(file_exists($path)){
				$data['img']= "$item.jpg";
			}
			else {
				$data['img']= "$item.jpeg";
			}
		}

		$data['reviews'] = $this->Item_model->get_review_data($item);



		$this->load->view('users/user_find_review_view',$data);
		$this->load->view('template/static-footer');


	}

	// 5/5 生成产品信息pdf
	public function download_pdf_func() {
		$this->load->model('Item_model');
		
		$item = $_SERVER['QUERY_STRING']; //获取query
		echo '<script>console.log("Query is: '.$item.'");</script>';
	
		//2 传图片路径给view
		$path = "uploads/admin/img/".$item.".png";
		$kind = '';
		if(file_exists($path)){
			// echo '<script>console.log("Rating: '.$path.'");</script>';
			$path = "uploads/admin/img/".$item.".png";
			$kind = "png";
		}else{
			$path = "uploads/admin/img/".$item.".jpg";
			if(file_exists($path)){
				$path = "uploads/admin/img/".$item.".jpg";
				$kind = "jpg";
			}
			else {
				$path = "uploads/admin/img/".$item.".jpeg";
				$kind = "jpeg";
			}
		}

		$phone_data = $this->Item_model->search_item_data($item);
		$price = $phone_data->price;
		$storage = $phone_data->storage;

		echo '<script>console.log("is: '.$price.'");</script>';
		echo '<script>console.log("is: '.$storage.'");</script>';
		ob_clean();
		require('fpdf/fpdf.php');
	
		/*A4 width : 219mm*/
		$pdf = new FPDF('P','mm','A4');
	
		$pdf->AddPage();
		/*output the result*/
	
		/*set font to arial, bold, 14pt*/
		$pdf->SetFont('Arial','B',20);
	
		/*Cell(width , height , text , border , end line , [align] )*/
	
		$pdf->Cell(46 ,10,'',0,0);
		$pdf->Cell(59 ,5,'Phone Name:'.$item,0,0);
		$pdf->Cell(59 ,10,'',0,1);
	
		$pdf->SetFont('Arial','B',15);
		$pdf->Cell(71 ,25,'',0,0);
		$pdf->Cell(29 ,25,'',0,0);
		$pdf->Cell(59 ,25,'Price: $'.$price,0,1);
	
		$pdf->SetFont('Arial','B',15);
		$pdf->Cell(71 ,25,'',0,0);
		$pdf->Cell(29 ,25,'',0,0);
		$pdf->Cell(59 ,25,'Storage: '.$storage.' GB',0,1);

		$pdf->SetFont('Arial','B',15);
		$pdf->Cell(71 ,25,'',0,0);
		$pdf->Cell(29 ,25,'',0,0);
		$pdf->Cell(59 ,25,'Manufacturer Warranty: One Year',0,1);
	
		$pdf->Image($path,10,20,60,70,$kind);
	
		//  $pdf->Output('example2.pdf','D');
		$pdf->Output('I','Details of '.$item);
	
		ob_end_flush(); 
	}
}
?>
