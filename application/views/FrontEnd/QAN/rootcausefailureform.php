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

     <!-- Sweetalert Css -->
     <link href="<?=base_url('assets/templates/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet" />
    
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

<form method="post" action="<?php echo base_url().'FrontEnd/rootcausefailureform' ?>">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li> -->
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li> -->
                <li><i class="material-icons">library_books</i> Root Cause Failure Analysis Form</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- <form> -->
                                <div class="row clearfix">
                                    <h5>ROOT CAUSE FAILURE ANALYSIS <i>(BY PROCESS OWNER)</i></h5>
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
                                                <input type="text" id="rcfa_pic_user" name="rcfa_pic_user" class="form-control">
                                                <label class="form-label">PERSON IN-CHARGE</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng" class="form-control">
                                                <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <div class="col-md-4">
                                            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                        </div>
                                        <div class="col-md-8">
                                            <select id="rcfa_ack_by_eng" name="rcfa_ack_by_eng" class="form-control show-tick">
                                            <?php
                                                foreach($rcfa_ack_by_eng as $rcfaackbyeng)
                                                {
                                                     echo '<option value="'.$rcfaackbyeng['id'].'">'.$rcfaackbyeng['fullname'].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div><br/> -->
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="rcfa_ack_by_eng" name="rcfa_ack_by_eng" class="form-control show-tick">
                                                <?php
                                                    foreach($rcfa_ack_by_eng as $rcfaackbyeng)
                                                    {
                                                        echo '<option value="'.$rcfaackbyeng['id'].'">'.$rcfaackbyeng['fullname'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">APPROVED BY <i>Supervisor & Above</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="rcfa_approved_by" name="rcfa_approved_by" class="form-control show-tick">
                                                <?php
                                                    foreach($rcfa_approved_by as $rcfaapprovedby)
                                                    {
                                                        echo '<option value="'.$rcfaapprovedby['id'].'">'.$rcfaapprovedby['fullname'].'</option>';
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nav tabs -->
                                    <!-- <form action="#" method="post"> -->
                                    <div class="col-md-12 col-sm-12">
                                        <ul class="nav nav-tabs tab-col-teal" id="eng_tab" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#sub1" data-toggle="tab">
                                                    <i class="material-icons">insert_drive_file</i>1st Submission
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="javascript:;" id="add_sub">
                                                    <span class="btn btn-success"><i class="material-icons">add</i>NEW</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content" id="eng_content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="sub1">
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
                                                            
                                                            
                                                                <th align="center"><input type="checkbox" id="insp_machine'.$inspectionmachine->id.'_1" name="qa_insp_machine'.$inspectionmachine->id.'[]" class="filled-in checkbox-active">
                                                                    <label for="insp_machine'.$inspectionmachine->id.'_1"></label>'.$inspectionmachine->name.'
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
                                                                            <select class="form-control show-tick" name="ra_result['.$inspectionmachine->id.']">
                                                                                <option value="1">PASS</option>
                                                                                <option value="0">FAIL</option>
                                                                            </select>
                                                                            ';
                                                                        
                                                                    echo '</div>';
                                                                echo '</td>';
                                                            }
                                                        echo '</tr>';
                                                    ?>
                                                    <!-- <tr>
                                                        <td>Result</td>
                                                        <td>
                                                            <div class="selectresult">
                                                                <select class="form-control show-tick" name="cmm_res1">
                                                                    <option value="1">PASS</option>
                                                                    <option value="0">FAIL</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="selectresult">
                                                            <select class="form-control show-tick" name="edi_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="selectresult">
                                                            <select class="form-control show-tick" name="ag_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="selectresult">
                                                            <select class="form-control show-tick" name="gng_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="selectresult">
                                                            <select class="form-control show-tick" name="qv_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="selectresult">
                                                            <select class="form-control show-tick" name="mp_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="selectresult">
                                                            <select class="form-control show-tick" name="vis_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                            </div>
                                                        </td>
                                                    </tr> -->
                                                </table>
                                                <!-- <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button> -->
                                            </div>
                                            </div>
                                                <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

            <!-- Vertical Layout | With Floating Label -->

            <!-- Vertical Layout | With Floating Label -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
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
                    </div>
                </div>
            </div>

<!-- Jquery Core Js -->
<script src="<?=base_url('assets/templates/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('/assets/templates/plugins/momentjs/moment.js')?>"></script>
<!-- Bootstrap Date Time Picker Js -->
<script src="<?=base_url('/assets/templates/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')?>"></script>
<script>
$(function() {
    //Textare auto growth
    //autosize($('textarea.auto-growth'));

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

    // $('div.selectresult').each(function(){
    //     $(this).hide();
    // });

    // $("table").on('change','input.checkbox-active',function(e){
        // if ($(this).prop('checked')) {
        //     $(this).parents('tr').siblings().find('input.form-control').fadeIn();
        // } else {
        //     $(this).parents('tr').siblings().find('input.form-control').hide();
        // }
        
        // var indexCheckbox = $(this).parents('th').index();
        // $(this).find('tr').each(function(){
            // alert($(this).attr('id'));
        // $(this).parents('tr').siblings().find('td:eq('+indexCheckbox+') input.form-control').slideToggle('slow');
        // $('tr.selectresult.dropdown').find('td:eq('+indexCheckbox+')').slideToggle('slow');
        //$('td div.selectresult:eq('+(indexCheckbox-1)+')').slideToggle('slow');
        // $(this).parents('tr').siblings().find('td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow');
        // });
    // });

    // $('td.header2').hide(); // hide the column header th

    // $('tr').each(function(){
    //     $(this).find('td:eq('+$('td.header2').index()+')').hide();
    // });
});


$('#add_sub').click(function (e) {
    var nextTab = $('#eng_tab li').size();

    // create the tab
    $(this).closest('li').before('<li role="presentation"><a href="#sub'+nextTab+'" data-toggle="tab"><i class="material-icons">insert_drive_file</i>'+ordinal_suffix_of(nextTab)+' Submission</a></li>');

    // create the tab content
    var format = '<div role="tabpanel" class="tab-pane fade" id="sub'+nextTab+'"><b>' +ordinal_suffix_of(nextTab)+' Submission Data</b></div>';
    var format_table = '';
    format_table = '<div role="tabpanel" class="tab-pane fade in active" id="sub' + nextTab + '">';
    format_table += '<b>QA Inspection Data - ' +ordinal_suffix_of(nextTab)+' Submission Data</b>';
    format_table += '<div class="form-group form-float"><br/>';
    format_table += '<div class="form-line">';
    format_table += '<input type="text" id="submit_by" name="submit_by" class="form-control">';
    format_table += '<label class="form-label">Submit By:</label>';
    format_table += '</div>';
    format_table += '</div>';
    format_table += '<table class="table table-hover table-bordered rootcause-form">';
                        <?php 

                            echo ' format_table +=  \'<tr>\';';
                                echo ' format_table +=  \'<th>ITEM INSPECTION</th>\';';
                                foreach($inspection_machine as $inspectionmachine)
                                {
                                                        
                                echo '                         
                                    format_table +=  \'<th align="center"><input type="checkbox" id="insp_machine'.$inspectionmachine->id.'_" name="qa_insp_machine_'.$inspectionmachine->id.'[\'+ nextTab + \'][]" class="filled-in checkbox-active">\';
                                    format_table +=  \'<label for="insp_machine'.$inspectionmachine->id.'_"></label>'.$inspectionmachine->name.'</th>\';';  
                                                
                                }
                            echo ' format_table +=  \'</tr>\';';
                        ?>

                        <?php 

                            echo ' format_table +=  \'<tr>\';';
                                echo ' format_table +=  \'<td>Inspect By</td>\';';
                                foreach($inspection_machine as $inspectionmachine)
                                {
                                echo ' format_table +=  \'<td>\';';
                                    echo ' format_table +=  \'<div class="selectresult">\';';   

                                    echo '
                                        format_table +=  \'<select class="form-control show-tick" name="inspect_by['.$inspectionmachine->id.']\'+ nextTab + \'">\';'; 
                                        foreach($inspect_by as $inspectby)
                                        {
                                            echo ' format_table +=  \'<option value="'.$inspectby['id'].'">'.$inspectby['fullname'].'</option>\';';
                                        }
                                        echo ' format_table +=  \'</select>\';';

                                    echo ' format_table +=  \'</div>\';';
                                echo ' format_table +=  \'</td>\';';    
                                }
                            echo ' format_table +=  \'</tr>\';';
                            
                        ?>

                        <?php 
                            
                            echo ' format_table +=  \'<tr>\';';
                                echo ' format_table +=  \'<td>Time Start</td>\';';
                                foreach($inspection_machine as $inspectionmachine)
                                {
                                                        
                                echo '
                                    format_table +=  \'<td><input type="text" name="time_start['.$inspectionmachine->id.']\'+ nextTab + \'" class="timepicker form-control"></td>\';';
                            
                                }
                            echo ' format_table +=  \'</tr>\';';
                        ?>

                        <?php 
                        
                            echo ' format_table +=  \'<tr>\';';
                                echo ' format_table +=  \'<td>Time End</td>\';';
                                foreach($inspection_machine as $inspectionmachine)
                                {
                                                        
                                echo '
                                    format_table +=  \'<td><input type="text" name="time_end['.$inspectionmachine->id.']\'+ nextTab + \'" class="timepicker form-control"></td>\';';
                            
                                }
                            echo ' format_table +=  \'</tr>\';';
                        ?>

                        <?php 
                        
                            echo ' format_table +=  \'<tr>\';';
                                echo ' format_table +=  \'<td>Result</td>\';';
                                foreach($inspection_machine as $inspectionmachine)
                                {
                                 
                                echo ' format_table +=  \'<td>\';';
                                    echo ' format_table +=  \'<div class="selectresult">\';';
                                                                
                                    echo '
                                        format_table +=  \'<select class="form-control show-tick" name="ra_result['.$inspectionmachine->id.']\'+ nextTab + \'">\';
                                            format_table +=  \'<option value="1">PASS</option>\';
                                            format_table +=  \'<option value="0">FAIL</option>\';
                                        format_table +=  \'</select>\';';
                                    
                                    echo ' format_table +=  \'</div>\';';
                                echo ' format_table +=  \'</td>\';';
                                }
                            echo ' format_table +=  \'</tr>\';';
                        ?>

    format_table += '</table>';
    format_table += '<button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>';
    format_table += '</div>';
    // format_table += '</div>';


    $(format_table).appendTo('#eng_content');

    // make the new tab active
    $('#eng_tab li:nth-child('+nextTab+') a').click();
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

