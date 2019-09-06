<!-- [TABS] -->
<div class="body">
<!-- Nav tabs -->
<ul id="eng_tab2" class="nav nav-tabs" role="tablist">
   
   <?php

        for($i = 0; $i < count($submissionlist); $i++ ){
            echo '<li role="presentation" class="'.($i==0?'active':'').'">
            <a href="#sub'.($i+1).'" data-toggle="tab" aria-expanded="false">
                <i class="material-icons">insert_drive_file</i>'.($i+1).' Submission
            </a>
        </li>';
        }

    ?>
   <li role="presentation">
      <a href="javascript:void(0);" id="add_sub">
      <span class="btn btn-success"><i class="material-icons">add</i>NEW</span>
      </a>
      <!-- <a href="javascript:;" id="add_sub1">
         <span class="btn btn-success">TEST</span>
         </a> -->
   </li>
</ul>
<!-- Tab panes -->
<div class="tab-content" id="eng_content2">
<!-- TAB 0 -->
<div role="tabpanel" class="tab-pane fade" id="sub">
   <div class="col-md-12 col-sm-12">
      <div class="form-group form-float">
         <div class="form-line">
            <textarea id="root_cause" name="root_cause[]" class="form-control"></textarea>
            <label class="form-label">ROOT CAUSE</label>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-sm-12">
      <div class="form-group form-float">
         <div class="form-line">
            <textarea id="corrective_action" name="corrective_action[]" class="form-control"></textarea>
            <label class="form-label">CORRECTIVE ACTION</label>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-4">
      <div class="form-group form-float">
         <div class="form-line">
            <input type="text" id="rcfa_pic_user" name="rcfa_pic_user[]" class="form-control" value="Ashok">
            <label class="form-label">PERSON IN-CHARGE</label>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-4">
      <div class="form-group form-float">
         <div class="form-line">
            <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng[]" class="form-control" value="Ashok">
            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-4">
      <div class="form-group form-float">
         <div class="form-line">
            <input type="text" id="rcfa_approved_by" name="rcfa_approved_by[]" class="form-control">
            <label class="form-label">APPROVED BY <i>Leader & Above</i></label>
         </div>
      </div>
   </div>
   <b class="qasubmission">QA Inspection Data - 0st Submission</b>
   <div class="form-group form-float">
      <br/>
      <div class="form-line">
         <input type="text" id="submit_by" name="submit_by[]" class="form-control" value="Ashok">
         <label class="form-label">Submit By:</label>                                                    
      </div>
   </div>
   <table class="table table-hover table-bordered rootcause-form">
      <tr>
         <th>ITEM INSPECTION</th>
         <th align="center"><input type="checkbox" id="insp_machine_1_machine" name="qa_insp_machine[1]" class="filled-in checkbox-tab">
            <label for="insp_machine_1_machine"></label>CMM
         </th>
         <th align="center"><input type="checkbox" id="insp_machine_2_machine" name="qa_insp_machine[2]" class="filled-in checkbox-tab">
            <label for="insp_machine_2_machine"></label>EDI
         </th>
         <th align="center"><input type="checkbox" id="insp_machine_3_machine" name="qa_insp_machine[3]" class="filled-in checkbox-tab">
            <label for="insp_machine_3_machine"></label>AIR GAUGE
         </th>
         <th align="center"><input type="checkbox" id="insp_machine_4_machine" name="qa_insp_machine[4]" class="filled-in checkbox-tab">
            <label for="insp_machine_4_machine"></label>GO NO GO
         </th>
         <th align="center"><input type="checkbox" id="insp_machine_5_machine" name="qa_insp_machine[5]" class="filled-in checkbox-tab">
            <label for="insp_machine_5_machine"></label>QV
         </th>
         <th align="center"><input type="checkbox" id="insp_machine_6_machine" name="qa_insp_machine[6]" class="filled-in checkbox-tab">
            <label for="insp_machine_6_machine"></label>MP
         </th>
         <th align="center"><input type="checkbox" id="insp_machine_7_machine" name="qa_insp_machine[7]" class="filled-in checkbox-tab">
            <label for="insp_machine_7_machine"></label>VISUAL
         </th>
      </tr>
      <tr>
         <td>Inspect By</td>
         <td>
            <div class="selectresult">
               <select id="inspect_by1_" class="form-control show-tick" name="inspect_by[1][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="inspect_by2_" class="form-control show-tick" name="inspect_by[2][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="inspect_by3_" class="form-control show-tick" name="inspect_by[3][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="inspect_by4_" class="form-control show-tick" name="inspect_by[4][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="inspect_by5_" class="form-control show-tick" name="inspect_by[5][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="inspect_by6_" class="form-control show-tick" name="inspect_by[6][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="inspect_by7_" class="form-control show-tick" name="inspect_by[7][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="8">Jaydul Hasan</option>
                  <option value="13">Anggia Permata</option>
                  <option value="14">Tannya Rahmadani</option>
                  <option value="15">Rabiul Islam</option>
                  <option value="18">Abu Sayd</option>
                  <option value="19">Joy Ahamed</option>
                  <option value="21">Ade Rahmadani</option>
                  <option value="23">Syarifah Wahyuni</option>
                  <option value="24">Santa Klara Barus</option>
                  <option value="26">Riaz Uddin</option>
                  <option value="27">MD. Azaharul</option>
               </select>
            </div>
         </td>
      </tr>
      <tr>
         <td>Time Start</td>
         <td><input id="time_start1_" type="text" name="time_start[1][]" class="timepicker form-control"></td>
         <td><input id="time_start2_" type="text" name="time_start[2][]" class="timepicker form-control"></td>
         <td><input id="time_start3_" type="text" name="time_start[3][]" class="timepicker form-control"></td>
         <td><input id="time_start4_" type="text" name="time_start[4][]" class="timepicker form-control"></td>
         <td><input id="time_start5_" type="text" name="time_start[5][]" class="timepicker form-control"></td>
         <td><input id="time_start6_" type="text" name="time_start[6][]" class="timepicker form-control"></td>
         <td><input id="time_start7_" type="text" name="time_start[7][]" class="timepicker form-control"></td>
      </tr>
      <tr>
         <td>Time End</td>
         <td><input id="time_end1_" type="text" name="time_end[1][]" class="timepicker form-control"></td>
         <td><input id="time_end2_" type="text" name="time_end[2][]" class="timepicker form-control"></td>
         <td><input id="time_end3_" type="text" name="time_end[3][]" class="timepicker form-control"></td>
         <td><input id="time_end4_" type="text" name="time_end[4][]" class="timepicker form-control"></td>
         <td><input id="time_end5_" type="text" name="time_end[5][]" class="timepicker form-control"></td>
         <td><input id="time_end6_" type="text" name="time_end[6][]" class="timepicker form-control"></td>
         <td><input id="time_end7_" type="text" name="time_end[7][]" class="timepicker form-control"></td>
      </tr>
      <tr>
         <td>Result</td>
         <td>
            <div class="selectresult">
               <select id="rc_result1_" class="form-control show-tick" name="rc_result[1][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="rc_result2_" class="form-control show-tick" name="rc_result[2][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="rc_result3_" class="form-control show-tick" name="rc_result[3][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="rc_result4_" class="form-control show-tick" name="rc_result[4][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="rc_result5_" class="form-control show-tick" name="rc_result[5][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="rc_result6_" class="form-control show-tick" name="rc_result[6][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
         <td>
            <div class="selectresult">
               <select id="rc_result7_" class="form-control show-tick" name="rc_result[7][]">
                  <option value="" disabled selected>-- Please Select --</option>
                  <option value="1">PASS</option>
                  <option value="0">FAIL</option>
               </select>
            </div>
         </td>
      </tr>
   </table>
</div>
<!-- END of TAB 0 -->

<?php
                                    
foreach($submissionlist as $i => $rcsubmissiondata){

    $subno = $i+1;
    $submissionid = $rcsubmissiondata->submission_id;

    echo "<!-- TAB $subno -->";

?>

<div role="tabpanel" class="tab-pane fade in active" id="sub<?php echo $subno;?>">

   <div class="col-md-12 col-sm-12">
      <div class="form-group form-float">
         <div class="form-line">
            <textarea id="root_cause" name="root_cause[1][]" class="form-control">
            <?php echo $rcsubmissiondata->root_cause;?>
            </textarea>
            <label class="form-label">ROOT CAUSE</label>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-sm-12">
      <div class="form-group form-float">
         <div class="form-line">
            <textarea id="corrective_action" name="corrective_action[1][]" class="form-control">
            <?php echo $rcsubmissiondata->corrective_action;?>
            </textarea>
            <label class="form-label">CORRECTIVE ACTION</label>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-4">
      <div class="form-group form-float">
         <div class="form-line">
            <input type="text" id="rcfa_pic_user" name="rcfa_pic_user[1][]" class="form-control" value="<?php echo $user[$rcsubmissiondata->rcfa_pic_user_id];?>">
            <label class="form-label">PERSON IN-CHARGE</label>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-4">
      <div class="form-group form-float">
         <div class="form-line">
            <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng[1][]" class="form-control" value="<?php echo $user[$rcsubmissiondata->rcfa_ack_by_eng];?>">
            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
         </div>
      </div>
   </div>
   <div class="col-md-4 col-sm-4">
      <div class="form-group form-float">
         <div class="form-line">
            <input type="text" id="rcfa_approved_by" name="rcfa_approved_by[1][]" class="form-control">
            <label class="form-label">APPROVED BY <i>Leader & Above</i></label>
         </div>
      </div>
   </div>
   <b>QA Inspection Data - Submission <?php echo $subno;?></b>
   <div class="form-group form-float">
      <br/>
      <div class="form-line">
         <input type="text" id="submit_by" name="submit_by[1][]" class="form-control" value="<?php echo $user[$rcsubmissiondata[$i]->completion_user_id];?>">
         <label class="form-label">Submit By:</label>                                              
      </div>
   </div>

    <?php

    $row[0][0] = 'ITEM INSPECTION';
    $row[1][0] = 'Inspect By';
    $row[2][0] = 'Time Start';
    $row[3][0] = 'Time End';
    $row[4][0] = 'Result';

    foreach($inspection_machine as $m_index => $inspectionmachine)
    {
        $table_col = $m_index+1;
        $cb_id = $inspectionmachine->id;
        $cb_name = $inspectionmachine->name;
        $cb_checked = '';
        $input_insp_by = '';
        $input_time_start = '';
        $input_time_end = '';
        $input_result = '';

        foreach($inspdata as $j => $dataobject){
            $db_cb_id = $dataobject->inspection_machine_id;
            $db_cb_sumbission_id = $dataobject->root_cause_submission_id;

            if($cbid == $db_cb_id and $db_cb_sumbission_id == $submissionid)
            {
                $cb_checked = 'checked';
                $input_insp_by = $dataobject->inspectby_user_id;
                $input_time_start = $dataobject->time_start;
                $input_time_end = $dataobject->time_end;
                $input_result = $dataobject->result;
            }
        }
        
        $row['id'][$table_col] = $cb_id;
        $row['name'][$table_col] = $cb_name;
        $row[0][$table_col] = $cb_checked;
        $row[1][$table_col] = $input_insp_by;
        $row[2][$table_col] = $input_time_start;
        $row[3][$table_col] = $input_time_end;
        $row[4][$table_col] = $input_result;
        
    }


    //generate table
    echo '<table class="table table-hover table-bordered rootcause-form">';
    for($tablerow=0;$tablerow<5;$tablerow++)
    {
        echo '<tr>';
        for($tablecol=0;$tablecol<count($tablerow[0]);$tablecol++)
        {
            if($tablerow!=0){
                echo '<td>';
            }

            if($tablecol==0){
                echo '<th>';
                echo $row[$tablerow][$table_col];
                continue;
            }

            $cb_id = $row['id'][$table_col];
            $cb_name = $row['name'][$table_col];

            if($tablerow==0){

                echo '<th align="center">';
                echo '<input type="checkbox" id="insp_machine'.$cb_id.'" name="qa_insp_machine['.$subno.']['.$cb_id.']" class="filled-in checkbox-tab" '.$cb_checked.'>';
                echo '<label for="insp_machine'.$cb_id.'"></label>'.$cb_name.'</th>';

            }

            if($tablerow==1){
                $input_insp_by = $row[$tablerow][$table_col];
                $select_default = 'selected';

                if($input_insp_by != ''){
                    $select_default = '';
                }
                echo '<div class="selectresult">';
                echo '<select id="inspect_by'.$cb_id.'_" class="form-control show-tick" name="inspect_by['.$subno.']['.$cb_id.']">';
                echo '<option value="" disabled '.$select_default.'>-- Please Select --</option>';
                foreach($inspect_by as $inspectby)
                {   
                    $user_selected = ($input_insp_by != '' AND $input_insp_by==$inspectby['id'])?'selected':'';
                    echo '<option value="'.$inspectby['id'].'" '.$user_selected.'>'.$inspectby['fullname'].'</option>';
                }
                echo '</select>';
            }

            if($tablerow==2){
                echo '<input id="time_start'.$cb_id.'_" type="text" name="time_start['.$subno.']['.$cb_id.']" value="'.$row[$tablerow][$table_col].'" class="timepicker form-control">';
            }

            if($tablerow==3){
                echo '<input id="time_end'.$cb_id.'_" type="text" name="time_end['.$subno.']['.$cb_id.']" value="'.$row[$tablerow][$table_col].'" class="timepicker form-control">';
            }

            if($tablerow==4){

                $select_default = 'selected';
                $pass_select = '';
                $fail_select = '';

                if($row[$tablerow][$table_col] != ''){
                    $pass_select = $row[$tablerow][$table_col]==1?'selected':'';
                    $fail_select = $row[$tablerow][$table_col]==0?'selected':'';
                }

                echo '<div class="selectresult">';
                echo '<select id="rc_result'.$cb_id.'_" class="form-control show-tick" name="rc_result['.$subno.']['.$cb_id.']">';
                echo '    <option value="" disabled '.$select_default.'>-- Please Select --</option>';
                echo '    <option value="1" '.$pass_select.'>PASS</option>';
                echo '    <option value="0" '.$fail_select.'>FAIL</option>';
                echo '</select>';
                echo '</div>';
            }

            if($tablerow==0){
                echo '</th>';
            }
            else{
                echo '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';



<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | JCY PQM - Product Quality System</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url('assets/templates/plugins/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url('assets/templates/plugins/node-waves/waves.css')?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url('assets/templates/plugins/animate-css/animate.css')?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url('assets/templates/css/style.css')?>" rel="stylesheet">

    
</head>


<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $password = ($this->session->userdata['logged_in']['password']);
        $fullname = ($this->session->userdata['logged_in']['fullname']);
        } 
        else {
          redirect('/login', 'refresh');
          // header("location: /login");
        }

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i> Machine Break Down Form</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Machine Break Down Form
                                <small>Update: 16 Oct 2017, Doc No.: IPQA-MB-018, Revision: 05</small>
                            </h2>
                            
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        QAN No:
                                        <!-- <span class="badge">00001</span> -->
                                       <input type="text" id="qan_no" name="qan_no" class="form-control" value="<?php echo $listmrbform[0]->qan_no;?>"/>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        Status
                                        <!-- <span class="badge">New</span> -->
                                        <input type='text' id='status' name='status' class='form-control' value='<?php echo $listmrbform[0]->status;?>'/>
                                    </button>
                                </li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                                
                            </ul>
                            
                        </div>
                        <div class="body">
      
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="issued_by_user" name="issued_by_user" class="form-control" value='<?php echo $user[$listmrbform[0]->issueby_user_id];?>'/>
                                                <label class="form-label">ISSUED BY</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="issueto_user" name="issueto_user" class="form-control" value='<?php echo $user[$listmrbform[0]->issueto_user];?>'/>
                                                <label class="form-label">TO</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="datetime" name="datetime" class="datetimepicker form-control" value='<?php echo $listmrbform[0]->datetime;?>'/>
                                                <label class="form-label">DATETIME</label>
                                            </div>
                                        </div>
                                        <input type="checkbox" id="ooc" name="ooc" class="filled-in" value="1" <?php if ($listmrbform[0]->ooc == '1') echo 'checked';?>>
                                        <label for="ooc">OOC (OUT OF CONTROL)</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ISSUED DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="issued_dept" name="issued_dept" class="form-control" value='<?php echo $listmrbform[0]->issued_dept;?>'/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">TO DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="to_dept" name="to_dept" class="form-control" value='<?php echo $listmrbform[0]->to_dept;?>'/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">SHIFT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="shift" name="shift" class="form-control" value='<?php echo $listmrbform[0]->shift;?>'/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                            <input type="checkbox" id="oos" name="oos" class="filled-in" value="1" <?php if ($listmrbform[0]->oos == '1') echo 'checked';?>>
                                            <label for="oos">OOS (OUT OF SPEC)</label>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <h5>DEFECT INFORMATION <i>(To be filled in by QA)</i></h5><br/>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                            <label class="form-label">PART NAME</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="part_name" name="part_name" class="form-control" value='<?php echo $partname[$listmrbform[0]->part_name];?>'/>
                                                </div>
                                            </div>
                                        </div><br/>
                                        <div class="form-group form-float"><br/>
                                            <div class="form-line">
                                                <input type="text" id="cav_no" name="cav_no" class="form-control">
                                                <label class="form-label">CAV NO (if any)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_no" name="machine_no" class="form-control" value='<?php echo $listmrbform[0]->machine_no;?>'/>
                                                <label class="form-label">M/C NO</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="up_affected" name="up_affected" class="form-control" value='<?php echo $listmrbform[0]->up_affected;?>'/>
                                                <label class="form-label">UP AFFECTED</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">PROCESS</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="process" name="process" class="form-control" value='<?php echo $procees[$listmrbform[0]->process];?>'/>
                                                </div>
                                            </div>
                                        </div><br/>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">DETECTED BY</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="detectedby_user" name="detectedby_user" class="form-control" value='<?php echo $user[$listmrbform[0]->detectedby_user];?>'/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea id="defect_description" name="defect_description" class="form-control"><?php echo $listmrbform[0]->defect_description;?></textarea>
                                                <label class="form-label">DEFECT DESCRIPTION</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="last_passed_sample" name="last_passed_sample" class="datetimepicker form-control" value='<?php echo $listmrbform[0]->last_passed_sample;?>'/>
                                                <label class="form-label">LAST PASSED SAMPLE DATETIME</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY ENGINEERING<i>(Tech & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="ack_eng_user" name="ack_eng_user" class="form-control" value='<?php echo $user[$listmrbform[0]->ack_eng_user];?>'/>
                                                </div>
                                            </div>
                                        </div><br/>
                                    </div> 
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="purge_from" name="purge_from" class="datetimepicker form-control" value='<?php echo $listmrbform[0]->purge_from;?>'/>
                                                <label class="form-label">PURGE FROM DATETIME</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY PRODUCTION<i>(Leader & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="ack_prod_user" name="ack_prod_user" class="form-control" value='<?php echo $user[$listmrbform[0]->ack_prod_user];?>'/>
                                                </div>
                                            </div>
                                        </div><br/> 
                                        <div class="col-md-12 col-sm-12">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" class="text-center">Production</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                        
                                                        foreach($prod_loc as $prodloc)
                                                        {
                                                    echo "<tr>";    
                                                        echo "<td>".$prodloc->location_name."</td>";
                                                        echo "<td>";
                                                            echo "<input type='number' id='input_qty_prod' value='' name='input_qty_prod[$prodloc->id]' class='form-control' disabled>";
                                                        echo "</td>";
                                                    echo "</tr>";
                                                    
                                                        }
                                                        ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <td><b>Total</b></td>
                                                    <td><input type = "text" id ="total_prod" name = "total_prod" class="form-control" readonly></td>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="estimate_qty" name="estimate_qty" class="form-control" value='<?php echo $listmrbform[0]->estimate_qty;?>'/>
                                                <label class="form-label">ESTIMATE QTY</label>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY QC/QA <i>(Leader & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="ack_qa_user" name="ack_qa_user" class="form-control" value='<?php echo $user[$listmrbform[0]->ack_qa_user];?>'/>
                                                </div>
                                            </div>
                                        </div><br/> 
                                        <div class="col-md-12 col-sm-12">
                                            <table class="table table-hover table-bordered qasample-form">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" class="text-center">QA Sample</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Location</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php 
                                                        
                                                        
                                                        foreach($qa_sample_loc as $qasampleloc)
                                                        {
                                                            foreach($listmrbform as $qty => $data2){
                                                                if ($data2->qa_sample_id == $qasampleloc->id){
                                                                    $tempqty = $data2->quantity;
                                                                    break;
                                                                }else{
                                                                    $tempqty = 0;
                                                                }
                                                            }

                                                    echo "<tr>";    
                                                        echo "<td>".$qasampleloc->location_name."</td>";
                                                        echo "<td>";
                                                            echo "<input type='number' value='$tempqty' name='input_qty_qasample[$qasampleloc->id]' class='form-control input_qty_qasample'>";
                                                        echo "</td>";
                                                    echo "</tr>";
                                                    
                                                        }
                                                        ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td><input type = "type" id ="total_qa_sample" name = "total_qa_sample" class="form-control" readonly></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div> 
                                    
                                    <div class="clearfix"></div>
                                    
                                    <!-- <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Save changes</button> -->
                                   
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Material Review Board Form                           
                            </h2>
                        </div>
                        <div class="body">   
                            <div class="row clearfix">
                                <div class="clearfix"></div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="col-md-8 col-sm-8">
                                            <table class="table table-hover table-bordered mrb-form">
                                                <thead>
                                                    <tr>
                                                        <th>LOCATION TO PURGE</th>
                                                        <th>ACTION</th>
                                                        <th>AFFECTED QTY</th>
                                                        <th>SORTING RESULT - GOOD QTY</th>
                                                        <th>SORTING RESULT - REJ QTY</th>
                                                        <th>PROD.PIC (LEADER & ABOVE)</th>
                                                        <th>QA BUY-OFF (LEADER & ABOVE)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                        
                                                        foreach($loc_to_purge as $loctopurge)
                                                        {
                                                            foreach($listmrbform as $qty => $data3){

                                                                if ($data3->purge_location_id == $loctopurge->id){
                                                                    $tempqty1 = $data3->affected_qty;
                                                                    $tempqty2 = $data3->good_qty;
                                                                    $tempqty3 = $data3->reject_qty;
                                                                    break;
                                                                }else{
                                                                    $tempqty1 = 0;
                                                                    $tempqty2 = 0;
                                                                    $tempqty3 = 0;
                                                                }
                                                            }
                                                        echo '
                                                        <tr>
                                                            <td>'.$loctopurge->process_name.'</td>
                                                            <td align="center">
                                                                <input type="checkbox" id="loc_purge'.$loctopurge->id.'" name="loc_purge['.$loctopurge->id.']" class="filled-in checkbox-active" '.($tempqty1 > 0 ? 'checked':'').'>
                                                                <label for="loc_purge'.$loctopurge->id.'"></label>
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-affqty" name="aff_qty['.$loctopurge->id.']" value="'.$tempqty1.'" class="form-control" disabled>
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-goodqty" name="good_qty['.$loctopurge->id.']" value="'.$tempqty2.'" class="form-control good-total">
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-rejqty" name="rej_qty['.$loctopurge->id.']" value="'.$tempqty3.'" class="form-control reject-total">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="prod_pic" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="qa_buy_off" class="form-control">
                                                            </td>
                                                        </tr>
                                                            ';
                                                        }
                                                        ?>

                                                    <tr>
                                                        <td>QA Sample</td>
                                                        <td></td>
                                                        <td>
                                                            <input type="text" id="total-affqty" name="qa_sample_affected_qty" class="form-control qasample-qty" value='<?php echo $totalquantity;?>'>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="total-goodqty" name="qa_sample_good_qty" class="form-control qasample-qty" value="<?php echo $listmrbform[0]->qa_sample_good_qty;?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" id="total-rejqty" name="qa_sample_reject_qty" class="form-control qasample-qty" value="<?php echo $listmrbform[0]->qa_sample_reject_qty;?>">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="qa_sample_prod_pic" value="" class="form-control qasample-qty">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="qa_sample_buy_off" value="" class="form-control qasample-qty">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>TOTAL</td>
                                                        <td></td>
                                                        <!-- <td id="total_affected_qty"></td> -->
                                                        <td><input type = "type" id ="total_affected_qty" name = "total_affected_qty" class="form-control total_affected_qty" readonly></td>
                                                        <!-- <td id="total_good_qty"></td> -->
                                                        <td><input type = "type" id ="total_good_qty" name = "total_good_qty" class="form-control total_good_qty" readonly></td>
                                                        <!-- <td id="total_reject_qty"></td> -->
                                                        <td><input type = "type" id ="total_rej_qty" name = "total_rej_qty" class="form-control total_rej_qty" readonly></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h5>DEFECTIVE PART DISPOSITION</h5>
                                            <input type="checkbox" id="scrap" name="scrap" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($listmrbform[0]->scrap == '1') echo 'checked';?>/>
                                            <label for="scrap">SCRAP</label>
                                            <input type="checkbox" id="rework" name="rework" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($listmrbform[0]->rework == '1') echo 'checked';?>/>
                                            <label for="rework">REWORK</label>
                                            <input type="checkbox" id="UAI" name="UAI" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($listmrbform[0]->uai == '1') echo 'checked';?>/>
                                            <label for="UAI">UAI</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="rework_order" name="rework_order" class="form-control" value='<?php echo $listmrbform[0]->rework_order_no;?>' disabled /> 
                                                    <label class="form-label">Rework order #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="scrap_no" name="scrap_no" class="form-control" value='<?php echo $listmrbform[0]->scrap_no;?>' disabled /> 
                                                    <label class="form-label">Scrap #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="UAI_no" name="UAI_no" class="form-control" required="required" value='<?php echo $listmrbform[0]->uai_no;?>' disabled />
                                                    <label class="form-label">UAI #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <tr>
                                                    <th colspan="3" class="text-center">REWORK DISPOSITION</th>
                                                </tr>
                                                <tr>
                                                    <th>Input</th>
                                                    <th>Output</th>
                                                    <th>Reject & Scrap</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="input_rework_uai" name="input_rework_uai" class="form-control" value='<?php echo $listmrbform[0]->rework_dispo_input;?>' disabled />
                                                    </td>
                                                    <td>
                                                        <input type="text" id="output_rework_uai" name="output_rework_uai" class="form-control" value='<?php echo $listmrbform[0]->rework_dispo_output;?>' disabled/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="rej_scrap" name="rej_scrap" class="form-control rework-open" value='<?php echo $listmrbform[0]->rework_dispo_rej_scrap;?>' disabled/>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="reported_by_mrb" name="reported_by_mrb" class="form-control" value='<?php echo $user[$listmrbform[0]->reportby_user_id];?>'/>
                                                    <label class="form-label">Reported by:<i>(MRB)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="qa_reinsp_verification_user_id" name="qa_reinsp_verification_user_id" class="form-control">
                                                    <label class="form-label">QA Re-inspection Verification:<i>(Leader & Above)</i></label>
                                                </div>
                                            </div>
                                            <input type="radio" id="qa_reinsp_accept" name="qa_reinsp_select" class="with-gap" value="1">
                                            <label for="qa_reinsp_accept">Accept</label>
                                            <input type="radio" id="qa_reinsp_reject" name="qa_reinsp_select" class="with-gap" value="0">
                                            <label for="qa_reinsp_reject">Reject</label>
                                            <input type="text" id="input_reject" name="input_reject" class="form-control" placeholder="If Reject,Reason" disabled />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="machine_breakdown_id" value="<?php echo $machine_breakdown_id;?>" />
                                    <!-- <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button> -->
                                <div class="row clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- Vertical Layout | With Floating Label -->

<!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h5>
                                ROOT CAUSE FAILURE ANALYSIS <i>(BY PROCESS OWNER)</i>                           
                            </h5>
                        </div>
                        <div class="body"> 

                        <form method="post" action="<?php echo base_url().'FrontEnd/rootcausefailureform' ?>"> 
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="root_cause" name="root_cause" class="form-control"></textarea>
                                            <label class="form-label">ROOT CAUSE</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="corrective_action" name="corrective_action" class="form-control"></textarea>
                                            <label class="form-label">CORRECTIVE ACTION</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_pic_user" name="rcfa_pic_user" class="form-control" value="<?php echo $fullname; ?>">
                                            <label class="form-label">PERSON IN-CHARGE</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng" class="form-control" value="<?php echo $fullname; ?>">
                                            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_approved_by" name="rcfa_approved_by" class="form-control">
                                            <label class="form-label">APPROVED BY <i>Leader & Above</i></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- [TABS] -->
                                <div class="body">
                                <!-- Nav tabs -->
                                <ul id="eng_tab1" class="nav nav-tabs tab-nav-right" role="tablist">
                                    <li role="presentation" class="active"><a href="#rc_tab" data-toggle="tab">HOME</a></li>
                                    <li role="presentation"><a href="#rc_tab1" data-toggle="tab">PROFILE</a></li>
                                    <li role="presentation"><a href="#rc_tab2" data-toggle="tab">MESSAGES</a></li>
                                    <li role="presentation"><a href="#rc_tab3" data-toggle="tab">SETTINGS</a></li>
                                    <li role="presentation"><a href="javascript:void(0);" id="add_sub"><span class="btn btn-success"><i class="material-icons">add</i>NEW</span></a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content" id="eng_content2">

                                <!-- TAB 1 -->
                                <div role="tabpanel" class="tab-pane fade in active" id="rc_tab">
                                    <b>QA Inspection Data - 1st Submission</b>
                                        <div class="form-group form-float"><br/>
                                            <div class="form-line">
                                                <input type="text" id="submit_by" name="submit_by" class="form-control">
                                                <label class="form-label">Submit By:</label>                                                    
                                            </div>
                                        </div>
                                        <table class="table table-hover table-bordered rootcause-form">
                                                
                                            <?php 
                                                echo '<tr>';
                                                    echo '<th>ITEM INSPECTION</th>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        
                                                        echo '
                                                            <th align="center"><input type="checkbox" id="insp_machine'.$inspectionmachine->id.'" name="qa_insp_machine'.$inspectionmachine->id.'" class="filled-in checkbox-tab">
                                                                <label for="insp_machine'.$inspectionmachine->id.'"></label>'.$inspectionmachine->name.'
                                                            </th>
                                                        ';
                                                            
                                                    }
                                                echo '</tr>';
                                            ?>

                                            <?php 
                                                echo '<tr>';
                                                    echo '<td>Inspect By</td>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '<td>';
                                                            echo '<div class="selectresult">';
                                                                
                                                                echo '
                                                                    <select class="form-control show-tick" name="inspect_by['.$inspectionmachine->id.']">';
                                                                    echo '<option value="" disabled selected>-- Please Select --</option>';
                                                                    foreach($inspect_by as $inspectby)
                                                                    {   
                                                                        echo '<option value="'.$inspectby['id'].'">'.$inspectby['fullname'].'</option>';
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
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '
                                                            <td><input type="text" name="time_start['.$inspectionmachine->id.']" class="timepicker form-control"></td>
                                                            
                                                        ';
                                                    }
                                                echo '</tr>';
                                            ?>

                                            <?php 
                                                echo '<tr>';
                                                    echo '<td>Time End</td>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '
                                                            <td><input type="text" name="time_end['.$inspectionmachine->id.']" class="timepicker form-control"></td>
                                                            
                                                        ';
                                                    }
                                                echo '</tr>';
                                            ?>

                                            <?php 
                                                echo '<tr>';
                                                    echo '<td>Result</td>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '<td>';
                                                            echo '<div class="selectresult">';
                                                                
                                                                echo '
                                                                        <select class="form-control show-tick" name="rc_result['.$inspectionmachine->id.']">
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
                                </div>
                                <!-- END of TAB1 -->

                                <!-- TAB 0 -->
                                <div role="tabpanel" class="tab-pane fade" id="sub">
                                    <b class="qasubmission">QA Inspection Data - 0st Submission</b>
                                    
                                        <div class="form-group form-float"><br/>
                                            <div class="form-line">
                                                <input type="text" id="submit_by" name="submit_by" class="form-control">
                                                <label class="form-label">Submit By:</label>                                                    
                                            </div>
                                        </div>
                                        <table class="table table-hover table-bordered rootcause-form">
                                                
                                            <?php 
                                                echo '<tr>';
                                                    echo '<th>ITEM INSPECTION</th>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        
                                                        echo '
                                                            <th align="center"><input type="checkbox" id="cb_'.$inspectionmachine->id.'_machine" name="qa_insp_machine'.$inspectionmachine->id.'" class="filled-in checkbox-tab">
                                                                <label for="cb_'.$inspectionmachine->id.'_machine"></label>'.$inspectionmachine->name.'
                                                            </th>
                                                        ';
                                                            
                                                    }
                                                echo '</tr>';
                                            ?>

                                            <?php 
                                                echo '<tr>';
                                                    echo '<td>Inspect By</td>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '<td>';
                                                            echo '<div class="selectresult">';
                                                                
                                                                echo '
                                                                    <select id="inspect_by'.$inspectionmachine->id.'_" class="form-control show-tick" name="inspect_by'.$inspectionmachine->id.'[]">';
                                                                    echo '<option value="" disabled selected>-- Please Select --</option>';
                                                                    foreach($inspect_by as $inspectby)
                                                                    {   
                                                                        echo '<option value="'.$inspectby['id'].'">'.$inspectby['fullname'].'</option>';
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
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '
                                                            <td><input id="time_start'.$inspectionmachine->id.'_" type="text" name="time_start'.$inspectionmachine->id.'[]" class="timepicker form-control"></td>
                                                            
                                                        ';
                                                    }
                                                echo '</tr>';
                                            ?>

                                            <?php 
                                                echo '<tr>';
                                                    echo '<td>Time End</td>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '
                                                            <td><input id="time_end'.$inspectionmachine->id.'_" type="text" name="time_end'.$inspectionmachine->id.'[]" class="timepicker form-control"></td>
                                                            
                                                        ';
                                                    }
                                                echo '</tr>';
                                            ?>

                                            <?php 
                                                echo '<tr>';
                                                    echo '<td>Result</td>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        echo '<td>';
                                                            echo '<div class="selectresult">';
                                                                
                                                                echo '
                                                                        <select id="rc_result'.$inspectionmachine->id.'_" class="form-control show-tick" name="rc_result'.$inspectionmachine->id.'[]">
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
                                </div>
                                <!-- END of TAB 0 -->
                            </div>
                        </div>
                                
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12">
                                        <h4 class="alert bg-green text-center">FOR QA USE ONLY</h4>
                                        <h5>APPROVAL <i>(Leader & Above)</i></h5>
                                        <label class="form-label">MACHINE STATUS</label>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 col-sm-6">
                                        <input type="radio" id="machine_status1" name="machine_status" class="with-gap">
                                        <label for="machine_status1">RUN</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_run_pic" name="machine_run_pic" class="form-control">
                                                <label class="form-label">APPROVED BY</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="radio" id="machine_status2" name="machine_status" class="with-gap">
                                        <label for="machine_status2">STOP</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_stop_reason" name="machine_stop_reason" class="form-control">
                                                <label class="form-label">IF STOP, REASON:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    <input type="hidden" name="machine_breakdown_id" value="<?php echo $machine_breakdown_id;?>" />
                                    <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>
                                </div>
                            <!-- </div> -->
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

<!-- Jquery Core Js -->
<script src="<?=base_url('assets/templates/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('/assets/templates/plugins/momentjs/moment.js')?>"></script>
<!-- Bootstrap Date Time Picker Js -->
<script src="<?=base_url('/assets/templates/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')?>"></script>
<script>
//Datetimepicker plugin
$('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
});

$('.datepicker').bootstrapMaterialDatePicker({
    format: 'dddd DD MMMM YYYY',
    clearButton: true,
    weekStart: 1,
    time: false
});

$('.timepicker').bootstrapMaterialDatePicker({
    format: 'HH:mm',
    clearButton: true,
    date: false
});

$('#issued_by_user').attr('disabled', true);

$('#reported_by_mrb').attr('disabled', true);

$('#prod_pic').attr('disabled', true);

$('table.mrb-form').find('input.form-control').hide();

$('table.mrb-form').find("input.checkbox-active:checked").parents('tr').find('input.form-control').show();
    
$('table.mrb-form').find('input.qasample-qty').show();
$('table.mrb-form').find('input.total_affected_qty').show();
$('table.mrb-form').find('input.total_good_qty').show();
$('table.mrb-form').find('input.total_rej_qty').show();

var totalPoints = 0;
$('input.input_qty_qasample').each(function(){
    totalPoints = parseFloat($(this).val()) + totalPoints;
});
$('#total_qa_sample').val(totalPoints);


var totalAffQty = 0;
$('input#total-affqty').each(function(){
    totalAffQty = parseFloat($(this).val()) + totalAffQty;
});
$('#total_affected_qty').val(totalAffQty);

var totalGoodQty = 0;
$('input#total-goodqty').each(function(){
    totalGoodQty = parseFloat($(this).val()) + totalGoodQty;
});
$('#total_good_qty').val(totalGoodQty);

var totalRejQty = 0;
$('input#total-rejqty').each(function(){
    totalRejQty = parseFloat($(this).val()) + totalRejQty;
});
$('#total_rej_qty').val(totalRejQty);

$('div.selectresult, table.rootcause-form input.form-control').each(function(){
    $(this).hide();
});

$('#eng_content2').on('change','input.checkbox-tab',function(e){
    
    var indexCheckbox = $(this).parents('th').index();
    var theId = parseInt($(this).attr('id').replace(/[^\d]/g, ''), 10);
    // alert(theId);
    // $('div#sub'+theId).find('input.form-control, div.selectresult').slideToggle('slow');
    $(this).parents('tr').siblings('tr').find('td:eq('+indexCheckbox+') input.form-control, td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow');
    // $('div.selectresult, table.rootcause-form input.form-control').each(function(){
    // $(this).slideToggle('slow');
    // });


    // $(this).parents().find().each(function(){
        // alert($(this).attr('id'));
    // $(this).parents('tr').siblings().find('td:eq('+indexCheckbox+') input.form-control').slideToggle('slow');
    // $('tr.selectresult.dropdown').find('td:eq('+indexCheckbox+')').slideToggle('slow');
    // $('td div.selectresult:eq('+(indexCheckbox-1)+')').slideToggle('slow');
    // $(this).parents('tr').siblings().find('td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow');
    // });
});

// $('td.header2').hide(); // hide the column header th

// $('tr').each(function(){
//     $(this).find('td:eq('+$('td.header2').index()+')').hide();
// });

// $('#add_sub1').click(function (e) {
//     $('#asma').html('<a href="javascript:;" id="add_sub2"><span class="btn btn-success">Show</span></a>');
//     $('#asma').append('<div id="asma2"><select class="form-control show-tick" name="inspect_by[1]"><option value="" disabled selected>-- Please Select --</option><option value="8">Jaydul Hasan</option><option value="13">Anggia Permata</option><option value="14">Tannya Rahmadani</option><option value="15">Rabiul Islam</option><option value="18">Abu Sayd</option><option value="19">Joy Ahamed</option><option value="21">Ade Rahmadani</option><option value="23">Syarifah Wahyuni</option><option value="24">Santa Klara Barus</option><option value="26">Riaz Uddin</option><option value="27">MD. Azaharul</option></select></div>');
//     $('div#asma2').each(function(){
//     $(this).hide();
//         $( "#add_sub2" ).on( "click", function() {
//             $('div#asma2').slideToggle('slow');
//         });
//     });
//     // $.AdminBSB.browser.activate();
//     // $.AdminBSB.leftSideBar.activate();
//     // $.AdminBSB.rightSideBar.activate();
//     // $.AdminBSB.navbar.activate();
//     $.AdminBSB.dropdownMenu.activate();
//     $.AdminBSB.input.activate();
//     $.AdminBSB.select.activate();
//     $.AdminBSB.search.activate();
// });


$('#add_sub').click(function (e) {
    var nextTab = $('#eng_tab2 li').size();

    // create the tab
    $(this).closest('li')
    .before('<li role="presentation"><a href="#rc_tab'+nextTab+'" data-toggle="tab"><i class="material-icons">insert_drive_file</i>'+ordinal_suffix_of(nextTab)+' Submission</a></li>');

    var $clone = $("#sub").clone();    // Create your clone

    // Get the number at the end of the ID, increment it, and replace the old id
    $clone.attr('id',$clone.attr('id')+nextTab ); 

    $clone.find('b.qasubmission').text('QA Inspection Data - ' +ordinal_suffix_of(nextTab)+' Submission Data')

    // Find all elements in $clone that have an ID, and iterate using each()
    $clone.find('[id]').each(function() { 

    //Perform the same replace as above
    var $th = $(this);
    var $tfor = $(this).siblings('label');
    //var newID = $th.attr('id').replace(/\d+$/, function(str) { return parseInt(str) + 1; });
    var newID = $th.attr('id')+nextTab; 
    $th.attr('id', newID);
    if($tfor.attr('for') != null)
    {
        $tfor.attr('for', newID);
    }
        
    });

    $clone.appendTo('#eng_content2');
    // $.AdminBSB.dropdownMenu.activate();
    $.AdminBSB.input.activate();

    

    // make the new tab active
    $('#eng_tab2 li:nth-child('+nextTab+') a').click();
    
    //$('#add_sub').hide();

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });

});

function ordinal_suffix_of(i) {
    var j = i % 10,
        k = i % 100;
    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
};

</script>

