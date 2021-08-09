<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminAddItem extends CI_Controller {

	public function index()
	{	
		$this->load->model('Item_model');		//load item model
		$this->load->helper('form');
    $this->load->helper('url');
    $this->load->database();

		$data['itemerror']= "<div class=\"alert alert-light text-center mb-0 mt-2\" role=\"alert\">Please input a new phone name.</div>";
    $data['imgerror']= "<div class=\"alert alert-light text-center mb-0 mt-2\" role=\"alert\">Please make sure image file name is the same as the input phone name!</div>";

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
			$this->load->view('admin/admin_add_item_view',$data);
			$this->load->view('template/static-footer');
			
		}	

	}



	public function admin_add_item_func() {

		$this->load->model('Item_model');		//load item model
		$this->load->helper('form');
    $this->load->helper('url');
    
    $config['upload_path'] = './uploads/admin/img';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size'] = 10240; //10MB
    $config['max_width'] = 0; // no limit
    $config['max_height'] = 0;
    $this->load->library('upload', $config);


		$this->load->view('template/admin-header');

    $name = $this->input->post('name'); //getting name
    $price = $this->input->post('price'); //getting price
    $storage = $this->input->post('storage'); //getting storage
    
    $maxDim = 500;
    $file_name = $_FILES['itemImg']['tmp_name'];
    list($width, $height, $type, $attr) = getimagesize( $file_name );
    if ( $width > $maxDim || $height > $maxDim ) {
        $target_filename = $file_name;
        $ratio = $width/$height;
        if( $ratio > 1) {
            $new_width = $maxDim;
            $new_height = $maxDim/$ratio;
        } else {
            $new_width = $maxDim*$ratio;
            $new_height = $maxDim;
        }
        $src = imagecreatefromstring( file_get_contents( $file_name ) );
        $dst = imagecreatetruecolor( $new_width, $new_height );
        imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
        imagedestroy( $src );
        switch ($_FILES['itemImg']['type']) {
          case 'image/jpeg':
              imagejpeg( $dst, $target_filename); // adjust format as needed
              break;
          case 'image/png':
              imagepng( $dst, $target_filename); // adjust format as needed
              break;
          case 'image/jpg':
              imagejpeg( $dst, $target_filename); // adjust format as needed
              break;
        }
        // imagepng( $dst, $target_filename ); // adjust format as needed
        imagedestroy( $dst );
    }

		//如果用户目前已经登陆
		if($this->session->userdata('name')=='admin'){
      //🌟如果干脆上传失败
      if ( ! $this->upload->do_upload('itemImg')) {
        $data['itemerror']= "<div class=\"alert alert-light text-center mb-0 mt-2\" role=\"alert\">Please input a new phone name.</div>";
        $data['imgerror']= "<div class=\"alert alert-danger text-center mb-0 mt-2\" role=\"alert\">Upload faild!</div>";
        $this->load->view('admin/admin_add_item_view',$data);
      } 
      else{
        // 1/3 上传成功
        if ( $this->Item_model->addItem($name, $price,$storage,$this->upload->data('orig_name'),$this->upload->data('file_ext'))=='success') {
            $this->Item_model->addItemImage($this->upload->data('orig_name'), $this->upload->data('full_path'),$name);
            $data['itemerror']= "<div class=\"alert alert-success text-center mb-0 mt-2\" role=\"alert\">Add new item successful!</div>";
            $data['imgerror']= "<div class=\"alert alert-success text-center mb-0 mt-2\" role=\"alert\">Add new image successful!</div>";

            $this->load->view('admin/admin_add_item_view',$data);
        } 
        // 2/3 上传文件名和手机名不一致，但已经上传到upload，需要删除
        else if ($this->Item_model->addItem($name, $price,$storage,$this->upload->data('orig_name'),$this->upload->data('file_ext'))=='upload file name false') { 

          // echo '<script>console.log("'.$this->upload->data('file_name').'");</script>';
          unlink( "./uploads/admin/img/".$this->upload->data('file_name') ); // 删除该文件
        
          // echo '<script>console.log("'.$this->upload->data('orig_name').'");</script>';
          // echo '<script>console.log("'.$this->upload->data('file_ext').'");</script>';

          $data['itemerror']= "<div class=\"alert alert-light text-center mb-0 mt-2\" role=\"alert\">Please input a new phone name.</div>";
          $data['imgerror']= "<div class=\"alert alert-danger text-center mb-0 mt-2\" role=\"alert\">This upload filename is not the same as the phone name!</div>";
          $this->load->view('admin/admin_add_item_view',$data);
        }
        // 3/3 手机名已存在，但已经上传到upload，需要删除
        else {
          // echo '<script>console.log("'.$this->upload->data('file_name').'");</script>';
          unlink( "./uploads/admin/img/".$this->upload->data('file_name') ); // 删除该文件
        
          $data['itemerror']= "<div class=\"alert alert-danger text-center mb-0 mt-2\" role=\"alert\">This phone name is already exist!</div>";
          $data['imgerror']= "<div class=\"alert alert-light text-center mb-0 mt-2\" role=\"alert\">Please make sure image file name is the same as the input phone name!</div>";
          $this->load->view('admin/admin_add_item_view',$data);
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
