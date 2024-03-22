<?php

class User_model extends CI_Model{
    public function create_user($data){
        $insert = $this->db->insert('users',$data);
        return $insert;
    }
    public function get_email($email){
        $this->db->select('email');
        $this->db->where('email',$email);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_email_by_user_uuid($user_uuid){
        $this->db->select('email');
        $this->db->where('user_uuid',$user_uuid);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function get_user_uuid($user_uuid){
        $this->db->select('user_uuid');
        $this->db->where('user_uuid',$user_uuid);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function all_users(){
        $query = $this->db->get('users');
        return $query->result();
    }

    public function single_user_by_id($id){
        $this->db->where('id',$id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function single_user($user_uuid){
        $this->db->where('user_uuid',$user_uuid);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_user($user_uuid,$data){
        $this->db->where('user_uuid',$user_uuid);
        $this->db->update('users',$data);
        return true;
    }

     public function get_user_username_row($email){
        $this->db->where('email',$email);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function login_user($email,$password){
        $this->db->where('email',$email);
        $this->db->where('enabled','1');
        $query = $this->db->get('users');
        $result = $query->row();
        $password_row = trim($result->password);
        if($password_row == $password){
            return true;
        }
        else{
            return false;
        }
    }

    public function last_user(){
        $this->db->select('id');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function usertype(){
      $query = $this->db->get('usertypes');
      return $query->result();
    }
  }
?>
