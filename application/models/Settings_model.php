<?php
class Settings_model extends CI_Model{

	public function __construct()
	{
		$this->load->database('default');
        date_default_timezone_set("Asia/Kuala_Lumpur");
	}
	
	public function record_count() {
        return $this->db->count_all("settings");
    }
	
	public function get_settings($settings_id = FALSE)
	{
		if ($settings_id === FALSE)
		{
			$query = $this->db->get('settings');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('settings', array('id' => $settings_id));
		return $query->row_array();
	}
	
	public function fetch_settings($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("settings");
 
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	
	public function get_web_title()
	{
		$query = $this->db->get_where('settings', array('id' => 1));
		$data = $query->row_array();
		return $data['value'];
	}
	
	public function get_web_footer()
	{
		$query = $this->db->get_where('settings', array('id' => 2));
		$data = $query->row_array();
		return $data['value'];
	}
	
	public function get_web_meta()
	{
		$query = $this->db->get_where('settings', array('id' => 3));
		$data = $query->row_array();
		return $data['value'];
	}
	
	public function get_web_mobile()
	{
		$query = $this->db->get_where('settings', array('id' => 4));
		$data = $query->row_array();
		return $data['value'];
	}
	
	public function get_web_address()
	{
		$query = $this->db->get_where('settings', array('id' => 5));
		$data = $query->row_array();
		return $data['value'];
	}
	
	public function get_web_email()
	{
		$query = $this->db->get_where('settings', array('id' => 6));
		$data = $query->row_array();
		return $data['value'];
	}
	
	public function get_homepage_slogan()
	{
		$query = $this->db->get_where('settings', array('id' => 8));
		$data = $query->row_array();
		return $data['value'];
	}
    
    public function delete($id){
        $this->db->delete('settings', array('id' => $id)); 
    }
}
?>