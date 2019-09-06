<?php
class Modal_Update extends CI_Model
{
    function update_section1($data){

        // $data = new stdClass();
        // $data->to_dept = 'Production';
        // $data->datetime= '2019-04-10 13:05:00.000';
        // $data->shift = 'Day';
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
        // $data_table_qan_machinebreakdown = array
        if(isset($data->modified_date)) $savetodb['modified_date'] = $data->modified_date;
        if(isset($data->issueto_user)) $savetodb['issueto_user'] = $data->issueto_user;
        if(isset($data->to_dept)) $savetodb['to_dept'] = $data->to_dept;
        if(isset($data->shift)) $savetodb['shift'] = $data->shift;
        if(isset($data->ooc)) $savetodb['ooc'] = $data->ooc;
        if(isset($data->oos)) $savetodb['oos'] = $data->oos;
        if(isset($data->datetime)) $savetodb['datetime'] = $data->datetime;

        $data_table_qan_machinebreakdown = $savetodb;
        // $data_table_qan_machinebreakdown = array(
		// 	'modified_date' => $data->modified_date,
		// 	'to_dept' => $data->to_dept,
		// 	'shift' => $data->shift,
		// 	'ooc' => $data->ooc,
		// 	'oos' => $data->oos,
		// 	'datetime' => $data->datetime
        //   );
        // print_r($savetodb);
        // exit;
        if(count($data_table_qan_machinebreakdown) > 0){
            $this->db->where('id',$data->qan_id);
		    $this->db->update('qan_machinebreakdown', $data_table_qan_machinebreakdown);
        }
        
		
		// if ($this->db->affected_rows() > 0) {
		// 	return true;
		// }else{
		// 	return false;
        // }

        $savetodb = array();
        if(isset($data->part_name)) $savetodb['part_name'] = $data->part_name;
        if(isset($data->machine_no)) $savetodb['machine_no'] = $data->machine_no;
        if(isset($data->process)) $savetodb['process'] = $data->process;
        if(isset($data->cav_no)) $savetodb['cav_no'] = $data->cav_no;
        if(isset($data->up_affected)) $savetodb['up_affected'] = $data->up_affected;
        if(isset($data->detectedby_user)) $savetodb['detectedby_user'] = $data->detectedby_user;
        if(isset($data->defect_description)) $savetodb['defect_description'] = $data->defect_description;
        if(isset($data->last_passed_sample)) $savetodb['last_passed_sample'] = $data->last_passed_sample;
        if(isset($data->purge_from)) $savetodb['purge_from'] = $data->purge_from;

        if(isset($data->ack_eng_user)) $savetodb['ack_eng_user'] = $data->ack_eng_user;
        if(isset($data->ack_prod_user)) $savetodb['ack_prod_user'] = $data->ack_prod_user;
        if(isset($data->ack_qa_user)) $savetodb['ack_qa_user'] = $data->ack_qa_user;
        $data_table_qan_defect_info = $savetodb;

        // $data_table_qan_defect_info = array(
		// 	'part_name' => $data->part_name,
		// 	'machine_no' => $data->machine_no,
		// 	'process' => $data->process,
		// 	'cav_no' => $data->cav_no,
		// 	'up_affected' => $data->up_affected,
		// 	'detectedby_user' => $data->detectedby_user,
		// 	'defect_description' => $data->defect_description,
		// 	'last_passed_sample' => $data->last_passed_sample,
		// 	'purge_from' => $data->purge_from
        // );
        if(count($data_table_qan_defect_info) > 0){
            $this->db->where('machine_breakdown_id',$data->qan_id);
		    $this->db->update('qan_defect_info', $data_table_qan_defect_info);
        }
        
        
        // if ($this->db->affected_rows() > 0) {
		// 	return true;
		// }else{
		// 	return false;
        // }
        
        

        if(is_array(@$data->qasample_qty) AND (count($data->qasample_qty) > 0)){
            
            $this->db->where('machine_breakdown_id',$data->qan_id);
            $query = $this->db->get('qa_sample_records');
            $sampleid_array = array();
            if($query->num_rows() > 0 ){
                
                foreach($query->result_object() as $qasampleqty){
                    $sampleid_array[$qasampleqty->qa_sample_id] = new stdClass();
                    $sampleid_array[$qasampleqty->qa_sample_id]->action = 'delete';
                    $sampleid_array[$qasampleqty->qa_sample_id]->samplequantity = $qasampleqty->quantity;
                }
            }
            foreach($data->qasample_qty as $i => $qasampleqty){
                if($qasampleqty->samplequantity > 0){
                    if(array_key_exists($qasampleqty->qa_sample_id,$sampleid_array)){
                        $sampleid_array[$qasampleqty->qa_sample_id]->action = 'update';
                    }else{
                        $sampleid_array[$qasampleqty->qa_sample_id] = new stdClass();
                        $sampleid_array[$qasampleqty->qa_sample_id]->action = 'insert';
                    }
                    $sampleid_array[$qasampleqty->qa_sample_id]->samplequantity = $qasampleqty->samplequantity;
                }
            }

            if(is_array($sampleid_array) AND (count($sampleid_array) > 0)){
                foreach($sampleid_array as $qa_sample_id => $qasampleqty){
    
                    $data_table_qa_sample_records = array(
                        'qa_sample_id' => $qa_sample_id,
                        'machine_breakdown_id' => $data->qan_id,
                        'quantity' => $qasampleqty->samplequantity
                    );
                    
                    if ($qasampleqty->action=='update') 
                    {
                        unset($data_table_qa_sample_records['machine_breakdown_id']);
                        $this->db->where('qa_sample_id', $qa_sample_id);
                        $this->db->where('machine_breakdown_id', $data->qan_id);
                        $this->db->update('qa_sample_records', $data_table_qa_sample_records);
                    }
                    if ($qasampleqty->action=='delete'){
                        $this->db->where('qa_sample_id', $qa_sample_id);
                        $this->db->where('machine_breakdown_id', $data->qan_id);
                        $this->db->delete('qa_sample_records');
                    }
                    if ($qasampleqty->action=='insert'){
                        $this->db->insert('qa_sample_records', $data_table_qa_sample_records);
                    }
                }
            }
        }

        
        // if(is_array(@$data->production_qty) AND (count($data->production_qty) > 0)){

        //     $this->db->where('machine_breakdown_id',$data->qan_id);
        //     $query = $this->db->get('production_records');
        //     $prodid_array = array();
        //     if($query->num_rows() > 0 ){
                
        //         foreach($query->result_object() as $prodqty){
        //             $prodid_array[$prodqty->prod_id] = new stdClass();
        //             $prodid_array[$prodqty->prod_id]->action = 'delete';
        //             $prodid_array[$prodqty->prod_id]->prodquantity = $prodqty->quantity;
        //         }
        //     }

        //     foreach($data->production_qty as $i => $prodqty){
        //         if($prodqty->prodquantity > 0){
        //             if(array_key_exists($prodqty->prod_id,$prodid_array)){
        //                 $prodid_array[$prodqty->prod_id]->action = 'update';
        //             }else{
        //                 $prodid_array[$prodqty->prod_id] = new stdClass();
        //                 $prodid_array[$prodqty->prod_id]->action = 'insert';
        //             }
        //             $prodid_array[$prodqty->prod_id]->prodquantity = $prodqty->prodquantity;
        //         }
        //     }

        //     if(is_array($prodid_array) AND (count($prodid_array) > 0)){
        //         foreach($prodid_array as $prod_id => $prodqty){
    
        //             $data_table_production_records = array(
        //                 'prod_id' => $prod_id,
        //                 'machine_breakdown_id' => $data->qan_id,
        //                 'quantity' => $prodqty->prodquantity
        //             );
                    
        //             if ($prodqty->action=='update') 
        //             {
        //                 $this->db->where('prod_id', $prod_id);
        //                 $this->db->update('production_records', $data_table_production_records);
        //             }
        //             if($prodqty->action=='delete') {
        //                 $this->db->where('prod_id', $prod_id);
        //                 $this->db->delete('production_records', $data_table_production_records);
        //             }
        //             if($prodqty->action=='insert') {
        //                 $this->db->insert('production_records', $data_table_production_records);
        //             }
        //         }
        //     }
        // }

        // return $data;


    }

    function update_section2($data){
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

        if($data->update_disposition == 'enabled'){

            if(isset($data->scrap)){
                $savetodb['scrap'] = 1;
                if(isset($data->scrap_no)) $savetodb['scrap_no'] = $data->scrap_no;
            }else{
                $savetodb['scrap'] = 0;
                $savetodb['scrap_no'] = null;
            } 
            if(isset($data->rework)){
                $savetodb['rework'] = 1;
                if(isset($data->rework_order_no)) $savetodb['rework_order_no'] = $data->rework_order_no;
            }else{
                $savetodb['rework'] = 0;
                $savetodb['rework_order_no'] = null;
            }
            if(isset($data->uai)){
                $savetodb['uai'] = 1;
                if(isset($data->uai_no)) $savetodb['uai_no'] = $data->uai_no;
            }else{
                $savetodb['uai'] = 0;
                $savetodb['uai_no'] = null;
            }
            if(isset($data->rework_dispo_input)) $savetodb['rework_dispo_input'] = $data->rework_dispo_input;
            if(isset($data->rework_dispo_output)) $savetodb['rework_dispo_output'] = $data->rework_dispo_output;
            if(isset($data->rework_dispo_rej_scrap)) $savetodb['rework_dispo_rej_scrap'] = $data->rework_dispo_rej_scrap;
            
            if(isset($data->qa_reinsp_verification_user_id)) $savetodb['qa_reinsp_verification_user_id'] = $data->qa_reinsp_verification_user_id;
            if(isset($data->qa_reinsp_status_accept)) $savetodb['qa_reinsp_status_accept'] = $data->qa_reinsp_status_accept;
            if(isset($data->qa_reinsp_status_reject)) $savetodb['qa_reinsp_status_reject'] = $data->qa_reinsp_status_reject;
            if(isset($data->reject_reason)) $savetodb['reject_reason'] = $data->reject_reason;
        }

        if(isset($data->confirmation)) $savetodb['confirmation'] = $data->confirmation;
        if(isset($data->reportby_user_id)) $savetodb['reportby_user_id'] = $data->reportby_user_id;

        $data_table_qan_material_review_board = $savetodb;

        if(count($data_table_qan_material_review_board) > 0){
            $this->db->where('machine_breakdown_id',$data->qan_id);
		    $this->db->update('qan_material_review_board', $data_table_qan_material_review_board);
        }

        //get mrb id first
        $this->db->select('id');
		$this->db->from('qan_material_review_board'); 
        $this->db->where('machine_breakdown_id',$data->qan_id);
        // $this->db->order_by("mrb_id", "desc");
        $query = $this->db->get(); 
        $result = $query->result_object();
        $data->mrb_id = $result[0]->id;

        if(is_array(@$data->qan_purge) AND (count($data->qan_purge) > 0)){

            $this->db->where('mrb_id',$data->mrb_id);
            $query = $this->db->get('qan_purge');
            $loc_purgeid_array = array();
            if($query->num_rows() > 0 ){
                
                foreach($query->result_object() as $qan_purge){
                    $loc_purgeid_array[$qan_purge->purge_location_id] = new stdClass();
                    $loc_purgeid_array[$qan_purge->purge_location_id]->action = 'delete';
                }
            }

                        
            foreach($data->qan_purge as $qan_purge){
                if($qan_purge->affected_qty > 0){
                    if(array_key_exists($qan_purge->purge_location_id,$loc_purgeid_array)){
                        $loc_purgeid_array[$qan_purge->purge_location_id]->action = 'update';
                    }else{
                        $loc_purgeid_array[$qan_purge->purge_location_id] = new stdClass();
                        $loc_purgeid_array[$qan_purge->purge_location_id]->action = 'insert';
                    }
                    $loc_purgeid_array[$qan_purge->purge_location_id]->affected_qty = $qan_purge->affected_qty;
                    $loc_purgeid_array[$qan_purge->purge_location_id]->good_qty = $qan_purge->good_qty;
                    $loc_purgeid_array[$qan_purge->purge_location_id]->reject_qty = $qan_purge->reject_qty;
                    $loc_purgeid_array[$qan_purge->purge_location_id]->prod_pic_user_id = $qan_purge->prod_pic_user_id;
                    $loc_purgeid_array[$qan_purge->purge_location_id]->qa_buyoff_user_id = $qan_purge->qa_buyoff_user_id;
                }
            }
        }
        //print_r($qan_purge);exit;
        
        if(is_array($loc_purgeid_array) AND (count($loc_purgeid_array) > 0)){
			foreach($loc_purgeid_array as $purge_location_id => $qan_purge){

                if($qan_purge->action=='delete') {
                    $this->db->where('purge_location_id', $purge_location_id);
                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->delete('qan_purge');
                    // echo $query = $this->db->get_compiled_select();
                    // exit;
                    $this->update_mrb_confirmation($data->qan_id,0);
                    continue;
                }

                $data_table_qan_purge = array(
					'purge_location_id' => $purge_location_id,
					'mrb_id' => $data->mrb_id,
					'affected_qty' => $qan_purge->affected_qty,
                    'good_qty' => $qan_purge->good_qty,
                    'reject_qty' => $qan_purge->reject_qty,
                    'prod_pic_user_id' => $qan_purge->prod_pic_user_id,
                    'qa_buyoff_user_id' => $qan_purge->qa_buyoff_user_id
                );
                
                if ($qan_purge->action=='update') 
                {
                    $this->db->where('purge_location_id', $purge_location_id);
                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->update('qan_purge', $data_table_qan_purge);
                }
                
                if($qan_purge->action=='insert') {
                    $this->db->insert('qan_purge', $data_table_qan_purge);
                    $this->update_mrb_confirmation($data->qan_id,0);
                }
            }
            
        }
        

    }

    function update_section3($data){
        
        // echo '<pre>';
        if(count($data->inspection_machine_data)>0){
            foreach($data->inspection_machine_data AS $qan_validation_submission){
                $savetodb = array();
                if(isset($qan_validation_submission->root_cause)) $savetodb['root_cause'] = $qan_validation_submission->root_cause;
                if(isset($qan_validation_submission->corrective_action)) $savetodb['corrective_action'] = $qan_validation_submission->corrective_action;
                if(isset($qan_validation_submission->rcfa_pic_user_id)) $savetodb['rcfa_pic_user_id'] = $qan_validation_submission->rcfa_pic_user_id;
                if(isset($qan_validation_submission->rcfa_ack_user_id)) $savetodb['rcfa_ack_user_id'] = $qan_validation_submission->rcfa_ack_user_id;
                if(isset($qan_validation_submission->rcfa_appr_user_id)) $savetodb['rcfa_appr_user_id'] = $qan_validation_submission->rcfa_appr_user_id;
                if(isset($qan_validation_submission->completion_user_id)) $savetodb['completion_user_id'] = $qan_validation_submission->completion_user_id;
                if(isset($qan_validation_submission->completion_datetime)) $savetodb['completion_datetime'] = $qan_validation_submission->completion_datetime;
                if(isset($qan_validation_submission->submission_no)) $savetodb['submission_no'] = $qan_validation_submission->submission_no;
                //if(isset($qan_validation_submission->submission_id)) $savetodb['submission_id'] = $qan_validation_submission->submission_id;

                //override datetime
                //$savetodb['completion_datetime'] = date("Y-m-d H:i:s");
                
                $data_table_qan_validation_submission = $savetodb;
                $this->db->where('id', $qan_validation_submission->submission_id);
                $this->db->where('machine_breakdown_id', $data->qan_id);
                $this->db->update('qan_validation_submission', $data_table_qan_validation_submission);
                
                // print_r($savetodb);

                if(is_array(@$qan_validation_submission->inspection_data) AND (count($qan_validation_submission->inspection_data) > 0)){
                    foreach($qan_validation_submission->inspection_data as $inspection_data){
                        
                        $data_table_qan_rootcause_item_inspection = array(
                            'inspection_machine_id' => $inspection_data->inspection_machine_id,
                            'inspectby_user_id' => $inspection_data->inspectby_user_id,
                            'time_start' => $inspection_data->time_start,
                            'time_end' => $inspection_data->time_end,
                            'result' => $inspection_data->result
                        );
                        $this->db->where('machine_breakdown_id', $data->qan_id);
                        $this->db->where('root_cause_submission_id', $qan_validation_submission->submission_id);
                        $this->db->update('qan_rootcause_item_inspection', $data_table_qan_rootcause_item_inspection);
        
                    }
                }
            }

            // exit;
        }
    }

    function update_section4($data){
		// $data = new stdClass();
		// $data->approval_user_id= '2';
		// $data->machine_status= 'test';
		// $data->machine_stop_reason= 12;

		$savetodb = array();
		// if(isset($data->qan_id)) $savetodb['id'] = $data->qan_id;
		if(isset($data->approval_user_id)) $savetodb['approval_user_id'] = $data->approval_user_id;
		if(isset($data->machine_status)) $savetodb['machine_status'] = $data->machine_status;
		if(isset($data->machine_stop_reason)) $savetodb['machine_stop_reason'] = $data->machine_status==0?$data->machine_stop_reason:null;
        $data_table_qan_machinebreakdown = $savetodb;

        if(count($data_table_qan_machinebreakdown) > 0){
            $this->db->where('id',$data->qan_id);
		    $this->db->update('qan_machinebreakdown', $data_table_qan_machinebreakdown);
        }
    }
    
    function update_section5($data){
		// $data = new stdClass();
		// $data->purge_status= 'test';
		// $data->notify_next_process= 'test';
        // $data->fix_validation_result= 12;
        // $data->closedby_user_id= 12;
        

		$savetodb = array();
		//if(isset($data->qan_id)) $savetodb['id'] = $data->qan_id;
		if(isset($data->purge_status)) $savetodb['purge_status'] = $data->purge_status;
		if(isset($data->notify_next_process)) $savetodb['notify_next_process'] = $data->notify_next_process;
        if(isset($data->fix_validation_result)) $savetodb['fix_validation_result'] = $data->fix_validation_result;
        if(isset($data->closedby_user_id)) $savetodb['closedby_user_id'] = $data->closedby_user_id;
        $savetodb['closed_datetime'] = date("Y-m-d H:i:s");
        $data_table_qan_machinebreakdown = $savetodb;

        if(count($data_table_qan_machinebreakdown) > 0){
            $this->db->where('id',$data->qan_id);
		    $this->db->update('qan_machinebreakdown', $data_table_qan_machinebreakdown);
        }


    }
    
    function update_status($qan_id,$status_code,$from_code=0){

        if($qan_id > 0 and $status_code!=''){

            $this->db->where('id',$qan_id);
            if($from_code != 0) 
                $this->db->where('status',$from_code);
            $this->db->update('qan_machinebreakdown', array('status'=>$status_code) );

        }

    }

    function update_mrb_confirmation($qan_id,$value=0){

        if($qan_id > 0){
            $this->db->where('machine_breakdown_id',$qan_id);
            $this->db->update('qan_material_review_board', array('confirmation'=>$value) );
        }

    }

    function update_qasample_mrb($qan_id=0,$reject_qty=false){

        $data = array();
        
        if($qan_id>0){
            
            $result = $this->modal_master->get_qasample_records($qan_id);
            $data['qa_sample_affected_qty'] = $result['total_qty'];

            if($reject_qty!=false){
                //$data['qa_sample_reject_qty'] = $result['qa_sample_reject_qty'];
                $data['qa_sample_reject_qty'] = $reject_qty;
                $data['qa_sample_good_qty'] = $data['qa_sample_affected_qty'] - $data['qa_sample_reject_qty'];
            }else{
                $data['qa_sample_good_qty'] = $result['total_qty'] - $result['qa_sample_reject_qty'];
            }

            
            if($result['mrb_exist']===false){
                $data['machine_breakdown_id'] = $qan_id;
                $this->db->insert('qa_sample_mrb', $data );
            }
            else{
                $this->db->where('machine_breakdown_id',$qan_id);
                $this->db->update('qa_sample_mrb', $data );
            }
        }

        return $data;
    }

}