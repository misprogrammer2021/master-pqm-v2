<?php
class Modal_create extends CI_Model{

    function get_next_qan_no($runtest=FALSE){

        $a=date("Y-m-d H:i:s");
		$b=date("y");
		
		if($runtest==TRUE)$test = 'TEST';
		else $test = '';
		// $LIKE = $b.$test.'%';
		$PRODLIKE = $b.'%';
		$TESTLIKE = $b.'TEST%';
		$this->db->select('qan_no');
		$this->db->from('qan_machinebreakdown');
		if($runtest==TRUE){
			$this->db->where('qan_no like \''.$TESTLIKE.'\'', NULL, FALSE);
		}else{
			$this->db->where('qan_no like \''.$PRODLIKE.'\'', NULL, FALSE);
			$this->db->where('qan_no NOT Like \''.$TESTLIKE.'\'', NULL, FALSE);
		}
		$this->db->order_by("id", "desc");
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 0) {
			$seq_no= '00001';
		} else {
			$row = $query->row(); 
			$last_qan_no = $row->qan_no;
		
			$qan_no_year = substr($last_qan_no, 0, 2);
			$seq_no = substr($last_qan_no, -5);
			if($qan_no_year == $b){
				$seq_no = sprintf('%05d', $seq_no+1);
			}else{
				$seq_no= '00001';
			}
		}
		$qan_no = $b.$test.$seq_no;
        return $qan_no;
    }

    function save_section1($data){
		echo "<!-- Example -->";
        // $data = new stdClass();
        // $data->issueby_user_id= 11;
        // $data->issueto_user=11;
        // $data->issued_dept= 'QA';
        // $data->to_dept= 'Production';
        // $data->datetime= '2019-04-10 13:05:00.000';
        // $data->shift= 'Day';
        // $data->ooc= 1;
        // $data->oos= 0;
        // $data->part_name = 17;
        // $data->machine_no = 1;
        // $data->process= 2;
        // $data->cav_no = '';
        // $data->up_affected = 0;
        // $data->detectedby_user = 22;
        // $data->defect_description = 'test1234';
        // $data->last_passed_sample = '2019-04-10 13:05:00.000';
        // $data->purge_from = '2019-04-10 13:06:00.000';
        // $data->estimate_qty = 0;
        // $data->ack_eng_user = 11;
        // $data->ack_prod_user = 12;
        // $data->ack_qa_user = 7;
        // $data->qasample_qty[0] = new stdClass();
        // $data->qasample_qty[0]->qa_sample_id = 1;
        // $data->qasample_qty[0]->samplequantity = 90;
        // $data->production_qty[0]=new stdClass();
        // $data->production_qty[0]->prod_id = 1;
        // $data->production_qty[0]->prodquantity = 90;
        // $data->production_qty[1]=new stdClass();
        // $data->production_qty[1]->prod_id = 2;
        // $data->production_qty[1]->prodquantity = 10;
        // $data->production_qty[2]=new stdClass();
        // $data->production_qty[2]->prod_id = 3;
        // $data->production_qty[2]->prodquantity = 10;

		$savetodb = array();
		
		if(isset($data->qan_no) and $data->qan_no != ''){

			$savetodb['status'] = '1';
			$savetodb['qan_no'] = $data->qan_no;
			$savetodb['datetime'] = date("Y-m-d H:i:s");
			if(isset($data->modified_date)) $savetodb['modified_date'] = $data->modified_date;
			if(isset($data->status)) $savetodb['status'] = $data->status;
			if(isset($data->issueby_user_id)) $savetodb['issueby_user_id'] = $data->issueby_user_id;
			if(isset($data->issueto_user)) $savetodb['issueto_user'] = $data->issueto_user;
			if(isset($data->issued_dept)) $savetodb['issued_dept'] = $data->issued_dept;
			if(isset($data->to_dept)) $savetodb['to_dept'] = $data->to_dept;
			if(isset($data->shift)) $savetodb['shift'] = $data->shift;
			if(isset($data->ooc)) $savetodb['ooc'] = $data->ooc;
			if(isset($data->oos)) $savetodb['oos'] = $data->oos;
			if(isset($data->visual)) $savetodb['visual'] = $data->visual;

			$data_table_qan_machinebreakdown = $savetodb;
			$this->db->insert('qan_machinebreakdown', $data_table_qan_machinebreakdown);
			$data->qan_id = $this->db->insert_id();
		}	

		if($data->qan_id > 0){

			$savetodb = array();
			
			if(isset($data->qan_id)) $savetodb['machine_breakdown_id'] = $data->qan_id;
			if(isset($data->part_name)) $savetodb['part_name'] = $data->part_name;
			if(isset($data->sector_id)) $savetodb['sector_id'] = $data->sector_id;
        	if(isset($data->machine_no_id)) $savetodb['machine_no_id'] = $data->machine_no_id;
			if(isset($data->process)) $savetodb['process'] = $data->process;
			if(isset($data->detectedby_user)) $savetodb['detectedby_user'] = $data->detectedby_user;
			if(isset($data->defect_description_id)) $savetodb['defect_description_id'] = $data->defect_description_id;
			if(isset($data->defect_description_id)) {
				$defect_list = @$this->modal_master->get_defect_desc($data->defect_description_id)[0];
				$defect_desc = $defect_list->defect_description_name;
				$savetodb['defect_description_name'] = $defect_desc;
			}
			if(isset($data->defect_description_others)) $savetodb['defect_description_others'] = $data->defect_description_others;
			if(isset($data->last_passed_sample)) $savetodb['last_passed_sample'] = $data->last_passed_sample;
			if(isset($data->purge_from)) $savetodb['purge_from'] = $data->purge_from;
			if(isset($data->estimate_qty)) $savetodb['estimate_qty'] = $data->estimate_qty;
			if(isset($data->ack_eng_user)) $savetodb['ack_eng_user'] = $data->ack_eng_user;
			if(isset($data->ack_eng_user)) $savetodb['ack_eng_user'] = $data->ack_eng_user;
			if(isset($data->ack_qa_user)) $savetodb['ack_qa_user'] = $data->ack_qa_user;

			$data_table_qan_defect_info = $savetodb;
			$this->db->insert('qan_defect_info', $data_table_qan_defect_info);

			if(is_array(@$data->qasample_qty) AND (count($data->qasample_qty) > 0)){
				foreach($data->qasample_qty as $i => $qasampleqty){
	
					//do not save 0 value
					if($qasampleqty->samplequantity<1) continue;

					$data_table_qa_sample_records = array(
						'qa_sample_id' => $qasampleqty->qa_sample_id,
						'machine_breakdown_id' => $data->qan_id,
						'quantity' => $qasampleqty->samplequantity
					);
					$this->db->insert('qa_sample_records', $data_table_qa_sample_records);
				}
			}

			$this->modal_update->update_qasample_mrb($data->qan_id);
			
			if(is_array(@$data->production_qty) AND (count($data->production_qty) > 0)){
				foreach($data->production_qty as $i => $prodqty){

					//do not save 0 value
					if($prodqty->prodquantity<1) continue;
					
					$data_table_production_records = array(

						'prod_id' => $prodqty->prod_id,
						'machine_breakdown_id' => $data->qan_id,
						'quantity' => $prodqty->prodquantity
					);   
					$this->db->insert('production_records', $data_table_production_records);    
				}
			}
		}
		
		return $data;
	}

    function save_section2($data){
		// $data = new stdClass();
		// $data->scrap= 1;
		// $data->rework= 1;
		// $data->uai= 0;
		// $data->scrap_no= 'test123';
		// $data->rework_order_no= 'test456';
		// $data->uai_no= '';
		// $data->rework_dispo_input= 'test456';
		// $data->rework_dispo_output= '';
		// $data->rework_dispo_rej_scrap= '';
		// $data->reportby_user_id= '';
		// $data->qa_reinsp_status_accept= 0;
		// $data->qa_reinsp_status_reject= 1;
		// $data->reject_reason= 'test';

		$savetodb = array();

		if(isset($data->qan_id)) $savetodb['machine_breakdown_id'] = $data->qan_id;
		if(isset($data->scrap)) $savetodb['scrap'] = $data->scrap;
		if(isset($data->rework)) $savetodb['rework'] = $data->rework;
		if(isset($data->uai)) $savetodb['uai'] = $data->uai;
		if(isset($data->scrap_no)) $savetodb['scrap_no'] = $data->scrap_no;
		if(isset($data->rework_order_no)) $savetodb['rework_order_no'] = $data->rework_order_no;
		if(isset($data->uai_no)) $savetodb['uai_no'] = $data->uai_no;
		if(isset($data->rework_dispo_input)) $savetodb['rework_dispo_input'] = $data->rework_dispo_input;
		if(isset($data->rework_dispo_output)) $savetodb['rework_dispo_output'] = $data->rework_dispo_output;
		if(isset($data->rework_dispo_rej_scrap)) $savetodb['rework_dispo_rej_scrap'] = $data->rework_dispo_reject;
		if(isset($data->reportby_user_id)) $savetodb['reportby_user_id'] = $data->reportby_user_id;
		if(isset($data->qa_reinsp_verification_user_id)) $savetodb['qa_reinsp_verification_user_id'] = $data->qa_reinsp_verification_user_id;
		if(isset($data->qa_reinsp_status_accept)) $savetodb['qa_reinsp_status_accept'] = $data->qa_reinsp_status_accept;
		if(isset($data->qa_reinsp_status_reject)) $savetodb['qa_reinsp_status_reject'] = $data->qa_reinsp_status_reject;
		if(isset($data->reject_reason)) $savetodb['reject_reason'] = $data->reject_reason;

		$data_table_qan_material_review_board = $savetodb;
		$this->db->insert('qan_material_review_board', $data_table_qan_material_review_board);
		$data->mrb_id = $this->db->insert_id();

		if(is_array(@$data->qan_purge) AND (count($data->qan_purge) > 0)){
			foreach($data->qan_purge as $qan_purge){
				
				if($qan_purge->affected_qty > 0){
					$data_table_qan_purge = array(
						'purge_location_id' => $qan_purge->purge_location_id,
						'mrb_id' => $data->mrb_id,
						'affected_qty' => $qan_purge->affected_qty,
						'good_qty' => $qan_purge->good_qty,
						'reject_qty' => $qan_purge->reject_qty,
						'prod_pic_user_id' => $qan_purge->prod_pic_user_id,
						'qa_buyoff_user_id' => $qan_purge->qa_buyoff_user_id
					);
					$this->db->insert('qan_purge', $data_table_qan_purge);
				}
			}
		}

		$this->modal_update->update_qasample_mrb($data->qan_id,$data->qa_sample_reject_qty);

		return $data;
	}

	function save_section3($data){
		// $data = new stdClass();
		// $data->root_cause= 'test';
		// $data->corrective_action= 'test';
		// $data->rcfa_pic_user_id= 12;
		// $data->rcfa_ack_user_id= 12;
		// $data->rcfa_appr_user_id= 0;
		// echo "<pre>";	
		// print_r($data);
		// exit;
		
		
		foreach($data->new_inspection_machine_data AS $qan_validation_submission){

			$savetodb = array();
			
			$savetodb['machine_breakdown_id'] = $data->qan_id;
			if(isset($qan_validation_submission->root_cause_id)) $savetodb['root_cause_id'] = $qan_validation_submission->root_cause_id;
			if(isset($qan_validation_submission->root_cause_id)) {
				$rootcause_list = $this->modal_master->get_rootcause($qan_validation_submission->root_cause_id);
				$rootcause = $rootcause_list->root_cause;
				$savetodb['root_cause'] = $rootcause;
			}

			if(isset($qan_validation_submission->corrective_action_id)) $savetodb['corrective_action_id'] = $qan_validation_submission->corrective_action_id;
			if(isset($qan_validation_submission->corrective_action_id)) {
				$corrective_list = $this->modal_master->get_corrective_action($qan_validation_submission->corrective_action_id);
				$corrective = $corrective_list->corrective_action;
				$savetodb['corrective_action'] = $corrective;
			}

			if(isset($qan_validation_submission->rcfa_pic_user_id)) $savetodb['rcfa_pic_user_id'] = $qan_validation_submission->rcfa_pic_user_id;
			if(isset($qan_validation_submission->rcfa_ack_user_id)) $savetodb['rcfa_ack_user_id'] = $qan_validation_submission->rcfa_ack_user_id;
			if(isset($qan_validation_submission->completion_user_id)) $savetodb['completion_user_id'] = $qan_validation_submission->completion_user_id;
			if(isset($qan_validation_submission->completion_datetime)) $savetodb['completion_datetime'] = $qan_validation_submission->completion_datetime;
			if(isset($qan_validation_submission->submission_no)) $savetodb['submission_no'] = $qan_validation_submission->submission_no;

			//override datetime
			$savetodb['completion_datetime'] = date("Y-m-d H:i:s");

			$data_table_qan_validation_submission = $savetodb;
			if($savetodb['root_cause_id'] != '' AND $savetodb['corrective_action_id'] != ''){
				$this->db->insert('qan_validation_submission', $data_table_qan_validation_submission);
				$data->validation_submission_id = $this->db->insert_id();
			}
		}

		if(is_array(@$data->inspection_result_data) AND (count($data->inspection_result_data) > 0)){

			$i = 0;
			foreach($data->inspection_result_data as $inspection_data){
				
				foreach($inspection_data as $validation_result){
				
					$data_table_qan_rootcause_item_inspection = array(
						'machine_breakdown_id' => $data->qan_id,
						'root_cause_submission_id' => $validation_result->root_cause_submission_id,
						'inspection_machine_id' => $validation_result->inspection_machine_id,
						'inspectby_user_id' => $validation_result->inspectby_user_id,
						'time_start' => $validation_result->time_start,
						'time_end' => $validation_result->time_end,
						'result' => $validation_result->result
					);
					$this->db->insert('qan_rootcause_item_inspection', $data_table_qan_rootcause_item_inspection);
	
				}
				$i++;
			}
		}
	}
}