<?php
class Nopage extends CI_Controller {

	public function __construct(){
		parent::__construct();
        if(!$this->session->userdata('logged_in_rtv')){
			$this->session->set_flashdata('You Have No Access','Please Contact The IT Department');
			redirect('loginuser');
		}
	}

    public function index(){
        $data['main_view']="page/404";
        $this->load->view('layouts/main',$data);
    }
}
?>
