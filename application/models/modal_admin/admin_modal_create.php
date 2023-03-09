<?php

Class Admin_modal_create extends CI_Model {

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

    function save_role($id,$role_id,$role_name) {

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

	function save_part_name($part_name,$is_active,$is_delete){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "part_name = $part_name";
		$this->db->select('*');
		$this->db->from('model_name');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'part_name' => $part_name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

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

	function save_purge_location($purge_name,$order_no,$show_process,$is_active,$is_delete){

		// Query to check whether purge_name & order_no already exist or not
		$condition = "purge_name = '$purge_name' OR order_no = '$order_no'";
		$this->db->select('*');
		$this->db->from('purge_location');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'purge_name' => $purge_name,
				'order_no' => $order_no,
				'show_process' => $show_process,
                'is_active' => $is_active,
				'is_delete' => $is_delete

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

	function save_defect_description($defect_description_name,$defect_type,$is_active,$is_delete){

		// Query to check whether defect_description_name already exist or not
		$condition = "defect_description_name = '$defect_description_name'";
		$this->db->select('*');
		$this->db->from('defectives');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'defect_description_name' => $defect_description_name,
				'defect_type' => $defect_type,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('defectives', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_root_cause($root_cause,$is_active,$is_delete){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "root_cause = '$root_cause'";
		$this->db->select('*');
		$this->db->from('root_cause_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
	
		if ($query->num_rows() == 0) {

			$data = array(

				// 'constant_no' => $constant_no,
				'root_cause' => $root_cause,
				'is_active' => $is_active,
				'is_delete' => $is_delete

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

	function save_corrective_action($corrective_action,$is_active,$is_delete){

		// Query to check whether constant_no & correction_action already exist or not
		$condition = "corrective_action = '$corrective_action'";
		$this->db->select('*');
		$this->db->from('corrective_action_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
	
		if ($query->num_rows() == 0) {

			$data = array(

				// 'constant_no' => $constant_no,
				'corrective_action' => $corrective_action,
				'is_active' => $is_active,
				'is_delete' => $is_delete
				
			);
		
			// Query to insert data in database
			$this->db->insert('corrective_action_list', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_machine_no($machine_name,$sector_id,$order_no,$is_active,$is_delete){ //$constant_no

		// Query to check whether machine_no already exist or not
		$condition = "machine_no = '$machine_no'";
		$this->db->select('*');
		$this->db->from('machine_no_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'machine_name' => $machine_name,
				'sector_id' => $sector_id,
				'order_no' => $order_no,
				'is_active' => $is_active,
				'is_delete' => $is_delete

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

	function save_sector($sector_name,$is_active,$is_delete){ //$constant_no

		// Query to check whether sector_name already exist or not
		$condition = "sector_name = '$sector_name'";
		$this->db->select('*');
		$this->db->from('sector_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'sector_name' => $machine_name,
				'is_active' => $is_active,
				'is_delete' => $is_delete
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

	function save_rule($rule_name,$is_active,$is_delete){ //$constant_no

		// Query to check correction_action already exist or not
		$condition = "rule_name = '$rule_name'";
		$this->db->select('*');
		$this->db->from('rule_list');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'rule_name' => $rule_name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('rule_list', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_detected_group($group_name,$is_active,$is_delete){ 

		// Query to check group_name already exist or not
		$condition = "group_name = '$group_name'";
		$this->db->select('*');
		$this->db->from('detected_group');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'group_name' => $group_name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('detected_group', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_detected_user_group($detectedby_user,$detected_group_id,$show_detectedby,$is_active,$is_delete){ 

		// Query to check detectedby_user already exist or not
		$condition = "detectedby_user = '$detectedby_user'";
		$this->db->select('*');
		$this->db->from('detectedby_user_group');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'detectedby_user' => $detectedby_user,
				'detected_group_id' => $detected_group_id,
				'show_detectedby' => $show_detectedby,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('detectedby_user_group', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_os_us($name,$is_active,$is_delete){

		// Query to check name already exist or not
		$condition = "name = '$name'";
		$this->db->select('*');
		$this->db->from('os_us');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'name' => $name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('os_us', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_datum($name,$is_active,$is_delete){

		// Query to check name already exist or not
		$condition = "name = '$name'";
		$this->db->select('*');
		$this->db->from('datum');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'name' => $name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('datum', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_remarks($name,$is_active,$is_delete){

		// Query to check name already exist or not
		$condition = "name = '$name'";
		$this->db->select('*');
		$this->db->from('remarks');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'name' => $name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('remarks', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
		}else{
			return array('error','Duplicate');
		}
	}

	function save_defect_type($defect_type_name,$is_active,$is_delete){

		// Query to check name already exist or not
		$condition = "defect_type_name = '$defect_type_name'";
		$this->db->select('*');
		$this->db->from('defect_type');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			$data = array(

				'defect_type_name' => $defect_type_name,
				'is_active' => $is_active,
				'is_delete' => $is_delete

			);
		
			// Query to insert data in database
			$this->db->insert('defect_type', $data);
			
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