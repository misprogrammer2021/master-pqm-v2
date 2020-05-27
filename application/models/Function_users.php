<?php

Class Function_users extends CI_Model {

    // public function viewuserrecords()
	// {
	//     $query=$this->db->query("select * from users");
	//     return $query->result();
    // }

    function viewuserrecords($user_id){
		
		$this->db->select('u.*,
		d.name AS department_name');
		$this->db->from('users u'); 
		$this->db->join('department d', 'd.id=u.dept_id', 'left');
		// $this->db->join('role r', 'r.role_id=ur.role_id', 'left');
		// $this->db->join('user_role ur', 'ur.id=u.role_id', 'left');
		// $this->db->where('u.id',$user_id);
		// $this->db->limit(1);
		$this->db->order_by('u.id','asc');         
		$query = $this->db->get(); 
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}
    
    function displayrecordsById($id)
	{
        $query=$this->db->query("select * from users where id='".$id."'");
        return $query->result();
	}

	function displayuserolesById($id)
	{
        $query=$this->db->query("select * from role_permission where id='".$id."'");
        return $query->result();
	}
	
	
	// function updaterecords($username,$password,$email,$fullname,$commodity,$dept_id,$title,$employee_no,$role_id,$created_date,$modified_date,$is_deleted,$id)
	// {
	// 	$query=$this->db->query("update users SET username='$username',password='$password',fullname='$fullname',commodity='$commodity',dept_id='$dept_id',title='$title',employee_no='$employee_no',created_date='$created_date',modified_date='$modified_date',is_deleted='$is_deleted' where id='".$id."'");
	// 	$this->db->where('user_id',$id);
	// 	$this->db->delete('user_role');
	// 	$this->db->insert('user_role');
	// 	saveUserRole($id,$role_id);
	// }	

	function updaterecords($id,$username,$password,$email,$fullname,$commodity,$dept_id,$title,$employee_no,$role_id,$created_date,$modified_date,$is_deleted)
	{
		$data = array(
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'fullname' => $fullname,
			'commodity' => $commodity,
			'dept_id' => $dept_id,
			'title' => $title,
			'employee_no' => $employee_no,
			'created_date' => $created_date,
			'modified_date' => $modified_date,
			'is_deleted' => $is_deleted
		  );

		  $this->db->where('id',$id);
		  $this->db->update('users', $data);
		  $this->db->where('user_id',$id);
		  $this->db->delete('user_role');
		  $this->saveUserRole($id,$role_id);
		  
	}	

	function saveUserRole($user_id,$roles_id){

		foreach($roles_id as $role_id){
			$data = array(
				'id' => $user_id.'-'.$role_id,
				'user_id' => $user_id,
				'role_id' => $role_id
			  );
			  
			//   echo $query = $this->db->set($data)->get_compiled_insert('user_role');
			//   exit;
			  $this->db->insert('user_role', $data);
		}
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		
	
	}

	// Get role permission(VIEW.ADD)
	public function GetUserRolePermision() {//$user_id

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
		// $this->db->where('ur.user_id',$user_id);
		$query = $this->db->get();

		// echo $query = $this->db->get_compiled_select();
		// exit;

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}

	function updateRolePermissionRecords($role_id,$section_id,$view_permission,$data_entry_permission,$approval_permission,$acknowledger_permission)
	{
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

		    // echo $query = $this->db->set($data)->get_compiled_insert('role_permission');
			//   exit;
		  $this->db->insert('role_permission', $data);	  
	}	

	// Get user role (VIEW,EDIT) permission
	public function viewuserrolepermission($user_id) {//$user_id

		$this->db->select('p.id,p.view_permission as see,p.data_entry_permission as de,
		p.acknowledger_permission as ack, p.approval_permission as app,
		ur.role_id as userroleid,
		r.name as rolename,
		r.role_id as roleid,
		s.section_name as sectionname');
		$this->db->from('role_permission p');
		$this->db->join('user_role ur', 'ur.role_id = p.role_id');
		$this->db->join('role r', 'r.role_id = p.role_id');
		$this->db->join('section s', 's.id = p.section_id');
		$this->db->where('ur.user_id',$user_id);
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
	public function GetRoleSection($role_id=0,$section_id=0) {//$user_id

		$this->db->select('r.name as role_name,r.role_id,
		s.section_name, s.id as section_id');
		$this->db->from('role as r');
		$this->db->join('role_permission p', 'p.role_id = r.role_id','left');
		$this->db->join('section s', 's.id = p.section_id','left');

		if($role_id>0) $this->db->where('r.role_id',$role_id);
		if($section_id>0) $this->db->where('s.id',$section_id);

		$query = $this->db->get();


		// echo $query = $this->db->get_compiled_select();
		// exit;

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}

    // function saveAddNewRole($role_id,$role_name){



	// 	$data = array(
	// 		'role_id' => $role_id,
	// 		'name' => $role_name
	// 	  );
		  
	// 	$this->db->insert('role', $data);
	// 	$id = $this->db->insert_id();
	// 	return $id;
	// }

	public function savePermission($data) {

		$result = $this->GetRoleSection($data['role_id'],$data['section_id']);
		// print_r($result);
		// echo 'ccccc'.count($result);
		//exit;
		if($result){
			return array('error','Duplicate');
		}
		// Query to check whether role_id & name already exist or not
		// $condition = "role_id = $role_id AND 'section_id = $section_id";
		// $this->db->select('*');
		// $this->db->from('role_permission');
		// $this->db->where($condition);
		// $this->db->limit(1);
		// $query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		// if ($query->num_rows() == 0) {

		// 	$data = array(
		// 		'role_id' => $role_id,
		// 		'section_id' => $section_id
		// 	  );
		

			// Query to insert data in database
			$query = $this->db->insert('role_permission', $data);
			
			if ($this->db->affected_rows() > 0) {
				return array('ok','Successful');;
			}else{
				return array('error','Database Failure');
			}
	}

	function updatePermissionRecords($role_id,$data)
	{
	
		$this->db->where('role_id',$role_id);
		$this->db->update('role', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	// public function savePermission($data) {


	// 	// $data = array(
	// 	// 	'role_id' => $role_id,
	// 	// 	'section_id' => $section_id
	// 	// );
		
	// 	$this->db->insert('role_permission', $data);
			
			
			
	// }

	public function saveAddNewRole($role_id,$role_name) {

		// Query to check whether role_id & name already exist or not
		$condition = "role_id = $role_id OR name = '$role_name'";
		$this->db->select('*');
		$this->db->from('role');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
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

	public function saveAddNewSection($section,$description) {

		// Query to check whether role_id & name already exist or not
		$condition = "section_name = $section";
		$this->db->select('*');
		$this->db->from('section');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
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

	function ViewSectionRecords($section_id){
		
		$this->db->select('id as section_id, section_name, description');
		$this->db->from('section'); 
		$this->db->where('id',$section_id);
		$this->db->order_by('id','asc');         
		$query = $this->db->get(); 
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}

	function updateSectionRecords($id,$data)
	{
	
		$this->db->where('id',$id);
		$this->db->update('section', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

    function getRoleFromDB($user_id = 0){
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
	
	public function displayListUserRoles()
	{
	    $query=$this->db->query("select * from role");
	    return $query->result();
	}

	function GetRoleDropdown(){
        $query = $this->db->query('SELECT role_id,name FROM role');
        return $query->result_array();
	}

	public function displayListSection()
	{
		$query = $this->db->query('SELECT * FROM section ORDER BY section_name ASC');
        return $query->result();
	}

	public function ViewListSection() {//$user_id

		$this->db->select('*');
		$this->db->from('section');
		
		$query = $this->db->get();

		// echo $query = $this->db->get_compiled_select();
		// exit;

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}
		else
		{
			return false;
		}
	}
	
	function getSectionsDropdown(){
        $query = $this->db->query('SELECT id,section_name,description FROM section');
        return $query->result_array();
    }

    function getDepartment(){
        $query = $this->db->query('SELECT id,name FROM department');
        return $query->result_array();
    }

    function getDepartmentById($id){

        $query=$this->db->query("select * from department where id='".$id."'");
		
		  if(count($query->result_array())){
			  $row = $query->result_array();
			  return $row[0]['name'];
		  }
		  return false;
	}

    function getUserRoleById($role_id){

        $query=$this->db->query("select * from role where role_id='".$role_id."'");
		
		  if(count($query->result_array())){
			  $row = $query->result_array();
			  return $row[0]['name'];
		  }
		  return false;
	}


}

?>    