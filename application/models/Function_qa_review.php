<?php
class Function_qa_review extends CI_Model 
{
    function saveForQAOnlyRecords($machine_breakdown_id,$approval_user_id,$machine_status,$machine_stop_reason){
        
        $data = array(

			'approval_user_id' => $approval_user_id,
			'machine_status' => $machine_status,
			'machine_stop_reason' => $machine_stop_reason
		);

		$this->db->where('id',$machine_breakdown_id);
		$this->db->update('qan_machinebreakdown', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function saveReviewByQARecords($machine_breakdown_id,$purge_status,$notify_next_process,$fix_validation_result,$closedby_user_id){
        
        $data = array(

			'purge_status' => $purge_status,
            'notify_next_process' => $notify_next_process,
            'fix_validation_result'=> $fix_validation_result,
            'closedby_user_id'=> $closedby_user_id
		);

		$this->db->where('id',$machine_breakdown_id);
		$this->db->update('qan_machinebreakdown', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function displayListNewStatusForm()
	{
	    $query=$this->db->query("select * from qan_machinebreakdown");
	    return $query->result();
	}
}