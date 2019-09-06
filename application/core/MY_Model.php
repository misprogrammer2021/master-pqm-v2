<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        if($hostname === '14JCY025TL') {
            $activedb = 'jcynb';
        } else {
            $activedb = 'default';
        }
        $this->load->database($activedb);
    }

    public function record_count($where=array(),$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function get_where($where=array(),$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function getOne($where=array(),$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function getFirst($where=array(),$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->order_by('ID');
        $query = $this->db->get($this->table);
        return $query->first_row('array');
    }

    public function getLast($where=array(),$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->order_by('ID');
        $query = $this->db->get($this->table);
        return $query->last_row('array');
    }

    public function insert($insert_array=array()) {
        $this->db->insert($this->table, $insert_array);
        return $this->db->insert_id();
    }

    public function update($where=array(),$update_array=array()) {
        //$where = array('Is_Deleted' => 0);
        $this->db->where($where);
        $this->db->update($this->table,$update_array);
    }

    public function delete($where=array()) {
        $where = array('Is_Deleted' => 1);
        $this->db->where($where);
        $this->db->update($this->table,$update_array);
    }

}

?>
