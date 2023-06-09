<?php

$jsselect = TRUE;

?>

<?php

    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $password = ($this->session->userdata['logged_in']['password']);
        $fullname = ($this->session->userdata['logged_in']['fullname']);
        }else{
          redirect('/login', 'refresh');
        }
        $section = $this->session->userdata['permission'];
        // $data = '{

        //     "root_cause": "test",
        //     "corrective_action": "test",
        //     "user":{
        //         "1": "asma",
        //         "2": "emizul",
        //         "3": "qayyum"
        //     },
        //     "rcfa_pic_user_id": 3,
        //     "rcfa_ack_user_id": 1,
        //     "rcfa_appr_user_id": 2,
        //     "completion_user_id": 1,
        //     "inspection_machine":[
        //         {"id":"1","name":"CMM"},
        //         {"id":"2","name":"EDI"},
        //         {"id":"3","name":"AIR GAUGE"}
        //     ],
        //     "inspection_machine_data":{
        //         {"inspection_machine_id":"1","root_cause_submission_id":"1","inspectby_user_id":"1","time_start2":"15:00","time_end2":"15:00","result":"1"},
        //         {"inspection_machine_id":"2","root_cause_submission_id":"1","inspectby_user_id":"1","time_start2":"15:00","time_end2":"15:00","result":"1"}

        //     }





        // }';


?>        

<div class="row clearfix" id="section3">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h5>
                    ROOT CAUSE FAILURE ANALYSIS <i>(BY PROCESS OWNER)</i>                           
                </h5>
            </div>
            <div class="body"> 
                <?php

                    if(@count($data->submit_button->s3)>0){

                        $form = $data->submit_button->s3[0];
                        echo "<!-- Section 3 Form -->\r\n";
                        echo '<form method="post" action="'.$form->action.'" autocomplete="off">';
                    }
                ?>
                
                <div class="row clearfix">
                    <!-- [TABS] -->
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul id="eng_tab2" class="nav nav-tabs" role="tablist">

                            <!-- start loop submission number  -->
                            <?php
                            
                                function ordinal($number) {
                                    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                    if ((($number % 100) >= 11) && (($number%100) <= 13))
                                        return $number. 'th';
                                    else
                                        return $number. $ends[$number % 10];
                                }
                                
                                if(@!$data->inspection_machine_data)
                                    $data->inspection_machine_data[0] = new stdClass();

                                for($i = 0; $i < count(@$data->inspection_machine_data); $i++ ){

                                    echo '<li role="presentation" class="'.($i==0?'active':'').'">
                                                <a href="#sub'.($i+1).'" data-toggle="tab" aria-expanded="false">
                                                    <i class="material-icons">insert_drive_file</i>'.ordinal($i+1).' Submission
                                                </a>
                                        </li>';
                                }
                            ?>
                    
                            <?php if (@$section['S3.1']['de']){?>

                            <li role="presentation">
                                <a href="javascript:void(0);" id="add_sub">
                                    <!-- <span class="btn btn-success"><i class="material-icons">add</i>NEW</span> -->
                                </a>
                            </li>
                            <?php }?>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="eng_content2">

                            <!-- TAB 0 -->
                            <div role="tabpanel" class="tab-pane fade" id="sub">
                                <input type="hidden" name="submission_id[]" value=""> 
                                <input type="hidden" name="submission_no[]" value="">      

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="root_cause" name="root_cause" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>></textarea>
                                            <label class="form-label">ROOT CAUSE</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="corrective_action" name="corrective_action" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>></textarea>
                                            <label class="form-label">CORRECTIVE ACTION</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_pic_user_id" name="rcfa_pic_user_id[]" class="form-control" value="<?php //echo  @$section['S3.1']['de']?@$data->user->{$this->session->userdata['logged_in']['id']}:''; ?>" disabled>
                                            <input type="hidden" name="rcfa_pic_user_id[]" value="<?php //echo @$section['S3.1']['de']?$this->session->userdata['logged_in']['id']:'';?>" />
                                            <label class="form-label">PERSON IN-CHARGE</label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_ack_user_id" name="rcfa_ack_user_id[]" class="form-control"  value="<?php echo @$section['S3.3']['ack']?@$data->user->{$this->session->userdata['logged_in']['id']}:''; ?>" disabled>
                                            <input type="hidden" name="rcfa_ack_user_id[]" value="<?php echo @$section['S3.3']['ack']?$this->session->userdata['logged_in']['id']:'';?>" />
                                            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="others_corrective_action" name="others_corrective_action" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>>
                                            <label class="form-label">OTHERS</label>
                                        </div>
                                    </div>
                                </div>
                                <b class="qasubmission">QA Inspection Data - 0st Submission</b>
                                <h5>Job Completion By Engineering</h5>           
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="completion_user_id" name="completion_user_id[]" class="form-control" value="<?php echo @$section['S3.1']['de']?@$data->user->{$this->session->userdata['logged_in']['id']}:''; ?>" disabled>
                                            <input type="hidden" name="completion_user_id[]" value="<?php echo @$section['S3.1']['de']?$this->session->userdata['logged_in']['id']:'';?>" />    
                                            <label class="form-label">NAME</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="completion_datetime" name="completion_datetime[]" class="form-control" <?php echo @$section['S3.1']['see']?'':'disabled';?>>
                                            <label class="form-label">DATE & TIME</label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover table-bordered rootcause-form">
                            
                                    <?php 

                                        echo '<tr>';
                                            echo '<th>ITEM INSPECTION</th>';
                                            foreach(@$data->inspection_machine as $inspectionmachine)
                                            {
                                                
                                                echo '
                                                    <th align="center"><input type="checkbox" id="insp_machine_0_machine'.$inspectionmachine->id.'" name="qa_insp_machine['.$inspectionmachine->id.']"'.(@$section['S3.2']['de']?'':'disabled').' class="filled-in checkbox-tab">
                                                        <label for="insp_machine_0_machine'.$inspectionmachine->id.'"></label>'.$inspectionmachine->name.'
                                                    </th>
                                                ';
                                                    
                                            }
                                        echo '</tr>';
                                    ?>

                                    <?php 

                                        echo '<tr>';
                                            echo '<td>Inspect By</td>';
                                            foreach(@$data->inspection_machine as $inspectionmachine)
                                            {
                                                echo '<td>';
                                                    echo '<div class="selectresult">';
                                                        
                                                        echo '
                                                            <select id="inspect_by_0_machine'.$inspectionmachine->id.'" class="form-control show-tick"'.(@$section['S3.2']['de']?'':'disabled').' name="inspect_by['.$inspectionmachine->id.'][]">';
                                                            echo '<option value="" disabled selected>-- Please Select --</option>';
                                                            foreach(@$data->inspect_user as $id => $inspectby)
                                                            {   
                                                                echo '<option value="'.$id.'">'.$inspectby->fullname.'</option>';
                                                            }
                                                            echo '</select>';

                                                    echo '</div>';
                                                echo '</td>';
                                            }
                                        echo '</tr>';
                                    ?>

                                    <?php 

                                        echo '<tr>';
                                            echo '<td>Time Start</td>';
                                            foreach(@$data->inspection_machine as $inspectionmachine)
                                            {
                                                echo '
                                                    <td><input id="time_start_0_machine'.$inspectionmachine->id.'" type="text" name="time_start['.$inspectionmachine->id.'][]"'.(@$section['S3.2']['de']?'':'disabled').' class="timepicker form-control"></td>
                                                    
                                                ';
                                            }
                                        echo '</tr>';
                                    ?>

                                    <?php 

                                        /*echo '<tr>';
                                            echo '<td>Time End</td>';
                                            foreach(@$data->inspection_machine as $inspectionmachine)
                                            {
                                                echo '
                                                    <td><input id="time_end_0_machine'.$inspectionmachine->id.'" type="text" name="time_end['.$inspectionmachine->id.'][]"'.(@$section['S3.2']['de']?'':'disabled').' class="timepicker form-control"></td>
                                                    
                                                ';
                                            }
                                        echo '</tr>';*/
                                    ?>

                                    <?php 
                                    
                                        echo '<tr>';
                                            echo '<td>Result</td>';
                                            foreach(@$data->inspection_machine as $inspectionmachine)
                                            {
                                                echo '<td>';
                                                    echo '<div class="selectresult">';
                                                        
                                                        echo '
                                                                <select id="rc_result_0_machine'.$inspectionmachine->id.'" class="form-control show-tick"'.(@$section['S3.2']['de']?'':'disabled').' name="rc_result['.$inspectionmachine->id.'][]">
                                                                    <option value="" disabled selected>-- Please Select --</option>
                                                                    <option value="1">PASS</option>
                                                                    <option value="0">FAIL</option>
                                                                </select>
                                                        ';
                                                                
                                                    echo '</div>';
                                                echo '</td>';
                                            }
                                        echo '</tr>';
                                    ?>  
                                </table>  
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="remarks" name="remarks" class="form-control" <?php echo @$section['S3.2']['de']?'':'disabled';?>>
                                            <label class="form-label">Remarks</label>
                                        </div>
                                    </div>
                                </div>  
                                <!-- <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12">
                                        <h5>APPROVAL <i>(Leader & Above)</i></h5>
                                        <label class="form-label">MACHINE STATUS</label>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="radio" id="machine_status1" name="machine_status[]" class="with-gap" <?php echo @$section['S3.2']['de']?'':'disabled';?>> 
                                            <label for="machine_status1">RUN</label>
                                            <div class="form-group form-float">
                                                <div class="form-line"> 
                                                    <input type="text" id="approval_user_id" name="approval_user_id[]" class="form-control" value="<?php echo @$section['S3.2']['de']?@$data->user->{$this->session->userdata['logged_in']['id']}:''; ?>" disabled>
                                                    <input type="hidden" name="approval_user_id[]" value="<?php echo @$section['S3.2']['de']?$this->session->userdata['logged_in']['id']:'';?>" /> 
                                                    <label class="form-label">APPROVED BY</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="radio" id="machine_status2" name="machine_status[]" class="with-gap" <?php echo @$section['S3.2']['de']?'':'disabled';?>> 
                                            <label for="machine_status2">STOP</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="machine_stop_reason" name="machine_stop_reason[]" class="form-control" <?php echo @$section['S3.2']['de']?'':'disabled';?>> 
                                                    <label class="form-label">IF STOP, REASON:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12">
                                        <h5>APPROVAL <i>(Leader & Above)</i></h5>
                                        <label class="form-label">MACHINE STATUS</label>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="radio" id="machine_status1" name="machine_status" class="with-gap" value="1" <?php echo @$section['S3.5']['de']?'':'disabled';?>> 
                                            
                                            <label for="machine_status1">RUN</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="approval_user_id" name="approval_user_id[]" class="form-control"  value='<?php echo @$data->user->{$data->approval_user_id};?>' <?php echo @$section['S3.4']['app']?'':'disabled';?>>
                                                    <input type="hidden" name="approval_user_id[]" value="<?php echo @$section['S3.4']['app']?$this->session->userdata['logged_in']['id']:'';?>" /> 
                                                    <label class="form-label">APPROVED BY</label>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <input type="radio" id="machine_status2" name="machine_status" class="with-gap" value="0" <?php echo @$section['S3.5']['de']?'':'disabled';?>> 
                                            <label for="machine_status2">STOP</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="machine_stop_reason" name="machine_stop_reason" class="form-control" <?php echo @$section['S3.5']['de']?'':'disabled';?>> 
                                                    <label class="form-label">IF STOP, REASON:</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END of TAB 0 -->  

                            <?php
                                
                                foreach(@$data->inspection_machine_data as $i => $rcsubmissiondata){

                                    $subno = $i+1;
                                
                                    echo "<!-- TAB $subno -->"; 
                                    echo '<div role="tabpanel" class="tab-pane fade '.($subno==1?'active in':'').'" id="sub'.$subno.'">';
                                    echo '<input type="hidden" name="submission_id['.$subno.']" value="'.$rcsubmissiondata->submission_id.'">';  
                                    echo '<input type="hidden" name="submission_no['.$subno.']" value="'.$subno.'">';      
                            ?>
                                        <br/>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="col-md-4">
                                                <label class="form-label">ROOT CAUSE</label>
                                            </div>
                                            <div class="col-md-8">

                                                <?php

                                                    $disabled_str = '';
                                                    if((is_array(@$rcsubmissiondata->inspection_data) and count(@$rcsubmissiondata->inspection_data))) 
                                                    {
                                                        $disabled_str = 'disabled';
                                                    }
                                                    
                                                        echo '<select id="root_cause" name="root_cause['.$subno.']" data-show-subtext="true" data-live-search="true" class="'.(@$section['S3.1']['de']?'show-tick':'') .' form-control"'.' '.(@$section['S3.1']['de']?'':'disabled').' '.$disabled_str.' required>';
                                                        echo '<option value="">--Please Select--</option>';
                                                    
                                                        foreach($data->list_rootcause as $id => $root_cause)
                                                        {
                                                            $selected = '';
                                                            if (@$rcsubmissiondata->root_cause_id == $id){
                                                                $selected = 'selected';
                                                            }
                                                            echo '<option value="'.$id.'" '.$selected.'>'.$root_cause.'</option>';
                                                        }
                                                        echo '</select>';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="col-md-4">
                                                <label class="form-label">CORRECTIVE ACTION</label>
                                            </div>
                                            <div class="col-md-8">

                                                <?php

                                                    $disabled_str = '';
                                                    if((is_array(@$rcsubmissiondata->inspection_data) and count(@$rcsubmissiondata->inspection_data))) 
                                                    {
                                                        $disabled_str = 'disabled';
                                                    }
                                                    
                                                        echo '<select id="corrective_action" name="corrective_action['.$subno.']" data-show-subtext="true" data-live-search="true" class="'.(@$section['S3.1']['de']?'show-tick':'') .' form-control"'.' '.(@$section['S3.1']['de']?'':'disabled').' '.$disabled_str.' required>';
                                                        echo '<option value="">--Please Select--</option>';
                                                        
                                                        foreach($data->list_corrective_action as $id => $corrective_action)
                                                        {
                                                            $selected = '';
                                                            if (@$rcsubmissiondata->corrective_action_id == $id){
                                                                $selected = 'selected';
                                                            }
                                                            echo '<option value="'.$id.'" '.$selected.'>'.$corrective_action.'</option>';
                                                        }
                                                        echo '</select>';
                                                ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="rcfa_pic_user_id" name="rcfa_pic_user_id[<?php //echo $subno;?>]" class="form-control" value="<?php //echo @$data->user->{@$rcsubmissiondata->rcfa_pic_user_id};?>" disabled>
                                                    <input type="hidden" name="rcfa_pic_user_id[<?php //echo $subno;?>]" value="<?php //echo @$rcsubmissiondata->rcfa_pic_user_id;?>" />
                                                    <label class="form-label">PERSON IN-CHARGE</label>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="rcfa_ack_user_id" name="rcfa_ack_user_id[<?php echo $subno;?>]" class="form-control" value="<?php echo @$data->user->{@$rcsubmissiondata->rcfa_ack_user_id};?>" disabled>
                                                    <input type="hidden" name="rcfa_ack_user_id[<?php echo $subno;?>]" value="<?php echo @$rcsubmissiondata->rcfa_ack_user_id;?>" />
                                                    <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="others_corrective_action" name="others_corrective_action[<?php echo $subno;?>]" value="<?php echo @$rcsubmissiondata->others_corrective_action;?>" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>>
                                                    <label class="form-label">OTHERS</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <b>QA Inspection Data - <?php echo ordinal($i+1);?> Submission</b>
                                        <h5>Job Completion By Engineering</h5>           
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="completion_user_id" name="completion_user_id[<?php echo $subno;?>]" class="form-control" value="<?php echo @$data->user->{@$rcsubmissiondata->completion_user_id}; ?>" disabled>
                                                    <input type="hidden" name="completion_user_id[<?php echo $subno;?>]" value="<?php echo @$rcsubmissiondata->completion_user_id;?>" />
                                                    <label class="form-label">NAME</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="completion_datetime" name="completion_datetime[<?php echo $subno;?>]" class="form-control" value="<?php echo @$rcsubmissiondata->completion_datetime; ?>" disabled>
                                                    <label class="form-label">DATE & TIME</label>
                                                </div>
                                            </div>
                                        </div>

                                        <?php

                                            // $row[0][0] = 'ITEM INSPECTION';
                                            // $row[1][0] = 'Inspect By';
                                            // $row[2][0] = 'Time Start';
                                            // $row[3][0] = 'Time End';
                                            // $row[4][0] = 'Result';
                                            $row[0][0] = 'ITEM INSPECTION';
                                            $row[1][0] = 'Inspect By';
                                            $row[2][0] = 'Time Start';
                                            $row[3][0] = 'Result';

                                            if(@$data->inspection_machine)

                                            foreach(@$data->inspection_machine as $m_index => $inspectionmachine)
                                            {
                                                $table_col = $m_index+1;
                                                $cb_id = $inspectionmachine->id;
                                                $cb_name = $inspectionmachine->name;
                                                $cb_checked = '';
                                                $input_insp_by = '';
                                                $input_time_start = '';
                                                // $input_time_end = '';
                                                $input_result = '';

                                                if(@$rcsubmissiondata->inspection_data)
                                                foreach(@$rcsubmissiondata->inspection_data as $dataobject){

                                                    $db_cb_id = $dataobject->inspection_machine_id;

                                                    if($cb_id == $db_cb_id /*and $db_cb_sumbission_id == $submissionid*/)
                                                    {
                                                        $cb_checked = 'checked';
                                                        $input_insp_by = $dataobject->inspectby_user_id;
                                                        $input_time_start = $dataobject->time_start2;
                                                        // $input_time_end = $dataobject->time_end2;
                                                        $input_result = $dataobject->result;
                                                        break;
                                                    }
                                                }

                                                $row['id'][$table_col] = $cb_id;
                                                $row['name'][$table_col] = $cb_name;
                                                // $row[0][$table_col] = $cb_checked;
                                                // $row[1][$table_col] = $input_insp_by;
                                                // $row[2][$table_col] = $input_time_start;
                                                // $row[3][$table_col] = $input_time_end;
                                                // $row[4][$table_col] = $input_result;
                                                $row[0][$table_col] = $cb_checked;
                                                $row[1][$table_col] = $input_insp_by;
                                                $row[2][$table_col] = $input_time_start;
                                                $row[3][$table_col] = $input_result;
                                            }

                                            //generate table
                                            echo '<table class="table table-hover table-bordered rootcause-form">';
                                            for($tablerow=0;$tablerow<4;$tablerow++) //for($tablerow=0;$tablerow<5;$tablerow++)
                                            {
                                                echo '<tr>';
                                                for($tablecol=0;$tablecol<count($row[0]);$tablecol++)
                                                {
                                                    if($tablerow!=0){
                                                        echo '<td>';
                                                    }

                                                    if($tablecol==0){

                                                        if($tablerow==0)echo '<th>';
                                                        echo $row[$tablerow][$tablecol];
                                                    }else{
                                                        $cb_id = $row['id'][$tablecol];
                                                        $cb_name = $row['name'][$tablecol];
                                                    
                                                        if($tablerow==0){

                                                            $cb_checked = $row[$tablerow][$tablecol];
                                                            $cb_id_val = 'insp_machine_'.$subno.'_machine'.$cb_id;

                                                            echo '<th align="center">';
                                                            $disabled_input = '';
                                                            if(@$rcsubmissiondata->inspection_data) {
                                                                $disabled_input = 'disabled';
                                                            }
                                                            echo '<input type="checkbox" id="'.$cb_id_val.'" name="qa_insp_machine['.$subno.']['.$cb_id.']" class="filled-in checkbox-tab"'.(@$section['S3.2']['de']?'':'disabled').' '.$cb_checked.' '.$disabled_input.'/>';
                                                            echo '<label for="'.$cb_id_val.'"></label>'.$cb_name;
                                                            echo '<input type="hidden" name="_qa_insp_machine['.$subno.']['.$cb_id.']" value="'.($cb_checked=="checked"?"on":"").'"/>';
                                                        }

                                                        $inspect_by_group = array();

                                                        foreach($detected_by as $key => $obj){
                                                            // $inspect_by_group[$obj->detected_group][$obj->id] = $obj->detected_by_name;
                                                            $inspect_by_group[$obj->group_name][$obj->id] = $obj->detectedby_user;
                                                        }

                                                        if($tablerow==1){
                                                            $input_insp_by = $row[$tablerow][$tablecol];
                                                            $select_default = 'selected';
                                                            $insp_id_val = 'inspect_by_'.$subno.'_machine'.$cb_id;

                                                            if($input_insp_by != ''){
                                                                $select_default = '';
                                                            }
                                                            echo '<div class="selectresult">';
                                                                echo '<select id="'.$insp_id_val.'" class="form-control show-tick"'.(@$section['S3.2']['de']?'':'disabled').' '.$disabled_input.' name="inspect_by['.$subno.']['.$cb_id.']">';
                                                                    echo '<option value="" disabled '.$select_default.'>-- Please Select --</option>';
                                                            
                                                                    // foreach($inspect_by_group[$cb_name] as $id => $detected_by_name)
                                                                    foreach($inspect_by_group[$cb_name] as $id => $detectedby_user)
                                                                    {
                                                                        $selected = ($input_insp_by != '' AND $id==$input_insp_by)?'selected':'';
                                                                        echo '<option value="'.$id.'" '.$selected.'>'.$detectedby_user.'</option>';
                                                                    }
                                                                echo '</select>';
                                                            echo '</div>';
                                                        }

                                                        if($tablerow==2){
                                                            
                                                            $time_start_val = 'time_start_'.$subno.'_machine'.$cb_id;
                                                            echo '<input id="'.$time_start_val.'" type="text" name="time_start['.$subno.']['.$cb_id.']" value="'.$row[$tablerow][$tablecol].'" readonly class="form-control">';
                                                        }

                                                        /*if($tablerow==3){

                                                            $time_end_val = 'time_end_'.$subno.'_machine'.$cb_id;
                                                            echo '<input id="'.$time_end_val.'" type="text" name="time_end['.$subno.']['.$cb_id.']" value="'.$row[$tablerow][$tablecol].'" class="timepicker form-control">';
                                                        }*/

                                                        if($tablerow==3){ //if($tablerow==4){

                                                            $select_default = 'selected';
                                                            $pass_select = '';
                                                            $fail_select = '';
                                                            $result_id_val = 'rc_result_'.$subno.'_machine'.$cb_id;

                                                            if($row[$tablerow][$tablecol] !== ''){
                                                                $pass_select = $row[$tablerow][$tablecol]==1?'selected':'';
                                                                $fail_select = $row[$tablerow][$tablecol]==0?'selected':'';
                                                            }

                                                            echo '<div class="selectresult">';
                                                                echo '<select id="'.$result_id_val.'" class="form-control show-tick"'.(@$section['S3.2']['de']?'':'disabled').' '.$disabled_input.' name="rc_result['.$subno.']['.$cb_id.']">';
                                                                echo '    <option value="" disabled '.$select_default.'>-- Please Select --</option>';
                                                                echo '    <option value="1" '.$pass_select.'>PASS</option>';
                                                                echo '    <option value="0" '.$fail_select.'>FAIL</option>';
                                                                echo '</select>';
                                                            echo '</div>';
                                                        }
                                                    } //end of ELSE 

                                                    if($tablerow==0){
                                                        echo '</th>';
                                                    }else{
                                                        echo '</td>';
                                                    }
                                                }
                                                echo '</tr>';
                                            }
                                            echo '</table>';
                                        ?>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="remarks" name="remarks[<?php echo $subno;?>]" class="form-control" value="<?php echo @$rcsubmissiondata->remarks; ?>" <?php echo @$section['S3.2']['de']?'':'disabled';?>>
                                                    <label class="form-label">Remarks</label>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row clearfix">
                                            <div class="col-md-12 col-sm-12">
                                                <h5>APPROVAL <i>(Leader & Above)</i></h5>
                                                <label class="form-label">MACHINE STATUS</label>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="radio" id="machine_status1[<?php echo $subno;?>]" name="machine_status[<?php echo $subno;?>]" class="with-gap" value="1" <?php if (@$rcsubmissiondata->machine_status == '1') echo 'checked';?> <?php echo @$section['S3.5']['de']?'':'disabled';?>> 
                                                    <label for="machine_status1[<?php echo $subno;?>]">RUN</label>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="approval_user_id" name="approval_user_id[<?php echo $subno;?>]" class="form-control" value="<?php echo @$data->user->{@$rcsubmissiondata->approval_user_id}; ?>" disabled>
                                                            <input type="hidden" name="approval_user_id[<?php echo $subno;?>]" value="<?php echo @$rcsubmissiondata->approval_user_id;?>" >  
                                                            <label class="form-label">APPROVED BY</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="radio" id="machine_status2[<?php echo $subno;?>]" name="machine_status[<?php echo $subno;?>]" class="with-gap" value="0" <?php if (@$rcsubmissiondata->machine_status == '0') echo 'checked';?> <?php echo @$section['S3.5']['de']?'':'disabled';?>> 
                                                    <label for="machine_status2[<?php echo $subno;?>]">STOP</label>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" id="machine_stop_reason" name="machine_stop_reason[<?php echo $subno;?>]" class="form-control" value='<?php echo @$rcsubmissiondata->machine_stop_reason;?>' <?php echo @$section['S3.5']['de']?'':'disabled';?>> 
                                                            <label class="form-label">IF STOP, REASON:</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php 

                                    echo "<!-- END of TAB $subno -->";
                                    $rcsubmissiondata = null;
                                }
                                ?>
                            </div>
                            <input type="hidden" name="machine_breakdown_id" value="<?php echo @$data->id;?>" />
                            <div class="pull-right">

                                <?php if(@count($data->submit_button->s3)>0){
                                    foreach($data->submit_button->s3 as $form){
                                ?>
                                    <button id="form" type="submit" name="submit" value="<?php echo $form->value;?>" class="btn btn-success m-t-15 waves-effect"><?php echo $form->name;?></button>
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                    <?php 

                        if(@count($data->submit_button->s3)>0){

                            $form = $data->submit_button->s3;
                            echo form_close();
                        }
                    ?>
            </div>
        </div>
    </div>
</div>

