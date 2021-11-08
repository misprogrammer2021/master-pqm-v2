<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=$header['pageName']?> | <?=$header['title']?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url('assets/templates/logo.ico')?>" type="image/x-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css"> -->
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
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url('assets/templates/plugins/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url('assets/templates/plugins/node-waves/waves.css')?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url('assets/templates/plugins/animate-css/animate.css')?>" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="<?=base_url('assets/templates/plugins/bootstrap-select/css/v1.12.4/bootstrap-select.css')?>" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?=base_url('assets/templates/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')?>" rel="stylesheet" />

    <!-- Bootstrap Tagsinput Css -->
    <link href="<?=base_url('assets/templates/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" rel="stylesheet">

    <!-- Bootstrap Chosen Css -->
    <link href="<?=base_url('assets/templates/plugins/chosen/chosen.min.css')?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url('assets/templates/css/themes/all-themes.css')?>" rel="stylesheet" />

    <!-- Bootstrap Footable Css -->
    <!-- <link href="<?=base_url('assets/templates/plugins/bootstrap-footable/css/footable-bootstrap.css')?>" rel="stylesheet"> -->

    <!-- JQUERY DATATABLES Css -->
    <link href="<?=base_url('assets/templates/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?=base_url('assets/templates/css/style.css')?>" rel="stylesheet">
    
</head>

<body class="theme-green ls-closed">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay">testing only</div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

