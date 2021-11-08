<section class="content">
    <div class="container-fluid">
        <div class="block-header"><h2>DASHBOARD</h2></div>

        <style>
            /* For Datatables sliding child details */
            table.dataTable tbody td.no-padding {
                padding: 0;
            }
            div.slider {
                display: none;
            }
            </style>

        <!-- QAN Active List -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>Closed Ticket</h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                
                            </div>
                        </div>
                    </div>
                    <div class="body">
                    
                        <table id="qan_closed_ticket_list" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Seq</th>
                                    <th>QAN NO</th>
                                    <th width="15%">Ticket Status</th>
                                    <th>Defect Description</th>
                                    <!-- <th width="2%">Acknowledge</th> -->
                                    <th width="2%">Submission No</th>
                                    <!-- <th>Progress</th> -->
                                    <th>Machine Resume</th>
                                    <th>Result Inspection</th>
                                    <!-- <th>Rej/Aff</th> -->
                                    <th>Start DateTime</th>
                                    <!-- <th>Machine Resume</th> -->
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            
                            <tfoot>
                                <tr>
                                    <th>Seq</th>
                                    <th>QAN NO</th>
                                    <th width="15%">Ticket Status</th>
                                    <th>Defect Description</th>
                                    <!-- <th width="2%">Acknowledge</th> -->
                                    <th width="2%">Submission No</th>
                                    <!-- <th>Progress</th> -->
                                    <th>Machine Resume</th>
                                    <th>Result Inspection</th>
                                    <!-- <th>Rej/Aff</th> -->
                                    <th>Start DateTime</th>
                                    <!-- <th>Machine Resume</th> -->
                                    <!-- <th>Action</th> -->
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# QAN Active List -->  
    </div><!-- #END# Container -->  
</section>
        