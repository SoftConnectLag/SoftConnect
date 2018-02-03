<?php
    session_start();
    if(!isset($_SESSION['admin_username']))
    {
        header("location:index.html");
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SoftConnect Admin - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>

<body>


    <!-- Left Panel -->

    <?php include "assets/sidebar.php"; ?>
    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <?php include "assets/header.php"; ?>

        <div class="content mt-3">

            <a href="compose.php">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-flat-color-1">
                        <div class="card-body pb-0">
                            <h4 class="mb-0">Compose</h4>
                            <p class="text-light" style="padding-top:30px"><span class="count" id="cur-msgs">0</span> sent messages</p>
                        </div>
                    </div>
                </div>
            </a>
            
            <a href="sent.php">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-flat-color-2">
                        <div class="card-body pb-0">
                            <h4 class="mb-0">Sent</h4>
                            <p class="text-light" style="padding-top:30px"><span class="count" id="msg-count">0</span> messages</p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="subscribers.php">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-flat-color-4">
                        <div class="card-body pb-0">
                            <h4 class="mb-0">Subscribers</h4>
                            <p class="text-light" style="padding-top:30px"><span class="count" id="sub-count">0</span> subscribers</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
</body>

</html>