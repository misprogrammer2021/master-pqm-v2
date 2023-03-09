<?php

class Modal_update extends CI_Model{

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

        if(isset($data->modified_date)) $savetodb['modified_date'] = $data->modified_date;
        if(isset($data->issueto_user)) $savetodb['issueto_user'] = $data->issueto_user;
        if(isset($data->issued_dept)) $savetodb['issued_dept'] = $data->issued_dept;
        if(isset($data->to_dept)) $savetodb['to_dept'] = $data->to_dept;
        if(isset($data->shift)) $savetodb['shift'] = $data->shift;
        if(isset($data->rule_name)) $savetodb['rule_name'] = $data->rule_name;
        // if(isset($data->ooc)) $savetodb['ooc'] = $data->ooc;
        // if(isset($data->oos)) $savetodb['oos'] = $data->oos;
        // if(isset($data->visual)) $savetodb['visual'] = $data->visual;
        if(isset($data->datetime)) $savetodb['datetime'] = $data->datetime;

        $data_table_qan_machinebreakdown = $savetodb;
    
        if(count($data_table_qan_machinebreakdown) > 0){

            $this->db->where('id',$data->qan_id);
		    $this->db->update('qan_machinebreakdown', $data_table_qan_machinebreakdown);
        }

        $savetodb = array();
        
        if(isset($data->part_name)) $savetodb['part_name'] = $data->part_name;
        if(isset($data->machine_no_id)) $savetodb['machine_no_id'] = $data->machine_no_id;
        if(isset($data->process)) $savetodb['process'] = $data->process;
        if(isset($data->detectedby_user)) $savetodb['detectedby_user'] = $data->detectedby_user;


        // if(isset($data->defect_description_id_1)) $savetodb['defect_description_id_1'] = $data->defect_description_id_1;
        // if(isset($data->defect_description_id_2)) $savetodb['defect_description_id_2'] = $data->defect_description_id_2;
        // if(isset($data->defect_description_id_3)) $savetodb['defect_description_id_3'] = $data->defect_description_id_3;
        // if(isset($data->defect_description_id_4)) $savetodb['defect_description_id_4'] = $data->defect_description_id_4;
        // if(isset($data->defect_description_id_5)) $savetodb['defect_description_id_3'] = $data->defect_description_id_5;

        /*
        if(isset($data->defect_description_id_1)) $savetodb['defect_description_id_1'] = $data->defect_description_id_1;
        if(isset($data->defect_description_id_1)) {
            $defect_list1 = @$this->modal_master->get_defect_desc1($data->defect_description_id_1); //get_defect_desc  //get_defects
            @$defect_desc1 = $defect_list1->defect_description_name;
            $savetodb['defect_description_name_1'] = $defect_desc1;
        }
            
        if(isset($data->defect_description_id_2)) $savetodb['defect_description_id_2'] = $data->defect_description_id_2;
        if(isset($data->defect_description_id_2)) {
            $defect_list2 = @$this->modal_master->get_defect_desc1($data->defect_description_id_2);
            @$defect_desc2 = $defect_list2->defect_description_name;
            $savetodb['defect_description_name_2'] = $defect_desc2;
        }
			
        if(isset($data->defect_description_id_3)) $savetodb['defect_description_id_3'] = $data->defect_description_id_3;
        if(isset($data->defect_description_id_3)) {
            $defect_list3 = @$this->modal_master->get_defect_desc1($data->defect_description_id_3);
            @$defect_desc3 = $defect_list3->defect_description_name;
            $savetodb['defect_description_name_3'] = $defect_desc3;
        }

        if(isset($data->defect_description_id_4)) $savetodb['defect_description_id_4'] = $data->defect_description_id_4;
        if(isset($data->defect_description_id_4)) {
            $defect_list4 = @$this->modal_master->get_defect_desc1($data->defect_description_id_4);
            @$defect_desc4 = $defect_list4->defect_description_name;
            $savetodb['defect_description_name_4'] = $defect_desc4;
        }

        if(isset($data->defect_description_id_5)) $savetodb['defect_description_id_5'] = $data->defect_description_id_5;
        if(isset($data->defect_description_id_5)) {
            $defect_list5 = @$this->modal_master->get_defect_desc1($data->defect_description_id_5);
            @$defect_desc5 = $defect_list5->defect_description_name;
            $savetodb['defect_description_name_5'] = $defect_desc5;
        }
        */

        /*
        if(isset($data->defect_description_others_1)) $savetodb['defect_description_others_1'] = $data->defect_description_others_1;
        if(isset($data->defect_description_others_2)) $savetodb['defect_description_others_2'] = $data->defect_description_others_2;
        if(isset($data->defect_description_others_3)) $savetodb['defect_description_others_3'] = $data->defect_description_others_3;
        if(isset($data->defect_description_others_4)) $savetodb['defect_description_others_4'] = $data->defect_description_others_4;
        if(isset($data->defect_description_others_5)) $savetodb['defect_description_others_5'] = $data->defect_description_others_5;
        */

        if(isset($data->last_passed_sample)) $savetodb['last_passed_sample'] = $data->last_passed_sample;
        if(isset($data->purge_from)) $savetodb['purge_from'] = $data->purge_from;
        if(isset($data->ack_eng_user)) $savetodb['ack_eng_user'] = $data->ack_eng_user;
        if(isset($data->ack_prod_user)) $savetodb['ack_prod_user'] = $data->ack_prod_user;
        if(isset($data->ack_qa_user)) $savetodb['ack_qa_user'] = $data->ack_qa_user;
        
        $data_table_qan_defect_info = $savetodb;

        if(count($data_table_qan_defect_info) > 0){

            $this->db->where('machine_breakdown_id',$data->qan_id);
		    $this->db->update('qan_defect_info', $data_table_qan_defect_info);
        }

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

        if(is_array(@$data->qan_defect_description) AND (count($data->qan_defect_description) > 0)){

            $this->db->where('machine_breakdown_id',$data->qan_id);
            $query = $this->db->get('qan_defect_description');
            $defect_array = array();

            if($query->num_rows() > 0 ){
                
                foreach($query->result_object() as $qan_defect_description){
                    
                    $defect_array[$qan_defect_description->machine_breakdown_id] = new stdClass();
                    $defect_array[$qan_defect_description->machine_breakdown_id]->action = 'delete';
                }
            }
     
            foreach($data->qan_defect_description as $qan_defect_description){
                
                if($qan_defect_description->defect_description_id > 0 OR $qan_defect_description->defect_description_others > 0 OR $qan_defect_description->os_us_id > 0 OR $qan_defect_description->datum_id > 0 OR $qan_defect_description->remarks_id > 0){

                    if(array_key_exists($qan_defect_description->defect_description_id,$defect_array)){
        
                        $defect_array[$qan_defect_description->defect_description_id]->action = 'update';

                    }else{

                        $defect_array[$qan_defect_description->defect_description_id] = new stdClass();
                        $defect_array[$qan_defect_description->defect_description_id]->action = 'insert';
                    }
                    $defect_array[$qan_defect_description->defect_description_id]->defect_description_id = $qan_defect_description->defect_description_id;
                    $defect_array[$qan_defect_description->defect_description_id]->defect_description_others = $qan_defect_description->defect_description_others;
                    $defect_array[$qan_defect_description->defect_description_id]->os_us_id = $qan_defect_description->os_us_id;
                    $defect_array[$qan_defect_description->defect_description_id]->datum_id = $qan_defect_description->datum_id;
                    $defect_array[$qan_defect_description->defect_description_id]->remarks_id = $qan_defect_description->remarks_id;
                }
            }
        }

        if(is_array($defect_array) AND (count($defect_array) > 0)){

			foreach($defect_array as $qan_defect_description){

                if($qan_defect_description->action=='delete') {

                    $this->db->where('machine_breakdown_id', $data->qan_id);
                    $this->db->delete('qan_defect_description');
                    continue;
                }

                $data_table_qan_defect_description = array(

					'machine_breakdown_id' => $data->qan_id,
                    'defect_description_id' => $qan_defect_description->defect_description_id,
                    'defect_description_others' => $qan_defect_description->defect_description_others,
                    'os_us_id' => $qan_defect_description->os_us_id,
                    'datum_id' => $qan_defect_description->datum_id,
                    'remarks_id' => $qan_defect_description->remarks_id
                );
                
                if($qan_defect_description->action=='update') {

                    $this->db->where('machine_breakdown_id', $data->qan_id);
                    $this->db->update('qan_defect_description', $data_table_qan_defect_description);
                }
                
                if($qan_defect_description->action=='insert') {

                    $this->db->insert('qan_defect_description', $data_table_qan_defect_description);
                }
            }
        }
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
        if(isset($data->washing)) $savetodb['washing'] = $data->washing;
        if(isset($data->brushing)) $savetodb['brushing'] = $data->brushing;
        if(isset($data->vmi)) $savetodb['vmi'] = $data->vmi;

        $data_table_qan_material_review_board = $savetodb;

        if(count($data_table_qan_material_review_board) > 0){
            $this->db->where('machine_breakdown_id',$data->qan_id);
		    $this->db->update('qan_material_review_board', $data_table_qan_material_review_board);
        }

        //get mrb id first
        $this->db->select('id');
		$this->db->from('qan_material_review_board'); 
        $this->db->where('machine_breakdown_id',$data->qan_id);
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
        
        if(is_array($loc_purgeid_array) AND (count($loc_purgeid_array) > 0)){

			foreach($loc_purgeid_array as $purge_location_id => $qan_purge){

                if($qan_purge->action=='delete') {

                    $this->db->where('purge_location_id', $purge_location_id);
                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->delete('qan_purge');
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
                
                if($qan_purge->action=='update') {

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

        if(is_array(@$data->qan_on_hold_sublot) AND (count($data->qan_on_hold_sublot) > 0)){

            // echo '<pre>';
            // print_r(@$data->qan_on_hold_sublot);
            // echo '</pre>';
            // exit;

            $this->db->where('mrb_id',$data->mrb_id);
            $query = $this->db->get('qan_on_hold_sublot');
            // $query_result = $query->result_object();
            // echo '<pre>';
            // print_r($query_result);
            // echo '</pre>';
            // exit;
            $sublot_array = array();

            if($query->num_rows() > 0 ){
                
                foreach($query->result_object() as $qan_on_hold_sublot){

                    // echo '<pre>';
                    // print_r($qan_on_hold_sublot);
                    // echo '</pre>';
                    // exit;
                    
                    $sublot_array[$qan_on_hold_sublot->mrb_id] = new stdClass();
                    $sublot_array[$qan_on_hold_sublot->mrb_id]->action = 'delete';
                }
            }
     
            foreach($data->qan_on_hold_sublot as $qan_on_hold_sublot){
                
                // echo '<pre>';
                // print_r($qan_on_hold_sublot);
                // echo '</pre>';
                // exit;
                
                if($qan_on_hold_sublot->sublot_no > 0 OR $qan_on_hold_sublot->qty_sublot_no > 0 OR $qan_on_hold_sublot->sorting_reject_qty > 0){

                    if(array_key_exists($qan_on_hold_sublot->sublot_no,$sublot_array)){
                        // echo '<pre>';
                        // print_r($qan_on_hold_sublot->sublot_no);
                        // echo '</pre>';
                        // exit;
                        $sublot_array[$qan_on_hold_sublot->sublot_no]->action = 'update';
                    }else{
                        $sublot_array[$qan_on_hold_sublot->sublot_no] = new stdClass();
                        $sublot_array[$qan_on_hold_sublot->sublot_no]->action = 'insert';
                        // echo '<pre>';
                        // print_r($sublot_array);
                        // echo '</pre>';
                        // exit;
                    }
                    // echo '<pre>';
                    // print_r($sublot_array);
                    // echo '</pre>';
                    // exit;
                    $sublot_array[$qan_on_hold_sublot->sublot_no]->sublot_no = $qan_on_hold_sublot->sublot_no;
                    $sublot_array[$qan_on_hold_sublot->sublot_no]->qty_sublot_no = $qan_on_hold_sublot->qty_sublot_no;
                    $sublot_array[$qan_on_hold_sublot->sublot_no]->sorting_good_qty = $qan_on_hold_sublot->sorting_good_qty;
                    $sublot_array[$qan_on_hold_sublot->sublot_no]->sorting_reject_qty = $qan_on_hold_sublot->sorting_reject_qty;
                    $sublot_array[$qan_on_hold_sublot->sublot_no]->sublotprod_pic_user_id = $qan_on_hold_sublot->sublotprod_pic_user_id;
                }
            }
        }

        if(is_array($sublot_array) AND (count($sublot_array) > 0)){

			foreach($sublot_array as $qan_on_hold_sublot){

                if($qan_on_hold_sublot->action=='delete') {

                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->delete('qan_on_hold_sublot');
                    // $this->update_mrb_confirmation($data->qan_id,0);
                    continue;
                }

                $data_table_qan_on_hold_sublot = array(

					'mrb_id' => $data->mrb_id,
                    'sublot_no' => $qan_on_hold_sublot->sublot_no,
                    'qty_sublot_no' => $qan_on_hold_sublot->qty_sublot_no,
                    'sorting_good_qty' => $qan_on_hold_sublot->sorting_good_qty,
                    'sorting_reject_qty' => $qan_on_hold_sublot->sorting_reject_qty,
                    'sublotprod_pic_user_id' => $qan_on_hold_sublot->sublotprod_pic_user_id
                );
                
                if($qan_on_hold_sublot->action=='update') {

                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->update('qan_on_hold_sublot', $data_table_qan_on_hold_sublot);
                }
                
                if($qan_on_hold_sublot->action=='insert') {

                    $this->db->insert('qan_on_hold_sublot', $data_table_qan_on_hold_sublot);
                    // $this->update_mrb_confirmation($data->qan_id,0);
                }
            }
        }

        if(is_array(@$data->qan_qa_buy_off) AND (count($data->qan_qa_buy_off) > 0)){

            $this->db->where('mrb_id',$data->mrb_id);
            $query = $this->db->get('qan_qa_buy_off');
            $buyoff_array = array();

            if($query->num_rows() > 0 ){
                
                foreach($query->result_object() as $qan_qa_buy_off){

                    $buyoff_array[$qan_qa_buy_off->mrb_id] = new stdClass();
                    $buyoff_array[$qan_qa_buy_off->mrb_id]->action = 'delete';
                }
            }
     
            foreach($data->qan_qa_buy_off as $qan_qa_buy_off){
                
                if($qan_qa_buy_off->qty_buyoff > 0 OR $qan_qa_buy_off->sorting_good_qty > 0 OR $qan_qa_buy_off->sorting_ooc_qty > 0 OR $qan_qa_buy_off->sorting_oos_qty > 0){

                    if(array_key_exists($qan_qa_buy_off->qty_buyoff,$buyoff_array)){
                        $buyoff_array[$qan_qa_buy_off->qty_buyoff]->action = 'update';
                    }else{
                        $buyoff_array[$qan_qa_buy_off->qty_buyoff] = new stdClass();
                        $buyoff_array[$qan_qa_buy_off->qty_buyoff]->action = 'insert';
                    }
                    $buyoff_array[$qan_qa_buy_off->qty_buyoff]->qty_buyoff = $qan_qa_buy_off->qty_buyoff;
                    $buyoff_array[$qan_qa_buy_off->qty_buyoff]->sorting_good_qty = $qan_qa_buy_off->sorting_good_qty;
                    $buyoff_array[$qan_qa_buy_off->qty_buyoff]->sorting_ooc_qty = $qan_qa_buy_off->sorting_ooc_qty;
                    $buyoff_array[$qan_qa_buy_off->qty_buyoff]->sorting_oos_qty = $qan_qa_buy_off->sorting_oos_qty;
                    $buyoff_array[$qan_qa_buy_off->qty_buyoff]->qa_pic_user_id = $qan_qa_buy_off->qa_pic_user_id;
                }
            }
        }

        if(is_array($buyoff_array) AND (count($buyoff_array) > 0)){

			foreach($buyoff_array as $qan_qa_buy_off){

                if($qan_qa_buy_off->action=='delete') {

                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->delete('qan_qa_buy_off');
                    // $this->update_mrb_confirmation($data->qan_id,0);
                    continue;
                }

                $data_table_qan_qa_buy_off = array(

					'mrb_id' => $data->mrb_id,
                    'qty_buyoff' => $qan_qa_buy_off->qty_buyoff,
                    'sorting_good_qty' => $qan_qa_buy_off->sorting_good_qty,
                    'sorting_ooc_qty' => $qan_qa_buy_off->sorting_ooc_qty,
                    'sorting_oos_qty' => $qan_qa_buy_off->sorting_oos_qty,
                    'qa_pic_user_id' => $qan_qa_buy_off->qa_pic_user_id
                );
                
                if($qan_qa_buy_off->action=='update') {

                    $this->db->where('mrb_id', $data->mrb_id);
                    $this->db->update('qan_qa_buy_off', $data_table_qan_qa_buy_off);
                }
                
                if($qan_qa_buy_off->action=='insert') {

                    $this->db->insert('qan_qa_buy_off', $data_table_qan_qa_buy_off);
                    // $this->update_mrb_confirmation($data->qan_id,0);
                }
            }
        }
    }

    function update_section3($data){
        
        if(count($data->inspection_machine_data)>0){

            foreach($data->inspection_machine_data AS $qan_validation_submission){

                $savetodb = array();

                if(isset($qan_validation_submission->root_cause_id)) $savetodb['root_cause_id'] = $qan_validation_submission->root_cause_id;
                // if(isset($qan_validation_submission->root_cause_id)) {
                //     $rootcause_list = $this->modal_master->get_rootcause($qan_validation_submission->root_cause_id);
                //     $rootcause = $rootcause_list->root_cause;
                //     $savetodb['root_cause'] = $rootcause;
                // }
                
                if(isset($qan_validation_submission->corrective_action_id)) $savetodb['corrective_action_id'] = $qan_validation_submission->corrective_action_id;
                // if(isset($qan_validation_submission->corrective_action_id)) {
                //     $corrective_list = $this->modal_master->get_corrective_action($qan_validation_submission->corrective_action_id);
                //     $corrective = $corrective_list->corrective_action;
                //     $savetodb['corrective_action'] = $corrective;
                // }
                    
                if(isset($qan_validation_submission->others_corrective_action)) $savetodb['others_corrective_action'] = $qan_validation_submission->others_corrective_action;
                // if(isset($qan_validation_submission->rcfa_pic_user_id)) $savetodb['rcfa_pic_user_id'] = $qan_validation_submission->rcfa_pic_user_id;
                if(isset($qan_validation_submission->rcfa_ack_user_id)) $savetodb['rcfa_ack_user_id'] = $qan_validation_submission->rcfa_ack_user_id;
                if(isset($qan_validation_submission->completion_user_id)) $savetodb['completion_user_id'] = $qan_validation_submission->completion_user_id;
                if(isset($qan_validation_submission->completion_datetime)) $savetodb['completion_datetime'] = $qan_validation_submission->completion_datetime;
                if(isset($qan_validation_submission->submission_no)) $savetodb['submission_no'] = $qan_validation_submission->submission_no;
                if(isset($qan_validation_submission->remarks)) $savetodb['remarks'] = $qan_validation_submission->remarks;
                if(isset($qan_validation_submission->approval_user_id)) $savetodb['approval_user_id'] = $qan_validation_submission->approval_user_id;
                if(isset($qan_validation_submission->machine_status)) $savetodb['machine_status'] = $qan_validation_submission->machine_status;
                if(isset($qan_validation_submission->machine_stop_reason)) $savetodb['machine_stop_reason'] = $qan_validation_submission->machine_status==0?$qan_validation_submission->machine_stop_reason:null;

                //override datetime                
                $data_table_qan_validation_submission = $savetodb;
                $this->db->where('id', $qan_validation_submission->submission_id);
                $this->db->where('machine_breakdown_id', $data->qan_id);
                $this->db->update('qan_validation_submission', $data_table_qan_validation_submission);
                
                if(is_array(@$qan_validation_submission->inspection_data) AND (count($qan_validation_submission->inspection_data) > 0))
                {
                    foreach($qan_validation_submission->inspection_data as $inspection_data){

                        $inspection_data->time_start = date("Y-m-d H:i:s");
                        
                        $data_table_qan_rootcause_item_inspection = array(

                            'inspection_machine_id' => $inspection_data->inspection_machine_id,
                            'inspectby_user_id' => $inspection_data->inspectby_user_id,
                            'time_start' => $inspection_data->time_start,
                            // 'time_end' => $inspection_data->time_end,
                            'result' => $inspection_data->result
                        );
                        $this->db->where('machine_breakdown_id', $data->qan_id);
                        $this->db->where('root_cause_submission_id', $qan_validation_submission->submission_id);
                        $this->db->update('qan_rootcause_item_inspection', $data_table_qan_rootcause_item_inspection);
        
                    }
                }
            }
        }
    }

    function update_section4($data){
		// $data = new stdClass();
		// $data->approval_user_id= '2';
		// $data->machine_status= 'test';
		// $data->machine_stop_reason= 12;

        $savetodb = array();
        
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

    // function update_ticket_status($qan_id,$ticket_status_code,$from_code=0){

    //     if($qan_id > 0 and $ticket_status_code!=''){

    //         $this->db->where('id',$qan_id);
    //         if($from_code != 0) 
    //             $this->db->where('status',$from_code);
    //         $this->db->update('qan_machinebreakdown', array('status'=>$ticket_status_code) );
    //     }
    // }

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

                $data['qa_sample_reject_qty'] = $reject_qty;
                $data['qa_sample_good_qty'] = $data['qa_sample_affected_qty'] - $data['qa_sample_reject_qty'];
            }else{
                $data['qa_sample_good_qty'] = $result['total_qty'] - $result['qa_sample_reject_qty'];
            }
            
            if($result['mrb_exist']===false){

                $data['machine_breakdown_id'] = $qan_id;
                $this->db->insert('qa_sample_mrb', $data );
            }else{
                $this->db->where('machine_breakdown_id',$qan_id);
                $this->db->update('qa_sample_mrb', $data );
            }
        }
        return $data;
    }
}