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
                <li class="active"><a href="<?=base_url('DashboardRootCauseFailure')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i> Root Cause Failure Analysis Form</li>
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
                                       <input type="text" id="qan_no" name="qan_no" class="form-control" value="<?php echo $data[0]->qan_no;?>" readonly>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        Status
                                        <!-- <span class="badge">New</span> -->
                                        <input type='text' id='status' name='status' class='form-control' value='<?php echo $data[0]->status;?>'readonly />
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
                                                <input type="text" id="issued_by_user" name="issued_by_user" class="form-control" value='<?php echo $user[$data[0]->issueby_user_id];?>' <?php echo @$section['S1']['see']?'':'disabled';?> />
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
                                            <input type="text" id="datetime" name="datetime" class="<?php echo @$section['S1']['see']?'datetimepicker':'';?>  form-control" <?php echo @$section['S1']['see']?'':'disabled';?> value='<?php echo $data[0]->datetime;?>' required/>
                                                <label class="form-label">DATETIME</label>
                                            </div>
                                        </div>
                                        <input type="checkbox" id="ooc" name="ooc" class="filled-in" value="1" <?php if ($data[0]->ooc == '1') echo 'checked';?> <?php echo @$section['S1']['see']?'':'disabled';?>>
                                        <label for="ooc">OOC (OUT OF CONTROL)</label>
                                    </div>
                                    <!-- <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ISSUED DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="issued_dept" name="issued_dept" class="form-control" value='<?php echo $data[0]->issued_dept;?>' readonly />
                                                </div>
                                            </div>
                                        </div> -->
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
                                        <!-- <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">TO DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="to_dept" name="to_dept" class="form-control" value='<?php echo $data[0]->to_dept;?>' readonly />
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">TO DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="to_dept" name="to_dept" class="<?php echo @$section['S1']['see']?'show-tick':'';?>  form-control" <?php echo @$section['S1']['see']?'':'disabled';?> required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="Production" <?php if ($data[0]->to_dept == 'Production') echo 'selected';?>>Production</option>
                                                    <option value="Engineering" <?php if ($data[0]->to_dept == 'Engineering') echo 'selected';?>>Engineering</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">SHIFT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="shift" name="shift" class="form-control" value='<?php echo $data[0]->shift;?>' readonly />
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">SHIFT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="shift" name="shift" class="<?php echo @$section['S1']['see']?'show-tick':'';?>  form-control" <?php echo @$section['S1']['see']?'':'disabled';?> required>
                                                    <option value="">--Please Select--</option>
                                                    <option value="Day" <?php if ($data[0]->shift == 'Day') echo 'selected';?>>DAY SHIFT</option>
                                                    <option value="Night" <?php if ($data[0]->shift == 'Night') echo 'selected';?>>NIGHT SHIFT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                            <input type="checkbox" id="oos" name="oos" class="filled-in" value="1" <?php if ($data[0]->oos == '1') echo 'checked';?> <?php echo @$section['S1']['see']?'':'disabled';?> required>
                                            <label for="oos">OOS (OUT OF SPEC)</label>
                                    </div>
                                </div>
                                <!-- <div class="row clearfix">
                                    <h5>DEFECT INFORMATION <i>(To be filled in by QA)</i></h5><br/>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                            <label class="form-label">PART NAME</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="part_name" name="part_name" class="form-control" value='<?php echo $partname[$data[0]->part_name];?>' readonly/>
                                                </div>
                                            </div>
                                        </div><br/> -->
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
                                    <!-- <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">PROCESS</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="process" name="process" class="form-control" value='<?php echo $procees[$data[0]->process];?>' readonly/>
                                                </div>
                                            </div>
                                        </div><br/> -->
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
                                        <!-- <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">DETECTED BY</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="detectedby_user" name="detectedby_user" class="form-control" value='<?php echo $user[$data[0]->detectedby_user];?>' readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
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
                                        <!-- <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY ENGINEERING<i>(Tech & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="ack_eng_user" name="ack_eng_user" class="form-control" value='<?php echo $user[$data[0]->ack_eng_user];?>' readonly/>
                                                </div>
                                            </div>
                                        </div><br/>
                                    </div>  -->
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
                                        <!-- <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY PRODUCTION<i>(Leader & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="ack_prod_user" name="ack_prod_user" class="form-control" value='<?php echo $user[$data[0]->ack_prod_user];?>' readonly/>
                                                </div>
                                            </div>
                                        </div><br/>  -->
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

                                                        $totalProd = 0;
                                                        foreach($prod_loc as $prodloc)
                                                        {
                                                            foreach($data as $qty => $data1){
                                                                if ($data1->prod_id == $prodloc->id){
                                                                    $tempqty = $data1->prodquantity;
                                                                    $totalProd += $tempqty;
                                                                    break;
                                                                }else{
                                                                    $tempqty = 0;
                                                                }
                                                            }
                                                    echo "<tr>";    
                                                        echo "<td>".$prodloc->location_name."</td>";
                                                        echo "<td>";
                                                            echo "<input type='number' value='$tempqty' name='input_qty_prod[$prodloc->id]' class='form-control input_qty_prod'".(@$section['S1.3']['see']?'':'disabled').">";
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
                                                <input type="text" id="estimate_qty" name="estimate_qty" class="form-control" value='<?php echo $data[0]->estimate_qty;?>' <?php echo @$section['S1.1']['see']?'':'disabled';?>/>
                                                <label class="form-label">ESTIMATE QTY</label>
                                            </div>
                                        </div> 
                                        <!-- <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ACKNOWLEDGED BY QC/QA <i>(Leader & Above)</i></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-line">
                                                    <input type="text" id="ack_qa_user" name="ack_qa_user" class="form-control" value='<?php echo $user[$data[0]->ack_qa_user];?>' readonly/>
                                                </div>
                                            </div>
                                        </div><br/>  -->
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
                                                        
                                                        $totalSample = 0;
                                                        foreach($qa_sample_loc as $qasampleloc)
                                                        {
                                                            foreach($data as $qty => $data2){
                                                                if ($data2->qa_sample_id == $qasampleloc->id){
                                                                    $tempqty = $data2->samplequantity;
                                                                    $totalSample += $tempqty;
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
                                                            foreach($data as $qty => $data3){

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
                                                                <input type="checkbox" id="loc_purge'.$loctopurge->id.'" name="loc_purge['.$loctopurge->id.']" class="filled-in checkbox-active"'.(@$section['S2.1']['see']?'':'disabled').' '.($tempqty1 > 0 ? 'checked':'').'>
                                                                <label for="loc_purge'.$loctopurge->id.'"></label>
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-affqty" name="aff_qty['.$loctopurge->id.']" value="'.$tempqty1.'" '.(@$section['S2.1']['see']?'':'disabled').' class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-goodqty" name="good_qty['.$loctopurge->id.']" value="'.$tempqty2.'" '.(@$section['S2.1']['see']?'':'disabled').' class="form-control good-total">
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-rejqty" name="rej_qty['.$loctopurge->id.']" value="'.$tempqty3.'" '.(@$section['S2.1']['see']?'':'disabled').' class="form-control reject-total">
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
                                                            <input type="text" id="total-affqty" name="qa_sample_affected_qty" class="form-control qasample-qty" value='<?php echo $totalSample;?>' <?php echo @$section['S2.1']['see']?'':'disabled';?>/>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="total-goodqty" name="qa_sample_good_qty" class="form-control qasample-qty" value="<?php echo $data[0]->qa_sample_good_qty;?>" <?php echo @$section['S2.1']['see']?'':'disabled';?>/>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="total-rejqty" name="qa_sample_reject_qty" class="form-control qasample-qty" value="<?php echo $data[0]->qa_sample_reject_qty;?>" <?php echo @$section['S2.1']['see']?'':'disabled';?>/>
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
                                            <input type="checkbox" id="scrap" name="scrap" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($data[0]->scrap == '1') echo 'checked';?> <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                            <label for="scrap">SCRAP</label>
                                            <input type="checkbox" id="rework" name="rework" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($data[0]->rework == '1') echo 'checked';?> <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                            <label for="rework">REWORK</label>
                                            <input type="checkbox" id="UAI" name="UAI" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($data[0]->uai == '1') echo 'checked';?> <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                            <label for="UAI">UAI</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="rework_order" name="rework_order" class="form-control" value='<?php echo $data[0]->rework_order_no;?>' disabled /> 
                                                    <label class="form-label">Rework order #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="scrap_no" name="scrap_no" class="form-control" value='<?php echo $data[0]->scrap_no;?>' disabled /> 
                                                    <label class="form-label">Scrap #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="UAI_no" name="UAI_no" class="form-control" required="required" value='<?php echo $data[0]->uai_no;?>' disabled />
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
                                                        <input type="text" id="input_rework_uai" name="input_rework_uai" class="form-control" value='<?php echo $data[0]->rework_dispo_input;?>' disabled />
                                                    </td>
                                                    <td>
                                                        <input type="text" id="output_rework_uai" name="output_rework_uai" class="form-control" value='<?php echo $data[0]->rework_dispo_output;?>' disabled/>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="rej_scrap" name="rej_scrap" class="form-control rework-open" value='<?php echo $data[0]->rework_dispo_rej_scrap;?>' disabled/>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="reported_by_mrb" name="reported_by_mrb" class="form-control" value='<?php echo $user[$submissionmrb[0]->reportby_user_id];?>' <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                                    <label class="form-label">Reported by:<i>(MRB)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="qa_reinsp_verification_user_id" name="qa_reinsp_verification_user_id" class="form-control" value='<?php echo $user[$data[0]->qa_reinsp_verification_user_id];?>' <?php echo @$section['S2.2']['see']?'':'disabled';?>>
                                                    <label class="form-label">QA Re-inspection Verification:<i>(Leader & Above)</i></label>
                                                </div>
                                            </div>
                                            <input type="radio" id="qa_reinsp_accept" name="qa_reinsp_select" class="with-gap" value="1" <?php if ($data[0]->qa_reinsp_status_accept == '1') echo 'checked';?> <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                            <label for="qa_reinsp_accept">Accept</label>
                                            <input type="radio" id="qa_reinsp_reject" name="qa_reinsp_select" class="with-gap" value="0" <?php if ($data[0]->qa_reinsp_status_reject == '0') echo 'checked';?> <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                            <label for="qa_reinsp_reject">Reject</label>
                                            <input type="text" id="input_reject" name="input_reject" class="form-control" placeholder="If Reject,Reason" value='<?php echo $data[0]->reject_reason;?>' disabled />
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
                                <!-- <div class="col-md-12 col-sm-12">
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
                                </div> -->
                                
                                <!-- [TABS] -->
                                <div class="body">
                                <!-- Nav tabs -->
                                <ul id="eng_tab2" class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#sub1" data-toggle="tab" aria-expanded="false">
                                            <i class="material-icons">insert_drive_file</i>1st Submission
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="javascript:void(0);" id="add_sub">
                                            <span class="btn btn-success"><i class="material-icons">add</i>NEW</span>
                                        </a>
                                    </li>
                                    <?php //if (@$section['S3.1']['de']){?>

                                    <!-- <li role="presentation">
                                        <a href="javascript:void(0);" id="add_sub">
                                            <span class="btn btn-success"><i class="material-icons">add</i>NEW</span>
                                        </a>
                                    </li> -->
                                    <?php //}?> 
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" id="eng_content2">

                                 <!-- TAB 0 -->
                                <div role="tabpanel" class="tab-pane fade" id="sub">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="root_cause" name="root_cause[]" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>></textarea>
                                            <label class="form-label">ROOT CAUSE</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="corrective_action" name="corrective_action[]" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>></textarea>
                                            <label class="form-label">CORRECTIVE ACTION</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_pic_user" name="rcfa_pic_user[]" class="form-control" value="<?php echo $fullname; ?>" <?php echo @$section['S3.1']['see']?'':'disabled';?>>
                                            <label class="form-label">PERSON IN-CHARGE</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng[]" class="form-control" value="<?php echo $fullname; ?>" <?php echo @$section['S3.2']['see']?'':'disabled';?>>
                                            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_approved_by" name="rcfa_approved_by[]" class="form-control" <?php echo @$section['S3.3']['see']?'':'disabled';?>>
                                            <label class="form-label">APPROVED BY <i>Leader & Above</i></label>
                                        </div>
                                    </div>
                                </div>

                                    <b class="qasubmission">QA Inspection Data - 0st Submission</b>
                                    
                                    <h5>Job Completion By Engineering</h5>           
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="completion_user_id" name="completion_user_id[]" class="form-control" value="<?php echo $fullname; ?>" <?php echo @$section['S3.1']['see']?'':'disabled';?>>
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
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        
                                                        echo '
                                                            <th align="center"><input type="checkbox" id="insp_machine_'.$inspectionmachine->id.'_machine" name="qa_insp_machine['.$inspectionmachine->id.']" class="filled-in checkbox-tab">
                                                                <label for="insp_machine_'.$inspectionmachine->id.'_machine"></label>'.$inspectionmachine->name.'
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
                                                                    <select id="inspect_by'.$inspectionmachine->id.'_" class="form-control show-tick" name="inspect_by['.$inspectionmachine->id.'][]">';
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
                                                            <td><input id="time_start'.$inspectionmachine->id.'_" type="text" name="time_start['.$inspectionmachine->id.'][]" class="timepicker form-control"></td>
                                                            
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
                                                            <td><input id="time_end'.$inspectionmachine->id.'_" type="text" name="time_end['.$inspectionmachine->id.'][]" class="timepicker form-control"></td>
                                                            
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
                                                                        <select id="rc_result'.$inspectionmachine->id.'_" class="form-control show-tick" name="rc_result['.$inspectionmachine->id.'][]">
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

                                <!-- TAB 1 -->
                                <div role="tabpanel" class="tab-pane fade in active" id="sub1">

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="root_cause" name="root_cause[1][]" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>></textarea>
                                            <label class="form-label">ROOT CAUSE</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea id="corrective_action" name="corrective_action[1][]" class="form-control" <?php echo @$section['S3.1']['de']?'':'disabled';?>></textarea>
                                            <label class="form-label">CORRECTIVE ACTION</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_pic_user" name="rcfa_pic_user[1][]" class="form-control" value="<?php echo $fullname; ?>" <?php echo @$section['S3.1']['see']?'':'disabled';?>>
                                            <label class="form-label">PERSON IN-CHARGE</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng[1][]" class="form-control" value="<?php echo $fullname; ?>" <?php echo @$section['S3.2']['see']?'':'disabled';?>>
                                            <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="rcfa_approved_by" name="rcfa_approved_by[1][]" class="form-control" <?php echo @$section['S3.3']['see']?'':'disabled';?>>
                                            <label class="form-label">APPROVED BY <i>Leader & Above</i></label>
                                        </div>
                                    </div>
                                </div>
                                
                                    <b>QA Inspection Data - 1st Submission</b>
                                        <!-- <div class="form-group form-float"><br/>
                                            <div class="form-line">
                                                <input type="text" id="submit_by" name="submit_by[1][]" class="form-control" value="<?php echo $fullname; ?>">
                                                <label class="form-label">Submit By:</label>                                                    
                                            </div>
                                        </div> -->

                                    <h5>Job Completion By Engineering</h5>           
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="completion_user_id" name="completion_user_id[1][]" class="form-control" value="<?php echo $fullname; ?>" <?php echo @$section['S3.1']['see']?'':'disabled';?>>
                                                <label class="form-label">NAME</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="completion_datetime" name="completion_datetime[1][]" class="form-control" <?php echo @$section['S3.1']['see']?'':'disabled';?>>
                                                <label class="form-label">DATE & TIME</label>
                                            </div>
                                        </div>
                                    </div>

                                        <table class="table table-hover table-bordered rootcause-form">
                                                
                                            <?php 
                                                echo '<tr>';
                                                    echo '<th>ITEM INSPECTION</th>';
                                                    foreach($inspection_machine as $inspectionmachine)
                                                    {
                                                        
                                                        echo '
                                                            <th align="center"><input type="checkbox" id="insp_machine'.$inspectionmachine->id.'" name="qa_insp_machine[1]['.$inspectionmachine->id.']" class="filled-in checkbox-tab">
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
                                                                    <select id="inspect_by'.$inspectionmachine->id.'_" class="form-control show-tick" name="inspect_by[1]['.$inspectionmachine->id.']">';
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
                                                            <td><input id="time_start'.$inspectionmachine->id.'_" type="text" name="time_start[1]['.$inspectionmachine->id.']" class="timepicker form-control"></td>
                                                            
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
                                                            <td><input id="time_end'.$inspectionmachine->id.'_" type="text" name="time_end[1]['.$inspectionmachine->id.']" class="timepicker form-control"></td>
                                                            
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
                                                                        <select id="rc_result'.$inspectionmachine->id.'_" class="form-control show-tick" name="rc_result[1]['.$inspectionmachine->id.']">
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
                                </div>
                                    <input type="hidden" name="machine_breakdown_id" value="<?php echo $machine_breakdown_id;?>" />
                                    <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right" <?php echo @$section['S3.1']['de']?'':'disabled';?>>SUBMIT</button>
                                </div>
                            <!-- </div> -->
                            <?php echo form_close(); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <input type="radio" id="machine_status1" name="machine_status" class="with-gap" disabled>
                                        <label for="machine_status1">RUN</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_run_pic" name="machine_run_pic" class="form-control" disabled>
                                                <label class="form-label">APPROVED BY</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="radio" id="machine_status2" name="machine_status" class="with-gap" disabled>
                                        <label for="machine_status2">STOP</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_stop_reason" name="machine_stop_reason" class="form-control" disabled>
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

var totalPoints = 0;
$('input.input_qty_prod').each(function(){
    totalPoints = parseFloat($(this).val()) + totalPoints;
});
$('#total_prod').val(totalPoints);

var totalAffQty = 0;
$('input#total-affqty').each(function(){
    totalAffQty = parseFloat($(this).val()) + totalAffQty;
});
$('#total_affected_qty').val(totalAffQty);

var totalGoodQty = 0;
$('input#total-goodqty').each(function(){
    if(parseFloat($(this).val()))
    totalGoodQty = parseFloat($(this).val()) + totalGoodQty;
});
$('#total_good_qty').val(totalGoodQty);

var totalRejQty = 0;
$('input#total-rejqty').each(function(){
    if(parseFloat($(this).val()))
    totalRejQty = parseFloat($(this).val()) + totalRejQty;
});
$('#total_rej_qty').val(totalRejQty);

$('div.selectresult, table.rootcause-form input.form-control').each(function(){
    $(this).hide();
    $(this).prop('disabled', function(i, v) { return !v; });
});

$('#eng_content2').on('change','input.checkbox-tab',function(e){
    
    var indexCheckbox = $(this).parents('th').index();
    var theId = parseInt($(this).attr('id').replace(/[^\d]/g, ''), 10);
    // alert(theId);
    // $('div#sub'+theId).find('input.form-control, div.selectresult').slideToggle('slow');
    $(this).parents('tr').siblings('tr').find('td:eq('+indexCheckbox+') input.form-control, td:eq('+indexCheckbox+') div.selectresult').slideToggle('slow').prop('disabled', function(i, v) { return !v; });
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
    .before('<li role="presentation"><a href="#sub'+nextTab+'" data-toggle="tab"><i class="material-icons">insert_drive_file</i>'+ordinal_suffix_of(nextTab)+' Submission</a></li>');

    // var $clone = $("#sub").clone();    // Create your clone

    var $clone;
     $.ajax({
     url: "",
     type: "POST",
     dataType : "html",
     success: function (data){
         
        var $html = $('<html />').html(data);
        $clone = $html.find("div#sub").clone();//$(data).find("#sub").clone();
        $clone.attr('id',$clone.attr('id')+nextTab ); 

        $clone.find('b.qasubmission').text('QA Inspection Data - ' +ordinal_suffix_of(nextTab)+' Submission Data')

        // Find all elements in $clone that have an ID, and iterate using each()
        $clone.find('[id]').each(function() { 

        //Perform the same replace as above
        var $th = $(this);
        var $thname = $th.attr('name');
        var $thname_array = $thname.split('[');
        $thname = $thname_array[0]+'['+nextTab+']['+$thname_array[1];
        $(this).attr('name', $thname);
        var $tfor = $(this).siblings('label');
        var $select_button = $(this).siblings('button');
        //var newID = $th.attr('id').replace(/\d+$/, function(str) { return parseInt(str) + 1; });
        var newID = $th.attr('id')+nextTab; 
        $th.attr('id', newID);

        if($select_button.data('id') != null){
            $select_button.attr('data-id',newID);
            console.log($select_button.data('id'))
        }

        if($tfor.attr('for') != null)
        {
            $tfor.attr('for', newID);
        }
            
        });

        // $clone.find('[id]').each(function(i,e){
        //     var $th = $(this).siblings('button');
        //     $th.data('id',123)
        //     console.log($th.data('id'))
        // })
           
        $clone.appendTo('#eng_content2');

        $('div.selectresult, table.rootcause-form input.form-control').each(function(){
            $(this).hide();
            $(this).prop('disabled', function(i, v) { return !v; });
        });


        // make the new tab active
        $('#eng_tab2 li:nth-child('+nextTab+') a').click();

        //$('#add_sub').hide();

        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });

        $.AdminBSB.dropdownMenu.activate();
        $.AdminBSB.input.activate();
        $.AdminBSB.select.activate();

     }
     })


    
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

