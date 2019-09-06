<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Frontend extends CI_Controller {

	private $data = array();
	
	public function __construct(){
        parent::__construct();

		$this->selfConstruct();
		
		if(!isset($this->session->userdata['logged_in'])){
			redirect('login');
		}
	}

	public function selfConstruct(){
		

	}

	public function header($data){
        
        $this->data['header'] = $data;
		$this->load->view("FrontEnd/header", $this->data);
    }

    public function topbar($data){
        
        $this->data['topbar'] = $data;
		$this->load->view("FrontEnd/topbar", $this->data);
    }
    
    public function leftsidebar($data){
        
        $this->data['leftsidebar'] = $data;
		$this->load->view("FrontEnd/leftsidebar", $this->data);
    }
    
    public function rightsidebar($data){
        
        $this->data['rightsidebar'] = $data;
		$this->load->view("FrontEnd/rightsidebar", $this->data);
	}

	public function footer($data=''){

		$this->data['footer'] = $data;
        $this->load->view("FrontEnd/footer", $this->data);
        
	}

}