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
                <strong>Well done!</strong><?php echo $data->message;?> 
            </div>
            You will redirect to preview page within <span id="timer" class="lead">3</span> seconds. If not,please click this button.
            <form method="GET" action="<?php echo $data->redirect;?>">
            <button id="form" type="submit" name="submit" value="SUBMIT" class="btn btn-primary waves-effect">VIEW</button>
            </form>
        </div>
    </div>
</div>

<script>

// redirect to google after 3 seconds
//window.setTimeout(function() {
    //window.location.href = '<?php echo $data->redirect;?>';
//}, 3000);


/* Countdown seconds */
var count = 3;
/* Website to redirect */
var url = "<?php echo $data->redirect;?>";
/* Call function at specific intervals */
var countdown = setInterval(function() { 
    /* Display Countdown with txt */
    document.getElementById("timer").innerHTML = count--;
    /* If count is smaller than 0 ...*/
    if (count < 0) {
        document.getElementById("timer").value = "---";
        /* Clear timer set with setInterval */
        clearInterval(countdown);
        /* Redirect */
        window.location.href = url;
    } 
    // milliseconds
}, 1000);
 
</script>