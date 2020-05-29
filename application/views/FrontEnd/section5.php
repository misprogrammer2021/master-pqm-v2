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
        // $data = '{

        //     "purge_status": 1,
        //     "user":{
        //         "1": "asma",
        //         "2": "nabi",
        //         "3": "emizul"
        //     },
        //     "closedby_user_id": 2,
        //     "notify_next_process": 1,
        //     "closed_datetime":"2018-12-20 09:34:00.000",
        //     "fix_validation_result": 1,
        //     "machine_breakdown_id": 169,
        //     "form_start":"yes",
        //     "form_end":"no",
        //         "submit_button":{
        //         "name":"submit",
        //         "url":"/controller"
        //     }
        // }';

?>

<div class="row clearfix" id="section5">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

            <?php

                if(@count($data->submit_button->s5)>0){

                    $form = $data->submit_button->s5[0];
                    echo "<!-- Section 5 Form -->\r\n";
                    echo '<form method="post" action="'.$form->action.'">';
                }
            ?>
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <h5>REVIEW BY QUALITY ENGINEER</h5>
                        <div class="clearfix"></div>
                        <div class="col-md-4 col-sm-4">
                            <label class="form-label">PURGING COMPLETED?</label>
                            <input type="radio" id="purging_completed1" name="purging_completed" class="with-gap" value="1" <?php if (@$data->purge_status == '1') echo 'checked';?> <?php echo @$section['S5']['de']?'':'disabled';?>>   
                            <label for="purging_completed1">YES</label>
                            <input type="radio" id="purging_completed2" name="purging_completed" class="with-gap" value="0" <?php if (@$data->purge_status == '0') echo 'checked';?> <?php echo @$section['S5']['de']?'':'disabled';?>>    
                            <label for="purging_completed2">No</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="closed_by" name="closed_by" class="form-control" value='<?php echo @$data->user->{$data->closedby_user_id};?>' <?php echo @$section['S5']['see']?'':'disabled';?>>  
                                    <input type="hidden" name="closedby_user_id" value="<?php echo @$data->closedby_user_id;?>" />  
                                    <label class="form-label">REVIEWED AND CLOSED BY <i>(Quality Engineer / Manager)</i></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label class="form-label">NOTIFY NEXT PROCESS</label>
                            <input type="radio" id="notify_next1" name="notify_next_process" class="with-gap" value="1" <?php if (@$data->notify_next_process == '1') echo 'checked';?> <?php echo @$section['S5']['de']?'':'disabled';?>>      
                            <label for="notify_next1">YES</label>
                            <input type="radio" id="notify_next2" name="notify_next_process" class="with-gap" value="0" <?php if (@$data->notify_next_process == '0') echo 'checked';?> <?php echo @$section['S5']['de']?'':'disabled';?>>      
                            <label for="notify_next2">NO</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="closed_datetime" name="closed_datetime" class="form-control" value='<?php echo @$data->closed_datetime;?>' disabled>    
                                    <label class="form-label">CLOSED DATE</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <label class="form-label">FIX VALIDATION RESULT</label>
                            <input type="radio" id="validation_result1" name="validation_result" class="with-gap" value="1" <?php if (@$data->fix_validation_result == '1') echo 'checked';?> <?php echo @$section['S5']['de']?'':'disabled';?>>      
                            <label for="validation_result1">PASS</label>
                            <input type="radio" id="validation_result2" name="validation_result" class="with-gap" value="0" <?php if (@$data->fix_validation_result == '0') echo 'checked';?> <?php echo @$section['S5']['de']?'':'disabled';?>>      
                            <label for="validation_result2">FAIL</label>
                        </div>
                    </div>
                    <input type="hidden" name="machine_breakdown_id" value="<?php echo @$data->id;?>" />
                    <div class="pull-right">

                        <?php if(@count($data->submit_button->s5)>0){
                            foreach($data->submit_button->s5 as $form){
                        ?>

                            <button id="form" type="submit" name="submit" value="<?php echo $form->value;?>" class="btn btn-success m-t-15 waves-effect"><?php echo $form->name;?></button>

                        <?php }} ?>
                    </div>
                </div> 

                <?php 

                    if(@count($data->submit_button->s5)>0){
                        
                        $form = $data->submit_button->s5;
                        echo form_close();
                    }
                ?>  
            </div>
        </div>
    </div>
</div>

