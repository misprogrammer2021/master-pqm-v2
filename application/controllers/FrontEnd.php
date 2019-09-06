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
            $this->load->model('Function_users');
            $this->load->model('Function_machinebreakdown');
            $this->load->model('Function_materialreviewboard');
            $this->load->model('Function_rootcausefailure');
            $this->load->model('Function_qa_review');
            $this->load->model('modal_master');
            $this->load->model('modal_create');
            $this->load->model('modal_update');
            $this->load->model('modal_delete');
        
            date_default_timezone_set('Asia/Kuala_Lumpur');
    }

	public function index()
	{
        redirect('/homepage', 'refresh');
        // if ($this->form_validation->run() == FALSE) {
        //     if(isset($this->session->userdata['logged_in'])){
        //         redirect('/homepage', 'refresh');

        //     }
        //         redirect('/login', 'refresh');
        // }   

        // Active Header, must include in every public function
        // $this->data['title'] = "JCY Product Quality System";
        // $this->data['pageName'] = "Homepage";
        // $this->data['description'] = "Overview";

        // // Start controller code here

        // // Load View
        // $this->header($this->data);
        // $this->topbar($this->data);
        // $this->leftsidebar($this->data);
        // $this->rightsidebar($this->data);
        // $this->load->view('FrontEnd/index',$this->data);
        // $this->footer();
    }
    
    // public function login() {
    //     // Active Header, must include in every public function
    //     $this->data['title'] = "JCY PQM - Product Quality System";
    //     $this->data['pageName'] = "JCY PQM";
    //     $this->data['description'] = "Product Quality System";
        
    //     //Load View
    //     $this->load->view('FrontEnd/login');
    // }

    
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
        //$this->form_validation->set_rules('role_group', 'Role Group', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('FrontEnd/register');
        } else {
            $data = array(
            // 'id' => $this->input->post(''),  
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
            // 'role_group_id' => $this->input->post('role_group')
            
            
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

            // $this->modal_master->section1_task_informer();
            // exit;
            $this->data['title'] = "JCY Product Quality System";
            $this->data['pageName'] = "Homepage";
            $this->data['description'] = "Overview";

            $this->header($this->data);
            $this->topbar($this->data);
            $this->leftsidebar($this->data);
            $this->rightsidebar($this->data);
            // $result['listnewform']=$this->Function_materialreviewboard->displayListNewStatusForm();
            $this->load->view('FrontEnd/QAN/homepage',$this->data);
            $this->footer();
            
    }

    public function dashboard_closed_ticket(){

        // $this->modal_master->section1_task_informer();
        // exit;
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Homepage";
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

        // print_r($result);// print_r($result);
        for($i=0; $i<12; $i++){
            $reject[$i] = 0;
            $affected[$i] = 0;
        }
        foreach($result as $row){
            $reject[$row->MONTH] = $row->Total_Rej;
            $affected[$row->MONTH] = $row->Total_Aff;

        }

        
        
        // print_r($reject);
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
            $result[$i]->defect = $this->modal_master->get_defect_info($row->id,'defect_description');
            
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
            $result[$i]->defect = $this->modal_master->get_defect_info($row->id,'defect_description');
            
        }
        $data = array(
            'data' =>$result
        );
        echo json_encode($data);
    }

    public function mastertemplate($qan_id=0){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Homepage";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        

        if($qan_id > 0){

            // echo '<pre>';
            // print_r($this->session->userdata['permission']);
            // exit;

            $this->modal_master->load_qan($qan_id);
            $this->modal_master->Section1();
            $this->modal_master->Section2();
            $this->modal_master->Section3();

            $view['data'] = $this->modal_master->get_data();
            // echo '<pre>';
            // print_r($view['data']);
            // exit;
            $view['data']->submit_button = new stdClass();

            //if(strlen($view['data']->datetime)<5) $view['data']->datetime = date("Y-m-d H:i:s");

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
                
                if((@$this->session->userdata['permission']['S1']['ack']) and ($view['data']->status == '1' or $view['data']->status == '3')){
                    $user_id = $this->session->userdata['logged_in']['id'];

                    if(!($view['data']->ack_eng_user==$user_id or $view['data']->ack_prod_user==$user_id or $view['data']->ack_qa_user==$user_id )){
                        $button_obj = new stdClass();
                        $button_obj->name = 'ACKNOWLEDGE';
                        $button_obj->value = 'update_section1_ack';
                        $button_obj->action = base_url().'FrontEnd/mastertemplate/'; //action kena sama
                        array_push($view['data']->submit_button->s1,$button_obj);
                    }
                }
      
            }

            if( (@$this->session->userdata['permission']['S2']['de'] OR @$this->session->userdata['permission']['S2']['ack'] OR @$this->session->userdata['permission']['S2']['app']) and ($view['data']->status >= 3 and $view['data']->status < 7)) //6
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
                    $view['data']->submit_button->s2 = array();
                    $button_obj = new stdClass();
                    $button_obj->name = @$view['data']->mrb_id > 0?'UPDATE':'CREATE';
                    $button_obj->value = @$view['data']->mrb_id > 0?'update_section2':'create_section2';
                    $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                    array_push($view['data']->submit_button->s2,$button_obj);
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
                // if((@$this->session->userdata['permission']['S3']['app']) and $view['data']->status < '5'){
                //     $button_obj = new stdClass();
                //     $button_obj->name = 'APPROVE';
                //     $button_obj->value = 'update_section3';
                //     $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                //     array_push($view['data']->submit_button->s3,$button_obj);
                // }
                if((@$this->session->userdata['permission']['S3']['de'] or @$this->session->userdata['permission']['S3']['ack']) and ($view['data']->status == '4')){
                    $button_obj = new stdClass();
                    $button_obj->name = @$view['data']->inspection_machine_data[0]->submission_id > 0?'UPDATE':'CREATE';
                    $button_obj->value = @$view['data']->inspection_machine_data[0]->submission_id > 0?'update_section3':'create_section3';
                    $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                    array_push($view['data']->submit_button->s3,$button_obj);
                }
            }
            if( (@$this->session->userdata['permission']['S4']['de'] OR @$this->session->userdata['permission']['S4']['ack'] OR @$this->session->userdata['permission']['S4']['app']) and ($view['data']->status == '5'))
            {
                $view['data']->submit_button->s4 = array();
                $button_obj = new stdClass();
                $button_obj->name = 'APPROVE';
                $button_obj->value = 'update_section4';
                $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                array_push($view['data']->submit_button->s4,$button_obj);
            }
            if( (@$this->session->userdata['permission']['S5']['de'] OR @$this->session->userdata['permission']['S5']['ack'] OR @$this->session->userdata['permission']['S5']['app']) and ($view['data']->status == '7'))
            {
                $view['data']->submit_button->s5 = array();
                $button_obj = new stdClass();
                $button_obj->name = 'CLOSED';
                $button_obj->value = 'update_section5';
                $button_obj->action = base_url().'FrontEnd/mastertemplate/';
                array_push($view['data']->submit_button->s5,$button_obj);
            }
            
        }else{
            
            $this->modal_master->load_new_qan();
            $view['data'] = $this->modal_master->get_data();
            $view['data']->submit_button = new stdClass();
            $view['data']->submit_button->s1 = array();
            $button_obj = new stdClass();
            $button_obj->name = 'CREATE NEW';
            $button_obj->value = 'create_section1';
            $button_obj->action = base_url().'FrontEnd/mastertemplate';
            array_push($view['data']->submit_button->s1,$button_obj);

        }
       
        // echo '<br><br><pre>';
        // print_r($this->session->userdata['permission']);
        // echo '</pre>';

        $view['data']->user->{$this->session->userdata['logged_in']['id']} = $this->Function_materialreviewboard->getUserById($this->session->userdata['logged_in']['id']);
        
        if(@$view['data']->issueby_user_id<1 and (@$this->session->userdata['permission']['S1.1']['de'] or @$this->session->userdata['permission']['S1.3']['de']) ){
            $view['data']->issueby_user_id = $this->session->userdata['logged_in']['id'];
        }
        if(@$view['data']->issueto_user<1 and @$this->session->userdata['permission']['S1.5']['ack']){
            $view['data']->issueto_user = $this->session->userdata['logged_in']['id'];
        }

        // echo '<pre>';
        // print_r($this->session->userdata);
        // exit;
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
    

        if($i < 0 OR (@$this->session->userdata['permission']['S3.1']['de'] and $i<$last_submit_result['total_submission'] and $last_submit_result['result']!='PASS')){

            
            $i = $i+1;

            if($last_submit_result['result']=='FAILED'){
                $i = $last_submit_result['total_submission'];
            }

            // echo $i;
            // exit;

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
        // $view['data']->issueto_user= $this->session->userdata['logged_in']['id'];
        // $view['show_section1'] = TRUE;
        // $view['show_section3'] = TRUE;
        // $view['show_section5'] = TRUE;
        // print_r($this->session->userdata['logged_in']['id']);
        // exit;
        $view['show_allsection'] = TRUE;
        // @$section['S1']['de']
        // print_r( $view['data']->issueto_user);
        // exit;
        // print_r($this->session->userdata['permission']);
        // print_r($view['data']);
        // exit;
        
        //Check submit button
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

            // echo '<pre>';
            // print_r($ack_data);
            // exit;

            if($ack_data->ack_eng_user > 0 and $ack_data->ack_prod_user > 0 and $ack_data->ack_qa_user > 0)
                $this->modal_update->update_status($data->qan_id,'4','3');
            else
                $this->modal_update->update_status($data->qan_id,'3');

            $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            redirect("FrontEnd/successmaster");

        }
        
        if($this->input->post('submit') == 'create_section1' OR $this->input->post('submit') == 'update_section1') {
        
            // print_r($_POST);
            // exit;

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
        if(isset($_POST['part_name'])) $data->part_name = $this->input->post('part_name'); 
        if(isset($_POST['machine_no'])) $data->machine_no = $this->input->post('machine_no');
        if(isset($_POST['process'])) $data->process= $this->input->post('process');
        if(isset($_POST['cav_no'])) $data->cav_no = $this->input->post('cav_no');
        if(isset($_POST['up_affected'])) $data->up_affected = $this->input->post('up_affected');
        if(isset($_POST['detectedby_user'])) $data->detectedby_user = $this->input->post('detectedby_user');
        if(isset($_POST['defect_description'])) $data->defect_description = $this->input->post('defect_description');
        if(isset($_POST['last_passed_sample'])) $data->last_passed_sample = $this->input->post('last_passed_sample');
        if(isset($_POST['purge_from'])) $data->purge_from = $this->input->post('purge_from');
        if(isset($_POST['estimate_qty'])) $data->estimate_qty = $this->input->post('estimate_qty');
        //if(isset($_POST['ack_eng_user'])) $data->ack_eng_user = $this->input->post('ack_eng_user');
        //if(isset($_POST['ack_prod_user'])) $data->ack_prod_user = $this->input->post('ack_prod_user');
        //if(isset($_POST['ack_qa_user']) )$data->ack_qa_user = $this->input->post('ack_qa_user');

       

        $qasample_qty_array = $this->input->post('input_qty_qasample'); 
        
        if(is_array($qasample_qty_array) AND (count($qasample_qty_array) > 0)){
            $i = 0;
            foreach($qasample_qty_array as $qa_sample_id => $qasampleqty){
                
                // if($qasampleqty > 0){
                    $data->qasample_qty[$i] = new stdClass();
                    $data->qasample_qty[$i]->qa_sample_id = $qa_sample_id;
                    $data->qasample_qty[$i]->samplequantity = $qasampleqty;
                    $i++;
                // }
            }	
        }
        $prod_qty_array = $this->input->post('input_qty_prod');
        
        if(is_array($prod_qty_array) AND (count($prod_qty_array) > 0)){

            $i = 0;
            foreach($prod_qty_array as $prod_id => $prodqty){
                
                // if($prodqty > 0){
                    $data->production_qty[$i] = new stdClass();
                    $data->production_qty[$i]->prod_id = $prod_id;
                    $data->production_qty[$i]->prodquantity = $prodqty;
                    $i++;
                // }
            }	
        }
        //date_default_timezone_set('Asia/Kuala_Lumpur');
        //system generate
        $data->modified_date = date("Y-m-d H:i:s");
        if($this->input->post('submit') == 'update_section1'){
            $data->qan_no = $this->input->post('qan_no');
            $data->qan_id = $this->input->post('machine_breakdown_id');
            // echo '<pre>';
            // print_r($data);
            // exit;
            $this->modal_update->update_section1($data);
           
            // echo '<pre>';
            // print_r($data);
            // exit;
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

    // echo '<pre>';
    // print_r($this->modal_update->update_qasample_mrb($qan_id));
    // exit;

    //Check submit button 
    if($this->input->post('submit') == 'create_section2' OR $this->input->post('submit') == 'update_section2' OR $this->input->post('submit') == 'final_section2') {
        
        // print_r($_POST);
        // exit;

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
    //if(isset($_POST['qa_buyoff_user_id'])) $data->qa_buyoff_user_id = $this->input->post('qa_buyoff_user_id');
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

    // 'purge_location_id' => $goodqty->purge_location_id,
	// 					'mrb_id' => $data->mrb_id,
	// 					'affected_qty' => $totalaffectedqty,
	// 					'good_qty' => $good_qty->good_qty,
	// 					'reject_qty' => $good_qty->reject_qty,
	// 					'prod_pic_user_id' => $good_qty->prod_pic_user_id,
    //                   'qa_buyoff_user_id' => $good_qty->qa_buyoff_user_id
    
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

    
    
    
    if($this->input->post('submit') == 'update_section2' OR $this->input->post('submit') == 'final_section2'){
        
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
        // $data->qan_no = $this->input->post('qan_no');
        $data->qan_id = $this->input->post('machine_breakdown_id');
        // echo '<pre>';
        // print_r($data);
        // exit;
        $this->modal_update->update_section2($data);
        $this->modal_update->update_qasample_mrb($data->qan_id,$data->qa_sample_reject_qty);
        

        if($data->confirmation > 10) $this->modal_update->update_status($data->qan_id,'7','6');
        // echo '<pre>';
        // print_r($data);
        // exit;
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
    if($this->input->post('submit') == 'create_section3' OR $this->input->post('submit') == 'update_section3') {
        
        // echo '<pre>';
        // print_r($_POST);
        // exit;
        $data = new stdClass();

        //captured engineering submission part
        if(isset($_POST['machine_breakdown_id'])) $data->qan_id = $this->input->post('machine_breakdown_id');
        if(isset($_POST['root_cause'])) $data->root_cause = $this->input->post('root_cause');
        if(isset($_POST['corrective_action'])) $data->corrective_action = $this->input->post('corrective_action');
        if(isset($_POST['rcfa_pic_user_id'])) $data->rcfa_pic_user_id = $this->input->post('rcfa_pic_user_id');
        if(isset($_POST['rcfa_ack_user_id'])) $data->rcfa_ack_user_id = $this->input->post('rcfa_ack_user_id');
        if(isset($_POST['rcfa_appr_user_id'])) $data->rcfa_appr_user_id = $this->input->post('rcfa_appr_user_id');
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

                if($i==0){
                    continue; //skip tab 0
                } 
                if($data->submission_no[$i] > ($last_submit_result['total_submission']+1) and $last_submit_result['result']=='PASS'){
                    continue; //skip if user send more than one submission or result that got pass result
                }
                if(isset($data->submission_id[$i]) and $data->submission_id[$i]>0){
                    //for update part
                    $data->inspection_machine_data[$i] = new stdClass();
                    $data->inspection_machine_data[$i]->submission_id = $data->submission_id[$i];
                    $data->inspection_machine_data[$i]->root_cause = @$data->root_cause[$i];
                    $data->inspection_machine_data[$i]->corrective_action = @$data->corrective_action[$i];
                    $data->inspection_machine_data[$i]->submission_no = $data->submission_no[$i];
                    $data->inspection_machine_data[$i]->rcfa_pic_user_id = $data->rcfa_pic_user_id[$i];
                    $data->inspection_machine_data[$i]->rcfa_ack_user_id = $data->rcfa_ack_user_id[$i];
                    $data->inspection_machine_data[$i]->rcfa_appr_user_id = $data->rcfa_appr_user_id[$i];
                    $data->inspection_machine_data[$i]->completion_user_id = $data->completion_user_id[$i];

                }
                else{
                    //for insert part
                    $data->new_inspection_machine_data[$i] = new stdClass();
                    $data->new_inspection_machine_data[$i]->root_cause = $data->root_cause[$i];
                    $data->new_inspection_machine_data[$i]->corrective_action = $data->corrective_action[$i];
                    $data->new_inspection_machine_data[$i]->submission_no = $data->submission_no[$i];
                    $data->new_inspection_machine_data[$i]->rcfa_pic_user_id = $data->rcfa_pic_user_id[$i];
                    $data->new_inspection_machine_data[$i]->rcfa_ack_user_id = $data->rcfa_ack_user_id[$i];
                    $data->new_inspection_machine_data[$i]->rcfa_appr_user_id = $data->rcfa_appr_user_id[$i];
                    $data->new_inspection_machine_data[$i]->completion_user_id = $data->completion_user_id[$i];

                }
            }
        }

        // echo '<pre>';
        // print_r($data);
        // exit;

        //find all current selected submission id AND collect inspection data
        if(isset($data->inspection_machine_id) and count($data->inspection_machine_id)>0){
            foreach($data->inspection_machine_id as $tab_no => $selected_machine){
                if($tab_no==0) continue; //skip tab 0
                $j=0;
                foreach($selected_machine as $machine_id => $checkbox_state){
                    
                    if(count($data->result[$tab_no])<1 or $data->submission_id[$tab_no]<1) continue;
                    //$root_cause_submission_id[$data->submission_id[$tab_no]] = $tab_no;
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

        //print_r($_POST);
        // echo '<pre>';
        // print_r($root_cause_submission_id);
        // print_r($data->_inspection_machine_id);
        // exit;
        
        $data->qan_id = $this->input->post('machine_breakdown_id');
        $success_msg = '';

        if($this->input->post('submit') == 'create_section3' OR count($data->new_inspection_machine_data)>0 OR count($data->inspection_result_data)>0 OR @count($data->_inspection_machine_id)){
        //    print_r($root_cause_submission_id);
        //    exit;
            if(count(@$root_cause_submission_id)>0 and count($data->inspection_result_data)>0){
                $this->modal_delete->delete_inspection_data($data->qan_id,array_keys($root_cause_submission_id));
            }
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
    
       // echo '<pre>';
        //print_r($view['data']);
        // print_r($this->session->userdata['permission']);
        // print_r($this->session->userdata);
        //exit;
        $this->load->view('FrontEnd/QAN/mastertemplate',$view);
        $this->footer($this->data);
}

    public function successmaster(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
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

    public function DashboardMachineBreakdown(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/homepagemachinebreakdown',$result);
        $this->footer();
    }

    public function DashboardMaterialReviewBoard(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_materialreviewboard->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/homepagematerialreviewboard',$result);
        $this->footer();
    }

    public function DashboardRootCauseFailure(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_rootcausefailure->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/homepagerootcausefailure',$result);
        $this->footer();
    }

    public function DashboardForQAUseOnly(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_qa_review->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/homepageforqauseonly',$result);
        $this->footer();
    }

    public function DashboardFinalReviewQAEngineer(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";;
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_qa_review->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/homepagefinalreview',$result);
        $this->footer();
    }

    public function ViewListMachineBreakdownByQA(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_materialreviewboard->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listmachinebreakdownbyqa',$result);
        $this->footer();
    }

    public function ViewListMachineBreakdownByProduction(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listmachinebreakdownbyprod',$result);
        $this->footer();
    }

    public function ViewListCompleteMachineBreakdown(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listcompletemachinebreakdown',$result);
        $this->footer();
    }

    public function ViewListCompleteMaterialReviewBoard(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_materialreviewboard->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listcompletematerialreviewboard',$result);
        $this->footer();
    }

    public function ViewListCompleteRootCauseFailure(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_rootcausefailure->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listcompleterootcausefailure',$result);
        $this->footer();
    }

    public function ViewListCompleteForQAUseOnly(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_qa_review->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listcompleteforqauseonly',$result);
        $this->footer();
    }

    public function dashboard(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "New Task";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['listnewform']=$this->Function_materialreviewboard->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listnewform',$result);
        $this->footer();
    }

    public function dashboardlistmrbform(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "New Task";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['listmrbform']=$this->Function_materialreviewboard->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listnewmrbform',$result);
        $this->footer();
    }

    public function dashboardlistrootcauseform(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "New Task";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['listrootcauseform']=$this->Function_rootcausefailure->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listrootcauseform',$result);
        $this->footer();
    }

    public function dashboardlistforqaonlyform(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "New Task";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['listforqaonlyform']=$this->Function_qa_review->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listforqaonlyform',$result);
        $this->footer();
    }


    public function machinebreakdown() {
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Machine Break Down Form";
        $this->data['description'] = "Overview";

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->load->view('FrontEnd/QAN/machinebreakdown',$this->data);
        $this->footer();
    }

    public function machinebreakdownform() {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

       // $result=$this->Function_machinebreakdown->viewAllMachineBreakdownForm(10);
        
        $this->form_validation->set_rules('issueby_user', 'Issued By');
        $this->form_validation->set_rules('issueto_user', 'To');
        $this->form_validation->set_rules('issued_dept', 'Issued Dept', 'required');
        $this->form_validation->set_rules('to_dept', 'To Dept', 'required');
        $this->form_validation->set_rules('shift', 'Shift', 'required');
        $this->form_validation->set_rules('ooc', 'OOC (OUT OF CONTROL)', 'required');
        $this->form_validation->set_rules('oos', 'OOS (OUT OF SPEC)', 'required');
        $this->form_validation->set_rules('datetime', 'DATETIME', 'required');
        $this->form_validation->set_rules('part_name', 'Part Name', 'required');
        $this->form_validation->set_rules('machine_no', 'Machine No', 'required');
        $this->form_validation->set_rules('process', 'Process', 'required');
        $this->form_validation->set_rules('cav_no', 'Cavity No');
        $this->form_validation->set_rules('up_affected', 'UP Affected', 'required');
        $this->form_validation->set_rules('detectedby_user', 'Detected By User', 'required');
        $this->form_validation->set_rules('defect_description', 'Defect Description', 'required');
        $this->form_validation->set_rules('last_passed_sample', 'Last Past Sample', 'required');
        $this->form_validation->set_rules('purge_from', 'Purge From', 'required');
        $this->form_validation->set_rules('estimate_qty', 'Estimate Quantity', 'required');
        $this->form_validation->set_rules('ack_eng_user', 'Acknowledge By Engineering', 'required');
        $this->form_validation->set_rules('ack_prod_user', 'Acknowledge By Production', 'required');
        $this->form_validation->set_rules('ack_qa_user', 'Acknowledge By QA', 'required');
        $this->form_validation->set_rules('air_gauge', 'Air Gauge');
        $this->form_validation->set_rules('edi', 'EDI');
        $this->form_validation->set_rules('cmm_marposs', 'CMM/Marposs');
        $this->form_validation->set_rules('visual', 'Visual');
        $this->form_validation->set_rules('runner', 'Runner');
        // $this->form_validation->set_rules('total', 'Total');

        // if ($this->form_validation->run() == FALSE) {
        //     $this->load->view('FrontEnd/QAN/machinebreakdownform');
        // }else{
        //     $this->input->post('save');
        

        //Check submit button 
        if($this->input->post('submit')) {
            //$this->session->userdata['logged_in']['id'];
        
		// if($this->input->post('save'))
		// {
            // print_r($_POST);
            // exit;
		//get form's data and store in local varable
		// $running_no=$this->input->post('');
		// $created_date=$this->input->post('');
        // $modified_date=$this->input->post('');
        // $is_deleted=$this->input->post('');
        // $defect_info_id=$this->input->post('');
        // $root_cause_failure_id=$this->input->post('');
        // $status=$this->input->post('');
            
            $qan_no=$this->input->post('qan_no');
            $issueby_user_id=$this->session->userdata['logged_in']['id'];
            $issueto_user=$this->input->post('issueto_user');
            $issued_dept=$this->input->post('issued_dept');
            $to_dept=$this->input->post('to_dept');
            $shift=$this->input->post('shift');
            $ooc=$this->input->post('ooc');
            $oos=$this->input->post('oos');
            $datetime=$this->input->post('datetime');


        // $approval_user_id=$this->input->post('');
        // $machine_status=$this->input->post('');
        // $machine_stop_reason=$this->input->post('');
        // $purge_status=$this->input->post('');
        // $notify_next_process=$this->input->post('');
        // $fix_validation_result=$this->input->post('');
        // $closedby_user_id=$this->input->post('');
        
       
            $machine_breakdown_id=$this->input->post();         
            $part_name=$this->input->post('part_name'); 
            $machine_no=$this->input->post('machine_no');
            $process=$this->input->post('process');
            $cav_no=$this->input->post('cav_no');
            $up_affected=$this->input->post('up_affected');
            $detectedby_user=$this->input->post('detectedby_user');
            $defect_description=$this->input->post('defect_description');
            $last_passed_sample=$this->input->post('last_passed_sample');
            $purge_from=$this->input->post('purge_from');
            $estimate_qty=$this->input->post('estimate_qty');
            $ack_eng_user=$this->input->post('ack_eng_user');
            $ack_prod_user=$this->input->post('ack_prod_user');
            $ack_qa_user=$this->input->post('ack_qa_user');

            // $machine_breakdown_id=$this->input->post(); 
            $qa_sample_id=$this->input->post('input_qty_qasample'); 
            $quantity=$this->input->post('input_qty_qasample'); 

            	
        
        //call saverecords method of Hello_Model and pass variables as parameter
        // $this->Function_machinebreakdown->saveMachineBreakdownRecords($running_no,$created_date,$modified_date,$is_deleted,$defect_info_id,$root_cause_failure_id,$status,$issueby_user_id,$issueto_user_id,$issued_dept,$to_dept,$shift,$ooc,$datetime,$approval_user_id,$machine_status,$machine_stop_reason,$purge_status,$notify_next_process,$fix_validation_result,$closedby_user_id);	
        $machine_breakdown_id = $this->Function_machinebreakdown->saveMachineBreakdownRecords($qan_no,$issueby_user_id,$issueto_user,$issued_dept,$to_dept,$shift,$ooc,$oos,$datetime);	
        $this->Function_machinebreakdown->saveDefectInfoRecords($machine_breakdown_id,$part_name,$machine_no,$process,$cav_no,$up_affected,$detectedby_user,$defect_description,$last_passed_sample,$purge_from,$estimate_qty,$ack_eng_user,$ack_prod_user,$ack_qa_user);
        foreach($quantity as $qa_sample_id => $qasampleqty){
            
            if($qasampleqty > 0){
            $data = array(
                'qa_sample_id' => $qa_sample_id,
                'machine_breakdown_id' => $machine_breakdown_id,
                'quantity' => $qasampleqty
                // 'total' => $this->input->post('total_qa_sample')
                );
                $this->Function_machinebreakdown->saveQASampleRecords($data);
            }
        }	
        
        	
        // $machine_breakdown_id = $this->Function_machinebreakdown->saveQASampleRecords($machine_breakdown_id,$qa_sample_id,$quantity);				
        echo "Records Saved Successfully";
        //$this->session->set_flashdata('response',"Record Saved Successfully");
        // redirect('/viewmachinerecords?viewid=135');
        //$machine_breakdown_id = '135';
        $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
        redirect('/successmachinebreakdown');
        
		}
        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        //$result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['issueto_user']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        //$result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->load->view('FrontEnd/QAN/machinebreakdownform',$result);
        $this->footer($this->data);
    }

    public function ViewMachineBreakdownByQA($machine_breakdown_id = ''){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_machinebreakdown->displayRecordById($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        //$result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        //$result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->load->view('FrontEnd/QAN/viewmachinebreakdownbyqa',$result);
        $this->footer($this->data);
    }

    public function ViewMachineBreakdownByProduction($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_machinebreakdown->displayRecordById($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->prodquantity;
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        //$result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        //$result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->load->view('FrontEnd/QAN/viewmachinebreakdownbyprod',$result);
        $this->footer($this->data);
    }

    public function viewmachinerecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        // $machine_breakdown_id=$this->input->get('viewid');
        $id=$this->input->get('id');
        $result['data']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // print_r($result['data']);
        // exit;
        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }

        // $result['status']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['datetime']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['machine_no']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['defect_description']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['up_affected']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['last_passed_sample']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['purge_from']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['estimate_qty']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['quantity']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['issued_dept']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['issueto_user']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        // $result['to_dept']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);

        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        $result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        $result['issueto_user']=$this->Function_machinebreakdown->getAllEngDepart();
        $result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        $result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->load->view('FrontEnd/QAN/viewmachinerecords',$result);
        $this->footer();

    }

    public function successmachinebreakdown(){

        // $machine_breakdown_id = '135';
        //$this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";
 
        // Start controller code here
 
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->data['last_created_machine_id']=$this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/QAN/successmachinebreakdown',$this->data);
        $this->footer();
    }

    public function productionform() {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";


        //Check submit button 
        if($this->input->post('submit')) {
            $this->session->userdata['logged_in']['id'];

            //  print_r($_POST);
            // exit;
        
            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $prod_id=$this->input->post('input_qty_prod'); 
            $quantity=$this->input->post('input_qty_prod'); 

            foreach($quantity as $prod_id => $prodqty){
            
                if($prodqty > 0){
                $data = array(
                    'prod_id' => $prod_id,
                    'machine_breakdown_id' => $machine_breakdown_id,
                    'quantity' => $prodqty
                    // 'total' => $this->input->post('total_qa_sample')
                    );
                    $this->Function_machinebreakdown->saveProductionRecords($data);
                }
            }
    
        echo "Records Saved Successfully";
        $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
        redirect('/successproduction');
        
		}
        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        $result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        $result['issueto_user']=$this->Function_machinebreakdown->getAllEngDepart();
        $result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        $result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->load->view('FrontEnd/QAN/productionform',$result);
        $this->footer();
    }

    public function viewproductionrecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);
        $result['productionpart']=$this->Function_machinebreakdown->displayRecordById($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['productionpart'] as $machinedata){
            $result['totalquantity']+= $machinedata->quantity;
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        $this->load->view('FrontEnd/QAN/viewproductionrecords',$result);
        $this->footer();

    }

    public function updatedmachinebreakdown($machine_breakdown_id){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        
        if($this->input->post('update')) {
            $this->session->userdata['logged_in']['id'];
            
            $issueto_user=$this->input->post('issueto_user_id');
            $issued_dept=$this->input->post('issued_dept');
            $to_dept=$this->input->post('to_dept');
            $shift=$this->input->post('shift');
            $ooc=$this->input->post('ooc');
            $oos=$this->input->post('oos');
            $datetime=$this->input->post('datetime');       
            $part_name=$this->input->post('part_name'); 
            $machine_no=$this->input->post('machine_no');
            $process=$this->input->post('process');
            $cav_no=$this->input->post('cav_no');
            $up_affected=$this->input->post('up_affected');
            $detectedby_user=$this->input->post('detectedby_user');
            $defect_description=$this->input->post('defect_description');
            $last_passed_sample=$this->input->post('last_passed_sample');
            $purge_from=$this->input->post('purge_from');
            $estimate_qty=$this->input->post('estimate_qty');
            $ack_eng_user=$this->input->post('ack_eng_user_id');
            $ack_prod_user=$this->input->post('ack_prod_user_id');
            $ack_qa_user=$this->input->post('ack_qa_user_id');
            $qa_sample_id=$this->input->post('input_qty_qasample'); 
            $quantity=$this->input->post('input_qty_qasample'); 

            $this->Function_machinebreakdown->updateMachineBreakdownRecords($machine_breakdown_id,$issueto_user,$issued_dept,$to_dept,$shift,$ooc,$oos,$datetime);	
            $this->Function_machinebreakdown->updateDefectInfoRecords($machine_breakdown_id,$part_name,$machine_no,$process,$cav_no,$up_affected,$detectedby_user,$defect_description,$last_passed_sample,$purge_from,$estimate_qty,$ack_eng_user,$ack_prod_user,$ack_qa_user);  
            foreach($quantity as $qa_sample_id => $qasampleqty){
            
                if($qasampleqty > 0){
                $data = array(
                    'qa_sample_id' => $qa_sample_id,
                    'machine_breakdown_id' => $machine_breakdown_id,
                    'quantity' => $qasampleqty
                    // 'total' => $this->input->post('total_qa_sample')
                    );
                    $this->Function_machinebreakdown->updateQASampleRecords($machine_breakdown_id,$qa_sample_id,$data);
                }
            }

            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successmachinebreakdown');
        }

        $this->footer();
    }

    public function updatedproduction($machine_breakdown_id){
        
        if($this->input->post('update')) {
            $this->session->userdata['logged_in']['id'];

            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $prod_id=$this->input->post('input_qty_prod'); 
            $quantity=$this->input->post('input_qty_prod'); 

            foreach($quantity as $prod_id => $prodqty){
            
                if($prodqty > 0){
                $data = array(
                    'prod_id' => $prod_id,
                    'machine_breakdown_id' => $machine_breakdown_id,
                    'quantity' => $prodqty
                    // 'total' => $this->input->post('total_qa_sample')
                    );
                    $this->Function_machinebreakdown->updateProductionRecords($machine_breakdown_id,$prod_id,$data);
                }
            }

            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successproduction');
        }

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->footer();
    }

    public function successproduction(){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";
 
        // Start controller code here
 
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->data['machine_breakdown_id']=$this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/QAN/successproduction',$this->data);
        $this->footer();
    }

    public function ViewMaterialReviewBoardByMRB($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_machinebreakdown->displayRecordById($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        //$result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['issueto_user']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        //$result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $this->load->view('FrontEnd/QAN/viewmaterialreviewboardbymrb',$result);
        $this->footer($this->data);
    }


    public function materialreviewboardform($machine_breakdown_id = '') {
        // print_r($_POST);
        // exit;
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Material Review Board Form";
        $this->data['description'] = "Overview";

        //Check submit button 
        if($this->input->post('submit')) {
            $this->session->userdata['logged_in']['id'];

            // if (@isset($_GET['test'])){
            //     echo '<pre>';
            //     print_r($_POST);
            //     exit;
            // } 
            
            // print_r($_POST);
            // exit;
            
            $mrb_id=$this->input->post();
            $purge_location_id=$this->input->post('loc_purge');
            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $affected_qty=$this->input->post('aff_qty');
            $good_qty_array=$this->input->post('good_qty');
            $reject_qty_array=$this->input->post('rej_qty');
            $prod_pic_user_id=$this->session->userdata['logged_in']['id'];
            $qa_buyoff_user_id=$this->input->post('qa_buy_off');
            $qa_sample_affected_qty=$this->input->post('qa_sample_affected_qty'); 
            $qa_sample_good_qty=$this->input->post('qa_sample_good_qty'); 
            $qa_sample_reject_qty=$this->input->post('qa_sample_reject_qty'); 

            $scrap=$this->input->post('scrap');         
            $rework=$this->input->post('rework'); 
            $uai=$this->input->post('UAI');
            $scrap_no=$this->input->post('scrap_no');
            $rework_order_no=$this->input->post('rework_order');
            $uai_no=$this->input->post('UAI_no');
            $rework_dispo_input=$this->input->post('input_rework_uai');
            $rework_dispo_output=$this->input->post('output_rework_uai');
            $rework_dispo_rej_scrap=$this->input->post('rej_scrap');
            $reportby_user_id=$this->session->userdata['logged_in']['id'];
            // $qa_reinsp_verification_user_id=$this->session->userdata['logged_in']['id'];
            $qa_reinsp_status_accept=$this->input->post('qa_reinsp_select');
            $qa_reinsp_status_reject=$this->input->post('qa_reinsp_select');
            $reject_reason=$this->input->post('input_reject');

            $mrb_id = $this->Function_materialreviewboard->saveMaterialReviewBoardRecords($machine_breakdown_id,$scrap,$rework,$uai,$scrap_no,$rework_order_no,$uai_no,$rework_dispo_input,$rework_dispo_output,$rework_dispo_reject,$reportby_user_id,$qa_reinsp_status_accept,$qa_reinsp_status_reject,$reject_reason);	
            $this->Function_materialreviewboard->saveQASamplePurge($machine_breakdown_id,$qa_sample_affected_qty,$qa_sample_good_qty,$qa_sample_reject_qty);	
            foreach($good_qty_array as $purge_location_id => $good_qty){
                $reject_qty = $reject_qty_array[$purge_location_id];
                $totalaffectedqty = intval($reject_qty) + intval($good_qty);
                if($totalaffectedqty> 0){
                $data = array(
                    'purge_location_id' => $purge_location_id,
                    'mrb_id' => $mrb_id,
                    'affected_qty' => $totalaffectedqty,
                    'good_qty' => $good_qty,
                    'reject_qty' => $reject_qty,
                    'prod_pic_user_id' => $prod_pic_user_id,
                    'qa_buyoff_user_id' => $qa_buyoff_user_id
                    );
                    $this->Function_materialreviewboard->savePurge($data);
                }
            }
            
        echo "Records Saved Successfully";
        
        $result['qa_sample_total']=$this->Function_materialreviewboard->getTotalQASample($machine_breakdown_id);
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
        redirect('/successmaterialreviewboard');
        
		}
        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $this->load->view('FrontEnd/QAN/materialreviewboardform',$result);
        $this->footer();
    }

    public function viewlistform($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listnewform']=$this->Function_machinebreakdown->displayRecordById($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['listnewform'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        
        
        $this->load->view('FrontEnd/QAN/viewmachinebreakdown_onclick',$result);
        $this->footer();
    }

    
    public function ViewMaterialReviewBoard(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listmaterialreviewboardbymrb',$result);
        $this->footer();
    }

    public function ViewMaterialReviewBoardRecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['user'][$machinedata->qa_reinsp_verification_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->qa_reinsp_verification_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewmaterialreviewboardrecords',$result);
        $this->footer($this->data);

    }
    
    public function updatematerialreviewboard($machine_breakdown_id){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Material Review Board Records";
        $this->data['description'] = "Overview";
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->footer();

        if($this->input->post('update')) {
            $this->session->userdata['logged_in']['id'];

            // print_r($_POST);
            // exit;

            $purge_location_id=$this->input->post('loc_purge');
            $affected_qty=$this->input->post('aff_qty');
            $good_qty_array=$this->input->post('good_qty');
            $reject_qty_array=$this->input->post('rej_qty');
            $prod_pic_user_id=$this->session->userdata['logged_in']['id'];
            $qa_buyoff_user_id=$this->input->post('qa_buy_off');
            $qa_sample_affected_qty=$this->input->post('qa_sample_affected_qty'); 
            $qa_sample_good_qty=$this->input->post('qa_sample_good_qty'); 
            $qa_sample_reject_qty=$this->input->post('qa_sample_reject_qty'); 

            $scrap=$this->input->post('scrap');         
            $rework=$this->input->post('rework'); 
            $uai=$this->input->post('UAI');
            $scrap_no=$this->input->post('scrap_no');
            $rework_order_no=$this->input->post('rework_order');
            $uai_no=$this->input->post('UAI_no');
            $rework_dispo_input=$this->input->post('input_rework_uai');
            $rework_dispo_output=$this->input->post('output_rework_uai');
            $rework_dispo_rej_scrap=$this->input->post('rej_scrap');
            $reportby_user_id=$this->session->userdata['logged_in']['id'];
            // $qa_reinsp_verification_user_id=$this->session->userdata['logged_in']['id'];
            $qa_reinsp_status_accept=$this->input->post('qa_reinsp_select');
            $qa_reinsp_status_reject=$this->input->post('qa_reinsp_select');
            $reject_reason=$this->input->post('input_reject');

            $this->Function_materialreviewboard->updateMaterialReviewBoardRecords($machine_breakdown_id,$scrap,$rework,$uai,$scrap_no,$rework_order_no,$uai_no,$rework_dispo_input,$rework_dispo_output,$rework_dispo_rej_scrap,$reportby_user_id,$qa_reinsp_status_accept,$qa_reinsp_status_reject,$reject_reason);	
            $this->Function_materialreviewboard->updateQASampleRecords($machine_breakdown_id,$qa_sample_affected_qty,$qa_sample_good_qty,$qa_sample_reject_qty);  
            
            $data = array();
            foreach($good_qty_array as $purge_location_id => $good_qty){
                $reject_qty = $reject_qty_array[$purge_location_id];
                $totalaffectedqty = intval($reject_qty) + intval($good_qty);
                if($totalaffectedqty> 0){
                $data[] = array(
                    'purge_location_id' => $purge_location_id,
                    // 'mrb_id' => $mrb_id,
                    'affected_qty' => $totalaffectedqty,
                    'good_qty' => $good_qty,
                    'reject_qty' => $reject_qty,
                    'prod_pic_user_id' => $prod_pic_user_id,
                    'qa_buyoff_user_id' => $qa_buyoff_user_id
                    );
                    
                }
            }
            $this->Function_materialreviewboard->updatePurgeRecords($machine_breakdown_id,$data);

            $result['machine_breakdown_id']=$machine_breakdown_id;
            $result['data']=$this->Function_materialreviewboard->displayRecordById($machine_breakdown_id);
            $result['totalquantity']=0;
            foreach($result['data'] as $machinedata){
                $result['totalquantity']+= $machinedata->samplequantity;
                // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
                $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
                $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
                $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
                $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
                $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
                $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
                $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
                $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
            }

            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successmaterialreviewboard');
        }

    }


    public function successmaterialreviewboard(){

        
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";
 
        // Start controller code here
 
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->data['machine_breakdown_id'] = $this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/QAN/successmaterialreviewboard', $this->data);
        $this->footer();
    }

    // public function rootcausefailureform() {
    //     // Active Header, must include in every public function
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "Root Cause Failure Analysis Form";
    //     $this->data['description'] = "Overview";

    //     // Start controller code here

    //     // Load View
    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);
    //     $this->load->view('FrontEnd/QAN/rootcausefailureform',$this->data);
    //     $this->footer();
    // }

    public function ViewRootCauseFailureByEngineering($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->qa_reinsp_verification_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->qa_reinsp_verification_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }

        $result['submissionmrb']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);
        foreach($result['submissionmrb'] as $mrbdata){
            $result['user'][$mrbdata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->reportby_user_id);
            
        }
        
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        //$result['ack_by_eng']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['issueto_user']=$this->Function_machinebreakdown->getAllEngDepart();
        //$result['ack_by_prod']=$this->Function_machinebreakdown->getAllProdUsers();
        //$result['ack_by_qa']=$this->Function_machinebreakdown->getAckByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();
        $this->load->view('FrontEnd/QAN/viewrootcausefailurebyeng',$result);
        $this->footer($this->data);
    }

    public function rootcausefailureform($machine_breakdown_id = '') {
        
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Root Cause Failure Analysis Form";
        $this->data['description'] = "Overview";
        
        //Check submit button 
        if($this->input->post('submit')) {
            $this->session->userdata['logged_in']['id'];

          
            // print_r($_POST);
            // exit;
            
            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $root_cause=$this->input->post('root_cause');
            $corrective_action=$this->input->post('corrective_action');
            // $rcfa_pic_user_id=$this->input->post('rcfa_pic_user');
            $rcfa_pic_user_id=$this->session->userdata['logged_in']['id'];
            // $rcfa_ack_user_id=$this->input->post('rcfa_ack_by_eng');
            $rcfa_ack_user_id=$this->session->userdata['logged_in']['id'];
            $rcfa_appr_user_id=$this->input->post('rcfa_approved_by');

            $root_cause_failure_id=$this->input->post();
            // $completion_user_id=$this->input->post('submit_by');
            $completion_user_id=$this->session->userdata['logged_in']['id'];
            // $submission_no=$this->input->post();
            // $completion_datetime=$this->input->post('submit_by');

            $inspection_machine_id=$this->input->post('qa_insp_machine');
            $root_cause_submission_id=$this->input->post();
            $inspectby_user_id=$this->input->post('inspect_by');
            $time_start=$this->input->post('time_start');
            $time_end=$this->input->post('time_end');
            $result=$this->input->post('rc_result');
       
            // $root_cause_failure_id = $this->Function_rootcausefailure->saveRootCauseRecords($machine_breakdown_id,$root_cause,$corrective_action,$rcfa_pic_user_id,$rcfa_ack_user_id,$rcfa_appr_user_id);	
            // $root_cause_submission_id = $this->Function_rootcausefailure->saveSubmissionRecords($root_cause_failure_id,$completion_user_id,$completion_datetime);
            // $this->Function_rootcausefailure->saveItemInspectionRecords($root_cause_submission_id,$inspection_machine_id,$inspectby_user_id,$time_start,$time_end,$result);
            $mc_row = $this->Function_rootcausefailure->getInspectionMachine();
            
            foreach($mc_row as $row => $rowvalue){
                $mcid[] = $rowvalue->id;
            }

            for($j = 1; $j < count($root_cause); $j++){
                $data = array(
                    'machine_breakdown_id' => $machine_breakdown_id,
                    'root_cause' => $root_cause[$j][0],
                    'corrective_action' => $corrective_action[$j][0],
                    'rcfa_pic_user_id' => $rcfa_pic_user_id,
                    'rcfa_ack_user_id' => $rcfa_ack_user_id,
                    'rcfa_appr_user_id' => $rcfa_appr_user_id[$j][0]
                    );
                    
                $root_cause_failure_id = $this->Function_rootcausefailure->saveRootCauseRecords($data);

                $current_datetime=date("Y-m-d H:i:s");
                $data = array(
                    'root_cause_failure_id' => $root_cause_failure_id,
                    'completion_user_id' => $completion_user_id,
                    'completion_datetime' => $current_datetime,
                    'submission_no' => $j
                    );
                $submission_id_list = $this->Function_rootcausefailure->saveSubmissionRecords($data);

                foreach($inspection_machine_id[$j] as $tick_id => $data_array)
                {
                    if(in_array($tick_id,$mcid))
                    {
                        $data = array(
                            'inspection_machine_id' => $tick_id,
                            'root_cause_submission_id' => $submission_id_list,
                            'inspectby_user_id' => $inspectby_user_id[$j][$tick_id],
                            'time_start' => $time_start[$j][$tick_id],
                            'time_end' => $time_end[$j][$tick_id],
                            'result' => $result[$j][$tick_id]
                            );
                    }

                    $this->Function_rootcausefailure->saveItemInspectionRecords($data);
                }
                
            }
            
            






            
            // foreach($mcid as $row => $rowvalue){
            //     $i = $rowvalue->id;
                
            //     for($j = 0; $j < count($inspectby_user_id[$i]); $j++){
            //         if(!isset($inspectby_user_id[$i])) continue;
            //         $data = array(
            //             'inspection_machine_id' => $i,
            //             'root_cause_submission_id' => $submission_id_list[$j],
            //             'inspectby_user_id' => $inspectby_user_id[$i][$j],
            //             'time_start' => $time_start[$i][$j],
            //             'time_end' => $time_end[$i][$j],
            //             'result' => $result[$i][$j]
            //             );
            //             $this->Function_rootcausefailure->saveItemInspectionRecords($data);

            //             // print_r($data);
            //             // echo $j.'<h1>test</h1>'.$submission_id_list[$j].'@'.count($inspectby_user_id[$i]);
            //     }
                
            // }
            // exit;

            echo "Records Saved Successfully";
            $result['machine_breakdown_id']=$machine_breakdown_id;
            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successrootcausefailure');

        }

        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['rcfa_approved_by']=$this->Function_rootcausefailure->getAppRootCauseQADepart();
        $result['rcfa_ack_by_eng']=$this->Function_rootcausefailure->getAckRootCauseEngDepart();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();
        $this->load->view('FrontEnd/QAN/rootcausefailureform',$result);
        $this->footer();
    }

    public function ViewRootCauseFailure(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listrootcausefailurebyeng',$result);
        $this->footer();
    }

    public function ViewRootCauseFailureRecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['user'][$machinedata->qa_reinsp_verification_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->qa_reinsp_verification_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata){
            $result['user'][$rootcausedata->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_pic_user_id);
            $result['user'][$rootcausedata->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_ack_user_id);
            $result['user'][$rootcausedata->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->completion_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        // print_r($root_cause_submission_id);
        // print_r($this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id));
        
        $result['inspdata']=@$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();

        // print_r($result['inspdata']);
        // print_r($result['inspection_machine']);
        // print_r($result['submissionlist']);



        // exit;
        $result['models']=$this->Function_machinebreakdown->getAllModels();
        $result['group']=$this->Function_machinebreakdown->getAllProcessName();
        $result['detected_by']=$this->Function_machinebreakdown->getDetectedByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewrootcausefailurerecords',$result);
        $this->footer($this->data);

    }

    public function viewlistmrbform($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listmrbform']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['listmrbform'] as $machinedata){
            $result['totalquantity']+= $machinedata->quantity;
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        
        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();
        $this->load->view('FrontEnd/QAN/viewmaterialreviewboard_onclick',$result);
        $this->footer();
    }

        public function viewrootcauserecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listmrbform']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['listmrbform'] as $rootcausedata){
            $result['totalquantity']+= $rootcausedata->quantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$rootcausedata->issueto_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueto_user);
            $result['user'][$rootcausedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueby_user_id);
            $result['user'][$rootcausedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->detectedby_user);
            $result['user'][$rootcausedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_eng_user);
            $result['user'][$rootcausedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_prod_user);
            $result['user'][$rootcausedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_qa_user);
            $result['user'][$rootcausedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->reportby_user_id);
            $result['partname'][$rootcausedata->part_name] = $this->Function_materialreviewboard->getPartNameById($rootcausedata->part_name);
            $result['procees'][$rootcausedata->process] = $this->Function_materialreviewboard->getProcessById($rootcausedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata1){
            $result['user'][$rootcausedata1->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_pic_user_id);
            $result['user'][$rootcausedata1->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_ack_user_id);
            $result['user'][$rootcausedata1->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->completion_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        // print_r($root_cause_submission_id);
        // print_r($this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id));
        
        $result['inspdata']=$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();

        // print_r($result['inspdata']);
        // print_r($result['inspection_machine']);
        // print_r($result['submissionlist']);



        // exit;
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewrootcauserecords',$result);
        $this->footer();

    }

    // public function updaterootcause($machine_breakdown_id){
        
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "View Root Cause Failure Records";
    //     $this->data['description'] = "Overview";
    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);
    //     $this->footer();

    //     if($this->input->post('update')) {
    //         $this->session->userdata['logged_in']['id'];

    //         // print_r($_POST);
    //         // exit;

    //         $root_cause=$this->input->post('root_cause');
    //         $corrective_action=$this->input->post('corrective_action');
    //         $rcfa_pic_user_id=$this->session->userdata['logged_in']['id'];
    //         $rcfa_ack_user_id=$this->session->userdata['logged_in']['id'];
    //         $rcfa_appr_user_id=$this->input->post('rcfa_approved_by');

    //         $completion_user_id=$this->session->userdata['logged_in']['id'];

    //         $inspection_machine_id=$this->input->post('qa_insp_machine');
    //         $inspectby_user_id=$this->input->post('inspect_by');
    //         $time_start=$this->input->post('time_start');
    //         $time_end=$this->input->post('time_end');
    //         $result=$this->input->post('rc_result');

    //         $rcsubjoinresult = $this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);
            
    //         foreach($rcsubjoinresult as $index => $data){
    //             $root_cause_submission_id[] = $data->submission_id;
    //         }

    //         $this->Function_rootcausefailure->deleterootcauseinspection($root_cause_submission_id);
    //         $this->Function_rootcausefailure->deleterootcausesubmission($machine_breakdown_id);
    //         exit;
    //         $mc_row = $this->Function_rootcausefailure->getInspectionMachine();
            
    //         foreach($mc_row as $row => $rowvalue){
    //             $mcid[] = $rowvalue->id;
    //         }

    //         for($j = 1; $j < count($root_cause); $j++){
    //             $data = array(
    //                 'machine_breakdown_id' => $machine_breakdown_id,
    //                 'root_cause' => $root_cause[$j][0],
    //                 'corrective_action' => $corrective_action[$j][0],
    //                 'rcfa_pic_user_id' => $rcfa_pic_user_id,
    //                 'rcfa_ack_user_id' => $rcfa_ack_user_id,
    //                 'rcfa_appr_user_id' => $rcfa_appr_user_id[$j][0]
    //                 );
                    
    //             $this->Function_rootcausefailure->updateRootCauseRecords($data);

    //             $current_datetime=date("Y-m-d H:i:s");
    //             $data = array(
    //                 // 'root_cause_failure_id' => $root_cause_failure_id,
    //                 'completion_user_id' => $completion_user_id,
    //                 'completion_datetime' => $current_datetime,
    //                 'submission_no' => $j
    //                 );
    //             $this->Function_rootcausefailure->updateSubmissionRecords($machine_breakdown_id,$data);

    //             foreach($inspection_machine_id[$j] as $tick_id => $data_array)
    //             {
    //                 if(in_array($tick_id,$mcid))
    //                 {
    //                     $data = array(
    //                         'inspection_machine_id' => $tick_id,
    //                         'root_cause_submission_id' => $submission_id_list,
    //                         'inspectby_user_id' => $inspectby_user_id[$j][$tick_id],
    //                         'time_start' => $time_start[$j][$tick_id],
    //                         'time_end' => $time_end[$j][$tick_id],
    //                         'result' => $result[$j][$tick_id]
    //                         );
    //                 }

    //                 $this->Function_rootcausefailure->updateItemInspectionRecords($data);
    //             }
                
    //         }

            
    //         $result['machine_breakdown_id']=$machine_breakdown_id;
            
    //         $result['totalquantity']=0;
    //         foreach($result['data'] as $machinedata){
    //         $result['totalquantity']+= $machinedata->quantity;
    //         // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
    //         $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
    //         $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
    //         $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
    //         $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
    //         $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
    //         $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
    //         $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
    //         $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
    //         $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
    //     }

    //         $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
    //         redirect('/successrootcausefailure');
    //     }

    // }

    // public function updaterootcause($machine_breakdown_id){
        
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "View Root Cause Failure Records";
    //     $this->data['description'] = "Overview";
    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);
    //     $this->footer();

    //     if($this->input->post('update')) {
    //         $this->session->userdata['logged_in']['id'];

    //         // print_r($_POST);
    //         // exit;

    //         $root_cause=$this->input->post('root_cause');
    //         $corrective_action=$this->input->post('corrective_action');
    //         $rcfa_pic_user_id=$this->session->userdata['logged_in']['id'];
    //         $rcfa_ack_user_id=$this->session->userdata['logged_in']['id'];
    //         $rcfa_appr_user_id=$this->input->post('rcfa_approved_by');

    //         $completion_user_id=$this->session->userdata['logged_in']['id'];

    //         $inspection_machine_id=$this->input->post('qa_insp_machine');
    //         $inspectby_user_id=$this->input->post('inspect_by');
    //         $time_start=$this->input->post('time_start');
    //         $time_end=$this->input->post('time_end');
    //         $result=$this->input->post('rc_result');

    //         // $rcsubjoinresult = $this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);
            
    //         // foreach($rcsubjoinresult as $index => $data){
    //         //     $root_cause_submission_id[] = $data->submission_id;
    //         // }

    //         // $this->Function_rootcausefailure->deleterootcauseinspection($root_cause_submission_id);
    //         // $this->Function_rootcausefailure->deleterootcausesubmission($machine_breakdown_id);
            
    //         for($j = 1; $j < count($root_cause); $j++){
    //             $data = array(
    //                 'machine_breakdown_id' => $machine_breakdown_id,
    //                 'root_cause' => $root_cause[$j][0],
    //                 'corrective_action' => $corrective_action[$j][0],
    //                 'rcfa_pic_user_id' => $rcfa_pic_user_id,
    //                 'rcfa_ack_user_id' => $rcfa_ack_user_id,
    //                 'rcfa_appr_user_id' => $rcfa_appr_user_id[$j][0]
    //             );
                
    //         $current_datetime=date("Y-m-d H:i:s");
    //         $data2 = array(
    //             array(
    //                 'root_cause_failure_id' => $root_cause_failure_id,
    //                 'completion_user_id' => $completion_user_id,
    //                 'completion_datetime' => $current_datetime,
    //                 'submission_no' => $j,
                
    //             'inspection_data' = array(
    //                 array(
    //                     'inspection_machine_id' => $tick_id,
    //                     'root_cause_submission_id' => $submission_id_list,
    //                     'inspectby_user_id' => $inspectby_user_id[$j][$tick_id],
    //                     'time_start' => $time_start[$j][$tick_id],
    //                     'time_end' => $time_end[$j][$tick_id],
    //                     'result' => $result[$j][$tick_id]
    //                 )

    //             )
                
                
    //         );
    //     }



    //         $mc_row = $this->Function_rootcausefailure->getInspectionMachine();
            
    //         foreach($mc_row as $row => $rowvalue){
    //             $mcid[] = $rowvalue->id;
    //         }

    //         for($j = 1; $j < count($root_cause); $j++){
    //             $data = array(
    //                 'machine_breakdown_id' => $machine_breakdown_id,
    //                 'root_cause' => $root_cause[$j][0],
    //                 'corrective_action' => $corrective_action[$j][0],
    //                 'rcfa_pic_user_id' => $rcfa_pic_user_id,
    //                 'rcfa_ack_user_id' => $rcfa_ack_user_id,
    //                 'rcfa_appr_user_id' => $rcfa_appr_user_id[$j][0]
    //                 );
                    
    //             $this->Function_rootcausefailure->updateRootCauseRecords($data);

    //             $current_datetime=date("Y-m-d H:i:s");
    //             $data = array(
    //                 // 'root_cause_failure_id' => $root_cause_failure_id,
    //                 'completion_user_id' => $completion_user_id,
    //                 'completion_datetime' => $current_datetime,
    //                 'submission_no' => $j
    //                 );
    //             $this->Function_rootcausefailure->updateSubmissionRecords($root_cause_failure_id,$data);

    //             foreach($inspection_machine_id[$j] as $tick_id => $data_array)
    //             {
    //                 if(in_array($tick_id,$mcid))
    //                 {
    //                     $data = array(
    //                         'inspection_machine_id' => $tick_id,
    //                         // 'root_cause_submission_id' => $submission_id_list,
    //                         'inspectby_user_id' => $inspectby_user_id[$j][$tick_id],
    //                         'time_start' => $time_start[$j][$tick_id],
    //                         'time_end' => $time_end[$j][$tick_id],
    //                         'result' => $result[$j][$tick_id]
    //                         );
    //                 }

    //                 $this->Function_rootcausefailure->updateItemInspectionRecords($root_cause_submission_id,$data);
    //             }
                
    //         }

            
    //         $result['machine_breakdown_id']=$machine_breakdown_id;
            
    //         $result['totalquantity']=0;
    //         foreach($result['data'] as $machinedata){
    //         $result['totalquantity']+= $machinedata->quantity;
    //         $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
    //         $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
    //         $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
    //         $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
    //         $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
    //         $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
    //         $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
    //         $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
    //         $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
    //     }

    //         $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
    //         redirect('/successrootcausefailure');
    //     }

    // }

    public function addnewsubmission($machine_breakdown_id = '') {
        
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Root Cause Failure Analysis Form";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata){
            $result['user'][$rootcausedata->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_pic_user_id);
            $result['user'][$rootcausedata->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_ack_user_id);
            $result['user'][$rootcausedata->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->completion_user_id);
        }
        
        // foreach($result['submissionlist'] as $index => $data){
        //     $root_cause_submission_id[] = $data->submission_id;
        // }
    
        $result['inspdata']=@$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();


        $rcsubjoinresult = $this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);
            
        foreach($rcsubjoinresult as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }

        $total_sub = count($root_cause_submission_id);
        
        
        //Check submit button 
        if($this->input->post('submit')) {
            $this->session->userdata['logged_in']['id'];

          
            // print_r($_POST);
            // exit;
            
            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $root_cause=$this->input->post('root_cause');
            $corrective_action=$this->input->post('corrective_action');
            $rcfa_pic_user_id=$this->session->userdata['logged_in']['id'];
            $rcfa_ack_user_id=$this->session->userdata['logged_in']['id'];
            $rcfa_appr_user_id=$this->input->post('rcfa_approved_by');

            $root_cause_failure_id=$this->input->post();
            $completion_user_id=$this->session->userdata['logged_in']['id'];

            $inspection_machine_id=$this->input->post('qa_insp_machine');
            $root_cause_submission_id=$this->input->post();
            $inspectby_user_id=$this->input->post('inspect_by');
            $time_start=$this->input->post('time_start');
            $time_end=$this->input->post('time_end');
            $result=$this->input->post('rc_result');

            $mc_row = $this->Function_rootcausefailure->getInspectionMachine();
            
            foreach($mc_row as $row => $rowvalue){
                $mcid[] = $rowvalue->id;
            }
            
            for($j = 1; $j < count($root_cause); $j++){
               
                if($j<=$total_sub) continue;
                
                $data = array(
                    'machine_breakdown_id' => $machine_breakdown_id,
                    'root_cause' => $root_cause[$j][0],
                    'corrective_action' => $corrective_action[$j][0],
                    'rcfa_pic_user_id' => $rcfa_pic_user_id,
                    'rcfa_ack_user_id' => $rcfa_ack_user_id,
                    'rcfa_appr_user_id' => $rcfa_appr_user_id[$j][0]
                    );
                    
                $root_cause_failure_id = $this->Function_rootcausefailure->saveRootCauseRecords($data);

                $current_datetime=date("Y-m-d H:i:s");
                $data = array(
                    'root_cause_failure_id' => $root_cause_failure_id,
                    'completion_user_id' => $completion_user_id,
                    'completion_datetime' => $current_datetime,
                    'submission_no' => $j
                    );
                $submission_id_list = $this->Function_rootcausefailure->saveSubmissionRecords($data);

                foreach($inspection_machine_id[$j] as $tick_id => $data_array)
                {
                    if(in_array($tick_id,$mcid))
                    {
                        $data = array(
                            'inspection_machine_id' => $tick_id,
                            'root_cause_submission_id' => $submission_id_list,
                            'inspectby_user_id' => $inspectby_user_id[$j][$tick_id],
                            'time_start' => $time_start[$j][$tick_id],
                            'time_end' => $time_end[$j][$tick_id],
                            'result' => $result[$j][$tick_id]
                            );
                    }

                    $this->Function_rootcausefailure->saveItemInspectionRecords($data);
                }
                
            }
         
            echo "Records Saved Successfully";
            $result['machine_breakdown_id']=$machine_breakdown_id;
            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successrootcausefailure');

        }
        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['rcfa_approved_by']=$this->Function_rootcausefailure->getAppRootCauseQADepart();
        $result['rcfa_ack_by_eng']=$this->Function_rootcausefailure->getAckRootCauseEngDepart();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $this->load->view('FrontEnd/QAN/viewrootcausefailurerecords',$result);
        $this->footer($this->data);

    }

    public function successrootcausefailure(){

        
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";
 
        // Start controller code here
 
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->data['machine_breakdown_id'] = $this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/QAN/successrootcausefailure', $this->data);
        $this->footer();
    }


    // public function qareviewform() {
    //     // Active Header, must include in every public function
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "Final QA Review Form";
    //     $this->data['description'] = "Overview";

    //     // Start controller code here

    //     // Load View
    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);
    //     $this->load->view('FrontEnd/QAN/qareviewform',$this->data);
    //     $this->footer();
    // }


    public function ViewForQAUseOnlyByQAEngineer($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata){
            $result['user'][$rootcausedata->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_pic_user_id);
            $result['user'][$rootcausedata->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_ack_user_id);
            $result['user'][$rootcausedata->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->completion_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        // print_r($root_cause_submission_id);
        // print_r($this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id));
        
        $result['inspdata']=@$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();

        // print_r($result['inspdata']);
        // print_r($result['inspection_machine']);
        // print_r($result['submissionlist']);



        // exit;
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $this->load->view('FrontEnd/QAN/viewforqauseonlybyqa',$result);
        $this->footer($this->data);
    }

    public function qareviewform($machine_breakdown_id = '') {
        // print_r($_POST);
        // exit;
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Material Review Board Form";
        $this->data['description'] = "Overview";

        //Check submit button 
        if($this->input->post('submit')) {
            $this->session->userdata['logged_in']['id'];

            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $approval_user_id=$this->session->userdata['logged_in']['id'];
            $machine_status=$this->input->post('machine_status');
            $machine_stop_reason=$this->input->post('machine_stop_reason');


            $this->Function_qa_review->saveForQAOnlyRecords($machine_breakdown_id,$approval_user_id,$machine_status,$machine_stop_reason);	
            
            
        echo "Records Saved Successfully";
        
        $result['qa_sample_total']=$this->Function_materialreviewboard->getTotalQASample($machine_breakdown_id);
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
        redirect('/successforqaonly');
        
		}
        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $this->load->view('FrontEnd/QAN/forqaonly',$result);
        $this->footer();
    }

    public function viewlistrootcauseform($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listrootcauseform']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['listrootcauseform'] as $rootcausedata){
            $result['totalquantity']+= $rootcausedata->quantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$rootcausedata->issueto_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueto_user);
            $result['user'][$rootcausedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueby_user_id);
            $result['user'][$rootcausedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->detectedby_user);
            $result['user'][$rootcausedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_eng_user);
            $result['user'][$rootcausedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_prod_user);
            $result['user'][$rootcausedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_qa_user);
            $result['user'][$rootcausedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->reportby_user_id);
            $result['partname'][$rootcausedata->part_name] = $this->Function_materialreviewboard->getPartNameById($rootcausedata->part_name);
            $result['procees'][$rootcausedata->process] = $this->Function_materialreviewboard->getProcessById($rootcausedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata1){
            $result['user'][$rootcausedata1->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_pic_user_id);
            $result['user'][$rootcausedata1->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_ack_user_id);
            $result['user'][$rootcausedata1->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->completion_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        // print_r($root_cause_submission_id);
        // print_r($this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id));
        
        $result['inspdata']=$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();

        // print_r($result['inspdata']);
        // print_r($result['inspection_machine']);
        // print_r($result['submissionlist']);



        // exit;
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewrootcausefailure_onclick',$result);
        $this->footer();

    }

    public function ViewForQAUseOnly(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listforqauseonlybyqa',$result);
        $this->footer();
    }

    public function ViewForQAUseOnlyRecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata){
            $result['user'][$rootcausedata->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_pic_user_id);
            $result['user'][$rootcausedata->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_ack_user_id);
            $result['user'][$rootcausedata->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->completion_user_id);
            $result['user'][$rootcausedata->rcfa_appr_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_appr_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        $result['machineinfo']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);

        foreach($result['machineinfo'] as $qaforonly){
            $result['user'][$qaforonly->approval_user_id] = $this->Function_materialreviewboard->getUserById($qaforonly->approval_user_id);
        }

        
        $result['inspdata']=@$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();


        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewforqauseonlyrecords',$result);
        $this->footer();

    }

    public function viewforqaonlyrecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listrootcauseform']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['listrootcauseform'] as $rootcausedata){
            $result['totalquantity']+= $rootcausedata->quantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$rootcausedata->issueto_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueto_user);
            $result['user'][$rootcausedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueby_user_id);
            $result['user'][$rootcausedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->detectedby_user);
            $result['user'][$rootcausedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_eng_user);
            $result['user'][$rootcausedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_prod_user);
            $result['user'][$rootcausedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_qa_user);
            $result['user'][$rootcausedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->reportby_user_id);
            $result['partname'][$rootcausedata->part_name] = $this->Function_materialreviewboard->getPartNameById($rootcausedata->part_name);
            $result['procees'][$rootcausedata->process] = $this->Function_materialreviewboard->getProcessById($rootcausedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata1){
            $result['user'][$rootcausedata1->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_pic_user_id);
            $result['user'][$rootcausedata1->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_ack_user_id);
            $result['user'][$rootcausedata1->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->completion_user_id);
            $result['user'][$rootcausedata1->rcfa_appr_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_appr_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        $result['machineinfo']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);

        foreach($result['machineinfo'] as $qaforonly){
            $result['user'][$qaforonly->approval_user_id] = $this->Function_materialreviewboard->getUserById($qaforonly->approval_user_id);
        }

        
        $result['inspdata']=$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();


        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewforqaonlyrecords',$result);
        $this->footer();

    }

    public function updateforqaonly($machine_breakdown_id){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Material Review Board Records";
        $this->data['description'] = "Overview";
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->footer();

        if($this->input->post('update')) {
            $this->session->userdata['logged_in']['id'];

            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $approval_user_id=$this->session->userdata['logged_in']['id'];
            $machine_status=$this->input->post('machine_status');
            $machine_stop_reason=$this->input->post('machine_stop_reason');

            $this->Function_qa_review->saveForQAOnlyRecords($machine_breakdown_id,$approval_user_id,$machine_status,$machine_stop_reason);	

            echo "Records Saved Successfully";
        
            $result['qa_sample_total']=$this->Function_materialreviewboard->getTotalQASample($machine_breakdown_id);
            $result['machine_breakdown_id']=$machine_breakdown_id;
            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successforqaonly');
            
        }
    }

    public function successforqaonly(){

        
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";
 
        // Start controller code here
 
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->data['machine_breakdown_id'] = $this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/QAN/successforqaonly', $this->data);
        $this->footer();
    }

    public function ViewFinalReviewByQAEngineer($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['user'][$machinedata->qa_reinsp_verification_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->qa_reinsp_verification_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata){
            $result['user'][$rootcausedata->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_pic_user_id);
            $result['user'][$rootcausedata->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_ack_user_id);
            $result['user'][$rootcausedata->rcfa_appr_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_appr_user_id);
            $result['user'][$rootcausedata->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->completion_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }

        
        $result['inspdata']=@$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);
        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $this->load->view('FrontEnd/QAN/viewfinalreviewbyqaengineer',$result);
        $this->footer();
    }

    public function reviewbyqaform($machine_breakdown_id = '') {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "Material Review Board Form";
        $this->data['description'] = "Overview";

        //Check submit button 
        if($this->input->post('submit')) {
            $this->session->userdata['logged_in']['id'];

            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $purge_status=$this->input->post('purging_completed');
            $notify_next_process=$this->input->post('notify_next');
            $fix_validation_result=$this->input->post('validation_result');
            $closedby_user_id=$this->session->userdata['logged_in']['id'];


            $this->Function_qa_review->saveReviewByQARecords($machine_breakdown_id,$purge_status,$notify_next_process,$fix_validation_result,$closedby_user_id);	
            
            
        echo "Records Saved Successfully";
        
        $result['qa_sample_total']=$this->Function_materialreviewboard->getTotalQASample($machine_breakdown_id);
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
        redirect('/successforqaonly');
        
		}
        
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $this->load->view('FrontEnd/QAN/reviewvyqaform',$result);
        $this->footer();
    }


    public function viewlistforqaonlyform($machine_breakdown_id=0){

        	
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
    
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listforqaonlyform']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);
        $result['totalquantity']=0;
        foreach($result['listforqaonlyform'] as $machinedata){
            $result['totalquantity']+= $machinedata->quantity;
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['user'][$machinedata->approval_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->approval_user_id);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata1){
            $result['user'][$rootcausedata1->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_pic_user_id);
            $result['user'][$rootcausedata1->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_ack_user_id);
            $result['user'][$rootcausedata1->rcfa_appr_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_appr_user_id);
            $result['user'][$rootcausedata1->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->completion_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
     
        $result['inspdata']=$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);
        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();

        $this->load->view('FrontEnd/QAN/viewrforqaonly_onclick',$result);
        $this->footer();
    }

    public function ViewFinalReview(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['data']=$this->Function_machinebreakdown->displayListNewStatusForm();
        $this->load->view('FrontEnd/QAN/listfinalreviewbyqa',$result);
        $this->footer();
    }

    public function ViewFinalReviewRecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['data']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['data'] as $machinedata){
            $result['totalquantity']+= $machinedata->samplequantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$machinedata->issueto_user] = $this->Function_materialreviewboard->getUserById($machinedata->issueto_user);
            $result['user'][$machinedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->issueby_user_id);
            $result['user'][$machinedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($machinedata->detectedby_user);
            $result['user'][$machinedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_eng_user);
            $result['user'][$machinedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_prod_user);
            $result['user'][$machinedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($machinedata->ack_qa_user);
            $result['user'][$machinedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->reportby_user_id);
            $result['user'][$machinedata->qa_reinsp_verification_user_id] = $this->Function_materialreviewboard->getUserById($machinedata->qa_reinsp_verification_user_id);
            $result['partname'][$machinedata->part_name] = $this->Function_materialreviewboard->getPartNameById($machinedata->part_name);
            $result['procees'][$machinedata->process] = $this->Function_materialreviewboard->getProcessById($machinedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata){
            $result['user'][$rootcausedata->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_pic_user_id);
            $result['user'][$rootcausedata->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_ack_user_id);
            $result['user'][$rootcausedata->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->completion_user_id);
            $result['user'][$rootcausedata->rcfa_appr_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->rcfa_appr_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
    
        $result['machineinfo']=$this->Function_machinebreakdown->viewmachinerecords($machine_breakdown_id);

        foreach($result['machineinfo'] as $qaforonly){
            $result['user'][$qaforonly->approval_user_id] = $this->Function_materialreviewboard->getUserById($qaforonly->approval_user_id);
        }

        
        $result['inspdata']=@$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();


        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();
        // print_r($result);
        // exit;
        $this->load->view('FrontEnd/QAN/viewfinalreviewrecords',$result);
        $this->footer();

    }

    public function viewreviewbyqarecords($machine_breakdown_id = ''){

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";


        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['machine_breakdown_id']=$machine_breakdown_id;
        $result['listforqaonlyform']=$this->Function_materialreviewboard->viewmaterialreviewboardrecords($machine_breakdown_id);

        $result['totalquantity']=0;
        foreach($result['listforqaonlyform'] as $rootcausedata){
            $result['totalquantity']+= $rootcausedata->quantity;
            // $result['user'][$mrbdata->prod_pic_user_id] = $this->Function_materialreviewboard->getUserById($mrbdata->prod_pic_user_id);
            $result['user'][$rootcausedata->issueto_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueto_user);
            $result['user'][$rootcausedata->issueby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->issueby_user_id);
            $result['user'][$rootcausedata->detectedby_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->detectedby_user);
            $result['user'][$rootcausedata->ack_eng_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_eng_user);
            $result['user'][$rootcausedata->ack_prod_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_prod_user);
            $result['user'][$rootcausedata->ack_qa_user] = $this->Function_materialreviewboard->getUserById($rootcausedata->ack_qa_user);
            $result['user'][$rootcausedata->reportby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->reportby_user_id);
            $result['user'][$rootcausedata->closedby_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata->closedby_user_id);
            $result['partname'][$rootcausedata->part_name] = $this->Function_materialreviewboard->getPartNameById($rootcausedata->part_name);
            $result['procees'][$rootcausedata->process] = $this->Function_materialreviewboard->getProcessById($rootcausedata->process);
        }
        

        $result['submissionlist']=$this->Function_rootcausefailure->viewrootcausesubmission($machine_breakdown_id);

        foreach($result['submissionlist'] as $rootcausedata1){
            $result['user'][$rootcausedata1->rcfa_pic_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_pic_user_id);
            $result['user'][$rootcausedata1->rcfa_ack_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_ack_user_id);
            $result['user'][$rootcausedata1->completion_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->completion_user_id);
            $result['user'][$rootcausedata1->rcfa_appr_user_id] = $this->Function_materialreviewboard->getUserById($rootcausedata1->rcfa_appr_user_id);
        }
        
        foreach($result['submissionlist'] as $index => $data){
            $root_cause_submission_id[] = $data->submission_id;
        }
        
        $result['inspdata']=$this->Function_rootcausefailure->viewrootcauseinspection($root_cause_submission_id);

        $result['inspection_machine']=$this->Function_rootcausefailure->getInspectionMachine();
        $result['inspect_by']=$this->Function_rootcausefailure->getInspectByQADepart();


        $result['qa_sample_loc']=$this->Function_machinebreakdown->getQASampleLocation();
        $result['prod_loc']=$this->Function_machinebreakdown->getProdLocation();
        $result['loc_to_purge']=$this->Function_materialreviewboard->getPurgeLocation();

        $this->load->view('FrontEnd/QAN/viewreviewbyqarecords',$result);
        $this->footer();

    }

    public function updatereviewbyqa($machine_breakdown_id){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Material Review Board Records";
        $this->data['description'] = "Overview";
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->footer();

        if($this->input->post('update')) {
            $this->session->userdata['logged_in']['id'];

            $machine_breakdown_id=$this->input->post('machine_breakdown_id'); 
            $purge_status=$this->input->post('purging_completed');
            $notify_next_process=$this->input->post('notify_next');
            $fix_validation_result=$this->input->post('validation_result');
            $closedby_user_id=$this->session->userdata['logged_in']['id'];

            $this->Function_qa_review->saveReviewByQARecords($machine_breakdown_id,$purge_status,$notify_next_process,$fix_validation_result,$closedby_user_id);	

            echo "Records Saved Successfully";
        
            $result['qa_sample_total']=$this->Function_materialreviewboard->getTotalQASample($machine_breakdown_id);
            $result['machine_breakdown_id']=$machine_breakdown_id;
            $this->session->set_userdata('last_created_machine_id', $machine_breakdown_id);
            redirect('/successreviewbyqa');
            
        }
    }

    public function successreviewbyqa(){

        
        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View Machine Breakdown Records";
        $this->data['description'] = "Overview";
 
        // Start controller code here
 
        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $this->data['machine_breakdown_id'] = $this->session->userdata('last_created_machine_id');
        $this->load->view('FrontEnd/QAN/successreviewbyqa', $this->data);
        $this->footer();
    }


    // public function register() {

        
    //     // Active Header, must include in every public function
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "User Registration Form";
    //     $this->data['description'] = "Overview";
    //     $this->data['jsselect'] = TRUE;
    //     // Start controller code here

    //     // Load View
    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);
    //     $result['role']=$this->Function_users->getUserRole();
    //     $result['department']=$this->Function_users->getDepartment();
    //     $this->load->view('FrontEnd/register',$result);
    //     $this->footer($this->data);
    // }

    public function register() {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        //Check submit button 
        if($this->input->post('submit')) {
           

		    //get form's data and store in local varable
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $email=$this->input->post('email');
            $fullname=$this->input->post('fullname');
            $commodity=$this->input->post('commodity');
            $dept_id=$this->input->post('dept_id');
            $title=$this->input->post('title');
            $employee_no=$this->input->post('employee_no');        
            $role_id=$this->input->post('role_id');         
            $created_date=$this->input->post('created_date'); 
            $modified_date=$this->input->post('modified_date');
            $is_deleted=$this->input->post('is_deleted');

            
          
        //call saverecords method of Login_Database and pass variables as parameter
        $user_id = $this->login_database->saveUserRegistration($username,$password,$email,$fullname,$commodity,$dept_id,$title,$employee_no,$created_date,$modified_date,$is_deleted);	
        // $this->Login_Database->saveUserRole($user_id,$role_id);
        // echo $user_id;
        $this->login_database->saveUserRole($user_id,$role_id);

        echo "Records Saved Successfully";
        redirect('/viewuserinfo');
        
        }
        
        $result['roles']=$this->Function_users->GetRoleDropdown();
        $result['department']=$this->Function_users->getDepartment();
        $this->load->view('FrontEnd/register',$result);
        $this->footer($this->data);
    }

    public function viewuserinfo($user_id = ''){

	    // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View User Details";
        $this->data['description'] = "Overview";

        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        $result['user_id']=$user_id;
        $result['data']=$this->Function_users->viewuserrecords($user_id);
        // print_r($user_id);
        // exit;
        $this->load->view('FrontEnd/QAN/viewuserinfo',$result);
        $this->footer();
    }
    
    public function updateduserinfo(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View User Details";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $id=$this->input->get('id');
        $result['data']=$this->Function_users->displayrecordsById($id);
        $result['roles']=$this->Function_users->getRoleFromDB($id);
        $result['department']=$this->Function_users->getDepartment();
        $this->load->view('FrontEnd/QAN/viewuserrecords',$result);	
        
            if($this->input->post('update'))
            {
                $username=$this->input->post('username');
                $password=$this->input->post('password');
                $email=$this->input->post('email');
                $fullname=$this->input->post('fullname');
                $commodity=$this->input->post('commodity');
                $dept_id=$this->input->post('dept_id');
                $title=$this->input->post('title');
                $employee_no=$this->input->post('employee_no');
                $role_id=$this->input->post('role_id');
                $created_date=$this->input->post('created_date');
                $modified_date=$this->input->post('modified_date');
                $is_deleted=$this->input->post('is_deleted');
                // $role_group_id=$this->input->post('role_group_id');
                $this->Function_users->updaterecords($id,$username,$password,$email,$fullname,$commodity,$dept_id,$title,$employee_no,$role_id,$created_date,$modified_date,$is_deleted);
                redirect("FrontEnd/viewuserinfo");
            }
        
            $this->footer($this->data);
    }

    public function AddPermision() {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        //Check submit button 
        if($this->input->post('submit')) {

            // print_r($_POST);
            // exit; 
            $role_ids=$this->input->post('role_id');
            $section_ids=$this->input->post('section_id');

            foreach($role_ids as $role_id => $on){

                foreach($section_ids[$role_id] as $section_id){
            
                
                    $data = array(
                        'role_id' => $role_id,
                        'section_id' => $section_id
                    );
                //         print_r($_POST);
                // exit;
                        $this->Function_users->savePermission($data);
                    
                }	
            }
        
            $role_ids=$this->input->post('role_id');
            $role_names=$this->input->post('role_name');
    
            foreach($role_ids as $role_id => $on){

                $data = array(
                    'name' => $role_names[$role_id]
                );
                //         print_r($_POST);
                // exit;
                $this->Function_users->updatePermissionRecords($role_id,$data);
                    
            }	
        }
        

        $roles_sections = $this->Function_users->GetRoleSection();
        $temp_role_section = array();
        foreach($roles_sections as $role_section){
            $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
            $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
            $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;
        }
        $result['roles_sections'] = $temp_role_section;
        $result['sections']=$this->Function_users->getSectionsDropdown();

        
        $this->load->view('FrontEnd/QAN/viewandaddnewroles',$result);
        $this->footer($this->data);
    }

    public function AddRolePermission() {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        //Check submit button 
        if($this->input->post('submit')) {

            //  print_r($_POST);
            //  exit; 

            $data = array();
            $view_permission = @$this->input->post('see');
            $data_entry_permission = @$this->input->post('de');
            $acknowledger_permission = @$this->input->post('ack');
            $approval_permission = @$this->input->post('app');

            if(is_array($view_permission))
            foreach($view_permission as $role_id => $permission){
                foreach($permission as $section_id => $on)
                {
                    $data[$role_id][$section_id]['view_permission'] = 1;
                }
            }

            if(is_array($data_entry_permission))
            foreach($data_entry_permission as $role_id => $permission){
                foreach($permission as $section_id => $on)
                {
                    $data[$role_id][$section_id]['data_entry_permission'] = 1;
                }
            }

            if(is_array($acknowledger_permission))
            foreach($acknowledger_permission as $role_id => $permission){
                foreach($permission as $section_id => $on)
                {
                    $data[$role_id][$section_id]['acknowledger_permission'] = 1;
                }
            }

            if(is_array($approval_permission))
            foreach($approval_permission as $role_id => $permission){
                foreach($permission as $section_id => $on)
                {
                    $data[$role_id][$section_id]['approval_permission'] = 1;
                }
            }

            foreach($data as $to_role_id => $section_data){
                foreach($section_data as $to_section_id => $permission_data){

                        $role_id = $to_role_id;
                        $section_id = $to_section_id;
                        $view_permission = 0;
                        $data_entry_permission = 0;
                        $acknowledger_permission = 0;
                        $approval_permission = 0;

                    foreach($permission_data as $to_permission => $permission_val){
                        
                        $$to_permission = $permission_val;// double $
                    }

                    $this->Function_users->updateRolePermissionRecords($role_id,$section_id,$view_permission,$data_entry_permission,$approval_permission,$acknowledger_permission);
                                                  
                }
            }
           
        $result['sections']=$this->Function_users->getSectionsDropdown();
        $result['permission']=$this->Function_users->GetUserRolePermision();
        
        $result['roles']=$this->Function_users->GetRoleDropdown();
        $this->load->view('FrontEnd/QAN/viewrolepermission',$result);
        $this->footer($this->data);
    }
}

    public function ViewRolePermission(){

	    // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        // Start controller code here

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
        // $result['user_id']=$user_id;
        $result['permission']=$this->Function_users->GetUserRolePermision();
        $result['roles']=$this->Function_users->GetRoleDropdown();
        $this->load->view('FrontEnd/QAN/viewrolepermission',$result);
        $this->footer($this->data);
    }

    public function updateuserroles(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "View User Details";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $id=$this->input->get('id');
        $result['data']=$this->Function_users->displayuserolesById($id);
        $result['roles']=$this->Function_users->getUserRole($id);
        $result['department']=$this->Function_users->getDepartment();
        $this->load->view('FrontEnd/QAN/viewuserrecords',$result);	
        
            if($this->input->post('update'))
            {
                $username=$this->input->post('username');
                $password=$this->input->post('password');
                $email=$this->input->post('email');
                $fullname=$this->input->post('fullname');
                $commodity=$this->input->post('commodity');
                $dept_id=$this->input->post('dept_id');
                $title=$this->input->post('title');
                $employee_no=$this->input->post('employee_no');
                $role_id=$this->input->post('role_id');
                $created_date=$this->input->post('created_date');
                $modified_date=$this->input->post('modified_date');
                $is_deleted=$this->input->post('is_deleted');
                // $role_group_id=$this->input->post('role_group_id');
                $this->Function_users->updaterecords($id,$username,$password,$email,$fullname,$commodity,$dept_id,$title,$employee_no,$role_id,$created_date,$modified_date,$is_deleted);
                redirect("FrontEnd/viewuserinfo");
            }
        
            $this->footer($this->data);
    }

    public function ViewUserRole(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
     
        $roles_sections = $this->Function_users->GetRoleSection();
        $temp_role_section = array();
        foreach($roles_sections as $role_section){
            $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
            $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
            $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;
        }
        $result['roles_sections'] = $temp_role_section;
        $result['sections']=$this->Function_users->getSectionsDropdown();

        //Check submit button 
        if($this->input->post('submit')) {

            //  print_r($_POST);
            //  exit; 
            
            $role_id=$this->input->post('role_id');
            $role_name=$this->input->post('role_name');
            
        $result['message_display'] = $this->Function_users->saveAddNewRole($role_id,$role_name);	
 
        }
        
        $this->load->view('FrontEnd/QAN/viewandaddnewroles',$result);
        $this->footer($this->data);
    }

    // public function AddNewRole() {

    //     // Active Header, must include in every public function
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
    //     $this->data['description'] = "Overview";
    //     $this->data['jsselect'] = TRUE;

    //     // Load View
    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);

    //     $roles_sections = $this->Function_users->GetRoleSection();
    //     $temp_role_section = array();
    //     foreach($roles_sections as $role_section){
    //         $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
    //         $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
    //         $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;
    //     }
    //     $result['roles_sections'] = $temp_role_section;
    //     $result['sections']=$this->Function_users->getSectionsDropdown();

    //     //Check submit button 
    //     if($this->input->post('submit')) {

    //        /*  print_r($_POST);
    //         exit; */
           
    //         $role_id=$this->input->post('role_id');
    //         $role_name=$this->input->post('role_name');
        
    //     $result['message_display'] = $this->Function_users->saveAddNewRole($role_id,$role_name);		

    //     }
        
    //     $this->load->view('FrontEnd/QAN/viewandaddnewroles',$result);
    //     $this->footer($this->data);
    // }

    public function AddNewSection() {

        // Active Header, must include in every public function
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        // Load View
        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        //Check submit button 
        if($this->input->post('submit')) {

           /*  print_r($_POST);
            exit; */
           
            $section=$this->input->post('section');
            $description=$this->input->post('description');
        
        $result['message_display'] = $this->Function_users->saveAddNewRole($section,$description);		

        }
        
        $this->load->view('FrontEnd/QAN/viewsection',$result);
        $this->footer($this->data);
    }
    
	public function ViewSection(){
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        //Check submit button 
        if($this->input->post('submit')) {

            // print_r($_POST);
            // exit; 
            
            $section=$this->input->post('section');
            $description=$this->input->post('description');
         
         $result['message_display'] = $this->Function_users->saveAddNewSection($section,$description);		
 
         }

        $result['sections']=$this->Function_users->displayListSection();
        $result['sections1']=$this->Function_users->getSectionsDropdown();
        $this->load->view('FrontEnd/QAN/viewsection',$result);
        $this->footer($this->data);
    }

    // public function ViewSection(){
        
    //     $this->data['title'] = "JCY Product Quality System";
    //     $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
    //     $this->data['description'] = "Overview";
    //     $this->data['jsselect'] = TRUE;

    //     $this->header($this->data);
    //     $this->topbar($this->data);
    //     $this->leftsidebar($this->data);
    //     $this->rightsidebar($this->data);

    //     $result['section_id']=$section_id;
    //     $result['data']=$this->Function_users->ViewSectionRecords($section_id);

    //     //Check submit button 
    //     if($this->input->post('submit')) {

    //         // print_r($_POST);
    //         // exit; 
            
    //         $section=$this->input->post('section');
    //         $description=$this->input->post('description');
         
    //      $result['message_display'] = $this->Function_users->saveAddNewSection($section,$description);		
 
    //      }

    //     $result['sections']=$this->Function_users->displayListSection();
    //     $result['sections1']=$this->Function_users->getSectionsDropdown();
    //     $this->load->view('FrontEnd/QAN/viewsection',$result);
    //     $this->footer($this->data);
    // }

    public function UpdateSection(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $result['msg'] = '';
        
        if($this->input->post('update')) {

            $section_id=$this->input->post('sectionid');
            $section=$this->input->post('section');
            $description=$this->input->post('desc'); 

            foreach($section_id as $id => $on ){
                $data_update = array(
                    'section_name' => $section[$id],
                    'description' => $description[$id]
                );
                if($this->Function_users->updateSectionRecords($id,$data_update))
                {
                    $result['msg'] = 'Success!!';
                }
                else{
                    $result['msg'] = 'Not Success!!';
                }
            }
        }

        $result['sections']=$this->Function_users->displayListSection();
        $this->load->view('FrontEnd/QAN/viewsection',$result);
        $this->footer($this->data);
    }


}