<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class Item_model extends CI_Model{

    // 1/3 admin 添加三个物品属性
    public function addItem($name, $price,$storage,$filename,$filetype){
      
      $newItem = array(
        'name' => $name,
        'price' => $price,
        'storage' => $storage
      );
      // $png = '.png';
      // $jpg = '.jpg';
      //就我而言，这是因为与+其他语言一样使用了我，但是在PHP字符串中，串联运算符是 .
      if($name.$filetype!=$filename) {
        return 'upload file name false';
      }
      else {
        $this->db->where('name', $name);
        $nameResult = $this->db->get('items');
        //如果name存在，报错
        if($nameResult->num_rows() == 1){
          return 'item name false';
        } 
        else {
          //如果name不存在，插入新item
          $this->db-> insert ('items', $newItem);
          return 'success';
          }
      }
    }	

    // 2/3 admin 添加物品图片
    public function addItemImage($filename,$path,$itemName){
      $data = array(
        'filename' => $filename,
        'path' => $path,
        'itemName' => $itemName
      );
      $query = $this->db->insert('itemImages', $data);
    
    }	

    // 3/3 首页AJAX搜索item物品
    public function fetch_data($query) {
      if($query == ''){
          return null;
      }
      // 返回全部item
      else if($query == 'totaltotalitem'){
        $this->db->select("*");
        $this->db->from("itemImages");
        $this->db->order_by('itemName', 'ESC'); //正序
        $obj = $this->db->get();
        return $obj;
        // return $this->db->query("select * from itemImages"); 
      }
      else if($query == 'itemnum'){
        $this->db->select("*");
        $this->db->from("items");
        $this->db->order_by('name', 'ESC'); //正序
        $obj2 = $this->db->get();
        return $obj2;
      }
      else{
          $this->db->select("*");

          // $this->db->from("items");
          $this->db->from("itemImages");
          
          // $this->db->like('name', $query);
          // $this->db->or_like('username', $query);

          $this->db->like('itemName', $query);

          // $this->db->order_by('name', 'DESC');
          $this->db->order_by('itemName', 'DESC');

          return $this->db->get();
        }
    }

    // 4/4 user添加评论
    public function userAddReview($ip,$userId,$item,$title,$comment,$totalrating,$valuerating,$easyrating,$softwarerating,$batteryrating,$camerarating,$hardwarerating,$anonymous){
        
      // 1/2 代表用ip下单
      if($ip != 'no ip') {

        // 如果选中匿名投票 “on"
        if($anonymous == 'on'){
          $data = array(
            'userId'=>'16',
            'itemName'=>$item,
            'title'=>$title,
            'comment'=>$comment,
            'totalRate'=>$totalrating,
            'valueRate'=>$valuerating,
            'easyUseRate'=>$easyrating,
            'softwareRate'=>$softwarerating,
            'batterLifeRate'=>$batteryrating,
            'cameraRate'=>$camerarating,
            'hardwareRate'=>$hardwarerating
          );

          // 评论数+1
          $this->db->where('itemName', $item); 
          $reviewAddOne = $this->db->get('itemImages')->result_array();
          $reviewAddOne =$reviewAddOne[0]['totalReviews']+1;
          
          $reviewdata = array(
            'totalReviews' => $reviewAddOne,
          )	;
          $this->db->where('itemName', $item);
          $this->db->update('itemImages',$reviewdata);
          
          // 插入新评论
          $query = $this->db->insert('reviews', $data);
          if($query){
            return 'success';
          }
        } 
        else {
          //直接注册新用户
          // $newUser = array(
          //   'email' => $ip,
          //   'password' => 'ipaccount',
          //   'name' => $ip
          // );

          // $this->db->where('email', $ip);
          // $ipEmailResult = $this->db->get('users');
          
          // // 如果email不存在
          // if($ipEmailResult->num_rows() != 1){
          // 	$this->db->where('name', $ip);
          //   $ipNameResult = $this->db->get('users');
            
          // 	if($ipNameResult->num_rows() != 1){
          //     //如果name页不存在，插入新用户
          //     $this->db->insert ('users', $newUser);
          // 	}
          // }


          $data = array(
            'userId'=>$userId,
            'itemName'=>$item,
            'title'=>$title,
            'comment'=>$comment,
            'totalRate'=>$totalrating,
            'valueRate'=>$valuerating,
            'easyUseRate'=>$easyrating,
            'softwareRate'=>$softwarerating,
            'batterLifeRate'=>$batteryrating,
            'cameraRate'=>$camerarating,
            'hardwareRate'=>$hardwarerating
          );

          // 评论数+1
          $this->db->where('itemName', $item); 
          $reviewAddOne = $this->db->get('itemImages')->result_array();
          $reviewAddOne =$reviewAddOne[0]['totalReviews']+1;
          
          $reviewdata = array(
            'totalReviews' => $reviewAddOne,
          )	;
          $this->db->where('itemName', $item);
          $this->db->update('itemImages',$reviewdata);
          
          // 插入新评论
          $query = $this->db->insert('reviews', $data);
          if($query){
            return 'success';
          }
        }
      }
     
      // 2/2 正常登陆下单
      else {
        // 如果是匿名下单
        if($anonymous == 'on'){
          $data = array(
            'userId'=>'16',
            'itemName'=>$item,
            'title'=>$title,
            'comment'=>$comment,
            'totalRate'=>$totalrating,
            'valueRate'=>$valuerating,
            'easyUseRate'=>$easyrating,
            'softwareRate'=>$softwarerating,
            'batterLifeRate'=>$batteryrating,
            'cameraRate'=>$camerarating,
            'hardwareRate'=>$hardwarerating
          );

          // 评论数+1
          $this->db->where('itemName', $item); 
          $reviewAddOne = $this->db->get('itemImages')->result_array();
          $reviewAddOne =$reviewAddOne[0]['totalReviews']+1;
          
          $reviewdata = array(
            'totalReviews' => $reviewAddOne,
          )	;
          $this->db->where('itemName', $item);
          $this->db->update('itemImages',$reviewdata);
          
          // 插入新评论
          $query = $this->db->insert('reviews', $data);
          if($query){
            return 'success';
          }
        }
        
        else {
          $data = array(
            'userId'=>$userId,
            'itemName'=>$item,
            'title'=>$title,
            'comment'=>$comment,
            'totalRate'=>$totalrating,
            'valueRate'=>$valuerating,
            'easyUseRate'=>$easyrating,
            'softwareRate'=>$softwarerating,
            'batterLifeRate'=>$batteryrating,
            'cameraRate'=>$camerarating,
            'hardwareRate'=>$hardwarerating
          );

          // 评论数+1
          $this->db->where('itemName', $item); 
          $reviewAddOne = $this->db->get('itemImages')->result_array();
          $reviewAddOne =$reviewAddOne[0]['totalReviews']+1;
          
          $reviewdata = array(
            'totalReviews' => $reviewAddOne,
          )	;
          $this->db->where('itemName', $item);
          $this->db->update('itemImages',$reviewdata);

          // 插入新评论
          $query = $this->db->insert('reviews', $data);
          if($query){
            return "success";
          }
        }
      }
    
    }	

    // 5/5 item展示所有review
    public function get_review_data($item) {
      if($item == ''){
        return null;
      }

      else{
        $query = $this->db->query(

          "SELECT a.name, b.*
            FROM `users` a
            JOIN `reviews` b
            ON a.userId = b.userId 
            WHERE b.itemName LIKE '%$item%';
        ");
        return $query->result();
      }
    }


    // 6/6 返回item的价格/容量
    public function search_item_data($item) {
      
      $query = $this->db->query(
        "SELECT *
          FROM `items`
          WHERE name LIKE '%$item%';
      ");
 

      return $query->result()[0];
    }


  }
?>
