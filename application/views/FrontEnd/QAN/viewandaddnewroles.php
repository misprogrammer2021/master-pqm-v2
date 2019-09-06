<?php

$jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('FrontEnd/homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><a href="<?=base_url('FrontEnd/ViewRolePermission')?>"><i class="material-icons">library_books</i>View User Permission</a></li>
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li> -->
                <li><i class="material-icons">archive</i>View User Role</li>
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
                        if(isset($message_display))
                        {
                            $msg_type = $message_display[0]=='ok'?'success':'danger';
                    
                            echo '<div class="alert alert-'.$msg_type.'">'.($message_display[1]).'</div>';
                        }
                        ?> 
                            <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'FrontEnd/AddPermision' ?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewRole" class="btn btn-primary"><i class="material-icons">add_box</i><span class="icon-name">Add New Role</span></button>
                            <a href="<?php echo base_url(); ?>FrontEnd/ViewSection"><button type="button" class="btn btn-primary"><i class="material-icons">pageview</i><span class="icon-name">View Section</span></button></a>
                            <!-- <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal">MODAL - DEFAULT SIZE</button> -->
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <!-- <th style="width:10%">No</th> -->
                                            <th style="width:10%">Role ID</th>
                                            <th style="width:10%">Role Name</th>
                                            <th style="width:10%">Selected Section</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i=1;
                                        foreach($roles_sections as $role_name => $role_section)
                                        {
                                        
                                        echo '
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" id="role'.($role_section['role_id']).'" name="role_id['.($role_section['role_id']).']" class="filled-in checkbox-active">
                                                <label for="role'.($role_section['role_id']).'"></label>
                                            </td>
                                            <td>'.$role_section['role_id'].'</td> 
                                            <td>
                                                <input type="text" name="role_name['.($role_section['role_id']).']" value="'.($role_name).'" class="form-control roleid" disabled>
                                            </td>
                                            <td>
                                            
                                                <select id="section_edit" class="chosen_section ms" name="section_id['.$role_section['role_id'].'][]" data-placeholder="Choose Sections..." multiple disabled>';
                                                
                                                foreach($sections as $section)
                                                {   
                                                    $selected='';
                                                    if(in_array($section['section_name'],$role_section['section_name']))
                                                        $selected='selected';
                                                    echo '<option value="'.$section['id'].'" '.$selected.'>'.$section['section_name'].'</option>';
                                                }
                                                    // echo '<input type="text" class="form-control" data-role="tagsinput" value="'.implode(',',$role_section['section_name']).'" >';
                                        echo ' </select> 
                                            </div>
                                            </td>
                                            <!-- <td>
                                            
                                            <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-primary" disabled><i class="material-icons">update</i><span class="icon-name">Edit Role</span></button>
                                            </td>  -->
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Save Changes</span></button>
                                <!-- <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-primary"><i class="material-icons">save</i><span class="icon-name">Save Changes</span></button> -->
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

            <!-- Start Modal for ADD NEW ROLE -->                           
            <div class="modal fade" id="addNewRole" tabindex="-1" role="dialog" aria-labelledby="addNewRole" aria-hidden="true">    
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="addNewRole">
                                <i class="material-icons">supervisor_account</i><span class="icon-name">Add New Role</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'FrontEnd/ViewUserRole' ?>">
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Role</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="text" name="role_id" class="form-control" placeholder="Enter Role ID"><br/>
                                        <input type="text" name="role_name" class="form-control" placeholder="Enter Role Name">
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Section</label>
                                    </div>
                                    <select id="role_edit" name="section_id[]" class="form-control show-tick" multiple="multiple" multiple data-selected-text-format="count">
                                        
                                        <?php
                                            foreach($sections as $section)
                                            {
                                                echo '<option value="'.$section['id'].' ">'.$section['section_name'].'('.$section['description'].')</option>';
                                            }
                                        ?>
                                    </select>
                                </div> -->
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
             <!-- End Modal for ADD NEW ROLE --> 

             <!-- Start Modal for ADD/UPDATE SECTION -->                           
            <div class="modal fade" id="addSection" tabindex="-1" role="dialog" aria-labelledby="addSection" aria-hidden="true">    
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="addSection">
                                <i class="material-icons">supervisor_account</i><span class="icon-name">Add Section</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Section</label>
                                    </div>
                                    <select id="sections" name="section_id[]" data-placeholder="Choose Sections..." multiple>
                                        
                                        <?php
                                            foreach($sections as $section)
                                            {
                                                echo '<option value="'.$section['id'].' ">'.$section['section_name'].'('.$section['description'].')</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
             <!-- End Modal for ADD/UPDATE SECTION --> 

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


$(document).ready(function () {
    $('input.checkbox-active').change(function () {
        if($(this).is(":checked"))
        {
            // alert($(this).parent().siblings().find("input").val());
            $(this).parent().siblings().find("select,input").attr("disabled",false);
        }
        else
        {
            // alert($(this).parent().siblings().find("input").val());
            $(this).parent().siblings().find("select,input").attr("disabled",true);
            
        }
    })
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
