<?php

$jsselect = TRUE;

?>


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
        $section = $this->session->userdata['permission'];

?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('DashboardMachineBreakdown')?>"><i class="material-icons">home</i> Home</a></li>
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
                                        
                                       <input type='text' id='qan_no' name='qan_no' class='form-control' value='<?php echo $data[0]->qan_no;?>' readonly/>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        Status
                                        <!-- <span class="badge">New</span> -->
                                        <input type='text' id='status' name='status' class='form-control' value='<?php echo $data[0]->status;?>' readonly />
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

                            <?php //echo form_open('FrontEnd/machinebreakdownform'); ?> 
                    
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="issued_by_user" name="issued_by_user" class="form-control" value='<?php echo $user[$data[0]->issueby_user_id];?> '<?php echo @$section['S1']['see']?'':'disabled';?> />
                                                <label class="form-label">ISSUED BY</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="issueto_user" name="issueto_user" class="form-control" value='<?php echo $user[$data[0]->issueto_user];?>' <?php echo @$section['S1']['see']?'':'disabled';?> />
                                                <label class="form-label">TO</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <!-- <input type="text" id="datetime" name="datetime" class="datetimepicker form-control" value='<?php echo $data[0]->datetime;?>'/> -->
                                                <input type="text" id="datetime" name="datetime" class="<?php echo @$section['S1']['see']?'datetimepicker':'';?>  form-control" <?php echo @$section['S1']['see']?'':'disabled';?> value='<?php echo $data[0]->datetime;?>' required/>
                                                <label class="form-label">DATETIME</label>
                                            </div>
                                        </div>
                                        <!-- <input type="checkbox" id="ooc" name="ooc" class="filled-in" value="1" <?php if ($data[0]->ooc == '1') echo 'checked';?>> -->
                                        <input type="checkbox" id="ooc" name="ooc" class="filled-in" value="1" <?php if ($data[0]->ooc == '1') echo 'checked';?> <?php echo @$section['S1']['see']?'':'disabled';?>>
                                        <label for="ooc">OOC (OUT OF CONTROL)</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ISSUED DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="issued_dept" name="issued_dept" class="<?php echo @$section['S1']['see']?'show-tick':'';?>  form-control" <?php echo @$section['S1']['see']?'':'disabled';?> required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="QA" <?php if ($data[0]->issued_dept == 'QA') echo 'selected';?>>QA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">TO DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="to_dept" name="to_dept" class="<?php echo @$section['S1']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1']['de']?'':'disabled';?> required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="Production" <?php if ($data[0]->to_dept == 'Production') echo 'selected';?>>Production</option>
                                                    <option value="Engineering" <?php if ($data[0]->to_dept == 'Engineering') echo 'selected';?>>Engineering</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">SHIFT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="shift" name="shift" class="<?php echo @$section['S1']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1']['de']?'':'disabled';?> required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="Day" <?php if ($data[0]->shift == 'Day') echo 'selected';?>>DAY SHIFT</option>
                                                    <option value="Night" <?php if ($data[0]->shift == 'Night') echo 'selected';?>>NIGHT SHIFT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                            <input type="checkbox" id="oos" name="oos" class="filled-in" value="1" <?php if ($data[0]->oos == '1') echo 'checked';?>  <?php echo @$section['S1']['see']?'':'disabled';?>>
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
                                                <select id="part_name" name="part_name" class="<?php echo @$section['S1.1']['see']?'show-tick':'';?>  form-control" <?php echo @$section['S1.1']['see']?'':'disabled';?> required>
                                                <option value="">--Please Select--</option>
                                                <?php
                                                    foreach($models as $model)
                                                    {
                                                        $selected = '';
                                                        if ($data[0]->part_name == $model['id']){
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option value="'.$model['id'].'" '.$selected.'>'.$model['part_name'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><br/>
                                        <div class="form-group form-float"><br/>
                                            <div class="form-line">
                                                <input type="text" id="cav_no" name="cav_no" class="form-control" value='<?php echo $data[0]->cav_no;?>' <?php echo @$section['S1.1']['see']?'':'disabled';?> required/>
                                                <label class="form-label">CAV NO (if any)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_no" name="machine_no" class="form-control" value='<?php echo $data[0]->machine_no;?>' <?php echo @$section['S1.1']['see']?'':'disabled';?> required/>
                                                <label class="form-label">M/C NO</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="up_affected" name="up_affected" class="form-control" value='<?php echo $data[0]->up_affected;?>' <?php echo @$section['S1.1']['see']?'':'disabled';?> required/>
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
                                                <select id="process" name="process" class="<?php echo @$section['S1.1']['see']?'show-tick':'';?>  form-control" <?php echo @$section['S1.1']['see']?'':'disabled';?> required>
                                                <option value="">--Please Select--</option>
                                                <?php
                                                    foreach($group as $process)
                                                    {
                                                        $selected = '';
                                                        if ($data[0]->process == $process['id']){
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option value="'.$process['id'].'" '.$selected.'>'.$process['process_name'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><br/>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">DETECTED BY</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="detectedby_user" name="detectedby_user" class="<?php echo @$section['S1.1']['see']?'show-tick':'';?>  form-control" <?php echo @$section['S1.1']['see']?'':'disabled';?> required>
                                                <option value="">--Please Select--</option>
                                                <?php
                                                    foreach($detected_by as $detectedby)
                                                    {
                                                        $selected = '';
                                                        if ($data[0]->detectedby_user == $detectedby['id']){
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option value="'.$detectedby['id'].'" '.$selected.'>'.$detectedby['fullname'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea id="defect_description" name="defect_description" class="form-control" <?php echo @$section['S1.1']['see']?'':'disabled';?>><?php echo $data[0]->defect_description;?></textarea>
                                                <label class="form-label">DEFECT DESCRIPTION</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="last_passed_sample" name="last_passed_sample" class="<?php echo @$section['S1.1']['see']?'datetimepicker':'';?>  form-control" <?php echo @$section['S1.1']['see']?'':'disabled';?> value='<?php echo $data[0]->last_passed_sample;?>' required/>
                                                <label class="form-label">LAST PASSED SAMPLE DATETIME</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY ENGINEERING<i>(Tech & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" name="ack_eng_user" class="form-control" value='<?php echo $user[$data[0]->ack_eng_user];?>' <?php echo @$section['S1.4']['ack']?'':'disabled';?>/>
                                                    <input type="hidden" name="ack_eng_user_id" value='<?php echo $data[0]->ack_eng_user;?>'/>
                                                </div>
                                            </div>
                                        </div><br/>
                                    </div>   
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="purge_from" name="purge_from" class="<?php echo @$section['S1.1']['see']?'datetimepicker':'';?>  form-control" <?php echo @$section['S1.1']['see']?'':'disabled';?> value='<?php echo $data[0]->purge_from;?>'/>
                                                <label class="form-label">PURGE FROM DATETIME</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY PRODUCTION<i>(Leader & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" name="ack_prod_user" class="form-control" value='<?php echo $user[$data[0]->ack_prod_user];?>' <?php echo @$section['S1.5']['ack']?'':'disabled';?>/>
                                                    <input type="hidden" name="ack_prod_user_id" value='<?php echo $data[0]->ack_prod_user;?>'/>
                                                </div>
                                            </div>
                                        </div><br/>
                                        <form method="post" action="<?php echo base_url().'FrontEnd/updatedproduction/'.$data[0]->machine_id ;?>">
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
                                                            foreach($data as $qty => $data1){
                                                                if ($data1->prod_id == $prodloc->id){
                                                                    $tempqty = $data1->prodquantity;
                                                                    break;
                                                                }else{
                                                                    $tempqty = 0;
                                                                }
                                                            }
                                                    echo "<tr>";    
                                                        echo "<td>".$prodloc->location_name."</td>";
                                                        echo "<td>";
                                                            echo "<input type='number' value='$tempqty' name='input_qty_prod[$prodloc->id]' class='form-control input_qty_prod'".(@$section['S1.3']['de']?'':'disabled').">";
                                                        echo "</td>";
                                                    echo "</tr>";
                                                    
                                                        }
                                                ?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <td><b>Total</b></td>
                                                    <td><input type = "type" id ="total_prod" name = "total_prod" class="form-control" readonly></td>
                                                </tfoot>
                                            </table>
                                            <input type="hidden" name="machine_breakdown_id" value="<?php echo $machine_breakdown_id;?>" />
                                            <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right" <?php echo @$section['S1.3']['de']?'':'disabled';?>>Save changes</button>
                                            <!-- <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span>SAVE</span></button>
                                            <button type="button" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">home</i><span>HOME</span></button> -->
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div> 
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="estimate_qty" name="estimate_qty" class="form-control" value='<?php echo $data[0]->estimate_qty;?>' <?php echo @$section['S1.1']['see']?'':'disabled';?>/>
                                                <label class="form-label">ESTIMATE QTY</label>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY QC/QA <i>(Leader & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" name="ack_qa_user" class="form-control" value='<?php echo $user[$data[0]->ack_qa_user];?>' <?php echo @$section['S1.6']['ack']?'':'disabled';?>/>
                                                    <input type="hidden" name="ack_qa_user_id" value='<?php echo $data[0]->ack_qa_user;?>'/>
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
                                                            foreach($data as $qty => $data2){
                                                                if ($data2->qa_sample_id == $qasampleloc->id){
                                                                    $tempqty = $data2->samplequantity;
                                                                    break;
                                                                }else{
                                                                    $tempqty = 0;
                                                                }
                                                            }

                                                    echo "<tr>";    
                                                        echo "<td>".$qasampleloc->location_name."</td>";
                                                        echo "<td>";
                                                            echo "<input type='number' value='$tempqty' name='input_qty_qasample[$qasampleloc->id]' class='form-control input_qty_qasample' ".(@$section['S1.2']['see']?'':'disabled').">";
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
                                    
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Vertical Layout | With Floating Label -->

<!-- Jquery Core Js -->
<script src="<?=base_url('/assets/templates/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('/assets/templates/plugins/momentjs/moment.js')?>"></script>
<!-- Bootstrap Date Time Picker Js -->
<script src="<?=base_url('/assets/templates/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')?>"></script>
<!-- SweetAlert Plugin Js -->
<script src="<?=base_url('/assets/templates/plugins/sweetalert/sweetalert.min.js')?>"></script>
<!-- Custom Js -->
<!-- <script src="<?=base_url('/assets/templates/js/pages/ui/dialogs.js')?>"></script> -->
<!-- Bootstrap Core Js -->
<!-- <script src="<?=base_url('/assets/templates/plugins/bootstrap/js/bootstrap.min.js')?>"></script> -->
<!-- Bootstrap Notify Plugin Js -->
<!-- <script src="<?=base_url('/assets/templates/plugins/bootstrap-notify/bootstrap-notify.min.js')?>"></script> -->
<script>

//     $(document).ready (function(){
//             $("#success-alert").hide();
//             $("#form").click(function showAlert() {
//                 $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
//                $("#success-alert").slideUp(500);
//                 });   
//             });
//  });


$(function() {
    //Textare auto growth
    //autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        //format: 'dddd DD MMMM YYYY - HH:mm',
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

    $('#issued_by_user').attr('disabled', true);
    // $('#ack_eng_user').attr('disabled', true);
    
        var totalPoints = 0;
        $('input.input_qty_qasample').each(function(){
                totalPoints = parseFloat($(this).val()) + totalPoints;
        });
        $('#total_qa_sample').val(totalPoints);

        var totalPoints = 0;
        $('input.input_qty_prod').each(function(){
                totalPoints = parseFloat($(this).val()) + totalPoints;
        });
        $('#total_prod').val(totalPoints);
    
    
    // $("#success-alert").hide();
    //         $("#myWish").click(function showAlert() {
    //             $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    //            $("#success-alert").slideUp(500);
    //             });   
    //         });

    // $('table.qasample-form').find('input.form-control').hide();

    // $("input.checkbox-active").click(function(){
        
    //     if ($(this).prop('checked')) {
    //         $(this).parents('tr').find('input.form-control').fadeIn();
    //     } else {
    //         $(this).parents('tr').find('input.form-control').hide();
    //     }
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

