<?php
session_start();
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/constant.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkInput.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/Utf8ToLatinUtil.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AdminCP | VinaEnter Edu</title>
    <!-- JQUERY SCRIPTS -->
    <script src="/templates/bstory/js/jquery-3.6.0.min.js"></script>
    <script src="/templates/bstory/js/jquery.validate.min.js"></script>
    <!-- ckeditor -->
    <script src="/templates/admin/assets/js/ckeditor/ckeditor.js"></script>
    <!-- ckfinder -->
    <script src="/templates/admin/assets/js/ckfinder/ckfinder.js"></script>
    <!-- BOOTSTRAP STYLES-->
    <link href="/templates/admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/templates/admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="/templates/admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin">VinaEnter Edu</a>
            </div>
            <?php
            if (isset($_SESSION['UserAdmin'])) {
            ?>
                <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> Xin chào <b><?php echo $_SESSION['UserAdmin']['fullname']; ?></b> &nbsp; <a href="/admin/auth/logout.php" class="btn btn-danger square-btn-adjust">Đăng xuất</a> </div>
            <?php
            }
            ?>

        </nav>
        <!-- /. NAV TOP  -->