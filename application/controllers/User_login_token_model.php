<?php

class User_login_token_model extends CI_Model {

	  private $table_name = "user_login_token";
      public function __construct() {
            $this->load->database();
            date_default_timezone_set("Asia/Kuala_Lumpur");
      }

      public function record_count() {
          
		  $this->db->select("count(*) AS total");
          $query = $this->db->get($this->table_name);
		  if ($query->num_rows() > 0) {
                $row = $query->row_array();
				return $row['total'];
          } else {
				return 0;
		  }	
		  
      }
      
      public function get($where=array())
      {
           $this->db->where($where);
           $query = $this->db->get($this->table_name);
           if ($query->num_rows() > 0) {
                return $query->result_array();
           } else {
			   	return array();
		   }
           
      }
	  
	  public function getOne($where)
      {
           $this->db->where($where);
           $query = $this->db->get($this->table_name);
           if ($query->num_rows() > 0) {
                return $query->row_array();
           } else {
			   	return array();
		   }
           
      }
      
      public function fetch($limit, $start) {
                      
           $this->db->order_by("postcode","ASC");
           $this->db->limit($limit, $start);
           $query = $this->db->get($this->table_name);
           if ($query->num_rows() > 0) {
                return $query->result_array();
           }
           return false;
      }
      
      public function insert($array) {
            
            $this->db->insert($this->table_name, $array);
            $insert_id = $this->db->insert_id();
            return $insert_id;
      }
      
      public function update($where,$array) {
            $this->db->where($where);
			     $this->db->update($this->table_name, $array);
            return;
      }
      
      public function delete($where) {
            $this->db->where($where);
            $this->db->update($this->table_name, array(
                'is_deleted' => 1,
            ));            
            return;
      }

}

?>