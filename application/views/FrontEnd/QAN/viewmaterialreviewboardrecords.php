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
                <li class="active"><a href="<?=base_url('DashboardMaterialReviewBoard')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i> Material Review Form</li>
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
                                       <input type="text" id="qan_no" name="qan_no" class="form-control" value="<?php echo $data[0]->qan_no;?>" readonly/>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        Status
                                        <!-- <span class="badge">New</span> -->
                                        <input type='text' id='status' name='status' class='form-control' value='<?php echo $data[0]->status;?>' readonly/>
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
                                                    <input type="text" id="issued_dept" name="issued_dept" class="form-control" value='<?php echo $data[0]->issued_dept;?>' disabled/>
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
                                                    <input type="text" id="to_dept" name="to_dept" class="form-control" value='<?php echo $data[0]->to_dept;?>' disabled/>
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
                                                    <input type="text" id="shift" name="shift" class="form-control" value='<?php echo $data[0]->shift;?>' disabled/>
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
                                                    <input type="text" id="part_name" name="part_name" class="form-control" value='<?php echo $partname[$data[0]->part_name];?>' disabled/>
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
                                                    <input type="text" id="process" name="process" class="form-control" value='<?php echo $procees[$data[0]->process];?>' disabled/>
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
                                                    <input type="text" id="detectedby_user" name="detectedby_user" class="form-control" value='<?php echo $user[$data[0]->detectedby_user];?>' disabled/>
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
                                                    <input type="text" id="ack_eng_user" name="ack_eng_user" class="form-control" value='<?php echo $user[$data[0]->ack_eng_user];?>' disabled/>
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
                                                    <input type="text" id="ack_qa_user" name="ack_qa_user" class="form-control" value='<?php echo $user[$data[0]->ack_qa_user];?>'/>
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
                        
                        <form method="post" action="<?php echo base_url().'FrontEnd/updatematerialreviewboard/'.$data[0]->machine_id ;?>">
                    
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
                                                                <input type="checkbox" id="loc_purge'.$loctopurge->id.'" name="loc_purge['.$loctopurge->id.']" class="filled-in checkbox-active"'.(@$section['S2.1']['de']?'':'disabled').' '.($tempqty1 > 0 ? 'checked':'').'>
                                                                <label for="loc_purge'.$loctopurge->id.'"></label>
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-affqty" name="aff_qty['.$loctopurge->id.']" value="'.$tempqty1.'" '.(@$section['S2.1']['de']?'':'disabled').' class="form-control" disabled>
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-goodqty" name="good_qty['.$loctopurge->id.']" value="'.$tempqty2.'" '.(@$section['S2.1']['de']?'':'disabled').' class="form-control good-total">
                                                            </td>
                                                            <td>
                                                                <input type="number" id="total-rejqty" name="rej_qty['.$loctopurge->id.']" value="'.$tempqty3.'" '.(@$section['S2.1']['de']?'':'disabled').' class="form-control reject-total">
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
                                                            <input type="text" id="total-affqty" name="qa_sample_affected_qty" class="form-control qasample-qty" value='<?php echo $totalSample;?>' <?php echo @$section['S2.1']['de']?'':'disabled';?>/>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="total-goodqty" name="qa_sample_good_qty" class="form-control qasample-qty" value="<?php echo $data[0]->qa_sample_good_qty;?>" <?php echo @$section['S2.1']['de']?'':'disabled';?>/>
                                                        </td>
                                                        <td>
                                                            <input type="number" id="total-rejqty" name="qa_sample_reject_qty" class="form-control qasample-qty" value="<?php echo $data[0]->qa_sample_reject_qty;?>" <?php echo @$section['S2.1']['de']?'':'disabled';?>/>
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
                                            <input type="checkbox" id="scrap" name="scrap" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($data[0]->scrap == '1') echo 'checked';?> <?php echo @$section['S2.1']['de']?'':'disabled';?>>
                                            <label for="scrap">SCRAP</label>
                                            <input type="checkbox" id="rework" name="rework" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($data[0]->rework == '1') echo 'checked';?> <?php echo @$section['S2.1']['de']?'':'disabled';?>>
                                            <label for="rework">REWORK</label>
                                            <input type="checkbox" id="UAI" name="UAI" class="filled-in" value="1" onclick="enableDisableAll();" <?php if ($data[0]->uai == '1') echo 'checked';?> <?php echo @$section['S2.1']['de']?'':'disabled';?>>
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
                                                    <input type="text" id="reported_by_mrb" name="reported_by_mrb" class="form-control" value='<?php echo $user[$data[0]->reportby_user_id];?>' <?php echo @$section['S2.1']['see']?'':'disabled';?>>
                                                    <label class="form-label">Reported by:<i>(MRB)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="qa_reinsp_verification_user_id" name="qa_reinsp_verification_user_id" class="form-control" value='<?php echo $user[$data[0]->qa_reinsp_verification_user_id];?>' <?php echo @$section['S2.2']['see']?'':'disabled';?>>
                                                    <label class="form-label">QA Re-inspection Verification:<i>(Leader & Above)</i></label>
                                                </div>
                                            </div>
                                            <input type="radio" id="qa_reinsp_accept" name="qa_reinsp_select" class="with-gap" value="1" <?php if ($data[0]->qa_reinsp_status_accept == '1') echo 'checked';?> <?php echo @$section['S2.1']['de']?'':'disabled';?>>
                                                <label for="qa_reinsp_accept">Accept</label>
                                            <input type="radio" id="qa_reinsp_reject" name="qa_reinsp_select" class="with-gap" value="0" <?php if ($data[0]->qa_reinsp_status_reject == '0') echo 'checked';?> <?php echo @$section['S2.1']['de']?'':'disabled';?>>
                                                <label for="qa_reinsp_reject">Reject</label>
                                            <input type="text" id="input_reject" name="input_reject" class="form-control" placeholder="If Reject,Reason"  value='<?php echo $data[0]->reject_reason;?>' disabled />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="machine_breakdown_id" value="<?php echo $machine_breakdown_id;?>" />
                                    <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Save changes</button>
                                <div class="row clearfix"></div>
                            </div>
                        <?php echo form_close(); ?>
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
    
    $('#reported_by_mrb').attr('disabled', true);

    $('#prod_pic').attr('disabled', true);

    $('table.mrb-form').find('input.form-control').hide();

    $('table.mrb-form').find("input.checkbox-active:checked").parents('tr').find('input.form-control').show();
        
    $('table.mrb-form').find('input.qasample-qty').show();
    $('table.mrb-form').find('input.total_affected_qty').show();
    $('table.mrb-form').find('input.total_good_qty').show();
    $('table.mrb-form').find('input.total_rej_qty').show();


    //show it when the checkbox is clicked
    // $('input[name="mc_p1"]').on('click', function () {
    //     if ($(this).prop('checked')) {
    //         $('input[name="aff_qty1"]').fadeIn();
    //     } else {
    //         $('input[name="aff_qty1"]').hide();
    //     }
    // });

    var totalPoints = 0;
    $('input.input_qty_qasample').each(function(){
        console.log(totalPoints);
        
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
        if(parseFloat($(this).val()) > 0)
        totalGoodQty = parseFloat($(this).val()) + totalGoodQty;
    });
    $('#total_good_qty').val(totalGoodQty);

    var totalRejQty = 0;
    $('input#total-rejqty').each(function(){
        if(parseFloat($(this).val()) > 0)
        totalRejQty = parseFloat($(this).val()) + totalRejQty;
    });
    $('#total_rej_qty').val(totalRejQty);

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

   
    document.getElementById('input_rework_uai').disabled = !((cb2 || cb3) && !cb1);
    document.getElementById('output_rework_uai').disabled = !((cb2 || cb3) && !cb1);
    document.getElementById('rej_scrap').disabled = !((cb2 || cb3) && !cb1);

    $("#scrap_no:disabled").val('');
    $("#rework_order:disabled").val('');
    $("#UAI_no:disabled").val('');
    $("#input_rework_uai:disabled").val('');
    $("#output_rework_uai:disabled").val('');
    $("#rej_scrap:disabled").val('');

}

</script>
