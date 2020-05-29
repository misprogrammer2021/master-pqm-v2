<?php

$jsselect = TRUE;

?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <li class="active"><a href="<?=base_url('homepage')?>"><i class="material-icons">home</i> Home</a></li>
                <li><i class="material-icons">library_books</i>View User Details</li>
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
                <div class="table-responsive">
                    <table id="list_user" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Employee No</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                            $i=1;
                            foreach($view_user as $row)
                            {
                                echo "<tr>";
                                    echo "<td><a href='update_user_records?id=".$row->id."'>Update</a></td>";
                                    echo "<td>".$i."</td>";
                                    echo "<td>".$row->fullname."</td>";
                                    echo "<td>".$row->department_name."</td>";
                                    echo "<td>".$row->title."</td>";
                                    echo "<td>".$row->employee_no."</td>";
                                    echo "<td>".(($row->status == 0)?"Active":"Deactive")."</td>";
                                echo "</tr>";
                            $i++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Employee No</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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

    $(document).ready(function () {

        $('#list_user').DataTable({
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

