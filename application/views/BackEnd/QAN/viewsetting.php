<?php

$jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li> -->
                <!-- <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li> -->
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
                    <li role="presentation" class="active"><a href="#partname" data-toggle="tab">PART NAME LIST</a></li>
                    <li role="presentation"><a href="#purgelocation" data-toggle="tab">PURGE LOCATION LIST</a></li>
                    <li role="presentation"><a href="#defectdescription" data-toggle="tab">DEFECT DESCRIPTION LIST</a></li>
                    <li role="presentation"><a href="#rootcause" data-toggle="tab">ROOT CAUSE LIST</a></li>
                    <li role="presentation"><a href="#correctiveaction" data-toggle="tab">CORRECTIVE ACTION LIST</a></li>
                    <li role="presentation"><a href="#machine_no" data-toggle="tab">MACHINE NO LIST</a></li>
                    <li role="presentation"><a href="#sector" data-toggle="tab">SECTOR LIST</a></li>
                    
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
                            <button type="button" data-toggle="modal" data-target="#addNewPartName" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Part Name</span></button><br/><br/>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:30%">Part Name</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="radio" id="yes_tab1'.$tab1->id.'_'.$i.'" name="is_deleted_partname['.$tab1->id.']" value="0" class="with-gap" '.(($tab1->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="yes_tab1'.$tab1->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab1'.$tab1->id.'_'.$i.'" name="is_deleted_partname['.$tab1->id.']" value="1" class="with-gap" '.(($tab1->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="no_tab1'.$tab1->id.'_'.$i.'">NO</label>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:30%">Part Name</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                                <!-- <input type="hidden" name="update" value="update_part_name"> -->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="purgelocation">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_purgelocation';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewPurgeLocation" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Purge Location</span></button><br/><br/>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:30%">Purge Name</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Show Process</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="checkbox" id="purge_name'.$tab2->id.'" name="purge_name_id['.$tab2->id.']" class="filled-in checkbox-active">
                                                <label for="purge_name'.$tab2->id.'"></label>
                                            </td>
                                            <td>'.$i.'</td> 
                                            <td>
                                                <input type="text" name="purge_name['.$tab2->id.']" value="'.$tab2->purge_name.'" class="form-control purge_name_id" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="order_no['.$tab2->id.']" value="'.$tab2->order_no.'" class="form-control purge_name_id" disabled>
                                            </td> 
                                            <td>
                                                <input type="radio" id="yes_show'.$tab2->id.'_'.$i.'" name="show_process['.$tab2->id.']" value="0" class="with-gap" '.(($tab2->show_process == 0)?"checked":"").' disabled>
                                                <label for="yes_show'.$tab2->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_show'.$tab2->id.'_'.$i.'" name="show_process['.$tab2->id.']" value="1" class="with-gap" '.(($tab2->show_process == 1)?"checked":"").' disabled>
                                                <label for="no_show'.$tab2->id.'_'.$i.'">NO</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="yes_active2'.$tab2->id.'_'.$i.'" name="is_active['.$tab2->id.']" value="0" class="with-gap" '.(($tab2->is_active == 0)?"checked":"").' disabled>
                                                <label for="yes_active2'.$tab2->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_active2'.$tab2->id.'_'.$i.'" name="is_active['.$tab2->id.']" value="1" class="with-gap" '.(($tab2->is_active == 1)?"checked":"").' disabled>
                                                <label for="no_active2'.$tab2->id.'_'.$i.'">NO</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="yes_tab2'.$tab2->id.'_'.$i.'" name="is_deleted_purge_name['.$tab2->id.']" value="1" class="with-gap" '.(($tab2->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="yes_tab2'.$tab2->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab2'.$tab2->id.'_'.$i.'" name="is_deleted_purge_name['.$tab2->id.']" value="0" class="with-gap" '.(($tab2->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="no_tab2'.$tab2->id.'_'.$i.'">NO</label>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:30%">Purge Name</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Show Process</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                                <!-- <input type="hidden" name="update" value="update_part_name"> -->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="defectdescription">
                        <!-- <b>Corrective Action</b> -->
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_defectdescription';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewDefectDescription" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Defect Description</span></button><br/><br/>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:30%">Defect Description Name</th>
                                            <th style="width:10%">Defect Type</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="text" name="defect_description['.$tab3->id.']" value="'.$tab3->defect_description_name.'" class="form-control defect_description_id" disabled>
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
                                        echo'    </select>
                                            </div>
                                            </td>
                                            <td>
                                                <input type="radio" id="yes_active3'.$tab3->id.'_'.$i.'" name="is_active['.$tab3->id.']" value="0" class="with-gap" '.(($tab3->is_active == 0)?"checked":"").' disabled>
                                                <label for="yes_active3'.$tab3->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_active3'.$tab3->id.'_'.$i.'" name="is_active['.$tab3->id.']" value="1" class="with-gap" '.(($tab3->is_active == 1)?"checked":"").' disabled>
                                                <label for="no_active3'.$tab3->id.'_'.$i.'">NO</label>
                                            </td> 
                                            <td>
                                                <input type="radio" id="yes_tab3'.$tab3->id.'_'.$i.'" name="is_deleted_defect_description['.$tab3->id.']" value="1" class="with-gap" '.(($tab3->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="yes_tab3'.$tab3->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab3'.$tab3->id.'_'.$i.'" name="is_deleted_defect_description['.$tab3->id.']" value="0" class="with-gap" '.(($tab3->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="no_tab3'.$tab3->id.'_'.$i.'">NO</label>
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
                                            <th style="width:30%">Defect Description Name</th>
                                            <th style="width:10%">Defect Type</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                                <!-- <input type="hidden" name="update" value="update_corrective_action"> -->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="rootcause">
                        <!-- <b>Corrective Action</b> -->
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_rootcause';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewRootCause" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Root Cause</span></button><br/><br/>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Constant No</th>
                                            <th style="width:30%">Root Cause</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="text" name="constant_no['.$tab4->id.']" value="'.$tab4->constant_no.'" class="form-control root_cause_id" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="root_cause['.$tab4->id.']" value="'.$tab4->root_cause.'" class="form-control root_cause_id" disabled>
                                            </td>
                                            <td>
                                                <input type="radio" id="yes_tab4'.$tab4->id.'_'.$i.'" name="is_deleted_root_cause['.$tab4->id.']" value="0" class="with-gap" '.(($tab4->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="yes_tab4'.$tab4->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab4'.$tab4->id.'_'.$i.'" name="is_deleted_root_cause['.$tab4->id.']" value="1" class="with-gap" '.(($tab4->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="no_tab4'.$tab4->id.'_'.$i.'">NO</label>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Constant No</th>
                                            <th style="width:30%">Root Cause</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                                <!-- <input type="hidden" name="update" value="update_corrective_action"> -->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="correctiveaction">
                        <!-- <b>Corrective Action</b> -->
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_correctiveaction';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewCorrectiveAction" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Corrective Action</span></button><br/><br/>
                                <table id="corr_act" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Constant No</th>
                                            <th style="width:30%">Corrective Action</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="text" name="constant_no['.$tab5->id.']" value="'.$tab5->constant_no.'" class="form-control corrective_action_id" disabled>
                                            </td>
                                            <td>
                                                <input type="text" name="corrective_action['.$tab5->id.']" value="'.$tab5->corrective_action.'" class="form-control corrective_action_id" style="width:100%" disabled>
                                            </td>
                                            <td>
                                                <input type="radio" id="yes_tab5'.$tab5->id.'_'.$i.'" name="is_deleted_corrective_action['.$tab5->id.']" value="0" class="with-gap" '.(($tab5->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="yes_tab5'.$tab5->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab5'.$tab5->id.'_'.$i.'" name="is_deleted_corrective_action['.$tab5->id.']" value="1" class="with-gap" '.(($tab5->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="no_tab5'.$tab5->id.'_'.$i.'">NO</label>
                                            </td>
                                        </tr>    
                                        
                                        ';
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Constant No</th>
                                            <th style="width:30%">Corrective Action</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                                <!-- <input type="hidden" name="update" value="update_corrective_action"> -->
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="machine_no">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_machineno';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewMachineNo" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Machine No</span></button><br/><br/>
                                <table id="mc_no" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Machine Name</th>
                                            <th style="width:10%">Sector</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="checkbox" id="machine_no_id'.$tab6->id.'" name="machine_no_id['.$tab6->id.']" class="filled-in checkbox-active">
                                                <label for="machine_no_id'.$tab6->id.'"></label>
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
                                        echo'    </select>
                                            </div>
                                            </td>
                                            <td>
                                                <input type="text" name="order_no['.$tab6->id.']" value="'.$tab6->order_no.'" class="form-control machine_no_id" disabled>
                                            </td> 
                                            <td>
                                                <input type="radio" id="yes_tab6'.$tab6->id.'_'.$i.'" name="is_deleted_machine_no['.$tab6->id.']" value="1" class="with-gap" '.(($tab6->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="yes_tab6'.$tab6->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab6'.$tab6->id.'_'.$i.'" name="is_deleted_machine_no['.$tab6->id.']" value="0" class="with-gap" '.(($tab6->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="no_tab6'.$tab6->id.'_'.$i.'">NO</label>
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
                                            <th style="width:10%">Machine Name</th>
                                            <th style="width:10%">Sector</th>
                                            <th style="width:10%">Order No</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
                                </table>
        
                            <button id="form" type="submit" name="update" value="SUBMIT" class="btn btn-success m-t-15 waves-effect pull-right"><i class="material-icons">save</i><span class="icon-name">Update</span></button>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="sector">
                        <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_sector';?>">
                            <div class="table-responsive">
                            <button type="button" data-toggle="modal" data-target="#addNewSector" class="btn btn-success m-t-15 waves-effect"><i class="material-icons">add_circle</i><span class="icon-name">Add New Sector</span></button><br/><br/>
                                <table id="sectors" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="no-sort" style="width:10%"></th>
                                            <th style="width:10%">No</th>
                                            <th style="width:10%">Sector Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
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
                                                <input type="radio" id="yes_active7'.$tab7->id.'_'.$i.'" name="is_active['.$tab7->id.']" value="0" class="with-gap" '.(($tab7->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="yes_active7'.$tab7->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_active7'.$tab7->id.'_'.$i.'" name="is_active['.$tab7->id.']" value="1" class="with-gap" '.(($tab7->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="no_active7'.$tab7->id.'_'.$i.'">NO</label>
                                            </td> 
                                            <td>
                                                <input type="radio" id="yes_tab7'.$tab7->id.'_'.$i.'" name="is_deleted_defect_description['.$tab7->id.']" value="1" class="with-gap" '.(($tab7->is_deleted == 1)?"checked":"").' disabled>
                                                <label for="yes_tab7'.$tab7->id.'_'.$i.'">YES</label>
                                                <input type="radio" id="no_tab7'.$tab7->id.'_'.$i.'" name="is_deleted_defect_description['.$tab7->id.']" value="0" class="with-gap" '.(($tab7->is_deleted == 0)?"checked":"").' disabled>
                                                <label for="no_tab7'.$tab7->id.'_'.$i.'">NO</label>
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
                                            <th style="width:10%">Sector Name</th>
                                            <th style="width:10%">Active</th>
                                            <th style="width:10%">Obsolete</th>
                                        </tr>
                                    </tfoot>
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Part Name</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_partname' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Part Name</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="part_name" class="form-control" placeholder="Enter Part Name">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab1" name="is_deleted_partname" class="with-gap" value="0">       
                            <label for="yes_tab1">YES</label>
                            <input type="radio" id="no_tab1" name="is_deleted_partname" class="with-gap" value="1">        
                            <label for="no_tab1">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_part_name"> -->
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Purge Location</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_purgelocation' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Purge Name</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="purge_name" class="form-control" placeholder="Enter Purge Name">
                        </div><br/>
                        <div class="col-md-12"> 
                            <label class="form-label">Order No</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="order_no" class="form-control" placeholder="Enter Order No">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Show Process</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_show" name="show_process" class="with-gap" value="0">       
                            <label for="yes_show">YES</label>
                            <input type="radio" id="no_show" name="show_process" class="with-gap" value="1">        
                            <label for="no_show">NO</label>
                        </div>
                    </div><br/>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Active</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_active2" name="is_active" class="with-gap" value="0">       
                            <label for="yes_active2">YES</label>
                            <input type="radio" id="no_active2" name="is_active" class="with-gap" value="1">        
                            <label for="no_active2">NO</label>
                        </div>
                    </div><br/>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab2" name="is_deleted_purge_name" class="with-gap" value="1">       
                            <label for="yes_tab2">YES</label>
                            <input type="radio" id="no_tab2" name="is_deleted_purge_name" class="with-gap" value="0">        
                            <label for="no_tab2">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_part_name"> -->
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Defect Description</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_defectdescription' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Defect Description Name</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="defect_description" class="form-control" placeholder=" Enter Defect Description Name">
                        </div><br/>
                        <div class="col-md-12">
                                <label class="form-label">Defect Type</label>
                        </div>
                        <div class="col-md-12">
                            <select id="defect_type" name="defect_type" class="show-tick form-control">
                                <option value="">--Please Select--</option>
                                <option value="SPC">SPC</option>
                                <option value="VISUAL">VISUAL</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Active</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_active6" name="is_active" class="with-gap" value="0">       
                            <label for="yes_active6">YES</label>
                            <input type="radio" id="no_active6" name="is_active" class="with-gap" value="1">        
                            <label for="no_active6">NO</label>
                        </div>
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab6" name="is_deleted_machine_no" class="with-gap" value="1">       
                            <label for="yes_tab6">YES</label>
                            <input type="radio" id="no_tab6" name="is_deleted_machine_no" class="with-gap" value="0">        
                            <label for="no_tab6">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_corrective_action"> -->
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Root Cause</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_rootcause' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Constant No</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="constant_no" class="form-control" placeholder="Enter Constant No">
                        </div><br/>
                        <div class="col-md-12"> 
                            <label class="form-label">Root Cause</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="root_cause" class="form-control" placeholder="Enter Root Cause">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab4" name="is_deleted_root_cause" class="with-gap" value="0">       
                            <label for="yes_tab4">YES</label>
                            <input type="radio" id="no_tab4" name="is_deleted_root_cause" class="with-gap" value="1">        
                            <label for="no_tab4">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_corrective_action"> -->
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Corrective Action</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_correctiveaction' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Constant No</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="constant_no" class="form-control" placeholder="Enter Constant No">
                        </div><br/>
                        <div class="col-md-12"> 
                            <label class="form-label">Corrective Action</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="corrective_action" class="form-control" placeholder="Enter Corrective Action">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab5" name="is_deleted_corrective_action" class="with-gap" value="0">       
                            <label for="yes_tab5">YES</label>
                            <input type="radio" id="no_tab5" name="is_deleted_corrective_action" class="with-gap" value="1">        
                            <label for="no_tab5">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_corrective_action"> -->
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Machine No</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_machineno' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Machine No</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="machine_name" class="form-control" placeholder="Enter Machine Name">
                        </div><br/>
                        <div class="col-md-4">
                            <label class="form-label">Sector</label>
                        </div>
                        <div class="col-md-12">
                            <select id="sector" name="sector" class="show-tick form-control">
                                <option value="">--Please Select--</option>
                                <option value="TA">TA</option>
                                <option value="TC">TC</option>
                                <option value="VMI">VMI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab6" name="is_deleted_machine_no" class="with-gap" value="0">       
                            <label for="yes_tab6">YES</label>
                            <input type="radio" id="no_tab6" name="is_deleted_machine_no" class="with-gap" value="1">        
                            <label for="no_tab6">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_corrective_action"> -->
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
                    <i class="material-icons">move_to_inbox</i><span class="icon-name">Add Sector</span>
                </h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-horizontal" role="form" action="<?php echo base_url().'BackEnd/processing_sector' ?>">
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-6"> 
                            <label class="form-label">Sector Name</label>
                        </div>
                        <div class="form-line">
                            <input type="text" name="sector_name" class="form-control" placeholder="Enter Sector Name">
                        </div><br/>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="col-md-12"> 
                            <label class="form-label">Active</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_active7" name="is_active" class="with-gap" value="0">       
                            <label for="yes_active7">YES</label>
                            <input type="radio" id="no_active7" name="is_active" class="with-gap" value="1">        
                            <label for="no_active7">NO</label>
                        </div>
                        <div class="col-md-12"> 
                            <label class="form-label">Obsolete</label>
                        </div>
                        <div class="form-line">
                            <input type="radio" id="yes_tab7" name="is_deleted_sector" class="with-gap" value="1">       
                            <label for="yes_tab7">YES</label>
                            <input type="radio" id="no_tab7" name="is_deleted_sector" class="with-gap" value="0">        
                            <label for="no_tab7">NO</label>
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
                        <!-- <input type="hidden" name="submit" value="insert_corrective_action"> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal for ADD/UPDATE MACHINE NO -->


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

    // $('.dataTable').DataTable( {
    //     paging: true,
    //     "order": [],
    //     "columnDefs": [ {
    //     "targets"  : 'no-sort',
    //     "orderable": false
    //     }]
    // } );
    
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
            // alert($(this).parent().siblings().find("input").val());
            $(this).parent().siblings().find("input").attr("disabled",false);
            $(this).parents('td').siblings().find("div.selectsector").prop('disabled', false);
        }
        else
        {
            // alert($(this).parent().siblings().find("input").val());
            $(this).parent().siblings().find("input").attr("disabled",true);
            $(this).parents('td').siblings().find("div.selectsector").prop('disabled', true);
        }
    })

    $('#mc_no,#corr_act,#sectors').DataTable({
        "columnDefs": [ {
            // "orderable": false,
            // "className": 'checkbox-active',
            "targets": [0,1],
            "searchable": false
        } ]
        // "select": {
        //     style:    'os',
        //     selector: 'td:first-child'
        // },
        // "order": [[ 1, 'asc' ]]
    });
});

</script>

