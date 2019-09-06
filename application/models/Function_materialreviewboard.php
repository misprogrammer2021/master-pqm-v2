<?php
class Function_materialreviewboard extends CI_Model 
{
    function saveMaterialReviewBoardRecords($machine_breakdown_id,$scrap,$rework,$uai,$scrap_no,$rework_order_no,$uai_no,$rework_dispo_input,$rework_dispo_output,$rework_dispo_rej_scrap,$reportby_user_id,$qa_reinsp_status_accept,$qa_reinsp_status_reject,$reject_reason){
        
        $data = array(
			'machine_breakdown_id' => $machine_breakdown_id,
			'scrap' => $scrap,
			'rework' => $rework,
			'uai' => $uai,
			'scrap_no' => $scrap_no,
			'rework_order_no' => $rework_order_no,
			'uai_no' => $uai_no,
			'rework_dispo_input' => $rework_dispo_input,
			'rework_dispo_output' => $rework_dispo_output,
			'rework_dispo_rej_scrap' => $rework_dispo_reject,
			'reportby_user_id' => $reportby_user_id,
			// 'qa_reinsp_verification_user_id' => $qa_reinsp_verification_user_id,
			'qa_reinsp_status_accept' => $qa_reinsp_status_accept,
			'qa_reinsp_status_reject' => $qa_reinsp_status_reject,
			'reject_reason' => $reject_reason
		);

		$this->db->insert('qan_material_review_board', $data);
		$mrb_id = $this->db->insert_id();
		return $mrb_id;
	}

	function savePurge($data){

		$this->db->insert('qan_purge', $data);
	}

	function saveQASamplePurge($machine_breakdown_id,$qa_sample_affected_qty,$qa_sample_good_qty,$qa_sample_reject_qty){

		$data = array(
			'machine_breakdown_id' => $machine_breakdown_id,
			'qa_sample_affected_qty' => $qa_sample_affected_qty,
			'qa_sample_good_qty' => $qa_sample_good_qty,
			'qa_sample_reject_qty' => $qa_sample_reject_qty
		);
		
		$this->db->insert('qa_sample_mrb', $data);
	
	}

	function updateMaterialReviewBoardRecords($machine_breakdown_id,$scrap,$rework,$uai,$scrap_no,$rework_order_no,$uai_no,$rework_dispo_input,$rework_dispo_output,$rework_dispo_rej_scrap,$reportby_user_id,$qa_reinsp_status_accept,$qa_reinsp_status_reject,$reject_reason)
	{
	    $data = array(
			'scrap' => $scrap,
			'rework' => $rework,
			'uai' => $uai,
			'scrap_no' => $scrap_no,
			'rework_order_no' => $rework_order_no,
			'uai_no' => $uai_no,
			'rework_dispo_input' => $rework_dispo_input,
			'rework_dispo_output' => $rework_dispo_output,
			'rework_dispo_rej_scrap' => $rework_dispo_rej_scrap,
			'reportby_user_id' => $reportby_user_id,
			// 'qa_reinsp_verification_user_id' => $qa_reinsp_verification_user_id,
			'qa_reinsp_status_accept' => $qa_reinsp_status_accept,
			'qa_reinsp_status_reject' => $qa_reinsp_status_reject,
			'reject_reason' => $reject_reason
		);
		
		$this->db->where('machine_breakdown_id',$machine_breakdown_id);
		$this->db->update('qan_material_review_board', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function getMRB_ID($machine_breakdown_id){

		$this->db->select('mrb.id');
		$this->db->from('qan_material_review_board AS mrb'); 
		$this->db->join('qan_machinebreakdown AS m', 'm.id=mrb.machine_breakdown_id', 'left');
		$this->db->where('m.id',$machine_breakdown_id);
     
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

	// function updatePurgeRecords($machine_breakdown_id,$data)
	// {
	// 	echo $mrb_id = $this->getMRB_ID($machine_breakdown_id);
	// 	exit;
	// 	// $this->db->where('mrb_id',$mrb_id);
	// 	$this->db->where('purge_location_id',$purge_location_id);
	// 	$query = $this->db->get('qan_purge');
	// 	// echo $query = $this->db->get_compiled_select();
	// 	// exit;
	// 	$isExist = ($query->num_rows() > 0 ) ? TRUE: FALSE;
	// 	$this->db->reset_query();
	// 	// $this->db->where('mrb_id', $mrb_id);
	// 	$this->db->where('purge_location_id',$purge_location_id);
		
	// 	if ($isExist) 
	// 	{
	// 		$this->db->where('purge_location_id', $purge_location_id);
	// 		$this->db->update('qan_purge', $data);
	// 	}else{
	// 		if($data['affected_qty'] && $data['good_qty'] && $data['reject_qty'] > 0)
	// 		$this->db->insert('qan_purge', $data);
	// 	}
	// 		// print_r($query);
	// 		// exit;
	// 	$result_data = array($isExist);
	// 	$new_data = array();
	// 	$updated_id = 0;

	// 	// foreach($result_data AS $purge_location_id){
	// 	// 	foreach($new_data As $submit_id){
	// 	// 		if($db_id == $submit_id){
	// 	// 			$this->db->update($)
	// 	// 		}
	// 	// 	}
	// 	// }

	// }

	function updatePurgeRecords($machine_breakdown_id,$data)
	{
		$mrb_id = $this->getMRB_ID($machine_breakdown_id);
		
		// $this->db->from('qan_purge AS p');
		$this->db->where('mrb_id',$mrb_id);
		$this->db->delete('qan_purge');
		

		foreach($data as $location_data){
			$location_data['mrb_id'] = $mrb_id;
			$this->Function_materialreviewboard->savePurge($location_data);
		}
		
	}
		

	function updateQASampleRecords($machine_breakdown_id,$qa_sample_affected_qty,$qa_sample_good_qty,$qa_sample_reject_qty)
	{
	    $data = array(
			'qa_sample_affected_qty' => $qa_sample_affected_qty,
			'qa_sample_good_qty' => $qa_sample_good_qty,
			'qa_sample_reject_qty' => $qa_sample_reject_qty
		);

		$this->db->where('machine_breakdown_id',$machine_breakdown_id);
		$this->db->update('qa_sample_mrb', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function getTotalQASample($machine_breakdown_id){

		$this->db->select('sum(quantity) as Total');
		$this->db->from('qa_sample_records');
		$this->db->where('machine_breakdown_id',$machine_breakdown_id);
		
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
		s.qa_sample_id,s.quantity');
		$this->db->from('qan_machinebreakdown m'); 
		$this->db->join('qan_defect_info d', 'd.machine_breakdown_id=m.id', 'left');
		$this->db->join('qa_sample_records s', 's.machine_breakdown_id=m.id', 'left');
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

	function viewmaterialreviewboardrecords($machine_breakdown_id){
		
		$this->db->select('m.id AS machine_id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,m.issued_dept,m.to_dept,m.shift,m.ooc,m.oos,m.datetime,m.approval_user_id,m.machine_status,m.machine_stop_reason,m.purge_status,m.notify_next_process,m.fix_validation_result,m.closedby_user_id,
		d.part_name,d.machine_no,d.process,d.cav_no,d.up_affected,d.detectedby_user,d.defect_description,d.last_passed_sample,d.purge_from,d.estimate_qty,d.ack_eng_user,d.ack_prod_user,d.ack_qa_user,
		s.qa_sample_id,s.quantity AS samplequantity,
		pr.prod_id,pr.quantity AS prodquantity,
		mrb.scrap,mrb.rework,mrb.uai,mrb.scrap_no,mrb.rework_order_no,mrb.uai_no,mrb.rework_dispo_input,mrb.rework_dispo_output,mrb.rework_dispo_rej_scrap,mrb.reportby_user_id,mrb.qa_reinsp_verification_user_id,mrb.qa_reinsp_status_accept,mrb.qa_reinsp_status_reject,mrb.reject_reason,
		p.purge_location_id,p.affected_qty,p.good_qty,p.reject_qty,
		qasm.qa_sample_affected_qty,qasm.qa_sample_good_qty,qasm.qa_sample_reject_qty');
		$this->db->from('qan_machinebreakdown m'); 
		$this->db->join('qan_defect_info d', 'd.machine_breakdown_id=m.id', 'left');
		$this->db->join('qa_sample_records s', 's.machine_breakdown_id=m.id', 'left');
		$this->db->join('production_records pr', 'pr.machine_breakdown_id=m.id', 'left');
		$this->db->join('qan_material_review_board mrb', 'mrb.machine_breakdown_id=m.id', 'left');
		$this->db->join('qan_purge p', 'p.mrb_id=mrb.id', 'left');
		$this->db->join('qa_sample_mrb qasm', 'qasm.machine_breakdown_id=m.id', 'left');
		$this->db->where('m.id',$machine_breakdown_id);
		// $this->db->limit(1);
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

	function getUserById($id){

        $query=$this->db->query("select * from users where id='".$id."'");
		
		  if(count($query->result_array())){
			  $row = $query->result_array();
			  return $row[0]['fullname'];
		  }
		  return false;
	}

	function getPartNameById($id){

        $query=$this->db->query("select * from model_name where id='".$id."'");
		
		  if(count($query->result_array())){
			  $row = $query->result_array();
			  return $row[0]['part_name'];
		  }
		  return false;
	}

	function getProcessById($id){

        $query=$this->db->query("select * from purge_location where id='".$id."'");
		
		  if(count($query->result_array())){
			  $row = $query->result_array();
			  return $row[0]['process_name'];
		  }
		  return false;
	}

	function getPurgeLocation(){
		$query = $this->db->select('*')->from('purge_location')->get();
		return $query->result();
	}
	
	
}