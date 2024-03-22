<?php

class Dashboard_model extends CI_Model{
  public function jan_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '01');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function feb_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '02');
      $this->db->where('year(rtv_date)',$year);
      $$query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function mar_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '03');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function apr_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '04');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function may_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '05');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function jun_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '06');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function july_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '07');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function aug_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '08');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function sept_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '09');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function oct_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '10');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function nov_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '11');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function dec_receive($year){
      $this->db->select('month(rtv_date) as date_monthly');
      $this->db->where('month(rtv_date)', '12');
      $this->db->where('year(rtv_date)',$year);
      $query =  $this->db->count_all_results('monitorings'); 
      return $query;
  }

  public function drilldown_dates(){
    $this->db->select('rtv_date, COUNT(rtv_date) as total');
    $this->db->group_by('rtv_date');
    $query=$this->db->get('monitorings');
    return $query->result();
  }

  public function drilldown_rtvs(){
    $this->db->distinct();
    $this->db->select('rtv_number');
    $query=$this->db->get('monitorings');
    return $query->result();
    }

    public function drilldown_table($array){
        $this->db->select('rtv_number','COUNT(rtv_number) as rtv_count');
        $this->db->select('SUM(qty) as total');
        $this->db->group_by('rtv_number');
        $this->db->where_in('rtv_number',$array);
        $query=$this->db->get('monitorings');
        return $query->result();
    }

    public function receive_by_year($year){
        $this->db->select('month(rtv_date) as date_monthly');
        $this->db->select('COUNT(month(rtv_date)) as count_monthly');
        $this->db->group_by('month(rtv_date)');
        $this->db->where('year(rtv_date)',$year);
        $this->db->order_by('max(rtv_date)');
        $query =  $this->db->get('monitorings');
        $months = $query->result();
        $data = array();
        return $months;
    }
}
?>
