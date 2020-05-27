<?php

require_once APPPATH . 'core/MY_FrontEnd.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperUser_ extends MY_FrontEnd {

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
            // $this->load->model('Function_machinebreakdown');
            $this->load->model('Function_materialreviewboard');
            $this->load->model('Function_rootcausefailure');
            // $this->load->model('Function_qa_review');
            $this->load->model('modal_master');
            $this->load->model('modal_create');
            $this->load->model('modal_update');
            $this->load->model('modal_delete');
            $this->load->model('modal_admin/admin_modal_select');
            $this->load->model('modal_superuser/superuser_modal_select');
            $this->load->model('modal_superuser/superuser_modal_update');
        
            date_default_timezone_set('Asia/Kuala_Lumpur');
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

        if(isset($_POST) or $qan_id > 0){
                
           $this->superuser_modal_select->load_qan($qan_id);
           $this->superuser_modal_select->Section1();
           $this->superuser_modal_select->Section2();
           $this->superuser_modal_select->Section3();

           $view['data'] = $this->superuser_modal_select->get_data();
            
           $view['data']->submit_button = new stdClass();

           if(@$this->session->userdata['permission']['QSU1']['de'] OR @$this->session->userdata['permission']['QSU1']['ack'] OR @$this->session->userdata['permission']['QSU1']['app'])
           { 
              $view['data']->submit_button->s1 = array();

               if((@$this->session->userdata['permission']['QSU1']['de']))
               {
                   $button_obj = new stdClass();
                   $button_obj->name = 'UPDATE';
                   $button_obj->value = 'update_section1';
                   $button_obj->action = base_url().'SuperUser/index/';
                   array_push($view['data']->submit_button->s1,$button_obj);
                
                }
                
                // if((@$this->session->userdata['permission']['S1']['ack']) and ($view['data']->status == '1' or $view['data']->status == '3'))
                // {
                //     $user_id = $this->session->userdata['logged_in']['id'];

                //     if(!($view['data']->ack_eng_user==$user_id or $view['data']->ack_prod_user==$user_id or $view['data']->ack_qa_user==$user_id ))
                //     {
                //         $button_obj = new stdClass();
                //         $button_obj->name = 'ACKNOWLEDGE';
                //         $button_obj->value = 'update_section1_ack';
                //         $button_obj->action = base_url().'FrontEnd/mastertemplate/'; //action kena sama
                //         array_push($view['data']->submit_button->s1,$button_obj);
                //     }
                // }
      
            }
                
            // $data = new stdClass(); 
            // $data->qan_id = '245';
            // $data->modified_date = '';
            // $data->issued_dept = '';
            // $data->to_dept = '';
            // $data->shift = 'Night';
            // $data->ooc = '1';
            // $data->oos = '1';

            // $data->part_name = '';
            // $data->machine_no = 'V-15';
            // $data->process = '';
            // $data->detectedby_user = '';
            // $data->defect_description_id = '';
            // $data->last_passed_sample = '';
            // $data->purge_from = '';
            // $data->estimate_qty = '';

            // $data->quantity = '';
            // $data->qa_sample_id = '';

            // $data->qasample_qty[0] = new stdClass();
            // $data->qasample_qty[0]->qa_sample_id = 1;
            // $data->qasample_qty[0]->samplequantity = 100;

            // $data->qasample_qty[1] = new stdClass();
            // $data->qasample_qty[1]->qa_sample_id = 2;
            // $data->qasample_qty[1]->samplequantity = 1;

            // $data->qasample_qty[2] = new stdClass();
            // $data->qasample_qty[2]->qa_sample_id = 5;
            // $data->qasample_qty[2]->samplequantity = 10;

            // $data->qasample_qty[3] = new stdClass();
            // $data->qasample_qty[3]->qa_sample_id = 3;
            // $data->qasample_qty[3]->samplequantity = 50;

            $view['show_section1'] = TRUE;

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

            
                $this->superuser_modal_update->update_section1($data);

                $ack_data = $this->modal_master->get_sec1_ack_list($data->qan_id);

                if($ack_data->ack_eng_user > 0 and $ack_data->ack_prod_user > 0 and $ack_data->ack_qa_user > 0)
                    $this->modal_update->update_status($data->qan_id,'4','3');
                else
                    $this->modal_update->update_status($data->qan_id,'3');

                $this->session->set_userdata('last_created_machine_id', $data->qan_id);
            //    echo $this->session->userdata('last_created_machine_id');
            //     exit;
                redirect("SuperUser/successmaster");

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
                if(isset($_POST['detectedby_user'])) $data->detectedby_user = $this->input->post('detectedby_user');
                if(isset($_POST['defect_description'])) $data->defect_description_id = $this->input->post('defect_description');
                if(isset($_POST['last_passed_sample'])) $data->last_passed_sample = $this->input->post('last_passed_sample');
                if(isset($_POST['purge_from'])) $data->purge_from = $this->input->post('purge_from');
                if(isset($_POST['estimate_qty'])) $data->estimate_qty = $this->input->post('estimate_qty');
        
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
                //system generate
                $data->modified_date = date("Y-m-d H:i:s");
                if($this->input->post('submit') == 'update_section1'){
                    $data->qan_no = $this->input->post('qan_no');
                    $data->qan_id = $this->input->post('machine_breakdown_id');
                    // echo '<pre>';
                    // print_r($data);
                    // exit;
                    $this->superuser_modal_update->update_section1($data);
                
                    // echo '<pre>';
                    // print_r($data);
                    // exit;
                    $this->session->set_userdata('success_message', 'Record Updated Successfully');
                }
                // else{
                //     $data->qan_no = $this->modal_create->get_next_qan_no(@$data->test);
                //     $data->qan_id = '';
                //     $data = $this->modal_create->save_section1($data);
                //     $this->session->set_userdata('success_message', 'Record Saved Successfully');
                // }
            
                $this->session->set_userdata('last_created_machine_id', $data->qan_id);
                echo $this->session->userdata('last_created_machine_id');
                exit;
                redirect("SuperUser/successmaster");
            } //end of submit section 1

            
            $this->load->view('SuperUser/QAN/superuser_master',$view);
            $this->footer($this->data);
        }
        
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