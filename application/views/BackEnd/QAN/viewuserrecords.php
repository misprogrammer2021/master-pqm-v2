<?php

$jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i> User Registration Form</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
            <?php
                    
                foreach($display_user as $row)
                {
            ?>
            <form method="post">
                <div class="row clearfix">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="username" name="username" class="form-control" value='<?php echo $row->username;?>'/>
                                <label class="form-label">Username</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="password" name="password" class="form-control" value='<?php echo $row->password;?>'/>
                                <label class="form-label">Password</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="created_at" name="created_at" class="datetimepicker form-control" value='<?php echo $row->created_at;?>' disabled/>
                                <label class="form-label">Created At</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                            <input type="text" name="fullname" class="form-control" value='<?php echo $row->fullname;?>'/>
                            <label class="form-label">Full Name</label>
                        </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="employee_no" class="form-control" value='<?php echo $row->employee_no;?>'/>
                                <label class="form-label">Employee No</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="updated_at" name="updated_at" class="datetimepicker form-control" value='<?php echo $row->updated_at;?>' disabled/>
                                <label class="form-label">Updated At</label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="email" class="form-control" value='<?php echo $row->email;?>'/>
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row clearfix">
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-4"> 
                            <label class="form-label">Designation</label>
                        </div>
                        <select id="title" name="title" class="form-control show-tick">
                            <option value="">--Please Select--</option>
                            <option value="Manager" <?php if ($row->title == 'Manager') echo 'selected';?>>Manager</option>
                            <option value="QA Engineer" <?php if ($row->title == 'QA Engineer') echo 'selected';?>>QA Engineer</option>
                            <option value="Engineer" <?php if ($row->title == 'Engineer') echo 'selected';?>>Engineer</option>
                            <option value="Asst Engineer" <?php if ($row->title == 'Asst Engineer') echo 'selected';?>>Assistant Engineer</option>
                            <option value="Leader" <?php if ($row->title == 'Leader') echo 'selected';?>>Leader</option>
                            <option value="Supervisor" <?php if ($row->title == 'Supervisor') echo 'selected';?>>Supervisor</option>
                            <option value="Senior Technician" <?php if ($row->title == 'Senior Technician') echo 'selected';?>>Senior Technician</option>
                            <option value="Technician" <?php if ($row->title == 'Technician') echo 'selected';?>>Technician</option>
                            <option value="Inspector" <?php if ($row->title == 'Inspector') echo 'selected';?>>Inspector</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-4"> 
                            <label class="form-label">Commodity</label>
                        </div>
                        <select id="commodity" name="commodity" class="form-control show-tick">
                            <option value="">--Please Select--</option>
                            <option value="E-Block" <?php if ($row->commodity == 'E-Block') echo 'selected';?>>E-Block</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-4"> 
                            <label class="form-label">Department</label>
                        </div>
                        <select id="dept_id" name="dept_id" class="form-control show-tick" required>
                            <option value="">--Please Select--</option>
                            <?php
                                foreach($department as $depart)
                                {
                                    $selected = '';
                                    if ($row->dept_id == $depart['id']){
                                        $selected = 'selected';
                                    }
                                    echo '<option value="'.$depart['id'].'" '.$selected.'>'.$depart['name'].'</option>';  
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-4"> 
                            <label class="form-label">User Role</label>
                        </div>
                        <select id="role_id" name="role_id[]" class="form-control show-tick" multiple="multiple" multiple data-selected-text-format="count">
                            <option value="">--Please Select--</option>
                            <?php
                                foreach($user_role as $role)
                                {
                                    $selected = '';
                                    if ($role['selected'] > 0){
                                        $selected = 'selected';
                                    }
                                    echo '<option value="'.$role['role_id'].'" '.$selected.'>'.$role['name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="col-md-4"> 
                            <label class="form-label">Status</label>
                        </div>
                        <select id="status" name="status" class="form-control show-tick">
                            <option value="">--Please Select--</option>
                            <option value="1" <?php if ($row->status == '1') echo 'selected';?>>Active</option>
                            <option value="0" <?php if ($row->status == '0') echo 'selected';?>>Deactive</option>
                        </select>
                    </div>
                </div>
                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Save changes</button>
                <div class="row clearfix"></div>
            </form>
            <?php } ?>
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

</script>

