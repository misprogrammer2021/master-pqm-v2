<?php

    require_once APPPATH . 'core/MY_FrontEnd.php';
    defined('BASEPATH') OR exit('No direct script access allowed');

    class SuperUser extends MY_FrontEnd {

        private $data = array();

        public function __construct() {
            parent::__construct();

            // Load form helper library
            $this->load->helper('form');
            $this->load->helper('url');
    
            // Load form validation library
            $this->load->library('form_validation');
    
            // Load database
            $this->load->model('login_database');
            $this->load->model('modal_master');
            $this->load->model('modal_create');
            $this->load->model('modal_update');
            $this->load->model('modal_delete');
            $this->load->model('modal_admin/admin_modal_select');
            $this->load->model('modal_superuser/superuser_modal_create');
            $this->load->model('modal_superuser/superuser_modal_select');
            $this->load->model('modal_superuser/superuser_modal_update');
            $this->load->model('modal_superuser/superuser_modal_delete');
        
            date_default_timezone_set('Asia/Kuala_Lumpur');
        }

        public function homepage(){

            $this->data['title'] = "JCY Product Quality System";
            $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
            $this->data['description'] = "Overview";

            $this->header($this->data);
            $this->topbar($this->data);
            $this->leftsidebar($this->data);
            $this->rightsidebar($this->data);
            $this->load->view('SuperUser/QAN/homepage',$this->data);
            $this->footer();
        
        }

        public function dashboard_closed_ticket(){

            $this->data['title'] = "JCY Product Quality System";
            $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
            $this->data['description'] = "Overview";

            $this->header($this->data);
            $this->topbar($this->data);
            $this->leftsidebar($this->data);
            $this->rightsidebar($this->data);
            $this->load->view('SuperUser/QAN/dashboard_closed_ticket',$this->data);
            $this->footer();
            
        }

        public function superuser_ajax_active_list(){

            $result = $this->superuser_modal_select->get_list_by_status('99',true);
            
            foreach($result as $i=>$row){

                $result[$i]->ack =  $this->superuser_modal_select->get_sec1_ack_list($row->id);
                $result[$i]->submission = $this->superuser_modal_select->get_submission_result($row->id);
                $result[$i]->total_submission = $this->superuser_modal_select->get_last_machine_status($row->id);
                $result[$i]->machine_status = $this->superuser_modal_select->get_last_machine_status($row->id);
                // $result[$i]->result_insepection = $this->superuser_modal_select->get_last_result_inspection($row->id);
                $result[$i]->last_qa_result = $this->superuser_modal_select->get_submission_validation_result($row->id);
                $result[$i]->part_name = $this->superuser_modal_select->get_partname($row->id,'part_name');
                $result[$i]->machine_name = $this->superuser_modal_select->get_machinename($row->id,'machine_name');
                $result[$i]->sector_name = $this->superuser_modal_select->get_machinename($row->id,'sector_name');
                // $result[$i]->defect = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name');
                $result[$i]->defect_description_name = $this->modal_master->get_defect_info($row->id,'defect_description_name');
                $result[$i]->defect_type = $this->modal_master->get_defect_info($row->id,'defect_type');

                // $result[$i]->defect1 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_1');
                // $result[$i]->defect2 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_2');
                // $result[$i]->defect3 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_3');
                // $result[$i]->defect4 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_4');
                // $result[$i]->defect5 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_5');
                // $result[$i]->ack =  $this->superuser_modal_select->get_sec1_ack_list($row->id);
                // $result[$i]->submission = $this->superuser_modal_select->get_submission_result($row->id);
                // $result[$i]->aff_rej = $this->superuser_modal_select->get_aff_rej_qty($row->id);
                // $result[$i]->defect = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name');
                
            }
            $data = array(
                'data' =>$result
            );
            echo json_encode($data);
        }

        public function superuser_ajax_closed_list(){

            $result = $this->superuser_modal_select->get_list_by_status('99');
            
            foreach($result as $i=>$row){

                $result[$i]->ack =  $this->superuser_modal_select->get_sec1_ack_list($row->id);
                $result[$i]->submission = $this->superuser_modal_select->get_submission_result($row->id);
                $result[$i]->total_submission = $this->superuser_modal_select->get_last_machine_status($row->id);
                $result[$i]->machine_status = $this->superuser_modal_select->get_last_machine_status($row->id);
                // $result[$i]->result_insepection = $this->superuser_modal_select->get_last_result_inspection($row->id);
                $result[$i]->last_qa_result = $this->superuser_modal_select->get_submission_validation_result($row->id);
                $result[$i]->part_name = $this->superuser_modal_select->get_partname($row->id,'part_name');
                $result[$i]->machine_name = $this->superuser_modal_select->get_machinename($row->id,'machine_name');
                $result[$i]->sector_name = $this->superuser_modal_select->get_machinename($row->id,'sector_name');
                // $result[$i]->defect = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name');
                $result[$i]->defect_description_name = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name');
                $result[$i]->defect_type = $this->superuser_modal_select->get_defect_info($row->id,'defect_type');

                // $result[$i]->defect1 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_1');
                // $result[$i]->defect2 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_2');
                // $result[$i]->defect3 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_3');
                // $result[$i]->defect4 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_4');
                // $result[$i]->defect5 = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name_5');
                // $result[$i]->ack =  $this->superuser_modal_select->get_sec1_ack_list($row->id);
                // $result[$i]->submission = $this->superuser_modal_select->get_submission_result($row->id);
                // $result[$i]->aff_rej = $this->superuser_modal_select->get_aff_rej_qty($row->id);
                // $result[$i]->defect = $this->superuser_modal_select->get_defect_info($row->id,'defect_description_name');
            }
            $data = array(
                'data' =>$result
            );
            echo json_encode($data);
        }

        public function get_defect_desc(){

            $types = $this->input->post('defect_type');
            if($types == ''){
                $result = array();
            }else{
                $result = $this->superuser_modal_select->get_defect_desc(0,$types);
            }
            
            echo json_encode($result);
        }

        public function get_machine(){

            $sector_id = $this->input->post('sector_id')>0?$this->input->post('sector_id'):0;
            $result = $this->superuser_modal_select->get_machine_no($sector_id,true);
            echo json_encode($result);
        }

        public function index($qan_id=0){
                
            $this->data['title'] = "JCY Product Quality System";
            $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
            $this->data['description'] = "Overview";
            $this->data['jsselect'] = TRUE;

            $this->header($this->data);
            $this->topbar($this->data);
            $this->leftsidebar($this->data);
            $this->rightsidebar($this->data);

            if($qan_id < 1 and isset($_POST['machine_breakdown_id']) and ($_POST['machine_breakdown_id']) > 0){
                $qan_id = $this->input->post('machine_breakdown_id');
            }
            if($qan_id > 0){
                
                $this->superuser_modal_select->load_qan($qan_id);
                $this->superuser_modal_select->Section1();
                $this->superuser_modal_select->Section2();
                $this->superuser_modal_select->Section3();

                $view['data'] = $this->superuser_modal_select->get_data();
                // echo '<pre>';
                // print_r($view);
                
                // echo '</pre>';
                // exit;

                $view['data']->submit_button = new stdClass();

                if(@$this->session->userdata['permission']['QASU1']['de'] OR @$this->session->userdata['permission']['QASU1']['ack'] OR @$this->session->userdata['permission']['QASU1']['app'])
                {    
                    $view['data']->submit_button->s1 = array();

                    if(@$this->session->userdata['permission']['QASU1']['de'] OR @$this->session->userdata['permission']['QASU1']['ack']){
                        $button_obj = new stdClass();
                        $button_obj->name = 'UPDATE';
                        $button_obj->value = 'update_section1';
                        $button_obj->action = base_url().'SuperUser/index/';
                        array_push($view['data']->submit_button->s1,$button_obj);
                    }
                }

                if(@$this->session->userdata['permission']['PRODSU2']['de'] OR @$this->session->userdata['permission']['PRODSU2']['ack'] OR @$this->session->userdata['permission']['PRODSU2']['app']) //6
                {
                    $show_create_update = true;
                    $show_finalize = true;

                    if(@$view['data']->mrb_id < 1){
                        $show_finalize = false;
                    }

                    if(@$view['data']->confirmation >= 11 OR (@$this->session->userdata['permission']['MRBSU2.4']['de'] and @$view['data']->confirmation == 10) OR (@$this->session->userdata['permission']['QASU2.6']['de'] and @$view['data']->confirmation == 1)){ 
                        $show_create_update = false;
                        $show_finalize = false;
                    }

                    if($show_create_update){

                        $button_obj = new stdClass();
                        $btn_sec2 = '';
                        $val_sec2 = 'update_section2';

                        if($this->session->userdata['permission']['PRODSU2']['de'] OR @$this->session->userdata['permission']['PRODSU2.1']['de'] OR @$this->session->userdata['permission']['MRBSU2.2']['de'] OR @$this->session->userdata['permission']['MRBSU2.3']['de'] OR @$this->session->userdata['permission']['MRBSU2.4']['de'] OR @$this->session->userdata['permission']['QASU2.6']['de']) //NEW ADDED and ($view['data']->status == '6')
                        {
                            $view['data']->submit_button->s2 = array();

                            if( (@$this->session->userdata['permission']['MRBSU2.2']['de'] OR @$this->session->userdata['permission']['MRBSU2.3']['de']) AND (@$view['data']->mrb_id > 0) )
                            {
                                if(@$view['data']->reportby_user_id > 0){
                                    $btn_sec2 = 'UPDATE';
                                    $val_sec2 = 'update_section2';
                                }
                            }

                            if(@$this->session->userdata['permission']['PRODSU2.1']['de']) //@$this->session->userdata['permission']['MRBSU2.2']['de'] OR @$this->session->userdata['permission']['MRBSU2.3']['de'] OR @$this->session->userdata['permission']['MRBSU2.4']['de']
                            {
                                if(@$view['data']->mrb_id > 0){
                                    $btn_sec2 = 'UPDATE';
                                    $val_sec2 = 'update_section2';
                                    $show_finalize = false;
                                }else{
                                    $btn_sec2 = 'CREATE';
                                    $val_sec2 = 'create_section2';
                                } 
                            }

                            // if(@$this->session->userdata['permission']['QASU2.6']['de'] AND @$view['data']->mrb_id > 0)
                            // {
                            //     $btn_sec2 = 'UPDATE';
                            //     $val_sec2 = 'update_section2';
                            // }

                            if(@$this->session->userdata['permission']['QASU2.6']['de'])
                            {
                                $btn_sec2 = 'UPDATE';
                                $val_sec2 = 'update_section2';
                            }
                                
                            if($btn_sec2 !== ''){
                                $button_obj->name = $btn_sec2;
                                $button_obj->value = $val_sec2;
                                $button_obj->action = base_url().'SuperUser/index/';
                                array_push($view['data']->submit_button->s2,$button_obj);
                            }
                        }
                    }

                    if($show_finalize){
                   
                        $button_obj = new stdClass();
                        $button_obj->name = 'FINALIZE';
                        $button_obj->value = 'final_section2';
                        $button_obj->action = base_url().'SuperUser/index/';
                        array_push($view['data']->submit_button->s2,$button_obj);
                    }
                }

                if(@$this->session->userdata['permission']['ENGSU3']['de'] OR @$this->session->userdata['permission']['ENGSU3']['ack'] OR @$this->session->userdata['permission']['ENGSU3']['app'])
                {
                    $view['data']->submit_button->s3 = array();

                    if(@$this->session->userdata['permission']['ENGSU3']['de'] or @$this->session->userdata['permission']['ENGSU3']['ack'])
                    {

                        $button_obj = new stdClass();
                        $btn = '';
                        $val = 'update_section3';

                        $last_inspection_data = @$view['data']->inspection_machine_data;
                        if(count( @$view['data']->inspection_machine_data)) 

                        $last_inspection_data = array_values(array_slice(@$view['data']->inspection_machine_data, -1))[0];

                        if(@$this->session->userdata['permission']['QASU3.2']['de'])
                        {
                            $btn = 'UPDATE';
                        }

                        if(@$this->session->userdata['permission']['ENGSU3.1']['de'])
                        {
                            if(@$last_inspection_data->root_cause_submission_id < 1){
                                $btn = 'CREATE';
                                $val = 'create_section3';
                            }elseif(is_array(@$last_inspection_data->inspection_data) AND count(@$last_inspection_data->inspection_data) == 0){
                                $btn = 'UPDATE';
                            }elseif((is_array(@$last_inspection_data->inspection_data) AND count(@$last_inspection_data->inspection_data) > 0) AND (@$last_inspection_data->root_cause_submission_id > 0) AND (@$last_inspection_data->submission_no > 0) AND (@$last_inspection_data->machine_status !== '')){
                                $btn = 'CREATE';
                                $val = 'create_section3';
                            }else{
                                if((is_array(@$last_inspection_data->inspection_data) AND count(@$last_inspection_data->inspection_data) > 0) AND (@$last_inspection_data->root_cause_submission_id < 0) AND (@$last_inspection_data->submission_no > 0)){
                                    $btn = '';
                                }
                            }
                        }

                        if($btn !== ''){
                            $button_obj->name = $btn;
                            $button_obj->value = $val;
                            $button_obj->action = base_url().'SuperUser/index/';
                            array_push($view['data']->submit_button->s3,$button_obj);
                        }
                    }
                }
    
                if(@$this->session->userdata['permission']['QASU4']['de'] OR @$this->session->userdata['permission']['QASU4']['ack'] OR @$this->session->userdata['permission']['QASU4']['app'])
                {
                    $view['data']->submit_button->s4 = array();
                    $button_obj = new stdClass();
                    $button_obj->name = 'APPROVE';
                    $button_obj->value = 'update_section4';
                    $button_obj->action = base_url().'SuperUser/index/'.$qan_id;
                    array_push($view['data']->submit_button->s4,$button_obj);
                }

                if(@$this->session->userdata['permission']['QASU5']['de'] OR @$this->session->userdata['permission']['QASU5']['ack'] OR @$this->session->userdata['permission']['QASU5']['app'])
                {
                    $view['data']->submit_button->s5 = array();
                    $button_obj = new stdClass();
                    if(@$view['data']->confirmation >= 11 AND @$this->session->userdata['permission']['QASU5']['de'] AND @$view['data']->closedby_user_id == ''){
                        $button_obj->name = 'CLOSED';
                        $button_obj->value = 'update_section5';
                        $button_obj->action = base_url().'SuperUser/index/';
                        array_push($view['data']->submit_button->s5,$button_obj);
                    }
                }
            }
    
            $view['data']->user->{$this->session->userdata['logged_in']['id']} = $this->admin_modal_select->get_user_by_id($this->session->userdata['logged_in']['id']);

            //section 3 user id assigning and placement
            /*
            "rcfa_pic_user_id" -->permission[S3.1]['de']
            "rcfa_ack_user_id" -->permission[S3.3]['ack']
            "rcfa_appr_user_id" -->permission[S3.4]['app']
            "rcfa_appr_user_id" -->permission[S3.1]['de']
            */
    
            $i = -1;

            if( is_array(@$view['data']->inspection_machine_data) AND count(@$view['data']->inspection_machine_data)>0 ){
            
                foreach($view['data']->inspection_machine_data as $i => $rcsubmissiondata){
                    if(@$view['data']->inspection_machine_data[$i]->rcfa_pic_user_id<1 and @$this->session->userdata['permission']['S3.1']['de']){
                        $view['data']->inspection_machine_data[$i]->rcfa_pic_user_id = $this->session->userdata['logged_in']['id'];
                    }
                    if(@$view['data']->inspection_machine_data[$i]->rcfa_ack_user_id<1 and @$this->session->userdata['permission']['S3.3']['ack']){
                        $view['data']->inspection_machine_data[$i]->rcfa_ack_user_id = $this->session->userdata['logged_in']['id'];
                    }
                    if(@$view['data']->inspection_machine_data[$i]->rcfa_appr_user_id<1 and @$this->session->userdata['permission']['S3.4']['app']){
                        $view['data']->inspection_machine_data[$i]->rcfa_appr_user_id = $this->session->userdata['logged_in']['id'];
                    }
                    if(@$view['data']->inspection_machine_data[$i]->completion_user_id<1 and @$this->session->userdata['permission']['S3.1']['de']){
                        $view['data']->inspection_machine_data[$i]->completion_user_id = $this->session->userdata['logged_in']['id'];
                    }
                    if(@$view['data']->inspection_machine_data[$i]->approval_user_id<1 and @$this->session->userdata['permission']['S3.5']['de']){
                        $view['data']->inspection_machine_data[$i]->approval_user_id = $this->session->userdata['logged_in']['id'];
                    }
                }
            }

            $last_submit_result = $this->superuser_modal_select->get_submission_validation_result($qan_id);

            $last_machine_status = $this->superuser_modal_select->get_last_machine_status($qan_id);

            // if($i < 0 OR (@$this->session->userdata['permission']['ENGSU3.1']['de'] and $i<$last_submit_result['total_submission'])){ //and $last_submit_result['result']!='PASS'
            if( $last_machine_status['total_submission'] < 1 or (@$this->session->userdata['permission']['ENGSU3.1']['de'] and $last_machine_status['machine_status']=='STOP') )
            {
                $i = $i+1;

                // if($last_submit_result['result']=='FAILED'){
                //     $i = $last_submit_result['total_submission'];
                // }

                $view['data']->inspection_machine_data[$i] = new stdClass();
                $view['data']->inspection_machine_data[$i]->submission_id = '';
                $view['data']->inspection_machine_data[$i]->root_cause = '';
                $view['data']->inspection_machine_data[$i]->corrective_action = '';
                $view['data']->inspection_machine_data[$i]->rcfa_pic_user_id = @$this->session->userdata['permission']['S3.1']['de']?$this->session->userdata['logged_in']['id']:'';
                $view['data']->inspection_machine_data[$i]->rcfa_ack_user_id = @$this->session->userdata['permission']['S3.3']['ack']?$this->session->userdata['logged_in']['id']:'';
                $view['data']->inspection_machine_data[$i]->rcfa_appr_user_id = @$this->session->userdata['permission']['S3.4']['app']?$this->session->userdata['logged_in']['id']:'';
                $view['data']->inspection_machine_data[$i]->completion_user_id = @$this->session->userdata['permission']['S3.1']['de']?$this->session->userdata['logged_in']['id']:'';
                $view['data']->inspection_machine_data[$i]->approval_user_id = @$this->session->userdata['permission']['S3.5']['de']?$this->session->userdata['logged_in']['id']:'';
            }

            $view['show_allsection'] = TRUE;

            /*
            if(@$this->session->userdata['permission']['QASU1']['de'] OR @$this->session->userdata['permission']['QASU3']['de'] OR @$this->session->userdata['permission']['QASU4']['de'] OR @$this->session->userdata['permission']['QASU5']['de'] OR @$this->session->userdata['permission']['QASU3.2']['de'] OR @$this->session->userdata['permission']['QASU3.4']['app'] OR @$this->session->userdata['permission']['QASU3.5']['de'])
            {
                // $view['show_section1'] = TRUE;
                // $view['show_section3'] = TRUE;
                // $view['show_section2'] = TRUE;
                // $view['show_section4'] = TRUE;
                // $view['show_section5'] = TRUE;

                $view['show_allsection'] = TRUE;
            }

            if(@$this->session->userdata['permission']['ENGSU3']['de'] OR @$this->session->userdata['permission']['ENGSU3.1']['de'] OR @$this->session->userdata['permission']['ENGSU3.3']['ack'] OR @$this->session->userdata['permission']['QASU3.4']['app'] OR @$this->session->userdata['permission']['QASU3.5']['de'])
            {
                // $view['show_section3'] = TRUE;

                // $view['show_section1'] = TRUE;
                // $view['show_section3'] = TRUE;
                // $view['show_section2'] = TRUE;
                // $view['show_section4'] = TRUE;
                // $view['show_section5'] = TRUE;

                $view['show_allsection'] = TRUE;
            }

            if(@$this->session->userdata['permission']['PRODSU2']['de'] OR @$this->session->userdata['permission']['PRODSU2.1']['de'] OR @$this->session->userdata['permission']['PRODSU2.5']['de'] OR @$this->session->userdata['permission']['MRBSU2.2']['de'] OR @$this->session->userdata['permission']['MRBSU2.3']['de'] OR @$this->session->userdata['permission']['MRBSU2.4']['de'] OR @$this->session->userdata['permission']['QASU2.6']['de'])
            {
                // $view['show_section2'] = TRUE;

                // $view['show_section1'] = TRUE;

                // $view['show_section3'] = TRUE;

                // $view['show_section2'] = TRUE;
                // $view['show_section3'] = TRUE;
                // $view['show_section4'] = TRUE;
                // $view['show_section5'] = TRUE;

                $view['show_allsection'] = TRUE;
            }
            */
            
            //Check submit button of section 1
            if($this->input->post('submit') == 'create_section1' OR $this->input->post('submit') == 'update_section1') 
            {
                $data = new stdClass();
                if(isset($_POST['test'])) $data->test = @$this->input->post('test') == 1? TRUE:FALSE;
                if(isset($_POST['issued_by_user_id'])) $data->issueby_user_id = $this->session->userdata['logged_in']['id'];
                if(isset($_POST['issueto_user_id'])) $data->issueto_user = $this->input->post('issueto_user_id');
                if(isset($_POST['issued_dept'])) $data->issued_dept= $this->input->post('issued_dept');
                if(isset($_POST['to_dept'])) $data->to_dept= $this->input->post('to_dept');
                if(isset($_POST['datetime'])) $data->datetime= $this->input->post('datetime');
                if(isset($_POST['shift'])) $data->shift = $this->input->post('shift');
                if(isset($_POST['rule_name'])) $data->rule_name = $this->input->post('rule_name');
                // if(isset($_POST['ooc'])) $data->ooc= $this->input->post('ooc');
                // if(isset($_POST['oos'])) $data->oos= $this->input->post('oos');
                // if(isset($_POST['visual'])) $data->visual= $this->input->post('visual');
                if(isset($_POST['part_name'])) $data->part_name = $this->input->post('part_name'); 
                if(isset($_POST['machine_no_id'])) $data->machine_no_id = $this->input->post('machine_no_id');
                if(isset($_POST['process'])) $data->process= $this->input->post('process');
                if(isset($_POST['detectedby_user'])) $data->detectedby_user = $this->input->post('detectedby_user');
                /*
                if(isset($_POST['defect_description_name_1'])) $data->defect_description_id_1 = $this->input->post('defect_description_name_1');
                if(isset($_POST['defect_description_name_2'])) $data->defect_description_id_2 = $this->input->post('defect_description_name_2');
                if(isset($_POST['defect_description_name_3'])) $data->defect_description_id_3 = $this->input->post('defect_description_name_3');
                if(isset($_POST['defect_description_name_4'])) $data->defect_description_id_4 = $this->input->post('defect_description_name_4');
                if(isset($_POST['defect_description_name_5'])) $data->defect_description_id_5 = $this->input->post('defect_description_name_5');
                if(isset($_POST['defect_description_others_1'])) $data->defect_description_others_1 = $this->input->post('defect_description_others_1');
                if(isset($_POST['defect_description_others_2'])) $data->defect_description_others_2 = $this->input->post('defect_description_others_2');
                if(isset($_POST['defect_description_others_3'])) $data->defect_description_others_3 = $this->input->post('defect_description_others_3');
                if(isset($_POST['defect_description_others_4'])) $data->defect_description_others_4 = $this->input->post('defect_description_others_4');
                if(isset($_POST['defect_description_others_5'])) $data->defect_description_others_5 = $this->input->post('defect_description_others_5');
                */
                if(isset($_POST['last_passed_sample'])) $data->last_passed_sample = $this->input->post('last_passed_sample');
                if(isset($_POST['purge_from'])) $data->purge_from = $this->input->post('purge_from');
                if(isset($_POST['estimate_qty'])) $data->estimate_qty = $this->input->post('estimate_qty');
                if(isset($_POST['defect_description_id'])) $data->defect_description_id = $this->input->post('defect_description_id');
                if(isset($_POST['defect_description_others']) )$data->defect_description_others = $this->input->post('defect_description_others');
                if(isset($_POST['os_us_id']) )$data->os_us_id = $this->input->post('os_us_id');
                if(isset($_POST['datum_id']) )$data->datum_id = $this->input->post('datum_id');
                if(isset($_POST['remarks_id']) )$data->remarks_id = $this->input->post('remarks_id');

                $qasample_qty_array = $this->input->post('input_qty_qasample'); 
                
                if(is_array($qasample_qty_array) AND (count($qasample_qty_array) > 0)){

                    $i = 0;
                    foreach($qasample_qty_array as $qa_sample_id => $qasampleqty){
                        
                        $data->qasample_qty[$i] = new stdClass();
                        $data->qasample_qty[$i]->qa_sample_id = $qa_sample_id;
                        $data->qasample_qty[$i]->samplequantity = $qasampleqty;
                        $i++;
                    }	
                }

                $prod_qty_array = $this->input->post('input_qty_prod');
                
                if(is_array($prod_qty_array) AND (count($prod_qty_array) > 0)){

                    $i = 0;
                    foreach($prod_qty_array as $prod_id => $prodqty){

                        $data->production_qty[$i] = new stdClass();
                        $data->production_qty[$i]->prod_id = $prod_id;
                        $data->production_qty[$i]->prodquantity = $prodqty;
                        $i++;
                    }	
                }

                if(isset($_POST['defect_description_id']) OR ($_POST['defect_description_others']) OR ($_POST['os_us_id']) OR ($_POST['datum_id']) OR ($_POST['remarks_id'])) {

                    $defect_array = $this->input->post('defect_description_id'); 
    
                    if(is_array($defect_array) and count($defect_array) > 0){
    
                        $i = 0;
                        foreach($defect_array as $defect_id => $defect){
    
                            $defect_others = $data->defect_description_others[$defect_id];
                            $os_us = $data->os_us_id[$defect_id];
                            $datum = $data->datum_id[$defect_id];
                            $remarks = $data->remarks_id[$defect_id];
                           
                            $data->qan_defect_description[$i] = new stdClass();
                            $data->qan_defect_description[$i]->defect_description_id = $defect;
                            $data->qan_defect_description[$i]->defect_description_others = $defect_others;
                            $data->qan_defect_description[$i]->os_us_id = $os_us;
                            $data->qan_defect_description[$i]->datum_id = $datum;
                            $data->qan_defect_description[$i]->remarks_id = $remarks;
                            $i++;
                        }
                    }
                }

                //system generate
                $data->modified_date = date("Y-m-d H:i:s");
                if($this->input->post('submit') == 'update_section1'){

                    $data->qan_no = $this->input->post('qan_no');
                    $data->qan_id = $this->input->post('machine_breakdown_id');
                    
                    $this->superuser_modal_update->update_section1($data);
                    
                    $this->session->set_userdata('success_message', 'Record Updated Successfully');
                }else{
                    $data->qan_no = $this->superuser_modal_create->get_next_qan_no(@$data->test);
                    $data->qan_id = '';
                    $data = $this->superuser_modal_create->save_section1($data);
                    
                    $this->session->set_userdata('success_message', 'Record Saved Successfully');
                }
                
                $this->session->set_userdata('last_created_machine_id', $qan_id);
                redirect("SuperUser/successmaster");
            } //end of submit section 1

            //Check submit button of section 2
            if($this->input->post('submit') == 'create_section2' OR $this->input->post('submit') == 'update_section2' OR $this->input->post('submit') == 'final_section2') 
            { 
                $data = new stdClass();
                if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
                if(isset($_POST['scrap'])) $data->scrap = $this->input->post('scrap');
                if(isset($_POST['rework'])) $data->rework = $this->input->post('rework');
                if(isset($_POST['uai'])) $data->uai = $this->input->post('uai');
                if(isset($_POST['scrap_no'])) $data->scrap_no = $this->input->post('scrap_no');
                if(isset($_POST['rework_order_no'])) $data->rework_order_no = $this->input->post('rework_order_no');
                if(isset($_POST['uai_no'])) $data->uai_no = $this->input->post('uai_no');
                if(isset($_POST['rework_dispo_input'])) $data->rework_dispo_input = $this->input->post('rework_dispo_input');
                if(isset($_POST['rework_dispo_output'])) $data->rework_dispo_output = $this->input->post('rework_dispo_output');
                if(isset($_POST['rework_dispo_rej_scrap'])) $data->rework_dispo_rej_scrap = $this->input->post('rework_dispo_rej_scrap');
                if(isset($_POST['reported_by_mrb'])) $data->reportby_user_id = $this->input->post('reported_by_mrb');
                if(isset($_POST['qa_reinsp_select'])) $data->qa_reinsp_status_accept = $this->input->post('qa_reinsp_select');
                if(isset($_POST['qa_reinsp_select'])) $data->qa_reinsp_status_reject = $this->input->post('qa_reinsp_select');
                if(isset($_POST['reject_reason'])) $data->reject_reason = $this->input->post('reject_reason');
                if(isset($_POST['qa_sample_affected_qty'])) $data->qa_sample_affected_qty = $this->input->post('qa_sample_affected_qty');
                if(isset($_POST['qa_sample_good_qty'])) $data->qa_sample_good_qty = $this->input->post('qa_sample_good_qty');
                if(isset($_POST['qa_sample_reject_qty'])) $data->qa_sample_reject_qty = $this->input->post('qa_sample_reject_qty');
                if(isset($_POST['confirmation'])) $data->confirmation = $this->input->post('confirmation');

                //Check if checkbox exist
                if(isset($_POST['_scrap'])) $data->_scrap = $this->input->post('_scrap');
                if(isset($_POST['_rework'])) $data->_rework = $this->input->post('_rework');
                if(isset($_POST['_uai'])) $data->_uai = $this->input->post('_uai');

                $data->update_disposition = 'disabled';

                if(@$this->session->userdata['permission']['MRBSU2.4']['de']){
                    $data->update_disposition = 'enabled';
                }

                if(isset($_POST['affected_qty']) )$data->affected_qty = $this->input->post('affected_qty');
                if(isset($_POST['good_qty']) )$data->good_qty = $this->input->post('good_qty');
                if(isset($_POST['reject_qty']) )$data->reject_qty = $this->input->post('reject_qty'); 
                if(isset($_POST['prod_pic_user_id'])) $data->prod_pic_user_id = $this->input->post('prod_pic_user_id');

                if(isset($_POST['loc_purge']) ) {

                    $loc_purge_array = $this->input->post('loc_purge');

                    if(is_array($loc_purge_array ) and count($loc_purge_array )>0){

                        $i = 0;
                        foreach($loc_purge_array as $purge_location_id => $null){

                            $affqty = $data->affected_qty[$purge_location_id];
                            $goodqty = @$data->good_qty[$purge_location_id];
                            $rejqty = $data->reject_qty[$purge_location_id];
                            
                            $goodqty = (int)$affqty - (int)$rejqty;//overwriten user's POST by doing logic calcs

                            $data->qan_purge[$i] = new stdClass();
                            $data->qan_purge[$i]->purge_location_id = $purge_location_id;
                            $data->qan_purge[$i]->good_qty = $goodqty;
                            $data->qan_purge[$i]->reject_qty = $rejqty;
                            $data->qan_purge[$i]->affected_qty = $affqty;
                            $data->qan_purge[$i]->prod_pic_user_id = $data->prod_pic_user_id;
                            $data->qan_purge[$i]->qa_buyoff_user_id = "";//$data->qa_buyoff_user_id;
                            $i++;
                        }
                    }
                }
    
                if(isset($_POST['washing'])) $data->washing = $this->input->post('washing');
                if(isset($_POST['brushing'])) $data->brushing = $this->input->post('brushing');
                if(isset($_POST['vmi'])) $data->vmi = $this->input->post('vmi');
                
                if(isset($_POST['sublot_no']) )$data->sublot_no = $this->input->post('sublot_no');
                if(isset($_POST['qty_sublot_no']) )$data->qty_sublot_no = $this->input->post('qty_sublot_no');
                if(isset($_POST['sorting_good_qty']) )$data->sorting_good_qty = $this->input->post('sorting_good_qty');
                if(isset($_POST['sorting_reject_qty']) )$data->sorting_reject_qty = $this->input->post('sorting_reject_qty');
                if(isset($_POST['sublotprod_pic_user_id'])) $data->sublotprod_pic_user_id = $this->input->post('sublotprod_pic_user_id');

                if(isset($_POST['sublot_no']) OR ($_POST['qty_sublot_no']) OR ($_POST['sorting_reject_qty'])) {

                    $sublot_no_array = $this->input->post('sublot_no'); 

                    if(is_array($sublot_no_array) and count($sublot_no_array) > 0){

                        $i = 0;
                        foreach($sublot_no_array as $lot => $sublot){
                        
                            $qtysublotno = $data->qty_sublot_no[$lot];
                            $sortgoodqty = @$data->sorting_good_qty[$lot];
                            $sortrejqty = $data->sorting_reject_qty[$lot];
                            
                            $sortgoodqty = (int)$qtysublotno - (int)$sortrejqty;//overwriten user's POST by doing logic calcs

                            $data->qan_on_hold_sublot[$i] = new stdClass();
                            $data->qan_on_hold_sublot[$i]->sublot_no = $sublot;
                            $data->qan_on_hold_sublot[$i]->qty_sublot_no = $qtysublotno;
                            $data->qan_on_hold_sublot[$i]->sorting_good_qty = $sortgoodqty;
                            $data->qan_on_hold_sublot[$i]->sorting_reject_qty = $sortrejqty;
                            $data->qan_on_hold_sublot[$i]->sublotprod_pic_user_id = $data->sublotprod_pic_user_id;
                            $i++;
                        }
                    }
                }
        
                if(isset($_POST['qty_buyoff']) )$data->qty_buyoff = $this->input->post('qty_buyoff');
                if(isset($_POST['bosorting_good_qty']) )$data->sorting_good_qty = $this->input->post('bosorting_good_qty');
                if(isset($_POST['sorting_ooc_qty']) )$data->sorting_ooc_qty = $this->input->post('sorting_ooc_qty');
                if(isset($_POST['sorting_oos_qty']) )$data->sorting_oos_qty = $this->input->post('sorting_oos_qty'); 
                if(isset($_POST['qa_pic_user_id'])) $data->qa_pic_user_id = $this->input->post('qa_pic_user_id');

                if(isset($_POST['qty_buyoff']) OR ($_POST['bosorting_good_qty']) OR ($_POST['sorting_ooc_qty']) OR ($_POST['sorting_oos_qty'])) {

                    $buyoff_array = $this->input->post('qty_buyoff'); 

                    if(is_array($buyoff_array) and count($buyoff_array) > 0){

                        $i = 0;
                        foreach($buyoff_array as $buy => $buyoff){
                        
                            $qtybuyoff = $data->qty_buyoff[$buy];
                            $bosortgoodqty = $data->sorting_good_qty[$buy];
                            $oocqty = $data->sorting_ooc_qty[$buy];
                            $oosqty = $data->sorting_oos_qty[$buy];
                            
                            $data->qan_qa_buy_off[$i] = new stdClass();
                            $data->qan_qa_buy_off[$i]->qty_buyoff = $buyoff;
                            $data->qan_qa_buy_off[$i]->sorting_good_qty = $bosortgoodqty;
                            $data->qan_qa_buy_off[$i]->sorting_ooc_qty = $oocqty;
                            $data->qan_qa_buy_off[$i]->sorting_oos_qty = $oosqty;
                            $data->qan_qa_buy_off[$i]->qa_pic_user_id = $data->qa_pic_user_id;
                            $i++;
                        }
                    }
                }

                if($this->input->post('submit') == 'update_section2' OR $this->input->post('submit') == 'final_section2')
                {
                    // if($this->input->post('submit') == 'final_section2'){

                        //allow MRB to fund 10 marks, other only 1
                        // if(@$this->session->userdata['permission']['MRBSU2.4']['de']){
                        //     $confirm_weight = 10;
                        // //PROD
                        // }else if(@$this->session->userdata['permission']['PRODSU2.1']['de'] OR @$this->session->userdata['permission']['PRODSU2.5']['de']){
                        //     $confirm_weight = 1;
                        // //QA    
                        // }else if(@$this->session->userdata['permission']['QASU2.6']['de']){
                        //     $confirm_weight = 1;
                        // }else{
                        //     $confirm_weight = 0;
                        // }

                        //allow MRB to fund 10 marks, other only 1
                        /*
                        if(@$this->session->userdata['permission']['MRBSU2.4']['de']){
                            $confirm_weight = 10;
                        //QA   
                        }elseif(@$this->session->userdata['permission']['QASU2.6']['de']){
                            $confirm_weight = 1;
                        }else{
                            $confirm_weight = 0;
                        }
                        */

                        // if($data->confirmation > 0) $data->confirmation += $confirm_weight;
                        // else $data->confirmation = $confirm_weight;
                    // }
                    $data->qan_id = $this->input->post('machine_breakdown_id');
                    $this->superuser_modal_update->update_section2($data);
                    $this->superuser_modal_update->update_qasample_mrb($data->qan_id,$data->qa_sample_reject_qty);
                    $this->session->set_userdata('success_message', 'Record Updated Successfully');
                }else{

                    if($this->input->post('submit') == 'create_section2' OR (is_array(@$view['data']->purge_location) AND count(@$view['data']->purge_location) > 0))
                    {
                        $data = $this->superuser_modal_create->save_section2($data);
                        $this->superuser_modal_update->update_qasample_mrb($qan_id,$data->qa_sample_reject_qty);
                        $this->session->set_userdata('success_message', 'Record Saved Successfully');
                    }
                    
                }

                $this->session->set_userdata('last_created_machine_id', $data->qan_id);
                redirect("SuperUser/successmaster");
            }//end of submit section2

            //Check submit button of section 3
            if($this->input->post('submit') == 'create_section3' OR $this->input->post('submit') == 'update_section3') 
            {
                $data = new stdClass();
                //captured engineering submission part
                if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
                if(isset($_POST['root_cause'])) $data->root_cause_id = $this->input->post('root_cause');
                if(isset($_POST['corrective_action'])) $data->corrective_action_id = $this->input->post('corrective_action');
                if(isset($_POST['others_corrective_action'])) $data->others_corrective_action = $this->input->post('others_corrective_action');
                // if(isset($_POST['rcfa_pic_user_id'])) $data->rcfa_pic_user_id = $this->input->post('rcfa_pic_user_id');
                if(isset($_POST['rcfa_ack_user_id'])) $data->rcfa_ack_user_id = $this->input->post('rcfa_ack_user_id');
                if(isset($_POST['completion_user_id'])) $data->completion_user_id = $this->input->post('completion_user_id');
                if(isset($_POST['completion_datetime'])) $data->completion_datetime = $this->input->post('completion_datetime');
                if(isset($_POST['submission_no'])) $data->submission_no = $this->input->post('submission_no');
                if(isset($_POST['submission_id'])) $data->submission_id = $this->input->post('submission_id');

                //captured QA Validator submission
                if(isset($_POST['qa_insp_machine'])) $data->inspection_machine_id = $this->input->post('qa_insp_machine');//checkbox selected
                if(isset($_POST['_qa_insp_machine'])) $data->_inspection_machine_id = $this->input->post('_qa_insp_machine');//hidden prev checkbox
                if(isset($_POST['inspect_by'])) $data->inspectby_user_id = $this->input->post('inspect_by');
                if(isset($_POST['time_start'])) $data->time_start = $this->input->post('time_start');
                // if(isset($_POST['time_end'])) $data->time_end = $this->input->post('time_end');
                if(isset($_POST['rc_result'])) $data->result = $this->input->post('rc_result');
                if(isset($_POST['remarks'])) $data->remarks = $this->input->post('remarks');
                if(isset($_POST['approval_user_id'])) $data->approval_user_id = $this->input->post('approval_user_id');
                if(isset($_POST['machine_status'])) $data->machine_status = $this->input->post('machine_status');
                if(isset($_POST['machine_stop_reason'])) $data->machine_stop_reason = $this->input->post('machine_stop_reason');
    
                $data->inspection_machine_data = array();
                $data->new_inspection_machine_data = array();
                $data->inspection_result_data = array();

                //lets check only previous submission has been given result then we allow to save next new
                $last_submit_result = $this->superuser_modal_select->get_submission_validation_result($data->qan_id);

                $last_machine_status = $this->superuser_modal_select->get_last_machine_status($data->qan_id);

                if(isset($data->rcfa_ack_user_id) and count($data->rcfa_ack_user_id)>0){ //if(isset($data->rcfa_pic_user_id) and count($data->rcfa_pic_user_id)>0){

                    foreach($data->rcfa_ack_user_id as $i => $null){ //foreach($data->rcfa_pic_user_id as $i => $null){

                        /*if($i==0){//only take last id OR (count($data->rcfa_pic_user_id)-1)>$i
                            continue; //skip tab 0
                        }*/ 
                        if($i==0 OR (count($data->rcfa_ack_user_id)-1)>$i){ //if($i==0 OR (count($data->rcfa_pic_user_id)-1)>$i){
                            continue; //skip tab 0
                        } 
                        /*if($data->submission_no[$i] > ($last_submit_result['total_submission']+1)){ //and $last_submit_result['result']=='PASS'
                            // continue; //skip if user send more than one submission or result that got pass result
                        }*/
                        if($data->submission_no[$i] > ($last_machine_status['total_submission']+1) and $last_machine_status['machine_status']=='RUN'){  //if($data->submission_no[$i] > ($last_submit_result['total_submission']+1) and $last_submit_result['result']=='PASS'){
                            continue; //skip if user send more than one submission or result that got pass result
                        }
                        
                        if(isset($data->submission_id[$i]) and $data->submission_id[$i]>0){
                            //for update part
                            $data->inspection_machine_data[$i] = new stdClass();
                            $data->inspection_machine_data[$i]->submission_id = $data->submission_id[$i];
                            $data->inspection_machine_data[$i]->root_cause_id = @$data->root_cause_id[$i];
                            $data->inspection_machine_data[$i]->corrective_action_id = @$data->corrective_action_id[$i];
                            $data->inspection_machine_data[$i]->submission_no = $data->submission_no[$i];
                            // $data->inspection_machine_data[$i]->rcfa_pic_user_id = $data->rcfa_pic_user_id[$i];
                            $data->inspection_machine_data[$i]->rcfa_ack_user_id = $data->rcfa_ack_user_id[$i];
                            $data->inspection_machine_data[$i]->completion_user_id = $data->completion_user_id[$i];
                            $data->inspection_machine_data[$i]->remarks = $data->remarks[$i];
                            $data->inspection_machine_data[$i]->approval_user_id = $data->approval_user_id[$i];
                            $data->inspection_machine_data[$i]->machine_status = $data->machine_status[$i];
                            $data->inspection_machine_data[$i]->machine_stop_reason = $data->machine_stop_reason[$i];
                        }
                        else{
                            //for insert part
                            $data->new_inspection_machine_data[$i] = new stdClass();
                            $data->new_inspection_machine_data[$i]->root_cause_id = $data->root_cause_id[$i];
                            $data->new_inspection_machine_data[$i]->corrective_action_id = $data->corrective_action_id[$i];
                            $data->new_inspection_machine_data[$i]->submission_no = $data->submission_no[$i];
                            // $data->new_inspection_machine_data[$i]->rcfa_pic_user_id = $data->rcfa_pic_user_id[$i];
                            $data->new_inspection_machine_data[$i]->rcfa_ack_user_id = $data->rcfa_ack_user_id[$i];
                            $data->new_inspection_machine_data[$i]->completion_user_id = $data->completion_user_id[$i];
                            $data->new_inspection_machine_data[$i]->remarks = $data->remarks[$i];
                            $data->new_inspection_machine_data[$i]->approval_user_id = $data->approval_user_id[$i];
                            $data->new_inspection_machine_data[$i]->machine_status = $data->machine_status[$i];
                            $data->new_inspection_machine_data[$i]->machine_stop_reason = $data->machine_stop_reason[$i];
                        }
                    }
                }

                //find all current selected submission id AND collect inspection data
                if(isset($data->inspection_machine_id) and count($data->inspection_machine_id)>0){

                    foreach($data->inspection_machine_id as $tab_no => $selected_machine){
                        
                        if($tab_no==0) continue; //skip tab 0
                        $j=0;
                        foreach($selected_machine as $machine_id => $checkbox_state){
                            
                            if(count($data->result[$tab_no])<1 or $data->submission_id[$tab_no]<1) continue;
                            $data->inspection_result_data[$tab_no][$j] = new stdClass();
                            $data->inspection_result_data[$tab_no][$j]->root_cause_submission_id = $data->submission_id[$tab_no];
                            $data->inspection_result_data[$tab_no][$j]->inspection_machine_id = $machine_id;
                            $data->inspection_result_data[$tab_no][$j]->inspectby_user_id = $data->inspectby_user_id[$tab_no][$machine_id];
                            $data->inspection_result_data[$tab_no][$j]->time_start = $data->time_start[$tab_no][$machine_id];
                            // $data->inspection_result_data[$tab_no][$j]->time_end = $data->time_end[$tab_no][$machine_id];
                            $data->inspection_result_data[$tab_no][$j]->result = $data->result[$tab_no][$machine_id];
                            $j++;
                        }
                    }
                }

                $root_cause_submission_id = array();
                //to find all prev selected checkbox submission_id in hidden input
                if(isset($data->_inspection_machine_id) and count($data->_inspection_machine_id)>0){

                    foreach($data->_inspection_machine_id as $tab_no => $selected_machine){

                        if($tab_no==0) continue; //skip tab 0
                        $j=0;

                        foreach($selected_machine as $machine_id => $checkbox_state){

                            if($checkbox_state=='on'){

                                $root_cause_submission_id[$data->submission_id[$tab_no]] = $tab_no;
                            }
                            $j++;
                        }
                    }
                }
        
                $data->qan_id = $this->input->post('machine_breakdown_id');
                $success_msg = '';

                if($this->input->post('submit') == 'create_section3' OR count($data->new_inspection_machine_data)>0 OR count($data->inspection_result_data)>0 OR @count($data->_inspection_machine_id))
                {
                    // if(count(@$root_cause_submission_id)>0 and count($data->inspection_result_data)>0){
                    //     $this->superuser_modal_delete->delete_inspection_data($data->qan_id,array_keys($root_cause_submission_id));
                    // }
                    $this->superuser_modal_create->save_section3($data);
                    $success_msg = 'Record Saved Successfully';

                }
                if($this->input->post('submit') == 'update_section3' OR count($data->inspection_machine_data)>0)
                {
                    $this->superuser_modal_update->update_section3($data);
                    $success_msg = 'Record Updated Successfully';

                    // $get_status = $this->superuser_modal_select->get_status_by_ticket_id($qan_id);
                    // $get_status_code = $get_status->status_code;

                    // $last_submit_result = $this->superuser_modal_select->get_submission_validation_result($data->qan_id);
            
                    // $last_machine_status = $this->superuser_modal_master->get_last_machine_status($data->qan_id);

                    /*
                    if($last_machine_status['machine_status'] == 'RUN'){ //if($last_submit_result['result'] == 'PASS'){

                        $this->superuser_modal_update->update_status($data->qan_id,'5','4');
                    }
                    else{
                        if($get_status_code > 4 and $get_status_code < 7){

                            $this->superuser_modal_update->update_status($data->qan_id,'4');
                        }
                    }
                    */
                }

                $this->session->set_userdata('success_message', ' '.$success_msg);
                $this->session->set_userdata('last_created_machine_id', $data->qan_id);
                redirect("SuperUser/successmaster");
            } //end of submit section3

            //Check submit button of section 4
            /*
            if($this->input->post('submit') == 'update_section4') 
            {
                $data = new stdClass();
                if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
                if(isset($_POST['approval_user_id'])) $data->approval_user_id = $this->input->post('approval_user_id');
                if(isset($_POST['machine_status'])) $data->machine_status = $this->input->post('machine_status');
                if(isset($_POST['machine_stop_reason'])) $data->machine_stop_reason = $this->input->post('machine_stop_reason');
                
                $this->superuser_modal_update->update_section4($data);
                $this->session->set_userdata('last_created_machine_id', $qan_id);
                redirect("SuperUser/successmaster");
            }
            */ 
            //end of submit section4

            //Check submit button of section 5
            if($this->input->post('submit') == 'update_section5') 
            {
                $data = new stdClass();
                if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
                if(isset($_POST['purging_completed'])) $data->purge_status = $this->input->post('purging_completed');
                if(isset($_POST['notify_next_process'])) $data->notify_next_process = $this->input->post('notify_next_process');
                if(isset($_POST['validation_result'])) $data->fix_validation_result = $this->input->post('validation_result');
                if(isset($_POST['closedby_user_id'])) $data->closedby_user_id = $this->input->post('closedby_user_id');
                if(isset($_POST['closed_datetime'])) $data->closed_datetime = $this->input->post('closed_datetime');

                $this->superuser_modal_update->update_section5($data);
                $this->session->set_userdata('last_created_machine_id', $qan_id);
                redirect("SuperUser/successmaster");
            } //end of submit section5

            $view['machine_no'] = $this->superuser_modal_select->get_machine_no();
            $view['detected_by'] = $this->superuser_modal_select->get_detected_by();
            $view['defect_desc'] = $this->superuser_modal_select->get_defect_desc();
            $view['os_us']=$this->superuser_modal_select->get_os_us();
            $view['datum']=$this->superuser_modal_select->get_datum();
            $view['remarks']=$this->superuser_modal_select->get_remarks();

            $this->load->view('SuperUser/QAN/superuser_master',$view);
            $this->footer($this->data);
        }

        public function successmaster(){

            $this->data['title'] = "JCY Product Quality System";
            $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
            $this->data['description'] = "Overview";

            $this->header($this->data);
            $this->topbar($this->data);
            $this->leftsidebar($this->data);
            $this->rightsidebar($this->data);

            $view['data'] = new stdClass();
            $view['data']->message = $this->session->userdata('success_message');
            $view['data']->redirect = base_url()."SuperUser/index/".$this->session->userdata('last_created_machine_id');
            $this->load->view('SuperUser/QAN/successmaster',$view);
            $this->footer();
        }
    }