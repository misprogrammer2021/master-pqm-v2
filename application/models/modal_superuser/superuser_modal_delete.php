<?php
class SuperUser_Modal_Delete extends CI_Model
{
    //section 3 QA inspection results
    function delete_inspection_data($machine_breakdown_id=0,$root_cause_submission_id=0){
        
        if($machine_breakdown_id>0){

            $this->db->where('machine_breakdown_id', $machine_breakdown_id);

            if(is_array($root_cause_submission_id) and count($root_cause_submission_id)>0){
                $this->db->where_in('root_cause_submission_id', $root_cause_submission_id);
            }
            else if($root_cause_submission_id>0){
                $this->db->where('root_cause_submission_id', $root_cause_submission_id);
            }

            return $this->db->delete('qan_rootcause_item_inspection');
            // echo $query = $this->db->get_compiled_select('qan_rootcause_item_inspection');
            // exit;
        }
        else{
            return false;
        }
        
    }
}
?>