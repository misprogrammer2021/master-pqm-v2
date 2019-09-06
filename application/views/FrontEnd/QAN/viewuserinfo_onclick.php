<!DOCTYPE html>
<html>

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

<style>
    
/* .scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-y: hidden;
    width: 300px;
} */

</style>    

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li> -->
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li> -->
                <li><i class="material-icons">library_books</i>Update User</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                            <?php
                               
                                foreach($data as $row)
                                    {
                            ?>
                            <form method="post">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                        <tr>
                                            <td><b>Username</b></td>
                                            <td><input type="text" name="username" class="form-control" value="<?php echo $row->username; ?>"/></td>
                                            <td><b>Password</b></td>
                                            <td><input type="text" name="password" class="form-control" value="<?php echo $row->password; ?>"/></td>
                                            <td><b>Full Name</b></td>
                                            <td><input type="text" name="fullname" class="form-control" value="<?php echo $row->fullname; ?>"/></td>
                                            <td><b>Email</b></td>
                                            <td><input type="text" name="email" class="form-control" value="<?php echo $row->email; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>Commodity</b></td>
                                            <td>
                                                <select id="commodity" name="commodity" class="form-control show-tick">
                                                    <option value="<?php echo $row->commodity; ?>">E-Block</option>
                                                </select>
                                            </td>
                                            <td><b>Department</b></td>
                                            <td>
                                                <select id="dept" name="dept" class="form-control show-tick">
                                                    <option value="QA">QA</option>
                                                    <option value="Engineering">Engineering</option>
                                                    <option value="MRB">MRB</option>
                                                    <option value="MIS">MIS</option>
                                                    
                                                </select>
                                            </td>
                                            <td><b>Designation</b></td>
                                            <td>
                                                <select id="title" name="title" class="form-control show-tick">
                                                    <option value="Manager">Manager</option>
                                                    <option value="QA Engineer">QA Engineer</option>
                                                    <option value="Engineer">Engineer</option>
                                                    <option value="Asst Engineer">Assistant Engineer</option>
                                                    <option value="Leader">Leader</option>
                                                    <option value="Supervisor">Supervisor</option>
                                                    <option value="Technician">Technician</option>
                                                    <option value="Inspector">Inspector</option>
                                                </select>
                                            </td>
                                            <td><b>Employee No</b></td>
                                            <td><input type="text" name="employee_no" class="form-control" value="<?php echo $row->employee_no; ?>"/></td>
                                        </tr>
                                        <tr>
                                            <td><b>User Role<b></td> 
                                            <td>
                                                <!-- <select id="user_role" name="user_role" class="form-control show-tick">
                                                    <option value="0">User</option>
                                                    <option value="1">QA</option>
                                                    <option value="2">Production</option>
                                                    <option value="3">Engineering</option>
                                                    <option value="4">Store</option>
                                                    <option value="-1">Admin</option>
                                                </select> -->
                                                <select id="user_role" name="user_role" class="form-control show-tick">
                                                    <?php
                                                    foreach($user_role as $userrole)
                                                    {
                                                        echo '<option value="'.$userrole['role_id'].'">'.$userrole['name'].'</option>';
                                                        
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <!-- <td><b>Role Group</b></td> 
                                            <td>
                                                <select id="role_group" name="role_group" class="form-control show-tick">
                                                    <option value="<?php echo $row->role_group_id; ?>">QA</option>
                                                    <option value="<?php echo $row->role_group_id; ?>">Engineering</option>
                                                </select>
                                            </td> -->
                                            <td><b>Created Date</b></td>
                                            <td><input type="text" id="created_date" name="created_date" class="datetimepicker form-control" value="<?php echo $row->created_date; ?>"/></td>
                                            <td><b>Modified Date</b></td>
                                            <td><input type="text" id="modified_date" name="modified_date" class="datetimepicker form-control" value="<?php echo $row->modified_date; ?>"/></td>
                                            <!-- <td><b>Status</b></td> -->
                                            <!-- <td><input type="text" name="is_deleted" class="form-control" value="<?php echo $row->is_deleted; ?>"/></td> -->
                                            <td><b>Status<b></td> 
                                            <td>
                                                <select id="is_deleted" name="is_deleted" class="form-control show-tick">
                                                    <option value="<?php echo $row->is_deleted; ?>"/>Active</option>
                                                    <option value="<?php echo $row->is_deleted; ?>"/>Deactive</option>
                                                </select>
                                            </td>
                                        </tr>
                                        
                                        <td colspan="100" align="center">
                                            <input type="submit" name="update" value="Update Records"/></td>
                                        
                                            <!-- <td colspan="100" align="center">
                                                <button type="submit" class="btn btn-success m-t-15 waves-effect pull-right" name="update">SUBMIT</button>
                                            </td> -->
                                </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                               
                            </div>
                            </form>
                            <?php } ?>
                            
                            <br/><br/><br/><br/><br/><br/>
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
$(function() {
    //Textare auto growth
    //autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        // format: 'dddd DD MMMM YYYY - HH:mm',
        format: 'YYYY-MM-DD HH:mm',
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
    format_table += '<table class="table table-hover table-bordered">';
    format_table += '        <tr>';
    format_table += '<th>ITEM INSPECTION</th>';
    format_table += '            <th>CMM</th>';
    format_table += '            <th>EDI</th>';
    format_table += '            <th>AIR GAUGE</th>';
    format_table += '            <th>GO NO GO</th>';
    format_table += '           <th>QV</th>';
    format_table += '            <th>MP</th>';
    format_table += '            <th>VISUAL</th>';
    format_table += '        </tr>';
    format_table += '        <tr>';
    format_table += '            <td>Inspect By</td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '        </tr>';
    format_table += '        <tr>';
    format_table += '            <td>Time Start</td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '</tr>';
    format_table += '<tr>';
    format_table += '<td>Time End</td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '</tr>';
    format_table += '<tr>';
    format_table += '<td>Result</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="cmm_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="edi_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="ag_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="gng_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="qv_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="mp_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="vis_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '</tr>';
    format_table += '</table>';
    format_table += '<button type="button" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>';
    format_table += '</div>';
    format_table += '</div>';


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

