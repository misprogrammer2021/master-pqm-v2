<?php

class Modal_master extends CI_Model{
    
    private $qan_id;
    private $defect_id;
    private $root_cause_failure_id;
    private $root_cause_submission_id;
    private $mrb_id;
    private $data;

    function __construct() {
        $data = new stdClass();
    }

    function load_qan($qan_id){

        @$this->get_rule();

        $this->qan_id = $qan_id;
        $this->db->select('m.id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,
        m.issued_dept,m.to_dept,m.shift,m.rule_name,substring(convert(varchar,m.datetime,20),1,19) as datetime,
        m.closedby_user_id,substring(convert(varchar,m.closed_datetime,20),1,19) as closed_datetime,
        s.ticket_status_name');
        $this->db->from('qan_machinebreakdown m'); 
        $this->db->join('ticket_status s', 's.ticket_status_code=m.status','left'); //$this->db->join('status s', 's.status_code=m.status','left');
		$this->db->where('id',$this->qan_id);
        $query = $this->db->get(); 

        $data = $query->result_object()[0];
        $this->data = (object) array_merge((array) $data,(array) $this->data); 
         
        if (strpos($data->qan_no, 'TEST') !== false) {
            $this->data->test = 1;
        }

        if(@!$this->data->user) $this->data->user = new stdClass();
        $this->data->user->{$data->issueto_user} = '';
        $this->data->user->{$data->issueby_user_id} = '';
        // $this->data->user->{$data->approval_user_id} = '';
        $this->data->user->{$data->closedby_user_id} = '';

        foreach($this->data->user As $id => $null){

            $this->data->user->{$id} = $this->admin_modal_select->get_user_by_id($id);
        }
    }

    function get_data(){
        return $this->data;
    }

    function Section1(){

        // $this->db->select('m.id AS machine_id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,m.issued_dept,m.to_dept,m.shift,m.ooc,m.oos,m.datetime,m.approval_user_id,m.machine_status,m.machine_stop_reason,m.purge_status,m.notify_next_process,m.fix_validation_result,m.closedby_user_id,
		// d.part_name,d.machine_no,d.process,d.cav_no,d.up_affected,d.detectedby_user,d.defect_description,d.last_passed_sample,d.purge_from,d.estimate_qty,d.ack_eng_user,d.ack_prod_user,d.ack_qa_user,
		// s.qa_sample_id,s.quantity AS samplequantity,
		// pr.prod_id,pr.quantity AS prodquantity,
		// mrb.scrap,mrb.rework,mrb.uai,mrb.scrap_no,mrb.rework_order_no,mrb.uai_no,mrb.rework_dispo_input,mrb.rework_dispo_output,mrb.rework_dispo_rej_scrap,mrb.reportby_user_id,mrb.qa_reinsp_verification_user_id,mrb.qa_reinsp_status_accept,mrb.qa_reinsp_status_reject,mrb.reject_reason,
		// p.purge_location_id,p.affected_qty,p.good_qty,p.reject_qty,
		// qasm.qa_sample_affected_qty,qasm.qa_sample_good_qty,qasm.qa_sample_reject_qty');
		// $this->db->from('qan_machinebreakdown m'); 
		// $this->db->join('qan_defect_info d', 'd.machine_breakdown_id=m.id', 'left');
		// $this->db->join('qa_sample_records s', 's.machine_breakdown_id=m.id', 'left');
		// $this->db->join('production_records pr', 'pr.machine_breakdown_id=m.id', 'left');
		// $this->db->join('qan_material_review_board mrb', 'mrb.machine_breakdown_id=m.id', 'left');
		// $this->db->join('qan_purge p', 'p.mrb_id=mrb.id', 'left');
		// $this->db->join('qa_sample_mrb qasm', 'qasm.machine_breakdown_id=m.id', 'left');
        // $this->db->where('m.id',$this->qan_id);
        //$this->db->order_by('m.qan_no','asc');
        // $this->db->limit(1);

        /*
        Machine breakdown table
         (
            [id] => 169
            [qan_no] => 1900023
            [created_date] => 2019-03-07 07:23:48.000
            [modified_date] => 2019-03-07 07:23:48.000
            [is_deleted] => 0
            [status] => NEW
            [issueby_user_id] => 11
            [issueto_user] => 11
            [issued_dept] => QA
            [to_dept] => Production
            [shift] => Day
            [ooc] => 1
            [oos] => 
            [datetime] => 2019-04-10 13:05:00.000
            [approval_user_id] => 11
            [machine_status] => 0
            [machine_stop_reason] => testing123
            [purge_status] => 1
            [notify_next_process] => 0
            [fix_validation_result] => 1
            [closedby_user_id] => 11
        )
        Defect table
        (
            [id] => 49
            [machine_breakdown_id] => 169
            [part_name] => 17
            [machine_no] => 1
            [process] => 2
            [cav_no] => 
            [up_affected] => 0
            [detectedby_user] => 22
            [defect_description] => test1234
            [last_passed_sample] => 2019-04-10 13:05:00.000
            [purge_from] => 2019-04-10 13:06:00.000
            [estimate_qty] => 0
            [ack_eng_user] => 11
            [ack_prod_user] => 12
            [ack_qa_user] => 7
        )

        QA Sample Qty table

        [qa_sample_loc] => Array
        (
            [0] => stdClass Object
                (
                    [id] => 1
                    [location_name] => Air Gauge
                )

            [1] => stdClass Object
                (
                    [id] => 2
                    [location_name] => EDI
                )

            [2] => stdClass Object
                (
                    [id] => 3
                    [location_name] => CMM/Marposs
                )

            [3] => stdClass Object
                (
                    [id] => 4
                    [location_name] => Visual
                )

            [4] => stdClass Object
                (
                    [id] => 5
                    [location_name] => Runner
                )

        )

        [prod_loc] => Array
        (
            [0] => stdClass Object
                (
                    [id] => 1
                    [location_name] => QA Sample
                )

            [1] => stdClass Object
                (
                    [id] => 2
                    [location_name] => Engineering Sample
                )

            [2] => stdClass Object
                (
                    [id] => 3
                    [location_name] => Inside CNC
                )

            [3] => stdClass Object
                (
                    [id] => 4
                    [location_name] => P1
                )

            [4] => stdClass Object
                (
                    [id] => 5
                    [location_name] => P2
                )

            [5] => stdClass Object
                (
                    [id] => 6
                    [location_name] => P3
                )

            [6] => stdClass Object
                (
                    [id] => 7
                    [location_name] => Washing
                )

            [7] => stdClass Object
                (
                    [id] => 8
                    [location_name] => Brushing
                )

            [8] => stdClass Object
                (
                    [id] => 9
                    [location_name] => CP
                )

            [9] => stdClass Object
                (
                    [id] => 10
                    [location_name] => FVMI
                )

        )

        */

        // $this->db->select('*');
        // $this->db->from('purge_location');
        // $query = $this->db->get();
        // $data = $query->result_object();
        // $this->data->loc_to_purge = new stdClass();
        // foreach($data as $purge){
        //     $this->data->loc_to_purge->{$purge->id} = $purge->process_name;
        // }

        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        // $this->get_defect_desc1();
        // $this->get_defect_desc2();
        // $this->get_defect_desc3();
        // $this->get_defect_desc4();
        // $this->get_defect_desc5();
        $this->get_sector();
        $this->get_machine_no();
        $this->get_detected_by();
        $this->get_defect_desc();

        $this->db->select('id as defect_id,part_name,machine_no_id,process,detectedby_user,substring(convert(varchar,last_passed_sample,20),1,19) as last_passed_sample,
        substring(convert(varchar,purge_from,20),1,19) as purge_from,estimate_qty,ack_qa_user'); 
		$this->db->from('qan_defect_info'); 
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $query = $this->db->get(); 
        $data = @$query->result_object()[0];

        $this->data = (object) array_merge((array) $data,(array) $this->data); 
        
        if(@!$this->data->user) $this->data->user = new stdClass();

        // $this->data->user->{@$data->ack_eng_user} = '';
        // $this->data->user->{@$data->ack_prod_user} = '';
        $this->data->user->{@$data->ack_qa_user} = '';
        $this->data->user->{@$data->detectedby_user} = '';

        foreach($this->data->user As $id => $null){

            $this->data->user->{$id} = $this->admin_modal_select->get_user_by_id($id);
        }

        $this->db->select('qa_sample_id, quantity AS samplequantity');
        $this->db->from('qa_sample_records');
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $query = $this->db->get();
        $data = $query->result_object();
        $this->data->qasample_qty =  $data;

        $this->db->select('prod_id, quantity AS prodquantity');
        $this->db->from('production_records');
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $query = $this->db->get();
        $data = $query->result_object();
        $this->data->production_qty =  $data;

        $this->db->select('dd.*, dl.*, os.*, dt.*,rm.*');
        $this->db->from('qan_defect_description dd');
        $this->db->join('defectives dl', 'dl.id = dd.defect_description_id', 'left');
        $this->db->join('os_us os', 'os.id = dd.os_us_id', 'left');
        $this->db->join('datum dt', 'dt.id = dd.datum_id', 'left');
        $this->db->join('remarks rm', 'rm.id = dd.remarks_id', 'left');
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $query = $this->db->get(); 
        $data = $query->result_object();
        $this->data->qan_defect_description = $data; 
        
    }
    
    function Section2(){ 
        
        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        // $this->get_defect_desc1();
        // $this->get_defect_desc2();
        // $this->get_defect_desc3();
        // $this->get_defect_desc4();
        // $this->get_defect_desc5();
        $this->get_process();
        $this->get_sector();
        $this->get_machine_no();
        $this->get_detected_by();
        $this->get_defect_desc();
        
        $this->db->select('id as mrb_id,scrap,rework,uai,scrap_no,rework_order_no,uai_no,rework_dispo_input,rework_dispo_output,rework_dispo_rej_scrap,
        reportby_user_id,qa_reinsp_verification_user_id,qa_reinsp_status_accept,qa_reinsp_status_reject,reject_reason,confirmation,
        washing,brushing,vmi');
		$this->db->from('qan_material_review_board'); 
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $this->db->order_by("mrb_id", "desc");
        $query = $this->db->get(); 
        $data = $query->result_object();

        if(count($data) > 0){

            $data = $data[0];
            $this->data = (object) array_merge((array) $data,(array) $this->data); 
            $this->data->user->{$data->reportby_user_id} = '';
            $this->data->user->{$data->qa_reinsp_verification_user_id} = '';
        }
        
        foreach($this->data->user As $id => $null){

            $this->data->user->{$id} = $this->admin_modal_select->get_user_by_id($id);
        }

        if(@$data->mrb_id > 0){

            $this->db->select('mrb_id,purge_location_id,affected_qty,good_qty,reject_qty,prod_pic_user_id,qa_buyoff_user_id');
            $this->db->from('qan_purge');
            $this->db->where('mrb_id',$this->data->mrb_id);
            $query = $this->db->get(); 
            $data1 = $query->result_object();
            $this->data->purge_location = $data1;

            $this->db->select('sublot_no,qty_sublot_no,sorting_good_qty,sorting_reject_qty,sublotprod_pic_user_id');
            $this->db->from('qan_on_hold_sublot');
            $this->db->where('mrb_id',$this->data->mrb_id);
            $query = $this->db->get(); 
            $data2 = $query->result_object();
            $this->data->onhold_sublot = $data2; 

            $this->db->select('qty_buyoff,sorting_good_qty,sorting_ooc_qty,sorting_oos_qty,qa_pic_user_id');
            $this->db->from('qan_qa_buy_off');
            $this->db->where('mrb_id',$this->data->mrb_id);
            $query = $this->db->get(); 
            $data3 = $query->result_object();
            $this->data->buy_off = $data3;

        }

        if(is_array(@$data1) AND count(@$data1) > 0){

            $data = @$data1[0];
            $this->data = (object) array_merge((array) $data,(array) $this->data); 
            $this->data->user->{@$data->prod_pic_user_id} = '';
        }

        if(is_array(@$data2) AND count(@$data2) > 0){

            $data = @$data2[0];
            $this->data = (object) array_merge((array) $data,(array) $this->data); 
            $this->data->user->{@$data->sublotprod_pic_user_id} = '';
        }

        if(is_array(@$data3) AND count(@$data3) > 0){

            $data = @$data3[0];
            $this->data = (object) array_merge((array) $data,(array) $this->data); 
            $this->data->user->{@$data->qa_pic_user_id} = '';
        }

        foreach($this->data->user As $id => $null){
            $this->data->user->{$id} = $this->admin_modal_select->get_user_by_id($id);
        }

        //get qa_sample_records / affect and rej qrt
        $data = $this->get_qasample_records($this->qan_id);
        $this->data->qa_sample_reject_qty = $data['qa_sample_reject_qty'];
        $this->data->qa_sample_affected_qty = $data['qa_sample_affected_qty'];
        $this->data->qa_sample_good_qty = $data['qa_sample_good_qty'];

    }

    function get_qasample_location(){
        if(@$this->data->qa_sample_loc){
            return;
        }

        $this->db->select('*');
        $this->db->from('qa_sample');
        $query = $this->db->get(); 
        $this->data->qa_sample_loc = $query->result_object();
    }

    function get_production_location(){

        if(@$this->data->prod_loc){
            return;
        }
        $this->db->select('*');
        $this->db->from('production');
        $query = $this->db->get(); 
        $this->data->prod_loc = $query->result_object();
    }

    function get_purge_location(){

        if(@$this->data->loc_to_purge){
            return;
        }
        $this->db->select('id, purge_name');
        $this->db->from('purge_location');
        $this->db->where('is_active = 1 AND order_no <= 14');
        $this->db->order_by('order_no', 'ASC');
        $query = $this->db->get();
        $data = $query->result_object();
        $this->data->loc_to_purge = $data;
    }

    function get_process(){

        if(@$this->data->list_process){
            return;
        }
        $this->db->select('*');
        $this->db->from('purge_location');
        $this->db->where('show_process = 1');
        $query = $this->db->get();
        $data = $query->result_object();

        $this->data->list_process = new stdClass();
        foreach($data as $process){
            $this->data->list_process->{$process->id} = $process->purge_name;
        }
    }

    function get_parts(){

        if(@$this->data->list_partname){
            return;
        }
        $this->db->select('*');
        $this->db->from('model_name');
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $data = $query->result_object();

        $this->data->list_partname = new stdClass();
        foreach($data as $part){
            $this->data->list_partname->{$part->id} = $part->part_name;
        }
    }

    function get_sector(){

        if(@$this->data->list_sector){
            return;
        }
        $this->db->select('*');
        $this->db->from('sector_list');
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $data = $query->result_object();
        
        $this->data->list_sector = new stdClass();
        foreach($data as $sector){
            $this->data->list_sector->{$sector->id} = $sector->sector_name;
        }
    }

    function get_rule(){

        if(@$this->data->list_rule){
            return;
        }
        $this->db->select('*');
        $this->db->from('rule_list');
        $this->db->where('is_active = 1');
        $query = $this->db->get();   
        $data = $query->result_object();
        $this->data->list_rule = new stdClass();
        foreach($data as $rule){
            $this->data->list_rule->{$rule->id} = $rule->rule_name;
        }
    }

    function get_machine_no(){

		$this->db->select('s.sector_name, m.*');
		$this->db->from('machine_no_list m'); 
		$this->db->join('sector_list s', 's.id = m.sector_id', 'left');

		$this->db->order_by('m.id','asc');         
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}else{
			return false;
		}
	}

    // function get_defect_desc($id=0,$defect_type=0){

    //     if(@$this->data->list_defect AND $id == 0){
    //         return $this->data->list_defect;
    //     }

    //     $this->db->select('*');
    //     $this->db->from('defectives');
    //     if($defect_type != ''){
    //         $defect_type = explode(',',$defect_type);
    //         if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
    //     }
        
    //     if($id > 0){
    //         $this->db->where('id = '.$id);
    //     }
    //     $this->db->where('is_active = 0');
    //     $query = $this->db->get();
    //     $result = $query->result_object();
 
    //     if(@$this->data){
    //         $this->data->list_defect = new stdClass();
    //         foreach($result as $defect){
    //             $this->data->list_defect->{$defect->id} = $defect->defect_description_name;
    //         }
    //     }
    //     return $result;
    // }

    // function get_sec1_ack_list($qan_id=0){
        
    //     $this->db->select('ack_eng_user,ack_prod_user,ack_qa_user'); 
    //     $this->db->from('qan_defect_info'); 
    //     if($qan_id > 0){
    //         $this->db->where('machine_breakdown_id',$qan_id);
    //     }
    //     $query = $this->db->get(); 
    //     if(isset($query->result_object()[0])){
    //         return $query->result_object()[0];
    //     }else{
    //         $ack = new stdClass();
    //         $ack->ack_eng_user = ''; 
    //         $ack->ack_prod_user = ''; 
    //         $ack->ack_qa_user = ''; 
    //         return $ack;
    //     }
    // }

    /*
    function get_defect_desc1($id=0,$defect_type=0){

        if(@$this->data->list_defect AND $id == 0){
            return $this->data->list_defect;
        }

        $this->db->select('*');
        $this->db->from('defectives');
        if($defect_type != ''){
            $defect_type = explode(',',$defect_type);
            if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
        }
        
        if($id > 0){
            $this->db->where('id = '.$id);
        }
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        if(isset($query->result_object()[0])){
            return $query->result_object()[0];
        }else{
            if(@$this->data){
                $this->data->list_defect = new stdClass();
                foreach($result as $defect){
                    $this->data->list_defect->{$defect->id} = $defect->defect_description_name;
                }
            }
            return $result;
        }
 
    }

    function get_defect_desc2($id=0,$defect_type=0){

        if(@$this->data->list_defect AND $id == 0){
            return $this->data->list_defect;
        }

        $this->db->select('*');
        $this->db->from('defectives');
        if($defect_type != ''){
            $defect_type = explode(',',$defect_type);
            if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
        }
        
        if($id > 0){
            $this->db->where('id = '.$id);
        }
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $result = $query->result_object();
 
        if(@$this->data){
            $this->data->list_defect = new stdClass();
            foreach($result as $defect){
                $this->data->list_defect->{$defect->id} = $defect->defect_description_name;
            }
        }
        return $result;
    }

    function get_defect_desc3($id=0,$defect_type=0){

        if(@$this->data->list_defect AND $id == 0){
            return $this->data->list_defect;
        }

        $this->db->select('*');
        $this->db->from('defectives');
        if($defect_type != ''){
            $defect_type = explode(',',$defect_type);
            if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
        }
        
        if($id > 0){
            $this->db->where('id = '.$id);
        }
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $result = $query->result_object();
 
        if(@$this->data){
            $this->data->list_defect = new stdClass();
            foreach($result as $defect){
                $this->data->list_defect->{$defect->id} = $defect->defect_description_name;
            }
        }
        return $result;
    }

    function get_defect_desc4($id=0,$defect_type=0){

        if(@$this->data->list_defect AND $id == 0){
            return $this->data->list_defect;
        }

        $this->db->select('*');
        $this->db->from('defectives');
        if($defect_type != ''){
            $defect_type = explode(',',$defect_type);
            if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
        }
        
        if($id > 0){
            $this->db->where('id = '.$id);
        }
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $result = $query->result_object();
 
        if(@$this->data){
            $this->data->list_defect = new stdClass();
            foreach($result as $defect){
                $this->data->list_defect->{$defect->id} = $defect->defect_description_name;
            }
        }
        return $result;
    }

    function get_defect_desc5($id=0,$defect_type=0){

        if(@$this->data->list_defect AND $id == 0){
            return $this->data->list_defect;
        }

        $this->db->select('*');
        $this->db->from('defectives');
        if($defect_type != ''){
            $defect_type = explode(',',$defect_type);
            if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
        }
        
        if($id > 0){
            $this->db->where('id = '.$id);
        }
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $result = $query->result_object();
 
        if(@$this->data){
            $this->data->list_defect = new stdClass();
            foreach($result as $defect){
                $this->data->list_defect->{$defect->id} = $defect->defect_description_name;
            }
        }
        return $result;
    }
    */

    /*
    function get_defect_desc_old(){

        if(@$this->data->list_defect_desc){
            return;
        }
        $this->db->select('*');
        $this->db->from('defectives');
        $this->db->where('is_active = 1');
        $query = $this->db->get();
        $data = $query->result_object();

        $this->data->list_defect_desc = new stdClass();
        foreach($data as $defect){
            $this->data->list_defect_desc->{$defect->id} = $defect->defect_description_name;
        }
    }
    */

    function get_defect_desc(){

        $this->db->select('*');
		$this->db->from('defectives'); 
		$this->db->where('is_active = 1');      
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}else{
			return false;
		}
	}

    function get_os_us(){

        $this->db->select('*');
		$this->db->from('os_us'); 
		$this->db->where('is_active = 1');      
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}else{
			return false;
		}
	}

    function get_datum(){

        $this->db->select('*');
		$this->db->from('datum'); 
		$this->db->where('is_active = 1');      
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}else{
			return false;
		}
	}

    function get_remarks(){

        $this->db->select('*');
		$this->db->from('remarks'); 
		$this->db->where('is_active = 1');      
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}else{
			return false;
		}
	}

    // function get_defects(){

    //     if(@$this->data->list_defects){
    //         return;
    //     }
    //     $this->db->select('*');
    //     $this->db->from('defectives');
    //     $this->db->where('is_active = 0');
    //     $query = $this->db->get();
    //     $data = $query->result_object();

    //     $this->data->list_defects = new stdClass();
    //     foreach($data as $defects){
    //         $this->data->list_defects->{$defects->id} = $defects->defect_description_name;
    //     }
    // }

    // function get_defects($id=0){

    //     if($id == 0){
    //         if(@$this->data->list_defects){
    //             return;
    //         }
    //         $this->db->select('*');
    //         $this->db->from('defectives');
    //         $this->db->where('is_active = 0');
    //         $query = $this->db->get();
    //         $data = $query->result_object();
    //         $this->data->list_defects = new stdClass();
    //         foreach($data as $defects){
    //             $this->data->list_defects->{$defects->id} = $defects->defect_description_name;
    //         }
    //     }else{
    //         $this->db->select('*');
    //         $this->db->from('defectives');
    //         $this->db->where('is_active = 0');
    //         $query = $this->db->get();
    //         $data = $query->result_object();
    //         return $data[0];
    //     }
    // }

    // function get_defects($id=0){

    //     if(@$this->data->list_defects AND $id == 0){
    //         return $this->data->list_defects;
    //     }

    //     $this->db->select('*');
    //     $this->db->from('defectives');

    //     if($id > 0){
    //         $this->db->where('id = '.$id);
    //     }
    //     $this->db->where('is_active = 0');
    //     $query = $this->db->get();
    //     $result = $query->result_object();
 
    //     if(@$this->data){
    //         $this->data->list_defects = new stdClass();
    //         foreach($result as $defect){
    //             $this->data->list_defects->{$defect->id} = $defect->defect_description_name;
    //         }
    //     }
        
    //     return $result;
    // }
    

    // function get_detected_by(){

	// 	$this->db->select('*');
    //     $this->db->from('detected_by'); 
    //     $this->db->where('is_active = 0');
	// 	$this->db->order_by('id','asc');         
	// 	$query = $this->db->get(); 

	// 	if($query->num_rows() != 0){
	// 		return $query->result_object();
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// }
    
    function get_detected_by(){

        $this->db->select('g.id, g.group_name, u.*');
		$this->db->from('detectedby_user_group u'); 
		$this->db->join('detected_group g', 'g.id = u.detected_group_id', 'left');
        $this->db->where('u.show_detectedby = 1');
		$this->db->order_by('u.id','ASC');         
		$query = $this->db->get(); 

		if($query->num_rows() != 0)
		{
			return $query->result_object();
		}else{
			return false;
		}
	}

    function get_QA_inspector_users(){

        if(@$this->data->user and @$this->data->inspect_user){
            return;
        }
        
        $this->db->select('u.id,u.fullname');
		$this->db->from('users u');
		$this->db->join('user_role ur', 'ur.user_id=u.id');
		$this->db->where('u.dept_id = 1 AND ur.role_id = 12 AND u.title = \'Inspector\' AND u.status = 1');
        // $query = $this->db->get_compiled_select();
        // print_r($query);
		// exit;
        $query = $this->db->get();
        $data = $query->result_object();

        if(@!$this->data->user) $this->data->user = new stdClass();
        if(@!$this->data->inspect_user) $this->data->inspect_user = new stdClass();

        foreach($data as $list_user){

            $this->data->user->{$list_user->id} = $list_user->fullname;
            $this->data->inspect_user->{$list_user->id} = new stdClass();
            $this->data->inspect_user->{$list_user->id}->fullname = $list_user->fullname;
        }
    }

    function load_new_qan(){

        @$this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        $this->get_inspection_machine();
        // $this->get_defect_desc1();
        // $this->get_defect_desc2();
        // $this->get_defect_desc3();
        // $this->get_defect_desc4();
        // $this->get_defect_desc5();
        $this->get_rootcause();
        $this->get_corrective_action();
        $this->get_process();
        $this->get_sector();
        @$this->get_rule();
        $this->get_machine_no();
        $this->get_defect_desc();

    }

    function Section3(){

        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        $this->get_inspection_machine();
        $this->get_rootcause();
        $this->get_corrective_action();
    
        $this->db->select('id AS submission_id, machine_breakdown_id,root_cause_id,corrective_action_id,rcfa_pic_user_id,rcfa_ack_user_id,rcfa_appr_user_id,
        id AS root_cause_submission_id,completion_user_id,substring(convert(varchar,completion_datetime,20),1,19) as completion_datetime,submission_no,
        others_corrective_action,remarks,approval_user_id,machine_status,machine_stop_reason');
		$this->db->from('qan_validation_submission');
		$this->db->where('machine_breakdown_id',$this->qan_id);
		$query = $this->db->get(); 
        $data = $query->result_object();
        $this->data->inspection_machine_data = $data;

        foreach($this->data->inspection_machine_data as $i => $submission_data){

            if(@!$this->data->user) $this->data->user = new stdClass();

            @$this->data->user->{$submission_data->rcfa_pic_user_id} = '';
            @$this->data->user->{$submission_data->rcfa_ack_user_id} = '';
            @$this->data->user->{$submission_data->rcfa_appr_user_id} = '';
            @$this->data->user->{$submission_data->completion_user_id} = '';
            @$this->data->user->{$submission_data->approval_user_id} = '';

            $this->db->select('*, substring(convert(varchar,time_start,20),1,5) as time_start2 , 
            substring(convert(varchar,time_end,20),1,5) as time_end2');
            $this->db->from('qan_rootcause_item_inspection');
            $this->db->where('machine_breakdown_id',$this->qan_id);
            $this->db->where('root_cause_submission_id',$submission_data->submission_id);
            $query = $this->db->get(); 
            $data = $query->result_object();

            $this->data->inspection_machine_data[$i]->inspection_data = $data;
            foreach($data as $i => $inspection_data){

                if(@!$this->data->user) $this->data->user = new stdClass();
                @$this->data->user->{$inspection_data->inspectby_user_id} = '';
            }
        }

        foreach($this->data->user As $id => $null){
            $this->data->user->{$id} = $this->admin_modal_select->get_user_by_id($id);
        }
    }
    
    function get_inspection_machine(){

        if(@$this->data->inspection_machine){
            return;
        }
        $this->db->select('id, name');
        $this->db->from('inspection_machine');
        $query = $this->db->get();
        $data = $query->result_object();
        $this->data->inspection_machine = $data;
    }

    function get_rootcause($id=0){

        if($id == 0){
            if(@$this->data->list_rootcause){
                return;
            }
            $this->db->select('*');
            $this->db->from('root_cause_list');
            $this->db->where('is_active = 1');
            $query = $this->db->get();
            $data = $query->result_object();
            $this->data->list_rootcause = new stdClass();
            foreach($data as $rootcause){
                $this->data->list_rootcause->{$rootcause->id} = $rootcause->root_cause;
            }
        }else{
            $this->db->select('*');
            $this->db->from('root_cause_list');
            $this->db->where('is_active = 1');
            $query = $this->db->get();
            $data = $query->result_object();
            return $data[0];
        }
    }

    function get_corrective_action($id=0){
        
        if($id == 0){
            if(@$this->data->list_corrective_action){
                return;
            }
            $this->db->select('*');
            $this->db->from('corrective_action_list');
            $this->db->where('is_active = 1');
            $query = $this->db->get();
            $data = $query->result_object();

            $this->data->list_corrective_action = new stdClass();

            foreach($data as $corrective){
                $this->data->list_corrective_action->{$corrective->id} = $corrective->corrective_action;
            }
        }else{
            $this->db->select('*');
            $this->db->from('corrective_action_list');
            $this->db->where('is_active = 1');
            $query = $this->db->get();
            $data = $query->result_object();
            return $data[0];
        }
    }

    function get_status($qan_id){

        $this->db->select('status'); 
        $this->db->from('qan_machinebreakdown'); 
		$this->db->where('id',$qan_id);
        $query = $this->db->get(); 
        return $query->result_object()[0]->status;
    }

    // function get_machine_status($qan_id){

    //     $this->db->select('machine_status'); 
    //     $this->db->from('qan_validation_submission'); 
    //     $this->db->where('id',$qan_id);
    //     $this->db->where('machine_status = 0');
    //     $query = $this->db->get(); 
    //     return $query->result_object();
    // }


    function get_sec1_ack_list($qan_id=0){
        
        $this->db->select('ack_qa_user'); //$this->db->select('ack_eng_user,ack_prod_user,ack_qa_user');
        $this->db->from('qan_defect_info'); 
        if($qan_id > 0){
            $this->db->where('machine_breakdown_id',$qan_id);
        }
        $query = $this->db->get(); 

        if(isset($query->result_object()[0])){
            return $query->result_object()[0];
        }else{
            $ack = new stdClass();
            // $ack->ack_eng_user = ''; 
            // $ack->ack_prod_user = ''; 
            $ack->ack_qa_user = ''; 
            return $ack;
        }
    }

    function get_submission_result($qan_id=0){

        $this->db->select('r.machine_breakdown_id as QAN_NO,r.root_cause_submission_id AS SUB_ID,
        COUNT(*) AS TOTAL_INSP,
        CASE WHEN Count(CASE WHEN r.result = 0 THEN 1 END) > 0 THEN \'Fail\' ELSE \'Pass\' End as \'Status\',
        SUM(CASE WHEN r.result = 1 THEN 1 ELSE 0 END) AS Passed,
        SUM(CASE WHEN r.result = 0 THEN 1 ELSE 0 END) as Failed,
        "Per_Pass" = round(avg(case WHEN r.result=1 then 100.0 else 0.0 end),2),
        "Per_Fail" = round(avg(case when r.result=0 then 100.0 else 0.0 end),2)'); 
        $this->db->from('qan_validation_submission s'); 
        $this->db->join('qan_rootcause_item_inspection r','r.root_cause_submission_id = s.id','left'); 
        $this->db->where('r.machine_breakdown_id',$qan_id);
        $this->db->group_by(array('r.machine_breakdown_id','r.root_cause_submission_id'));
        $this->db->order_by("r.root_cause_submission_id","DESC");
    
        $query = $this->db->get();
        
        if($query->num_rows()>0)
            return $query->result_object();
    }

    function get_submission_validation_result($qan_id=0,$root_cause_submission_id=0){

        $result = "NA";
        $total = 0;

        $return = array();
        $return['result'] = $result;
        $return['total_submission'] = $total;
        $return['total_inspection'] = $total;
        $return['result_raw'] = '';

        if($qan_id>0){
            $this->db->select('root_cause_submission_id, min(result) AS overall, count(id) AS total_inspection'); 
            $this->db->from('qan_rootcause_item_inspection'); 
            $this->db->where('machine_breakdown_id',$qan_id);
            $this->db->group_by("root_cause_submission_id");
            $this->db->order_by("root_cause_submission_id","DESC");
            /* 
            SELECT "root_cause_submission_id", min(result) AS overall, count(id) AS total_inspection
            FROM "qan_rootcause_item_inspection" 
            WHERE "machine_breakdown_id" = '10265' 
            GROUP BY "root_cause_submission_id" 
            ORDER BY "root_cause_submission_id" DESC
            */
            $query = $this->db->get();
            $query_result = $query->result_object();

            $submission_info = $this->get_submission_result($qan_id);

            if($submission_info) $return['total_submission'] = count($submission_info);
            else $return['total_submission'] = 0;

            if(count($query_result)>0){
                $return['result_raw'] = $query_result[0]->overall;
                if($root_cause_submission_id==0){
                    $return['result'] = $query_result[0]->overall === 1?'PASS':'FAILED';
                }

                foreach($query_result as $i => $data){
                    $return['total_inspection'] += $data->total_inspection;
                    if($root_cause_submission_id>0 AND $data->root_cause_submission_id == $root_cause_submission_id){
                        $return['total_inspection'] = $data->total_inspection;
                        $return['result'] = $data->overall == 0?'FAILED':'PASS';
                        return $return;
                    }
                }
            }
        }

        return $return;
    }

    function get_last_machine_status($qan_id=0){

        $machine_status = "";
        $total = 0;

        $return = array();
        $return['machine_status'] = $machine_status;
        $return['total_submission'] = $total;
        $return['total_inspection'] = $total;
        $return['result_raw'] = '';

        if($qan_id>0){
            $this->db->select('id, submission_no, machine_status'); 
            $this->db->from('qan_validation_submission'); 
            $this->db->where('machine_breakdown_id',$qan_id);
            $this->db->order_by("id","DESC");
            $this->db->order_by("submission_no","DESC");
            $this->db->limit(1);

            $query = $this->db->get();
            // echo '<pre>'; print_r($this->db->last_query());exit;
            // print_r($query);
            // exit;
            $query_result = $query->result_object();
            // print_r($query_result);
            // exit;
            
            $return['total_submission'] = 0;
            $return['machine_status'] = 'NA';

            //$submission_info = $this->get_submission_result($qan_id);

            // if($submission_info) $return['total_submission'] = count($submission_info);
            // else $return['total_submission'] = 0;


            if(count($query_result)>0){

                $return['total_submission'] = $query_result[0]->submission_no;
   
                $return['machine_status'] = $query_result[0]->machine_status == '0'?'STOP':($query_result[0]->machine_status == '1'? 'RUN':'NA');

                // echo '<pre>';
                // print_r($return);
                // echo '</pre>';
                // exit;
                
            }
        }

        return $return;
    }

    function get_last_result_inspection($qan_id=0){

        $result = "NA";
        $total = 0;

        $return = array();
        $return['result'] = $result;
        $return['total_submission'] = $total;
        $return['total_inspection'] = $total;
        $return['result_raw'] = '';

        if($qan_id>0){
            $this->db->select('min(result) as result'); 
            $this->db->from('qan_rootcause_item_inspection'); 
            $this->db->where('machine_breakdown_id',$qan_id);
            $this->db->order_by("result","DESC");
            // $this->db->limit(1);

            $query = $this->db->get();
            // echo '<pre>'; print_r($this->db->last_query());exit;
            // print_r($query);
            // exit;
            $query_result = $query->result_object();
            // print_r($query_result);
            // exit;
            
            $return['total_submission'] = 0;
            $return['result'] = 'NA';

            //$submission_info = $this->get_submission_result($qan_id);

            // if($submission_info) $return['total_submission'] = count($submission_info);
            // else $return['total_submission'] = 0;


            if(count($query_result)>0){
   
                // $return['result'] = $query_result[0]->result == 1?'PASS':'FAILED';
                $return['result'] = $query_result[0]->result === 0?'FAILED':($query_result[0]->result === 1? 'PASS':'NA');
                // echo '<pre>';
                // print_r($return);
                // echo '</pre>';
                // exit;
                
            }
        }

        return $return;
    }

    function get_rootcause_submission($qan_id=0){

        $this->db->select('*'); 
        $this->db->from('qan_validation_submission'); 
        $this->db->where('machine_breakdown_id',$qan_id);

        $query = $this->db->get();
        return $query->result_object();
    }

    function get_qasample_records($qan_id=0){

        $return = array(

            "records_exist" => false,
            "mrb_exist" => false,
            "qa_sample_affected_qty" => 0,
            "qa_sample_reject_qty" => 0,
            "qa_sample_good_qty" => 0,
            "total_qty" => 0,
            "error" => false,
            "error_msg" => ""
        );

        $this->db->select('SUM(quantity) as total_qty'); 
        $this->db->from('qa_sample_records');
        $this->db->where('machine_breakdown_id',$qan_id);
        $this->db->group_by('machine_breakdown_id');
        $query = $this->db->get();
        $result = $query->result_object();

        if(count( $result )>0){

            $return['total_qty'] = $result[0]->total_qty;
            $return['records_exist'] = true;
        }
       
        $this->db->select('*'); 
        $this->db->from('qa_sample_mrb');
        $this->db->where('machine_breakdown_id',$qan_id);
        $query = $this->db->get();
        $result = $query->result_object();

        if(count( $result )>0){

            $return['mrb_exist'] = true;
            if(count($result)>1){
                $return['error_msg'] .= ' Duplicate result found at qa_sample_mrb qan_id='.$qan_id;
                $return['error'] = true;
            }
            if($result[0]->qa_sample_affected_qty != $return['total_qty']){
                $return['error_msg'] .= ' Affected qty not sync between qa_sample_mrb('.($result[0]->qa_sample_affected_qty>0?$result[0]->qa_sample_affected_qty:0).') and SUM of qa_sample_records('.$return['total_qty'].')!';
                $return['error'] = true;
            }
            $return['qa_sample_affected_qty'] = $result[0]->qa_sample_affected_qty>0?$result[0]->qa_sample_affected_qty:0;
            $return['qa_sample_good_qty'] = $result[0]->qa_sample_good_qty>0?$result[0]->qa_sample_good_qty:0;
            $return['qa_sample_reject_qty'] = $result[0]->qa_sample_reject_qty>0?$result[0]->qa_sample_reject_qty:0;
        }else{
            $return['error_msg'] .= ' Not records found on table qa_sample_mrb';
            $return['error'] = true;
        }
        return $return;
    }

    function get_aff_rej_qty($qan_id=0){

        $return = array();

        if($qan_id>0){

            $return['total_aff_qty'] = 0;
            $return['total_rej_qty'] = 0;
            $return['qa_aff_qty'] = 0;
            $return['qa_rej_qty'] = 0;
            $return['prod_aff_qty'] = 0;
            $return['prod_rej_qty'] = 0;
            $return['details'] = array();

            $this->db->select('SUM(p.affected_qty) as Total_Aff,SUM(p.reject_qty) as Total_Rej'); 
            $this->db->from('qan_material_review_board m');
            $this->db->join('qan_purge p','p.mrb_id=m.id','left');
            $this->db->where('m.machine_breakdown_id',$qan_id);
            $query = $this->db->get();
            $result = $query->result_object();

            if(count( $result )>0){

                $return['prod_aff_qty'] = $result[0]->Total_Aff;
                $return['prod_rej_qty'] = $result[0]->Total_Rej;
            }

            $qasample_total = $this->get_qasample_records($qan_id);

            if(count( $qasample_total )>0){

                $return['qa_aff_qty'] = $qasample_total['qa_sample_affected_qty'];
                $return['qa_rej_qty'] = $qasample_total['qa_sample_reject_qty'];
            }

            $return['total_aff_qty'] = $return['prod_aff_qty'] + $return['qa_aff_qty'];
            $return['total_rej_qty'] = $return['prod_rej_qty'] + $return['qa_rej_qty'];
            //query untuk dpt items qa dan prod
        }
        return $return;
    }

    function get_list_by_status($status,$not=false){

        //$status must in name convention
        // $this->db->select('m.*, s.status_name'); 
        // $this->db->from('qan_machinebreakdown m');
        // $this->db->join('status s','s.status_code=m.status','left');

        $this->db->select('m.*, s.ticket_status_name'); 
        $this->db->from('qan_machinebreakdown m');
        $this->db->join('ticket_status s','s.ticket_status_code=m.status','left');

        if($not){

            if(is_array($status)){
                $this->db->where_not_in('m.status', $status);
            }else{
                $this->db->where('m.status !=\'' . $status . '\' and s.ticket_status_name != \'' . $status . '\'');
            }
            
        }
        else{
            if(is_array($status)){
                $this->db->where_in('m.status', $status);
            }else{
                $this->db->where('m.status =\'' . $status . '\' or s.ticket_status_name = \'' . $status . '\'');
            }
        }
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result_object();    
        // echo $query = $this->db->get_compiled_select();
        //     exit;    
    }

    // function get_defect_info($qan_id=0,$select='*'){

    //     if($qan_id > 0){
    //         $this->db->select($select);
    //         $this->db->from('qan_defect_info di'); 
    //         $this->db->where('machine_breakdown_id',$qan_id);
    //         $query = $this->db->get();

    //         if($query->num_rows()>0){
            
    //             return $query->result_object()[0];
    //         }else{
    //             $y = new stdClass();
    //             $y->defect_description_name_1 = ''; 
    //             $y->defect_description_name_2 = ''; 
    //             $y->defect_description_name_3 = '';
    //             $y->defect_description_name_4 = '';
    //             $y->defect_description_name_5 = '';
    //             return $y;
    //         }
    //     }
    // }

    // function get_defect_info($qan_id=0){
        
    //     $this->db->select('defect_description_name_1,defect_description_name_2,defect_description_name_3,defect_description_name_4,defect_description_name_5'); 
    //     $this->db->from('qan_defect_info'); 
    //     if($qan_id > 0){
    //         $this->db->where('machine_breakdown_id',$qan_id);
    //     }
    //     $query = $this->db->get(); 
    //     if(isset($query->result_object()[0])){
    //         return $query->result_object()[0];
    //     }else{
    //         $y = new stdClass();
    //         $y->defect_description_name_1 = ''; 
    //         $y->defect_description_name_2 = ''; 
    //         $y->defect_description_name_3 = '';
    //         $y->defect_description_name_4 = '';
    //         $y->defect_description_name_5 = '';
    //         return $y;
    //     }
    // }

    function get_defect_info($qan_id = 0){

        $this->db->select('dl.id, dl.defect_description_name, dl.defect_type');
        $this->db->from('qan_defect_description dd');
        $this->db->join('defectives dl', 'dl.id = dd.defect_description_id', 'left');
        if($qan_id>0){
            $this->db->where('machine_breakdown_id',$qan_id);
        }
        
        $query = $this->db->get();

        if($query->num_rows()>0){
            
            return $query->result_object()[0];
        }else{
            $y = new stdClass();
            $y->defect_description_name = ''; 
            $y->defect_type = ''; 
            return $y;

        }
        // $result_array = $query->result_object();
        // echo '<pre>';
        // print_r($result_array);
        // echo '</pre>';
        // exit;

        // if(count($result_array) > 0){

            // $object = new stdClass();
            // foreach($result_array as $key => $data){

            //    return $this->$key = $data;
            //     // exit;
            //     // if(is_array($data)){
            //     //     $data = ToObject($data);
            //     // }
            //     // $object->$key = $data;
            

                
            // }
            // return $object;
            // print_r($object);
            // exit;
        // }
        
    }
    
    function get_partname($qan_id = 0){
        if($qan_id > 0){
            $this->db->select('m.id,m.part_name');
            $this->db->from('qan_defect_info d'); 
            $this->db->join('model_name m', 'm.id=d.part_name', 'left');
            $this->db->where('machine_breakdown_id',$qan_id);

            // echo $query = $this->db->get_compiled_select();
            // exit;
            $query = $this->db->get();
            if($query->num_rows()>0){
            
                return $query->result_object()[0];
            }else{
                $y = new stdClass();
                $y->part_name = ''; 
                return $y;

            }
        }
    }

    function get_machinename($qan_id = 0){
        if($qan_id > 0){
            $this->db->select('m.id,m.machine_name,s.id,s.sector_name');
            $this->db->from('qan_defect_info d'); 
            $this->db->join('machine_no_list m', 'm.id=d.machine_no_id', 'left');
            $this->db->join('sector_list s', 's.id=m.sector_id', 'left');
            $this->db->where('machine_breakdown_id',$qan_id);

            $query = $this->db->get();
            if($query->num_rows()>0){
            
                return $query->result_object()[0];
            }else{
                $y = new stdClass();
                $y->machine_name = ''; 
                $y->sector_name = '';
                return $y;

            }
        }
    }

    function check_purge_data($qan_id=0){

        $this->db->select('p.*');
        $this->db->from('qan_material_review_board mrb'); 
        $this->db->join('qan_purge p','p.mrb_id=mrb.id','innner'); 
        $this->db->where('mrb.machine_breakdown_id',$qan_id);

        $query = $this->db->get();
        return $query->result_object();
    }

    function get_mrb_finalize_score($qan_id=0){

        $this->db->select('mrb.confirmation AS finalize_score');
        $this->db->from('qan_material_review_board mrb'); 
        $this->db->where('mrb.machine_breakdown_id',$qan_id);
        $query = $this->db->get();

        if($query->num_rows()>0){
            $result = $query->result_object()[0];
            $result = $result->finalize_score;
        }
        else $result = 0;
        return $result;
    }

    function total_reject_affected_qty($year=0,$month=0,$day=0){

        if($year == 0)
            $year = date("Y");

        $this->db->select('SUM(p.affected_qty) as Total_Aff,SUM(p.reject_qty) as Total_Rej');
        $this->db->from('qan_material_review_board mrb'); 
        $this->db->join('qan_purge p','p.mrb_id=mrb.id','left');
        $this->db->join('qan_machinebreakdown m','m.id=mrb.machine_breakdown_id','left');
        $this->db->where('YEAR(m.datetime) = '.$year); //mandatory

        if($month > 0)
        $this->db->where('MONTH(m.datetime) = '.$month); //optional
        if($day > 0)
        $this->db->where('DAY(m.datetime) = '.$day); //optional
    }

    function rej_aff_qty_12month($year=0){

        if($year == 0)
            $year = date("Y");

        $this->db->select('YEAR(m.datetime) AS YEAR, MONTH(m.datetime) AS MONTH, SUM(p.affected_qty) as Total_Aff,SUM(p.reject_qty) as Total_Rej');
        $this->db->from('qan_material_review_board mrb'); 
        $this->db->join('qan_purge p','p.mrb_id=mrb.id','left');
        $this->db->join('qan_machinebreakdown m','m.id=mrb.machine_breakdown_id','left');
        $this->db->where('YEAR(m.datetime) = '.$year);
        $this->db->group_by(array("YEAR(m.datetime)", "MONTH(m.datetime)"));
        $this->db->order_by('MONTH(m.datetime)');

        $query = $this->db->get();
        return $query->result_object();
    }

    /*function get_total_open_ticket(){

        $this->db->select('COUNT(status) as total_open_ticket'); 
        $this->db->from('qan_machinebreakdown');
        $this->db->where("status != '99' AND status != 'NEW' AND status != ''");

        $query = $this->db->get();
        return $query->result_object();
        // echo '<pre>';
        // print_r($return);
        // echo '</pre>';
        // exit;
    }*/

    function get_total_open_ticket(){

        $total_ticket = 0;

        $return = array();
        $return['total_ticket'] = $total_ticket;

        
            $this->db->select('COUNT(status) as total_open_ticket'); 
            $this->db->from('qan_machinebreakdown'); 
            $this->db->where("status != '99' AND status != 'NEW' AND status != ''");

            $query = $this->db->get();
            // echo '<pre>'; print_r($this->db->last_query());exit;
            // print_r($query);
            // exit;
            $query_result = $query->result_object();
            // print_r($query_result);
            // exit;
   
            $return['total_ticket'] = 0;

            if(count($query_result)>0){

                $return['total_ticket'] = $query_result[0]->total_open_ticket;
   
                // echo '<pre>';
                // print_r($return);
                // echo '</pre>';
                // exit;
                
            }
        

        return $return;
    }

    function section1_task_informer(){
        
        $section = $this->session->userdata['permission'];
        $task = '';
        $data = array();
        $return = array();

        $result = $this->get_list_by_status("1");
        
        if(@$section['S1']['de']){
            
            foreach($result as $i=>$row_obj){

                $task = "Ticket Are Still Updatable";
               
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
                $data[$row_obj->id]['section'][] = 'S1';
            }

        }

        if(@$section['S1']['ack'] AND @$section['S1.7']['ack']){

            $result = array_merge($result,$this->get_list_by_status("3"));
            $task = "Need Your Acknowledge Action";

            foreach($result as $i=>$row_obj){

                $acks = $this->get_sec1_ack_list($row_obj->id);
                
                if(@$section['S1.5']['ack'] and @$acks->ack_eng_user>0) continue;
                if(@$section['S1.6']['ack'] and @$acks->ack_prod_user>0) continue;
                if(@$section['S1.7']['ack'] and @$acks->ack_qa_user>0) continue;
                
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
                $data[$row_obj->id]['section'] = 'S1';
            }
        }

        $i = 0;
        foreach($data as $id=>$details){

            $return[$i]['id']=$id;
            $return[$i] = $details;
            $i++;
        }
        return $return;
    }

    function section2_task_informer(){
    
        $section = $this->session->userdata['permission'];
        $task = '';
        $data = array();
        $return = array();

            /**
             * 4 logic
             * 1) Status > 3
             * 2) Permission: PROD & MRB
             * 3) Data: OK & data > 0 = ok else not ok
             * 4) Finalized:!=11 AND & !=1 : >10
             */
        // $result = $this->get_list_by_status(array('4','5','6'));
        $result = $this->get_list_by_status("5"); 
        // $result = $this->get_list_by_status(array('6')); //both PROD and MRB colobrate in this level

        if(@$section['S2.1']['de']){ //PROD

            foreach($result as $i=>$row_obj){

                if($this->get_mrb_finalize_score($row_obj->id) !=13 AND $this->get_mrb_finalize_score($row_obj->id) !=1)
                {
                    $task = "Please Update Affected Quantity & Finalize";
                
                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                    $data[$row_obj->id]['section'][] = 'S2';
                }
            }
        }
        if(@$section['S2.2']['de']){
            
            foreach($result as $i=>$row_obj){

                if(count($this->check_purge_data($row_obj->id)) > 0 AND $this->get_mrb_finalize_score($row_obj->id) < 10)
                {
                    $task = "Please Update Reject Quantity & Finalize";
                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                    $data[$row_obj->id]['section'][] = 'S2';
                }
            }
        }
        if(@$section['S2.6']['de']){
            
            foreach($result as $i=>$row_obj){

                if($this->get_mrb_finalize_score($row_obj->id) !=13 AND $this->get_mrb_finalize_score($row_obj->id) !=2)
                {
                    $task = "Please Update QA Buy Off Quantity & Finalize";
                
                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                    $data[$row_obj->id]['section'][] = 'S2';
                }
            }
        }

        $i = 0;
        foreach($data as $id=>$details){

            $return[$i]['id']=$id;
            $return[$i] = $details;
            $i++;
        }
        return $return;
    }

    //submission by engineering and QA validation
    function section3_task_informer(){
        
        $section = $this->session->userdata['permission'];
        $task = '';
        $data = array();
        $return = array();

        $result = $this->get_list_by_status("4"); //both ENG and QA colobrate in this level
        
        if(@$section['S3.1']['de']){

            /**
             * 3 situation
             * -No submission yet
             * -Submission submitted but QA not give result yet
             * -Submission submitted with FAIL result, need next submission
             */
            
            foreach($result as $i=>$row_obj){

                $task = '';
                $submit_result = $this->get_submission_validation_result($row_obj->id);
                $submit_last_machine_status = $this->get_last_machine_status($row_obj->id);

                $total_submission = count($this->get_rootcause_submission($row_obj->id));
                $total_submission_with_result = $submit_result['total_submission'];
                // $last_submission_result = $submit_result['result'];
                $total_submission_with_last_machine_status = $submit_last_machine_status['total_submission'];
                $last_submission_machine_status = $submit_last_machine_status['machine_status'];

                if($total_submission < 1){
                    $task = "Waiting First Submission"; 
                }elseif($total_submission_with_last_machine_status == $total_submission AND $last_submission_machine_status == 'STOP'){ //if($total_submission_with_result == $total_submission AND $last_submission_result == 'FAILED')
                    $task = "Waiting For Next Submission";
                }else{
                    if($total_submission_with_result == '')
                    $task = "Ticket Are Still Updatable";
                }

                if($task!=''){

                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                    $data[$row_obj->id]['section'][] = 'S3';
                    $data[$row_obj->id]['result_raw'][] = $total_submission. "-" .$total_submission_with_last_machine_status; //$data[$row_obj->id]['result_raw'][] = $total_submission. "-" .$total_submission_with_result;
                }
            }
        }

        if(@$section['S3.2']['de']){

            foreach($result as $i=>$row_obj){

                $task = '';
                $submit_result = $this->get_submission_validation_result($row_obj->id);
                $submit_last_machine_status = $this->get_last_machine_status($row_obj->id);

                $total_submission = count($this->get_rootcause_submission($row_obj->id));
                $total_submission_with_result = $submit_result['total_submission'];
                // $last_submission_result = $submit_result['result'];
                $total_submission_with_last_machine_status = $submit_last_machine_status['total_submission'];
                $last_submission_machine_status = $submit_last_machine_status['machine_status'];

                /*if($total_submission > $total_submission_with_last_machine_status){ //if($total_submission > $total_submission_with_result){
                    $task = "Waiting For Result";
                }*/

                if($total_submission > $total_submission_with_result){
                    $task = "Waiting For Result";
                }

                if($task!=''){

                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                    $data[$row_obj->id]['section'][] = 'S3';
                    $data[$row_obj->id]['result_raw'][] = $total_submission. "-" .$total_submission_with_last_machine_status; //$data[$row_obj->id]['result_raw'][] = $total_submission. "-" .$total_submission_with_result;
                }
            }
        }

        // if(@$section['S3.5']['de']){
        if(@$section['S3.4']['app'] OR @$section['S3.5']['de']){
            
            foreach($result as $i=>$row_obj){

                $task = '';
                $result = $this->get_list_by_status("5"); 
                
                // $submit_result = $this->get_submission_validation_result($row_obj->id);
                $submit_last_machine_status = $this->get_last_machine_status($row_obj->id);
                $total_submission = count($this->get_rootcause_submission($row_obj->id));
                // $total_submission_with_result = $submit_result['total_submission'];
                // $last_submission_result = $submit_result['result'];
                $total_submission_with_last_machine_status = $submit_last_machine_status['total_submission'];
                $last_submission_machine_status = $submit_last_machine_status['machine_status'];

                if($total_submission_with_last_machine_status == $total_submission AND $result AND ($last_submission_machine_status == 'NA' OR $last_submission_machine_status == '')){ 
                // if(($total_submission > $total_submission_with_last_machine_status) AND ($last_submission_machine_status == 'STOP' OR $last_submission_machine_status == '')){ //if($total_submission > $total_submission_with_result){
                    $task = "Waiting For Machine Status Approval"; //$task = "Waiting For Result";
                }

                if($task!=''){

                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                    $data[$row_obj->id]['section'][] = 'S3';
                    $data[$row_obj->id]['result_raw'][] = $total_submission. "-" .$total_submission_with_last_machine_status; //$data[$row_obj->id]['result_raw'][] = $total_submission. "-" .$total_submission_with_result;
                }
            }
        }

        if(@$section['S3.3']['ack']){

            $task = "Need Your Acknowledge Action";

            foreach($result as $i=>$row_obj){
      
                if(@$section['S3.3']['ack']) continue;
                
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
                $data[$row_obj->id]['section'][] = 'S3';
            }
        }

        // if(@$section['S3.5']['de']){

        //     $task = "Need Your Review";

        //     foreach($result as $i=>$row_obj){
                      
        //         $data[$row_obj->id]['details'] = $row_obj;
        //         $data[$row_obj->id]['desc'][] = $task;
        //         $data[$row_obj->id]['section'][] = 'S3';
        //     }
        // }

        $i = 0;
        foreach($data as $id=>$details){
            $return[$i]['id']=$id;
            $return[$i] = $details;
            $i++;
        }
        return $return;
    }

    function section4_task_informer(){
        
        $section = $this->session->userdata['permission'];
        $task = '';
        $data = array();
        $return = array();

        $result = $this->get_list_by_status("5");
        
        if(@$section['S4']['de'] OR (@$section['S4.1']['de'] OR (@$section['S4.1']['app'])))
        {
            
            foreach($result as $i=>$row_obj){

                $task = "Need Your Review";
               
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
                $data[$row_obj->id]['section'][] = 'S4';
            }
        }

        $i = 0;
        foreach($data as $id=>$details){
            $return[$i]['id']=$id;
            $return[$i] = $details;
            $i++;
        }
        return $return;
    }

    function section5_task_informer(){
        
        $section = $this->session->userdata['permission'];
        $task = '';
        $data = array();
        $return = array();

        $result = $this->get_list_by_status(array('6','7'));
        
        if(@$section['S5']['de'] OR (@$section['S5.1']['de'] OR (@$section['S5.1']['app'])))
        {
            foreach($result as $i=>$row_obj){
                $task = "Ticket Waiting For Close";
               
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
                $data[$row_obj->id]['section'][] = 'S5';
            }
        }

        $i = 0;
        foreach($data as $id=>$details){

            $return[$i]['id']=$id;
            $return[$i] = $details;
            $i++;
        }
        return $return;
    }
}
