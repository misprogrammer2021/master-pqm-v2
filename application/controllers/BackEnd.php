<?php

require_once APPPATH . 'core/MY_FrontEnd.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class BackEnd extends MY_FrontEnd {

    public function __construct() {
        parent::__construct();

        if(@$this->session->userdata['permission']['C1']['de'] OR @$this->session->userdata['permission']['C1.1']['de'] OR @$this->session->userdata['permission']['C1.2']['de'] OR @$this->session->userdata['permission']['C1.3']['de']OR @$this->session->userdata['permission']['C1.4']['de']) 
        {
            
        }else{
            redirect("BackEnd/notauthorized");
        }
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
        $this->load->model('modal_admin/admin_modal_update');
        $this->load->model('modal_admin/admin_modal_create');
    
        date_default_timezone_set('Asia/Kuala_Lumpur');
    }

    public function notauthorized(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $this->load->view('BackEnd/notauthorized',$this->data);
        $this->footer($this->data);
    }

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
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // $email=$this->input->post('email');
            $fullname = $this->input->post('fullname');
            $commodity = $this->input->post('commodity');
            $dept_id = $this->input->post('dept_id');
            $title = $this->input->post('title');
            $employee_no = $this->input->post('employee_no'); 
            $role_id = $this->input->post('role_id');         
            $created_at = date("Y-m-d H:i:s"); 
            $updated_at = date("Y-m-d H:i:s");

            //call saverecords method of Login_Database and pass variables as parameter
            $user_id = $this->login_database->save_user_registration($username,$password,$fullname,$commodity,$dept_id,$title,$employee_no,$created_at,$updated_at);	
            $this->login_database->save_user_role($user_id,$role_id);

            echo "Records Saved Successfully";
            redirect('/view_user_info');
        }
        
        $result['roles'] = $this->admin_modal_select->get_role_dropdown();
        $result['department'] = $this->admin_modal_select->get_department();
        $this->load->view('BackEnd/QAN/register',$result);
        $this->footer($this->data);
    }
    

    public function view_user_info($user_id = ''){

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
        $result['user_id'] = $user_id;
        $result['view_user'] = $this->admin_modal_select->view_user_records($user_id);
        $this->load->view('BackEnd/QAN/viewuserinfo',$result);
        $this->footer();
    }

    public function update_user_records(){

        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);

        $id=$this->input->get('id');
        $result['display_user'] = $this->admin_modal_select->display_user_by_id($id);
        $result['user_role'] = $this->admin_modal_select->get_user_role($id);
        $result['department'] = $this->admin_modal_select->get_department();
        $this->load->view('BackEnd/QAN/viewuserrecords',$result);	
        
        if($this->input->post('update'))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // $email=$this->input->post('email');
            $fullname = $this->input->post('fullname');
            $commodity = $this->input->post('commodity');
            $dept_id = $this->input->post('dept_id');
            $title = $this->input->post('title');
            $employee_no = $this->input->post('employee_no');
            $status = $this->input->post('status');
            $role_id = $this->input->post('role_id');
            $updated_at = date("Y-m-d H:i:s");
            
            $this->admin_modal_update->update_user_records($id,$username,$password,$fullname,$commodity,$dept_id,$title,$employee_no,$status,$role_id,$updated_at);
            redirect("BackEnd/view_user_info");
        }
        $this->footer($this->data);
    }

    public function view_role_permission(){

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

        $result['sections'] = $this->admin_modal_select->get_section();
        $result['section1'] = $this->admin_modal_select->get_section1();
        $result['permission'] = $this->admin_modal_select->get_user_role_permision();
        $roles_sections = $this->admin_modal_select->get_role_section();

        $temp_role_section = array();

        foreach($roles_sections as $role_section){

            $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
            $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
            $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;
            
        }
        $result['roles_sections'] = $temp_role_section;
        $this->load->view('BackEnd/QAN/viewrolepermission',$result);
        $this->footer($this->data);
    }

    public function processing_role_permission() { //AddRolePermission->old

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
                    //$this->Function_users->updateRolePermissionRecords ->old
                    $this->admin_modal_update->update_role_permission($role_id,$section_id,$view_permission,$data_entry_permission,$approval_permission,$acknowledger_permission);
                                                  
                }
            }
            $roles_sections = $this->admin_modal_select->get_role_section();

            $temp_role_section = array();

            foreach($roles_sections as $role_section){

                $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
                $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
                $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;

            }
            $result['roles_sections'] = $temp_role_section;   
            $result['sections'] = $this->admin_modal_select->get_section();
            $result['section1'] = $this->admin_modal_select->get_section1();
            $result['permission'] = $this->admin_modal_select->get_user_role_permision();
            
            $this->load->view('BackEnd/QAN/viewrolepermission',$result);
            $this->footer($this->data);
        }
    }

    public function processing_permission() { //AddPermision->old

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

            $role_ids = $this->input->post('role_id');
            $section_ids = $this->input->post('section_id');

            foreach($role_ids as $role_id => $on){

                if(is_array($section_ids) AND count($section_ids) > 0){

                    foreach($section_ids[$role_id] as $section_id){

                        $data = array(
                            'role_id' => $role_id,
                            'section_id' => $section_id
                        );
                        $this->admin_modal_create->save_permission($data);//savePermission->old
                        // $this->modal_update->update_permission($data);//savePermission->old
                    }	
                }
            }
            $role_ids=$this->input->post('role_id');
            $role_names=$this->input->post('role_name');
    
            foreach($role_ids as $role_id => $on){

                $data = array(

                    'name' => $role_names[$role_id]
                );
                
                $this->admin_modal_update->update_role($role_id,$data); //updatePermissionRecords->old
            }
        }
           
        $roles_sections = $this->admin_modal_select->get_role_section();

        $temp_role_section = array();

        foreach($roles_sections as $role_section){

            $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
            $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
            $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;

        }
        $result['roles_sections'] = $temp_role_section;
        $result['sections'] = $this->admin_modal_select->get_section();
        $result['section1'] = $this->admin_modal_select->get_section1();
        $result['permission'] = $this->admin_modal_select->get_user_role_permision();

        $this->load->view('BackEnd/QAN/viewrolepermission',$result);//FrontEnd/QAN/viewandaddnewroles
        $this->footer($this->data);
    }

    public function processing_role(){ //ViewUserRole->old
        
        $this->data['title'] = "JCY Product Quality System";
        $this->data['pageName'] = "QUALITY ACTION NOTICE (QAN) & MACHINE BREAKDOWN FORM";
        $this->data['description'] = "Overview";
        $this->data['jsselect'] = TRUE;

        $this->header($this->data);
        $this->topbar($this->data);
        $this->leftsidebar($this->data);
        $this->rightsidebar($this->data);
     
        $roles_sections = $this->admin_modal_select->get_role_section();

        $temp_role_section = array();

        foreach($roles_sections as $role_section){

            $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
            $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
            $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;

        }
        $result['roles_sections'] = $temp_role_section;
        $result['sections']=$this->admin_modal_select->get_section();

        //Check submit button 
        if($this->input->post('submit')) {
            
            $role_id = $this->input->post('role_id');
            $role_name = $this->input->post('role_name');
            
            $result['message_display'] = $this->admin_modal_create->save_role($role_id,$role_name);	
        }
        $result['permission']=$this->admin_modal_select->get_user_role_permision();
        $result['section1']=$this->admin_modal_select->get_section1();
        $this->load->view('BackEnd/QAN/viewrolepermission',$result);
        $this->footer($this->data);
    }

    public function processing_section(){ //ViewSection->old
        
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

            $section = $this->input->post('section');
            $description = $this->input->post('description');
         
            $result['message_display'] = $this->admin_modal_create->save_section($section,$description); //Function_users->saveAddNewSection->old
 
        }else{

            if($this->input->post('update')) {

                $section_id = $this->input->post('sectionid');
                $section = $this->input->post('section');
                $description = $this->input->post('description'); 
    
                foreach($section_id as $id => $on ){
                    $data_update = array(
                        'section_name' => $section[$id],
                        'description' => $description[$id]
                    );
                    if($this->admin_modal_update->update_section($id,$data_update)) //$this->Function_users->updateSectionRecords->old
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }
        $roles_sections = $this->admin_modal_select->get_role_section();
        $temp_role_section = array();
        foreach($roles_sections as $role_section){
            $temp_role_section[$role_section->role_name]['role_id'] = $role_section->role_id;
            $temp_role_section[$role_section->role_name]['section_id'][] =  $role_section->section_id;
            $temp_role_section[$role_section->role_name]['section_name'][] = $role_section->section_name;
        }
        $result['roles_sections'] = $temp_role_section;
        $result['permission']=$this->admin_modal_select->get_user_role_permision();
        $result['sections']=$this->admin_modal_select->get_section();
        $result['section1']=$this->admin_modal_select->get_section1();
        $this->load->view('BackEnd/QAN/viewrolepermission',$result); //'FrontEnd/QAN/viewsection'->old
        $this->footer($this->data);
    }

    public function view_setting(){

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
       
        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_partname() {

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

            $part_name = $this->input->post('part_name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_part_name($part_name,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $part_name_id = $this->input->post('part_name_id');
                $part_name = $this->input->post('part_name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($part_name_id as $id => $on ){

                    $data_update = array(

                        'part_name' => $part_name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_part_name($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_purgelocation() {

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

            $purge_name = $this->input->post('purge_name');
            $order_no = $this->input->post('order_no');
            $show_process = $this->input->post('show_process');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_purge_location($purge_name,$order_no,$show_process,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $purge_name_id = $this->input->post('purge_name_id');
                $purge_name = $this->input->post('purge_name');
                $order_no = $this->input->post('order_no');
                $show_process = $this->input->post('show_process');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($purge_name_id as $id => $on ){

                    $data_update = array(

                        'purge_name' => $purge_name[$id],
                        'order_no' => $order_no[$id],
                        'show_process' => $show_process[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat
                        
                    );
                    if($this->admin_modal_update->update_purge_location($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_defectdescription() {

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

            $defect_description_name = $this->input->post('defect_description_name');
            $defect_type = $this->input->post('defect_type');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_defect_description($defect_description_name,$defect_type,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $defect_description_id = $this->input->post('defect_description_id');
                $defect_description_name = $this->input->post('defect_description_name');
                $defect_type = $this->input->post('defect_type');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($defect_description_id as $id => $on ){

                    $data_update = array(

                        'defect_description_name' => $defect_description_name[$id],
                        'defect_type' => $defect_type[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_defect_description($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_rootcause() {

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

            // $constant_no = $this->input->post('constant_no');
            $root_cause = $this->input->post('root_cause');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_root_cause($root_cause,$is_active,$is_delete);

        }else {

            if($this->input->post('update')) {

                $dateformat = date('Y-m-d H:i:s');
                $root_cause_id = $this->input->post('root_cause_id');
                // $constant_no = $this->input->post('constant_no');
                $root_cause = $this->input->post('root_cause');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($root_cause_id as $id => $on ){

                    $data_update = array(

                        // 'constant_no' => $constant_no[$id],
                        'root_cause' => $root_cause[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat //$dateformat.strtotime($updated_at[$id])

                    );
                    if($this->admin_modal_update->update_root_cause($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_correctiveaction() {

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

            // $constant_no = $this->input->post('constant_no');
            $corrective_action = $this->input->post('corrective_action');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_corrective_action($corrective_action,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {

                $dateformat = date('Y-m-d H:i:s');
                $corrective_action_id = $this->input->post('corrective_action_id');
                // $constant_no = $this->input->post('constant_no');
                $corrective_action = $this->input->post('corrective_action'); 
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($corrective_action_id as $id => $on ){

                    $data_update = array(
                        
                        // 'constant_no' => $constant_no[$id],
                        'corrective_action' => $corrective_action[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_corrective_action($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_machineno() {

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

            $machine_name = $this->input->post('machine_name');
            $sector_id = $this->input->post('sector_id');
            $order_no = $this->input->post('order_no');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_machine_no($machine_name,$sector_id,$order_no,$is_active,$is_delete); 

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $machine_no_id = $this->input->post('machine_no_id');
                $machine_name = $this->input->post('machine_name');
                $sector_id = $this->input->post('sector_id');
                $order_no = $this->input->post('order_no');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($machine_no_id as $id => $on ){

                    $data_update = array(

                        'machine_name' => $machine_name[$id],
                        'sector_id' => $sector_id[$id],
                        'order_no' => $order_no[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_machine_no($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_sector() {

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

            $sector_name = $this->input->post('sector_name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
            $updated_at = $this->input->post('updated_at');
        
            $result['message_display'] = $this->admin_modal_create->save_sector($sector_name,$is_active,$is_delete); //$constant_no	

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $sector_id = $this->input->post('sector_id');
                $sector_name = $this->input->post('sector_name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($sector_id as $id => $on ){

                    $data_update = array(

                        'sector_name' => $sector_name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_sector($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_rule() {

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
            
            $rule_name = $this->input->post('rule_name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_rule($rule_name,$is_active,$is_delete); //$constant_no	

        }else {

            if($this->input->post('update')) {
               
                $dateformat = date('Y-m-d H:i:s');
                $rule_id = $this->input->post('rule_id');
                $rule_name = $this->input->post('rule_name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($rule_id as $id => $on ){
                   
                    $data_update = array(
                        
                        'rule_name' => $rule_name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat
                        
                    );
                    if($this->admin_modal_update->update_rule($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_detectedgroup() {

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
            
            $group_name = $this->input->post('group_name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_detected_group($group_name,$is_active,$is_delete); //$constant_no	

        }else {

            if($this->input->post('update')) {
               
                $dateformat = date('Y-m-d H:i:s');
                $detectedgroup_id = $this->input->post('detectedgroup_id');
                $group_name = $this->input->post('group_name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($detectedgroup_id as $id => $on ){
                   
                    $data_update = array(
                        
                        'group_name' => $group_name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat
                        
                    );
                    if($this->admin_modal_update->update_detected_group($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_detectedusergroup() {

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
            
            $detectedby_user = $this->input->post('detectedby_user');
            $detected_group_id  =$this->input->post('detected_group_id');
            $show_detectedby = $this->input->post('show_detectedby');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_detected_user_group($detectedby_user,$detected_group_id,$show_detectedby,$is_active,$is_delete); //$constant_no	

        }else {

            if($this->input->post('update')) {
               
                $dateformat = date('Y-m-d H:i:s');
                $detectedby_id = $this->input->post('detectedby_id');
                $detectedby_user = $this->input->post('detectedby_user');
                $detected_group_id = $this->input->post('detected_group_id');
                $show_detectedby = $this->input->post('show_detectedby');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($detectedby_id as $id => $on){
                   
                    $data_update = array(
                        
                        'detectedby_user' => $detectedby_user[$id],
                        'detected_group_id' => $detected_group_id[$id],
                        'show_detectedby' => $show_detectedby[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    
                    if($this->admin_modal_update->update_detected_user_group($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
                
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_osorus() {

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

            $name = $this->input->post('name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_os_us($name,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $os_us_id = $this->input->post('os_us_id');
                $name = $this->input->post('name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($os_us_id as $id => $on ){

                    $data_update = array(

                        'name' => $name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_os_us($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_datum() {

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

            $name = $this->input->post('name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_datum($name,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $datum_id = $this->input->post('datum_id');
                $name = $this->input->post('name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($datum_id as $id => $on ){

                    $data_update = array(

                        'name' => $name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_datum($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_remarks() {

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

            $name = $this->input->post('name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_remarks($name,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $remarks_id = $this->input->post('remarks_id');
                $name = $this->input->post('name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($remarks_id as $id => $on ){

                    $data_update = array(

                        'name' => $name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_remarks($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

    public function processing_defecttype() {

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

            $defect_type_name = $this->input->post('defect_type_name');
            $is_active = $this->input->post('is_active');
            $is_delete = $this->input->post('is_delete');
        
            $result['message_display'] = $this->admin_modal_create->save_defect_type($defect_type_name,$is_active,$is_delete);		

        }else {

            if($this->input->post('update')) {
            
                $dateformat = date('Y-m-d H:i:s');
                $defect_type_id = $this->input->post('defect_type_id');
                $defect_type_name = $this->input->post('defect_type_name');
                $is_active = $this->input->post('is_active');
                $is_delete = $this->input->post('is_delete');
                $updated_at = $this->input->post('updated_at');

                foreach($defect_type_id as $id => $on ){

                    $data_update = array(

                        'defect_type_name' => $defect_type_name[$id],
                        'is_active' => $is_active[$id],
                        'is_delete' => $is_delete[$id],
                        'updated_at' => $dateformat

                    );
                    if($this->admin_modal_update->update_defect_type($id,$data_update))
                    {
                        $result['msg'] = 'Success!!';
                    }
                    else{
                        $result['msg'] = 'Not Success!!';
                    }
                }
            }
        }

        $result['part_name'] = $this->admin_modal_select->get_partname();
        $result['purge_name'] = $this->admin_modal_select->get_purge();
        $result['defect_description'] = $this->admin_modal_select->get_defect_description();
        $result['root_cause'] = $this->admin_modal_select->get_root_cause();;
        $result['corrective_action'] = $this->admin_modal_select->get_corrective_action();
        $result['machine_no'] = $this->admin_modal_select->get_machine_no();
        $result['sector'] = $this->admin_modal_select->get_sector();
        $result['rule'] = $this->admin_modal_select->get_rule();
        $result['detected_group'] = $this->admin_modal_select->get_detected_group();
        $result['detectedby_user_group'] = $this->admin_modal_select->get_detectedby_user_group();
        $result['os_us'] = $this->admin_modal_select->get_os_us();
        $result['datum'] = $this->admin_modal_select->get_datum();
        $result['remarks'] = $this->admin_modal_select->get_remarks();
        $result['defect_type'] = $this->admin_modal_select->get_defect_type();

        $this->load->view('BackEnd/QAN/viewsetting',$result);
        $this->footer($this->data);
    }

}