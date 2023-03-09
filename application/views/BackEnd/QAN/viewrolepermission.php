<?php

$jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i>View User Permission</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h3>
                    <center>User Permission & Role Management</center>                          
                </h3>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#userpermission" data-toggle="tab">USER PERMISSION</a></li>
                    <li role="presentation"><a href="#userrole" data-toggle="tab">USER ROLE</a></li>
                    <li role="presentation"><a href="#section" data-toggle="tab">SECTION</a></li>
                    
                </ul>
                <br/>
                
                <?php 

                    if(isset($message_display))
                    {
                        $msg_type = $message_display[0]=='ok'?'success':'danger';
                
                        echo '<div class="alert alert-'.$msg_type.'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'.($message_display[1]).'</div>';
                    }
                ?> 

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="userpermission">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_role_permission';?>"> <!--'FrontEnd/AddRolePermission' old--> 
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th>Role Name</th>
                                            <th>Section Name</th>
                                            <th>View Permission</th>
                                            <th>Data Entry Permission</th>
                                            <th>Acknowledge Permission</th>
                                            <th>Approval Permission</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                        $i=1;
                                        
                                        foreach($permission as $row)
                                        {
                                
                                            echo '
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="role'.$row->role_id.'_'.$row->id.'" name="role_id['.$row->role_id.']" class="filled-in checkbox-active">
                                                    <label for="role'.$row->role_id.'_'.$row->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>'.$row->role_name.'</td>  
                                                <td>'.$row->section_name.'</td>
                                                <td align="center">
                                                    <input type="checkbox" id="see'.$row->role_id.'_'.$i.'" name="see['.$row->role_id.']['.$row->section_id.']" class="filled-in" '.(($row->see == 1)?"checked":"").' disabled>
                                                    <label for="see'.$row->role_id.'_'.$i.'"></label>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" id="de'.$row->role_id.'_'.$i.'" name="de['.$row->role_id.']['.$row->section_id.']" class="filled-in" '.(($row->de == 1)?"checked":"").' disabled>
                                                    <label for="de'.$row->role_id.'_'.$i.'"></label>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" id="ack'.$row->role_id.'_'.$i.'" name="ack['.$row->role_id.']['.$row->section_id.']" class="filled-in" '.(($row->ack == 1)?"checked":"").' disabled>
                                                    <label for="ack'.$row->role_id.'_'.$i.'"></label>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" id="app'.$row->role_id.'_'.$i.'" name="app['.$row->role_id.']['.$row->section_id.']" class="filled-in" '.(($row->app == 1)?"checked":"").' disabled>
                                                    <label for="app'.$row->role_id.'_'.$i.'"></label>
                                                </td>
                                            </tr>
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="userrole">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_permission' ?>"> <!--'BackEnd/processing_permission / FrontEnd/AddPermision' old -->
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewRole" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Role</span></button>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">Role ID</th>
                                            <th style="width:50%">Role Name</th>
                                            <th style="width:50%">Selected Section</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                        $i=1;
                                        foreach($roles_sections as $role_name => $role_section)
                                        {
                                        
                                        echo '
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" id="role'.($role_section['role_id']).'" name="role_id['.($role_section['role_id']).']" class="filled-in checkbox-active">
                                                <label for="role'.($role_section['role_id']).'"></label>
                                            </td>
                                            <td>'.$role_section['role_id'].'</td> 
                                            <td>
                                                <input type="text" name="role_name['.($role_section['role_id']).']" value="'.($role_name).'" class="form-control roleid" disabled>
                                            </td>
                                            <td>
                                                <select id="section_edit" class="chosen_section ms" name="section_id['.$role_section['role_id'].'][]" data-placeholder="Choose Sections..." multiple disabled>';
                                                
                                                foreach($sections as $section)
                                                {   
                                                    $selected='';
                                                    if(in_array($section['section_name'],$role_section['section_name']))
                                                        $selected='selected';
                                                    echo '<option value="'.$section['id'].'" '.$selected.'>'.$section['section_name'].'</option>';
                                                }
                                        echo ' </select> 
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }   
                                    ?>
                                    </tbody>
                                </table>
                                <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                            </div>
                        </form>                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="section">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_section';?>"> <!-- 'FrontEnd/UpdateSection' ProcessingSection-old -->
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewSection" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Section</span></button>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Section Name</th>
                                            <th style="width:10%">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($section1 as $sec)
                                        {
                                        
                                        echo '
                                        
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" id="section'.$sec->id.'" name="sectionid['.$sec->id.']" class="filled-in checkbox-active">
                                                <label for="section'.$sec->id.'"></label>
                                            </td>
                                            <td>'.$i.'</td> 
                                            <td>
                                                <input type="text" name="section['.$sec->id.']" value="'.$sec->section_name.'" class="form-control sectionid" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="description['.$sec->id.']" value="'.$sec->description.'" class="form-control sectionid" disabled>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                            </div>
                        </form>   
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label -->

<!-- Start Modal for ADD NEW ROLE -->                           
<div class="modal fade" id="addNewRole" tabindex="-1" role="dialog" aria-labelledby="addNewRole" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewRole">
                    <span class="icon-name">Add Role</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_role' ?>"> <!--FrontEnd/ViewUserRole' old-->
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Role ID</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="role_id" class="form-control"><br/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Role Name</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="role_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal for ADD NEW ROLE -->  

<!-- Start Modal for ADD/UPDATE SECTION -->                           
<div class="modal fade" id="addNewSection" tabindex="-1" role="dialog" aria-labelledby="addNewSection" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewSection">
                    <i class="material-icons">supervisor_account</i><span class="icon-name">Add Section</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_section' ?>"> <!-- 'FrontEnd/ViewSection' old-->
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Section</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="section" class="form-control" placeholder="Enter Section Name">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Description</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="description" class="form-control" placeholder="Enter Description">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- End Modal for ADD/UPDATE SECTION --> 

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

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000);

    $(document).ready(function () {
        $('input.checkbox-active').change(function () {
            if($(this).is(":checked"))
            {
                $(this).parent().siblings().find("select,input").attr("disabled",false).trigger("chosen:updated");
                $('.chosen_section').chosen({ width: '100%' });
            }
            else
            {
                $(this).parent().siblings().find("select,input").attr("disabled",true);
            }
        })
    });

</script>

