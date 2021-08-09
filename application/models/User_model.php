<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // 1/4 Log in 检验
    public function login($email, $password){
			// 如果是admin
			if($email=='admin@fr.com') {
				$this->db->where('email', $email);
				$this->db->where('password', $password);
				$result = $this->db->get('users');
				if($result->num_rows() == 1){
						return 'admin';
				} else {
						return 'wrong password';
				}
			}

			// 如果是User
			else {
				// Validate
				$this->db->where('email', $email);
				// $this->db->where('password', $password);
				$emailResult = $this->db->get('users');
				if($emailResult->num_rows() == 1){
						$this->db->where('email', $email);
						$this->db->where('password', $password);
						$passwordResult = $this->db->get('users');
					
						// 1/3 如果密码正确，返回用户名
						if($passwordResult->num_rows() == 1){
							// $query = $this->db->query("SELECT name FROM users WHERE email LIKE '$email';");
							// foreach ($query->result() as $user){
							// 	$name = $user->name;
							// 	return $name;
							// }
							$query = $this->db->query("SELECT userId FROM users WHERE email LIKE '$email';");
							foreach ($query->result() as $user){
								$userId = $user->userId;
							};

							$query2 = $this->db->query("SELECT name FROM users WHERE email LIKE '$email';");
							foreach ($query2->result() as $user){
								$name = $user->name;
							};

							$userInfo = array(
								'name' => $name,
								'userId' => $userId,
							);
							return $userInfo;
						} 
						// 2/3 如果密码不正确
						else {
							return 'wrong password';
						}
						// return true;
				} 
				// 2/3 如果email不存在
				else {
						return 'email not exist';
						// return false;
				}
			}
		}

		#######################################################################################
		#######################################################################################
		#print_r($query->row());  在model里打印结果
		#######################################################################################
		#######################################################################################



    // 2/4 Register 检验
    public function register($email, $password, $name, $uuid){
        
			$newUser = array(
					'email' => $email,
					'password' => $password,
					'name' => $name,
					'uuid_reset' => $uuid,
					'verifyStatus' => 'false'  // 表示还未验证邮箱
			);

			$this->db->where('email', $email);
			$emailResult = $this->db->get('users');
			//如果email存在，报错
			if($emailResult->num_rows() == 1){
					return 'email false';
			} 
			else {
				$this->db->where('name', $name);
				$nameResult = $this->db->get('users');
					//如果name存在，报错
				if($nameResult->num_rows() == 1){
					return 'name false';
				}
				else {
						//如果emial,name不存在，插入新用户
						$this->db-> insert ('users', $newUser);
						return 'success';
				}
			}
		}
		
		// 2.5/4 Profile页面获取name,email返回前端
		public function getProfile($email, $password){

			$this->db->where('email', $email);
			$emailResult = $this->db->get('users');
			if($emailResult->num_rows() == 1){
					$this->db->where('email', $email);
					$this->db->where('password', $password);
					$passwordResult = $this->db->get('users');
				
					// 1/3 如果密码正确，返回用户 信息
					if($passwordResult->num_rows() == 1){
		
						$query = $this->db->query("SELECT email FROM users WHERE email LIKE '$email';");
						foreach ($query->result() as $user){
							$email = $user->email;
						};

						$query2 = $this->db->query("SELECT name FROM users WHERE email LIKE '$email';");
						foreach ($query2->result() as $user){
							$name = $user->name;
						};

						$query3 = $this->db->query("SELECT verifyStatus FROM users WHERE email LIKE '$email';");
						foreach ($query3->result() as $user){
							$verifyStatus = $user->verifyStatus;
						};

						$query4 = $this->db->query("SELECT phone FROM users WHERE email LIKE '$email';");
						foreach ($query4->result() as $user){
							$phone = $user->phone;
						};

						$userInfo = array(
							'name' => $name,
							'email' => $email,
							'verify' => $verifyStatus,
							'phone' => $phone
						);
						return $userInfo;
					} 
					// 2/3 如果密码不正确
					else {
						return 'wrong password';
					}
			} 

			else {
					return 'email not exist';
			}

		}

		// 3/4 更新email
		public function editEmail($newEmail,$emailSession){
			$this->db->where('email', $newEmail);
			$emailResult = $this->db->get('users');
			//如果email存在，报错
			if($emailResult->num_rows() == 1){
				return 'email already exist';
			} 
			else {
				$data = array(
					'email' => $newEmail,
				)	;
				$this->db->where('email', $emailSession);
				$this->db->update('users',$data);
				return 'success';
			}
		}

		// 4/4 更新name
		public function editName($newName,$nameSession){
			$this->db->where('name', $newName);
			$nameResult = $this->db->get('users');
			//如果name存在，报错
			if($nameResult->num_rows() == 1){
				return 'name already exist';
			} 
			else {
				$data = array(
					'name' => $newName,
				)	;
				$this->db->where('name', $nameSession);
				$this->db->update('users',$data);
				return 'success';
			}
		}

		// 5/5 更新password
		public function editPassword($newPassword,$emailSession){
			$this->db->where('email', $emailSession);
			$userResult = $this->db->get('users');
			//如果user存在，
			if($userResult->num_rows() == 1){
				$data = array(
					'password' => $newPassword,
				)	;
				$this->db->where('email', $emailSession);
				$this->db->update('users',$data);
				return 'success';
			} 
			else {
				return 'email not exist';
			}
		}
		
		//6/6 增加ip 的user
		public function addIpUser($ip){
			$newUser = array(
        'email' => $ip,
        'password' => 'ipaccount',
        'name' => $ip
			);
			
			$this->db->where('email', $ip);
			$ipEmailResult = $this->db->get('users');

			// 如果email不存在
      if($ipEmailResult->num_rows() != 1){
				$this->db->where('name', $ip);
        $ipNameResult = $this->db->get('users');
        
				if($ipNameResult->num_rows() != 1){
          //如果name页不存在，插入新用户
					$this->db->insert ('users', $newUser);
				}
			}
			$query = $this->db->query("SELECT userId FROM users WHERE email LIKE '$ip';");
			foreach ($query->result() as $user){
				$userId = $user->userId;
			};
			return $userId;
		}

		// 7/7 验证email状态改为true
		public function verify_email($email){
			$data = array(
				'verifyStatus' => 'true',
			)	;
			$this->db->get('users');
			$this->db->where('email', $email);
			$this->db->update('users',$data);
			return 'success';
		}

		// 8/8 reset password先查找该email是否存在
		public function find_email($email){
			$this->db->where('email', $email);
			$emailResult = $this->db->get('users');
			//如果email存在，success
			if($emailResult->num_rows() == 1){
				$query = $this->db->query("SELECT uuid_reset FROM users WHERE email LIKE '$email';");
				foreach ($query->result() as $user){
					$uuid = $user->uuid_reset;
				};
				return $uuid;
			} 
			else {
				return 'false';
			}
		}

		// 9. reset password, 如果uuid正确，更改password
		public function check_uuid_password($newpassword, $uuid){
			$this->db->where('uuid_reset', $uuid);
			$uuidResult = $this->db->get('users');
			//如果uuid存在，success
			if($uuidResult->num_rows() == 1){
				$data = array(
					'password' => $newpassword,
				)	;
				$this->db->where('uuid_reset', $uuid);
				$this->db->update('users',$data);
				return 'success';
			} 
			else {
				return 'false';
			}

		}


		// 10. 获取短信验证码（uuid第二段数字）
		public function get_sms_code($email){
			$this->db->where('email', $email);
			
			$query = $this->db->query("SELECT uuid_reset FROM users WHERE email LIKE '$email';");
			foreach ($query->result() as $user){
				$uuid = $user->uuid_reset;
			};

			$check_sms = explode("-",$uuid)[1]; //6aa0c63e-db2b-47ce-be64-520484d1f744 的 db2b
			return $check_sms;
		}

		// 11. 验证短信验证码是否正确
		public function check_sms($email, $sms, $phone){
			$this->db->where('email', $email);
			
			$query = $this->db->query("SELECT uuid_reset FROM users WHERE email LIKE '$email';");
			foreach ($query->result() as $user){
				$uuid = $user->uuid_reset;
			};
		
			$check_sms = explode("-",$uuid)[1]; //6aa0c63e-db2b-47ce-be64-520484d1f744 的 db2b

			if($check_sms == $sms){
				$data = array(
					'phone' => $phone,
				)	;
				$this->db->where('email', $email);
				$this->db->update('users',$data);
				return 'success';
			} 
			else {
				return 'false';
			}

		}

 }
?>
