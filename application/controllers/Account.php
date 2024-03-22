<?php
class Account extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in_rtv')){
			$this->session->set_flashdata('You Have No Access','Please Contact The IT Department');
			redirect('loginuser');
		}
	}

	public function index()
	{
		$data['alert']="alerts/profile_alert";
		$data['main_view']="users/profile";
    $data['select']="selects/user";
    $data['usertypes']=$this->User_model->usertype();
		$this->load->view('layouts/main',$data);
	}

	public function update($user_uuid){
		//User UUID
		$first_name_uuid = strtolower($this->input->post("first_name"));
		$last_name_uuid = strtolower($this->input->post("last_name"));
		$email_uuid = strtolower($this->input->post("email"));

		//Conversion Of UUID
		$combine_uuid =$first_name_uuid.$last_name_uuid.$email_uuid;
		$mainuuid=$this->uuid->v5($combine_uuid,'8d3dc6d8-3a0d-4c03-8a04-1155445658f7');
		//Check of User
		$single_user_uuid = $this->User_model->get_user_uuid($mainuuid);
		$single_user_row = $this->User_model->single_user($user_uuid);
		$combine_user_row = strtolower($single_user_row->first_name.$single_user_row->last_name.$single_user_row->email);
		//Trim The User
		$combine_user_post_trim = trim($combine_uuid);
		$removed_user_post_space = str_replace(' ', '', $combine_user_post_trim);
		$combine_user_row_trim = trim($combine_user_row);
		$removed_user_row_space = str_replace(' ', '', $combine_user_row_trim);
		//Password Post Use to Checked if the post
		$password_post = $this->input->post('password');
		//The Date for Create_at and Update_at
		date_default_timezone_set('Asia/Manila');
		$datetoday = date('Y-m-d H:i:s');


		//Check of Email
		$checkbox_email = $this->input->post('updateemail');
		if($checkbox_email=='1'){
			$email_post = $this->input->post('email');
			$email_row = $this->User_model->get_email($email_post);
			if(!empty($email_row)){
				$removed_email_space = str_replace(' ', '', $email_row->email);
				if($removed_email_space == $email_post){
					$this->session->set_flashdata('Email already exist','Email already exist');
					redirect('account');
				}
			}
			else{
				$email_to_post = $email_post;
			}
		}else{
			$user_email_row = $this->User_model->get_email_by_user_uuid($user_uuid);
			$email_to_post = $user_email_row->email;
		}


		//If First Name , Last Name and Date of Birth USER UUID WILL Not Change In Edit Post
		if($removed_user_post_space == $removed_user_row_space){
			//Checking of Password If Empty
			if(!empty($password_post)){
				//Password Encryption
				$secured_password= md5($this->input->post('password'));
				//Submit Data to Database
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'middle_name' => $this->input->post('middle_name'),
					'last_name' => $this->input->post('last_name'),
					'password' => $secured_password,
					'email' =>$email_to_post,
          'usertype_id'=>$this->input->post('usertype_id')
				);
			}
			else{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'middle_name' => $this->input->post('middle_name'),
					'last_name' => $this->input->post('last_name'),
					'email' =>$email_to_post,
          'usertype_id'=>$this->input->post('usertype_id')
				);
			}
			$this->User_model->update_user($user_uuid,$data);
			$this->session->set_flashdata('Please Relogin','Please Relogin');
			redirect('/loginuser/logout');
		}

		// Changes Of Edit Post If First Name or Middle Name or Date Of Birth Is Change
		// Part Two Of Checking Of User
		else{
			if(empty($single_user_uuid)){
				$row_uuid ="";
				$removed_uuid_space ="";
			}
			else{
				$row_uuid = strtolower($single_user_uuid->user_uuid);
				$removed_uuid_space = str_replace(' ', '', $row_uuid);
			}



				//Checking of Password If Empty
				if(!empty($password_post)){
					//Password Encryption
					$secured_password= md5($this->input->post('password'));
					//Submit Data to Database
					$data = array(
						'first_name' => $this->input->post('first_name'),
						'middle_name' => $this->input->post('middle_name'),
						'last_name' => $this->input->post('last_name'),
						'password' => $secured_password,
						'user_uuid' => $mainuuid,
						'email' =>$email_to_post,
            'usertype_id'=>$this->input->post('usertype_id')
					);

				}else{
					$data = array(
						'first_name' => $this->input->post('first_name'),
						'middle_name' => $this->input->post('middle_name'),
						'last_name' => $this->input->post('last_name'),
						'user_uuid' => $mainuuid,
						'email' =>$email_to_post,
            'usertype_id'=>$this->input->post('usertype_id')
					);
				}
				$this->User_model->update_user($user_uuid,$data);
				$this->session->set_flashdata('Please Relogin','Please Relogin');
				redirect('/loginuser/logout');
			}
		
	}
}
