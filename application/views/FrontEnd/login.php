<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | JCY PQM - Product Quality System</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->

    <style>
    /* roboto-regular - latin_cyrillic-ext */
    @font-face {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    src: url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-regular.eot'); /* IE9 Compat Modes */
    src: local('Roboto'), local('Roboto-Regular'),
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-regular.woff2') format('woff2'), /* Super Modern Browsers */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-regular.woff') format('woff'), /* Modern Browsers */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-regular.ttf') format('truetype'), /* Safari, Android, iOS */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-regular.svg#Roboto') format('svg'); /* Legacy iOS */
    }
    /* roboto-700 - latin_cyrillic-ext */
    @font-face {
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 700;
    src: url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-700.eot'); /* IE9 Compat Modes */
    src: local('Roboto Bold'), local('Roboto-Bold'),
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-700.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-700.woff2') format('woff2'), /* Super Modern Browsers */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-700.woff') format('woff'), /* Modern Browsers */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-700.ttf') format('truetype'), /* Safari, Android, iOS */
        url('/assets/templates/fonts/roboto/roboto-v20-latin_cyrillic-ext-700.svg#Roboto') format('svg'); /* Legacy iOS */
    }

    /* fallback */
    @font-face {
    font-family: 'Material Icons';
    font-style: normal;
    font-weight: 400;
    src: url(/assets/templates/fonts/material-icon/MaterialIcons-Regular.eot);
    /* For IE6-8 */
    src: url(/assets/templates/fonts/material-icon/flUhRq6tzZclQEJ-Vdg-IuiaDsNa.woff) format('woff'),
         url(/assets/templates/fonts/material-icon/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
    }

    /* .material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
    } */

    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;  /* Preferred icon size */
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;

        /* Support for all WebKit browsers. */
        -webkit-font-smoothing: antialiased;
        /* Support for Safari and Chrome. */
        text-rendering: optimizeLegibility;

        /* Support for Firefox. */
        -moz-osx-font-smoothing: grayscale;

        /* Support for IE. */
        font-feature-settings: 'liga';
    }
    </style>

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url('assets/templates/plugins/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url('assets/templates/plugins/node-waves/waves.css')?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url('assets/templates/plugins/animate-css/animate.css')?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url('assets/templates/css/style.css')?>" rel="stylesheet">
</head>

<body class="login-page">

<?php
    if (isset($logout_message)) {
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
    }
?>
<?php
    if (isset($message_display)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
    }
?>

    <div class="login-box">
        <div class="logo">
        <h3 align = "center">JCY PQM - Product Quality System</h3>
        </div>
        <div class="card">
            <div class="body">
                <!-- <form id="sign_in" method="POST"> -->
                    <div class="msg">Sign in to start your session</div>

                    <?php echo form_open('login'); ?> 
                        <?php
                            echo "<div class='error_msg'>";
                            if (isset($error_message)) {
                                echo $error_message;
                            }
                                echo validation_errors();
                                echo "</div>";
                        ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <!-- <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="#">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </div> -->
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?=base_url('assets/templates/plugins/jquery/jquery.min.js')?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url('assets/templates/plugins/bootstrap/js/bootstrap.js')?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url('assets/templates/plugins/node-waves/waves.js')?>"></script>

    <!-- Validation Plugin Js -->
    <script src="<?=base_url('assets/templates/plugins/jquery-validation/jquery.validate.js')?>"></script>

    <!-- Custom Js -->
    <script src="<?=base_url('assets/templates/js/admin.js')?>"></script>
    <script src="<?=base_url('assets/templates/js/pages/examples/sign-in.js')?>"></script>
</body>

</html>