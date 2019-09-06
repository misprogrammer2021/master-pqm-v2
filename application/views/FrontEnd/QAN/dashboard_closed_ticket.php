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
                                    <th></th>
                                    <th>Seq</th>
                                    <th>Qan No</th>
                                    <th width="15%">Status</th>
                                    <th>Defect Description</th>
                                    <th width="2%">Acknowledge</th>
                                    <th>Progress</th>
                                    <th>Rej/Aff</th>
                                    <th>Start DateTime</th>
                                    <th>Elapsed Time</th>
                                </tr>
                            </thead>
                            
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Seq</th>
                                    <th>Qan No</th>
                                    <th width="15%">Status</th>
                                    <th>Defect Description</th>
                                    <th width="2%">Acknowledge</th>
                                    <th>Progress</th>
                                    <th>Rej/Aff</th>
                                    <th>Start DateTime</th>
                                    <th>Elapsed Time</th>
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
        