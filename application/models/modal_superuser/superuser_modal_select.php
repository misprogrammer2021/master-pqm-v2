<?php
class SuperUser_modal_select extends CI_Model 
{
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

        $this->qan_id = $qan_id;
        $this->db->select('m.id,m.qan_no,m.status,m.issueby_user_id,m.issueto_user,
        m.issued_dept,m.to_dept,m.shift,m.ooc,m.oos,m.visual,substring(convert(varchar,m.datetime,20),1,19) as datetime,m.approval_user_id,
        m.machine_status,m.machine_stop_reason,m.purge_status,m.notify_next_process,
        m.fix_validation_result,m.closedby_user_id,substring(convert(varchar,m.closed_datetime,20),1,19) as closed_datetime,
        s.status_name');
        $this->db->from('qan_machinebreakdown m'); 
        $this->db->join('status s', 's.status_code=m.status','left');
		$this->db->where('id',$this->qan_id);
        $query = $this->db->get(); 

        if($query->num_rows()> 0){
            $data = $query->result_object()[0];
        }else{
            $data = $query->result_object();
        }

        $this->data = (object) array_merge((array) $data,(array) $this->data); 

        if (strpos(@$data->qan_no, 'TEST') !== false) {
            $this->data->test = 1;
        }

        if(@!$this->data->user) $this->data->user = new stdClass();
        $this->data->user->{$data->issueto_user} = '';
        $this->data->user->{$data->issueby_user_id} = '';
        $this->data->user->{$data->approval_user_id} = '';
        $this->data->user->{$data->closedby_user_id} = '';

        foreach($this->data->user As $id => $null){
            
            $this->data->user->{$id} = $this->admin_modal_select->get_user_by_id($id);
        }
    }

    function get_data(){
        return $this->data;
    }

    function Section1(){

        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        $this->get_defect_desc();
        $this->get_machine_no();
        $this->get_detected_by();
        
        $this->db->select('id as defect_id,part_name,machine_no_id,machine_no,process,cav_no,
        up_affected,detectedby_user,defect_description_id,defect_description_name,defect_description_others,substring(convert(varchar,last_passed_sample,20),1,19) as last_passed_sample,
        substring(convert(varchar,purge_from,20),1,19) as purge_from,estimate_qty,ack_eng_user,ack_prod_user,ack_qa_user');
		$this->db->from('qan_defect_info'); 
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $query = $this->db->get(); 
        $data = @$query->result_object()[0];

        $this->data = (object) array_merge((array) $data,(array) $this->data); 
        
        if(@!$this->data->user) $this->data->user = new stdClass();

        $this->data->user->{@$data->ack_eng_user} = '';
        $this->data->user->{@$data->ack_prod_user} = '';
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
    }
    
    function Section2(){ 
        
        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        $this->get_defect_desc();
        $this->get_process();
        $this->get_machine_no();
        $this->get_detected_by();
        
        $this->db->select('id as mrb_id,scrap,rework,uai,scrap_no,rework_order_no,
        uai_no,rework_dispo_input,rework_dispo_output,rework_dispo_rej_scrap,
        reportby_user_id,qa_reinsp_verification_user_id,qa_reinsp_status_accept,
        qa_reinsp_status_reject,reject_reason,confirmation');
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
            $this->db->select('purge_location_id,affected_qty,good_qty,
            reject_qty,prod_pic_user_id,qa_buyoff_user_id');
            $this->db->from('qan_purge');
            $this->db->where('mrb_id',$this->data->mrb_id);
            $query = $this->db->get(); 
            $data = $query->result_object();
            $this->data->purge_location = $data;
        }

        if(count($data) > 0){
            $data = $data[0];
            $this->data = (object) array_merge((array) $data,(array) $this->data); 
            $this->data->user->{$data->prod_pic_user_id} = '';
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
        $this->db->where('is_active = 0 AND order_no <= 14');
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
        $this->db->where('show_process = 0');

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
        $this->db->where('is_deleted = 0');
        $query = $this->db->get();
        $data = $query->result_object();
        $this->data->list_partname = new stdClass();
        foreach($data as $part){
            $this->data->list_partname->{$part->id} = $part->part_name;
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
		}
		else
		{
			return false;
		}
	}

    function get_defect_desc($id=0,$defect_type=0){

        if(@$this->data->list_defect AND $id == 0){
            return $this->data->list_defect;
        }

        $this->db->select('*');
        $this->db->from('defectives_list');
        if($defect_type != ''){
            $defect_type = explode(',',$defect_type);
            if(@count($defect_type) > 0) $this->db->where_in('defect_type',$defect_type);
        }
        
        if($id > 0){
            $this->db->where('id = '.$id);
        }

        $this->db->where('is_active = 0');
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

    function get_detected_by(){

		$this->db->select('*');
        $this->db->from('detected_by'); 
        $this->db->where('is_active = 0');
		$this->db->order_by('id','asc');         
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

    function get_QA_inspector_users(){

        if(@$this->data->user and @$this->data->inspect_user){
            return;
        }
        
        $this->db->select('u.id,u.fullname');
		$this->db->from('users u');
		$this->db->join('user_role ur', 'ur.user_id=u.id');
		$this->db->where('u.dept_id = 1 AND ur.role_id = 1 AND u.title = \'Inspector\' AND u.status = 0');
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
        $this->get_defect_desc();
        $this->get_rootcause();
        $this->get_corrective_action();
        $this->get_process();
        $this->get_machine_no();
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

        $this->db->select('id AS submission_id, machine_breakdown_id,root_cause_id,root_cause,corrective_action_id,corrective_action,rcfa_pic_user_id,rcfa_ack_user_id,rcfa_appr_user_id,
		id AS root_cause_submission_id,completion_user_id,substring(convert(varchar,completion_datetime,20),1,19) as completion_datetime,submission_no');
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
            $this->db->where('is_deleted = 0');
            $query = $this->db->get();
            $data = $query->result_object();
            $this->data->list_rootcause = new stdClass();
            foreach($data as $rootcause){
                $this->data->list_rootcause->{$rootcause->id} = $rootcause->root_cause;
            }
        }else{
            $this->db->select('*');
            $this->db->from('root_cause_list');
            $this->db->where('is_deleted = 0');
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
            $this->db->where('is_deleted = 0');
            $query = $this->db->get();
            $data = $query->result_object();
            $this->data->list_corrective_action = new stdClass();
            foreach($data as $corrective){
                $this->data->list_corrective_action->{$corrective->id} = $corrective->corrective_action;
            }
        }else{
            $this->db->select('*');
            $this->db->from('corrective_action_list');
            $this->db->where('is_deleted = 0');
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

    function get_sec1_ack_list($qan_id=0){

        $this->db->select('ack_eng_user,ack_prod_user,ack_qa_user'); 
        $this->db->from('qan_defect_info'); 

        if($qan_id > 0){
            $this->db->where('machine_breakdown_id',$qan_id);
        }

        $query = $this->db->get(); 
        
        if(isset($query->result_object()[0])){
            return $query->result_object()[0];
        }else{
            $ack = new stdClass();
            $ack->ack_eng_user = ''; 
            $ack->ack_prod_user = ''; 
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
                
                if($root_cause_submission_id==0){
                    $return['result'] = $query_result[0]->overall == 0?'FAILED':'PASS';
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
        }
        else{
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
        $this->db->select('m.*, s.status_name'); 
        $this->db->from('qan_machinebreakdown m');
        $this->db->join('status s','s.status_code=m.status','left');

        if($not){
            if(is_array($status)){
                $this->db->where_not_in('m.status', $status);
            }else{
                $this->db->where('m.status !=\'' . $status . '\' and s.status_name != \'' . $status . '\'');
            }
        }
        else{
            if(is_array($status)){
                $this->db->where_in('m.status', $status);
            }else{
                $this->db->where('m.status =\'' . $status . '\' or s.status_name = \'' . $status . '\'');
            }
        }
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result_object();
    }

    function get_status_by_ticket_id($qan_id=0){

        $this->db->select('m.id,s.*'); 
        $this->db->from('qan_machinebreakdown m');
        $this->db->join('status s','s.status_code=m.status','left');
        $this->db->where('id',$qan_id);

        $query = $this->db->get(); 
        return $query->result_object()[0];
    }

    function get_defect_info($qan_id=0,$select='*'){

        if($qan_id > 0){
            $this->db->select($select);
            $this->db->from('qan_defect_info di'); 
            $this->db->where('machine_breakdown_id',$qan_id);

            $query = $this->db->get();
            if($query->num_rows()>0){
            
                return $query->result_object()[0];
            }else{
                $y = new stdClass();
                $y->defect_description_name = ''; 
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
}
