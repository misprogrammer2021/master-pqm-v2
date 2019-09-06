<section class="content">
    <div class="container-fluid">
        <div class="block-header"><h2>DASHBOARD</h2></div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                    <a href="<?php echo base_url().'FrontEnd/mastertemplate'; ?>"><i class="material-icons">playlist_add_check</i></a>
                    </div>
                    <div class="content">
                        <p>CREATE NEW MACHINE BREAKDOWN FORM</p>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-blue hover-expand-effect">
                    <div class="icon">
                    <a href="<?php echo base_url().'FrontEnd/dashboard_closed_ticket'; ?>"><i class="material-icons">playlist_add_check</i></a>
                    </div>
                    <div class="content">
                        <p>ALL CLOSED TICKETS</p>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>    

        <style>
        /* For Datatables sliding child details */
        table.dataTable tbody td.no-padding {
            padding: 0;
        }
        div.slider {
            display: none;
        }
        </style>

        <!-- <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>Affected & Reject Quantity Report</h2>
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">
                                
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div style="width: 100%">
                            <canvas id="canvas"></canvas>
                        </div>

                    <script>
                        var barChartData = {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            data: [],
                            label: 'Affected',
                            backgroundColor: "#FAEBCC",
                            xAxisID: "bar-x-axis"
                            // type: 'line',
                            // label: 'This Year',
                            // fill: false,
                            // backgroundColor: "#fff",
                            // borderColor: "#70cbf4",
                            // borderCapStyle: 'butt',
                            // borderDash: [],
                            // borderDashOffset: 0.0,
                            // borderJoinStyle: 'miter',
                            // lineTension: 0.3,
                            // pointBackgroundColor: "#fff",
                            // pointBorderColor: "#70cbf4",
                            // pointBorderWidth: 1,
                            // pointHoverRadius: 5,
                            // pointHoverBackgroundColor: "#70cbf4",
                            // pointHoverBorderColor: "#70cbf4",
                            // pointHoverBorderWidth: 2,
                            // pointRadius: 4,
                            // pointHitRadius: 10
                        },  {
                            label: 'Reject',
                            backgroundColor: "#ef0000",
                            yAxisID: "bar-y-axis",
                            data: []
                        }]
                        };

                        window.onload = function() {
                        var ctx = document.getElementById("canvas").getContext("2d");
                        window.myChart = new Chart(ctx, {
                            type: 'bar',
                            data: barChartData,
                            options: {
                            title: {
                                display: false,
                                text: "Chart.js Bar Chart - Stacked"
                            },
                            tooltips: {
                                mode: 'label'
                            },
                            responsive: true,
                            scales: {
                                xAxes: [{
                                stacked: true,
                                }],
                                yAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    min: 0,
                                    max: 100
                                }
                                }, {
                                id: "bar-y-axis",
                                stacked: true,
                                display: false, 
                                ticks: {
                                    beginAtZero: true,
                                    min: 0,
                                    max: 100
                                },
                                type: 'linear'
                                }]
                            }
                            }
                        });
                        // logic to get new data
                        var getData = function() {
                            $.ajax({
                                url: '/FrontEnd/ajax_statistics_data',
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {

                                myChart.data.datasets[0].data=data.chart.affected;
                                myChart.data.datasets[1].data=data.chart.reject;
                                // re-render the chart
                                myChart.update();
                                }
                            });
                        };
                        getData();
                        };
                    </script>
                    </div>
                </div>    
            </div>
        </div> -->

            <!-- QAN New Task -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>New Task</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        
                            <table id="qan_task_list" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th width="2%">Seq</th>
                                        <th>QAN NO</th>
                                        <th>Status</th>
                                        <!-- <th>Acknowledge</th> -->
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th width="2%">Seq</th>
                                        <th>QAN NO</th>
                                        <th>Status</th>
                                        <!-- <th>Acknowledge</th> -->
                                        <th>Description</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-6">
                    <div class="card">
                    <div class="body bg-teal">
                            <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST MONTH
                                    <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST YEAR
                                    <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    ALL
                                    <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- #END# QAN New Task --> 

            <!-- QAN Active List -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Active QAN (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        
                            <table id="qan_active_list" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Seq</th>
                                        <th>QAN NO</th>
                                        <th width="15%">Status</th>
                                        <th>Defect Description</th>
                                        <th width="2%">Acknowledge</th>
                                        <th>Progress</th>
                                        <th>Rej/Aff</th>
                                        <th>Start DateTime</th>
                                        <th>Elapsed Time</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Seq</th>
                                        <th>QAN NO</th>
                                        <th width="15%">Status</th>
                                        <th>Defect Description</th>
                                        <th width="2%">Acknowledge</th>
                                        <th>Progress</th>
                                        <th>Rej/Aff</th>
                                        <th>Start DateTime</th>
                                        <th>Elapsed Time</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# QAN Active List -->  






















