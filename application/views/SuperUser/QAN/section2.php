<?php

$jsselect = TRUE;

?>

<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $password = ($this->session->userdata['logged_in']['password']);
        $fullname = ($this->session->userdata['logged_in']['fullname']);
        }else {
          redirect('/login', 'refresh');
        }
        $section = $this->session->userdata['permission'];
?>

<div class="row clearfix" id="section2">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Material Review Board Form                           
                </h2>
            </div>
            <div class="body"> 

            <?php

                if(@count($data->submit_button->s2)>0){

                    $form = $data->submit_button->s2[0];
                    echo "<!-- Section 2 Form -->\r\n";
                    echo '<form method="post" action="'.$form->action.'">';
                }
            ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 

                                        $tempqty1 = 0;
                                        $tempqty2 = 0;
                                        $tempqty3 = 0;
                                        $row_num = 0;
                                        if(@$data->loc_to_purge){
                                            $total_row = count($data->loc_to_purge);
                                            foreach(@$data->loc_to_purge as $loctopurge)
                                            {
                                                $row_num++;
                                                if(@$data->purge_location){

                                                    foreach(@$data->purge_location as $purgeloc){

                                                        if ($purgeloc->purge_location_id == $loctopurge->id){
                                                            $tempqty1 = $purgeloc->affected_qty;
                                                            $tempqty2 = $purgeloc->good_qty;
                                                            $tempqty3 = $purgeloc->reject_qty;
                                                            break;
                                                        }else{
                                                            $tempqty1 = 0;
                                                            $tempqty2 = 0;
                                                            $tempqty3 = 0;
                                                        }
                                                    }
                                                }
                                                echo '
                                                <tr>
                                                    <td>'.$loctopurge->purge_name.'</td>
                                                    <td align="center">';
                                                        if(!@$section['PRODSU2.1']['de']){
                                                            echo '<input type="hidden" name="loc_purge['.$loctopurge->id.']" value="'.($tempqty1 > 0 ?"on":"").'"/>';
                                                        }
                                                        echo '
                                                        <input type="checkbox" id="loc_purge'.$loctopurge->id.'" name="loc_purge['.$loctopurge->id.']" class="filled-in checkbox-active"'.(@$section['PRODSU2.1']['de']?'':'disabled').' '.($tempqty1 > 0 ? 'checked':'').'>
                                                        <label for="loc_purge'.$loctopurge->id.'"></label>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="affected_qty['.$loctopurge->id.']" value="'.$tempqty1.'">
                                                        <input type="number" id="total-affqty" name="affected_qty['.$loctopurge->id.']" value="'.$tempqty1.'" '.(@$section['PRODSU2.1']['de']?'':'disabled').' class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" id="total-goodqty" name="good_qty['.$loctopurge->id.']" value="'.$tempqty2.'" class="form-control good-total" disabled>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="reject_qty['.$loctopurge->id.']" value="'.$tempqty3.'">
                                                        <input type="number" id="total-rejqty" name="reject_qty['.$loctopurge->id.']" value="'.$tempqty3.'" '.(@$section['MRBSU2.2']['de']?'':'disabled').' class="form-control reject-total">
                                                    </td>
                                                    ';
                                                    if($row_num == 1) echo '<td rowspan='.($total_row+1).'>
                                                        <p>'.@$data->user->{$data->prod_pic_user_id}.'</p>
                                                        <input type="hidden" name="prod_pic_user_id" class="form-control" value="'.@$data->prod_pic_user_id.'">
                                                    </td>
                                                    <!-- <td rowspan='.($total_row+1).'> 
                                                        <input type="hidden" name="qa_buyoff_user_id" class="form-control"> -->
                                                    <!--</td> -->';
                                            echo '</tr>';
                                            }
                                        }    
                                    ?>
                                        <tr>
                                            <td>QA Sample</td>
                                            <td></td>
                                            <td>
                                                <input type="hidden" name="qa_sample_affected_qty" value="<?php if(@$totalSample > 0) echo $totalSample;?>">
                                                <input type="number" id="total-affqty" name="qa_sample_affected_qty" class="form-control qasample-qty" value='<?php if(@$totalSample > 0) echo $totalSample;?>' disabled>
                                            </td>
                                            <td>
                                                <input type="number" id="total-goodqty" name="qa_sample_good_qty" class="form-control qasample-qty" value="<?php echo @$data->qa_sample_good_qty;?>" disabled/> 
                                            </td>
                                            <td>
                                                <input type="hidden" name="qa_sample_reject_qty" value="<?php echo @$data->qa_sample_reject_qty;?>">
                                                <input type="number" id="total-rejqty" name="qa_sample_reject_qty" class="form-control qasample-qty" value="<?php echo @$data->qa_sample_reject_qty;?>" <?php echo @$section['S2.2']['de']?'':'disabled';?>/>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>TOTAL</td>
                                            <td></td>
                                            <td><input type = "type" id ="total_affected_qty" name = "total_affected_qty" class="form-control total_affected_qty" readonly></td>
                                            <td><input type = "type" id ="total_good_qty" name = "total_good_qty" class="form-control total_good_qty" readonly></td>
                                            <td><input type = "type" id ="total_rej_qty" name = "total_rej_qty" class="form-control total_rej_qty" readonly></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h5>DEFECTIVE PART DISPOSITION</h5>
                                <input type="checkbox" id="scrap" name="scrap" class="filled-in" value="1" onclick="enableDisableAll();" <?php if (@$data->scrap == '1') echo 'checked';?> <?php echo @$section['MRBSU2.3']['de']?'':'disabled';?>>
                                <label for="scrap">SCRAP</label>
                                <input type="checkbox" id="rework" name="rework" class="filled-in" value="1" onclick="enableDisableAll();" <?php if (@$data->rework == '1') echo 'checked';?> <?php echo @$section['MRBSU2.3']['de']?'':'disabled';?>>
                                <label for="rework">REWORK</label>
                                <input type="checkbox" id="uai" name="uai" class="filled-in" value="1" onclick="enableDisableAll();" <?php if (@$data->uai == '1') echo 'checked';?> <?php echo @$section['MRBSU2.3']['de']?'':'disabled';?>>
                                <label for="uai">UAI</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="rework_order_no" name="rework_order_no" class="form-control" value='<?php echo @$data->rework_order_no;?>' disabled /> 
                                        <label class="form-label">Rework order #<i>(if any)</i></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="scrap_no" name="scrap_no" class="form-control" value='<?php echo @$data->scrap_no;?>' disabled /> 
                                        <label class="form-label">Scrap #<i>(if any)</i></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="uai_no" name="uai_no" class="form-control" required="required" value='<?php echo @$data->uai_no;?>' disabled />
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
                                            <input type="text" id="rework_dispo_input" name="rework_dispo_input" class="form-control" value='<?php echo @$data->rework_dispo_input;?>' disabled />
                                        </td>
                                        <td>
                                            <input type="text" id="rework_dispo_output" name="rework_dispo_output" class="form-control" value='<?php echo @$data->rework_dispo_output;?>' disabled/>
                                        </td>
                                        <td>
                                            <input type="text" id="rework_dispo_rej_scrap" name="rework_dispo_rej_scrap" class="form-control" value='<?php echo @$data->rework_dispo_rej_scrap;?>' disabled/>
                                        </td>
                                    </tr>
                                </table>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="reported_by_mrb" name="reported_by_mrb" class="form-control" value='<?php echo @$data->user->{$data->reportby_user_id};?>' disabled>
                                        <input type="hidden" name="reported_by_mrb" value='<?php echo @$data->reportby_user_id;?>'/>
                                        <label class="form-label">Reported by:<i>(MRB)</i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="machine_breakdown_id" value="<?php echo @$data->id;?>" />
                    <input type="hidden" name="confirmation" value="<?php echo @$data->confirmation;?>" />

                    <div class="pull-right">
                    <?php if(@count($data->submit_button->s2)>0){
                        foreach($data->submit_button->s2 as $form){
                    ?>

                        <button id="form" type="submit" name="submit" value="<?php echo $form->value;?>" class="btn btn-success m-t-15 waves-effect"><?php echo $form->name;?></button>

                    <?php }} ?>
                </div>
                    
                <div class="row clearfix"></div>
                <?php 

                if(@count($data->submit_button->s2)>0){
                    $form = $data->submit_button->s2;
                    echo form_close();
                }
                ?>
            </div>
        </div>
    </div>
</div>



