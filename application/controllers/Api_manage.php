<?php
require_once APPPATH . 'core/MY_apicontroller.php';
class Api_manage extends MY_apicontroller {


	public function checktoken(){

		try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
				
				$token = $this->input->post("token", true);

				$user_id = $this->adminAuth($token);

				$this->json_output(array(
	            	'user_id' => $user_id,
	            ));

			} else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}


	}
	
	public function register() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

				
				$email = $this->input->post("email", true);
				$name = $this->input->post("name", true);

				$password = $this->input->post("password", true);
				$passconf = $this->input->post("passconf", true);
				$phone = $this->input->post("phone", true);
				$usertype = $this->input->post("usertype", true);
				$is_terms = $this->input->post("is_terms", true);
				
				$com_name = $this->input->post("com_name", true);
				$com_ssm_no = $this->input->post("com_ssm_no", true);
				$com_address = $this->input->post("com_address", true);
				
				$confirmation_code = md5(date("YmdHis")."443322");
				
				/*  0 => User, -1 => Admin, 2 => Dealer, 3 => Vendor
				$tmp = explode(".", $_SERVER['HTTP_HOST']);
				
				if($tmp[0]=='vendor'){
					$spcarray = array(
						'role_id'		 => '2',
						'mailer_name'	 => 'Vendor',
					);
				} else if($tmp[0]=='dealer'){
					 $spcarray = array(
						'role_id'		 => '3',
						'mailer_name'	 => 'Dealer',
					);
				}else{
					$spcarray = array(
						'role_id'		 => '1',
						'mailer_name'	 => 'Member',
					);
				};
				*/

				$this->load->model("Ads_model");
				$ads_setting = $this->Ads_model->get_ads_setting();

				$credit = 0;
				$userType =  $this->input->post("usertype", true);

				if ($userType == "P"){
					$credit_balance =  $ads_setting['featureCredit_individual'];
					$validity = $ads_setting['validityDay_individual'];
					$mailer_name = "Personal";
				} else if ($userType == "B"){
					$credit_balance =  $ads_setting['featureCredit_company'];
					$validity = $ads_setting['validityDay_company'];
					$mailer_name = "Business";
				}

				//$verification_code = rand(1000,9999);

				
				$array = array(
					'email'       	=> $email,
					//'phone'			=> $phone,
					//'phone_approval'=> $phone_approval,
					'name'			=> $name,
					'usertype'      => $usertype,
					//'level'		 	 => $spcarray['role_id'],
					'level' 		=> 0,	// temporary treat all registered user as normal user.
					'is_terms'      => $is_terms,
					'com_name'		=> $com_name,
					'com_ssm_no'	=> $com_ssm_no,
					'com_address'	=> $com_address,
					'credit_balance'=> $credit_balance,
					'validity' => $validity,
					'cumulated_validity' => $validity,
					'confirmation_code'	 => $confirmation_code,
					'socialRegister_status' => 1,
				);				
				
				$userdata = $this->Users_model->getOne(array('email' => $email));

				if(!empty($userdata)) {
					throw new Exception("This email had been registered in our database. Press OK to recover your password or press cancel to exit this screen.");
				}
				
				if(isset($password) && !empty($passconf) && $password == $passconf) {
					$array['password'] = password_hash($password, PASSWORD_DEFAULT);
				}else{
					throw new Exception("Your password and confirm password is not same. If you forgot your password, press OK to recover your password or press cancel to exit this screen.");
				}
				
				
				//print_r($_POST);exit;
				$array['created_date'] = date("Y-m-d H:i:s");
				$user_id=$this->Users_model->insert($array);

				$this->load->model("User_phone_model");
				$phone_array = array(
					'user_id' => $user_id,
					'phone' =>	$phone,
					'pri' => true,
					'created_date' => date('Y-m-d H:i:s'),
				);
				$phone_check = $this->User_phone_model->getOne(array('phone' => $phone));
				
				if(!empty($phone_check)) {
					//Required approval if duplicated phone number found
					$phone_array['uniq'] = false;
					$phone_array['status'] = "Pending Verification";
				} else {
					$phone_array['uniq'] = true;
					$phone_array['status'] = "OK";
				}

				$phone_id=$this->User_phone_model->insert($phone_array);

				$credit_data = array(
					'user_id' => $user_id,
					'description' => "New register user",
					'credit_amount' => $credit_balance,
					'credit_balance' => $credit_balance,
					'type' => 'FREE',
					'is_processed' => 0,
					'created_date' => date('Y-m-d H:i:s'),
				);
	
				$this->load->model("Credit_record_model");
				$this->Credit_record_model->insert($credit_data);				
				
					            
	            $this->json_output(array(
					'status' => 'OK'
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }

    public function updateProfile() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

				$id = $this->input->post("id", true);
				$name = $this->input->post("name", true);
				$fullname = $this->input->post("fullname", true);
				$email = $this->input->post("email", true);
				$phone_data = $this->input->post("phoneobj", true);
				$gender = $this->input->post("gender", true);

				$usertype = $this->input->post("usertype", true);
				$state_id = $this->input->post("state_id", true);
				$area_id = $this->input->post("area_id", true);
				$aboutme = $this->input->post("aboutme", true);
				$com_name = $this->input->post("com_name", true);
				$com_ssm_no = $this->input->post("com_ssm_no", true);
				$com_ssm_url = $this->input->post("com_ssm_url", true);
				$com_bizcard_url = $this->input->post("com_bizcard_url", true);
				$com_address = $this->input->post("com_address", true);
				$com_logourl = $this->input->post("com_logourl", true);

				if(isset($usertype) && $usertype === 'B') {
					if(empty($com_ssm_url) && empty($com_bizcard_url) && empty($com_logourl)) {
						throw new Exception("To registered as business account, please upload required document: SSM Document, Business Card, Business Logo");
					}
				}

				if(isset($com_ssm_url) && !empty($com_ssm_url)) {
					$business_is_verified = true;
				} else {
					$business_is_verified = false;
				}

				$this->load->model('User_phone_model');
				foreach ($phone_data as $v) {
					// Check if other user has same phone number, set unique as false and wait for approval
					$data = $this->User_phone_model->getOne(array(
						'phone' => $v['phone'],
					));
					if(isset($data) && !empty($data) && $data['user_id'] != $id ) {
						$phone_sql = array(
							'user_id' => $id,
							'phone' => $v['phone'],
							'pri' => $v['pri'],
							'uniq' => false,
							'status' => "Pending Verification",
							'reason' => null,
							'created_date' => date("Y-m-d H:i:s"),
						);
						$phone_id = $this->User_phone_model->insert($phone_sql);
					} else if(isset($data) && !empty($data) && $data['user_id'] == $id && $data['phone'] == $v['phone']) {
						// If primary number change, will update it.
						$phone_sql3 = array(
							'pri' => $v['pri'],
							'modified_date' => date("Y-m-d H:i:s"),
						);
						$phone_id3 = $this->User_phone_model->update(array('id' => $v['id']), $phone_sql3);
					} else {
						
							$phone_sql4 = array(
								'user_id' => $id,
								'phone' => $v['phone'],
								'pri' => $v['pri'],
								'uniq' => true,
								'status' => "OK",
								'reason' => "",
								'created_date' => date("Y-m-d H:i:s"),
							);
							$phone_id4 = $this->User_phone_model->insert($phone_sql4);
						
					}

				}

				$array = array(
					'name'			 	=> $name,
					'fullname'			=> $fullname,
					'email'       	 	=> $email,

					'gender'	 	 => $gender,
					'usertype'	 	 => $usertype,
					'business_is_verified' => $business_is_verified,
					'state_id'	 	 => $state_id,
					'area_id'	 	 => $area_id,
					'aboutme'	 	 => $aboutme,
					'com_name'	 	 => $com_name,
					'com_ssm_no'	 	 => $com_ssm_no,
					'com_ssm_url'	 	 => $com_ssm_url,
					'com_bizcard_url'	 	 => $com_bizcard_url,
					'com_address'	 	 => $com_address,
					'com_logourl'	 	 => $com_logourl
				);

				if($fullname!='' && $phone_data!=''){
					$array['socialRegister_status'] = 1;
				}
				
				$userdata = $this->Users_model->getOne(array('id !=' => $id,'email' => $email));

				if(!empty($userdata)) {
					throw new Exception("This email has been registered in our database");
				}

				$oldpassword = $this->input->post("oldpassword", true);
				$password = $this->input->post("password", true);
				$passconf = $this->input->post("passconf", true);

				if(isset($oldpassword)) {
					if($userdata['password'] != password_verify($oldpassword,$userdata['password'])) {
						throw new Exception("Your old password doesn't match our record, please try again.");
					}
					if(isset($password) && isset($passconf)) {
						if($password == $passconf) {
							$array['password'] = password_hash($password, PASSWORD_DEFAULT);
						} else {
							throw new Exception("Your password and confirm password are not same");
						}	
					}
				}
				
				$array['modified_date'] = date("Y-m-d H:i:s");
				$user_id = $this->Users_model->update(array("id" => $id),$array);
					            
	            $this->json_output(array(
					'status' => 'OK',
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }

	public function submit_contact_us() {
		$this->load->model('Contactus_model');
        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

				$name = $this->input->post("name", true);
				$email = $this->input->post("email", true);
				$subject = $this->input->post("subject", true);
				$phone = $this->input->post("phone", true);
				$enquiry = $this->input->post("enquiry", true);
				$admin_email = $this->input->post("admin_email", true);

				$sql = array(
					'name' => $name,
					'email' => $email,
					'subject' => $subject,
					'phone' => $phone,
					'enquiry' => $enquiry,
					'is_sent' => 1,
					'admin_email' => $admin_email,
					'created_date' => date('Y-m-d H:i:s'),
					'is_deleted' => false
				);
				
				$content = 'Fullname:'.$name.'<br/>';
				$content .= 'Subject:'.$subject.'<br/>';
				//$content .= 'Case ID:'.$id.'<br/>';
				$content .= 'Guest Email:'.$email.'<br/>';
				$content .= 'Phone:'.$phone.'<br/>';
				$content .= 'Description:'.$enquiry.'<br/>';
				$content .= 'Send Date:'.date('Y-m-d H:i:s').'<br/>';
				
	            $this->load->library('Emailer');
				
				$id = $this->Contactus_model->insert($sql);

	            $this->json_output(array(
					'status' => 'OK'
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }	
	
	
	public function search() {
	
	//print_r($_POST);exit;
        $result = $this->Workshops_model->typefetchworkshop(100,0,array(
			'is_deleted'=>0),	
			
		  array(
			'name' => ucwords(urldecode($_POST['phrase'])),
			//'state_code'=>  ucwords(urldecode($state)),
		  ));
		
		//echo $this->db->last_query();exit;
        echo json_encode($result);

    } 
	
	public function checkmail() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
                
                $email = $this->input->post("email", true);
				
				$data = $this->User_model->getEmail(array(
					'email' => $email,
					//'area' => $area,
			 	 ));
				//print_r($data);exit;
				
				if(!empty($data)) {
					  if($this->data['init']['langu'] == 'en'){
						throw new Exception("have this email");
						}else{
						throw new Exception("有这个email了");
					}					
				}else{
					$this->json_output(array(
						'status' => 'OK',
					)); 
				}          


	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }
	
	
	
	public function resetpassword() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

				
				$email = $this->input->post("email", true);
				$pwd_retrieval = md5(date("YmdHis")."443322");
				
				$userdata = $this->Users_model->getOne(array(
					'email' => $email,
			 	));
				
				if(empty($userdata)) {
					throw new Exception("Invalid Email");
				}
								
				$this->Users_model->update(array(
					'id' => $userdata['id'],
				), array(
					'pwd_retrieval' => $pwd_retrieval,			
					'modified_date' => date("Y-m-d H:i:s"),
				));
	            
	            $this->json_output(array(
	            	'status' => 'OK',
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }
	
	
	
	public function signin() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
				
				$email = $this->input->post("email", true);
			    $password = $this->input->post("password", true);                                    
				
			    $userdata = $this->Users_model->getOne(array('email'=>$email,'is_deleted'=> 0 ));
				//print_r($userdata);exit;
				if(empty($userdata)) {

						throw new Exception("Invalid email or password");
				
				} else if($userdata['password'] != password_verify($password,$userdata['password'])) {
						
					   throw new Exception("Invalid email or password");
						
				} else if($userdata['confirmed'] != 1){
					    
						throw new Exception("This email has not been verified yet");
						
				} else {
				  
						$user_id = $userdata['id'];                        
						$randomstring = md5(date("YmdHis").$userdata['id'].rand(1000,9999));
	
						$token_data = $this->User_login_token_model->getOne(array(
							'user_id' => $userdata['id']
						));
						//print_r ($userdata);
						//exit;
						
						if(!empty($token_data)) {
							//允許同一個帳號多人登入
							$this->User_login_token_model->insert(array(
								'user_id'   => $userdata['id'],
								'token'     => $randomstring,
								'expired'   => time()+7*24*3600,
								'created_date'  => date("Y-m-d H:i:s"),
								'modified_date' => date("Y-m-d H:i:s"),
								'is_deleted'    => 0,
							));
	
						} else {
	
							$this->User_login_token_model->insert(array(
								'user_id'	=> $userdata['id'],
								'token'		=> $randomstring,
								'expired'   => time()+7*24*3600,
								'created_date'	=> date("Y-m-d H:i:s"),
								'modified_date'	=> date("Y-m-d H:i:s"),
								'is_deleted'	=> 0,
							));
	
						} 
						$this->json_output(array(							
							'token'  => $randomstring,
						));           		
						$this->cookie->set("token", $randomstring);
				}
				

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }


    public function verify() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
				
				$email = $this->input->post("email", true);
				$code = $this->input->post("code", true);
				
			    $userdata = $this->Users_model->getOne(array(
			    	'email'=>$email,
			    	'is_deleted'=> 0 
			    ));

			    if(empty($userdata)) {
			    	throw new Exception("Invalid email or code");
			    }

			    if($userdata['confirmed'] == 0) { 
				    if($userdata['confirmation_code'] == $code) {

				    	$this->Users_model->update(array(
				    		'id' => $userdata['id'],
				    	), array(
				    		'confirmed' => 1,
				    		'modified_date' => date("Y-m-d H:i:s"),
				    	));

				    } else {
				    	throw new Exception("Invalid confirmation code");
				    }
				}

				$this->json_output(array(							
					'confirmed'  => 1,
				)); 
				
							

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }	
	
	public function renewpassword() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

				$user_id = isset($_POST['id']) ? $_POST['id'] : '';
			
				if(isset($_POST['password']) && !empty($_POST['repassword']) && $_POST['password'] == $_POST['repassword']) {
					$array['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				}else{
					throw new Exception("password wrong");
				}
				
				//print_r($_POST);exit;
				$array['modified_date'] = date("Y-m-d H:i:s");
				$this->Users_model->update(array('id'=>$user_id), $array);
	            
	            $this->json_output(array(
	            	'status' => 'OK',
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }
	
	
	public function resetnewpassword() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

				//$pwd_retrieval  = isset($_POST['pwd_retrieval']) ? $_POST['pwd_retrieval'] : '';
				$pwd_retrieval = $this->input->post("pwd_retrieval",true);

				if(isset($pwd_retrieval) && !empty($pwd_retrieval))
				{				
					$userdata = $this->Users_model->getOne(array('pwd_retrieval'=>$pwd_retrieval));
				}
				else
				{
					throw new Exception("Password recovery code cannot be found from Users model");
				}

				$newpassword = $this->input->post('newpassword',true);
				$newpassconf = $this->input->post('newpassconf',true);
			
				if(isset($newpassword) && !empty($newpassconf) && $newpassword == $newpassconf && !empty($userdata)) 
				{
					$pwd_new = password_hash($newpassconf, PASSWORD_DEFAULT);
				} 
				else
				{
					throw new Exception("Either password and confirm password doesn't match, or user account doesn\'t exist.");
				}
				
				//print_r($_POST);exit;				
				$this->Users_model->update(array('id'=>$userdata['id']),
				array(	
					'pwd_retrieval' => '',
					'password' => $pwd_new,		
					'modified_date' => date("Y-m-d H:i:s"),
				));
	            
	            $this->json_output(array(
	            	'status' => 'OK',
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }
	
	
	public function resendresetpassword() {
		
		try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
				
				$email = $this->input->post("email", true);
				$pwd_retrieval = md5(date("YmdHis")."443322");
				
				$data = $this->Users_model->getOne(array(
					'email' => $email,
			 	));
				
				if($data['email'] != $email) {
					throw new Exception("email wrong");
				}
				
				//print_r($_POST);exit;
				$this->Users_model->update(array(
					'id' => $data['id'],
				), array(
					'pwd_retrieval' => $pwd_retrieval,			
					'modified_date' => date("Y-m-d H:i:s"),
				));
				
				$subject = 'Reset your password from TalkCar';
				
				$content = '<h4>Rest Your Password</h4><br/>';
				$content .= 'Click here to reset your password:'.base_url($this->data['init']['langu'].'/reset-password/'.$pwd_retrieval);
				$this->load->library('Emailer');
	            
	            $this->json_output(array(
	            	'status' => 'OK',
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }	
	
	public function submit_review() {

        try {

	        if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
	            $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
				
				
				if(!empty($_POST['emailreview'])) {
					
					$email = $this->input->post("emailreview", true);
					$confirmation_code = md5(date("YmdHis")."443322");
					
					$arrayuser = array(
						'email' => $email,
						'confirmation_code'=>$confirmation_code,
					);
					$arrayuser['created_date'] = date("Y-m-d H:i:s");
					$user_id = $this->Users_model->insert($arrayuser);
					
					$getuserid = $this->Users_model->getOne(array(
						'email'=>$email,
					));
					
					$user_id = $getuserid['id'];
					
					$subject = 'Verify your email address from TalkCar';
				
					$content = '<h4>Verify Your Email Address</h4><br/>';
					$content .= 'Please follow the link below to verify your email address '.base_url($this->data['init']['langu'].'/register-verify/'.$confirmation_code);
					$this->load->library('Emailer');
					
				}else{
					$user_id = $this->input->post("user_id", true);
				}
				
				
				//print_r($user_id);exit;
				$workshopdata_id = $this->input->post("workshopdata_id", true);
				$message = $this->input->post("message", true);
				$title = $this->input->post("title", true);
				$content = $this->input->post("content", true);
				$rating = $this->input->post("rating", true);
				$review_gallery = $this->input->post("GalleryContent", true);
			
				$array = array(
					'title' => $title,
					'comment' => $content,
					'member_id' => $user_id,
					'workshop_id' => $workshopdata_id,
					'rating' => $rating,
					'review_gallery' => $review_gallery,
				);
				
				$array['created_date'] = date("Y-m-d H:i:s");
				$user_id=$this->Member_reviews_model->insert($array);
				
				$this->load->helper("review_avg_update");
	            review_avg_update($workshopdata_id);
				
	            $this->json_output(array(
	            	'status' => 'OK',
	            ));

	        } else {
	        	throw new Exception("Invalid param");
	        }

    	} catch (Exception $e) {
    		$this->json_output_error($e->getMessage());
    	}

    }
	
		public function member_delete() 
	{
		try {
			if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
				$_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
				$id = $this->input->post('id', true);
				if(!isset($id) || $id === "" ) {
					$resp = "No such person exists in this system";
					throw new Exception($resp);
				} else {
					$this->User_model->delete($id);

					//delete all feature record of ads posted by this user					
					$this->load->model('Ads_model');
					$where = array(
						'seller_id' => $id,
						'status' => 'published',
					);
					$target_adsList = $this->Ads_model->getAll($where);

					$this->load->model('AdsFeature_record_model');
					foreach($target_adsList as $t){
						$where = array(
							'ads_id' => $t['id'],
							'is_deleted' => 0,
						);

						$update_data = array(
							'is_deleted' => 1,
							'modified_date' => date('Y-m-d H:i:s'),
						);

						$this->AdsFeature_record_model->update($where,$update_data);
					}

					//delete all ads posted by this user
					$where = array(
						'seller_id' => $id,
					);

					$update_data = array(
						'ads_feature' => "",
						'status' => 'deleted',
						'bump_date' => NULL,
						'is_addSloted_top' => NULL,
						'is_addSloted_site' => NULL,
						'is_addSloted_middle' => NULL,
						'is_addSloted_bottom' => NULL,
						'deleted_date' => date('Y-m-d H:i:s'),
						'is_deleted' => 1,
						'modified_date' => date('Y-m-d H:i:s'),
					);
					
					$this->Ads_model->update($where,$update_data);

					$resp = "Account suspended successfully.";
					$this->json_output($resp);
				}
			} else {
				throw new Exception("Invalid param");
			}
		} catch (Exception $e) {
			$this->json_output_error($e->getMessage());
		}
	}

	
	
	
	

    
}
