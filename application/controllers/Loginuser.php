<?php
class Loginuser extends CI_Controller {
	public function index(){
        $data['alert']="alerts/login_alert";
        $this->load->view('login/index',$data);

    }

    public function login(){
        $email= $this->input->post('email');
        $password= $this->input->post('password');
        $password_hash = md5($password);

        $user_row = $this->User_model->get_user_username_row($email);
        if(!empty($user_row)){
            if($user_row->enabled=='1'){
                $user_id = $this->User_model->login_user($email,$password_hash);
            }else{
                $this->session->set_flashdata('User Disabled','User Disabled');
                redirect('loginuser');
            }
        }else{
            $this->session->set_flashdata('User Does Not Exist','User Does Not Exist');
            redirect('loginuser');
        }


        if($user_id){
            $user_data = array(
            'user_id' =>$user_id,
            'user_mainid'=>$user_row->id,
            'password' => $user_row->password,
            'first_name' => $user_row->first_name,
            'middle_name' => $user_row->middle_name,
            'last_name'=> $user_row->last_name,
            'email'   =>$user_row->email,
            'superuser'  =>$user_row->superuser,
            'enabled' =>$user_row->enabled,
            'user_uuid' =>$user_row->user_uuid,
            'usertype' =>$user_row->usertype_id,
            'id'=>$user_row->id,
            'excel_upload_status'=>$user_row->excel_upload_status,
            'migration_upload_status'=>$user_row->migration_upload_status,
            'logged_in_rtv' =>true
            );

            $this->session->set_userdata($user_data);
            $this->session->set_flashdata('User Successfully Login','User Successfully Login');
            redirect('dashboard');

        }
        else{
            $this->session->set_flashdata('Login Failed','Login Failed Please Check Your Username and Password');
            redirect('loginuser');
        }

    }

    public function logout(){

        if(!empty($this->session->flashdata('Please Relogin'))){
            $this->session->sess_destroy();
            redirect('/loginuser/settingcheck');
        }
        else{
            $this->session->sess_destroy();
            redirect('loginuser');
        }
    }

    public function settingcheck(){
        $this->session->set_flashdata('Please Relogin Now','Please Relogin Now');
        redirect('loginuser');
    }
}
