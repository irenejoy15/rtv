<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
ini_set('sqlsrv.ClientBufferMaxKBSize','1000000'); // Setting to 512M
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','1000000');

class Migration extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in_rtv')){
			$this->session->set_flashdata('You Have No Access','Please Contact The IT Department');
			redirect('loginuser');
		}

        if($this->session->userdata('migration_upload_status')!='1'){
			$this->session->set_flashdata('You Have No Access To This Content','You Have No Access To This Content');
			redirect('dashboard');
		}
	}

    public function index(){
        $data['main_view']="migrations/ajax";
        $data['select']="selects/store_code";
        $data['ajax_view']="ajax/migration_ajax";
        $data['alert']="alerts/migration_alert";
        $this->load->view('layouts/main',$data);
    }

    public function store_code_ajax(){
        $numberofrecords = 10;
        $irene = $this->input->post('searchTerm');
        
        $response = array();
      
        if(!isset($irene)){
            $store_codes = $this->Migration_model->migration_store_code();
             
        }
        else{
            $store_codes = $this->Migration_model->migration_store_code_search($irene);
            
        }

        foreach($store_codes as $store_code){
            $response[] = array(
               "id" => $store_code->store_code,
               "text" => $store_code->store_code
            );
         }
        
        echo json_encode($response);
    }

    public function store_description_ajax(){
        $numberofrecords = 10;
        $irene = $this->input->post('searchTerm');
        
        $response = array();
      
        if(!isset($irene)){
            $store_descriptions = $this->Migration_model->migration_store_description_ajax();
             
        }
        else{
            $store_descriptions = $this->Migration_model->migration_store_description_ajax_search($irene);
            
        }

        foreach($store_descriptions as $store_description){
            $response[] = array(
               "id" => $store_description->store_description,
               "text" => $store_description->store_description
            );
         }
        
        echo json_encode($response);
    }

    public function address_ajax($store_code){
        $datas = array();
        $address = $this->Migration_model->selectArMultAddress($store_code);
        array_push($datas, $address->ShipToAddr1, $address->ShipToAddr2, $address->ShipToAddr3, $address->ShipToAddr4);
        $count = 1;
        $response1 = '<div class="col-md-6"><span class="span_address">SHIP ADDRESS 1:</span> '.$address->ShipToAddr1.'</div>';
        $response2 = '<div class="col-md-6"><span class="span_address">TIN:</span> '.$address->ShipToAddr3.'</div>';
        $response3 = '<div class="col-md-6"><span class="span_address">SHIP ADDRESS 2:</span> '.$address->ShipToAddr2.'</div>';
        $response4 = '<div class="col-md-6"><span class="span_address">DEPOT:</span> '.$address->ShipToAddr4.'</div>';
        echo $response1;
        echo $response2;
        echo $response3;
        echo $response4;
      
    }
    public function store_description_ajax_now($store_code){
        $store = $this->Migration_model->get_store_description($store_code);
        $response = '<h4 style="font-weight:bold; pt-1">'.$store->ShipToName.'</h4>';
        echo $response;
    }
        

    public function migration_ajax(){
		
        $start = $this->input->post('start');
		$strlen = strlen($_POST['search']['value']);
		
        
        $migrations = $this->Migration_model->get_datatables();
        // echo '<pre>';
		// print_r($migrations);
        $data = array();
        
		foreach($migrations as $row) {   
            
            $store_code = $row->store_code;
            $count = $this->Migration_model->migration_count($store_code);  
            $rtv = $this->Migration_model->get_rtvs($store_code);
			$data[] = array(
                 '<p class="rtv_mobile text-center" style="font-size:20px; font-weight:bold;">MIGRATION DETAIL</p><hr class="rtv_mobile"><span class="rtv_mobile" style="font-weight:bold;">STORE CODE: </span>'.$row->store_code,
				 '<span class="rtv_mobile" style="font-weight:bold;">STORE DESCRIPTION: </span>'.$row->store_description,
                 '<span class="rtv_mobile" style="font-weight:bold;">RTV COUNT: </span>'.$count,	
                 '<span class="rtv_mobile" style="font-weight:bold;">RTV #: </span>'.$row->rtv_number,			
				 '<span class="rtv_mobile" style="font-weight:bold;">ACTION: </span> <a onClick="javascript:confirmationDelete($(this));return false;" href="'.base_url().'index.php/migration/post/'.$row->store_code.'"><button class="btn btn-success btn-block">POST</button></a>'
			 );			
		}

		//<a onClick="javascript:confirmationDelete($(this));return false;" href="'.base_url().'index.php/user/delete/'.$row->user_uuid.'"><span style="color:red;" class="fas fa-eraser"></span></a>
		
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Migration_model->count_all(),
            "recordsFiltered" => $this->Migration_model->count_filtered(),
            "data" => $data,
        );
        
    
		echo json_encode($output);
		exit();
 
	 }


    public function find(){
        $config['base_url'] = site_url("migration/find/");
        $config['total_rows'] = $this->Migration_model->num_rows_get_all_monitoring_value_zero();
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
        $config['per_page'] = 1;
        $page = $this->uri->segment(3);

        $data['migrations']=$this->Migration_model->all_migration($config['per_page'],$page);
        $this->pagination->initialize($config);
        $data['skip']=$this->uri->segment(3);
       
        $data['get_store']="";
        $data['get_store_code']="";
        
        $data['main_view']="migrations/index";
        $this->load->view('layouts/main',$data);
        
    }

    public function rtvs_ajax($store_code){
        //Datatables Variables
        // echo '<pre>';
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$data = array();

        $rtvs = $this->Migration_model->migration_store_code_and_store_description($store_code);
        //print_r($rtvs);
        $rtvs_count = count($rtvs);
        foreach($rtvs as $row){
            
            //$rtv_rows = $this->Migration_model->get_description_and_qty($row->rtv_number);
            $rtv_rows = $this->Migration_model->combine_detail_qty($row->rtv_number); 
            $data[] = array(
                '<p class="rtv_mobile text-center" style="font-size:20px; font-weight:bold;">MIGRATION DETAIL</p><hr class="rtv_mobile"><span class="rtv_mobile" style="font-weight:bold;">ACCEPT: </span>
                <input type="hidden" form="post" name="check[]" value="0" ><input type="checkbox" form="post" id="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">',
                '<span class="rtv_mobile" style="font-weight:bold;">RTV DATE</span>'.$row->rtv_date,
                '<span class="rtv_mobile" style="font-weight:bold;"><input type="hidden" form="post" name="rtv_number[]" value="'.$row->rtv_number.'" >RTV NUMBERS</span>'.$row->rtv_number,
                '<span class="rtv_mobile" style="font-weight:bold;">SKU CODES</span>'.$rtv_rows['sku_code'],
                '<span class="rtv_mobile" style="font-weight:bold;">DESCRIPTIONS</span>'.$rtv_rows['description'],
                '<span class="rtv_mobile" style="font-weight:bold;">QUANTITIES</span>'.$rtv_rows['qty'],
                '<span class="rtv_mobile" style="font-weight:bold;">RECEIVE QUANTITIES</span>'.$rtv_rows['receive_qty'],
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

    public function migrate(){
        $rtv_number_post = $this->input->post('rtv_number');
        $check_post = $this->input->post('check');
        $store_code = $this->input->post('store_code');
        $checkcounts = count($rtv_number_post);
        // echo '<pre>';
        $rtv_numbers = 0;
        for($check_count = 0; $check_count < $checkcounts; $check_count++){
            if($check_post[$check_count]){
                $rtv_numbers++;
            }
        }   
        
        if($rtv_numbers>8){
            $this->session->set_flashdata('The Rtv Numbers must be below 9','The Rtv Numbers must be below 9');
            redirect('migration');
        }
        // for($check_rtv = 0; $check_rtv < $checkcounts; $check_rtv++){
        //     if($check_post[$check_rtv]){
        //         $check_migration = $this->Migration_model->check_migration_status($rtv_number_post[$check_rtv]);
        //         if(!empty($check_migration)){
        //             $this->session->set_flashdata('The Rtv Numbers were already migrated','The Rtv Numbers were already migrated');
        //             redirect('migration');
        //         }
        //     }
        // }
        if(!in_array("1", $check_post)){
            $this->session->set_flashdata('Migration is Empty','Migration is Empty');
            redirect('migration');
        }
       
        for($check = 0; $check < $checkcounts; $check++){
            if($check_post[$check]){
              $update_pre_migration = array('pre_migrate_status'=>'1');
              if($update_pre_migration ){
                $this->Migration_model->update_monitorings_pre_migration($rtv_number_post[$check],$update_pre_migration);
              }
              
            }
        }   
        $SorControl = $this->Migration_model->selectSorControl();

        //Sales Order
        $NextCreditMemo = $SorControl->NextCreditMemo;
        $salesOrder = str_pad($NextCreditMemo, 15, '0', STR_PAD_LEFT);
        
        //Update of Migration Status
        $migration_posts = $this->Migration_model->migration_store_codes($store_code);
        foreach($migration_posts as $migration_post){
            $monitoring_id_sales = $migration_post->id;
            $data_sales_order = array(
                'sales_order'=>$salesOrder
            );
           $this->Migration_model->update_migration($monitoring_id_sales,$data_sales_order);
        }

         //SorControl Update Itaas Mo Ito
         $NextCreditMemo_Increment = $SorControl->NextCreditMemo + 1;
         $data_SorControl = array('NextCreditMemo'=>$NextCreditMemo_Increment);
         
         if($data_SorControl){
            $this->Migration_model->updateSorControl($data_SorControl);
         }
        //  print_r($data_SorControl);

      
        $ArMultAddr = $this->Migration_model->selectArMultAddress($store_code);
       
        $Shipaddress1 = $ArMultAddr->ShipToAddr1;
        $Shipaddress2 = $ArMultAddr->ShipToAddr2;
        $Shipaddress3 = $ArMultAddr->ShipToAddr3;
        $Shipaddress4 = $ArMultAddr->ShipToAddr4;

        // echo "<br>ADDRESS<br>";
        // print_r($ArMultAddr);

        //MultiRtvNumber
        $rtv_numbers = $this->Migration_model->migration_distinct($store_code,$salesOrder);
        foreach($rtv_numbers as $rtv_number){
            $rtv_post = $rtv_number->rtv_number;
            $length[] = strlen($rtv_post) +1;
            $sum = array_sum($length);
            if($sum <= 30){
                $rtv_number_less_30[] = $rtv_number->rtv_number;
               
            }else{
                $rtv_number_above_30[] = $rtv_number->rtv_number;    
               
            }
        }
        if(!empty($rtv_number_less_30)){
            // print_r($rtv_number_less_30);
            $less_30_separated = implode("/", $rtv_number_less_30);
        
        }else{
            $less_30_separated  = '';
        }

        if(!empty($rtv_number_above_30)){
            //print_r($rtv_number_above_30);
            $above_30_separated = implode("/", $rtv_number_above_30);
        }else{
            $above_30_separated = '';
        }

        //Distinct Sku Code and Quantity
        $sku_codes = $this->Migration_model->migration_distinct_sku_code($store_code,$salesOrder);
        $NextDetailLine = count($sku_codes) + 1;

        //Company Tax
        $CompanyTaxNo = '201-277-095-000';
        //Store Code
        $multiShipCode = $store_code;
        //Store Description
        $store_name = $this->Migration_model->migration_store_description($store_code,$salesOrder);
        $CustomerName = $store_name->store_description;
        $rtv_date = $store_name->rtv_date;
        
        $date_query = new DateTime( $rtv_date );
			
        $dateconvert = $date_query->format("Y-m-d");

        //Capture HH and MM
        date_default_timezone_set('Asia/Manila');
		$datetoday = date('Y-m-d H:i:s');
        $datetoday_ver_2 = date('Y-m-d');
        $timeconvert= date('His');
        $timetoday = $timeconvert.'01'; 
        
        $hour_today = date('H');
        $minutes_today = date('i');
       
   
          //Insert Of SorMaster
          $data_SorMaster = array(
            'SalesOrder'=>$salesOrder,
            'NextDetailLine ' =>$NextDetailLine,
            'OrderStatus'=>'8',
            'ActiveFlag' =>'',
            'CancelledFlag' =>'',
            'DocumentType '=>'C',
            'Customer '=>'CR00003',
            'Salesperson' =>'G01',
            'CustomerPoNumber'=> $less_30_separated,
            'OrderDate'=>$dateconvert ,
            'EntrySystemDate'=>$datetoday_ver_2,
            'ReqShipDate'=>$dateconvert ,
            'DateLastDocPrt'=>NULL,
            'ShippingInstrs'=>$above_30_separated,
            'ShippingInstrsCod'=>'',
            'AltShipAddrFlag'=>'Y',
            'InvoiceCount'=> '0',
            'InvTermsOverride' =>'04',
            'CreditAuthority'=>'',
            'Branch' =>'50',
            'SpecialInstrs'=>'',
            'EntInvoice'=>'',
            'EntInvoiceDate'=>NULL,
            'DiscPct1'=>'0.00',
            'DiscPct2'=>'0.00',
            'DiscPct3'=>'0.00',
            'OrderType'=>'',
            'TaxExemptNumber'=>'',
            'TaxExemptFlag'=>'N',
	        'Area'=>'04',
	        'TaxExemptOverride'=> 'N',
	        'CashCredit'=> 'CR',
            'Warehouse'=>'',
            'LastInvoice'=>'',
            'ScheduledOrdFlag'=>'',
            'GstExemptFlag'=>'E',
            'GstExemptNum'=>'',
            'GstExemptORide' =>'E',
            'IbtFlag'=>'',
            'OrdAcknwPrinted'=>'',
            'DetCustMvmtReqd' => 'N',
	        'DocumentFormat' =>'0',
	        'FixExchangeRate'=>'N',
	        'ExchangeRate'=> '1',
	        'MulDiv'=>'M',
            'Currency' =>'PHP',
	        'GstDeduction'=>'I',
	        'OrderStatusFail' => '8',
            'ConsolidatedOrder'=>'',
            'CreditedInvDate'=>NULL,
            'Job'=>'',
            'SerialisedFlag'=>'',
            'CounterSalesFlag'=>'',
            'Nationality'=>'',
            'DeliveryTerms'=>'',
            'TransactionNature'=>'0',
            'TransportMode'=>'0',
            'ProcessFlag'=>'0',
            'JobsExistFlag'=>'',
            'AlternateKey'=>'',
	        'LastOperator'=> 'WIL',
            'HierarchyFlag'=>'',
            'DepositFlag'=>'',
            'EdiSource'=>'',
            'DeliveryNote'=>'',
            'Operator'=>'',
	        'LineComp'=> 'Y',
            'CaptureHh' =>$hour_today,
	        'CaptureMm' =>$minutes_today,
            'LastDelNote'=>NULL,
            'TimeDelPrtedHh'=>'0',
            'TimeDelPrtedMm'=>'0',
            'TimeInvPrtedHh'=>'0',
            'TimeInvPrtedMm'=>'0',
            'DateLastInvPrt'=>NULL,
            'Salesperson2'=>'',
            'Salesperson3'=>'',
            'Salesperson4'=>'',
            'CommissionSales1'=>'0.00',
            'CommissionSales2'=>'0.00',
            'CommissionSales3'=>'0.00',
            'CommissionSales4'=>'0.00',
            'TimeTakenToAdd'=>'0',
            'TimeTakenToChg'=>'0',
	        'FaxInvInBatch' =>'N',
            'InterWhSale'=>'',
            'SourceWarehouse'=>'',
            'TargetWarehouse'=>'',
            'DispatchesMade'=>'',
            'LiveDispExist'=>'',
	        'NumDispatches' =>'0',
            'CustomerName' => $CustomerName,
            'ShipAddress1' =>$Shipaddress1,
            'ShipAddress2' =>$Shipaddress2,
            'ShipAddress3' =>$Shipaddress3,
            'ShipAddress3Loc'=>'',
            'ShipAddress4' =>$Shipaddress4,
            'ShipAddress5' =>'',
            'ShipPostalCode' =>'',
            'ShipToGpsLat' =>'0.000000',
            'ShipToGpsLong' =>'0.000000',
            'State'=>'',
            'CountyZip'=>'',
            'ExtendedTaxCode'=>'',
            'MultiShipCode'=>$multiShipCode,
            'WebCreated'=>'',
            'Quote'=>'',
            'QuoteVersion' =>'0',
            'GtrReference'=>'',
            'NonMerchFlag'=>'',
            'Email'=>'',
            'User1'=>'',
	        'CompanyTaxNo'=> $CompanyTaxNo,
	        'TpmPickupFlag'=>'D',
            'TpmEvaluatedFlag'=>'',
            'StandardComment'=>'',
            'DetailStatus'=>'',
            'SalesOrderSource'=>'',
            'SalesOrderSrcDesc'=>'',
            'LanguageCode'=>'',
            'ShippingLocation'=>'',
            'IncludeInMrp'=>'',
            'User1'=>'',
            'TimeStamp'=>NULL,
        );
        // echo '<br>SorMaster Insert <br>';
        // print_r($data_SorMaster);
        if($data_SorMaster){
          $this->Migration_model->insert_SorMaster($data_SorMaster);
        }

      

        //SORDETAIL
        // echo '<br>SorDetail Insert <br>';
        // print_r($sku_codes);
        foreach($sku_codes as $sku_code){
            
            $main_sku_code = $sku_code->sku_code;
            $description_row = $this->Migration_model->get_description_by_sku($store_code,$main_sku_code,$salesOrder);
             //Invprice
             $InvPrice = $this->Migration_model->selectInvPrice($main_sku_code);
             $SellingPrice =  $InvPrice->SellingPrice;
             $reason = $description_row->reason;
             
             if(strpos($reason, 'DEFECTIVE')){
                $reason_code = '19';
             }
             elseif(strpos($reason, 'LEAKING')){
                $reason_code = '20';
             }
             elseif(strpos($reason, 'INSECT')){
                $reason_code = '21';
             }
             elseif(strpos($reason, 'DENTED')){
                $reason_code = '22';
             }
             elseif(strpos($reason, 'EXPIRY')){
                $reason_code = '25';
             }
             elseif(strpos($reason, 'HHT')){
                $reason_code = '27';
             }
             else{
                $reason_code = '19';
             }

             if (preg_match('~[BSP]+~', $main_sku_code)) {
                $MProductClass = 'BHW';
                if (preg_match('~[1]+~', $main_sku_code)) {
                    $ConvFactOrdUm = '1';
                    $MPrice = '252.40000';
                    $MStockUnitmass='9400.800000';
                    $MConvFactAlloc = '1';
                }
                elseif(preg_match('~[2]+~', $main_sku_code)){
                    $ConvFactOrdUm = '1';
                    $MPrice = '264.00000';
                    $MStockUnitmass='13068.000000';
                    $MConvFactAlloc = '1';
                }
                else{
                    $ConvFactOrdUm = '1';
                    $MPrice = '240.00000';
                    $MStockUnitmass='12937.000000';
                    $MConvFactAlloc = '1';
                }
            }
            else{
                $MProductClass = 'AQL';
                if (preg_match('~[1]+~', $main_sku_code)) {
                    $ConvFactOrdUm = '36';
                    $MPrice = $SellingPrice;
                    $MStockUnitmass='482.904000';
                    $MConvFactAlloc = '36';
                    $MCusSupStkCode = '4809015758038';
                }
                elseif(preg_match('~[2]+~', $main_sku_code)){
                    $ConvFactOrdUm = '24';
                    $MPrice = $SellingPrice;
                    $MStockUnitmass='302.184000';
                    $MConvFactAlloc = '24';
                    $MCusSupStkCode = '4809015758045';
                }
                else{
                    $ConvFactOrdUm = '12';
                    $MPrice = $SellingPrice;
                    $MStockUnitmass='151.668000';
                    $MConvFactAlloc = '12';
                    $MCusSupStkCode = '4809015758052';
                }
            }

            //SorDetailQty Query Check
            $allMonitorings = $this->Migration_model->get_ids_by_store_code_ver_2($store_code,$main_sku_code,$salesOrder);
           
            $inQtys = $this->Migration_model->in_details_ver_2($allMonitorings);
        
            $data_SorDetail = array(
                'SalesOrder'=>$salesOrder,
                'SalesOrderLine'=>$sku_code->rownum,
                'LineType'=>'1',
                'MStockCode' =>$main_sku_code,
                'MStockDes' =>'AQUALIFE PURIFIED WATER',
                'MWarehouse'=>'W1',
                'MBin'=>'W1',
                'MOrderQty'=>$inQtys* -1,
                'MShipQty'=>$inQtys* -1,
                'MBackOrderQty'=>'0.000000',
                'MUnitCost'=>'0.00000',
                'MBomFlag'=>'',
                'MParentKitType'=>'N',
                'MQtyPer'=>'0.00000',
                'MScrapPercentage'=>'0.00',
                'MPrintComponent'=>'Y',
                'MComponentSeq'=>'',
                'MQtyChangesFlag'=>'',
                'MOptionalFlag'=>'',
                'MDecimals'=>'3',
                'MOrderUom'=>$description_row->uom,
                'MStockQtyToShp'=> round((($sku_code->sum_qty/$MConvFactAlloc) * -1),3),
                'MStockingUom'=>'CS',
                'MConvFactOrdUm'=>$ConvFactOrdUm,
                'MMulDivPrcFct'=>'D',
                'MPrice'=>$SellingPrice,
                'MPriceUom'=>'CS',
                'MCommissionCode'=>'',
                'MDiscPct1'=>'0.00',
                'MDiscPct2'=>'0.00',
                'MDiscPct3'=>'0.00',
                'MDiscValFlag'=>'',
                'MDiscValue'=>'0.00',
                'MProductClass'=>$MProductClass,
                'MTaxCode'=>'G',
                'MLineShipDate'=>$dateconvert,
                'MAllocStatSched'=>'',
                'MFstTaxCode'=>'',
                'MStockUnitMass'=>$MStockUnitmass,
                'MStockUnitVol'=>'0',
                'MPriceCode'=>'A',
                'MConvFactAlloc'=>$MConvFactAlloc,
                'MMulDivQtyFct'=>'D',
                'MTraceableType'=>'T',
                'MMpsFlag'=>'Y',
                'MPickingSlip'=>'',
                'MMovementReqd'=>'Y',
                'MSerialMethod'=>'N',
                'MZeroQtyCrNote'=>'',
                'MAbcApplied'=>'N',
                'MMpsGrossReqd'=>'I',
                'MContract'=>'',
                'MBuyingGroup'=>'',
                'MCusSupStkCode'=>$MCusSupStkCode,//ITO AY MAY VALUE SA DATABASE
                'MCusRetailPrice'=>'0.00000',
                'MTariffCode'=>'',
                'MLineReceiptDat'=>NULL,
                'MLeadTime'=>'0',
                'MTrfCostMult'=>'0.000000',
                'MSupplementaryUn'=>'N',
                'MReviewFlag'=>'',
                'MReviewStatus'=>'',
                'MInvoicePrinted'=>'',
                'MDelNotePrinted'=>'',
                'MOrdAckPrinted'=>'',
                'MHierarchyJob'=>'',
                'MCustRequestDat'=>$dateconvert,
                'MLastDelNote'=>'',
                'MUserDef'=>'',
                'MQtyDispatched'=>'0.000000',
                'MDiscChanged'=>'N',
                'MCreditOrderNo'=>'',
                'MCreditOrderLine'=>'0',
                'MUnitQuantity'=>'N',
                'MConvFactUnitQ'=>'0',
                'MAltUomUnitQ'=>'',
                'MDecimalsUnitQ'=>'0',
                'MEccFlag'=>'',
                'MVersion'=>'',
                'MRelease'=>'',
                'MCommitDate'=>NULL,
                'QtyReserved'=>'0.000000',
                'NComment'=>'',
                'NCommentFromLin'=>'0',
                'NMscChargeValue'=>'0.00',
                'NMscProductCls'=>'',
                'NMscChargeCost'=>'0.00',
                'NMscInvCharge'=>'',
                'NCommentType'=>'',
                'NMscTaxCode'=>'',
                'NMscFstCode'=>'',
                'NCommentTextTyp'=>'',
                'NMscChargeQty'=>'0.000000',
                'NSrvIncTotal'=>'',
                'NSrvSummary'=>'',
                'NSrvChargeType'=>'',
                'NSrvParentLine'=>'0',
                'NSrvUnitPrice'=>'0.000000',
                'NSrvUnitCost'=>'0.000000',
                'NSrvQtyFactor'=>'0.000000',
                'NSrvApplyFactor'=>'',
                'NSrvDecimalRnd'=>'0',
                'NSrvDecRndFlag'=>'',
                'NSrvMinValue'=>'0.00',
                'NSrvMaxValue'=>'0.00',
                'NSrvMulDiv'=>'',
                'NPrtOnInv'=>'',
                'NPrtOnDel'=>'',
                'NPrtOnAck'=>'',
                'NTaxAmountFlag'=>'',
                'NDepRetFlagProj'=>'',
                'NRetentionJob'=>'',
                'NSrvMinQuantity'=>'0.000000',
                'NChargeCode'=>'',
                'IncludeInMrp'=>'',
                'ProductCode'=>'',
                'LibraryCode'=>'',
                'MaterialAllocLine'=>'',
                'ScrapQuantity'=>'0.000000',
                'FixedQtyPerFlag'=>'',
                'FixedQtyPer'=>'0.000000',
                'MultiShipCode'=>'',
                'User1'=>'',
                'CreditReason'=>$reason_code,
                'OrigShipDateAps'=>NULL,
                'TpmUsageFlag'=>'',
                'PromotionCode'=>'',
                'TpmSequence'=>'0',
                'SalesOrderInitLine'=>$sku_code->rownum,
                'PreactorPriority'=>'0',
                'SalesOrderDetStat'=>'',
                'SalesOrderResStat'=>'',
                'QtyReservedShip'=>'0.000000',
                'TimeStamp'=>NULL,
            );
            //  print_r($data_SorDetail);
            if($data_SorDetail){
               $this->Migration_model->insert_SorDetail($data_SorDetail);
            }

            //SorAdditions
            $data_SorAdditions= array(
                'TrnDate'=>$datetoday_ver_2,
                'TrnTime'=>$timetoday,
                'SalesOrder'=>$salesOrder,
                'SalesOrderLine'=>$sku_code->rownum,
                'Customer '=>'CR00003',
                'LineType'=>'1',
                'LineValue'=>(($SellingPrice / $ConvFactOrdUm ) * $inQtys)*-1,
                'CostValue'=>'0',//($sku_code->sum_qty * -1) * (($detail_result->detail_qty / $ConvFactOrdUm) * -1), // May Kulang Ito
                'ProductClass'=>$MProductClass,
                'Branch '=>'50',
                'DocumentType '=>'C',
                'Salesperson '=>'G01',
                'Area '=>'04',
                'TaxCode '=>'G',
                'GstCode '=>'',
                'UserField1 '=>'',
                'StockCode '=>$main_sku_code,
                'Description '=>'AQUALIFE PURIFIED WATER',
                'Warehouse'=>'W1',
                'OrderQty'=>($inQtys)*-1,
                'OrderUom'=>'PCS',
                'Price'=>$SellingPrice,
                'PriceUom'=>'CS',
                'Discount'=>'0.00',
                'ShipQty'=>($inQtys)*-1,
                'CreditReason'=>$reason_code,
                'Operator'=>'WIL',
                'TimeStamp'=>NULL,
            );
            //  print_r($data_SorAdditions);
            if($data_SorAdditions){
               $this->Migration_model->insert_SorAdditions($data_SorAdditions);
            }

            //SorDetailLot & Bin Query Check
            $monitoring_results = $this->Migration_model->get_ids_by_store_code($store_code,$main_sku_code,$salesOrder);
            $orderLine[$main_sku_code] = $sku_code->rownum;
            $ConvFactOrdUmArrays[$main_sku_code] = $ConvFactOrdUm;
            
            foreach($monitoring_results as $monitoring_result){
                $id_monitoring[] = $monitoring_result->id;
            }

            
        }

        //Query For Where In Clause
        $inDetails = $this->Migration_model->in_details($id_monitoring);

        foreach($inDetails as $inDetail){
            $LotDetail_row = $this->Migration_model->selectLotDetail($inDetail->detail_lot);
            if(empty($LotDetail_row)){
                $LotExpiryDate = NULL;
            }else{
                $LotExpiryDate = $LotDetail_row->ExpiryDate;
            }
            $OrderLineOutput = $orderLine[trim($inDetail->sku_code)];
            $ConvFactOrdUmOutput = $ConvFactOrdUmArrays[trim($inDetail->sku_code)];
            $data_SorDetailLot = array(
                'SalesOrder'=>$salesOrder,
                'SalesOrderLine'=>$OrderLineOutput,
                'Lot'=>$inDetail->detail_lot,
                'StockQtyToShip' =>round((($inDetail->total_qty / $ConvFactOrdUmOutput) * -1),3),
                'QtyThisSession'=>'0.000000',
                'Version'=>'',
                'Release'=>'',
                'Certificate'=>'',
                'LotExpiryDate'=>$LotExpiryDate,
                'QtyReserved'=>'0.000000',
                'RmaNumber' =>'',
                'TimeStamp'=>NULL,
            );
            // print_r($data_SorDetailLot);
            if($data_SorDetailLot){
               $this->Migration_model->insert_SorLotDetail($data_SorDetailLot);
            }

            //SorDetailBin
            $data_SorDetailBin = array(
                'SalesOrder'=>$salesOrder,
                'SalesOrderLine'=>$OrderLineOutput,
                'Lot'=>$inDetail->detail_lot,
                'Bin'=>'W1',
                'StockQtyToShip' =>round((($inDetail->total_qty / $ConvFactOrdUmOutput) * -1),3),
                'QtyThisSession'=>'0.000000',
                'QtyReserved'=>'0.000000',
                'TimeStamp'=>NULL,
            );
            if($data_SorDetailBin){
              $this->Migration_model->insert_SorDetailBin($data_SorDetailBin);
            }
        }

        $migrations = $this->Migration_model->migration_store_codes_ver_2($store_code,$salesOrder);
        //Update of Migration Status
        foreach($migrations as $migration){
            $monitoring_id = $migration->id;
            $data_update_migration = array(
                'migration_status'=>'1'
            );
            if($data_update_migration){
               $this->Migration_model->update_migration($monitoring_id,$data_update_migration);
            }
        }

        $this->session->set_flashdata('Migration Successful','Migration Successful');
        redirect('migration');

    }

    public function export_all(){
		$data['monitorings']=$this->Migration_model->get_all_monitorings_no_limit();
		$this->load->view('layouts/migration_export',$data);
		// redirect('/dashboard');
	}

	public function export_range(){
		$date_from = $this->input->post('date_from_range');
		$date_to = $this->input->post('date_to_range');
		$data['monitorings']=$this->Migration_model->get_all_monitorings_no_limit_range($date_from,$date_to);
		$this->load->view('layouts/migration_export',$data);
		// redirect('/dashboard');
	}

	public function download(){
		$this->load->view('alerts/migration_success');
	}

   
}
?>