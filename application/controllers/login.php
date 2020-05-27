<?php 
// ob_start();
//updated
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
            parent::__construct();

        // Load form helper library
        $this->load->helper('form');
        $this->load->helper('url');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('login_database');
  
    }

    public function index()
    {
         // Active Header, must include in every public function
         $this->data['title'] = "JCY PQM - Product Quality System";
         $this->data['pageName'] = "JCY PQM";
         $this->data['description'] = "Product Quality System";
         
         //Load View
         $this->load->view('FrontEnd/login');

         if(!empty($this->input->post('username')))
         {
            $this->user_login_process();
         }
         
    }

    // Check for user login process
    private function user_login_process() {
    
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
                if(isset($this->session->userdata['logged_in'])){
    
                redirect('/homepage', 'refresh');
                    
                }
                
                redirect('/login', 'refresh');
        } 
            else {
                $data = array(
                    'username' => $this->input->post('username'),
                    'password' => $this->input->post('password')
                );
                $result = $this->login_database->login($data);
                if ($result == TRUE) {
        
                $username = $this->input->post('username');
                $result = $this->login_database->read_user_information($username);
                if ($result != false) {
                    $session_data = array(
                    'username' => $result[0]->username,
                    'password' => $result[0]->password,
                    'fullname' => $result[0]->fullname,
                    'id' => $result[0]->id,
                    );

                //rebuild permission list array
                $result2 = $this->login_database->read_user_permission($result[0]->id);
                $session_data_permission = array();
                
                if($result2 != false){
                    foreach($result2 as $i=>$row){
                        $session_data_permission[$row->section_name] = array(
                            'view' => $row->see,
                            'de' => $row->de,
                            'ack' => $row->ack,
                            'app' => $row->app//'appr'
                        );
                        
                    }
                }

                
                // $session_data_permission[$row->section]['view'] = $row->see;
                // $session_data_permission[$row->section]['de'] = $row->de;
                // $session_data_permission[$row->section]['ack'] = $row->ack;
                // $session_data_permission[$row->section]['appr'] = $row->appr;

                // Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    $this->session->set_userdata('permission', $session_data_permission);
    
                    if($this->session->userdata['logged_in']['username'] == 'qasuperuser' OR $this->session->userdata['logged_in']['username'] == 'engsuperuser' OR $this->session->userdata['logged_in']['username'] == 'prodsuperuser' OR $this->session->userdata['logged_in']['username'] == 'mrbsuperuser'){
                        redirect('SuperUser/homepage', 'refresh');

                    }else{
                        redirect('/homepage', 'refresh');
                    }
                    
                }

               
            } 
            else {
                $data = array(
                    'error_message' => 'Invalid Username or Password');
                     //$this->load->view('FrontEnd/login', $data);
            }
        }
    }

    public function logout() {

        // Removing session data
        $sess_array = array(
                'username' => '',
                'password' => '',
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->sess_destroy();
        $data['message_display'] = 'Successfully Logout';
        $this->load->view('FrontEnd/login', $data);
    }
}
