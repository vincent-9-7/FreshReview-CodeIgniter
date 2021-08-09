<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
  
  public function fatch() {
    $this -> load -> model('Item_model'); //加载file model
    $output = '';
    $query = '';
    if($this -> input -> get('query')) {
      $query = $this -> input -> get('query'); //get search query send from ajax search form
    }

    // 🌟使用file_model的fetch_data函数
    $data = $this->Item_model->fetch_data($query);
      if(!$data == null) {
        // 🌟send result back
        echo json_encode ($data -> result());
      } else {
        echo ""; //没找到result
      }

  }

}
?>