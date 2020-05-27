<?php

Class Admin_Modal_Create extends CI_Model {

    function save_user_role($user_id,$roles_id){

        foreach($roles_id as $role_id){
            $data = array(
                'id' => $user_id.'-'.$role_id,
                'user_id' => $user_id,
                'role_id' => $role_id
            );
            
            $this->db->insert('user_role', $data);
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

    function save_permission($data) {

		$result = $this->admin_modal_select->get_role_section($data['role_id'],$data['section_id']);

		if($result){
			return array('error','Duplicate');
		}

		// Query to insert data in database
		$query = $this->db->insert('role_permission', $data);
		
		if ($this->db->affected_rows() > 0) {
			return array('ok','Successful');;
		}else{
			return array('error','Database Failure');
		}
	}

    function save_role($role_id,$role_name) {

		// Query to check whether role_id & name already exist or not
		$condition = "role_id = $role_id OR name = '$role_name'";
		$this->db->select('*');
		$this->db->from('role');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(
				'role_id' => $role_id,
				'name' => $role_name
			);
		
			// Query to insert data in database
			$this->db->insert('role', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_section($section,$description) {

		// Query to check whether section_name already exist or not
		$condition = "section_name = '$section'";
		$this->db->select('*');
		$this->db->from('section');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(
				'section_name' => $section,
				'description' => $description
			);
		
			// Query to insert data in database
			$this->db->insert('section', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_part_name($part_name,$is_deleted_partname){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "part_name = $part_name";
		$this->db->select('*');
		$this->db->from('model_name');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if ($query->num_rows() == 0) {

			$data = array(
				'part_name' => $part_name,
				'is_deleted' => $is_deleted_partname
			  );
		

			// Query to insert data in database
			$this->db->insert('model_name', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}

	}

	function save_purge_location($purge_name,$order_no,$show_process,$is_active,$is_deleted_purge_name){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "purge_name = '$purge_name' OR order_no = '$order_no'";
		$this->db->select('*');
		$this->db->from('purge_location');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if ($query->num_rows() == 0) {

			$data = array(
				'purge_name' => $purge_name,
				'order_no' => $order_no,
				'show_process' => $show_process,
                'is_active' => $is_active,
				'is_deleted' => $is_deleted_purge_name
			  );
		

			// Query to insert data in database
			$this->db->insert('purge_location', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}

	}

	function save_defect_description($defect_description,$defect_type,$is_active,$is_deleted_defect_description){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "defect_description_name = '$defect_description'";
		$this->db->select('*');
		$this->db->from('defectives_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if ($query->num_rows() == 0) {

			$data = array(
				'defect_description_name' => $defect_description,
				'defect_type' => $defect_type,
				'is_active' => $is_active,
				'is_deleted' => $is_deleted_defect_description
			  );
		

			// Query to insert data in database
			$this->db->insert('defectives_list', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}

	}

	function save_root_cause($constant_no,$root_cause,$is_deleted_root_cause){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "constant_no = '$constant_no' OR root_cause = '$root_cause'";
		$this->db->select('*');
		$this->db->from('root_cause_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if ($query->num_rows() == 0) {

			$data = array(
				'constant_no' => $constant_no,
				'root_cause' => $root_cause,
				'is_deleted' => $is_deleted_root_cause
			  );
		

			// Query to insert data in database
			$this->db->insert('root_cause_list', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}

	}

	function save_machine_no($machine_name,$sector_id,$order_no,$is_deleted_machine_no){ //$constant_no

		// Query to check whether constant_no & correction_action already exist or not
		// $condition = "constant_no = '$constant_no' AND machine_no = '$machine_no'";
		$condition = "machine_no = '$machine_no'";
		$this->db->select('*');
		$this->db->from('machine_no_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if ($query->num_rows() == 0) {

			$data = array(
				'machine_name' => $machine_name,
				'sector_id' => $sector_id,
				'order_no' => $order_no,
				'is_deleted' => $is_deleted_machine_no
			  );
		

			// Query to insert data in database
			$this->db->insert('machine_no_list', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}

	}

	function save_sector($sector_name,$is_active,$is_deleted_sector){ //$constant_no

		// Query to check whether constant_no & correction_action already exist or not
		// $condition = "constant_no = '$constant_no' AND machine_no = '$machine_no'";
		$condition = "sector_name = '$sector_name'";
		$this->db->select('*');
		$this->db->from('sector_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if ($query->num_rows() == 0) {

			$data = array(
				'sector_name' => $machine_name,
				'is_active' => $is_active,
				'is_deleted' => $is_deleted_sector
			  );
		

			// Query to insert data in database
			$this->db->insert('sector_list', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}

	}
}