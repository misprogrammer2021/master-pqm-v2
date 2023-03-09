<?php

    $jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">settings</i>Setting</li>
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
                    <center>Setting Management</center>                          
                </h3>
            </div>
            <div class="body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#partname" data-toggle="tab">PART NAME</a></li>
                    <li role="presentation"><a href="#purgelocation" data-toggle="tab">PURGE LOCATION</a></li>
                    <li role="presentation"><a href="#defectdescription" data-toggle="tab">DEFECT DESCRIPTION</a></li>
                    <li role="presentation"><a href="#rootcause" data-toggle="tab">ROOT CAUSE</a></li>
                    <li role="presentation"><a href="#correctiveaction" data-toggle="tab">CORRECTIVE ACTION</a></li>
                    <li role="presentation"><a href="#machine_no" data-toggle="tab">MACHINE NO</a></li>
                    <li role="presentation"><a href="#sector" data-toggle="tab">SECTOR</a></li>
                    <li role="presentation"><a href="#rule" data-toggle="tab">RULE</a></li>
                    <li role="presentation"><a href="#detectedgroup" data-toggle="tab">DETECTED GROUP</a></li>
                    <li role="presentation"><a href="#detectedusergroup" data-toggle="tab">DETECTED BY</a></li>
                    <li role="presentation"><a href="#osorus" data-toggle="tab">O/S OR U/S</a></li>
                    <li role="presentation"><a href="#datum" data-toggle="tab">DATUM</a></li>
                    <li role="presentation"><a href="#remarks" data-toggle="tab">REMARKS</a></li>
                    
                </ul><br/>

                <?php 

                    if(isset($message_display))
                    {
                        $msg_type = $message_display[0]=='ok'?'success':'danger';
                
                        echo '<div class="alert alert-'.$msg_type.'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'.($message_display[1]).'</div>';
                    }
                ?> 
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="partname">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_partname';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewPartName" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Part Name</span></button><br/><br/>
                                <table id="pname" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Part Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($part_name as $tab1)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="part_name'.$tab1->id.'" name="part_name_id['.$tab1->id.']" class="filled-in checkbox-active">
                                                    <label for="part_name'.$tab1->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="part_name['.$tab1->id.']" value="'.$tab1->part_name.'" class="form-control part_name_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active1'.$tab1->id.'_'.$i.'" name="is_active['.$tab1->id.']" value="1" class="with-gap" '.(($tab1->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active1'.$tab1->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active1'.$tab1->id.'_'.$i.'" name="is_active['.$tab1->id.']" value="0" class="with-gap" '.(($tab1->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active1'.$tab1->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete1'.$tab1->id.'_'.$i.'" name="is_delete['.$tab1->id.']" value="1" class="with-gap" '.(($tab1->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete1'.$tab1->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete1'.$tab1->id.'_'.$i.'" name="is_delete['.$tab1->id.']" value="0" class="with-gap" '.(($tab1->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete1'.$tab1->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab1->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab1->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab1->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab1->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Part Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="purgelocation">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_purgelocation';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewPurgeLocation" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Purge Location</span></button><br/><br/>
                                <table id="plocation" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Purge Name</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Show Process</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                        $i=1;
                                        foreach($purge_name as $tab2)
                                        {
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="purge_name_id'.$tab2->id.'" name="purge_name_id['.$tab2->id.']" class="filled-in checkbox-active">
                                                    <label for="purge_name_id'.$tab2->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="purge_name['.$tab2->id.']" value="'.$tab2->purge_name.'" class="form-control purge_name_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="text" name="order_no['.$tab2->id.']" value="'.$tab2->order_no.'" class="form-control purge_name_id" disabled>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_show'.$tab2->id.'_'.$i.'" name="show_process['.$tab2->id.']" value="1" class="with-gap" '.(($tab2->show_process == 1)?"checked":"").' disabled>
                                                    <label for="yes_show'.$tab2->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_show'.$tab2->id.'_'.$i.'" name="show_process['.$tab2->id.']" value="0" class="with-gap" '.(($tab2->show_process == 0)?"checked":"").' disabled>
                                                    <label for="no_show'.$tab2->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active2'.$tab2->id.'_'.$i.'" name="is_active['.$tab2->id.']" value="1" class="with-gap" '.(($tab2->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active2'.$tab2->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active2'.$tab2->id.'_'.$i.'" name="is_active['.$tab2->id.']" value="0" class="with-gap" '.(($tab2->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active2'.$tab2->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_delete2'.$tab2->id.'_'.$i.'" name="is_delete['.$tab2->id.']" value="1" class="with-gap" '.(($tab2->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete2'.$tab2->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete2'.$tab2->id.'_'.$i.'" name="is_delete['.$tab2->id.']" value="0" class="with-gap" '.(($tab2->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete2'.$tab2->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab2->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab2->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab2->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab2->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Purge Name</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Show Process</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="defectdescription">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_defectdescription';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewDefectDescription" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Defect Description</span></button><br/><br/>
                                <table id="ddescription" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Defect Description Name</th>
                                            <th style="width:20%">Defect Type</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      
                                        $i=1;
                                        foreach($defect_description as $tab3)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="defect_description_id'.$tab3->id.'" name="defect_description_id['.$tab3->id.']" class="filled-in checkbox-active">
                                                    <label for="defect_description_id'.$tab3->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="defect_description_name['.$tab3->id.']" value="'.$tab3->defect_description_name.'" class="form-control defect_description_id" disabled>
                                                </td>

                                                <td> 
                                                <div class="selectdefect">
                                                    <select id="defect_type['.$tab3->id.']" name="defect_type['.$tab3->id.']" class="form-control show-tick defect_description_id">
                                                    <option value="">--Please Select--</option>
                                                    ';
                                                    $selected = '';
                                                    foreach($defect_type as $index => $defect_obj){
                                                        
                                                        $selected = $defect_obj->defect_type ==  $tab3->defect_type?'selected':'';
                                                        echo '<option value="'.$defect_obj->defect_type.'" '.$selected.'>'.$defect_obj->defect_type.'</option>';
                                                    }
                                                    echo '</select>
                                                </div>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active3'.$tab3->id.'_'.$i.'" name="is_active['.$tab3->id.']" value="1" class="with-gap" '.(($tab3->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active3'.$tab3->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active3'.$tab3->id.'_'.$i.'" name="is_active['.$tab3->id.']" value="0" class="with-gap" '.(($tab3->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active3'.$tab3->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete3'.$tab3->id.'_'.$i.'" name="is_delete['.$tab3->id.']" value="1" class="with-gap" '.(($tab3->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete3'.$tab3->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete3'.$tab3->id.'_'.$i.'" name="is_delete['.$tab3->id.']" value="0" class="with-gap" '.(($tab3->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete3'.$tab3->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab3->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab3->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab3->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab3->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Defect Description Name</th>
                                            <th style="width:20%">Defect Type</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="rootcause">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_rootcause';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewRootCause" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Root Cause</span></button><br/><br/>
                                <table id="rcause" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <!-- <th style="width:5%">Constant No</th> -->
                                            <th style="width:20%">Root Cause</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($root_cause as $tab4)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="root_cause'.$tab4->id.'" name="root_cause_id['.$tab4->id.']" class="filled-in checkbox-active">
                                                    <label for="root_cause'.$tab4->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td>
                                                <td>
                                                    <input type="text" name="root_cause['.$tab4->id.']" value="'.$tab4->root_cause.'" class="form-control root_cause_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active4'.$tab4->id.'_'.$i.'" name="is_active['.$tab4->id.']" value="1" class="with-gap" '.(($tab4->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active4'.$tab4->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active4'.$tab4->id.'_'.$i.'" name="is_active['.$tab4->id.']" value="0" class="with-gap" '.(($tab4->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active4'.$tab4->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_delete4'.$tab4->id.'_'.$i.'" name="is_delete['.$tab4->id.']" value="1" class="with-gap" '.(($tab4->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete4'.$tab4->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete4'.$tab4->id.'_'.$i.'" name="is_delete['.$tab4->id.']" value="0" class="with-gap" '.(($tab4->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete4'.$tab4->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab4->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab4->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab4->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab4->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                        // <td>
                                        //     <input type="text" name="constant_no['.$tab4->id.']" value="'.$tab4->constant_no.'" class="form-control root_cause_id" disabled>
                                        // </td>
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <!-- <th style="width:5%">Constant No</th> -->
                                            <th style="width:20%">Root Cause</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="correctiveaction">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_correctiveaction';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewCorrectiveAction" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Corrective Action</span></button><br/><br/>
                                <table id="caction" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <!-- <th style="width:5%">Constant No</th> -->
                                            <th style="width:20%">Corrective Action</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($corrective_action as $tab5)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="corrective_action'.$tab5->id.'" name="corrective_action_id['.$tab5->id.']" class="filled-in checkbox-active">
                                                    <label for="corrective_action'.$tab5->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td>
                                                <td>
                                                    <input type="text" name="corrective_action['.$tab5->id.']" value="'.$tab5->corrective_action.'" class="form-control corrective_action_id" style="width:100%" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active5'.$tab5->id.'_'.$i.'" name="is_active['.$tab5->id.']" value="1" class="with-gap" '.(($tab5->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active5'.$tab5->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active5'.$tab5->id.'_'.$i.'" name="is_active['.$tab5->id.']" value="0" class="with-gap" '.(($tab5->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active5'.$tab5->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_delete5'.$tab5->id.'_'.$i.'" name="is_delete['.$tab5->id.']" value="1" class="with-gap" '.(($tab5->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete5'.$tab5->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete5'.$tab5->id.'_'.$i.'" name="is_delete['.$tab5->id.']" value="0" class="with-gap" '.(($tab5->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete5'.$tab5->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab5->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab5->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab5->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab5->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        // <td>
                                        //     <input type="text" name="constant_no['.$tab5->id.']" value="'.$tab5->constant_no.'" class="form-control corrective_action_id" disabled>
                                        // </td>
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <!-- <th style="width:5%">Constant No</th> -->
                                            <th style="width:20%">Corrective Action</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="machine_no">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_machineno';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewMachineNo" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Machine No</span></button><br/><br/>
                                <table id="mno" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:10%">Machine Name</th>
                                            <th style="width:10%">Sector</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      
                                        $i=1;
                                        foreach($machine_no as $index => $machine_row){
                                            $sector_list[$machine_row->sector_id] =  $machine_row->sector_name;
                                        }
                                        
                                        foreach($machine_no as $tab6)
                                        {
                                            
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="machine_no'.$tab6->id.'" name="machine_no_id['.$tab6->id.']" class="filled-in checkbox-active">
                                                    <label for="machine_no'.$tab6->id.'"></label>
                                                </td>
                                                <td>'.$tab6->id.'</td> 
                                                <td>
                                                    <input type="text" name="machine_name['.$tab6->id.']" value="'.$tab6->machine_name.'" class="form-control machine_no_id" disabled>
                                                </td>

                                                <td> 
                                                <div class="selectsector">
                                                    <select id="sector_id['.$tab6->id.']" name="sector_id['.$tab6->id.']" class="form-control show-tick machine_no_id">
                                                        <option value="">--Please Select--</option>
                                                        ';
                                                        $selected = '';
                                                        foreach($sector_list as $sector_id => $sector_name){
                                                            
                                                            $selected = $tab6->sector_id ==  $sector_id?'selected':'';
                                                            echo '<option value="'.$sector_id.'" '.$selected.'>'.$sector_name.'</option>';
                                                        }
                                                    echo '</select>
                                                </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="order_no['.$tab6->id.']" value="'.$tab6->order_no.'" class="form-control machine_no_id" disabled>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_active6'.$tab6->id.'_'.$i.'" name="is_active['.$tab6->id.']" value="1" class="with-gap" '.(($tab6->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active6'.$tab6->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active6'.$tab6->id.'_'.$i.'" name="is_active['.$tab6->id.']" value="0" class="with-gap" '.(($tab6->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active6'.$tab6->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_delete6'.$tab6->id.'_'.$i.'" name="is_delete['.$tab6->id.']" value="1" class="with-gap" '.(($tab6->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete6'.$tab6->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete6'.$tab6->id.'_'.$i.'" name="is_delete['.$tab6->id.']" value="0" class="with-gap" '.(($tab6->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete6'.$tab6->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab6->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab6->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab6->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab6->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                            $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:10%">Machine Name</th>
                                            <th style="width:10%">Sector</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
        
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="sector">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_sector';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewSector" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Sector</span></button><br/><br/>
                                <table id="stor" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:10%">Sector Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      
                                        $i=1;
                                        foreach($sector as $tab7)
                                        {
                                            
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="sector_id'.$tab7->id.'" name="sector_id['.$tab7->id.']" class="filled-in checkbox-active">
                                                    <label for="sector_id'.$tab7->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="sector_name['.$tab7->id.']" value="'.$tab7->sector_name.'" class="form-control sector_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active7'.$tab7->id.'_'.$i.'" name="is_active['.$tab7->id.']" value="1" class="with-gap" '.(($tab7->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active7'.$tab7->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active7'.$tab7->id.'_'.$i.'" name="is_active['.$tab7->id.']" value="0" class="with-gap" '.(($tab7->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active7'.$tab7->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete7'.$tab7->id.'_'.$i.'" name="is_delete['.$tab7->id.']" value="1" class="with-gap" '.(($tab7->is_delete== 1)?"checked":"").' disabled>
                                                    <label for="yes_delete7'.$tab7->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete7'.$tab7->id.'_'.$i.'" name="is_delete['.$tab7->id.']" value="0" class="with-gap" '.(($tab7->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete7'.$tab7->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab7->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab7->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab7->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab7->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:10%">Sector Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
        
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="rule">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_rule';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewRule" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Rule</span></button><br/><br/>
                                <table id="rle" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Rule Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th> 
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      
                                        $i=1;
                                        foreach($rule as $tab8)
                                        {
                                            
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="rule_id'.$tab8->id.'" name="rule_id['.$tab8->id.']" class="filled-in checkbox-active">
                                                    <label for="rule_id'.$tab8->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="rule_name['.$tab8->id.']" value="'.$tab8->rule_name.'" class="form-control rule_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active8'.$tab8->id.'_'.$i.'" name="is_active['.$tab8->id.']" value="1" class="with-gap" '.(($tab8->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active8'.$tab8->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active8'.$tab8->id.'_'.$i.'" name="is_active['.$tab8->id.']" value="0" class="with-gap" '.(($tab8->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active8'.$tab8->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete8'.$tab8->id.'_'.$i.'" name="is_delete['.$tab8->id.']" value="1" class="with-gap" '.(($tab8->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete8'.$tab8->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete8'.$tab8->id.'_'.$i.'" name="is_delete['.$tab8->id.']" value="0" class="with-gap" '.(($tab8->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete8'.$tab8->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab8->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab8->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab8->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab8->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Rule Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
        
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="detectedgroup">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_detectedgroup';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewDetectedGroup" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Detected Group</span></button><br/><br/>
                                <table id="dgroup" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Group Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      
                                        $i=1;
                                        foreach($detected_group as $tab9)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="detectedgroup_id'.$tab9->id.'" name="detectedgroup_id['.$tab9->id.']" class="filled-in checkbox-active">
                                                    <label for="detectedgroup_id'.$tab9->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td> 
                                                    <input type="text" name="group_name['.$tab9->id.']" value="'.$tab9->group_name.'" class="form-control detectedgroup_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active9'.$tab9->id.'_'.$i.'" name="is_active['.$tab9->id.']" value="1" class="with-gap" '.(($tab9->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active9'.$tab9->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active9'.$tab9->id.'_'.$i.'" name="is_active['.$tab9->id.']" value="0" class="with-gap" '.(($tab9->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active9'.$tab9->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete9'.$tab9->id.'_'.$i.'" name="is_delete['.$tab9->id.']" value="1" class="with-gap" '.(($tab9->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete9'.$tab9->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete9'.$tab9->id.'_'.$i.'" name="is_delete['.$tab9->id.']" value="0" class="with-gap" '.(($tab9->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete9'.$tab9->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab9->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab9->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab9->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab9->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                            $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Group Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
        
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="detectedusergroup">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_detectedusergroup';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewDetectedUserGroup" class="btn btn-success m-t-15 waves-effect"><span class="icon-name"><i class="material-icons">add_circle</i><span class="icon-name">New Detected By</span></button><br/><br/>
                                <table id="dusergroup" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Detected By</th>
                                            <th style="width:20%">Detected Group</th>
                                            <th style="width:5%">Show Detected</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      
                                        $i=1;
                                        foreach($detectedby_user_group as $index => $detectedby_user_group_row){
                                            
                                            $detected_list[$detectedby_user_group_row->detected_group_id] =  $detectedby_user_group_row->group_name;
                                            
                                        }

                                        foreach($detectedby_user_group as $tab10)
                                        {
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="detectedby_id'.$tab10->id.'" name="detectedby_id['.$tab10->id.']" class="filled-in checkbox-active-detectedby">
                                                    <label for="detectedby_id'.$tab10->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td> 
                                                    <input type="text" name="detectedby_user['.$tab10->id.']" value="'.$tab10->detectedby_user.'" class="form-control detectedby_id" disabled>
                                                </td>
                                                <td> 
                                                    <div class="selectdetectedusergroup">
                                                        <select id="detected_group_id['.$tab10->id.']" name="detected_group_id['.$tab10->id.']" class="form-control show-tick detectedby_id">
                                                            <option value="">--Please Select--</option>
                                                            ';
                                                            $selected = '';
                                                            foreach($detected_list as $detected_group_id => $group_name){

                                                                $selected = $tab10->detected_group_id == $detected_group_id?'selected':'';
                                                                echo '<option value="'.$detected_group_id.'" '.$selected.'>'.$group_name.'</option>';
                                                            }

                                                        echo '</select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_show'.$tab10->id.'_'.$i.'" name="show_detectedby['.$tab10->id.']" value="1" class="with-gap" '.(($tab10->show_detectedby == 1)?"checked":"").' disabled>
                                                    <label for="yes_show'.$tab10->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_show'.$tab10->id.'_'.$i.'" name="show_detectedby['.$tab10->id.']" value="0" class="with-gap" '.(($tab10->show_detectedby == 0)?"checked":"").' disabled>
                                                    <label for="no_show'.$tab10->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active10'.$tab10->id.'_'.$i.'" name="is_active['.$tab10->id.']" value="1" class="with-gap" '.(($tab10->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active10'.$tab10->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active10'.$tab10->id.'_'.$i.'" name="is_active['.$tab10->id.']" value="0" class="with-gap" '.(($tab10->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active10'.$tab10->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete9'.$tab10->id.'_'.$i.'" name="is_delete['.$tab10->id.']" value="1" class="with-gap" '.(($tab10->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete9'.$tab10->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete9'.$tab10->id.'_'.$i.'" name="is_delete['.$tab10->id.']" value="0" class="with-gap" '.(($tab10->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete9'.$tab10->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab10->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab10->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab10->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab10->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                            $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Detected By</th>
                                            <th style="width:20%">Detected Group</th>
                                            <th style="width:5%">Show Detected</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
        
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="osorus">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_osorus';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewOsOrUs" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New O/S or U/S</span></button><br/><br/>
                                <table id="osus" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($os_us as $tab11)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="os_us_id'.$tab11->id.'" name="os_us_id['.$tab11->id.']" class="filled-in checkbox-active">
                                                    <label for="os_us_id'.$tab11->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="name['.$tab11->id.']" value="'.$tab11->name.'" class="form-control os_us_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active11'.$tab11->id.'_'.$i.'" name="is_active['.$tab11->id.']" value="1" class="with-gap" '.(($tab11->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active11'.$tab11->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active11'.$tab11->id.'_'.$i.'" name="is_active['.$tab11->id.']" value="0" class="with-gap" '.(($tab11->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active11'.$tab11->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete11'.$tab11->id.'_'.$i.'" name="is_delete['.$tab11->id.']" value="1" class="with-gap" '.(($tab11->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete11'.$tab11->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete11'.$tab11->id.'_'.$i.'" name="is_delete['.$tab11->id.']" value="0" class="with-gap" '.(($tab11->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete11'.$tab11->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab11->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab11->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab11->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab11->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="datum">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_datum';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewDatum" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Datum</span></button><br/><br/>
                                <table id="datum" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($datum as $tab12)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="datum_id'.$tab12->id.'" name="datum_id['.$tab12->id.']" class="filled-in checkbox-active">
                                                    <label for="datum_id'.$tab12->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="name['.$tab12->id.']" value="'.$tab12->name.'" class="form-control datum_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active12'.$tab12->id.'_'.$i.'" name="is_active['.$tab12->id.']" value="1" class="with-gap" '.(($tab12->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active12'.$tab12->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active12'.$tab12->id.'_'.$i.'" name="is_active['.$tab12->id.']" value="0" class="with-gap" '.(($tab12->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active12'.$tab12->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete12'.$tab12->id.'_'.$i.'" name="is_delete['.$tab12->id.']" value="1" class="with-gap" '.(($tab12->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete12'.$tab12->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete12'.$tab12->id.'_'.$i.'" name="is_delete['.$tab12->id.']" value="0" class="with-gap" '.(($tab12->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete12'.$tab12->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab12->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab12->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab12->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab12->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade in active" id="remarks">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_remarks';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewRemarks" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">New Remarks</span></button><br/><br/>
                                <table id="remarks" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    
                                        $i=1;
                                        foreach($remarks as $tab13)
                                        {
                                        
                                            echo '
                                            
                                            <tr>
                                                <td align="center">
                                                    <input type="checkbox" id="remarks_id'.$tab13->id.'" name="remarks_id['.$tab13->id.']" class="filled-in checkbox-active">
                                                    <label for="remarks_id'.$tab13->id.'"></label>
                                                </td>
                                                <td>'.$i.'</td> 
                                                <td>
                                                    <input type="text" name="name['.$tab13->id.']" value="'.$tab13->name.'" class="form-control remarks_id" disabled>
                                                </td>
                                                <td>
                                                    <input type="radio" id="yes_active13'.$tab13->id.'_'.$i.'" name="is_active['.$tab13->id.']" value="1" class="with-gap" '.(($tab13->is_active == 1)?"checked":"").' disabled>
                                                    <label for="yes_active13'.$tab13->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_active13'.$tab13->id.'_'.$i.'" name="is_active['.$tab13->id.']" value="0" class="with-gap" '.(($tab13->is_active == 0)?"checked":"").' disabled>
                                                    <label for="no_active13'.$tab13->id.'_'.$i.'">NO</label>
                                                </td> 
                                                <td>
                                                    <input type="radio" id="yes_delete13'.$tab13->id.'_'.$i.'" name="is_delete['.$tab13->id.']" value="1" class="with-gap" '.(($tab13->is_delete == 1)?"checked":"").' disabled>
                                                    <label for="yes_delete13'.$tab13->id.'_'.$i.'">YES</label>
                                                    <input type="radio" id="no_delete13'.$tab13->id.'_'.$i.'" name="is_delete['.$tab13->id.']" value="0" class="with-gap" '.(($tab13->is_delete == 0)?"checked":"").' disabled>
                                                    <label for="no_delete13'.$tab13->id.'_'.$i.'">NO</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="createdat'.$tab13->id.'_'.$i.'" name="created_at" value="'.date("Y-m-d H:i:s",strtotime($tab13->created_at)).'" class="form-control"  readonly>
                                                </td>
                                                <td>
                                                    <input type="text" id="updatedat'.$tab13->id.'_'.$i.'" name="updated_at" value="'.date("Y-m-d H:i:s",strtotime($tab13->updated_at)).'" class="form-control"  readonly>
                                                </td>
                                            </tr>    
                                            
                                            ';
                                        $i++;
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="no-sort" style="width:5%"></th>
                                            <th style="width:5%">No</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>  
                                            <th style="width:10%">Created At</th>
                                            <th style="width:10%">Updated At</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label -->

<!-- Start Modal for ADD/UPDATE PART NAME -->                           
<div class="modal fade" id="addNewPartName" tabindex="-1" role="dialog" aria-labelledby="addNewPartName" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewPartName">
                    Part Name Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_partname' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="group_name">Part Name</label> 
                                <input type="text" name="part_name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>         
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
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
<!-- End Modal for ADD/UPDATE PART NAME --> 

<!-- Start Modal for ADD/UPDATE PURGE LOCATION -->                           
<div class="modal fade" id="addNewPurgeLocation" tabindex="-1" role="dialog" aria-labelledby="addNewPurgeLocation" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewPurgeLocation">
                    Purge Location Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_purgelocation' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="purge_name">Purge Name</label>
                                <input type="text" name="purge_name" class="form-control">
                                <br>
                                <label for="order_no">Order No</label>
                                <input type="text" name="order_no" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="show_process">Show Process</label><br/>
                                <input type="radio" id="yes_show" name="show_process" class="with-gap" value="1">       
                                <label for="yes_show">YES</label>
                                <input type="radio" id="no_show" name="show_process" class="with-gap" value="0">        
                                <label for="no_show">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="active">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
                
                   
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
<!-- End Modal for ADD/UPDATE PURGE LOCATION --> 

<!-- Start Modal for ADD/UPDATE DEFECT DESCRIPTION -->                           
<div class="modal fade" id="addNewDefectDescription" tabindex="-1" role="dialog" aria-labelledby="addNewDefectDescription" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewDefectDescription">
                    Defectives Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_defectdescription' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="defect_description_name">Defect Description Name</label> 
                                <input type="text" name="defect_description_name" value="" class="form-control">
                                <br>
                                <label for="defect_type">Defect Type</label>
                                <select id="defect_type" name="defect_type" class="show-tick form-control">
                                    <option value="">--Please Select--</option>
                                    <option value="MECHANICAL">MECHANICAL</option>
                                    <option value="VISUAL">VISUAL</option>>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>         
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
                
                    
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
<!-- End Modal for ADD/UPDATE DEFECT DESCRIPTION --> 

<!-- Start Modal for ADD/UPDATE ROOT CAUSE -->                           
<div class="modal fade" id="addNewRootCause" tabindex="-1" role="dialog" aria-labelledby="addNewRootCause" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewRootCause">
                    Root Cause Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_rootcause' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                               <!--  <label for="constant_no">Constant No</label>
                                <input type="text" name="constant_no" class="form-control">
                                <br> -->
                                <label for="root_cause">Root Cause</label>
                                <input type="text" name="root_cause" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
                    
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
<!-- End Modal for ADD/UPDATE DEFECT DESCRIPTION -->

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
                    Corrective Action Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_correctiveaction' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <!-- <label for="constant_no">Constant No</label>
                                <input type="text" name="constant_no" class="form-control">
                                <br> -->
                                <label for="corrective_action">Corrective Action</label>
                                <input type="text" name="corrective_action" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>

                    
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

<!-- Start Modal for ADD/UPDATE MACHINE NO -->                           
<div class="modal fade" id="addNewMachineNo" tabindex="-1" role="dialog" aria-labelledby="addNewMachineNo" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewMachineNo">
                    Machine No Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_machineno' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="machine_name">Machine No</label>
                                <input type="text" name="machine_name" class="form-control">
                                <br>
                                <label for="sector">Sector</label>
                                <select id="sector" name="sector" class="show-tick form-control">
                                    <option value="">--Please Select--</option>
                                    <option value="TA">TA</option>
                                    <option value="TC">TC</option>
                                    <option value="VMI">VMI</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>    
                    </div><br/>
                  
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
<!-- End Modal for ADD/UPDATE MACHINE NO -->

<!-- Start Modal for ADD/UPDATE SECTOR -->                           
<div class="modal fade" id="addNewSector" tabindex="-1" role="dialog" aria-labelledby="addNewSector" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewSector">
                    Sector Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_sector' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="sector_name">Sector Name</label> 
                                <input type="text" name="sector_name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="active">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
                
                  
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
<!-- End Modal for ADD/UPDATE SECTOR -->

<!-- Start Modal for ADD/UPDATE RULE -->                           
<div class="modal fade" id="addNewRule" tabindex="-1" role="dialog" aria-labelledby="addNewRule" aria-hidden="true">    
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewRule">
                    Rule Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_rule' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="rule_name">Rule Name</label> 
                                <input type="text" name="rule_name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="active">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
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
<!-- End Modal for ADD/UPDATE RULE -->

<!-- Start Modal for ADD/UPDATE DETECTED GROUP -->                           
<div class="modal fade" id="addNewDetectedGroup" tabindex="-1" role="dialog" aria-labelledby="addNewDetectedGroup" aria-hidden="true">    
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewDetectedGroup">
                    Detected Group Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_detectedgroup' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="group_name">Group Name</label> 
                                <input type="text" name="group_name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="active">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>         
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
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
<!-- End Modal for ADD/UPDATE DETECTED GROUP -->

<!-- Start Modal for ADD/UPDATE DETECTED USER GROUP -->                           
<div class="modal fade" id="addNewDetectedUserGroup" tabindex="-1" role="dialog" aria-labelledby="addNewDetectedUserGroup" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewDetectedUserGroup">
                    Detected User Group Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_detectedusergroup' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="detectedby_user">Detected By Name</label>
                                <input type="text" name="detectedby_user" class="form-control">
                                <br>
                                <label for="detected_group_id">Detected By User Group</label>
                                <select id="detected_group_id" name="detected_group_id" class="show-tick form-control">
                                    <option value="">--Please Select--</option>
                                        <?php
                                        
                                            foreach($detected_group as $index => $row){

                                                echo '<option value="'.@$row->id.'">'.@$row->group_name.'</option>';
                                            }
                                        
                                        ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="sh">Show Detected By</label><br/>
                                <input type="radio" id="yes_show" name="show_detectedby" class="with-gap" value="1" checked>       
                                <label for="yes_show">YES</label>
                                <input type="radio" id="no_show" name="show_detectedby" class="with-gap" value="0">        
                                <label for="no_show">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                            <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>        
                                <label for="no_delete">NO</label>
                            </div>
                        </div>    
                    </div><br/>
                
                    <!-- <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Detected By Name</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="detectedby_user" value="" class="form-control">
                        </div><br/>
                        <div class="col-md-12"> 
                            <label class="form-label">Detected By User Group</label>
                        </div>
                        <div class="form-line">
                            <select id="detected_group_id" name="detected_group_id" class="show-tick form-control">
                                <option value="">--Please Select--</option>
                                <?php
                                    
                                    foreach($detected_group as $index => $row){

                                        echo '<option value="'.@$row->id.'">'.@$row->group_name.'</option>';
                                    }
                                    
                                ?>    
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="active">Show Detected By</label><br/>
                        <input type="radio" id="yes_show" name="show_detectedby" class="with-gap" value="1" checked>       
                        <label for="yes_show">YES</label>
                        <input type="radio" id="no_show" name="show_detectedby" class="with-gap" value="0">        
                        <label for="no_show">NO</label>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label for="active">Active</label><br/>
                            <input type="radio" id="yes_active9" name="is_active" class="with-gap" value="1" checked>       
                            <label for="yes_active9">YES</label>
                            <input type="radio" id="no_active9" name="is_active" class="with-gap" value="0">        
                        <label for="no_active9">NO</label>
                    </div>
                    <div class="col-md-6">
                        <label for="obsolete">Obsolete</label><br/>
                        <input type="radio" id="yes_delete9" name="is_delete" class="with-gap" value="1">       
                        <label for="yes_delete9">YES</label>
                        <input type="radio" id="no_delete9" name="is_delete" class="with-gap" value="0" checked>         
                        <label for="no_delete9">NO</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                
                            </div>
                        </div>
                    </div> -->
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
<!-- End Modal for ADD/UPDATE DETECTED USER GROUP --> 

<!-- Start Modal for ADD/UPDATE O/S OR U/S -->                           
<div class="modal fade" id="addNewOsOrUs" tabindex="-1" role="dialog" aria-labelledby="addNewOsOrUs" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewOsOrUs">
                    O/S or U/S Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_osorus' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="name">Name</label> 
                                <input type="text" name="name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>         
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
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
<!-- End Modal for ADD/UPDATE O/S OR U/S --> 

<!-- Start Modal for ADD/UPDATE DATUM -->                           
<div class="modal fade" id="addNewDatum" tabindex="-1" role="dialog" aria-labelledby="addNewDatum" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewDatum">
                    Datum Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_datum' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="name">Name</label> 
                                <input type="text" name="name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>         
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
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
<!-- End Modal for ADD/UPDATE DATUM --> 

<!-- Start Modal for ADD/UPDATE REMARKS -->                           
<div class="modal fade" id="addNewRemarks" tabindex="-1" role="dialog" aria-labelledby="addNewRemarks" aria-hidden="true">    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="addNewRemarks">
                    Remarks Details
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_remarks' ?>">
                    <div class="row">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="name">Name</label> 
                                <input type="text" name="name" value="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6">
                                <label for="active">Active</label><br/>
                                <input type="radio" id="yes_active" name="is_active" class="with-gap" value="1" checked>       
                                <label for="yes_active">YES</label>
                                <input type="radio" id="no_active" name="is_active" class="with-gap" value="0">        
                                <label for="no_active">NO</label>
                            </div>
                            <div class="col-md-6">
                                <label for="obsolete">Obsolete</label><br/>
                                <input type="radio" id="yes_delete" name="is_delete" class="with-gap" value="1">       
                                <label for="yes_delete">YES</label>
                                <input type="radio" id="no_delete" name="is_delete" class="with-gap" value="0" checked>         
                                <label for="no_delete">NO</label>
                            </div>
                        </div>
                    </div><br/>
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
<!-- End Modal for ADD/UPDATE DATUM --> 

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

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);

    });

    $(document).ready(function () {
        $('input.checkbox-active').change(function () {

            if($(this).is(":checked"))
            {
                $(this).parent().siblings().find("input").attr("disabled",false);
                $(this).parents('td').siblings().find("div.selectsector").prop('disabled', false);
            }
            else{
                $(this).parent().siblings().find("input").attr("disabled",true);
                $(this).parents('td').siblings().find("div.selectsector").prop('disabled', true);
            }
        })

        $('input.checkbox-active-detectedby').change(function () {

            if($(this).is(":checked"))
            {
                $(this).parent().siblings().find("input").attr("disabled",false);
                $(this).parents('td').siblings().find("div.selectdetectedusergroup").prop('disabled', false);
            }
            else{
                $(this).parent().siblings().find("input").attr("disabled",true);
                $(this).parents('td').siblings().find("div.selectdetectedusergroup").prop('disabled', true);
            }
        })

        // $('#pname,#plocation').DataTable({
        //     "columnDefs": [ {
        //         // "orderable": false,
        //         // "className": 'checkbox-active',
        //         "targets": [0,1],
        //         "searchable": true
        //     } ]
        //     // "select": {
        //     //     style:    'os',
        //     //     selector: 'td:first-child'
        //     // },
        //     // "order": [[ 1, 'asc' ]]
        // });
        

    });

</script>

