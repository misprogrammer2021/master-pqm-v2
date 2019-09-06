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

<form method="post" action="<?php echo base_url().'FrontEnd/materialreviewboardform' ?>">
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
            <li class="active"><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li> -->
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li> -->
                <li><i class="material-icons">library_books</i> Material Review Board Form</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- <form>                                     -->
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
                                                        echo '
                                                        <tr>
                                                            <td>'.$loctopurge->process_name.'</td>
                                                            <td align="center">
                                                                <input type="checkbox" id="loc_purge'.$loctopurge->id.'" name="loc_purge['.$loctopurge->id.']" class="filled-in checkbox-active">
                                                                <label for="loc_purge'.$loctopurge->id.'"></label>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="aff_qty['.$loctopurge->id.']" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="number" name="good_qty['.$loctopurge->id.']" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="number" name="rej_qty['.$loctopurge->id.']" class="form-control">
                                                            </td>
                                                            <td>
                                                              
                                                            </td>
                                                            <td>
                                                              
                                                            </td>
                                                        </tr>
                                                            ';
                                                            continue;
                                                    echo "<tr>";    
                                                        echo "<td>".$loctopurge->process_name."</td>";
                                                        echo "<td align='center'>";
                                                            // echo "<input type='checkbox' id='check_machine' name='check_machine' class='filled-in checkbox-active'>";
                                                            echo '<input type="checkbox" id="scrap" name="scrap" class="filled-in" value="1">';
                                                            echo "<label for='machine'></label>";
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo "<input type='text' id='aff_qty' value='' name='aff_qty[$loctopurge->id]' class='form-control'>";
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo "<input type='text' id='good_qty' value='' name='good_qty[$loctopurge->id]' class='form-control'>";
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo "<input type='text' id='rej_qty' value='' name='rej_qty[$loctopurge->id]' class='form-control'>";
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo "<input type='text' id='prod_pic' name='prod_pic' class='form-control'>";
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo "<input type='text' id='qa_buy_off' value='' name='qa_buy_off' class='form-control'>";
                                                        echo "</td>";
                                                    echo "</tr>";
                                                    
                                                        }
                                                        ?>

                                                    <tr>
                                                        <td>QA Sample</td>
                                                        <td></td>
                                                        <td>
                                                            <input type="number" name="qa_sample_aff_qty" class="form-control" value='<?php echo is_object($qa_sample_total) ? $qa_sample_total->Total : '' ;?>' readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="qa_sample_good_qty" value="" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="qa_sample_rej_qty" value="" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="qa_sample_prod_pic" value="" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="qa_sample_buy_off" value="" class="form-control">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>TOTAL</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h5>DEFECTIVE PART DISPOSITION</h5>
                                            <input type="checkbox" id="scrap" name="scrap" class="filled-in" value="1" onclick="enableDisableAll();" />
                                            <label for="scrap">SCRAP</label>
                                            <input type="checkbox" id="rework" name="rework" class="filled-in" value="1" onclick="enableDisableAll();" />
                                            <label for="rework">REWORK</label>
                                            <input type="checkbox" id="UAI" name="UAI" class="filled-in" value="1" onclick="enableDisableAll();" />
                                            <label for="UAI">UAI</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="rework_order" name="rework_order" class="form-control" disabled/>
                                                    <label class="form-label">Rework order #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="scrap_no" name="scrap_no" class="form-control" disabled/>
                                                    <label class="form-label">Scrap #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="UAI_no" name="UAI_no" class="form-control" required="required" disabled/>
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
                                                        <input type="text" id="input_rework_uai" name="input_rework_uai" class="form-control" disabled/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="output_rework_uai" name="output_rework_uai" class="form-control" disabled/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="rej_scrap" name="rej_scrap" class="form-control rework-open" disabled/>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="reported_by_mrb" name="reported_by_mrb" class="form-control" value="<?php echo $fullname; ?>">
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
                                <!-- <input type="hidden" name="_glpi_csrf_token" value="<?php echo $machine_breakdown_id->machine_breakdown_id; ?>"> -->
                                <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>
                                <div class="row clearfix"></div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- Vertical Layout | With Floating Label -->

<!-- Jquery Core Js -->
<script src="<?=base_url('assets/templates/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('/assets/templates/plugins/momentjs/moment.js')?>"></script>
<!-- Bootstrap Date Time Picker Js -->
<script src="<?=base_url('/assets/templates/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')?>"></script>
<script>

// document.getElementById('scrap').onchange = function() {
//     document.getElementById('scrap_no').disabled = !this.checked;
// };

// document.getElementById('rework').onchange = function() {
//     document.getElementById('rework_order').disabled = !this.checked;
//     document.getElementById('input_rework_uai').disabled = !this.checked;
//     document.getElementById('output_rework_uai').disabled = !this.checked;
//     document.getElementById('rej_scrap').disabled = !this.checked;
//     $("#rework_order").val('');
//     $("#input_rework_uai").val('');
//     $("#output_rework_uai").val('');
//     $("#rej_scrap").val('');
// };

// document.getElementById('UAI').onchange = function() {
//     document.getElementById('UAI_no').disabled = !this.checked;
// }; 


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

    $('#reported_by_mrb').attr('disabled', true);

    $('#prod_pic').attr('disabled', true);

    $('table.mrb-form').find('input.form-control').hide();

    //show it when the checkbox is clicked
    // $('input[name="mc_p1"]').on('click', function () {
    //     if ($(this).prop('checked')) {
    //         $('input[name="aff_qty1"]').fadeIn();
    //     } else {
    //         $('input[name="aff_qty1"]').hide();
    //     }
    // });

    $("input.checkbox-active").click(function(){
        
        if ($(this).prop('checked')) {
            $(this).parents('tr').find('input.form-control').fadeIn();
        } else {
            $(this).parents('tr').find('input.form-control').hide();
        }
    });

    $(".with-gap").click(function() {
        $("#input_reject").attr("disabled", true);
            if ($("input[name=qa_reinsp_select]:checked").val() == "0") {
                $("#input_reject").attr("disabled", false);
        }
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

function enableDisableAll() {
    cb1 = document.getElementById('scrap').checked;
    cb2 = document.getElementById('rework').checked;
    cb3= document.getElementById('UAI').checked;

    document.getElementById('scrap_no').disabled = !cb1;
    document.getElementById('rework_order').disabled = !cb2;
    document.getElementById('UAI_no').disabled = !cb3;

    $("#scrap_no").val('');
    $("#rework_order").val('');
    $("#UAI_no").val('');
    $("#input_rework_uai").val('');
    $("#output_rework_uai").val('');
    $("#rej_scrap").val('');

    document.getElementById('input_rework_uai').disabled = !((cb2 || cb3) && !cb1);
    document.getElementById('output_rework_uai').disabled = !((cb2 || cb3) && !cb1);
    document.getElementById('rej_scrap').disabled = !((cb2 || cb3) && !cb1);

}

</script>

