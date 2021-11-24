<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
  if(!isset($_SESSION['UserAdmin'])){
      header('location:auth/login.php');
  }
?>
<?php
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php';
?>

<div id="page-wrapper">
     
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>TRANG QUẢN TRỊ VIÊN</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                    <?php
                      $qrCat = "SELECT * FROM cat";
                      $resultCat = $conn->query($qrCat);                      
                    ?>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/cat/" title="">Quản lý danh mục</a></p>
                        <p class="text-muted">Có <?php echo $resultCat->num_rows; ?> danh mục</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                    <?php
                      $qrStory = "SELECT * FROM story";
                      $resultStory = $conn->query($qrStory);                      
                    ?>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/story/" title="">Quản lý truyện</a></p>
                        <p class="text-muted">Có <?php echo $resultStory->num_rows; ?> truyện</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                    <?php
                      $qrUser = "SELECT * FROM users";
                      $resultUser = $conn->query($qrUser);                      
                    ?>
                    <div class="text-box">
                        <p class="main-text"><a href="/admin/user/" title="">Quản lý người dùng</a></p>
                        <p class="text-muted">Có <?php echo $resultUser->num_rows; ?> người dùng</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>