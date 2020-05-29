<?php

Class Admin_modal_select extends CI_Model {
	

    function get_user_by_id($id){

        $query=$this->db->query("select * from users where id='".$id."'");
		
		  if(count($query->result_array())){
			  $row = $query->result_array();
			  return $row[0]['fullname'];
		  }
		  return false;
    }

    function view_user_records($user_id){
		
		$this->db->select('u.*, d.name AS department_name');
		$this->db->from('users u'); 
		$this->db->join('department d', 'd.id=u.dept_id', 'left');

		$this->db->order_by('u.id','asc');         
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
    }

    function display_user_by_id($id)
	{
        $query=$this->db->query("select * from users where id='".$id."'");
        return $query->result();
	}

    function get_department(){

        $query = $this->db->query('SELECT id,name FROM department');
        return $query->result_array();
    }

    
    function get_role_dropdown(){

        $query = $this->db->query('SELECT role_id,name FROM role');
        return $query->result_array();
    }
    
    function get_user_role($user_id = 0){

		$extrajoin = '';
		if($user_id > 0){
			$extrajoin = 'and ur.user_id='.$user_id;
		}
		$this->db->select('r.role_id, r.name,ur.user_id as selected');
		$this->db->from('role as r'); 
		$this->db->join('user_role as ur', "(ur.role_id=r.role_id $extrajoin)", 'left');
		$query = $this->db->get(); 
		return $query->result_array();
	}
    
    	// Get role permission(VIEW.ADD)
	function get_user_role_permision() {//$user_id

		$this->db->select('p.id,p.view_permission as see,p.data_entry_permission as de,
		p.acknowledger_permission as ack, p.approval_permission as app,
		r.name as role_name,
		r.role_id,
		s.id as section_id,
		s.section_name');
		$this->db->from('role_permission p');
		$this->db->join('role r', 'r.role_id = p.role_id');
		$this->db->join('section s', 's.id = p.section_id');
		$this->db->order_by("r.name asc, s.section_name asc");
		$query = $this->db->get();

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
    }

    // Get Role name & Section name
	function get_role_section($role_id=0,$section_id=0) {//$user_id

		$this->db->select('r.name as role_name,r.role_id,
		s.section_name, s.id as section_id');
		$this->db->from('role as r');
		$this->db->join('role_permission p', 'p.role_id = r.role_id','left');
		$this->db->join('section s', 's.id = p.section_id','left');

		if($role_id>0) $this->db->where('r.role_id',$role_id);
		if($section_id>0) $this->db->where('s.id',$section_id);

		$query = $this->db->get();

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}
    
    function get_section(){

		$query = $this->db->query('SELECT id,section_name,description FROM section');
        return $query->result_array();
    }

    function get_section1(){
        
		$query = $this->db->query('SELECT * FROM section ORDER BY section_name ASC');
        return $query->result();
	}

    function get_partname(){

		$query = $this->db->query('SELECT * FROM model_name ORDER BY part_name ASC');
        return $query->result();
    }
    
    function get_purge(){

		$query = $this->db->query('SELECT * FROM purge_location ORDER BY order_no ASC');
        return $query->result();
    }
	
	function get_defect_description(){

		$query = $this->db->query('SELECT * FROM defectives_list ORDER BY id ASC');
		return $query->result();
	}

	function get_defect_type(){

		$this->db->distinct();
		$this->db->select('defect_type');
		$query = $this->db->get('defectives_list'); 
		return $query->result();
	}

    function get_root_cause(){

		$query = $this->db->query('SELECT * FROM root_cause_list ORDER BY constant_no ASC');
        return $query->result();
	}
	
	function get_corrective_action(){

		$query = $this->db->query('SELECT * FROM corrective_action_list ORDER BY constant_no ASC');
        return $query->result();
	}
	
	function get_machine_no(){

		$this->db->select('s.id, s.sector_name, m.*');
		$this->db->from('machine_no_list m'); 
		$this->db->join('sector_list s', 's.id = m.sector_id', 'left');

		$this->db->order_by('m.id','asc');         
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}
	
	function get_sector(){
		
		$query = $this->db->query('SELECT * FROM sector_list ORDER BY id ASC');
		return $query->result();
	}

}