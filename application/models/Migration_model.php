<?php

class Migration_model extends CI_Model{    
    
    var $table = 'monitorings';
    var $column_order = array('store_code','store_description'); //set column field database for datatable orderable
    var $column_search = array('store_code','store_description'); //set column field database for datatable searchable 
    var $order = array('store_code' => 'DESC'); // default order 

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->PBB = $this->load->database('secondDb', TRUE);
        }
    
        private function _get_datatables_query($store_code,$store_description)
        {
           
            $this->db->select('store_code, count(store_code) as total');
            $this->db->select('store_description, COUNT(store_description) as total1');
            $this->db->select("rtv_number=(SELECT  CONVERT( varchar(20),b.rtv_number) + ' ' as irene  FROM monitorings b WHERE b.store_code = a.store_code AND migration_status='0'  GROUP BY b.rtv_number FOR XML PATH(''))");
            $this->db->from('monitorings a');
            $this->db->where('received_status','1');
            $this->db->where('migration_status','0');
            $this->db->group_by('store_code,store_description');
            $this->db->like('store_code',$store_code);
            $this->db->or_like('store_description',$store_description);
          
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }

        }
    
    function get_datatables($store_code,$store_description)
    {
        $this->_get_datatables_query($store_code,$store_description);
        if($_POST['length'] != 1)
        $this->db->limit(10, $_POST['start']);
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($store_code,$store_description)
    {
        $this->_get_datatables_query($store_code,$store_description);
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($store_code,$store_description)
    {
        $this->db->select('store_code, count(store_code) as total');
        $this->db->select('store_description, COUNT(store_description) as total1');
        $this->db->select("rtv_number=(SELECT  CONVERT( varchar(20),b.rtv_number) + ' ' as irene  FROM monitorings b WHERE b.store_code = a.store_code AND migration_status='0' GROUP BY b.rtv_number FOR XML PATH(''))");
        $this->db->from('monitorings a');
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->like('store_code',$store_code);
        $this->db->or_like('store_description',$store_description);
        $this->db->order_by('store_code','DESC');
        $this->db->group_by('store_code,store_description');
        return $this->db->count_all_results();
    }
        

    public function all_migration($limit,$offset){
     
        $this->db->select('store_code, count(store_code) as total');
        $this->db->select('store_description, COUNT(store_description) as total1');
        
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->order_by('COUNT(store_code)','DESC');
        $this->db->group_by('store_code,store_description');
    
        $this->db->limit($limit,$offset);
        $query=$this->db->get('monitorings');
        return $query->result();
    }
    
   
    public function migration_count($store_code){
        $this->db->distinct();
        $this->db->select('rtv_number');
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
      
        $query=$this->db->get('monitorings');
        return $query->num_rows();
    }

    public function get_rtvs($store_code){
        $this->db->distinct();
        $this->db->select('rtv_number');
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $query = $this->db->get('monitorings');
        $datas = $query->result(); 
        foreach($datas as $data){
            $rtv[] = $data->rtv_number;
        }
        $output = implode("/", $rtv);
        return $output;
    }

    public function update_monitorings_pre_migration($rtv_number,$data){
        $this->db->where('rtv_number',$rtv_number);
        $update = $this->db->update('monitorings',$data);
        return $update;
    }

    public function check_migration_status($rtv_number){
        $this->db->where('rtv_number',$rtv_number);
        $this->db->where('migration_status','1');
        $query = $this->db->get('monitorings');
        return $query->row();
    }
    
    public function migration_distinct($store_code,$salesOrder){
        $this->db->distinct();
        $this->db->select('rtv_number');
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('sales_order',$salesOrder);
      
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_distinct_sku_code($store_code,$salesOrder){
        //$this->db->select('sku_code');
        $this->db->select('ROW_NUMBER() OVER( ORDER BY sku_code) AS rownum');
        $this->db->select('sku_code,count(sku_code) as count_sku');
        $this->db->select('SUM(total_qty_received) as sum_qty');
          
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('sales_order',$salesOrder);
        
        $this->db->group_by('sku_code');
        
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_sku_code_group_by($store_code){
        $this->db->select('sku_code,count(sku_code) as count_sku');
        $this->db->select('SUM(qty) as sum_qty');
          
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->group_by('sku_code');
        
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_store_codes($store_code){
      
        $this->db->select('id');
        $this->db->select('store_code');
        $this->db->select('store_description');
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
      
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_store_codes_ver_2($store_code,$salesOrder){
      
        $this->db->select('id');
        $this->db->select('store_code');
        $this->db->select('store_description');
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('sales_order',$salesOrder);
      
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_store_description($store_code,$salesOrder){
      
        $this->db->select('store_description');
        $this->db->select('rtv_date');
        $this->db->where('store_code',$store_code);
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('sales_order',$salesOrder);
      
        $query=$this->db->get('monitorings');
        return $query->row();
    }

    public function num_rows_get_all_monitoring_value_zero(){
        $this->db->select('store_code, count(store_code) as total');
        $this->db->select('store_description, COUNT(store_description) as total1');
      
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->order_by('store_code','DESC');
        $this->db->group_by('store_code,store_description');
        
      
        $query=$this->db->get('monitorings');
        return $query->num_rows();
    }

    public function update_migration($id,$data){
        $this->db->where('id',$id);
        $update = $this->db->update('monitorings',$data);
        return $update;
    }

    public function selectSorControl(){
        $this->PBB->select('KeyType');
        $this->PBB->select('KeyNext');
        $this->PBB->where('KeyType','CRNOTE');
        $query = $this->PBB->get('SorNextKeys');
        return $query->row();
    }

    public function selectArMultAddress($store_code){
        $this->PBB->select('ShipToAddr1');
        $this->PBB->select('ShipToAddr2');
        $this->PBB->select('ShipToAddr3');
        $this->PBB->select('ShipToAddr4');
        $this->PBB->where('AddrCode',$store_code);
        $query = $this->PBB->get('ArMultAddress');
        return $query->row();
    }

    public function selectInvPrice($sku_code){
        $this->PBB->select('SellingPrice');
        $this->PBB->where('StockCode',$sku_code);
        $query = $this->PBB->get('InvPrice');
        return $query->row();
    }

    public function selectLotDetail($Lot){
        $this->PBB->select('ExpiryDate');
        $this->PBB->where('Lot',$Lot);
        $query = $this->PBB->get('LotDetail');
        return $query->row();
    }

    public function selectLotDetailBySkuCode($sku_code,$lot){
        $this->PBB->select('Lot');
        $this->PBB->where('StockCode',$sku_code);
        $this->PBB->where('Lot',$lot);
        $query = $this->PBB->get('LotDetail');
        return $query->row();
    }

    public function updateSorControl($data){
        $this->PBB->where('KeyType','CRNOTE');
        $update = $this->PBB->update('SorNextKeys',$data);
        return $update;
    }

    public function insert_SorMaster($data){
        $insert = $this->PBB->insert('SorMaster',$data);
        return $insert;
    }

    public function insert_SorDetail($data){
        $insert = $this->PBB->insert('SorDetail',$data);
        return $insert;
    }

    public function insert_SorLotDetail($data){
        $insert = $this->PBB->insert('SorDetailLot',$data);
        return $insert;
    }

    public function insert_SorDetailBin($data){
        $insert = $this->PBB->insert('SorDetailBin',$data);
        return $insert;
    }

    public function insert_SorAdditions($data){
        $insert = $this->PBB->insert('SorAdditions',$data);
        return $insert;
    }

    public function get_description_by_sku($store_code,$sku_code,$salesOrder){
        $this->db->select('description');
        $this->db->select('uom');
        $this->db->select('reason');
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('store_code',$store_code);
        $this->db->where('sku_code',$sku_code);
        $this->db->where('sales_order',$salesOrder);
        $query = $this->db->get('monitorings');
        return $query->row();
    }

    public function get_ids_by_store_code($store_code,$sku_code,$salesOrder){
        $this->db->select('id');
        $this->db->select('sku_code');
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('store_code',$store_code);
        $this->db->where('sku_code',$sku_code);
        $this->db->where('sales_order',$salesOrder);
        $query = $this->db->get('monitorings');
        return $query->result();
    }

    public function get_ids_by_store_code_ver_2($store_code,$sku_code,$salesOrder){
        $this->db->select('id');
        $this->db->select('sku_code');
        $this->db->where('received_status','1');
        $this->db->where('pre_migrate_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('store_code',$store_code);
        $this->db->where('sku_code',$sku_code);
        $this->db->where('sales_order',$salesOrder);
        $query = $this->db->get('monitorings');
        $datas = $query->result();
        foreach($datas as $data){
            $irene[] = $data->id;
        }
        return $irene;
    }
    

    public function details_result($monitoring_id){
        $this->db->select('detail_lot');
        $this->db->select('detail_qty');
        $this->db->where('monitoring_id',$monitoring_id);
        $query = $this->db->get('monitoringdetails');
        return $query->result();
    }

    public function in_details($array){
        
        $this->db->select('monitoringdetails.detail_lot ,COUNT(monitoringdetails.detail_lot) as lines');
        $this->db->select('SUM(monitoringdetails.detail_qty) as total_qty');
        $this->db->select('monitorings.sku_code');
        $this->db->where_in('monitoringdetails.monitoring_id',$array);
        $this->db->group_by('monitoringdetails.detail_lot,monitorings.sku_code');

        $this->db->join('monitorings','monitorings.id = monitoringdetails.monitoring_id');

        $query = $this->db->get('monitoringdetails');
        return $query->result();
    }

    public function in_details_ver_2($array){
        
        $this->db->select('monitoringdetails.detail_lot ,COUNT(monitoringdetails.detail_lot) as lines');
        $this->db->select('SUM(monitoringdetails.detail_qty) as total_qty');
        $this->db->select('monitorings.sku_code');
        $this->db->where_in('monitoringdetails.monitoring_id',$array);
        $this->db->group_by('monitoringdetails.detail_lot,monitorings.sku_code');

        $this->db->join('monitorings','monitorings.id = monitoringdetails.monitoring_id');

        $query = $this->db->get('monitoringdetails');
        $datas = $query->result();
        foreach($datas as $data){
            $irene[] = $data->total_qty;
        }
        $sum_detail_lot = array_sum($irene);
        return $sum_detail_lot;
    }

    public function migration_store_code(){
        $this->db->distinct();
        $this->db->select('store_code');
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_store_code_search($store_code){
        $this->db->distinct();
        $this->db->select('store_code');
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->like('store_code',$store_code);
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_store_description_ajax(){
        $this->db->distinct();
        $this->db->select('store_description');
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function migration_store_description_ajax_search($store_description){
        $this->db->distinct();
        $this->db->select('store_description');
        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->like('store_description',$store_description);
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function get_store_description($store_code){
        $this->PBB->select('ShipToName');
        $this->PBB->where('AddrCode',$store_code);
        $query = $this->PBB->get('ArMultAddress');
        return $query->row();
    }

    public function migration_store_code_and_store_description($store_code){
        $this->db->select('rtv_number','COUNT(rtv_number) as rtv_count');
        $this->db->select('rtv_date');
        $this->db->select('store_code');
        //$this->db->select("sku_code=(SELECT  CONVERT( varchar(20),b.sku_code) + '//' as irene  FROM monitorings b WHERE b.rtv_number = a.rtv_number  GROUP BY b.sku_code FOR XML PATH(''))");
        // $this->db->select("description=(SELECT  b.description + '//' as irene1  FROM monitorings b WHERE b.rtv_number = a.rtv_number  GROUP BY b.description ORDER BY b.description desc FOR XML PATH(''))");
        // $this->db->select("qty=(SELECT  CONVERT( varchar(20),b.qty) + '//' as irene2  FROM monitorings b WHERE b.rtv_number = a.rtv_number  GROUP BY b.qty FOR XML PATH(''))");
        

        $this->db->where('received_status','1');
        $this->db->where('migration_status','0');
        $this->db->where('store_code',$store_code);
        $this->db->group_by('rtv_number,rtv_date,store_code');

        $query=$this->db->get('monitorings a');
        return $query->result();
    }

    public function getName($name){
        $checkspace = strpos($name,"%20");
        if($checkspace >= 0){
            $convertedname = str_replace("%20", " ", $name);
            $checkEnye = strpos($convertedname,"%3%B1");
            if($checkEnye >= 0){
                $convertedname = str_replace("%C3%B1", "ñ", $convertedname);
                $checkEnye2 = strpos($convertedname,"%C3%91");
                if($checkEnye2 >= 0){
                    $convertedname = str_replace("%C3%91", "Ñ", $convertedname);
                }else{
                    $convertedname = $name;
                }
            }else{
                $convertedname = $name;
            }
        }else{
            $convertedname = $name;
        }
        return $convertedname;
      }

    public function get_description_and_qty($rtv_number){
        $this->db->select('sku_code');
        $this->db->select('description');
        $this->db->select('qty');
        $this->db->where('rtv_number',$rtv_number);
        $query = $this->db->get('monitorings');
        $datas = $query->result(); 
        foreach($datas as $data){
            $pass[] = $data->sku_code;
            $pass1[] = $data->description;
            $pass2[] = $data->qty;
        }
        $output = array(
            'sku_code'=>implode("<br>", $pass),
            'description'=>implode("<br>", $pass1),
            'qty'=>implode("<br>", $pass2),
        ); 
      
        return $output;
    }

    public function get_id_by_rtv_number($rtv_number){
        $this->db->select('id');
        $this->db->where('rtv_number',$rtv_number);
        $query = $this->db->get('monitorings');
        return $query->result();
    }

    public function combine_detail_qty($rtv_number){
        $arrays = $this->get_id_by_rtv_number($rtv_number);
        foreach($arrays as $array){
            $ids[] = $array->id;
        }
        $this->db->select('SUM(monitoringdetails.detail_qty) as total_receive');
        $this->db->select('monitoringdetails.monitoring_id');
        $this->db->select('monitorings.sku_code');
        $this->db->select('monitorings.description');
        $this->db->select('monitorings.qty');
        $this->db->group_by('monitoringdetails.monitoring_id,monitorings.sku_code,monitorings.description,monitorings.qty');
        $this->db->where('monitorings.migration_status','0');
        $this->db->where_in('monitoringdetails.monitoring_id',$ids);
        $this->db->join('monitorings','monitorings.id = monitoringdetails.monitoring_id');
        $query = $this->db->get('monitoringdetails');

        $datas = $query->result();
        foreach($datas as $data){
            $pass[] = $data->sku_code;
            $pass1[] = $data->description;
            $pass2[] = $data->qty;
            $pass3[] = $data->total_receive;
        }
        $output = array(
            'sku_code'=>implode("<br>", $pass),
            'description'=>implode("<br>", $pass1),
            'qty'=>implode("<br>", $pass2),
            'receive_qty'=>implode("<br>", $pass3),
        ); 
      
        return $output;
    }

    public function get_all_monitorings_no_limit(){
        $this->db->select('*');
        $this->db->order_by('id','DESC');
        $this->db->where('received_status','1');
        $query=$this->db->get('monitorings');
        return $query->result();
      }
    
      public function get_all_monitorings_no_limit_range($date_from,$date_to){
        $this->db->select('*');
        $this->db->order_by('id','DESC');
        if($date_from !="" && $date_to !=""){
          $this->db->where('rtv_date >=',$date_from);
          $this->db->where('rtv_date <=',$date_to);
        }
        $this->db->where('received_status','1');
        $query=$this->db->get('monitorings');
        return $query->result();
      }
    

}
?>
