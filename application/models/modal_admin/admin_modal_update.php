<?php

Class Admin_modal_update extends CI_Model {

    function update_user_records($id,$username,$password,$fullname,$commodity,$dept_id,$title,$employee_no,$status,$role_id,$updated_at)
	{
		$data = array(

			'username' => $username,
			'password' => $password,
			// 'email' => $email,
			'fullname' => $fullname,
			'commodity' => $commodity,
			'dept_id' => $dept_id,
			'title' => $title,
			'employee_no' => $employee_no,
			'status' => $status,
			'updated_at' => $updated_at
			
		  );

		  $this->db->where('id',$id);
		  $this->db->update('users', $data);
		  $this->db->where('user_id',$id);
		  $this->db->delete('user_role');
		  $this->admin_modal_create->save_user_role($id,$role_id);
		  
	}
	
	function update_role_permission($role_id,$section_id,$view_permission,$data_entry_permission,$approval_permission,$acknowledger_permission){
		
		$data = array(
			'role_id' => $role_id,
			'section_id' => $section_id,
			'view_permission' => $view_permission,
			'data_entry_permission' => $data_entry_permission,
			'approval_permission' => $approval_permission,
			'acknowledger_permission' => $acknowledger_permission
		);
		  
		$this->db->where('role_id',$role_id);
		$this->db->where('section_id',$section_id);
		$this->db->delete('role_permission');
		$this->db->insert('role_permission', $data);	  
	}
	
	function update_role($role_id,$data){
	
		$this->db->where('role_id',$role_id);
		$this->db->update('role', $data);
			
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
  	}
    
	function update_section($id,$data){

		$this->db->where('id',$id);
		$this->db->update('section', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_part_name($id,$data){

		$this->db->where('id',$id);
		$this->db->update('model_name', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
    
	function update_purge_location($id,$data){

		$this->db->where('id',$id);
		$this->db->update('purge_location', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_defect_description($id,$data){

		$this->db->where('id',$id);
		$this->db->update('defectives', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_root_cause($id,$data){

		$this->db->where('id',$id);
		$this->db->update('root_cause_list', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_corrective_action($id,$data){

		$this->db->where('id',$id);
		$this->db->update('corrective_action_list', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_machine_no($id,$data){

		$this->db->where('id',$id);
		$this->db->update('machine_no_list', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_sector($id,$data){

		$this->db->where('id',$id);
		$this->db->update('sector_list', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_rule($id,$data){

		$this->db->where('id',$id);
		$this->db->update('rule_list', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_detected_group($id,$data){

		$this->db->where('id',$id);
		$this->db->update('detected_group', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_detected_user_group($id,$data){

		$this->db->where('id',$id);
		$this->db->update('detectedby_user_group', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_os_us($id,$data){

		$this->db->where('id',$id);
		$this->db->update('os_us', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_datum($id,$data){

		$this->db->where('id',$id);
		$this->db->update('datum', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_remarks($id,$data){

		$this->db->where('id',$id);
		$this->db->update('remarks', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function update_defect_type($id,$data){

		$this->db->where('id',$id);
		$this->db->update('defect_type', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

}