<?php

$jsselect = TRUE;

?>

<?php

    if (isset($this->session->userdata['logged_in'])) {

        $username = ($this->session->userdata['logged_in']['username']);
        $password = ($this->session->userdata['logged_in']['password']);
        $fullname = ($this->session->userdata['logged_in']['fullname']);
    }else{
          redirect('/login', 'refresh');
        }
        $section = $this->session->userdata['permission'];
        // $data = '{
        //     "qan_no": 123,
        //     "status": "new",
        //     "issueby_user_id": 2,
        //     "user":{
        //         "1":"asma",
        //         "2":"Jaidul",
        //         "3":"ashok"
        //     },
        //     "issueto_user": 3,
        //     "datetime":"2018-12-20 09:34:00.000",
        //     "issued_dept": "QA",
        //     "to_dept": "Production",
        //     "shift":"Day",
        //     "ooc": 1,
        //     "oos": 1,
        //     "part_name": 3,
        //     "list_partname":{
        //         "1":"diablo",
        //         "2":"v11",
        //         "3":"cimarron"
        //     },
        //     "cav_no":455,
        //     "machine_no":5,
        //     "up_affected":4,
        //     "process": 2,
        //     "loc_to_purge":{
        //       "1":"p1",
        //       "2":"p2"
        //     },
        //     "detectedby_user": 2,
        //     "defect_description":"test",
        //     "last_passed_sample":"2018-12-20 09:34:00.000",
        //     "ack_eng_user": 1,
        //     "purge_from":"2018-12-20 09:34:00.000",
        //     "ack_prod_user": 1,
        //     "production_qty":[
        //     {"prod_id":1,"prodquantity":"10"},
        //     {"prod_id":2,"prodquantity":"40"}
        //     ],
        //     "qasample_qty":[
        //         {"qa_sample_id":1,"samplequantity":"10"},
        //         {"qa_sample_id":2,"samplequantity":"40"}
        //     ],    
        //     "estimate_qty":90,
        //     "ack_qa_user": 3,
        //     "input_qty_qasample":[
        //     {"id":1,"location_name":"EDI"},
        //     {"id":2,"location_name":"CMM"}
        //     ],
        //     "form_start":"yes",
        //     "form_end":"no",
        //     "submit_button":{
        //       "name":"submit",
        //       "url":"/controller"
        //     },

        //     "prod_loc":[
        //         {"id":"1","location_name":"QA Sample"},
        //         {"id":"2","location_name":"Engineering Sample"},
        //         {"id":"3","location_name":"Inside CNC"},
        //         {"id":"4","location_name":"P1"},
        //         {"id":"5","location_name":"P2"},
        //         {"id":"6","location_name":"Washing"},
        //         {"id":"7","location_name":"Brushing"},
        //         {"id":"8","location_name":"CP"},
        //         {"id":"9","location_name":"FVMI"}
        //     ],

        //     "qa_sample_loc":[
        //         {"id":"1","location_name":"QA Sample"},
        //         {"id":"2","location_name":"Engineering Sample"},
        //         {"id":"3","location_name":"Inside CNC"},
        //         {"id":"4","location_name":"P1"},
        //         {"id":"5","location_name":"P2"},
        //         {"id":"6","location_name":"Washing"},
        //         {"id":"7","location_name":"Brushing"},
        //         {"id":"8","location_name":"CP"},
        //         {"id":"9","location_name":"FVMI"}
        //     ]

        //   }';



        //   echo '<pre>';
        //   print_r($data);
        //   exit;
          
?>

<?php 

    if(@count($data->submit_button->s1)>0){

        $form = $data->submit_button->s1[0];
        echo "<!-- Section 1 Form -->\r\n";
        echo '<form method="post" action="'.$form->action.'">';
    }
?>

<?php echo validation_errors(); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i>Machine Breakdown Form</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->

<div class="row clearfix" id="section1">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Machine Break Down Form
                    <small>Update: 16 Oct 2017, Doc No.: IPQA-MB-018, Revision: 05</small>
                </h2>
                <br/>
                <input type="checkbox" id="test" name="test" class="filled-in" value="1" <?php if (@$data->test == '1') echo 'checked';?>>
                <label for="test">TRIAL</label>
                
                <ul class="header-dropdown m-r--5">
                    <li>
                        <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                            QAN No:
                            <input type="text" id="qan_no" name="qan_no" class="form-control" value="<?php echo @$data->qan_no;?>" readonly/>
                        </button>
                    </li>
                    <li>
                        <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                            Status
                            <input type='text' id='status' name='status' class='form-control' value='<?php echo @$data->status_name;?>' readonly/>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="issued_by_user" name="issued_by_user" class="form-control" value='<?php echo @$data->user->{$data->issueby_user_id};?>' disabled/>
                                <input type="hidden" name="issued_by_user_id" value='<?php echo @$data->issueby_user_id?>'/>
                                <label class="form-label">ISSUED BY</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="issueto_user" name="issueto_user" class="form-control" value='<?php echo  @$data->user->{$data->issueto_user};?>' disabled/>
                                <input type="hidden" name="issueto_user_id" value='<?php echo @$data->issueto_user;?>'/>
                                <label class="form-label">TO</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="datetime" name="datetime" class="form-control" value='<?php echo @$data->datetime;?>' disabled />
                                <label class="form-label">DATETIME</label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="issued_dept" name="issued_dept" class="form-control" value='QA' <?php echo @$data->issued_dept;?> disabled/>
                                <label class="form-label">ISSUED DEPT</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="to_dept" name="to_dept" class="form-control" value='Engineering' <?php echo @$data->to_dept;?> disabled/>
                                <label class="form-label">TO DEPT</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="form-label">SHIFT</label>
                            </div>
                            <div class="col-md-8">
                                <select id="shift" name="shift" class="<?php echo @$section['S1.1']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1.1']['de']?'':'disabled';?> required>
                                    <option value="">--Please Select--</option>
                                    <option value="Day" <?php if (@$data->shift == 'Day') echo 'selected';?>>DAY SHIFT</option>
                                    <option value="Night" <?php if (@$data->shift == 'Night') echo 'selected';?>>NIGHT SHIFT</option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="defect_checkbox">
                            <input type="hidden" name="oos" value="0">
                            <input type="hidden" name="ooc" value="0">
                            <input type="hidden" name="visual" value="0">
                            <input type="checkbox" id="oos" name="oos" class="filled-in checkbox-active" data-type="spc" value="1" <?php if (@$data->oos == '1') echo 'checked';?> <?php echo @$section['S1.1']['de']?'':'disabled';?>>
                            <label for="oos">OOS (OUT OF SPEC)</label>
                            <input type="checkbox" id="ooc" name="ooc" class="filled-in checkbox-active" data-type="spc" value="1" <?php if (@$data->ooc == '1') echo 'checked';?> <?php echo @$section['S1.1']['de']?'':'disabled';?>>
                            <label for="ooc">OOC (OUT OF CONTROL)</label>
                            <input type="checkbox" id="visual" name="visual" class="filled-in checkbox-active" data-type="visual" value="1" <?php if (@$data->visual == '1') echo 'checked';?> <?php echo @$section['S1.1']['de']?'':'disabled';?>>
                            <label for="visual">VISUAL</label> 
                        </div>
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
                                <select id="part_name" name="part_name" data-show-subtext="true" data-live-search="true" class="<?php echo @$section['S1.2']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> required>
                                <option value="">--Please Select--</option>
                                <?php
                                    foreach($data->list_partname as $id => $part_name)
                                    {
                                        $selected = '';
                                        if (@$data->part_name == $id){
                                            $selected = 'selected';
                                        }
                                        echo '<option value="'.$id.'" '.$selected.'>'.$part_name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><br/> 
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="form-label">M/C NO</label>
                            </div>
                            <div class="col-md-8">
                                <select id="select_machine_no" name="machine_no_id" data-show-subtext="true" data-live-search="true" class="<?php echo @$section['S1.2']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> required>
                                    <option value="">--Please Select--</option>
                                    <?php
                                        $selected = '';
                                        foreach($machine_no as $index => $machine_row){

                                            $selected = $data->machine_no_id == $machine_row->id?'selected':'';
                                            echo '<option value="'.$machine_row->id.'" '.$selected.'>'.$machine_row->machine_name.' ['.$machine_row->sector_name.']</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="form-label">PROCESS</label>
                            </div>
                            <div class="col-md-8">
                                <select id="process" name="process" data-show-subtext="true" data-live-search="true" class="<?php echo @$section['S1.2']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> required>
                                <option value="">--Please Select--</option>
                                <?php
                                    foreach($data->list_process as $id => $purge)
                                    {
                                        $selected = '';
                                        if (@$data->process == $id){
                                            $selected = 'selected';
                                        }
                                        echo '<option value="'.$id.'" '.$selected.'>'.$purge.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="form-label">DETECTED BY</label>
                            </div>
                            <div class="col-md-8">
                                <select id="detectedby_user" name="detectedby_user" data-show-subtext="true" data-live-search="true" class="<?php echo @$section['S1.2']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> required>
                                <option value="">--Please Select--</option>
                                <?php
                                    $selected = '';
                                    foreach($detected_by as $index => $detectedby_row){
                                        if($detectedby_row->show_detectedby == 0){
                                            $selected = $data->detectedby_user == $detectedby_row->id?'selected':'';
                                            echo '<option value="'.$detectedby_row->id.'" '.$selected.'>'.$detectedby_row->detected_by_name.' ['.$detectedby_row->detected_group.']</option>';
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>                
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-4">
                            <label class="form-label">DEFECT DESCRIPTION <span style="color: red">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <span id="defectives"> <!--style="display:none"-->
                                <select id="select_defect" name="defect_description_name" data-show-subtext="true" data-live-search="true" class="<?php echo @$section['S1.2']['de']?'show-tick':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> required>
                                <option value="">--Please Select--</option>
                                <?php
                                    foreach($data->list_defect as $id => $defect_description)
                                    {
                                        $selected = '';
                                        if (@$data->defect_description_id == $id){
                                            $selected = 'selected';
                                        }
                                        echo '<option value="'.$id.'" '.$selected.'>'.$defect_description.'</option>';
                                    }
                                ?>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="others" name="defect_description_others" class="form-control" value='<?php echo @$data->defect_description_others;?>' <?php echo @$section['S1.2']['de']?'':'disabled';?> />    
                                <label class="form-label">DEFECT DESCRIPTION (OTHERS)</label>
                            </div> 
                        </div>     
                    </div>   
                    <div class="clearfix"></div> 
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="last_passed_sample" name="last_passed_sample" class="<?php echo @$section['S1.2']['de']?'datetimepicker':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> value='<?php echo @$data->last_passed_sample;?>' required/>
                                <label class="form-label">LAST PASSED SAMPLE DATETIME</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="form-label">ACKNOWLEDGED BY ENGINEERING<i>(Tech & Above)</i></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-line">
                                    <input type="text" name="ack_eng_user" class="form-control" value='<?php echo @$data->user->{$data->ack_eng_user};?>' disabled/>
                                    <input type="hidden" name="ack_eng_user_id" value='<?php echo @$data->ack_eng_user;?>'/>
                                </div>
                            </div>
                        </div><br/>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="purge_from" name="purge_from" class="<?php echo @$section['S1.2']['de']?'datetimepicker':'';?>  form-control" <?php echo @$section['S1.2']['de']?'':'disabled';?> value='<?php echo @$data->purge_from;?>' required/>
                                <label class="form-label">PURGE FROM DATETIME</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="form-label">ACKNOWLEDGED BY PRODUCTION<i>(Leader & Above)</i></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-line">
                                    <input type="text" name="ack_prod_user" class="form-control" value='<?php echo @$data->user->{$data->ack_prod_user};?>' disabled/>
                                    <input type="hidden" name="ack_prod_user_id" value='<?php echo @$data->ack_prod_user;?>'/>
                                </div>
                            </div>
                        </div><br/>
                            <div class="col-md-12 col-sm-12">
                                <!-- <table class="table table-hover table-bordered">
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
                                            $tempqty = '';
                                            if(@$data->prod_loc){
                                                foreach(@$data->prod_loc as $prodloc)
                                                {
                                                    if(@$data->production_qty){
                                                        
                                                    
                                                        foreach(@$data->production_qty as $prodqty){
                                                            if ($prodqty->prod_id == $prodloc->id){
                                                                $tempqty = $prodqty->prodquantity;
                                                                $totalProd += $tempqty;
                                                                break;
                                                            }else{
                                                                $tempqty = 0;
                                                            }
                                                        }
                                                    }
                                                    echo "<tr>";    
                                                        echo "<td>".$prodloc->location_name."</td>";
                                                        echo "<td>";
                                                            echo "<input type='number' value='$tempqty' name='input_qty_prod[$prodloc->id]' class='form-control input_qty_prod'".(@$section['S1.4']['de']?'':'disabled').">";
                                                        echo "</td>";
                                                    echo "</tr>";
                                            
                                                }
                                            }
                                            
                                            ?>
                                        
                                    </tbody>
                                    <tfoot>
                                        <td><b>Total</b></td>
                                        <td><input type = "text" id ="total_prod" name = "total_prod" class="form-control" readonly></td>
                                    </tfoot>
                                </table> -->
                            </div>
                        </div> 
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="estimate_qty" name="estimate_qty" class="form-control" value='<?php echo @$data->estimate_qty;?>' <?php echo @$section['S1.2']['de']?'':'disabled';?> required/>
                                    <label class="form-label">ESTIMATE QTY</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="form-label">ACKNOWLEDGED BY QC/QA <i>(Leader & Above)</i></label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-line">
                                        <input type="text" name="ack_qa_user" class="form-control" value='<?php echo @$data->user->{$data->ack_qa_user};?>' disabled/>
                                        <input type="hidden" name="ack_qa_user_id" value='<?php echo @$data->ack_qa_user;?>'/>
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
                                        $tempqty = '';
                                        if(@$data->qa_sample_loc){

                                            foreach(@$data->qa_sample_loc as $qasampleloc)
                                            {
                                                if(@$data->qasample_qty){
                                                    
                                                    foreach(@$data->qasample_qty as $qasampleqty){
                                                        if ($qasampleqty->qa_sample_id == $qasampleloc->id){
                                                            $tempqty = $qasampleqty->samplequantity;
                                                            $totalSample += $tempqty;
                                                            break;
                                                        }else{
                                                            $tempqty = 0;
                                                        }
                                                    }
                                                }    
                                                echo "<tr>";    
                                                    echo "<td>".$qasampleloc->location_name."</td>";
                                                    echo "<td>";
                                                        echo "<input type='number' value='$tempqty' name='input_qty_qasample[$qasampleloc->id]' class='form-control input_qty_qasample'".(@$section['S1.3']['de']?'':'disabled').">";
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
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
                        <input type="hidden" name="machine_breakdown_id" value="<?php echo @$data->id;?>" />
                        <div class="pull-right">

                        <?php if(@count($data->submit_button->s1)>0){
                            foreach($data->submit_button->s1 as $form){
                        ?>
                            <button id="form" type="submit" name="submit" value="<?php echo $form->value;?>" class="btn btn-success m-t-15 waves-effect"><?php echo $form->name;?></button>
                        
                        <?php }} ?>

                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(@count($data->submit_button->s1)>0){

        $form = $data->submit_button->s1;
        echo form_close();
    }
?>
 
   