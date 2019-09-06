<?php
class Modal_Master extends CI_Model 
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
        m.issued_dept,m.to_dept,m.shift,m.ooc,m.oos,substring(convert(varchar,m.datetime,20),1,19) as datetime,m.approval_user_id,
        m.machine_status,m.machine_stop_reason,m.purge_status,m.notify_next_process,
        m.fix_validation_result,m.closedby_user_id,substring(convert(varchar,m.closed_datetime,20),1,19) as closed_datetime,
        s.status_name');
        $this->db->from('qan_machinebreakdown m'); 
        $this->db->join('status s', 's.status_code=m.status','left');
		$this->db->where('id',$this->qan_id);
        $query = $this->db->get(); 
        $data = $query->result_object()[0];

        //$this->data->qan_no = $query->result_object()->qan_no;
        $this->data = (object) array_merge((array) $data,(array) $this->data); 
		// echo $query = $this->db->get_compiled_select();
        //print_r($query->result_object());
        // exit;
         
        if (strpos($data->qan_no, 'TEST') !== false) {
            $this->data->test = 1;
        }
        if(@!$this->data->user) $this->data->user = new stdClass();
        $this->data->user->{$data->issueto_user} = '';
        $this->data->user->{$data->issueby_user_id} = '';
        $this->data->user->{$data->approval_user_id} = '';
        $this->data->user->{$data->closedby_user_id} = '';

        

        // $this->data->user->{$data->reportby_user_id} = '';
        // $this->data->user->{$data->qa_reinsp_verification_user_id} = '';

        foreach($this->data->user As $id => $null){
            $this->data->user->{$id} = $this->Function_materialreviewboard->getUserById($id);
        }

        // $this->db->select('id as mrb_id,scrap,rework,uai,scrap_no,rework_order_no,
        // uai_no,rework_dispo_input,rework_dispo_output,rework_dispo_rej_scrap,
        // reportby_user_id,qa_reinsp_verification_user_id,qa_reinsp_status_accept,
        // qa_reinsp_status_reject,reject_reason');
		// $this->db->from('qan_material_review_board'); 
        // $this->db->where('machine_breakdown_id',$this->qan_id);
        // $this->db->order_by("mrb_id", "desc");
        // $query = $this->db->get(); 
        // $data = $query->result_object()[0];

        // if(count($data) > 0){
        //     $this->data = (object) array_merge((array) $data,(array) $this->data); 
        // }
        // print_r($data);
        // exit;
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
        

        $this->db->select('id as defect_id,part_name,machine_no,process,cav_no,
        up_affected,detectedby_user,defect_description,substring(convert(varchar,last_passed_sample,20),1,19) as last_passed_sample,
        substring(convert(varchar,purge_from,20),1,19) as purge_from,estimate_qty,ack_eng_user,ack_prod_user,ack_qa_user');
		$this->db->from('qan_defect_info'); 
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $query = $this->db->get(); 
        $data = $query->result_object()[0];

        $this->data = (object) array_merge((array) $data,(array) $this->data); 
        
        if(@!$this->data->user) $this->data->user = new stdClass();

        $this->data->user->{$data->ack_eng_user} = '';
        $this->data->user->{$data->ack_prod_user} = '';
        $this->data->user->{$data->ack_qa_user} = '';
        $this->data->user->{$data->detectedby_user} = '';

        foreach($this->data->user As $id => $null){
            $this->data->user->{$id} = $this->Function_materialreviewboard->getUserById($id);
        }

        // print_r($this->data->user);
        // exit;

        //$this->Function_materialreviewboard->getPartNameById($machinedata->part_name);

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


        // print_r($this->data);
        // exit;
    }
    
    function Section2(){ 
        
        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();

        
        $this->db->select('id as mrb_id,scrap,rework,uai,scrap_no,rework_order_no,
        uai_no,rework_dispo_input,rework_dispo_output,rework_dispo_rej_scrap,
        reportby_user_id,qa_reinsp_verification_user_id,qa_reinsp_status_accept,
        qa_reinsp_status_reject,reject_reason,confirmation');
		$this->db->from('qan_material_review_board'); 
        $this->db->where('machine_breakdown_id',$this->qan_id);
        $this->db->order_by("mrb_id", "desc");
        $query = $this->db->get(); 
        $data = $query->result_object();

        // echo $query = $this->db->get_compiled_select();
        // exit;
        // print_r($data);
        // exit;
        if(count($data) > 0){
            $data = $data[0];
            $this->data = (object) array_merge((array) $data,(array) $this->data); 
            $this->data->user->{$data->reportby_user_id} = '';
            $this->data->user->{$data->qa_reinsp_verification_user_id} = '';
        }
        

        foreach($this->data->user As $id => $null){
               
            $this->data->user->{$id} = $this->Function_materialreviewboard->getUserById($id);
            
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
            $this->data->user->{$id} = $this->Function_materialreviewboard->getUserById($id);
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
        $this->db->select('id, process_name');
        $this->db->from('purge_location');
        $this->db->order_by("order_no", "ASC");
        $query = $this->db->get();
        $data = $query->result_object();

        // echo $query = $this->db->get_compiled_select();
        //     exit;
        $this->data->loc_to_purge = $data;
    }

    function get_parts(){
        if(@$this->data->list_partname){
            return;
        }
        $this->db->select('*');
        $this->db->from('model_name');
        $query = $this->db->get();
        $data = $query->result_object();
        $this->data->list_partname = new stdClass();
        foreach($data as $part){
            $this->data->list_partname->{$part->id} = $part->part_name;
        }


    }

    function get_QA_inspector_users(){
        if(@$this->data->user and @$this->data->inspect_user){
            return;
        }
        
        $this->db->select('u.id,u.fullname');
		$this->db->from('users u');
		$this->db->join('user_role ur', 'ur.user_id=u.id');
		$this->db->where('u.dept_id = 1 AND ur.role_id = 1 AND u.title = \'Inspector\' AND u.is_deleted = 0');
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
    }

    function Section3(){

        $this->get_qasample_location();
        $this->get_production_location();
        $this->get_parts();
        $this->get_purge_location();
        $this->get_QA_inspector_users();
        $this->get_inspection_machine();
    
        // $this->db->select('rf.machine_breakdown_id,rf.id as root_cause_failure_id,rf.root_cause,rf.corrective_action,rf.rcfa_pic_user_id,rf.rcfa_ack_user_id,rf.rcfa_appr_user_id,
		// rs.id AS root_cause_submission_id,rs.completion_user_id,rs.completion_datetime,rs.submission_no');
		// $this->db->from('qan_rootcause_failure rf');
		// $this->db->join('qan_rootcause_submission rs', 'rs.root_cause_failure_id=rf.id','left');
		// $this->db->where('rf.machine_breakdown_id',$this->qan_id);
		// $query = $this->db->get(); 
        // $data = $query->result_object
        $this->db->select('id AS submission_id, machine_breakdown_id,root_cause,corrective_action,rcfa_pic_user_id,rcfa_ack_user_id,rcfa_appr_user_id,
		id AS root_cause_submission_id,completion_user_id,substring(convert(varchar,completion_datetime,20),1,19) as completion_datetime,submission_no');
		$this->db->from('qan_validation_submission');
		$this->db->where('machine_breakdown_id',$this->qan_id);
		$query = $this->db->get(); 
        $data = $query->result_object();

        $this->data->inspection_machine_data = $data;

        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
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

            // echo $submission_data->submission_id.' : ';
            // echo $this->get_submission_validation_result($this->qan_id,$submission_data->submission_id);
            // echo '<br>';

        }
        //exit;
        foreach($this->data->user As $id => $null){
            $this->data->user->{$id} = $this->Function_materialreviewboard->getUserById($id);
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
        return $query->result_object()[0];
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
        // echo '<pre>';
        //  echo $query = $this->db->get_compiled_select();
        // exit;
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

        if($qan_id>0){
            $this->db->select('id,result'); 
            $this->db->from('qan_rootcause_item_inspection'); 
            $this->db->where('machine_breakdown_id',$qan_id);
            if($root_cause_submission_id>0){
                $this->db->where('root_cause_submission_id',$root_cause_submission_id);
            }
            else{
                $this->db->order_by('id','DESC');
                //$this->db->limit(1);
            }
            $query = $this->db->get();
            $query_result = $query->result_object();

            // echo $query = $this->db->get_compiled_select();
            // exit;
            $submission_info = $this->get_submission_result($qan_id);

            if($submission_info) $return['total_submission'] = count($submission_info);
            else $return['total_submission'] = 0;

            if(count($query_result)>0){
                $expected_result = 1;

                foreach($query_result as $i=>$inspection_data){
                    if($i>0)continue;
                    if($inspection_data->result === $expected_result){
                        $return['result'] = "PASS";
                    }
                    else{
                        $return['result'] = "FAILED";
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

        // echo $query = $this->db->get_compiled_select();
        
    }

    function get_defect_info($qan_id=0,$select='*'){
        if($qan_id > 0){
            $this->db->select($select);
            $this->db->from('qan_defect_info'); 
            $this->db->where('machine_breakdown_id',$qan_id);

            $query = $this->db->get();
            if($query->num_rows()>0)
                return $query->result_object()[0];
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
        
        //$this->db->where('MONTH(m.datetime) = 8 AND YEAR(m.datetime) = 2019');

        // $query = $this->db->get();

        echo $query = $this->db->get_compiled_select();
        exit;
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

        // echo $query = $this->db->get_compiled_select();
        // exit;
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
            }

        }
        if(@$section['S1']['ack']){

            $result = array_merge($result,$this->get_list_by_status("3"));
            $task = "Need Your Acknowledge Action";

            foreach($result as $i=>$row_obj){
                $acks = $this->get_sec1_ack_list($row_obj->id);
            
                if(@$section['S1.5']['ack'] and $acks->ack_eng_user>0) continue;
                if(@$section['S1.6']['ack'] and $acks->ack_prod_user>0) continue;
                if(@$section['S1.7']['ack'] and $acks->ack_qa_user>0) continue;
                
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
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
        
        $result = $this->get_list_by_status(array('4','5','6')); //both PROD and MRB colobrate in this level

        if(@$section['S2.1']['de']){ //PROD

            foreach($result as $i=>$row_obj){

                if($this->get_mrb_finalize_score($row_obj->id) !=11 AND $this->get_mrb_finalize_score($row_obj->id) !=1){
                    $task = "Please Update Affected Quantity & Finalize";
                
                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
                }
            }
        }
        if(@$section['S2.2']['de']){
            
            foreach($result as $i=>$row_obj){

                if(count($this->check_purge_data($row_obj->id)) > 0 AND $this->get_mrb_finalize_score($row_obj->id) < 10){
                    $task = "Please Update Reject Quantity & Finalize";
                    $data[$row_obj->id]['details'] = $row_obj;
                    $data[$row_obj->id]['desc'][] = $task;
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

                $submit_result = $this->get_submission_validation_result($row_obj->id);
                if($submit_result['total_submission'] == 0){
                    $task = "Waiting First Submission";
                }
                if($submit_result['result']=='FAILED'){
                    $task = "Next Submission is Pending";
                }
                if($submit_result['result']=='NA'){
                    $task = "Waiting For Result";
                }

                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
            }

        }

        if(@$section['S3.2']['de']){

            foreach($result as $i=>$row_obj){

                $submit_result = $this->get_submission_validation_result($row_obj->id);
                if($submit_result['total_submission'] == 0 OR($submit_result['total_submission'] <1)){
                    $task = "Next Submission is Pending";
                }
                if($submit_result['result']=='FAILED'){
                    $task = "Next Submission is Pending";
                }
                if($submit_result['result']=='NA'){
                    $task = "Waiting For Result";
                }

                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
            }

        }

   
        if(@$section['S3.3']['ack']){

            $task = "Need Your Acknowledge Action";

            foreach($result as $i=>$row_obj){
      
                if(@$section['S3.3']['ack']) continue;
                
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
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

    function section4_task_informer(){
        
        $section = $this->session->userdata['permission'];
        $task = '';
        $data = array();
        $return = array();

        
        $result = $this->get_list_by_status("5");
        
        if(@$section['S4']['de'] OR (@$section['S4.1']['de'] OR (@$section['S4.1']['app']))){
            
            foreach($result as $i=>$row_obj){
                $task = "Need Your Review";
               
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
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

        
        $result = $this->get_list_by_status("7");
        
        if(@$section['S5']['de'] OR (@$section['S5.1']['de'] OR (@$section['S5.1']['app']))){
            
            foreach($result as $i=>$row_obj){
                $task = "Ticket Waiting For Close";
               
                $data[$row_obj->id]['details'] = $row_obj;
                $data[$row_obj->id]['desc'][] = $task;
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
