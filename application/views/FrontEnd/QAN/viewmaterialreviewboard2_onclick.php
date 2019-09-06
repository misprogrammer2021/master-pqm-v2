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

                        <form method="post" id="ajaxFrom=" <?php echo base_url().'FrontEnd/rootcausefailureform' ?>"> 
                            <div id="clonedInput1" class="clonedInput">
                                <div class="row clearfix eng-section">  
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
                                                <a href="#" id="add_sub">
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
                                                                            <select class="form-control show-tick" name="ra_result['.$inspectionmachine->id.']">
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
                                                <!-- <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button> -->
                                            </div>
                                        </div>
                                    </div>
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


var regex = /^(.+?)(\d+)$/i;
var cloneIndex = $(".clonedInput").length;

function clone(){
    $(this).parents(".clonedInput").clone()
        .appendTo("form")
        .attr("id", "clonedInput" +  cloneIndex)
        .find("*")
        .each(function() {
            var id = this.id || "";
            var match = id.match(regex) || [];
            if (match.length == 3) {
                this.id = match[1] + (cloneIndex);
            }
        })
        .on('click', 'a#add_sub', clone)
        .on('click', 'button.remove', remove);
    cloneIndex++;
}
function remove(){
    $(this).parents(".clonedInput").remove();
}
$("a#add_sub").on("click", clone);

$("button.remove").on("click", remove);

    

    $('div.selectresult, table.rootcause-form input.form-control').each(function(){
        $(this).hide();
    });

   $('#eng_content').on('change','input.checkbox-tab',function(e){
        
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
});




</script>

