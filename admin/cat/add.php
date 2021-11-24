<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<script type="text/javascript">
    document.title = "Add category | VinaEnter Edu";
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('.formAddCat').validate({
                                            rules: {
                                                tenCat: {
                                                    required: true,
                                                }
                                            },
                                            messages: {
                                                tenCat: {
                                                    required: 'nhập tên danh mục',
                                                }
                                            }
                                        });
                                    });
                                </script>
                                <?php
                                $name = "";
                                $nameErr = "";
                                if (isset($_POST['submit'])) {
                                    $name = trim($_POST['tenCat']);
                                    if ($name == "") {
                                        $nameErr = "Vui lòng nhập tên danh mục";
                                    } else {
                                        if (!checkName($name)) {
                                            $nameErr = "Tên danh mục không hợp lệ";
                                        } else {
                                            $qrCheckCatName = "SELECT * FROM cat WHERE name = '$name'";
                                            $resultCheck = $conn->query($qrCheckCatName);
                                            if ($resultCheck->num_rows == 0) {
                                                $qr = "INSERT INTO cat(name) VALUES ('$name')";
                                                $result = $conn->query($qr);
                                                if ($result) {
                                                    header('location:index.php?msg=Thêm thành công');
                                                    die();
                                                } else {
                                                    header('location:index.php?msg=Thêm thất bại');
                                                    die();
                                                }
                                            } else {
                                                $nameErr = "Tên danh mục đã tồn tại";
                                            }
                                        }
                                    }
                                }
                                ?>
                                <form role="form" method="post" action="" class="formAddCat">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input id="catName" type="text" name="tenCat" class="form-control" />
                                        <span class="error"><?php echo $nameErr; ?></span>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
                                <style>
                                    .error {
                                        color: red;
                                        font-style: italic;
                                        margin-left: 4px;
                                        margin-top: 4px;
                                        display: block;
                                        font-weight:normal !important;
                                    }
                                </style>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>