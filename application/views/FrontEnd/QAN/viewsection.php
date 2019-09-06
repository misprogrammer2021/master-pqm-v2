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
                <li><i class="material-icons">library_books</i>View User Roles Details</li>
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
                        // if(isset($msg))
                        // {
                        //     $msg_type = $msg[0]=='ok'?'success':'danger';
                    
                        //     echo '<div class="alert alert-'.$msg_type.'">'.($msg[1]).'</div>';
                        // }
                        // ?> 
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'FrontEnd/UpdateSection';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewSection" class="btn btn-primary"><i class="material-icons">add_box</i><span class="icon-name">Add New Section</span></button>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Section Name</th>
                                            <th style="width:10%">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                        $i=1;
                                        foreach($sections as $section)
                                        {
                                        
                                        echo '
                                        
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" id="section'.$section->id.'" name="sectionid['.$section->id.']" class="filled-in checkbox-active">
                                                <label for="section'.$section->id.'"></label>
                                            </td>
                                            <td>'.$i.'</td> 
                                            <td>
                                                <input type="text" name="section['.$section->id.']" value="'.$section->section_name.'" class="form-control sectionid" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="desc['.$section->id.']" value="'.$section->description.'" class="form-control sectionid" disabled>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">update</i><span class="icon-name">Update</span></button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

             <!-- Start Modal for ADD/UPDATE SECTION -->                           
            <div class="modal fade" id="addNewSection" tabindex="-1" role="dialog" aria-labelledby="addNewSection" aria-hidden="true">    
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="addNewSection">
                                <i class="material-icons">supervisor_account</i><span class="icon-name">Add Section</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'FrontEnd/ViewSection' ?>">
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Section</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="text" name="section" class="form-control" placeholder="Enter Section Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Description</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="text" name="description" class="form-control" placeholder="Enter Description">
                                    </div>
                                </div>
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
            $(this).parent().siblings().find("input").attr("disabled",false);
        }
        else
        {
            // alert($(this).parent().siblings().find("input").val());
            $(this).parent().siblings().find("input").attr("disabled",true);
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
