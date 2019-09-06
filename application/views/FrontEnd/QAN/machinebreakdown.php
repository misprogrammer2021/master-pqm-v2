<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li><i class="material-icons">attachment</i> File</li>
            </ol>
        </div>
    </div>
</section>

<!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Machine Break Down Form
                                <small>Update: 16 Oct 2017, Doc No.: IPQA-MB-018, Revision: 05</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        QAN No:
                                        <span class="badge">00001</span>
                                    </button>
                                </li>
                                <li>
                                    <button class="btn bg-green btn-lg btn-block waves-effect pull-right" type="button">
                                        Status
                                        <span class="badge">New</span>
                                    </button>
                                </li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                                
                            </ul>
                            
                        </div>
                        <div class="body">
                            <form>
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="issued_by_user" name="issued_by_user" class="form-control">
                                                <label class="form-label">ISSUED BY</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="to_user" name="to_user" class="form-control">
                                                <label class="form-label">TO</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="date_issued" name="date_issued" class="datepicker form-control">
                                                <label class="form-label">DATE</label>
                                            </div>
                                        </div>
                                        <input type="checkbox" id="out_of_control" name="out_of_control" class="filled-in">
                                        <label for="out_of_control">OOC (OUT OF CONTROL)</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">ISSUED DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="issued_dept" name="issued_dept" class="form-control show-tick">
                                                    <option value="QA">QA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">TO DEPT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="to_dept" name="to_dept" class="form-control show-tick">
                                                    <option value="prod">Production</option>
                                                    <option value="eng">Engineering</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="form-label">SHIFT</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select id="shifttype" name="shifttype" class="form-control show-tick">
                                                    <option value="day">DAY SHIFT</option>
                                                    <option value="night">NIGHT SHIFT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                            <input type="checkbox" id="out_of_spec" name="out_of_spec" class="filled-in">
                                            <label for="out_of_spec">OOS (OUT OF SPEC)</label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="time_issued" name="time_issued" class="timepicker form-control">
                                                <label class="form-label">TIME</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <h5>DEFECT INFORMATION <i>(To be filled in by QA)</i></h5>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="part_name" name="part_name" class="form-control">
                                                <label class="form-label">PART NAME</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="cav_no" name="cav_no" class="form-control">
                                                <label class="form-label">CAV NO (if any)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_no" name="machine_no" class="form-control">
                                                <label class="form-label">M/C NO</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="up_affected" name="up_affected" class="form-control">
                                                <label class="form-label">UP AFFECTED</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_process" name="machine_process" class="form-control">
                                                <label class="form-label">PROCESS</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="detected_by" name="detected_by" class="form-control">
                                                <label class="form-label">DETECTED BY</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea id="defect_description" name="defect_description" class="form-control"></textarea>
                                                <label class="form-label">DEFECT DESCRIPTION</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="last_pass_sample_datetime" name="last_pass_sample_datetime" class="datetimepicker form-control">
                                                <label class="form-label">LAST PASSED SAMPLE DATETIME</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="ack_by_eng" name="ack_by_eng" class="form-control">
                                                <label class="form-label">ACKNOWLEDGED BY <i>ENGINEERING (TECH & ABOVE)</i></label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="purge_from_datetime" name="purge_from_datetime" class="form-control">
                                                <label class="form-label">PURGE FROM</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="ack_by_prod" name="ack_by_prod" class="form-control">
                                                <label class="form-label">ACKNOWLEDGED BY <i>PRODUCTION (LEADER & ABOVE)</i></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <table class="table table-hover table-bordered">
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
                                                    <tr>
                                                        <td>QA Sample</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Engineering Sample</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Inside CNC</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>P1</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>P2</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>P3</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Washing</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Brushing</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>CP</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FVMI</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <td><b>Total</b></td>
                                                    <td></td>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="estimate_qty" name="estimate_qty" class="form-control">
                                                <label class="form-label">ESTIMATE QTY</label>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="ack_by_qa" name="ack_by_qa" class="form-control">
                                                <label class="form-label">ACKNOWLEDGED BY <i>QC/QA (LEADER & ABOVE)</i></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <table class="table table-hover table-bordered">
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
                                                    <tr>
                                                        <td>Air Gauge</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>EDI</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>CMM/Marposs</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Visual</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Runner</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="col-md-8 col-sm-8">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>LOCATION TO PURGE</th>
                                                        <th>AFFECTED QTY</th>
                                                        <th>SORTING RESULT - GOOD QTY</th>
                                                        <th>SORTING RESULT - REJ QTY</th>
                                                        <th>PROD.PIC (LEADER & ABOVE)</th>
                                                        <th>QA BUY-OFF (LEADER & ABOVE)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>M/C - P1</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>M/C - P2</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>M/C - P3</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>M/C - P4</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>M/C - SPM</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>VMI</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>WASHING</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BRUSHING</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FVMI</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FG</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>TOTAL</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <h5>DEFECTIVE PART DISPOSITION</h5>
                                            <input type="checkbox" id="scrap" name="scrap" class="filled-in">
                                            <label for="scrap">SCRAP</label>
                                            <input type="checkbox" id="rework" name="rework" class="filled-in">
                                            <label for="rework">REWORK</label>
                                            <input type="checkbox" id="UAI" name="UAI" class="filled-in">
                                            <label for="UAI">UAI</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="rework_order" name="rework_order" class="form-control">
                                                    <label class="form-label">Rework order #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="scrap_no" name="scrap_no" class="form-control">
                                                    <label class="form-label">Scrap #<i>(if any)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="UAI_no" name="UAI_no" class="form-control">
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
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="reported_by_mrb" name="reported_by_mrb" class="form-control">
                                                    <label class="form-label">Reported by:<i>(MRB)</i></label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="qa_reinspection_verification" name="qa_reinspection_verification" class="form-control">
                                                    <label class="form-label">QA Re-inspection Verification:<i>(Leader & Above)</i></label>
                                                </div>
                                            </div>
                                            <input type="radio" id="qa_reinspection_status1" name="qa_reinspection_status" class="with-gap">
                                            <label for="qa_reinspection_status1">Accept</label>
                                            <input type="radio" id="qa_reinspection_status2" name="qa_reinspection_status" class="with-gap">
                                            <label for="qa_reinspection_status2">Reject</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <h5>ROOT CAUSE FAILURE ANALYSIS <i>(BY PROCESS OWNER)</i></h5>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea id="root_cause" name="root_cause" class="form-control"></textarea>
                                                <label class="form-label">ROOT CAUSE</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea id="corrective_action" name="corrective_action" class="form-control"></textarea>
                                                <label class="form-label">CORRECTIVE ACTION</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="PIC" name="PIC" class="form-control">
                                                <label class="form-label">PERSON IN-CHARGE</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="rcfa_ack_by_eng" name="rcfa_ack_by_eng" class="form-control">
                                                <label class="form-label">ACKNOWLEDGED BY <i>Engineer / Manager (Eng Dept)</i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="rcfa_approved_by" name="rcfa_approved_by" class="form-control">
                                                <label class="form-label">APPROVED BY <i>(Supervisor & Above)</i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nav tabs -->
                                    <form action="#" method="post">
                                    <div class="col-md-12 col-sm-12">
                                        <ul class="nav nav-tabs tab-col-teal" id="eng_tab" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#sub1" data-toggle="tab">
                                                    <i class="material-icons">insert_drive_file</i>1st Submission
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="javascript:;" id="add_sub">
                                                    <span class="btn btn-success"><i class="material-icons">add</i>NEW</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content" id="eng_content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="sub1">
                                                <b>QA Inspection Data - 1st Submission</b>
                                                <table class="table table-hover table-bordered">
                                                    <tr>
                                                        <th>ITEM INSPECTION</th>
                                                        <th>CMM</th>
                                                        <th>EDI</th>
                                                        <th>AIR GAUGE</th>
                                                        <th>GO NO GO</th>
                                                        <th>QV</th>
                                                        <th>MP</th>
                                                        <th>VISUAL</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Inspect By</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time Start</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time End</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Result</td>
                                                        <td>
                                                            <select class="form-control" name="cmm_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="edi_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="ag_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="gng_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="qv_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="mp_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="vis_res1">
                                                                <option value="1">PASS</option>
                                                                <option value="0">FAIL</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <button type="button" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>

                                    </form>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="alert bg-green text-center">FOR QA USE ONLY</h4>
                                    <h5>APPROVAL <i>(Leader & Above)</i></h5>
                                    <label class="form-label">MACHINE STATUS</label>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="radio" id="machine_status1" name="machine_status" class="with-gap">
                                        <label for="machine_status1">RUN</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_run_pic" name="machine_run_pic" class="form-control">
                                                <label class="form-label">APPROVED BY</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="radio" id="machine_status2" name="machine_status" class="with-gap">
                                        <label for="machine_status2">STOP</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="machine_stop_reason" name="machine_stop_reason" class="form-control">
                                                <label class="form-label">IF STOP, REASON:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <h5>REVIEW BY QUALITY ENGINEER</h5>
                                    <div class="clearfix"></div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="form-label">PURGING COMPLETED?</label>
                                        <input type="radio" id="purging_completed1" name="purging_completed" class="with-gap">
                                        <label for="purging_completed1">YES</label>
                                        <input type="radio" id="purging_completed2" name="purging_completed" class="with-gap">
                                        <label for="purging_completed2">No</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="closed_by" name="closed_by" class="form-control">
                                                <label class="form-label">REVIEWED AND CLOSED BY <i>(Quality Engineer / Manager)</i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="form-label">NOTIFY NEXT PROCESS</label>
                                        <input type="radio" id="notify_next1" name="notify_next" class="with-gap">
                                        <label for="notify_next1">YES</label>
                                        <input type="radio" id="purging_completed2" name="notify_next" class="with-gap">
                                        <label for="notify_next2">NO</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="closed_date" name="closed_date" class="datetimepicker form-control">
                                                <label class="form-label">REVIEWED AND CLOSED DATE</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="form-label">FIX VALIDATION RESULT</label>
                                        <input type="radio" id="validation_result1" name="validation_result" class="with-gap">
                                        <label for="validation_result1">PASS</label>
                                        <input type="radio" id="validation_result2" name="validation_result" class="with-gap">
                                        <label for="validation_result2">FAIL</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12">
                                        <!-- <input type="checkbox" id="remember_me_2" class="filled-in">
                                        <label for="remember_me_2">Remember Me</label> -->
                                        <br>
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                                    </div>
                                </div>
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
    //Textare auto growth
    //autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
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

$('#add_sub').click(function (e) {
    var nextTab = $('#eng_tab li').size();

    // create the tab
    $(this).closest('li').before('<li role="presentation"><a href="#sub'+nextTab+'" data-toggle="tab"><i class="material-icons">insert_drive_file</i>'+ordinal_suffix_of(nextTab)+' Submission</a></li>');

    // create the tab content
    var format = '<div role="tabpanel" class="tab-pane fade" id="sub'+nextTab+'"><b>' +ordinal_suffix_of(nextTab)+' Submission Data</b></div>';
    var format_table = '';
    format_table = '<div role="tabpanel" class="tab-pane fade in active" id="sub' + nextTab + '">';
    format_table += '<b>QA Inspection Data - ' +ordinal_suffix_of(nextTab)+' Submission Data</b>';
    format_table += '<table class="table table-hover table-bordered">';
    format_table += '        <tr>';
    format_table += '<th>ITEM INSPECTION</th>';
    format_table += '            <th>CMM</th>';
    format_table += '            <th>EDI</th>';
    format_table += '            <th>AIR GAUGE</th>';
    format_table += '            <th>GO NO GO</th>';
    format_table += '           <th>QV</th>';
    format_table += '            <th>MP</th>';
    format_table += '            <th>VISUAL</th>';
    format_table += '        </tr>';
    format_table += '        <tr>';
    format_table += '            <td>Inspect By</td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '            <td></td>';
    format_table += '        </tr>';
    format_table += '        <tr>';
    format_table += '            <td>Time Start</td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '</tr>';
    format_table += '<tr>';
    format_table += '<td>Time End</td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '<td></td>';
    format_table += '</tr>';
    format_table += '<tr>';
    format_table += '<td>Result</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="cmm_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="edi_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="ag_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="gng_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="qv_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="mp_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '<td>';
    format_table += '<select class="form-control" name="vis_res' + nextTab + '">';
    format_table += '<option value="1">PASS</option>';
    format_table += '<option value="0">FAIL</option>';
    format_table += '<select>';
    format_table += '</td>';
    format_table += '</tr>';
    format_table += '</table>';
    format_table += '<button type="button" class="btn btn-success m-t-15 waves-effect pull-right">SUBMIT</button>';
    format_table += '</div>';
    format_table += '</div>';


    $(format_table).appendTo('#eng_content');

    // make the new tab active
    $('#eng_tab li:nth-child('+nextTab+') a').click();
});


function ordinal_suffix_of(i) {
    var j = i % 10,
        k = i % 100;
    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
};

</script>

