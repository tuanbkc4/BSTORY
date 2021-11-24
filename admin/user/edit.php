<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<script type="text/javascript">
    document.title ="Edit user | VinaEnter Edu";
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa người dùng</h2>
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

                                <?php
                                $id = $_GET['id'];
                                $qr1 = "SELECT * FROM users WHERE user_id=$id";
                                $result1 = $conn->query($qr1);
                                $row1 = $result1->fetch_assoc();
                                $username = $row1['username'];
                                $fullname = $row1['fullname'];
                                if ($row1['username'] == 'admin' && $_SESSION['UserAdmin']['username'] != 'admin') {
                                    header('Location:index.php?msg=Bạn không có quyền sửa admin');
                                    die();
                                }
                                $passwordErr = $fullnameErr = "";
                                if (isset($_POST['submit'])) {
                                    $password = trim($_POST['password']);
                                    $fullname = trim($_POST['fullname']);
                                    // Kiểm tra
                                    // fullname
                                    if ($fullname == "") {
                                        $fullnameErr = "Vui lòng nhập fullname";
                                    } else {
                                        if (!checkName($fullname)) {
                                            $fullnameErr = "fullname không hợp lệ";
                                            $fullname = "";
                                            $password = "";
                                        }
                                    }
                                    //password
                                    if ($password != "" && !checkPassword($password)) {
                                        $passwordErr = "Password không hợp lệ (password có độ dài 6-32 ký tự,bao gồm số và chữ cái)";
                                        $password = "";
                                    }
                                    //edit user
                                    if ($passwordErr == "" && $fullnameErr == "") {
                                        if ($password == "") {
                                            $qr2 = "UPDATE users SET fullname = '$fullname' WHERE user_id = $id";
                                            $result2 = $conn->query($qr2);
                                            if ($result2) {
                                                header('location:index.php?msg=Sửa thành công');
                                                die();
                                            } else {
                                                header('location:index.php?msg=Sửa thất bại');
                                                die();
                                            }
                                        } else {
                                            $password = md5($password);
                                            $qr2 = "UPDATE users SET fullname = '$fullname',password = '$password' WHERE user_id = $id";
                                            $result2 = $conn->query($qr2);
                                            if ($result2) {
                                                header('location:index.php?msg=Sửa thành công');
                                                die();
                                            } else {
                                                header('location:index.php?msg=Sửa thất bại');
                                                die();
                                            }
                                        }
                                    }
                                }
                                ?>
                                <form role="form" method="post" action="">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" readonly value="<?php echo $username; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" />
                                        <span style="color:red;font-style:italic;margin-left:4px;margin-top:4px;display:block;"><?php echo $passwordErr; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>" />
                                        <span style="color:red;font-style:italic;margin-left:4px;margin-top:4px;display:block;"><?php echo $fullnameErr; ?></span>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                </form>



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