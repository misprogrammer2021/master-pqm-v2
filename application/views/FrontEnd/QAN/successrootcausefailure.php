<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-col-teal">
                <!-- <li><i class="material-icons">home</i> Home</a></li> -->
            </ol>
        </div>
    </div>
</section>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="alert alert-success">
                                <strong>Well done!</strong> Record Saved Successfully.
                            </div>
                            Please click this button to view
                            
                            <form method="POST" action="<?php  echo base_url(); ?>FrontEnd/ViewRootCauseFailureRecords/<?php echo $machine_breakdown_id;?>">
                            <button id='form' type='submit' name='submit' value='SUBMIT' class='btn btn-primary waves-effect'>VIEW</button>
                            </form>
                            
                        </div>
                    </div>
                </div>