<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_apicontroller extends CI_Controller {

    public $data = array();

    public function __construct() {
            parent::__construct();
            
            $this->data['starttime'] = microtime(true);
            $this->load->library('Cookie');


            header('Content-Type: application/json; charset=utf-8');
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

            $this->selfConstruct();
    }

    public function selfConstruct(){
    }

    // Read Successful
    protected function json_output($result){
    	$this->data['endtime'] = microtime(true);
    	$timediff = ($this->data['endtime'] - $this->data['starttime']);
    	header('Content-Type: application/json; charset=utf-8');
		header("Access-Control-Allow-Origin: *");
    	echo json_encode(array(
    		'status'	=> "OK",
    		'result'	=> $result,
    		'comment'	=> "",
    		'duration'	=> $timediff,
    	));
    }

    // Read Error
    protected function json_output_error($result){
    	$this->data['endtime'] = microtime(true);
    	$timediff = ($this->data['endtime'] - $this->data['starttime']);
    	header('Content-Type: application/json; charset=utf-8');
		header("Access-Control-Allow-Origin: *");
    	echo json_encode(array(
    		'status'	=> "ERROR",
    		'result'	=> $result,
    		'comment'	=> "",
    		'duration'	=> $timediff,
    	));
    }

    public function YmdHisToDDMMMYYYYHHMMSSAM($YmdHis) {

        //Date with Time
        if(strpos($YmdHis, " ") !== FALSE) {
            $tmp = explode(" ", $YmdHis);

            $date = $tmp[0];
            $time = $tmp[1];

            $dateTmp = explode("-", $date);
            $timeTmp = explode(":", $time);

            $unixTimeStamp = mktime($timeTmp[0],$timeTmp[1],$timeTmp[2], $dateTmp[1], $dateTmp[2], $dateTmp[0]);

            return date("d M Y h:i:s A", $unixTimeStamp);

        //just Date
        } else {

            $dateTmp = explode("-", $YmdHis);
            $unixTimeStamp = mktime(0,0,0, $dateTmp[1], $dateTmp[2], $dateTmp[0]);

            return date("d M Y", $unixTimeStamp);

        }


    }

    public function jsDateStringToPHPDateFormat($jsDateString, $jsDateFmt = '') {
        
        $tmp = explode(" ", trim($jsDateString));

        $monthNumList = array(
            "Jan" => "01", "Feb" => "02", "Mar" => "03", 
            "Apr" => "04", "May" => "05", "Jun" => "06",
            "Jul" => "07", "Aug" => "08", "Sep" => "09",
            "Oct" => "10", "Nov" => "11", "Dec" => "12",
        );

        switch ($jsDateFmt) {
            case 'dd MMM yyyy':
                //handle backend <datepicker date-format="dd MMM yyyy"> to php date
                //sample : "01 Jun 2017"
                return $tmp[2]."-".$monthNumList[$tmp[1]]."-".$tmp[0];
                break;
                
            default:
                //handle js date
                //sample : "Thu Jun 01 2017 00:00:00 GMT+0800 (Malay Peninsula Standard Time)"
                return $tmp[3]."-".$monthNumList[$tmp[1]]."-".$tmp[2];
                break;
        }
        //return "2017-06-01"
    }

    public function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb"); 
        
        if(strpos($base64_string,",") !== false) {
            $data = explode(',', $base64_string);           
            fwrite($ifp, base64_decode($data[1])); 
        } else {
            fwrite($ifp, base64_decode($base64_string));    
        }
        fclose($ifp); 
    
        return $output_file; 
    }

    //Admin Authentication
    public function adminAuth($token) {

        //Authentication
        $tokenData = $this->User_login_token_model->getOne(array(
                'token' => $token,
                'expired >' => time(),
        ));            
                                 
        if( !empty($tokenData) ){                      

            $this->User_login_token_model->update(array('id'=>$tokenData['id']),array(                         
                    'expired'   => time()+7*24*3600,                            
                    'modified_date' => date("Y-m-d H:i:s"),                         
            ));
            return $tokenData['user_id'];
                
        } else {
            throw new Exception("You are not allow to view this data");
        }

    }

    //Delete API
    public function delete(){

        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


        try {

            if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
                $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

                
                $ID = $this->input->post("id", true);
                $token = $this->input->post("token", true);

                $adminID = $this->adminAuth($token);

                $eachData = $this->{$this->data['main_model']}->getOne(array(
                            $this->data['primaryKey'] => $ID,
                ));
                if(empty($eachData)) {
                    throw new Exception("data not exists");
                }

                $this->{$this->data['main_model']}->update(array(
                    $this->data['primaryKey'] => $ID,
                ),array(
                    'is_deleted' => 1,                          
                    'modified_date' => date("Y-m-d H:i:s"),
                ));

                //Audit Trail
                $this->Audit_trail_model->insert(array(
                    'adminID' => $adminID,
                    'section' => $this->data['audit_section'],
                    'itemID' => $ID,
                    'action' => "Delete",
                    'beforeData' => json_encode(array('is_deleted' => 0)),
                    'afterData' => json_encode(array('is_deleted' => 1)),
                    'created_date' => date("Y-m-d H:i:s"),
                ));
                
                $this->json_output(array(
                    $this->data['primaryKey'] => $ID,
                ));

            } else {
                throw new Exception("Invalid param");
            }

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }

    }

    //Batch Update
    public function batchUpdate(){

        header('Content-Type: application/json; charset=utf-8');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


        try {

            if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
                $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));

                $action = $this->input->post("action", true);
                $chosenID = $this->input->post("chosenID", true);
                $token = $this->input->post("token", true);

                $adminID = $this->adminAuth($token);

                $chosenIDs = array();
                if(strpos($chosenID, ",") !== FALSE) {
                    $chosenIDs = explode(",", $chosenID);
                } else {
                    $chosenIDs[] = $chosenID;
                }

                if(!empty($chosenIDs)) {
                    foreach($chosenIDs as $v) {

                        $eachData = $this->{$this->data['main_model']}->getOne(array(
                            $this->data['primaryKey'] => $v,
                        ));

                        $update_array = array(
                            'modified_date' => date("Y-m-d H:i:s")
                        );
                        $column = "status";
                        switch($action) 
                        {
                            case "Delete":
                                $update_array['is_deleted'] = 1;
                                $column = "is_deleted";
                                break;
                            case "Activate":
                                $update_array['status'] = 1;
                                break;
                            case "Deactivate":
                                $update_array['status'] = 0;
                                break;
                            case "Approved":
                                $update_array['status'] = "APPROVED";
                                break;
                            case "Rejected":
                                $update_array['status'] = "REJECTED";
                                break;
                            case "Pending":
                                $update_array['status'] = "PENDING";
                                break;
                            case "Enabled":
                                $update_array['status'] = 1;
                                break;
                            case "Disabled":
                                $update_array['status'] = 0;
                                break;
							case "Available":
                                $update_array['display'] = 1;
                                break;
							case "Unavailable":
                                $update_array['display'] = 0;
                                break;
                        }

                        $this->{$this->data['main_model']}->update(array(
                            $this->data['primaryKey'] => $v,
                        ), $update_array);

                        //更新資料的紀錄
                        $this->Audit_trail_model->insert(array(
                            'adminID' => $adminID,
                            'section' => $this->data['audit_section'],
                            'itemID' => $v,
                            'action' => $action,
                            'beforeData' => json_encode(array(
                                $column => $eachData[$column],
                            )),
                            'afterData' => json_encode($update_array),
                            'created_date' => date("Y-m-d H:i:s"),
                        ));

                    }
                }
                $this->json_output($chosenID);

            } else {
                throw new Exception("Invalid param");
            }

        } catch (Exception $e) {
            $this->json_output_error($e->getMessage());
        }


    }

    //getDetail
    public function getDetail($ID, $token){

        try {

            $adminID = $this->adminAuth($token);

            $eachData = $this->{$this->data['main_model']}->getOne(array(
                $this->data['primaryKey'] => $ID,
                'is_deleted' => 0,
            ));

            $eachData[$this->data['primaryKey']] = (int)$eachData[$this->data['primaryKey']];

            $this->json_output(array(
                $this->data['audit_section'].'Detail' => array(
                    $this->data['audit_section'].'Data' => $eachData,
                ),
            ));

        } catch (Exception $e) {

            $this->json_output_error($e->getMessage());

        }

    }

    //User Authentication
    public function userAuth($user_id, $token) {

        $tokenData = $this->User_login_token_model->getOne(array(
                'user_id'   => $user_id, 
                'token'     => $token,
                'expired >' => time(),
        ));            
                                 
        if( !empty($tokenData) ){                      

            $this->User_login_token_model->update(array('id'=>$tokenData['id']),array(                         
                    'expired'   => time()+7*24*3600,                            
                    'modified_date' => date("Y-m-d H:i:s"),                         
            ));
            return $tokenData['user_id'];
                
        } else {
            throw new Exception("Your login session has expired. Please login.");
        }

    }

    //check whether the user is logged in
    public function userIsLogin($token) {

        $tokenData = $this->User_login_token_model->getOne(array(
                'token'     => $token,
                'expired >' => time(),
        ));            
        if( !empty($tokenData) ){                      

            $this->User_login_token_model->update(array('id'=>$tokenData['id']),array(                         
                    'expired'   => time()+7*24*3600,                            
                    'modified_date' => date("Y-m-d H:i:s"),                         
            ));
            return $tokenData['user_id'];
                
        } else {
            return "";
        }

    }

    public function getListNormal($parameter=""){        
        
        $dataList =  $this->{$this->data['main_model']}->get_where(array(
            'is_deleted' => 0,          
        ));
        
        $this->json_output(array(
            'dataList' => $dataList
        ));

    }

}
?>