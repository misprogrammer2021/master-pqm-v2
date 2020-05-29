<?php

$jsselect = TRUE;

?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i>User Registration Form</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <form method="post" action="<?php echo base_url().'BackEnd/register' ?>">
                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="text" name="username" class="form-control" placeholder="Username"><?php echo form_error('username'); ?>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="password" name="password" class="form-control" placeholder="Password"><?php echo form_error('password'); ?>
                                </div>
                            </div>
                            <!-- <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="created_date" name="created_date" class="datetimepicker form-control">
                                    <label class="form-label">Created Date</label>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="text" name="fullname" class="form-control" placeholder="Full Name"><?php echo form_error('fullname'); ?>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="employee_no" class="form-control" placeholder="Employee No"><?php echo form_error('employee_no'); ?>
                                </div>
                            </div>
                            <!-- <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="modified_date" name="modified_date" class="datetimepicker form-control">
                                    <label class="form-label">Modified Date</label>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-4">
                            <div class="col-md-4"> 
                                <label class="form-label">Designation</label>
                            </div>
                            <select id="title" name="title" class="form-control show-tick">
                                <option value="">--Please Select--</option>
                                <option value="Manager">Manager</option>
                                <option value="QA Engineer">QA Engineer</option>
                                <option value="Engineer">Engineer</option>
                                <option value="Asst Engineer">Assistant Engineer</option>
                                <option value="Leader">Leader</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Technician">Technician</option>
                                <option value="Inspector">Inspector</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="col-md-4"> 
                                <label class="form-label">Commodity</label>
                            </div>
                            <select id="commodity" name="commodity" class="form-control show-tick">
                                <option value="">--Please Select--</option>
                                <option value="E-Block">E-Block</option>
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
                                        echo '<option value="'.$depart['id'].'">'.$depart['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="col-md-4"> 
                                <label class="form-label">Role</label>
                            </div>
                            <select id="role_id" name="role_id[]" class="form-control show-tick" multiple="multiple" multiple data-selected-text-format="count">
                                <option value="">--Please Select--</option>

                                <?php
                                    foreach($roles as $role)
                                    {
                                        echo '<option value="'.$role['role_id'].' ">'.$role['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-4 col-sm-4">
                            <div class="col-md-4"> 
                                <label class="form-label">Status</label>
                            </div>
                            <select id="is_deleted" name="is_deleted" class="form-control show-tick">
                                <option value="">--Please Select--</option>
                                <option value="0">Active</option>
                                <option value="1">Deactive</option>
                            </select>
                        </div> -->
                    </div>
                    <button type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>
                    <div class="row clearfix"></div>
                </form>
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

