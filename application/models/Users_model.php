<?php
class Users_model extends MY_Model {
	protected $table_name = "users";
	public $primaryKey = "id";
	public $prefix = "";

	public function getLevelList(){
		return array(
			'0' => "User",
            '1' => "QA",
            '2' => "Production",
            '3' => "Engineering",
            '4' => "Store",
			'-1' => "Admin",
		);
	}

}
?>