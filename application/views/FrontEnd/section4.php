
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

        //     "machine_status": 1,
        //     "user": {
        //         "user":{
        //             "1":"asma",
        //             "2":"Jaidul",
        //             "3":"ashok"
        //         }
        //     },
        //     "approval_user_id": 1,
        //     "machine_stop_reason": "test",
        //     "form_start":"yes",
        //        "form_end":"no",
        //         "submit_button":{
        //         "name":"submit",
        //         "url":"/controller"
        //     },
        //     "machine_breakdown_id": 169

        // }';


?>      
  
<div class="row clearfix" id="section4">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">

            <?php

                if(@count($data->submit_button->s4)>0){

                    $form = $data->submit_button->s4[0];
                    echo "<!-- Section 4 Form -->\r\n";
                    echo '<form method="post" action="'.$form->action.'">';
                }
            ?>
                
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <h4 class="alert bg-green text-center">FOR QA USE ONLY</h4>
                        <h5>APPROVAL <i>(Leader & Above)</i></h5>
                        <label class="form-label">MACHINE STATUS</label>
                        <div class="clearfix"></div>
                        <div class="col-md-6 col-sm-6">
                            <input type="radio" id="machine_status1" name="machine_status" class="with-gap" value="1" <?php if (@$data->machine_status == '1') echo 'checked';?> <?php echo @$section['S4']['de']?'':'disabled';?>> 
                            <label for="machine_status1">RUN</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="approval_user" name="approval_user" class="form-control" value='<?php echo @$data->user->{$data->approval_user_id};?>' <?php echo @$section['S4']['see']?'':'disabled';?>>
                                    <input type="hidden" name="approval_user_id" value="<?php echo @$data->approval_user_id;?>" />  
                                    <label class="form-label">APPROVED BY</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input type="radio" id="machine_status2" name="machine_status" class="with-gap" value="0" <?php if (@$data->machine_status == '0') echo 'checked';?> <?php echo @$section['S4']['de']?'':'disabled';?>> 
                            <label for="machine_status2">STOP</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="machine_stop_reason" name="machine_stop_reason" class="form-control" value='<?php echo @$data->machine_stop_reason;?>' <?php echo @$section['S4']['de']?'':'disabled';?>> 
                                    <label class="form-label">IF STOP, REASON:</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="machine_breakdown_id" value="<?php echo @$data->id;?>" />
    
                    <div class="pull-right">

                        <?php if(@count($data->submit_button->s4)>0){
                            foreach($data->submit_button->s4 as $form){
                        ?>

                            <button id="form" type="submit" name="submit" value="<?php echo $form->value;?>" class="btn btn-success m-t-15 waves-effect"><?php echo $form->name;?></button>

                        <?php }} ?>
                    </div>
                </div>

                <?php 

                    if(@count($data->submit_button->s4)>0){
                        $form = $data->submit_button->s4;
                        echo form_close();
                    }
                ?>
            </div>
        </div>
    </div>
</div>


