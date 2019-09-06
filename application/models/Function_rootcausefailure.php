<?php
class Function_rootcausefailure extends CI_Model 
{
	function saveRootCauseRecords($data)
	{

		// $data = array(
		// 		'machine_breakdown_id' => $machine_breakdown_id,
		// 		'root_cause' => $root_cause,
		// 		'corrective_action' => $corrective_action,
		// 		'rcfa_pic_user_id' => $rcfa_pic_user_id,
		// 		'rcfa_ack_user_id' => $rcfa_ack_user_id,
		// 		'rcfa_appr_user_id' => $rcfa_appr_user_id
		// );
          
        $this->db->insert('qan_rootcause_failure', $data);
        $root_cause_failure_id = $this->db->insert_id();
		return $root_cause_failure_id;
    }

	function saveSubmissionRecords($data)
	{
		// print_r($submission_no);
		// exit;
		// $current_datetime=date("Y-m-d H:i:s");
		// $data = array(
		// 		'root_cause_failure_id' => $root_cause_failure_id,
		// 		// 'submission_no' => $submission_no,
		// 		'completion_user_id' => $completion_user_id,
		// 		'completion_datetime' => $current_datetime
		// );
		  
        $this->db->insert('qan_rootcause_submission', $data);
        $root_cause_submission_id = $this->db->insert_id();
		return $root_cause_submission_id;
    }
    
	function saveItemInspectionRecords($data)
	{
		$this->db->insert('qan_rootcause_item_inspection', $data);
	}

	// function viewrootcauserecords($machine_breakdown_id){
		
	// 	$this->db->select('m.id AS machine_id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,m.issued_dept_id,m.to_dept_id,m.shift,m.ooc,m.oos,m.datetime,
	// 	d.part_name,d.machine_no,d.process,d.cav_no,d.up_affected,d.detectedby_user,d.defect_description,d.last_passed_sample,d.purge_from,d.estimate_qty,d.ack_eng_user,d.ack_prod_user,d.ack_qa_user,
	// 	s.qa_sample_id,s.quantity,
	// 	mrb.scrap,mrb.rework,mrb.uai,mrb.scrap_no,mrb.rework_order_no,mrb.uai_no,mrb.rework_dispo_input,mrb.rework_dispo_output,mrb.rework_dispo_rej_scrap,mrb.reportby_user_id,mrb.qa_reinsp_verification_user_id,mrb.qa_reinsp_status_accept,mrb.qa_reinsp_status_reject,mrb.reject_reason,
	// 	p.purge_location_id,p.affected_qty,p.good_qty,p.reject_qty,
	// 	qasm.qa_sample_affected_qty,qasm.qa_sample_good_qty,qasm.qa_sample_reject_qty,
	// 	rf.root_cause,rf.corrective_action,rf.rcfa_pic_user_id,rf.rcfa_ack_user_id,rf.rcfa_appr_user_id,
	// 	rs.completion_user_id,rs.completion_datetime,
	// 	ri.inspection_machine_id,ri.inspectby_user_id,ri.time_start,ri.time_end,ri.result');
	// 	$this->db->from('qan_machinebreakdown m'); 
	// 	$this->db->join('qan_defect_info d', 'd.machine_breakdown_id=m.id', 'left');
	// 	$this->db->join('qa_sample_records s', 's.machine_breakdown_id=m.id', 'left');
	// 	$this->db->join('qan_material_review_board mrb', 'mrb.machine_breakdown_id=m.id', 'left');
	// 	$this->db->join('qan_purge p', 'p.mrb_id=mrb.id', 'left');
	// 	$this->db->join('qa_sample_mrb qasm', 'qasm.machine_breakdown_id=m.id', 'left');
	// 	$this->db->join('qan_rootcause_failure rf', 'rf.machine_breakdown_id=m.id', 'left');
	// 	$this->db->join('qan_rootcause_submission rs', 'rs.root_cause_failure_id=rf.id', 'left');
	// 	$this->db->join('qan_rootcause_item_inspection ri', 'ri.root_cause_submission_id=rs.id', 'left');
	// 	$this->db->where('m.id',$machine_breakdown_id);
	// 	// $this->db->limit(1);
	// 	$this->db->order_by('m.qan_no','asc');         
	// 	$query = $this->db->get(); 
	// 	// echo $query = $this->db->get_compiled_select();
	// 	// exit;
	// 	if($query->num_rows() != 0)
	// 	{
	// 		return $query->result_object();
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	function getRootCause_ID($machine_breakdown_id){

		$this->db->reset_query();
		$this->db->select('rc.id');
		$this->db->from('qan_rootcause_failure AS rc'); 
		// $this->db->join('qan_machinebreakdown AS m', 'm.id=rc.machine_breakdown_id', 'left');
		$this->db->where('rc.machine_breakdown_id',$machine_breakdown_id);
     
		$query = $this->db->get(); 
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if($query->num_rows() != 0)
		{
			return $query->result_object()[0]->id;
		}
		else
		{
			return false;
		}
	}

	function getSubmission_ID($root_cause_failure_id){

		$this->db->reset_query();
		$this->db->select('rcs.id');
		$this->db->from('qan_rootcause_submission AS rcs'); 
		// $this->db->join('qan_rootcause_failure AS rc', 'rc.id=rcs.root_cause_failure_id', 'left');
		$this->db->where('rc.root_cause_failure_id',$root_cause_failure_id);
     
		$query = $this->db->get(); 
		// echo $query = $this->db->get_compiled_select();
		// exit;
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function getInspection_ID($root_cause_submission_id){

		$this->db->reset_query();
		$this->db->select('rci.id');
		$this->db->from('qan_rootcause_item_inspection AS rci'); 
		$this->db->join('qan_rootcause_submission AS rci', 'rci.root_cause_submission_id=rcs.id', 'left');
		$this->db->where('rci.root_cause_submission_id',$root_cause_submission_id);
     
		$query = $this->db->get(); 
		echo $query = $this->db->get_compiled_select();
		exit;
		if($query->num_rows() != 0)
		{
			return $query->result_object()[0]->id;
		}
		else
		{
			return false;
		}
	}

	function updateRootCauseRecords($data)
	{

		$this->db->where('machine_breakdown_id');
		$this->db->update('qan_rootcause_failure', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function updateSubmissionRecordsOld($data)
	{
		$this->deleterootcausesubmission();
		$this->db->where('root_cause_failure_id');
		$this->db->update('qan_rootcause_submission', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}


	}

	function updateSubmissionRecords($root_cause_failure_id,$data)
	{
		$rc_id = $this->getRootCause_ID($machine_breakdown_id);
		if($rc_id != FALSE){
			$submission_id = $this->getSubmission_ID($rc_id);
			if($submission_id != FALSE){
				//delete inspection
				$this->db->where_in('root_cause_submission_id',$submission_id);
				$this->db->delete('qan_rootcause_item_inspection');

				//delete submission
				$this->db->where('root_cause_failure_id',$rc_id);
				$this->db->delete('qan_rootcause_submission');
			}
		}
		

		foreach($data as $submission_data){
			$submission_data['root_cause_failure_id'] = $rc_id;
			$this->Function_rootcausefailure->saveSubmissionRecords($submission_data);
		}

	}

	function updateItemInspectionRecordsOld($data)
	{

		$this->db->where('inspection_machine_id');
		$query = $this->db->get('qan_rootcause_item_inspection');
		$isExist = ($query->num_rows() > 0 ) ? TRUE: FALSE;
		$this->db->reset_query();
		$this->db->where('inspection_machine_id');
		
		if ($isExist) 
		{
			//$this->db->where('inspection_machine_id');
			$this->db->update('qan_rootcause_item_inspection', $data);
		}else{
			// if($data['affected_qty'] && $data['good_qty'] && $data['reject_qty'] > 0)
			$this->db->insert('qan_rootcause_item_inspection', $data);
		}


	}

	function updateItemInspectionRecords($root_cause_submission_id,$data)
	{

		$inpection_id = $this->getInspection_ID($root_cause_submission_id);
		
		$this->db->where('root_cause_submission_id',$submission_id);
		$this->db->delete('qan_rootcause_item_inspection');
		
		foreach($data as $inspection_data){
			$inspection_data['root_cause_submission_id'] = $inpection_id;
			$this->Function_rootcausefailure->saveItemInspectionRecords($inspection_data);
		}


	}

	// function deleterootcausesubmission($machine_breakdown_id){

	// 	$this->db->delete('rf.machine_breakdown_id,rf.root_cause,rf.corrective_action,rf.rcfa_pic_user_id,rf.rcfa_ack_user_id,rf.rcfa_appr_user_id,
	// 	rs.id AS submission_id,rs.completion_user_id,rs.completion_datetime,rs.submission_no');
	// 	$this->db->from('qan_rootcause_failure rf');
	// 	$this->db->join('qan_rootcause_submission rs', 'rs.root_cause_failure_id=rf.id');
	// 	$this->db->where('machine_breakdown_id',$machine_breakdown_id);
	// 	$query = $this->db->get(); 

	// 	// echo $query = $this->db->get_compiled_select();
	// 	// exit;

	// 	return $query->result();
	// }

	function deleterootcausesubmission($machine_breakdown_id,$data){
		
		$rc_id = $this->getRootCause_ID($machine_breakdown_id);

		// $this->db->delete('rf.machine_breakdown_id,rf.root_cause,rf.corrective_action,rf.rcfa_pic_user_id,rf.rcfa_ack_user_id,rf.rcfa_appr_user_id,
		// rs.id AS submission_id,rs.completion_user_id,rs.completion_datetime,rs.submission_no');
		// $this->db->from('qan_rootcause_failure rf');
		// $this->db->join('qan_rootcause_submission rs', 'rs.root_cause_failure_id=rf.id');
		$this->db->where('root_cause_failure_id',$rc_id);
		$this->db->delete('qan_rootcause_submission');
		// $query = $this->db->get(); 

		foreach($data as $rcsubmissionlist){
			$rcsubmissionlist['root_cause_failure_id'] = $rc_id;
			$this->Function_rootcausefailure->saveSubmissionRecords($rcsubmissionlist);
		}

		// echo $query = $this->db->get_compiled_select();
		// exit;

		return $query->result();
	}

	function viewrootcausesubmission($machine_breakdown_id){
		$this->db->select('rf.machine_breakdown_id,rf.root_cause,rf.corrective_action,rf.rcfa_pic_user_id,rf.rcfa_ack_user_id,rf.rcfa_appr_user_id,
		rs.id AS submission_id,rs.completion_user_id,rs.completion_datetime,rs.submission_no');
		$this->db->from('qan_rootcause_failure rf');
		$this->db->join('qan_rootcause_submission rs', 'rs.root_cause_failure_id=rf.id');
		$this->db->where('rf.machine_breakdown_id',$machine_breakdown_id);
		$query = $this->db->get(); 

		// echo $query = $this->db->get_compiled_select();
		// exit;

		return $query->result();
	}

	function viewrootcauseinspection($root_cause_submission_id){
		$wherein = '';
		if(is_array($root_cause_submission_id)){
			$wherein = $root_cause_submission_id;
		}else{
			$wherein = array($root_cause_submission_id);
		}
		
		$this->db->select('ri.*, substring(convert(varchar,time_start,20),1,5) as time_start2 , substring(convert(varchar,time_end,20),1,5) as time_end2');
		$this->db->from('qan_rootcause_item_inspection ri');
		$this->db->where_in('ri.root_cause_submission_id',$wherein);
		$query = $this->db->get(); 
		// echo $query = $this->db->get_compiled_select();
		// exit;

		return $query->result();
	}

	// function deleterootcauseinspection($root_cause_submission_id){
	// 	$wherein = '';
	// 	if(is_array($root_cause_submission_id)){
	// 		$wherein = $root_cause_submission_id;
	// 	}else{
	// 		$wherein = array($root_cause_submission_id);
	// 	}
		
	// 	$this->db->delete('ri.*, substring(convert(varchar,time_start,20),1,5) as time_start2 , substring(convert(varchar,time_end,20),1,5) as time_end2');
	// 	$this->db->from('qan_rootcause_item_inspection ri');
	// 	$this->db->where_in('ri.root_cause_submission_id',$wherein);
	// 	$query = $this->db->get(); 
	// 	// echo $query = $this->db->get_compiled_select();
	// 	// exit;

	// 	return $query->result();
	// }

	function deleterootcauseinspection($root_cause_submission_id){
		
		$wherein = '';
		if(is_array($root_cause_submission_id)){
			$wherein = $root_cause_submission_id;
		}else{
			$wherein = array($root_cause_submission_id);
		}
		
		// $this->db->delete('ri.*, substring(convert(varchar,time_start,20),1,5) as time_start2 , substring(convert(varchar,time_end,20),1,5) as time_end2');
		// $this->db->from('qan_rootcause_item_inspection ri');
		$this->db->reset_query();
		$this->db->where_in('root_cause_submission_id',$wherein);
		$this->db->delete('qan_rootcause_item_inspection');
		// $query = $this->db->get(); 
		// echo $query = $this->db->get_compiled_select('qan_rootcause_item_inspection');
		// exit;

		// return $query->result();
	}

	public function displayListNewStatusForm()
	{
	    $query=$this->db->query("select * from qan_machinebreakdown");
	    return $query->result();
	}
		
    function getInspectionMachine(){

		$query = $this->db->select('*')->from('inspection_machine')->get();
	  	return $query->result();

		foreach($query->result_array() as $row) {
			$data[$row['id']] = $row['name'];
		}
		 
    }
    
    function getAckRootCauseEngDepart(){
			$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id= '2' AND role_id = 3 AND title = 'Engineer' OR title = 'Manager'");
			return $query->result_array();

			foreach($query->result_array() as $row) {
				$data[$row['id']] = $row['fullname'];
		  }
		
		  return $data;
    }
    
    function getAppRootCauseQADepart(){
		$query = $this->db->query("SELECT id,fullname FROM users WHERE dept_id = '1' AND role_id = 1 AND title = 'Supervisor' OR title = 'Leader' OR title = 'Assistant Engineer' OR title = 'Engineer' OR title = 'QA Engineer' OR title = 'Manager'");
		return $query->result_array();

		foreach($query->result_array() as $row) {
			$data[$row['id']] = $row['fullname'];
		  }
		
		  return $data;
	}

	// function getInspectByQADepart(){
	// 	$query = $this->db->query("SELECT id,fullname FROM users");
	// 	return $query->result_array();
	// }

	function getInspectByQADepart(){
		
		$this->db->select('u.id,u.fullname');
		$this->db->from('users u');
		$this->db->join('user_role ur', 'ur.user_id=u.id');
		$this->db->where('u.dept_id = 1 AND ur.role_id = 1 AND u.title = \'Inspector\' AND u.is_deleted = 0');
		$query = $this->db->get();
		// echo $query = $this->db->get_compiled_select();
		// exit;
		return $query->result_array();
	}
}







