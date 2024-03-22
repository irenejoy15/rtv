<?php
class User extends CI_Controller {
    public function __construct(){
  		parent::__construct();

  		if(!$this->session->userdata('logged_in_rtv')){
  			$this->session->set_flashdata('You Have No Access','Please Contact The IT Department');
  			redirect('loginuser');
  		}
  		if($this->session->userdata('superuser')!=1){
  			$this->session->set_flashdata('Your Not A Superuser','You Have No Right To Access This Content');
  			redirect('dashboard');
  		}
  	}

    public function index()
  	{
  		$data['main_view']="users/index";
  		$data['ajax_view']="ajax/user_ajax";
  		$this->load->view('layouts/main',$data);
  	}

    public function user_ajax(){
		// Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));


		$users = $this->User_model->all_users();
		$users_count = count($users);
		$data = array();

		foreach($users as $row) {
			if($row->superuser=="1"){
				$superuser = '<button class="bg-block btn btn-success" style="width:100%; padding:3px 0px;">ACTIVE</button>';
			}else{
				$superuser = '<button class="bg-block btn btn-danger" style="width:100%; padding:3px 0px;">INACTIVE</button>';
			}

			//Checking of Superuser
			if($row->enabled=="1"){
				$enabled = '<button class="bg-block btn btn-success" style="width:100%; padding:3px 0px;">ACTIVE</button>';
			}else{
				$enabled = '<button class="bg-block btn btn-danger" style="width:100%; padding:3px 0px;">INACTIVE</button>';
			}

      if($row->usertype_id=='1'){
        $usertype = "ADMIN";
      }
      elseif($row->usertype_id=='2'){
        $usertype = "ACCOUNTING";
      }
      elseif($row->usertype_id=='3'){
        $usertype = "WAREHOUSE";
      }

			$data[] = array(
				 $enabled,
				 $superuser,
				 $row->first_name.' '.$row->middle_name.' '.$row->last_name,
				 $usertype,
				 $row->email,
				 '<a href="'.base_url().'index.php/user/edit/'.$row->user_uuid.'"><span style="color:green;" class="fas fa-edit"></span></a>'
			 );
		}

    $output = array(
			 "draw" => $draw,
			 "recordsTotal" => $users_count,
			 "recordsFiltered" => $users_count,
			 "data" => $data
		  );
		echo json_encode($output);
		exit();

	 }

    public function create(){
      $data['usertypes']=$this->User_model->usertype();
      $data['select']="selects/user";
      $data['alert']="alerts/user_alert";
      $data['main_view']="users/create";
      $this->load->view('layouts/main',$data);
    }

    public function insert(){
		//Check Of Superuser If Checked
		$superusercheck = $this->input->post('superuser');
		if($superusercheck == 1){
			$superuser="1";
		}else{
			$superuser="0";
		}

		//Check Of Enabled Is Checked
		$enable_check = $this->input->post('enabled');
		if($enable_check == 1){
			$enabled="1";
		}else{
			$enabled="0";
		}

		$excel_check= $this->input->post('excel_status');
		if($excel_check == 1){
			$excel="1";
		}else{
			$excel="0";
		}

		$migration_check = $this->input->post('migration_uploader');
		if($migration_check == 1){
			$migration="1";
		}else{
			$migration="0";
		}

		//User UUID
		$first_name_uuid = strtolower($this->input->post("first_name"));
		$last_name_uuid = strtolower($this->input->post("last_name"));
		$email_uuid = strtolower($this->input->post("email"));

		//Conversion Of UUID
		$combine_uuid =$first_name_uuid.$last_name_uuid.$email_uuid;
		$mainuuid=$this->uuid->v5($combine_uuid,'8d3dc6d8-3a0d-4c03-8a04-1155445658f7');

		//Check of Email
		$email_post = $this->input->post('email');
		$email_row = $this->User_model->get_email($email_post);

		if(!empty($email_row)){
			$removed_email_space = str_replace(' ', '', $email_row->email);
			if($removed_email_space == $email_post){
				$this->session->set_flashdata('Email already exist','Email already exist');
				redirect('/user/create');
			}
		}
		//Check of User
		$single_user_uuid = $this->User_model->get_user_uuid($mainuuid);

		if(empty($single_user_uuid)){
			$row_uuid ="";
			$removed_uuid_space ="";
		}
		else{
			$row_uuid = strtolower($single_user_uuid->user_uuid);
			$removed_uuid_space = str_replace(' ', '', $row_uuid);
		}

		if($mainuuid == $removed_uuid_space){
			$this->session->set_flashdata('User already exist','User already exist');
			redirect('/user/create');
		}
		else{
			//The Date for Create_at and Update_at
			date_default_timezone_set('Asia/Manila');
			$datetoday = date('Y-m-d H:i:s');

			//Password Encryption

			$secured_password= md5($this->input->post('password'));

			//Submit Data to Database
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'middle_name' => $this->input->post('middle_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => $secured_password,
				'superuser' => $superuser,
				'user_uuid' => $mainuuid,
				'enabled' =>$enabled,
        		'usertype_id'=>$this->input->post('usertype_id'),
				'excel_upload_status'=>$excel,
				'migration_upload_status'=>$migration,
			);
			$this->User_model->create_user($data);
			$this->session->set_flashdata('User Successfully Created','User Successfully Created');
			redirect('/user/create');
		}
	}

  public function edit($user_uuid){
		$data['user'] = $this->User_model->single_user($user_uuid);
		$data['main_view']="users/edit";
		$data['usertypes']=$this->User_model->usertype();
		$data['select']="selects/user";
		$data['alert']="alerts/user_alert";
		$this->load->view('layouts/main',$data);
	}

  public function update($user_uuid){
	  
		$superusercheck = $this->input->post('superuser');
		if($superusercheck == 1){
			$superuser="1";
		}else{
			$superuser="0";
		}

		//Check Of Enabled Is Checked
		$enable_check = $this->input->post('enabled');
		if($enable_check == 1){
			$enabled="1";
		}else{
			$enabled="0";
		}

		$excel_check= $this->input->post('excel_status');
		if($excel_check == 1){
			$excel="1";
		}else{
			$excel="0";
		}

		$migration_check = $this->input->post('migration_uploader');
		if($migration_check == 1){
			$migration="1";
		}else{
			$migration="0";
		}

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
					redirect('/user/edit/'.$user_uuid);
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
					'superuser' => $superuser,
					'email' =>$email_to_post,
					'enabled' =>$enabled,
          			'usertype_id'=>$this->input->post('usertype_id'),
					'excel_upload_status'=>$excel,
					'migration_upload_status'=>$migration
				);
			}
			else{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'middle_name' => $this->input->post('middle_name'),
					'last_name' => $this->input->post('last_name'),
					'superuser' => $superuser,
					'enabled' =>$enabled,
					'date_of_birth' =>$this->input->post('date_of_birth'),
					'email' =>$email_to_post,
          			'usertype_id'=>$this->input->post('usertype_id'),
					'excel_upload_status'=>$excel,
					'migration_upload_status'=>$migration
				);
			}
			$this->User_model->update_user($user_uuid,$data);
			$this->session->set_flashdata('User Successfully Updated','User Successfully Updated');
			redirect('/user/edit/'.$user_uuid);
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
						'superuser' => $superuser,
						'user_uuid' => $mainuuid,
						'email' =>$email_to_post,
						'enabled' =>$enabled,
            			'usertype_id'=>$this->input->post('usertype_id'),
						'excel_upload_status'=>$excel,
						'migration_upload_status'=>$migration
					);

				}else{
					$data = array(
						'first_name' => $this->input->post('first_name'),
						'middle_name' => $this->input->post('middle_name'),
						'last_name' => $this->input->post('last_name'),
						'superuser' => $superuser,
						'user_uuid' => $mainuuid,
						'email' =>$email_to_post,
						'enabled' =>$enabled,
            			'usertype_id'=>$this->input->post('usertype_id'),
						'excel_upload_status'=>$excel,
						'migration_upload_status'=>$migration
					);
				}

				$this->User_model->update_user($user_uuid,$data);
				$this->session->set_flashdata('User Successfully Updated','User Successfully Updated');
				redirect('/user/edit/'.$mainuuid);

		}
	}
}
?>
