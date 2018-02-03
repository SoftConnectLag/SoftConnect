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

        <div class="content mt-3 col-md-7">
            <form id="send-msg">
                <label for="filter">Filter By : </label>
                <select name="filter" id="filter" class="form-control">
                    <option value="all">Send to All</option>
                    <option value="level">By Level</option>
                    <option value="department">By Department</option>
                </select>                

                <div style="display:none; padding-top:10px;" id="levelSelector">
                    <label for="leveltosend" id="lbl1">Select Level : </label>
                    <select name="leveltosend" id="leveltosend" class="form-control">
                        <option value="100">100 Level</option>								
                        <option value="200">200 Level</option>
                        <option value="300">300 Level</option>
                        <option value="400">400 Level</option>
                        <option value="500">500 Level</option>
                        <option value="600">600 Level</option>
                        <option value="700">700 Level</option>
                        <option value="0" selected hidden>Select Level</option>
                    </select>
                </div>  

                <div style="display:none; padding-top:10px;" id="departmentSelector">
                    <label for="departmenttosend" id="lbl2">Select Department : </label>
                    <select name="departmenttosend" id="departmenttosend" class="form-control">
                        <option value="Computer Sciences">Computer Sciences</option>								
                        <option value="Mathematics">Mathematics</option>
                        <option value="Biochemistry">Biochemistry</option>
                        <option value="Microbiology">Microbiology</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="0" selected hidden>Select Department</option>
                    </select>
                </div>
                
                <div style="padding-top:10px;">
                    <label for="msgtosend">Message : </label>
                    <textarea class="form-control" rows="3" name="msgtosend" required id="msgtosend" placeholder="Type Message Here"></textarea>
                </div>

                <div style="padding-top:10px;">
                    <button type="submit" id="send-msg-btn" name="send=msg-btn" class="btn btn-success">Send Message</button>
                </div>

            </form>
        </div>

    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
</body>

</html>