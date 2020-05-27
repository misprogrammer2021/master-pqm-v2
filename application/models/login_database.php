<?php

Class Login_database extends CI_Model {


// Insert registration data in database
public function registration_insert($data) {

    // Query to check whether username already exist or not
    $condition = "username =" . "'" . $data['username'] . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 0) {
    
        // Query to insert data in database
        $this->db->insert('users', $data);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }else {
        return false;
    }
}

function save_user_registration($username,$password,$email,$fullname,$commodity,$dept_id,$title,$employee_no,$created_date,$modified_date,$is_deleted){

    // Query to check whether username already exist or not
    $condition = "username =" . "'" . $username . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    
    if ($query->num_rows() == 0) {

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
    
        // Query to insert data in database

    //     echo $query = $this->db->get_compiled_select();
	// exit;
        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();
        return $user_id;
        
        
    }else {
        return false;
    }
    
}

function save_user_role($user_id,$roles_id){

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


// Read data using username and password
public function login($data) {

    $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return true;
    } 
    else {
        return false;
    }
}

// Read data from database to show data in admin page
public function read_user_information($username) {

    $condition = "username =" . "'" . $username . "'";
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
        return $query->result();
    } 
    else {
        return false;
    }
}

	// Get user permission
	public function read_user_permission($id) {

		$this->db->select('p.view_permission as see,p.data_entry_permission as de,
		p.acknowledger_permission as ack, p.approval_permission as app,
		ur.role_id as user_role_id,
		r.name as role_name,
		s.section_name as section_name');
		$this->db->from('role_permission p');
		$this->db->join('user_role ur', 'ur.role_id = p.role_id');
		$this->db->join('role r', 'r.role_id = p.role_id');
		$this->db->join('section s', 's.id = p.section_id');
		$this->db->where('ur.user_id',$id);
		$query = $this->db->get();
    // echo $query = $this->db->get_compiled_select();
	// exit;
		if ($query->num_rows() > 0) {
			return $query->result();
		} 
		else {
			return false;
		}
	}


}

?>