<?php

class Monitoring_model extends CI_Model{


    var $table = 'monitorings';
    var $column_order = array('rtv_date','rtv_number','store','sku_code','description','uom','qty','amount','reason','case_reference','reference_number',null); //set column field database for datatable orderable
    var $column_search = array('rtv_date','rtv_number','store','sku_code','description','uom','qty','amount','reason','case_reference','reference_number'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 
   
    public function __construct()
    {
        parent::__construct();
       
    }

    // public function test(){
    //   $query = $this->db2->get('SorControl');
    //   return $query->result();
    //  }

 
    private function _get_datatables_query()
    {   
        $column0_search = $this->input->post('column0_search');
        $column1_search = $this->input->post('column1_search');
        $column2_search = $this->input->post('column2_search');
        $column3_search = $this->input->post('column3_search');
        $column4_search = $this->input->post('column4_search');
        $column5_search = $this->input->post('column5_search');
        $column6_search = $this->input->post('column6_search');
        $column7_search = $this->input->post('column7_search');
        $column8_search = $this->input->post('column8_search');
        $column9_search = $this->input->post('column9_search');
        $column10_search = $this->input->post('column10_search');
        $this->db->from($this->table);
        $i = 0;
        

        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if($column0_search){
          $i = $i +1;
          $this->db->like('rtv_date',$column0_search);
        }
        else{
          $i = 0;
        }

        if($column1_search){
          $i = $i +1;
          $this->db->like('rtv_number',$column1_search);
        }
        else{
          $i = 0;
        }

        if($column2_search){
          $i = $i +1;
          $this->db->like('store',$column2_search);
        }
        else{
          $i = 0;
        }

        if($column3_search){
          $i = $i +1;
          $this->db->like('sku_code',$column3search);
        }
        else{
          $i = 0;
        }
        
        if($column4_search){
          $i = $i +1;
          $this->db->like('description',$column4_search);
        }
        else{
          $i = 0;
        }
        
        if($column5_search){
          $i = $i +1;
          $this->db->like('uom',$column5_search);
        }
        else{
          $i = 0;
        }

        if($column6_search){
          $i = $i +1;
          $this->db->like('qty',$column6_search);
        }
        else{
          $i = 0;
        }

        if($column7_search){
          $i = $i +1;
          $this->db->like('amount',$column7_search);
        }
        else{
          $i = 0;
        }

        if($column8_search){
          $i = $i +1;
          $this->db->like('reason',$column8_search);
        }
        else{
          $i = 0;
        }

        if($column9_search){
          $i = $i +1;
          $this->db->like('case_reference',$column9_search);
        }
        else{
          $i = 0;
        }

        if($column10_search){
          $i = $i +1;
          $this->db->like('reference_number',$column10_search);
        }
        else{
          $i = 0;
        }
               
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
 
  function get_datatables()
  {
      $this->_get_datatables_query();
      if($_POST['length'] != 1)
      $this->db->limit(10, $_POST['start']);
      $query = $this->db->get();
      return $query->result();
  }

  function count_filtered()
  {
      $this->_get_datatables_query();
      $query = $this->db->get();
      return $query->num_rows();
  }

  public function all_rtv_empty(){
    $this->db->order_by('rtv_date','DESC');
    $this->db->limit(10,0);
    $query = $this->db->get('monitorings');
    
    return $query->result();
  }

  public function count_all()
  {
      $this->db->from($this->table);
      return $this->db->count_all_results();
  }

  public function all_rtv(){
    $this->db->order_by('rtv_date','DESC');
    $query = $this->db->get('monitorings');
    return $query->result();
  }
  public function insert($data){
    $insert = $this->db->insert('monitorings',$data);
    return $insert;
  }

  public function update_status($id,$data){
    $this->db->where('id',$id);
    $update = $this->db->update('monitorings',$data);
    return $update;
  }

  public function rtv_row($id){
    $this->db->where('id',$id);
    $query = $this->db->get('monitorings');
    return $query->row();
  }

   public function rtv_receives($id){
    $this->db->where('monitoring_id',$id);
    $query = $this->db->get('monitoringdetails');
    return $query->result();
  }

  public function receive($data){
    $insert = $this->db->insert('monitoringdetails',$data);
    return $insert;
  }

  public function update($id,$data){
    $this->db->where('id',$id);
    $update = $this->db->update('monitoringdetails',$data);
    return $update;
  }

  public function delete($id){
    $this->db->where('id',$id);
    $this->db->delete('monitoringdetails');
  }

  public function get_all_monitorings_no_limit($pod_date,$name,$store_code,$store,$sales_order,$sku,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to){
    $this->db->select('*');
    if($pod_date!=''){
      $this->db->like('pod_date', $pod_date,'both',false);
    }
    if($name!=''){
      $this->db->like('rtv_number', $name,'both',false);
    }
    if($store_code!=''){
      $this->db->like('store_code',$store_code,'both',false);  
    }
    if($store!=''){
      $this->db->like('store_description',$store,'both',false);  
    }
    if($sales_order!=''){
      $this->db->like('sales_order',$sales_order,'both',false);  
    }
    if($sku!=''){
      $this->db->like('sku_code',$sku,'both',false);  
    }
  
    if($description!=''){
      $this->db->like('description',$description ,'both',false);  
    }
    if($uom!=''){
      $this->db->like('uom',$uom,'both',false);  
    }

    if($qty!=''){
      $this->db->like('qty',$qty,'both',false);  
    }

    if($qty_received!=''){
      $this->db->like('total_qty_received',$qty_received,'both',false);  
    }

    if($amount!=''){
      $this->db->like('amount',$amount,'both',false);  
    }
    if($reason!=''){
      $this->db->like('reason',$reason,'both',false);  
    }
    if($case!=''){
      $this->db->like('case_reference',$case,'both',false);  
    }
    if($reference!=''){
      $this->db->like('reference_number',$reference,'both',false);  
    }
   
    if($date_from !=""){
      $this->db->where('rtv_date >=',$date_from);
    }

    if( $date_to !=""){
      $this->db->where('rtv_date <=',$date_to);
    }

    $this->db->where('migration_status',$migration_status);  
    $this->db->order_by('id','DESC');
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
    $query=$this->db->get('monitorings');
    return $query->result();
  }
  

  public function get_all_monitorings($limit,$offset){
    $this->db->select('*');
    $this->db->order_by('id','DESC');
    $this->db->limit($limit,$offset);
    $this->db->where('migration_status','0');  
    $query=$this->db->get('monitorings');
    return $query->result();
    }

    public function num_rows_search_monitoring($pod_date,$name,$store_code,$store,$sales_order,$sku,$get_date,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to){
        $convertedname = $this->getName($name);
        $convertedstorecode = $this->getName($store_code);
        $convertedstore = $this->getName($store);
        $convertedso = $this->getName($sales_order);
        $convertedsku = $this->getName($sku);
        $converteddate = $this->getName($get_date);
        $converteddescription  = $this->getName($description);
        $converteduom= $this->getName($uom);

        $convertedqty= $this->getName($qty);
        $convertedqtyreceived= $this->getName($qty_received);
        $convertedamount= $this->getName($amount);
        $convertedreason= $this->getName($reason);
        $convertedcase= $this->getName($case);
        $convertedreference= $this->getName($reference);

        $converteddatefrom= $this->getName($date_from);
        $converteddateto= $this->getName($date_to);

        $this->db->select('count(DISTINCT id) as countrows');
        if($this->input->get('pod_date')){
          $this->db->like('pod_date', $pod_date,'both',false);
        }

        if($this->input->get('rtv_number')){
          $this->db->like('rtv_number', $convertedname,'both',false);
        }
        if($this->input->get('store_code')){
          $this->db->like('store_code',$convertedstorecode,'both',false);  
        }
        if($this->input->get('store')){
          $this->db->like('store_description',$convertedstore,'both',false);  
        }
        if($this->input->get('so_number')){
          $this->db->like('sales_order',$convertedso,'both',false);  
        }
        if($this->input->get('sku_code')){
          $this->db->like('sku_code',$convertedsku,'both',false);  
        }
        if($this->input->get('rtv_date')){
          $this->db->like('rtv_date',$converteddate,'both',false);  
        }
        if($this->input->get('description')){
          $this->db->like('description',$converteddescription ,'both',false);  
        }
        if($this->input->get('uom')){
          $this->db->like('uom',$converteduom,'both',false);  
        }

        if($this->input->get('qty')){
          $this->db->like('qty',$convertedqty,'both',false);  
        }

        if($this->input->get('qty_received')){
          $this->db->like('total_qty_received',$convertedqtyreceived,'both',false);  
        }

        if($this->input->get('amount')){
          $this->db->like('amount',$convertedamount,'both',false);  
        }
        if($this->input->get('reason')){
          $this->db->like('reason',$convertedreason,'both',false);  
        }
        if($this->input->get('case')){
          $this->db->like('case_reference',$convertedcase,'both',false);  
        }
        if($this->input->get('reference')){
          $this->db->like('reference_number',$convertedreference,'both',false);  
        }
       
        if($date_from !="1970-01-01"){
          $this->db->where('rtv_date >=',$date_from);
        }
        
        if($date_to !="1970-01-01"){
          $this->db->where('rtv_date <=',$date_to);
        }
      
        if($migration_status!='2'){
          $this->db->where('migration_status',$migration_status);  
        }
        else{
          $this->db->where('recon_status','0');
          $this->db->where('total_qty_received >','0');
          $this->db->where('migration_status','1');
        }
    
        $query=$this->db->get('monitorings');
        return $query->row();
    }

    public function num_rows_get_all_users(){
      $this->db->select('count(DISTINCT id) as countrows');
      $this->db->where('migration_status','0');  
      $query=$this->db->get('monitorings');
      return $query->row();
    }

    public function search_monitoring_name($pod_date,$name,$limit,$offset,$store_code,$store,$sales_order,$sku,$get_date,$description,$uom,$qty,$qty_received,$amount,$reason,$case,$reference,$migration_status,$date_from,$date_to){
      
        $convertedname = $this->getName($name);
        $convertedstorecode = $this->getName($store_code);
        $convertedstore = $this->getName($store);
        $convertedso = $this->getName($sales_order);
        $convertedsku = $this->getName($sku);
        $converteddate = $this->getName($get_date);
        $converteddescription = $this->getName($description);
        $converteduom= $this->getName($uom);

        $convertedqty= $this->getName($qty);
        $convertedqtyreceived= $this->getName($qty_received);
        $convertedamount= $this->getName($amount);
        $convertedreason= $this->getName($reason);
        $convertedcase= $this->getName($case);
        $convertedreference= $this->getName($reference);
        $converteddatefrom= $this->getName($date_from);
        $converteddateto= $this->getName($date_to);

        $this->db->select('*');
        if($this->input->get('pod_date')){
          $this->db->like('pod_date', $pod_date,'both',false);
        }
        if($this->input->get('rtv_number')){
         $this->db->like('rtv_number', $convertedname,'both',false);
        }
        if($this->input->get('store_code')){
          $this->db->like('store_code',$convertedstorecode,'both',false);  
        }
        if($this->input->get('store')){
          $this->db->like('store_description',$convertedstore,'both',false);  
        }
        if($this->input->get('so_number')){
          $this->db->like('sales_order',$convertedso,'both',false);  
        }
        if($this->input->get('sku_code')){
          $this->db->like('sku_code',$convertedsku,'both',false);  
        }
        if($this->input->get('rtv_date')){
          $this->db->like('rtv_date',$converteddate,'both',false);  
        }
        if($this->input->get('description')){
          $this->db->like('description',$converteddescription ,'both',false);  
        }
        if($this->input->get('uom')){
          $this->db->like('uom',$converteduom,'both',false);  
        }

        if($this->input->get('qty')){
          $this->db->like('qty',$convertedqty,'both',false);  
        }

        if($this->input->get('qty_received')){
          $this->db->like('total_qty_received',$convertedqtyreceived,'both',false);  
        }

        if($this->input->get('amount')){
          $this->db->like('amount',$convertedamount,'both',false);  
        }
        if($this->input->get('reason')){
          $this->db->like('reason',$convertedreason,'both',false);  
        }
        if($this->input->get('case')){
          $this->db->like('case_reference',$convertedcase,'both',false);  
        }
        if($this->input->get('reference')){
          $this->db->like('reference_number',$convertedreference,'both',false);  
        }
        
        if($date_from !="1970-01-01"){
          $this->db->where('rtv_date >=',$date_from);
        }
        
        if($date_to !="1970-01-01"){
          $this->db->where('rtv_date <=',$date_to);
        }
      
        if($migration_status!='2'){
          $this->db->where('migration_status',$migration_status);  
        }
        else{
          $this->db->where('recon_status','0');
          $this->db->where('total_qty_received >','0');
          $this->db->where('migration_status','1');  
        }
        $this->db->order_by('id','DESC');
        $this->db->limit($limit,$offset);
        $query=$this->db->get('monitorings');
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
  public function check_store_code($monitoring_id){
    $this->db->select('rtv_number');
    $this->db->select('pod_date');
    $this->db->where('id',$monitoring_id);
    $query=$this->db->get('monitorings');
    return $query->row();
  }

  public function check_sku_code($monitoring_id){
    $this->db->select('sku_code');
    $this->db->select('qty');
    $this->db->where('id',$monitoring_id);
    $query=$this->db->get('monitorings');
    return $query->row();
  }

  public function check_store_code_received_status($store_code){
    $this->db->select('received_check_status');
    $this->db->where('received_check_status','1');
    $this->db->where('store_code',$store_code);
    $query = $this->db->get('monitorings');
    return $query->num_rows();
  }

  public function check_store_code_count($rtv_number){
    $this->db->select('received_check_status');
    $this->db->where('received_check_status','0');
    $this->db->where('rtv_number',$rtv_number);
    $query = $this->db->get('monitorings');
    return $query->num_rows();
  }

  public function update_all_status($monitoring_id,$data){
    $this->db->where('id',$monitoring_id);
    $update = $this->db->update('monitorings',$data);
    return $update;
  }

  public function delete_monitorings($monitoring_id){
    $this->db->where('id',$monitoring_id);
    $delete = $this->db->delete('monitorings');
    return $delete;
  }

  public function delete_monitoring_details($monitoring_id){
    $this->db->where('monitoring_id',$monitoring_id);
    $delete = $this->db->delete('monitoringdetails');
    return $delete;
  }

  public function check_migration_status($monitoring_id){
    $this->db->select('migration_status');
    $this->db->where('id',$monitoring_id);
    $query = $this->db->get('monitorings');
    return $query->row();
  }

  public function month_and_year(){
    $this->db->select("CAST(month(rtv_date) as varchar) +' '+ CAST(year(rtv_date) as varchar) as date");
    $this->db->select('COUNT(month(rtv_date)) as count_monthly');
    $this->db->group_by('month(rtv_date),year(rtv_date)');
    $query =  $this->db->get('monitorings');
    $months = $query->result();
    
    foreach($months as $month){
      $convert = explode(" ", $month->date);
      
      $month_convert = $convert[0];
      $date_month_object = DateTime::createFromFormat('!m', $month_convert);
      $date_month_post=$date_month_object->format('F');
      $year_convert = $convert[1];
      $data[] = array(
        'month'=>$date_month_post,
        'year'=>$year_convert
      );
    }
    
    return $data;
  }

  public function month_and_year_search($month,$year){
    $this->db->select("CAST(month(rtv_date) as varchar) +' '+ CAST(year(rtv_date) as varchar) as date");
    $this->db->select('COUNT(month(rtv_date)) as count_monthly');
    $this->db->group_by('month(rtv_date),year(rtv_date)');
    if($month!=""){
      $this->db->like('month(rtv_date)',$month);
    }
    if($year!=''){
      $this->db->like('year(rtv_date)',$year);
    }
    
    $query =  $this->db->get('monitorings');
    $months = $query->result();
    
    foreach($months as $month){
      $convert = explode(" ", $month->date);
      
      $month_convert = $convert[0];
      $date_month_object = DateTime::createFromFormat('!m', $month_convert);
      $date_month_post=$date_month_object->format('F');
      $year_convert = $convert[1];
      $data[] = array(
        'month'=>$date_month_post,
        'year'=>$year_convert
      );
    }
    
    return $data;
  }

  public function sku_code_counts(){
    $this->db->select('count(sku_code) as counts');
    $this->db->select('sum(qty) as qty_total');
    $this->db->select('sum(total_qty_received) as qty_total_received');
    $this->db->select('sku_code');
    $this->db->group_by('sku_code');
    $query = $this->db->get('monitorings');
    return $query->result();
  }

}
?>
