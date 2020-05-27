<?php

$jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('FrontEnd/homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><a href="<?=base_url('FrontEnd/ViewRolePermission')?>"><i class="material-icons">library_books</i>View User Permission</a></li>
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li> -->
                <li><i class="material-icons">library_books</i>View User Roles Details</li>
            </ol>
        </div>
    </div>
</section>



<!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                        <?php 
                        // if(isset($msg))
                        // {
                        //     $msg_type = $msg[0]=='ok'?'success':'danger';
                    
                        //     echo '<div class="alert alert-'.$msg_type.'">'.($msg[1]).'</div>';
                        // }
                        // ?> 
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'FrontEnd/UpdateCorrectiveAction';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewCorrectiveAction" class="btn btn-primary"><i class="material-icons">add_box</i><span class="icon-name">Add New Corrective Action</span></button>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Constant No</th>
                                            <th style="width:10%">Corrective Action</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                        $i=1;
                                        foreach($correction_actions as $correction_action)
                                        {
                                        
                                        echo '
                                        
                                        <tr>
                                            <td align="center">
                                                <input type="checkbox" id="correction_action'.$correction_action->id.'" name="corrective_action_id['.$correction_action->id.']" class="filled-in checkbox-active">
                                                <label for="correction_action'.$correction_action->id.'"></label>
                                            </td>
                                            <td>'.$i.'</td> 
                                            <td>
                                                <input type="text" name="constant_no['.$correction_action->id.']" value="'.$correction_action->constant_no.'" class="form-control corrective_action_id" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="correction_action['.$correction_action->id.']" value="'.$correction_action->corrective_action.'" class="form-control corrective_action_id" disabled>
                                            </td>
                                            <td>
                                                <input type="radio" id="active" name="is_deleted" class="with-gap" value="0"'.[$correction_action->is_deleted == "0"?"checked":""].'>       
                                                <label for="active">ACTIVE</label>
                                                <input type="radio" id="deactive" name="is_deleted" class="with-gap" value="1"'.[$correction_action->is_deleted == "1"?"checked":""].'>        
                                                <label for="deactive">DEACTIVE</label>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">update</i><span class="icon-name">Update</span></button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

             <!-- Start Modal for ADD/UPDATE CORRECTIVE ACTION -->                           
            <div class="modal fade" id="addNewCorrectiveAction" tabindex="-1" role="dialog" aria-labelledby="addNewCorrectiveAction" aria-hidden="true">    
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title" id="addNewCorrectiveAction">
                                <i class="material-icons">supervisor_account</i><span class="icon-name">Add Corrective Action</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'FrontEnd/ViewCorrectiveAction' ?>">
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Constant No</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="text" name="constant_no" class="form-control" placeholder="Enter Constant No">
                                    </div>
                                    <div class="col-md-6"> 
                                        <label class="form-label">Obsolete</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="radio" id="active" name="is_deleted" class="with-gap" value="0">       
                                        <label for="active">ACTIVE</label>
                                        <input type="radio" id="deactive" name="is_deleted" class="with-gap" value="1">        
                                        <label for="deactive">DEACTIVE</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-6"> 
                                        <label class="form-label">Corrective Action</label>
                                    </div>
                                    <div class="form-line">
                                        <input type="text" name="correction_action" class="form-control" placeholder="Corrective Action">
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
             <!-- End Modal for ADD/UPDATE CORRECTIVE ACTION --> 