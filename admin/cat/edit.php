<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<script type="text/javascript">
    document.title = "Edit category | VinaEnter Edu";
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa danh mục</h2>
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
                                        $('.formEditCat').validate({
                                            rules: {
                                                tenCat: {
                                                    required: true,
                                                }
                                            },
                                            messages: {
                                                tenCat: {
                                                    required: 'Vui lòng nhập tên danh mục',
                                                }
                                            }
                                        });
                                    });
                                </script>
                                <?php
                                $id = $_GET["id"];
                                $qr1 = "SELECT * FROM cat WHERE cat_id = $id";
                                $result1 = $conn->query($qr1);
                                $row1 = $result1->fetch_assoc();
                                $name = $row1['name'];
                                // Kiểm tra
                                $nameErr = "";
                                if (isset($_POST['submit'])) {
                                    $name = trim($_POST['tenCat']);
                                    if ($name == "") {
                                        $nameErr = "Vui lòng nhập tên danh mục";
                                        $name = "";
                                    } else {
                                        if (!checkName($name)) {
                                            $nameErr = "Tên danh mục không hợp lệ";
                                            $name = "";
                                        } else {
                                            $qrCheckCatName = "SELECT * FROM cat WHERE name = '$name' && cat_id !=$id";
                                            $resultCheck = $conn->query($qrCheckCatName);
                                            if ($resultCheck->num_rows == 0) {
                                                $qr2 = "UPDATE cat SET name = '$name' WHERE cat_id=$id";
                                                $result2 = $conn->query($qr2);
                                                if ($result2) {
                                                    header('location:index.php?msg=Sửa thành công');
                                                    die();
                                                } else {
                                                    header('location:index.php?msg=Sửa thất bại');
                                                    die();
                                                }
                                            } else {
                                                $nameErr = "Tên danh mục đã tồn tại";
                                                $name = "";
                                            }
                                        }
                                    }
                                }
                                ?>
                                <form role="form" method="post" action="" class="formEditCat">
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" name="tenCat" class="form-control" value="<?php echo $name; ?>" />
                                        <span class="error"><?php echo $nameErr; ?></span>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
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