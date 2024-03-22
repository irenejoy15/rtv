<?php
class Dashboard extends CI_Controller {
    public function __construct(){
  		parent::__construct();

  		if(!$this->session->userdata('logged_in_rtv')){
  			$this->session->set_flashdata('You Have No Access','Please Contact The IT Department');
  			redirect('loginuser');
  		}
  	}

    public function index(){
    	$data['main_view']="dashboard/index";
		$data['alert']="alerts/dashboard_alert";
    	date_default_timezone_set('Asia/Manila');
		$year = date('Y');

		//Received
		$months = $this->Dashboard_model->receive_by_year($year);
		if(!empty($months)){
			foreach($months as $month){	
			$monthName = date('F', mktime(0, 0, 0, $month->date_monthly, 10));
			$month_name_array[] = "'".$monthName."'";
			$month_count_array[] = "'".$month->count_monthly."'";
			}
			$month_name_separated = implode(",", $month_name_array);
			$month_count_separated = implode(",",$month_count_array);
		}else{
			$month_name_separated = "";
			$month_count_separated = "";
		}
	
		
		$data['labels'] = $month_name_separated;
		$data['results'] = $month_count_separated;
		
		// $data['jan_r'] = $this->Dashboard_model->jan_receive($year);
		// $data['feb_r'] = $this->Dashboard_model->feb_receive($year);
		// $data['mar_r'] = $this->Dashboard_model->mar_receive($year);
		// $data['apr_r'] = $this->Dashboard_model->apr_receive($year);
		// $data['may_r'] = $this->Dashboard_model->may_receive($year);
		// $data['jun_r'] = $this->Dashboard_model->jun_receive($year);
		// $data['july_r'] = $this->Dashboard_model->july_receive($year);
		// $data['aug_r'] = $this->Dashboard_model->aug_receive($year);
		// $data['sept_r'] = $this->Dashboard_model->sept_receive($year);
		// $data['oct_r'] = $this->Dashboard_model->oct_receive($year);
		// $data['nov_r'] = $this->Dashboard_model->nov_receive($year);
		// $data['dec_r'] = $this->Dashboard_model->dec_receive($year);

		$data['year'] = $year;

		$data['main_view']="dashboard/index";
		$data['chart']="charts/dashboard";
    	$this->load->view('layouts/main',$data);
    }


	public function drilldown(){
		
		$data['main_view']="dashboard/index";
		date_default_timezone_set('Asia/Manila');
		$year = date('Y');

		//Received
		
		$data['rtvs'] = $this->Dashboard_model->drilldown_rtvs();
		$data['main_view']="dashboard/drilldown";
		$data['chart']="charts/drilldown";
		$this->load->view('layouts/main',$data);
	}

	public function drilldown_ajax(){
		$checks = $this->input->post('checks');

		 //Datatables Variables
        // echo '<pre>';
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$data = array();

        $rtvs = $this->Dashboard_model->drilldown_table($checks);
        //print_r($rtvs);
        $rtvs_count = count($rtvs);
        foreach($rtvs as $row){
            

            $data[] = array(
                $row->rtv_number,
				$row->total
             );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $rtvs_count ,
            "recordsFiltered" => $rtvs_count ,
            "data" => $data
        );
        echo json_encode($output);
        exit();
	}

	public function drilldown_ajax_chart(){
		

		$checks = $this->input->post('checks');

        $rtvs = $this->Dashboard_model->drilldown_table($checks);
        print_r($rtvs);
      
        foreach($rtvs as $row){
            $data = array(
                'rtv_number'=>$row->rtv_number,
				'qty'=>$row->total
             );
        }

		echo json_encode($data);

	}

	public function drilldown_ajax_chart2(){
		$checks = $this->input->post('checks');

        $rtvs = $this->Dashboard_model->drilldown_table($checks);
        //print_r($rtvs);
      
        foreach($rtvs as $rtv){
            $rtv_number[] = $rtv->rtv_number;
			$qty[]=$rtv->total;
        }
		$convertRtv = implode(",", $rtv_number);
		$convertqty= implode(",", $qty);
		
		$bar_graph = '
			<canvas id="graph" data-settings=
			\'{
				"type": "bar",
				"data":
					{
						"labels": ['.$convertRtv .'],
						"datasets": 
						[{
							"label": "irene",
							"backgroundColor": "#000000",
							"borderColor": "#000000",
							"data":['.$convertqty.']
						}]
					},
					"options":{
						"legend":
						{
							"display": true
						}
					}
			}\'
			></canvas>';

			echo $bar_graph;
	}
	

	
}
?>
