<?php

require_once APPPATH . 'core/MY_FrontEnd.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontEnd extends MY_FrontEnd {

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
        
            date_default_timezone_set('Asia/Kuala_Lumpur');
    }

	public function index(){

        redirect('/homepage', 'refresh');
    }
    
    // Validate and store registration data in database
    public function new_user_registration() {

        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('commodity', 'Commodity', 'required');
        $this->form_validation->set_rules('dept', 'Department', 'required');
        $this->form_validation->set_rules('title', 'Designation', 'required');
        $this->form_validation->set_rules('employee_no', 'Employee No', 'required');
        $this->form_validation->set_rules('user_role', 'User Role', 'required');
        $this->form_validation->set_rules('created_date', 'Created Date', 'required');
        $this->form_validation->set_rules('modified_date', 'Modified Date', 'required');
        $this->form_validation->set_rules('is_deleted', 'Status', 'required');
        
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('FrontEnd/register');

        }else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'fullname' => $this->input->post('fullname'),
                'commodity' => $this->input->post('commodity'),
                'dept_id' => $this->input->post('dept_id'),
                'title' => $this->input->post('title'),
                'employee_no' => $this->input->post('employee_no'),
                'role_id' => $this->input->post('role_id'),
                'created_date' => $this->input->post('created_date'),
                'modified_date' => $this->input->post('modified_date'),
                'is_deleted' => $this->input->post('is_deleted')
            );
            $result = $this->login_database->registration_insert($data);
            if ($result == TRUE) {
                $data['message_display'] = 'Registration Successfully !';
                $this->load->view('FrontEnd/login', $data);
            } else {
                $data['message_display'] = 'Username already exist!';
                $this->load->view('FrontEnd/register', $data);
            }
        }
    }
  
    public function homepage(){
      
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->load->view('FrontEnd/QAN/homepage',$this->data);
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
        $this->load->view('FrontEnd/QAN/dashboard_closed_ticket',$this->data);
        $this->footer();
    }

    public function ajax_statistics_data(){

        $result = $this->modal_master->rej_aff_qty_12month();

        for($i=0; $i<12; $i++){
            $reject[$i] = 0;
            $affected[$i] = 0;
        }
        foreach($result as $row){
            $reject[$row->MONTH] = $row->Total_Rej;
            $affected[$row->MONTH] = $row->Total_Aff;
        }
        
        $data = new stdClass();
        $data->affected = $affected; //array(50, 44, 52, 62, 48, 58, 59, 50, 51, 52, 53, 54);
        $data->reject = $reject; //array(50, 30, 60, 70, 80, 90, 95, 70, 90, 20, 60, 95);

        $data = array(
            'chart' =>$data
        );
       
        echo json_encode($data);
    }

    public function ajax_active_list(){

        $result = $this->modal_master->get_list_by_status('99',true);

        foreach($result as $i=>$row){
            $result[$i]->ack =  $this->modal_master->get_sec1_ack_list($row->id);
            $result[$i]->submission = $this->modal_master->get_submission_result($row->id);
            $result[$i]->aff_rej = $this->modal_master->get_aff_rej_qty($row->id);
            $result[$i]->defect = $this->modal_master->get_defect_info($row->id,'defect_description_name');
            
        }
        $data = array(
            'data' =>$result
        );
        echo json_encode($data);
    }

    public function ajax_get_task(){
        
        $result = $this->modal_master->section1_task_informer();
        $result = array_merge_recursive($result,$this->modal_master->section2_task_informer());
        $result = array_merge_recursive($result,$this->modal_master->section3_task_informer());
        $result = array_merge_recursive($result,$this->modal_master->section4_task_informer());
        $result = array_merge_recursive($result,$this->modal_master->section5_task_informer());
        
        foreach($result as $i=>$row){
            $result[$i]['ack'] =  $this->modal_master->get_sec1_ack_list($row['details']->id);
        }

        $data = array(
            'data' =>$result
        );
        echo json_encode($data);
    }

    public function ajax_closed_list(){

        $result = $this->modal_master->get_list_by_status('99');
        
        foreach($result as $i=>$row){
            $result[$i]->ack =  $this->modal_master->get_sec1_ack_list($row->id);
            $result[$i]->submission = $this->modal_master->get_submission_result($row->id);
            $result[$i]->aff_rej = $this->modal_master->get_aff_rej_qty($row->id);
            $result[$i]->defect = $this->modal_master->get_defect_info($row->id,'defect_description_name');
            
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
            $result = $this->modal_master->get_defect_desc(0,$types);
        }
        
        echo json_encode($result);
    }

    public function get_machine(){

        $sector_id = $this->input->post('sector_id')>0?$this->input->post('sector_id'):0;
        $result = $this->modal_master->get_machine_no($sector_id,true);
        echo json_encode($result);
    }

    public function mastertemplate($qan_id=0){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        if($qan_id > 0){

            $this->modal_master->load_qan($qan_id);
            $this->modal_master->Section1();
            $this->modal_master->Section2();
            $this->modal_master->Section3();

            $view['data'] = $this->modal_master->get_data();
            $view['data']->submit_button = new stdClass();

            if(@$this->session->userdata['permission']['S1']['de'] OR @$this->session->userdata['permission']['S1']['ack'] OR @$this->session->userdata['permission']['S1']['app'])
            {    
                $view['data']->submit_button->s1 = array();

                if((@$this->session->userdata['permission']['S1']['de']) and $view['data']->status < '3'){
                    $button_obj = new stdClass();
                    $button_obj->name = 'UPDATE';
                    $button_obj->value = 'update_section1';
                    $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                    array_push($view['data']->submit_button->s1,$button_obj);
                }
                
                if((@$this->session->userdata['permission']['S1']['ack']) and ($view['data']->status == '1' or $view['data']->status == '3'))
                {
                    $user_id = $this->session->userdata['logged_in']['id'];

                    if(!(@$view['data']->ack_eng_user==$user_id or @$view['data']->ack_prod_user==$user_id or @$view['data']->ack_qa_user==$user_id ))
                    {
                        $button_obj = new stdClass();
                        $button_obj->name = 'ACKNOWLEDGE';
                        $button_obj->value = 'update_section1_ack';
                        $button_obj->action = base_url().'FrontEnd/mastertemplate/'; //action kena sama
                        array_push($view['data']->submit_button->s1,$button_obj);
                    }
                }
            }

            if( (@$this->session->userdata['permission']['S2']['de'] OR @$this->session->userdata['permission']['S2']['ack'] OR @$this->session->userdata['permission']['S2']['app']) and ($view['data']->status > 3 and $view['data']->status < 7)) //6
            {
                $show_create_update = true;
                $show_finalize = true;

                if(@$view['data']->mrb_id < 1){
                    $show_finalize = false;
                }

                if(@$view['data']->confirmation >= 11 OR (@$this->session->userdata['permission']['S2.1']['de'] and @$view['data']->confirmation == 1) OR (@$this->session->userdata['permission']['S2.4']['de'] and @$view['data']->confirmation == 10) ){
                    $show_create_update = false;
                    $show_finalize = false;
                }

                if($show_create_update){

                    $button_obj = new stdClass();
                    $btn_sec2 = '';
                    $val_sec2 = 'update_section2';

                    if((@$this->session->userdata['permission']['S2']['de'] OR @$this->session->userdata['permission']['S2.1']['de'] OR @$this->session->userdata['permission']['S2.2']['de'] OR @$this->session->userdata['permission']['S2.3']['de'] OR @$this->session->userdata['permission']['S2.4']['de'])) //NEW ADDED and ($view['data']->status == '6')
                    {
                        $view['data']->submit_button->s2 = array();

                        if( (@$this->session->userdata['permission']['S2.2']['de'] OR @$this->session->userdata['permission']['S2.3']['de']) AND (@$view['data']->mrb_id > 0))
                        {
                            $btn_sec2 = 'UPDATE';
                            $val_sec2 = 'update_section2';
                        }

                        if(@$this->session->userdata['permission']['S2.1']['de']){
                            if(@$view['data']->mrb_id > 0){
                                $btn_sec2 = 'UPDATE';
                                $val_sec2 = 'update_section2';
                            }else{
                                $btn_sec2 = 'CREATE';
                                $val_sec2 = 'create_section2';
                            } 
                        }
                            
                        if($btn_sec2 !== ''){
                            $button_obj->name = $btn_sec2;
                            $button_obj->value = $val_sec2;
                            $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                            array_push($view['data']->submit_button->s2,$button_obj);
                        }
                        
                    }
                }

                if($show_finalize){
                   
                    $button_obj = new stdClass();
                    $button_obj->name = 'FINALIZE';
                    $button_obj->value = 'final_section2';
                    $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                    array_push($view['data']->submit_button->s2,$button_obj);
                }
            }

            if(@$this->session->userdata['permission']['S3']['de'] OR @$this->session->userdata['permission']['S3']['ack'] OR @$this->session->userdata['permission']['S3']['app'])
            {
                $view['data']->submit_button->s3 = array();

                if((@$this->session->userdata['permission']['S3']['de'] or @$this->session->userdata['permission']['S3']['ack']) and ($view['data']->status == '4'))
                {
                    $button_obj = new stdClass();
                    $btn = '';
                    $val = 'update_section3';

                    $last_inspection_data = @$view['data']->inspection_machine_data;
                    
                    if(count( @$view['data']->inspection_machine_data))
                    $last_inspection_data = array_values(array_slice(@$view['data']->inspection_machine_data, -1))[0];

                    if(@$this->session->userdata['permission']['S3.2']['de'] AND (is_array(@$last_inspection_data->inspection_data) AND count(@$last_inspection_data->inspection_data) == 0))
                    {
                        $btn = 'UPDATE';
                    }
                    
                    if(@$this->session->userdata['permission']['S3.1']['de'])
                    {
                        if(is_array(@$last_inspection_data->inspection_data) AND count(@$last_inspection_data->inspection_data) == 0)
                            $btn = 'UPDATE';
                        else $btn = 'CREATE';
                             $val = 'create_section3';
                    }
                    
                    if($btn !== ''){
                        $button_obj->name = $btn;
                        $button_obj->value = $val;
                        $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                        array_push($view['data']->submit_button->s3,$button_obj);
                    }
                }
            }
        
            if( (@$this->session->userdata['permission']['S4']['de'] OR @$this->session->userdata['permission']['S4']['ack'] OR @$this->session->userdata['permission']['S4']['app']) and ($view['data']->status == '5'))
            {
                $view['data']->submit_button->s4 = array();
                $button_obj = new stdClass();
                $button_obj->name = 'APPROVE';
                $button_obj->value = 'update_section4';
                $button_obj->action = base_url().'FrontEnd/mastertemplate/'.$qan_id;
                array_push($view['data']->submit_button->s4,$button_obj);
            }

            if( (@$this->session->userdata['permission']['S5']['de'] OR @$this->session->userdata['permission']['S5']['ack'] OR @$this->session->userdata['permission']['S5']['app']) and ($view['data']->status == '6') OR ($view['data']->status == '7'))
            {
                $view['data']->submit_button->s5 = array();
                $button_obj = new stdClass();
                if(@$view['data']->confirmation >= 11 AND @$this->session->userdata['permission']['S5']['de']){
                    $button_obj->name = 'CLOSED';
                    $button_obj->value = 'update_section5';
                    $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                    array_push($view['data']->submit_button->s5,$button_obj);
                }
                
            }
            
        }else{
            
            if(!( count($_POST) OR (@$this->session->userdata['permission']['S6']['view'] OR @$this->session->userdata['permission']['S6']['de']) )) { //(@$this->session->userdata['permission']['S6']['view'] OR @$this->session->userdata['permission']['S6']['de']
                redirect("FrontEnd/notauthorized");
                exit;
            }

            $this->modal_master->load_new_qan();
            $view['data'] = $this->modal_master->get_data();
            $view['data']->submit_button = new stdClass();
            if(@$this->session->userdata['permission']['S1']['de'] OR @$this->session->userdata['permission']['S1']['ack'] OR @$this->session->userdata['permission']['S1']['app'] OR @$this->session->userdata['permission']['S1']['app']){
                $view['data']->submit_button->s1 = array();
                $button_obj = new stdClass();
                $button_obj->name = 'CREATE NEW';
                $button_obj->value = 'create_section1';
                $button_obj->action = base_url().'FrontEnd/mastertemplate';
                array_push($view['data']->submit_button->s1,$button_obj);
            }
        }
       
        $view['data']->user->{$this->session->userdata['logged_in']['id']} = $this->admin_modal_select->get_user_by_id($this->session->userdata['logged_in']['id']);
        
        if(@$view['data']->issueby_user_id<1 and (@$this->session->userdata['permission']['S1.1']['de'] or @$this->session->userdata['permission']['S1.3']['de']) ){
            $view['data']->issueby_user_id = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->issueto_user<1 and @$this->session->userdata['permission']['S1.5']['ack']){
            $view['data']->issueto_user = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->ack_eng_user<1 and @$this->session->userdata['permission']['S1.5']['ack']){
            $view['data']->ack_eng_user = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->ack_prod_user<1 and @$this->session->userdata['permission']['S1.6']['ack']){
            $view['data']->ack_prod_user = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->ack_qa_user<1 and @$this->session->userdata['permission']['S1.7']['ack']){
            $view['data']->ack_qa_user = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->prod_pic_user_id<1 and @$this->session->userdata['permission']['S2.1']['de']){
            $view['data']->prod_pic_user_id = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->reportby_user_id<1 and @$this->session->userdata['permission']['S2.4']['de']){
            $view['data']->reportby_user_id = $this->session->userdata['logged_in']['id'];
        }

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
            }

        }

        $last_submit_result = $this->modal_master->get_submission_validation_result($qan_id);
   
        if($i < 0 OR (@$this->session->userdata['permission']['S3.1']['de'] and $i<$last_submit_result['total_submission'] and $last_submit_result['result']!='PASS'))
        {

            $i = $i+1;

            if($last_submit_result['result']=='FAILED'){
                $i = $last_submit_result['total_submission'];
            }

            $view['data']->inspection_machine_data[$i] = new stdClass();
            $view['data']->inspection_machine_data[$i]->submission_id = '';
            $view['data']->inspection_machine_data[$i]->root_cause = '';
            $view['data']->inspection_machine_data[$i]->corrective_action = '';
            $view['data']->inspection_machine_data[$i]->rcfa_pic_user_id = @$this->session->userdata['permission']['S3.1']['de']?$this->session->userdata['logged_in']['id']:'';
            $view['data']->inspection_machine_data[$i]->rcfa_ack_user_id = @$this->session->userdata['permission']['S3.3']['ack']?$this->session->userdata['logged_in']['id']:'';
            $view['data']->inspection_machine_data[$i]->rcfa_appr_user_id = @$this->session->userdata['permission']['S3.4']['app']?$this->session->userdata['logged_in']['id']:'';
            $view['data']->inspection_machine_data[$i]->completion_user_id = @$this->session->userdata['permission']['S3.1']['de']?$this->session->userdata['logged_in']['id']:'';
        }

        if(@$view['data']->approval_user_id<1 and @$this->session->userdata['permission']['S4']['de']){
            $view['data']->approval_user_id = $this->session->userdata['logged_in']['id'];
        }

        if(@$view['data']->closedby_user_id<1 and @$this->session->userdata['permission']['S5']['de']){
            $view['data']->closedby_user_id = $this->session->userdata['logged_in']['id'];
        }

        $view['show_allsection'] = TRUE;
        
        //Check submit button of section 1
        if($this->input->post('submit') == 'update_section1_ack') {

            $data = new stdClass(); 
            $data->qan_id = $this->input->post('machine_breakdown_id');
            $data->status = @$this->modal_master->get_status($data->qan_id);

            if(@$this->session->userdata['permission']['S1.5']['ack'] and ($data->status == '1' or $data->status == '3')){
                $data->ack_eng_user = $this->session->userdata['logged_in']['id'];
                $data->issueto_user = $data->ack_eng_user;
            }
            if(@$this->session->userdata['permission']['S1.6']['ack'] and ($data->status == '1' or $data->status == '3')){
                $data->ack_prod_user = $this->session->userdata['logged_in']['id'];
            }
            if(@$this->session->userdata['permission']['S1.7']['ack'] and ($data->status == '1' or $data->status == '3')){
                $data->ack_qa_user = $this->session->userdata['logged_in']['id'];
            }

            $this->modal_update->update_section1($data);

            $ack_data = $this->modal_master->get_sec1_ack_list($data->qan_id);

            if($ack_data->ack_eng_user > 0 and $ack_data->ack_prod_user > 0 and $ack_data->ack_qa_user > 0)
                $this->modal_update->update_status($data->qan_id,'4','3');
            else
                $this->modal_update->update_status($data->qan_id,'3');

            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");

        }
        
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
            if(isset($_POST['ooc'])) $data->ooc= $this->input->post('ooc');
            if(isset($_POST['oos'])) $data->oos= $this->input->post('oos');
            if(isset($_POST['visual'])) $data->visual= $this->input->post('visual');
            if(isset($_POST['part_name'])) $data->part_name = $this->input->post('part_name'); 
            if(isset($_POST['machine_no_id'])) $data->machine_no_id = $this->input->post('machine_no_id');
            if(isset($_POST['process'])) $data->process= $this->input->post('process');
            if(isset($_POST['detectedby_user'])) $data->detectedby_user = $this->input->post('detectedby_user');
            if(isset($_POST['defect_description_name'])) $data->defect_description_id = $this->input->post('defect_description_name');
            if(isset($_POST['defect_description_others'])) $data->defect_description_others = $this->input->post('defect_description_others');
            if(isset($_POST['last_passed_sample'])) $data->last_passed_sample = $this->input->post('last_passed_sample');
            if(isset($_POST['purge_from'])) $data->purge_from = $this->input->post('purge_from');
            if(isset($_POST['estimate_qty'])) $data->estimate_qty = $this->input->post('estimate_qty');
        
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
            //system generate
            $data->modified_date = date("Y-m-d H:i:s");
            if($this->input->post('submit') == 'update_section1'){
                $data->qan_no = $this->input->post('qan_no');
                $data->qan_id = $this->input->post('machine_breakdown_id');
               
                $this->modal_update->update_section1($data);
                $this->session->set_userdata('success_message', 'Record Updated Successfully');
            }else{
                $data->qan_no = $this->modal_create->get_next_qan_no(@$data->test);
                $data->qan_id = '';
                $data = $this->modal_create->save_section1($data);
                $this->session->set_userdata('success_message', 'Record Saved Successfully');
            }
        
            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");
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
            if(isset($_POST['prod_pic_user_id'])) $data->prod_pic_user_id = $this->input->post('prod_pic_user_id');
            if(isset($_POST['qa_sample_affected_qty'])) $data->qa_sample_affected_qty = $this->input->post('qa_sample_affected_qty');
            if(isset($_POST['qa_sample_good_qty'])) $data->qa_sample_good_qty = $this->input->post('qa_sample_good_qty');
            if(isset($_POST['qa_sample_reject_qty'])) $data->qa_sample_reject_qty = $this->input->post('qa_sample_reject_qty');
            if(isset($_POST['confirmation'])) $data->confirmation = $this->input->post('confirmation');

            //Check if checkbox exist
            if(isset($_POST['_scrap'])) $data->_scrap = $this->input->post('_scrap');
            if(isset($_POST['_rework'])) $data->_rework = $this->input->post('_rework');
            if(isset($_POST['_uai'])) $data->_uai = $this->input->post('_uai');

            $data->update_disposition = 'disabled';

            if(@$this->session->userdata['permission']['S2.4']['de']){
                $data->update_disposition = 'enabled';
            }

            if(isset($_POST['affected_qty']) )$data->affected_qty = $this->input->post('affected_qty');
            if(isset($_POST['good_qty']) )$data->good_qty = $this->input->post('good_qty');
            if(isset($_POST['reject_qty']) )$data->reject_qty = $this->input->post('reject_qty'); 

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

            if($this->input->post('submit') == 'update_section2' OR $this->input->post('submit') == 'final_section2')
            {
                if($this->input->post('submit') == 'final_section2'){

                    //allow MRB to fund 10 marks, other only 1
                    if(@$this->session->userdata['permission']['S2.4']['de']){
                        $confirm_weight = 10;
                    }else if(@$this->session->userdata['permission']['S2.1']['de']){
                        $confirm_weight = 1;
                    }
                    else{
                        $confirm_weight = 0;
                    }

                    if($data->confirmation > 0) $data->confirmation += $confirm_weight;
                    else $data->confirmation = $confirm_weight;
                }
                $data->qan_id = $this->input->post('machine_breakdown_id');
                $this->modal_update->update_section2($data);
                $this->modal_update->update_qasample_mrb($data->qan_id,$data->qa_sample_reject_qty);
                

                if($data->confirmation > 10) $this->modal_update->update_status($data->qan_id,'7','6');
                $this->session->set_userdata('success_message', 'Record Updated Successfully');
            }else{
            
                $data = $this->modal_create->save_section2($data);
                $this->modal_update->update_qasample_mrb($qan_id,$data->qa_sample_reject_qty);

                $this->session->set_userdata('success_message', 'Record Saved Successfully');
            }

            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");
        }//end of submit section2

        //Check submit button of section 3
        if($this->input->post('submit') == 'create_section3' OR $this->input->post('submit') == 'update_section3') 
        {
            $data = new stdClass();

            //captured engineering submission part
            if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
            if(isset($_POST['root_cause'])) $data->root_cause_id = $this->input->post('root_cause');
            if(isset($_POST['corrective_action'])) $data->corrective_action_id = $this->input->post('corrective_action');
            if(isset($_POST['rcfa_pic_user_id'])) $data->rcfa_pic_user_id = $this->input->post('rcfa_pic_user_id');
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
            if(isset($_POST['time_end'])) $data->time_end = $this->input->post('time_end');
            if(isset($_POST['rc_result'])) $data->result = $this->input->post('rc_result');

            $data->inspection_machine_data = array();
            $data->new_inspection_machine_data = array();
            $data->inspection_result_data = array();

            //lets check only previous submission has been given result then we allow to save next new
            $last_submit_result = $this->modal_master->get_submission_validation_result($data->qan_id);
            
            if(isset($data->rcfa_pic_user_id) and count($data->rcfa_pic_user_id)>0){

                foreach($data->rcfa_pic_user_id as $i => $null){

                    if($i==0 OR (count($data->rcfa_pic_user_id)-1)>$i){
                        continue; //skip tab 0
                    } 
                    if($data->submission_no[$i] > ($last_submit_result['total_submission']+1) and $last_submit_result['result']=='PASS'){
                        continue; //skip if user send more than one submission or result that got pass result
                    }
                    
                    if(isset($data->submission_id[$i]) and $data->submission_id[$i]>0){
                        //for update part
                        $data->inspection_machine_data[$i] = new stdClass();
                        $data->inspection_machine_data[$i]->submission_id = $data->submission_id[$i];
                        $data->inspection_machine_data[$i]->root_cause_id = @$data->root_cause_id[$i];
                        $data->inspection_machine_data[$i]->corrective_action_id = @$data->corrective_action_id[$i];
                        $data->inspection_machine_data[$i]->submission_no = $data->submission_no[$i];
                        $data->inspection_machine_data[$i]->rcfa_pic_user_id = $data->rcfa_pic_user_id[$i];
                        $data->inspection_machine_data[$i]->rcfa_ack_user_id = $data->rcfa_ack_user_id[$i];
                        $data->inspection_machine_data[$i]->completion_user_id = $data->completion_user_id[$i];

                    }
                    else{
                        //for insert part
                        $data->new_inspection_machine_data[$i] = new stdClass();
                        $data->new_inspection_machine_data[$i]->root_cause_id = $data->root_cause_id[$i];
                        $data->new_inspection_machine_data[$i]->corrective_action_id = $data->corrective_action_id[$i];
                        $data->new_inspection_machine_data[$i]->submission_no = $data->submission_no[$i];
                        $data->new_inspection_machine_data[$i]->rcfa_pic_user_id = $data->rcfa_pic_user_id[$i];
                        $data->new_inspection_machine_data[$i]->rcfa_ack_user_id = $data->rcfa_ack_user_id[$i];
                        $data->new_inspection_machine_data[$i]->completion_user_id = $data->completion_user_id[$i];

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
                        $data->inspection_result_data[$tab_no][$j]->time_end = $data->time_end[$tab_no][$machine_id];
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
                $this->modal_create->save_section3($data);
                $success_msg = 'Record Saved Successfully';
            }
            if($this->input->post('submit') == 'update_section3' OR count($data->inspection_machine_data)>0){

                $this->modal_update->update_section3($data);
                $success_msg = 'Record Updated Successfully';

                $last_submit_result = $this->modal_master->get_submission_validation_result($data->qan_id);
            
                if($last_submit_result['result']=='PASS'){
                    $this->modal_update->update_status($data->qan_id,'5','4');
                }
            }

            $this->session->set_userdata('success_message', ' '.$success_msg);
            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");
        } //end of submit section3

        //Check submit button of section 4
        if($this->input->post('submit') == 'update_section4') {

            $data = new stdClass();
            if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
            if(isset($_POST['approval_user_id'])) $data->approval_user_id = $this->input->post('approval_user_id');
            if(isset($_POST['machine_status'])) $data->machine_status = $this->input->post('machine_status');
            if(isset($_POST['machine_stop_reason'])) $data->machine_stop_reason = $this->input->post('machine_stop_reason');
            
            $this->modal_update->update_section4($data);
            if(@$view['data']->confirmation >= 11)
                $this->modal_update->update_status($data->qan_id,'7');
            else 
                $this->modal_update->update_status($data->qan_id,'6','5');

            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");
        } //end of submit section4

        //Check submit button of section 5
        if($this->input->post('submit') == 'update_section5') {

            $data = new stdClass();
            if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
            if(isset($_POST['purging_completed'])) $data->purge_status = $this->input->post('purging_completed');
            if(isset($_POST['notify_next_process'])) $data->notify_next_process = $this->input->post('notify_next_process');
            if(isset($_POST['validation_result'])) $data->fix_validation_result = $this->input->post('validation_result');
            if(isset($_POST['closedby_user_id'])) $data->closedby_user_id = $this->input->post('closedby_user_id');

            $this->modal_update->update_section5($data);
            $this->modal_update->update_status($data->qan_id,'99','7');
            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");
        } //end of submit section5
    
        $view['machine_no']=$this->modal_master->get_machine_no();
        $view['detected_by']=$this->modal_master->get_detected_by();
        $this->load->view('FrontEnd/QAN/mastertemplate',$view);
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
        $view['data']->redirect = base_url()."FrontEnd/mastertemplate/".$this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/successmaster',$view);
        $this->footer();
    }

    public function notauthorized(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $this->load->view('FrontEnd/notauthorized',$this->data);
        $this->footer($this->data);
    }

    public function Section1(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $data = '{
            "qan_no": 123,
            "status": "new",
            "issueby_user_id": 2,
            "issueto_user": 3,
           
            "ack_eng_user": 1,
            
            "ack_prod_user": 1,
                
            
            "ack_qa_user": 3,
            
            "form_start":"yes",
            "form_end":"no",
            "submit_button":{
              "name":"submit",
              "url":"/controller"
            },

            "prod_loc":[
                {"id":"1","location_name":"QA Sample"},
                {"id":"2","location_name":"Engineering Sample"},
                {"id":"3","location_name":"Inside CNC"},
                {"id":"4","location_name":"P1"},
                {"id":"5","location_name":"P2"},
                {"id":"6","location_name":"Washing"},
                {"id":"7","location_name":"Brushing"},
                {"id":"8","location_name":"CP"},
                {"id":"9","location_name":"FVMI"}
            ],

            "qa_sample_loc":[
                {"id":"1","location_name":"QA Sample"},
                {"id":"2","location_name":"Engineering Sample"},
                {"id":"3","location_name":"Inside CNC"},
                {"id":"4","location_name":"P1"},
                {"id":"5","location_name":"P2"},
                {"id":"6","location_name":"Washing"},
                {"id":"7","location_name":"Brushing"},
                {"id":"8","location_name":"CP"},
                {"id":"9","location_name":"FVMI"}
            ]


            
          }';
          $data = json_decode($data);

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        //$result['data']=$data;
        $data->submit_button->name="Save";
        $this->load->view('FrontEnd/section1',array("data"=>$data));
        $this->footer($this->data);
    }

    public function Section2(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";
        

        $data = '{
            "loc_to_purge":[
                {"id":"1","process_name":"M/C-P1"},
                {"id":"2","process_name":"M/C-P2"},
                {"id":"3","process_name":"M/C-P3"}
            ],
           "purge_location":[
               {"purge_location_id":1,"affected_qty":"20","good_qty":"10","reject_qty":"10"},
               {"purge_location_id":2,"affected_qty":"20","good_qty":"10","reject_qty":"10"},
               {"purge_location_id":3,"affected_qty":"20","good_qty":"10","reject_qty":"10"}
            ],
            "totalSample": 90,
            "qa_sample_good_qty": 100,
            "qa_sample_reject_qty": 50,
            "scrap": 1,
            "rework": 1,
            "uai": 1,
            "rework_order_no": "test",
            "scrap_no": "test",
            "uai_no": "test",
            "rework_dispo_input": "test",
            "rework_dispo_output": "test",
            "rework_dispo_rej_scrap": "test",
            "user":{
                "1":"asma",
                "2":"Jaidul",
                "3":"ashok"
            },
            "reportby_user_id": 1,
            "qa_reinsp_verification_user_id": 2,
            "qa_reinsp_status_accept": 1,
            "qa_reinsp_status_reject": 0,
            "reject_reason": "test",
            "form_start":"yes",
               "form_end":"no",
                "submit_button":{
                "name":"submit",
                "url":"/controller"
            },
            "machine_breakdown_id": 1

        }';
        $data = '{"loc_to_purge":[
            {"id":"1","process_name":"M/C-P1"},
            {"id":"2","process_name":"M/C-P2"},
            {"id":"3","process_name":"M/C-P3"}
        ],
       "purge_location":[
           
        ]}';
        $data = json_decode($data);
        
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$data;
        if(@$data->submit_button->name){
            $data->submit_button->name="Save";
        }
        $this->load->view('FrontEnd/section2',$result);
        $this->footer();
    }

    public function Section3(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";
        

        $data = '{

            "root_cause": "test",
            "corrective_action": "test",
            "user":{
                "1": "asma",
                "2": "emizul",
                "3": "qayyum"
            },
            "inspect_user":{
                "1": {"fullname": "asma"},
                "2": {"fullname": "emizul"},
                "3": {"fullname":"qayyum"}
            },   
            "inspect_by": 1,
            "rcfa_pic_user_id": 3,
            "rcfa_ack_user_id": 1,
            "rcfa_appr_user_id": 2,
            "completion_user_id": 1,
            "inspection_machine":[
                {"id":"1","name":"CMM"},
                {"id":"2","name":"EDI"},
                {"id":"3","name":"AIR GAUGE"}
            ],
            "inspection_machine_data":
            [
              
                    {
                      
                      "root_cause_submission_id":"1",
                      "root_cause": "test",
                      "corrective_action": "test",
                      "rcfa_pic_user_id": 1,
                      "rcfa_ack_user_id": 1,
                      "rcfa_appr_user_id": 1,
                      "completion_user_id": 1,
                      
                      "inspection_data": [{
                            "inspection_machine_id":"1",
                            "inspectby_user_id":"1",
                            "time_start2":"15:00",
                            "time_end2":"15:00",
                            "result":"1"
                        }]
                    },
                    {
                      
                      "root_cause_submission_id":"2",
                      "root_cause": "test2",
                      "corrective_action": "test2",
                      "rcfa_pic_user_id": 2,
                      "rcfa_ack_user_id": 2,
                      "rcfa_appr_user_id": 2,
                      "completion_user_id": 2,
                      
                      "inspection_data": [{
                            "inspection_machine_id":"2",
                            "inspectby_user_id":"2",
                            "time_start2":"15:00",
                            "time_end2":"15:00",
                            "result":"0"
                        }]
                      
                    }
                 
                
            ]
            
        }';

        $data = json_decode($data);

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$data;
        // $data->submit_button->name="Save";
        $this->load->view('FrontEnd/section3',$result);
        $this->footer();
    }

    public function Section5(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";
        

        $data = '{

            "machine_status": 1,
            "user": {
                "1":"asma",
                "2":"Jaidul",
                "3":"ashok"
            },
            "approval_user_id": 1,
            "machine_stop_reason": "test",
            "form_start":"yes",
               "form_end":"no",
                "submit_button":{
                "name":"submit",
                "url":"/controller"
            },
            "machine_breakdown_id": 169

        }';

        $data = json_decode($data);

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$data;
        $data->submit_button->name="Save";
        $this->load->view('FrontEnd/section5',$result);
        $this->footer();
    }

    public function Section6(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";
        

        $data = '{

            "purge_status": 1,
            "user":{
                "1": "asma",
                "2": "nabi",
                "3": "emizul"
            },
            "closedby_user_id": 2,
            "notify_next_process": 1,
            "closed_datetime":"2018-12-20 09:34:00.000",
            "fix_validation_result": 1,
            "machine_breakdown_id": 169,
            "form_start":"yes",
            "form_end":"no",
                "submit_button":{
                "name":"submit",
                "url":"/controller"
            }
        }';

        $data = json_decode($data);

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$data;
        $data->submit_button->name="Save";
        $this->load->view('FrontEnd/section6',$result);
        $this->footer();
    }
}