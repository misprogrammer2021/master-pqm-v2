<?php
class Function_machinebreakdown extends CI_Model 
{
	public $formID;

	function getAllModels(){
		$query = $this->db->query('SELECT id,part_name FROM model_name');
		return $query->result_array();
	}

	function saveMachineBreakdownRecords($qan_no,$issueby_user_id,$issueto_user,$issued_dept,$to_dept,$shift,$ooc,$oos,$datetime){
		$a=date("Y-m-d H:i:s");
		$b=date("y");
		$this->db->select('qan_no');
		$this->db->from('qan_machinebreakdown');
		$this->db->order_by("id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		//$query = $this->db->get_compiled_select();
		
		if ($query->num_rows() == 0) {
			$qan_no= $b.'00001';
		} else {
			$row = $query->row(); 
			$last_qan_no = $row->qan_no;
		
			$qan_no_year = substr($last_qan_no, 0, 2);

			if($qan_no_year == $b){
				$qan_no = $last_qan_no+1;
			}else{
				$qan_no= $b.'00001';
			}
		}
		$data = array(
			'qan_no' => $qan_no,
			'created_date' => $a,
			'modified_date' => $a,
			'is_deleted' => 0,
			'status' => 'NEW',
			'issueby_user_id' => $issueby_user_id,
			'issueto_user' => $issueto_user,
			'issued_dept' => $issued_dept,
			'to_dept' => $to_dept,
			'shift' => $shift,
			'ooc' => $ooc,
			'oos' => $oos,
			'datetime' => $datetime
		  );
		  
		$this->db->insert('qan_machinebreakdown', $data);
		$machine_breakdown_id = $this->db->insert_id();
		return $machine_breakdown_id;
		//echo $query="insert into qan_machinebreakdown values(,$qan_no,'$a','$a',0,'New',$issueby_user_id,$issueto_user,'$issued_dept','$to_dept','$shift','$ooc','$oos','$datetime','','','','','','','')";
		//$this->db->query($query);
		
	}

	function saveDefectInfoRecords($machine_breakdown_id,$part_name,$machine_no,$process,$cav_no,$up_affected,$detectedby_user,$defect_description,$last_passed_sample,$purge_from,$estimate_qty){

		$data = array(
			'machine_breakdown_id' => $machine_breakdown_id,
			'part_name' => $part_name,
			'machine_no' => $machine_no,
			'process' => $process,
			'cav_no' => $cav_no,
			'up_affected' => $up_affected,
			'detectedby_user' => $detectedby_user,
			'defect_description' => $defect_description,
			'last_passed_sample' => $last_passed_sample,
			'purge_from' => $purge_from,
			'estimate_qty' => $estimate_qty
			// 'ack_eng_user' => $ack_eng_user,
			// 'ack_prod_user' => $ack_prod_user,
			// 'ack_qa_user' => $ack_qa_user
		  );
		  
		$this->db->insert('qan_defect_info', $data);
		// $query="insert into qan_defect_info values('','','$part_name','$machine_no','$process','$cav_no',$up_affected,'$detectedby_user','$defect_description','$last_passed_sample','$purge_from',$estimate_qty,'$ack_eng_user','$ack_prod_user','$ack_qa_user')";
		// $this->db->query($query);
	}

	function saveQASampleRecords($data){

		$this->db->insert('qa_sample_records', $data);
		// $query="insert into qa_sample_records values('',$location_id,'',$quantity)";
		// $this->db->query($query);
	}

	function saveProductionRecords($data){

		$this->db->insert('production_records', $data);
		// $query="insert into qa_sample_records values('',$location_id,'',$quantity)";
		// $this->db->query($query);
	}

	function viewmachinerecords($machine_breakdown_id){
		
		$this->db->select('m.id AS machine_id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,m.issued_dept,m.to_dept,m.shift,m.ooc,m.oos,m.datetime,m.approval_user_id,m.machine_status,m.machine_stop_reason,m.purge_status,m.notify_next_process,m.fix_validation_result,m.closedby_user_id,
		d.part_name,d.machine_no,d.process,d.cav_no,d.up_affected,d.detectedby_user,d.defect_description,d.last_passed_sample,d.purge_from,d.estimate_qty,d.ack_eng_user,d.ack_prod_user,d.ack_qa_user,
		s.qa_sample_id,s.quantity AS samplequantity,
		p.prod_id,p.quantity AS prodquantity');
		$this->db->from('qan_machinebreakdown m'); 
		$this->db->join('qan_defect_info d', 'd.machine_breakdown_id=m.id', 'left');
		$this->db->join('qa_sample_records s', 's.machine_breakdown_id=m.id', 'left');
		$this->db->join('production_records p', 'p.machine_breakdown_id=m.id', 'left');
		$this->db->where('m.id',$machine_breakdown_id);
		$this->db->order_by('m.qan_no','asc');         
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

	function updateMachineBreakdownRecords($machine_breakdown_id,$issueto_user,$issued_dept,$to_dept,$shift,$ooc,$oos,$datetime)
	{
	    $data = array(
			// 'issueto_user' => $issueto_user,
			'issued_dept' => $issued_dept,
			'to_dept' => $to_dept,
			'shift' => $shift,
			'ooc' => $ooc,
			'oos' => $oos,
			'datetime' => $datetime
		  );
		// print_r($data);
		// exit; 
		$this->db->where('id',$machine_breakdown_id);
		$this->db->update('qan_machinebreakdown', $data);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function updateDefectInfoRecords($machine_breakdown_id,$part_name,$machine_no,$process,$cav_no,$up_affected,$detectedby_user,$defect_description,$last_passed_sample,$purge_from,$estimate_qty,$ack_eng_user,$ack_prod_user,$ack_qa_user)
	{
	    $data = array(
			'part_name' => $part_name,
			'machine_no' => $machine_no,
			'process' => $process,
			'cav_no' => $cav_no,
			'up_affected' => $up_affected,
			'detectedby_user' => $detectedby_user,
			'defect_description' => $defect_description,
			'last_passed_sample' => $last_passed_sample,
			'purge_from' => $purge_from,
			'estimate_qty' => $estimate_qty
			// 'ack_eng_user' => $ack_eng_user,
			// 'ack_prod_user' => $ack_prod_user,
			// 'ack_qa_user' => $ack_qa_user
		  );
		$this->db->where('machine_breakdown_id',$machine_breakdown_id);
		$this->db->update('qan_defect_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function updateQASampleRecords($machine_breakdown_id,$qa_sample_id,$data){

		$this->db->where('machine_breakdown_id',$machine_breakdown_id);
		$this->db->where('qa_sample_id',$qa_sample_id);
		$query = $this->db->get('qa_sample_records');
		$isExist = ($query->num_rows() > 0 ) ? TRUE: FALSE;
		$this->db->reset_query();
		$this->db->where('machine_breakdown_id', $machine_breakdown_id);
		
		// $this->db->update('qa_sample_records', $data);

		if ($isExist) 
		{
			$this->db->where('qa_sample_id', $qa_sample_id);
			$this->db->update('qa_sample_records', $data);
		}else{
			if($data['quantity'] > 0)
			$this->db->insert('qa_sample_records', $data);
		}


	}

	function updateProductionRecords($machine_breakdown_id,$prod_id,$data){

		$this->db->where('machine_breakdown_id',$machine_breakdown_id);
		$this->db->where('prod_id',$prod_id);
		$query = $this->db->get('production_records');
		$isExist = ($query->num_rows() > 0 ) ? TRUE: FALSE;
		$this->db->reset_query();
		$this->db->where('machine_breakdown_id', $machine_breakdown_id);
		
		// $this->db->update('qa_sample_records', $data);

		if ($isExist) 
		{
			$this->db->where('prod_id', $prod_id);
			$this->db->update('production_records', $data);
		}else{
			if($data['quantity'] > 0)
			$this->db->insert('production_records', $data);
		}


	}

	public function displayListNewStatusForm()
	{
	    $query=$this->db->query("select * from qan_machinebreakdown");
	    return $query->result();
	}

	function displayRecordById($machine_breakdown_id){

        // $query=$this->db->query("select * from qan_machinebreakdown where id='".$machine_breakdown_id."'");
		// return $query->result();

		$this->db->select('m.id AS machine_id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,m.issued_dept,m.to_dept,m.shift,m.ooc,m.oos,m.datetime,
		d.part_name,d.machine_no,d.process,d.cav_no,d.up_affected,d.detectedby_user,d.defect_description,d.last_passed_sample,d.purge_from,d.estimate_qty,d.ack_eng_user,d.ack_prod_user,d.ack_qa_user,
		s.qa_sample_id,s.quantity AS samplequantity,
		p.prod_id,p.quantity AS prodquantity');
		$this->db->from('qan_machinebreakdown m'); 
		$this->db->join('qan_defect_info d', 'd.machine_breakdown_id=m.id', 'left');
		$this->db->join('qa_sample_records s', 's.machine_breakdown_id=m.id', 'left');
		$this->db->join('production_records p', 'p.machine_breakdown_id=m.id', 'left');
		$this->db->where('m.id',$machine_breakdown_id);
		$this->db->order_by('m.qan_no','asc');         
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

	function getAllProcessName(){
		$query = $this->db->query('SELECT id,process_name FROM purge_location');
		return $query->result_array();
	}

	// function getAckByQADepart(){
	// 	$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id = '1' AND role_id = 1 AND title = 'Leader' OR title = 'Assistant Engineer' OR title = 'Engineer' OR title = 'QA Engineer' OR title = 'Manager'");
	// 	return $query->result_array();
	// }

	// function getDetectedByQADepart(){
	// 	$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id = '1' AND role_id = 1 AND title = 'Inspector' AND is_deleted = '0'");
	// 	return $query->result_array();
	// }

	function getDetectedByQADepart(){
		
		$this->db->select('u.id,u.fullname');
		$this->db->from('users u');
		$this->db->join('user_role ur', 'ur.user_id=u.id');
		$this->db->where('u.dept_id = 1 AND ur.role_id = 1 AND u.title = \'Inspector\' AND u.is_deleted = 0');
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		return $query->result_array();
	}

	// function getAllEngDepart(){
	// 	$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id = '2' AND role_id = 3 AND title = 'Technician' OR title = 'Supervisor' OR title = 'Leader'  OR title = 'Engineer'");
	// 	return $query->result_array();

	// 	foreach($query->result_array() as $row) {
	// 		$data[$row['id']] = $row['fullname'];
	// 	  }
		
	// 	  return $data;
	// }

	// function getAllProdUsers(){
	// 	$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id = '1' AND role_id = 2 AND title = 'Leader' OR title = 'Supervisor'");
	// 	return $query->result_array();
	// }

	function getAllQAUsers(){
		$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id = '1' AND role_id = 1 AND title = 'Leader' OR title = 'Supervisor'");
		return $query->result_array();
	}


	function getQASampleLocation(){
		$query = $this->db->select('*')->from('qa_sample')->get();
		return $query->result();
	}

	function getQASampleRecords(){
		$query = $this->db->select('qa_sample_id')->from('qa_sample_records')->get();
		return $query->result();
	}

	function getProdLocation(){
		$query = $this->db->select('*')->from('production')->get();
		return $query->result();
	}

	function getProductionRecords(){
		$query = $this->db->select('prod_id')->from('production_records')->get();
		return $query->result();
	}

	

}