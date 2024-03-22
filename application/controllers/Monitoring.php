<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
ini_set('sqlsrv.ClientBufferMaxKBSize','1000000'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','1000000');
require FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Monitoring extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in_rtv')){
			$this->session->set_flashdata('You Have No Access','Please Contact The IT Department');
			redirect('loginuser');
		}
	}

//   public function index(){
//     $data['main_view']="monitorings/index";
//     $data['ajax_view']="ajax/rtv_ajax";
//     $data['alert']="alerts/rtv_alert";
//     $this->load->view('layouts/main',$data);
//   }


	public function date_monitoring_ajax_from(){
		$numberofrecords = 10;
		$irene = $this->input->post('fromTo');
		// $irene = "May 2021";
		
		$response = array();
	
		if(!isset($irene)){
			$dates = $this->Monitoring_model->month_and_year();
		}
		else{
			$date_post  = trim(preg_replace('/[0-9]+/', '', $irene));
			if(!empty($date_post)){
				$date_month = date_parse($date_post);
				$the_month = $date_month['month'];
			}
			else{
				$the_month = "";
			}

			$year = (int) filter_var($irene, FILTER_SANITIZE_NUMBER_INT);  
			if(!empty($year)){
				$the_year = $year;
			}
			else{
				$the_year = "";
			}
			$dates = $this->Monitoring_model->month_and_year_search($the_month,$year);
			
		}
			
		foreach($dates as $date){
			
			$response[] = array(
			"id" => $date['month'].' '.$date['year'],
			"text" => $date['month'].' '.$date['year']
			);
		}
		
		echo json_encode($response);
	}

	public function date_monitoring_ajax_to(){
		$numberofrecords = 10;
		$irene = $this->input->post('toFrom');
		// $irene = "May 2021";
		
		$response = array();
	
		if(!isset($irene)){
			$dates = $this->Monitoring_model->month_and_year();
		}
		else{
			$date_post  = trim(preg_replace('/[0-9]+/', '', $irene));
			if(!empty($date_post)){
				$date_month = date_parse($date_post);
				$the_month = $date_month['month'];
			}
			else{
				$the_month = "";
			}

			$year = (int) filter_var($irene, FILTER_SANITIZE_NUMBER_INT);  
			if(!empty($year)){
				$the_year = $year;
			}
			else{
				$the_year = "";
			}
			$dates = $this->Monitoring_model->month_and_year_search($the_month,$year);
			
		}
			
		foreach($dates as $date){
			
			$response[] = array(
			"id" => $date['month'].' '.$date['year'],
			"text" => $date['month'].' '.$date['year']
			);
		}
		
		echo json_encode($response);
	}

	public function find(){
	
		$data['select']="selects/dates";
		$data['alert']="alerts/rtv_alert";
	

		$data['count']=$this->Monitoring_model->num_rows_get_all_users();
		$config['base_url'] = site_url("monitoring/find/");
		$config['total_rows'] = $data['count']->countrows;
		$config['num_links'] = 1;
		$config['full_tag_open'] = '<ul class ="search" id="change1" style=" border:1px solid white; box-sizing: border-box; border-radius:4px; overflow:hidden">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';
		$config['next_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_close'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class=\'active\'><span><b>';
		$config['cur_tag_close'] = '</b></span></li>';
		$config['per_page'] = 10;
		$page = $this->uri->segment(3);

		$data['monitorings']=$this->Monitoring_model->get_all_monitorings($config['per_page'],$page);
		$this->pagination->initialize($config);
		$data['skip']=$this->uri->segment(3);
		// $data['skip2']=site_url("user/find/");
		$data['date_from']="";
		$data['date_to']="";
		$data['pod_date']="";
		$data['get_name']="";
		$data['get_store']="";
		$data['get_store_code']="";
		$data['get_so']="";
		$data['get_sku']="";
		$data['get_migration']="0";
		$data['get_date']="";
		$data['description']="";
		$data['uom']="";
		$data['qty']="";
		$data['amount']="";
		$data['reason']="";
		$data['case']="";
		$data['reference']="";
		$data['qty_received']="";

		$data['skus'] = $this->Monitoring_model->sku_code_counts();
		$data['main_view']="monitorings/find";
		$this->load->view('layouts/main',$data);
	}

	public function search_monitoring(){
		
		$datefrompostquery =($this->input->get("dates_form"))? $this->input->get("dates_form") : "&nbsp;";
		$datetopostquery =($this->input->get("dates_to"))? $this->input->get("dates_to") : "&nbsp;";	
		if($datefrompostquery!='&nbsp;'){
			$d_from = new DateTime( $datefrompostquery );
			$datefrompost = $d_from->format("Y-m-d");
		}else{
			$datefrompost = "1970-01-01";
		}

		if($datetopostquery!='&nbsp;'){
			$d_to = new DateTime( $datetopostquery );
			$datetopost =  $d_to->format("Y-m-d");	
		}
		else{
			$datetopost = "1970-01-01";
		}
        $podpost =($this->input->get("pod_date"))? $this->input->get("pod_date") : "&nbsp;";
		$namepost =($this->input->get("rtv_number"))? $this->input->get("rtv_number") : "&nbsp;";
		$storecodepost =($this->input->get("store_code"))? $this->input->get("store_code") : "&nbsp;";	
		$storepost =($this->input->get("store"))? $this->input->get("store") : "&nbsp;";	
		
		$sku_codepost= ($this->input->get("sku_code"))? $this->input->get("sku_code") : "&nbsp;";
		$get_datepost= ($this->input->get("rtv_date"))? $this->input->get("rtv_date") : "&nbsp;";
		$descriptionpost= ($this->input->get("description"))? $this->input->get("description") : "&nbsp;";
		$uompost= ($this->input->get("uom"))? $this->input->get("uom") : "&nbsp;";

		$qtypost= ($this->input->get("qty"))? $this->input->get("qty") : "&nbsp;";
		$qtyreceivedpost= ($this->input->get("qty_received"))? $this->input->get("qty_received") : "&nbsp;";
		$uompost= ($this->input->get("uom"))? $this->input->get("uom") : "&nbsp;";
		$amountpost= ($this->input->get("amount"))? $this->input->get("amount") : "&nbsp;";
		$reasonpost= ($this->input->get("reason"))? $this->input->get("reason") : "&nbsp;";
		$casepost= ($this->input->get("case"))? $this->input->get("case") : "&nbsp;";
		$referencepost= ($this->input->get("reference"))? $this->input->get("reference") : "&nbsp;";
		$migrationstatuspost = $this->input->get("migration_status");
		
		if($migrationstatuspost !=0){
			$sopost =($this->input->get("so_number"))? $this->input->get("so_number") : "&nbsp;";	
		}else{
			$sopost ="&nbsp;";	
		}

		$array = array(
			'pod_date'=>$podpost,
			'rtv_number' => $namepost,
			'store_code' => $storecodepost,  
			'store' => $storepost, 
			'sales_order'=>$sopost,
			'sku_code' => $sku_codepost,
			'rtv_date'=>$get_datepost,
			'description'=>$descriptionpost,
			'uom'=>$uompost,
			'qty'=>$qtypost,
			'qty_received'=>$qtyreceivedpost,
			'amount'=>$amountpost,
			'reason'=>$reasonpost,
			'case'=>$casepost,
			'reference'=>$referencepost,
			'migration_status'=>$migrationstatuspost,
			'date_from'=>$datefrompost,
			'date_to'=>$datetopost,
		);
		$url = $this->uri->assoc_to_uri($array);

		$pod_date = $array['pod_date'];
		$name = $array['rtv_number'];
		$store_code = $array['store_code'];
		$store = $array['store'];

		$sales_order = $array['sales_order'];
		
		$sku_code =$array['sku_code'];
		$get_date = $array['rtv_date'];
		$description = $array['description'];
		$uom= $array['uom'];

		$qty=$array['qty'];
		$qty_received = $array['qty_received'];
		$amount=$array['amount'];
		$reason=$array['reason'];
		$case=$array['case'];
		$reference=$array['reference'];
		$migration_status=$array['migration_status'];
		
		$name = trim($name);
		$store_code = trim($store_code);
		$store = trim($store);	
		$sales_order = trim($sales_order);
		$sku_code = trim($sku_code);
		$get_date = trim($get_date);
		$description = trim($description);

		$qty=trim($qty);
		$amount=trim($amount);
		$reason=trim($reason);
		$case=trim($case);
		$reference=trim($reference);

		$date_from = trim($array['date_from']);
		$date_to = trim($array['date_to']);
		

		if($pod_date != "" && $name != "" && $store_code !='' && $store !='' && $sku_code!='' && $get_date!='' && $description!='' && $uom !='' && $qty !=''&& $amount !='' && $reason !='' && $case !='' && $reference !='' && $qty_received !='' && $sales_order !='' && $date_from!='' && $date_to!=''){

		$config['reuse_query_string'] = true;
		$data['count']=$this->Monitoring_model->num_rows_search_monitoring($pod_date,$name,$store_code,$store,$sales_order,$sku_code,$get_date,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to);
		$config['base_url'] = site_url("monitoring/search_monitoring/");
		$config['total_rows'] = $data['count']->countrows;
		$config['per_page'] = 10;
		$config['num_links'] = 1;
		$config['full_tag_open'] = '<ul class = "search" id="change1" style="border:1px solid white; box-sizing: border-box; border-radius:4px; overflow:hidden">';
		$config['full_tag_close'] = '</ul>';

		$config['first_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';

		$config['next_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['first_tag_close'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_tag_close'] = '</li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class=\'active\'><span><b>';
		$config['cur_tag_close'] = '</b></span></li>';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['alert']="alerts/rtv_alert";
		$data['select']="selects/dates";
		$data['monitorings']=$this->Monitoring_model->search_monitoring_name($pod_date,$name,$config['per_page'],$page,$store_code,$store,$sales_order,$sku_code,$get_date,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to);
		$data['pod_date']=$this->Monitoring_model->getName($pod_date);
		$data['date_from']=$this->Monitoring_model->getName($date_from);
		$data['date_to']=$this->Monitoring_model->getName($date_to);
		$data['get_name']=$this->Monitoring_model->getName($name);
		$data['get_store_code']=$this->Monitoring_model->getName($store_code);
		$data['get_store']=$this->Monitoring_model->getName($store);
		$data['get_so']=$this->Monitoring_model->getName($sales_order);
		
		$data['get_sku']=$this->Monitoring_model->getName($sku_code);
		$data['get_date']=$this->Monitoring_model->getName($get_date);
		$data['description']=$this->Monitoring_model->getName($description);
		$data['uom']=$this->Monitoring_model->getName($uom);
		
		$data['qty']=$this->Monitoring_model->getName($qty);
		$data['qty_received']=$this->Monitoring_model->getName($qty_received);
		$data['amount']=$this->Monitoring_model->getName($amount);
		$data['reason']=$this->Monitoring_model->getName($reason);
		$data['case']=$this->Monitoring_model->getName($case);
		$data['reference']=$this->Monitoring_model->getName($reference);
		$data['get_migration'] = $migration_status;
		$data['skus'] = $this->Monitoring_model->sku_code_counts();
		$data['skip']=$this->uri->segment(3);
		$data['main_view']="monitorings/find";
		$this->load->view('layouts/main',$data);
		} else{
		$this->find();
		}
	}

	public function search_monitoring_mobile(){
		$datefrompostquery =($this->input->get("dates_form"))? $this->input->get("dates_form") : "&nbsp;";
		$datetopostquery =($this->input->get("dates_to"))? $this->input->get("dates_to") : "&nbsp;";	
		if($datefrompostquery!='&nbsp;'){
			$d_from = new DateTime( $datefrompostquery );
			$datefrompost = $d_from->format("Y-m-d");
		}else{
			$datefrompost = "1970-01-01";
		}

		if($datetopostquery!='&nbsp;'){
			$d_to = new DateTime( $datetopostquery );
			$datetopost =  $d_to->format("Y-m-d");	
		}
		else{
			$datetopost = "1970-01-01";
		}

		$podpost =($this->input->get("pod_date"))? $this->input->get("pod_date") : "&nbsp;";
		$namepost =($this->input->get("rtv_number"))? $this->input->get("rtv_number") : "&nbsp;";
		$storecodepost =($this->input->get("store_code"))? $this->input->get("store_code") : "&nbsp;";	
		$storepost =($this->input->get("store"))? $this->input->get("store") : "&nbsp;";
			
		$sku_codepost= ($this->input->get("sku_code"))? $this->input->get("sku_code") : "&nbsp;";
		$get_datepost= ($this->input->get("rtv_date"))? $this->input->get("rtv_date") : "&nbsp;";
		$descriptionpost= ($this->input->get("description"))? $this->input->get("description") : "&nbsp;";
		$uompost= ($this->input->get("uom"))? $this->input->get("uom") : "&nbsp;";

		$qtypost= ($this->input->get("qty"))? $this->input->get("qty") : "&nbsp;";
		$qtyreceivedpost= ($this->input->get("qty_received"))? $this->input->get("qty_received") : "&nbsp;";
		$amountpost= ($this->input->get("amount"))? $this->input->get("amount") : "&nbsp;";
		$reasonpost= ($this->input->get("reason"))? $this->input->get("reason") : "&nbsp;";
		$casepost= ($this->input->get("case"))? $this->input->get("case") : "&nbsp;";
		$referencepost= ($this->input->get("reference"))? $this->input->get("reference") : "&nbsp;";
		$migrationstatuspost = $this->input->get("migration_status");
		if($migrationstatuspost !=0){
			$sopost =($this->input->get("so_number"))? $this->input->get("so_number") : "&nbsp;";	
		}else{
			$sopost ="&nbsp;";	
		}

		$array = array(
			'pod_date'=>$podpost,
			'rtv_number' => $namepost,
			'store_code' => $storecodepost,  
			'store' => $storepost, 
			'sales_order'=>$sopost,
			'sku_code' => $sku_codepost,
			'rtv_date'=>$get_datepost,
			'description'=>$descriptionpost,
			'uom'=>$uompost,
			'qty'=>$qtypost,
			'qty_received'=>$qtyreceivedpost,
			'amount'=>$amountpost,
			'reason'=>$reasonpost,
			'case'=>$casepost,
			'reference'=>$referencepost,
			'migration_status'=>$migrationstatuspost,
			'date_from'=>$datefrompost,
			'date_to'=>$datetopost,
		
		);
		$url = $this->uri->assoc_to_uri($array);
		$pod_date = $array['pod_date'];
		$name = $array['rtv_number'];
		$store_code = $array['store_code'];
		$store = $array['store'];
		$sales_order = $array['sales_order'];
		$sku_code =$array['sku_code'];
		$get_date = $array['rtv_date'];
		$description = $array['description'];
		$uom= $array['uom'];

		$qty=$array['qty'];
		$qty_received = $array['qty_received'];
		$amount=$array['amount'];
		$reason=$array['reason'];
		$case=$array['case'];
		$reference=$array['reference'];
		$migration_status=$array['migration_status'];
		
		$name = trim($name);
		$store_code = trim($store_code);
		$store = trim($store);
		$sku_code = trim($sku_code);
		$get_date = trim($get_date);
		$description = trim($description);

		$qty=trim($qty);
		$amount=trim($amount);
		$reason=trim($reason);
		$case=trim($case);
		$reference=trim($reference);

		$date_from = trim($array['date_from']);
		$date_to = trim($array['date_to']);
		

		if($pod_date != "" && $name != "" && $store_code !='' && $store !='' && $sku_code!='' && $get_date!='' && $description!='' && $uom !='' && $qty !=''&& $amount !='' && $reason !='' && $case !='' && $reference !='' && $qty_received !='' && $sales_order !=''  && $date_from!='' && $date_to!=''){

		$config['reuse_query_string'] = true;
		$data['count']=$this->Monitoring_model->num_rows_search_monitoring($pod_date,$name,$store_code,$store,$sales_order,$sku_code,$get_date,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to);
		$config['base_url'] = site_url("monitoring/search_monitoring_mobile/");
		$config['total_rows'] = $data['count']->countrows;
		$config['per_page'] = 10;
		$config['num_links'] = 1;
		$config['full_tag_open'] = '<ul class = "search" id="change1" style="border:1px solid white; box-sizing: border-box; border-radius:4px; overflow:hidden">';
		$config['full_tag_close'] = '</ul>';

		$config['first_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';

		$config['next_tag_open'] = '<li>';
		$config['prev_tag_open'] = '<li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['first_tag_close'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_tag_close'] = '</li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class=\'active\'><span><b>';
		$config['cur_tag_close'] = '</b></span></li>';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['alert']="alerts/rtv_alert";
		$data['select']="selects/dates";
		$data['monitorings']=$this->Monitoring_model->search_monitoring_name($pod_date,$name,$config['per_page'],$page,$store_code,$store,$sales_order,$sku_code,$get_date,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to);
		$data['date_from']=$this->Monitoring_model->getName($date_from);
		$data['date_to']=$this->Monitoring_model->getName($date_to);
		$data['pod_date']=$this->Monitoring_model->getName($pod_date);
		$data['get_name']=$this->Monitoring_model->getName($name);
		$data['get_store_code']=$this->Monitoring_model->getName($store_code);
		$data['get_store']=$this->Monitoring_model->getName($store);
		$data['get_so']=$this->Monitoring_model->getName($sales_order);
		$data['get_sku']=$this->Monitoring_model->getName($sku_code);
		$data['get_date']=$this->Monitoring_model->getName($get_date);
		$data['description']=$this->Monitoring_model->getName($description);
		$data['uom']=$this->Monitoring_model->getName($uom);
		
		$data['qty']=$this->Monitoring_model->getName($qty);
		$data['qty_received']=$this->Monitoring_model->getName($qty_received);
		$data['amount']=$this->Monitoring_model->getName($amount);
		$data['reason']=$this->Monitoring_model->getName($reason);
		$data['case']=$this->Monitoring_model->getName($case);
		$data['reference']=$this->Monitoring_model->getName($reference);
		$data['get_migration'] = $migration_status;
		$data['skus'] = $this->Monitoring_model->sku_code_counts();

		$data['skip']=$this->uri->segment(3);
		$data['main_view']="monitorings/find";
		$this->load->view('layouts/main',$data);
		} else{
		$this->find();
		}
	}

	public function upload(){
		if($this->session->userdata('excel_upload_status')!='1'){
			$this->session->set_flashdata('You Have No Access To This Content','You Have No Access To This Content');
			redirect('monitoring/find');
		}
		$file_mimes = array('text/x-comma-separated-values','image/jpeg','image/png', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['upload_file']['name']);
			$extension = end($arr_file);

		if(empty($extension)){
			$this->session->set_flashdata('No File Uploaded','No File Uploaded');
			redirect('monitoring/find');
		}
		if('csv' == $extension){
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		}
		elseif('xlsx' == $extension) {
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		elseif('xls' == $extension){
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		}
		elseif('xls' != $extension || 'xlsx' != $extension || 'csv' != $extension ){
		$this->session->set_flashdata('Invalid File Extension','Invalid File Extension');
		redirect('monitoring/find');
		}

		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetDatas = $spreadsheet->getActiveSheet()->toArray();
			$B1 = $spreadsheet->getActiveSheet()->getCell('B1')->getValue();
			$C1 = $spreadsheet->getActiveSheet()->getCell('C1')->getValue();
			$K1 = $spreadsheet->getActiveSheet()->getCell('K1')->getValue();
			if(trim($B1) !='RTV No.'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/find');
			}

			if(trim($C1) !='Store'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/find');
			}

			if(trim($K1) !='Reference No.'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/find');
			}

			array_shift($sheetDatas);
			foreach($sheetDatas as $sheetData){
						$rtv_date_change = $sheetData[0];
						
						$date_query = new DateTime( $rtv_date_change );
					
						$newDate = $date_query->format("Y-m-d");
						$rtv_number = $sheetData[1];
						//Separate Store Code and Store Description
						$store = $sheetData[2];
						$store_array = explode("_", $store);
						
						//End Separate Store Code and Store Description
						$sku_code = $sheetData[3];
						$description = $sheetData[4];
						$uom = $sheetData[5];
						$qty = $sheetData[6];

						$searchForValueQty = ',';
						$stringValueQty = $sheetData[6];
						if( strpos($stringValueQty, $searchForValueQty) !== false ) {
							$qty = str_replace(',', '', $stringValueQty);
						}else{
							$qty = $sheetData[6];	
						}
						// $amount = $sheetData[7];
						$searchForValue = ',';
						$stringValue = $sheetData[7];
						if( strpos($stringValue, $searchForValue) !== false ) {
							$amount = str_replace(',', '', $stringValue);
						}else{
							$amount = $sheetData[7];	
						}

						$reason = $sheetData[8];
						$case = $sheetData[9];
						$reference = $sheetData[10];
						if(empty($reference)){
							$reference_post="";
						}else{
							$reference_post=$reference;
						}
						
						if($store_array['1']==''){
							$this->session->set_flashdata('There is No Store Code','There is No Store Code');
							redirect('monitoring/find');
						}

						if($rtv_number!=""){
							$data = array(
							'rtv_date'=>$newDate,
							'rtv_number'=>$rtv_number,
							'store_code'=>$store_array['0'],
							'store_description'=>$store_array['1'],
							'sku_code'=>$sku_code,
							'description'=>$description,
							'uom'=>$uom,
							'qty'=>$qty,
							'amount'=>$amount,
							'reason'=>$reason,
							'case_reference'=>$case,
							'reference_number'=>$reference_post,
							'received_status'=>'0',
							'migration_status'=>'0',
							'pre_migrate_status'=>'0',
							'total_qty_received'=>'0',
							'recon_status'=>'0'									
						);
						//Use For Checking
						// echo '<pre>';
						// print_r($data);
						$this->Monitoring_model->insert($data);
						}

		}
		$this->session->set_flashdata('File Successfully Uploaded','File Successfully Uploaded');
		redirect('monitoring/find');

		}
			else{
				$this->session->set_flashdata('No File Uploaded','No File Uploaded');
				redirect('monitoring/find');
			}
	}

	public function receive($id,$segment){
		$data['receives'] = $this->Monitoring_model->rtv_receives($id);
		$data['rtv'] = $this->Monitoring_model->rtv_row($id);
		
		$data['main_view']="monitorings/details";
		$data['ajax_view']="ajax/detail_ajax";
		$data['alert']="alerts/rtv_alert";
		$this->load->view('layouts/main',$data);
	}

	public function ajax_row($sku_code,$lot){
        
        $lot = $this->Migration_model->selectLotDetailBySkuCode($sku_code,$lot);
        $row= array();
        if(empty($lot)){
            $row= array(
                "id" => "NONE",
                "text" => "NONE"
             );
        }
        else{
            
            $row= array(
                "id" => $lot->Lot,
                "text" => $lot->Lot
             );
        }
        
        
        echo json_encode($row);
    }

	public function detail(){
		//Date and Time Today
   		date_default_timezone_set('Asia/Manila');
		$datetoday = date('Y-m-d H:i:s');
		$received_date = date('Y-m-d');
		$monitoring_id = $this->input->post('monitoring_id');
		$qty_check = $this->input->post('qty_to_check');
		//For Create
		$quantity = $this->input->post('qty');
		$lot = $this->input->post('lot');
		
		//Sku Code Query
		$rtv_row = $this->Monitoring_model->check_sku_code($monitoring_id);
		$sku_code = $rtv_row->sku_code;

		//Segment Value
		$segmentvalue = $this->input->post('segment');
		$segmenttotal = $segmentvalue - 1; 
		
		//Quantity Check
		$qty_main = $rtv_row->qty; 
		$qty_update = $this->input->post('editqty');
		if(empty($quantity)){
			$qty_detail_total = array_sum($qty_update);
		}

		if(empty($qty_update)){
			$qty_detail_total = array_sum($quantity);
		}

		if(!empty($quantity)&&!empty($qty_update)){
			$qty_detail_total = array_sum($quantity) + array_sum($qty_update);
		}
		
		if(!empty($lot)){
			$lot_remove_blank=array_values(array_diff($lot,array("null","")));
			if(!empty($quantity)){
			$quantity_remove_blank=array_values(array_diff($quantity,array("null","")));
			}
			$createcounts = count($lot_remove_blank);
		}
		else{
				$lot_remove_blank ="";
		}
	

		if(!empty($lot_remove_blank)){
			for($check= 0; $check < $createcounts; $check++){
				//Check Lot
				$lot_detail_check = trim(strtoupper($lot_remove_blank[$check]));
				$lot = $this->Migration_model->selectLotDetailBySkuCode($sku_code,$lot_detail_check);
				if(empty($lot)){
					$this->session->set_flashdata('Lot Does Not Exist','Lot '.$lot_detail_check.' Does Not Exist');
					redirect('monitoring/receive/'.$monitoring_id.'/'.$segmenttotal);
				}
			}

			for($create = 0; $create < $createcounts; $create++){
				//Create Detail
				$data = array(
					'detail_date'=>$datetoday,
					'detail_qty'=>$quantity_remove_blank[$create],
					'detail_lot'=>$lot_remove_blank[$create],
					'monitoring_id' =>$monitoring_id
				);
				$total_qty_create_post[]=$quantity_remove_blank[$create];
				$this->Monitoring_model->receive($data);
			}
		}

		//For Update
		$editlot = $this->input->post('editlot');
		$editqty = $this->input->post('editqty');
		$editid = $this->input->post('editid');

		if(!empty($editlot)){
			$updatecounts = count($editlot);
			for($update = 0; $update < $updatecounts; $update++){
				if(trim($editlot[$update])!=''){
					$data_update = array(
						'detail_date'=>$datetoday,
						'detail_qty'=>$editqty[$update],
						'detail_lot'=>$editlot[$update]
					);
					$total_edit_qty_post[]= $editqty[$update];
					$this->Monitoring_model->update($editid[$update],$data_update);
				}
				else{
					//Delete If You Type Empty Lot
					$this->Monitoring_model->delete($editid[$update]);
				}
			}
		}

		if(empty($total_edit_qty_post)){
			$total_qty_received= array_sum($total_qty_create_post) ;
		}

		if(empty($total_qty_create_post)){
			$total_qty_received= array_sum($total_edit_qty_post) ;
		}

		if(!empty($total_edit_qty_post)&&!empty($total_qty_create_post)){
			$total_qty_received= array_sum($total_edit_qty_post) + array_sum($total_qty_create_post) ;
		}

		
		$rtv_row = $this->Monitoring_model->check_store_code($monitoring_id);
		$rtv_number = $rtv_row ->rtv_number;
		$check_pod_date= $rtv_row ->pod_date;
		
		// $check_count_with_status = $this->Monitoring_model->check_store_code_received_status($store_code);
		// $check_count_store_code = $this->Monitoring_model->check_store_code_count($rtv_number);
		// echo $check_count_with_status.'<br>';
		// echo $check_count_store_code;
		
		// if($check_count_store_code=='0'){
			// Update Receive Status By id
		// }
		if($total_qty_received == $qty_check){
			$recon_status = '1';
		}else{
			$recon_status = '0';
		}
		//Update total qty
		$data_received_total_qty = array('total_qty_received'=>$total_qty_received,'recon_status'=>$recon_status);
		if($data_received_total_qty ){
			$this->Monitoring_model->update_all_status($monitoring_id,$data_received_total_qty);
		}
		

		if($check_pod_date==NULL){
			$data_received_all_by_store_code = array('received_status'=>'1','pod_date'=>$received_date);
			if($data_received_all_by_store_code ){
				$this->Monitoring_model->update_all_status($monitoring_id,$data_received_all_by_store_code);
			}
		}

		$this->session->set_flashdata('Item Received','Item Received');
		echo '<script type="text/javascript">
		window.history.go(-2);
		</script>';

	}

	public function delete($monitoring_id){
		$row = $this->Monitoring_model->check_migration_status($monitoring_id);

		if($row->migration_status=='0'){
			$this->Monitoring_model->delete_monitorings($monitoring_id);
			$this->Monitoring_model->delete_monitoring_details($monitoring_id);
			$this->session->set_flashdata('RTV Detail Successfully Deleted','RTV Detail Successfully Deleted');
			redirect('monitoring/find');
		}else{
			$this->session->set_flashdata('RTV Already Migrated','RTV Already Migrated');
			redirect('monitoring/find');
		}
	}

	public function export(){
		$date_from = $this->input->post('dates_form_export');
		$date_to = $this->input->post('dates_to_export');
		$migration_status = $this->input->post('migration_status_export');
		$pod_date = $this->input->post('pod_export');
		$name = $this->input->post('rtv_number_export');
		$store_code = $this->input->post('store_code_export');
		$store = $this->input->post('store_export');
		$sales_order = $this->input->post('so_number_export');
		$sku_code = $this->input->post('sku_code_export');
		$description = $this->input->post('description_export');
		$uom = $this->input->post('uom_export');
		$qty = $this->input->post('qty_export');
		$qty_received = $this->input->post('qty_received_export');
		$amount = $this->input->post('amount_export');
		$reason = $this->input->post('reason_export');
		$case = $this->input->post('case_export');
		$reference = $this->input->post('reference_export');
		$data['monitorings']=$this->Monitoring_model->get_all_monitorings_no_limit($pod_date,$name,$store_code,$store,$sales_order,$sku_code,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to);
		$this->load->view('layouts/export',$data);
	
	}

	public function download(){
		$this->load->view('alerts/success');	
	}

	public function recon(){
		$data['alert']="alerts/rtv_alert";
		$data['main_view']="monitorings/recon";
		$this->load->view('layouts/main',$data);
	}
	
	public function upload_recon(){
		$file_mimes = array('text/x-comma-separated-values','image/jpeg','image/png', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['upload_file']['name']);
			$extension = end($arr_file);

		if(empty($extension)){
			$this->session->set_flashdata('No File Uploaded','No File Uploaded');
			redirect('monitoring/recon');
		}
		if('csv' == $extension){
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		}
		elseif('xlsx' == $extension) {
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		elseif('xls' == $extension){
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		}
		elseif('xls' != $extension || 'xlsx' != $extension || 'csv' != $extension ){
		$this->session->set_flashdata('Invalid File Extension','Invalid File Extension');
		redirect('monitoring/recon');
		}

		$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
		$sheetDatas = $spreadsheet->getActiveSheet()->toArray();
			$A1 = $spreadsheet->getActiveSheet()->getCell('A1')->getValue();
			$D1 = $spreadsheet->getActiveSheet()->getCell('D1')->getValue();
			$F1 = $spreadsheet->getActiveSheet()->getCell('F1')->getValue();
			$O1 = $spreadsheet->getActiveSheet()->getCell('O1')->getValue();
			if(trim($A1) !='RTV Date'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/recon');
			}

			if(trim($D1) !='Code'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/recon');
			}

			if(trim($F1) !='SO Number'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/recon');
			}

			if(trim($O1) !='Reference No.'){
				$this->session->set_flashdata('Uploading Wrong Format','Uploading Wrong Format');
				redirect('monitoring/recon');
			}

			array_shift($sheetDatas);
			// $row = 1;
			foreach($sheetDatas as $sheetData){
				$rtv_date_change = $sheetData[0];
				$date_query_rtv = new DateTime( $rtv_date_change );
				$rtv_date = $date_query_rtv->format("Y-m-d");
				
				$rtv_pod_date_change = $sheetData[1];
				$date_query_rtv_pod = new DateTime( $rtv_pod_date_change  );
				$rtv_pod_date = $date_query_rtv_pod->format("Y-m-d");
				

				$rtv_number = $sheetData[2];
				//Separate Store Code and Store Description
				$store_code = $sheetData[3];
				$store_description = $sheetData[4];
				//End Separate Store Code and Store Description
				$sales_order = $sheetData[5];
				$sku_code = $sheetData[6];
				$description = $sheetData[7];
				$uom = $sheetData[8];
				if($sheetData[9] == '-'){
					$qty = 0;
				}
				else{
					$qty = $sheetData[9];
				}
				if($sheetData[10] == '-'){
					$qty_rcv = 0;
				}
				else{
					if(trim($sheetData[10])=='(1)'){
						$qty_rcv ='1';
					}else{
						$qty_rcv = $sheetData[10];
					}
					
				}
				if($sheetData[11] == '-'){
					$amount = 0;
				}else{
					$searchForValue = ',';
					$stringValue = $sheetData[11];

					if( strpos($stringValue, $searchForValue) !== false ) {
						$amount = str_replace(',', '', $stringValue);
					}else{
						$amount = $sheetData[11];	
					}
				}
			
				$reason = $sheetData[12];
				if($sheetData[13] == '-'){
					$case = 0;
				}
				else{
					$case = $sheetData[13];
				}
				
				$reference = $sheetData[14];
				if(empty($reference)){
					$reference_post="";
				}else{
					$reference_post=$reference;
				}
				
				if($rtv_number!=""){
					$data = array(
					'rtv_date'=>$rtv_date,
					'pod_date'=>$rtv_pod_date,
					'rtv_number'=>$rtv_number,
					'store_code'=>$store_code,
					'store_description'=>$store_description,
					'sales_order'=>$sales_order,
					'sku_code'=>$sku_code,
					'description'=>$description,
					'uom'=>$uom,
					'qty'=>$qty,
					'total_qty_received'=>$qty_rcv,
					'amount'=>$amount,
					'reason'=>$reason,
					'case_reference'=>$case,
					'reference_number'=>$reference_post,
					'received_status'=>'1',
					'migration_status'=>'1',
					'pre_migrate_status'=>'1',
					'recon_status'=>'0'									
				);
				//Use For Checking
				// echo '<pre>';
				
				// print_r($data);
				// echo $row++;
				$this->Monitoring_model->insert($data);
				}

			}
			$this->session->set_flashdata('File Successfully Uploaded','File Successfully Uploaded');
			redirect('monitoring/recon');

			}
			else{
				$this->session->set_flashdata('No File Uploaded','No File Uploaded');
				redirect('monitoring/recon');
			}
	}

}
?>
