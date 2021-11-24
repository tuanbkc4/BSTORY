<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<script type="text/javascript">
    document.title = "Add user | VinaEnter Edu";
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm người dùng</h2>
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
                                        $('.formAddUser').validate({
                                            rules: {
                                                username: {
                                                    required: true,
                                                },
                                                password: {
                                                    required: true,
                                                },
                                                fullname: {
                                                    required: true,
                                                }
                                            },
                                            messages: {
                                                username: {
                                                    required: 'Vui lòng nhập username',
                                                },
                                                password: {
                                                    required: 'Vui lòng nhập password',
                                                },
                                                fullname: {
                                                    required: 'Vui lòng nhập fullname',
                                                }
                                            }
                                        });
                                    });
                                </script>
                                <?php
                                $username = $password = $fullname = "";
                                $usernameErr = $passwordErr = $fullnameErr = "";
                                if (isset($_POST['submit'])) {
                                    $username = trim($_POST['username']);
                                    $password = trim($_POST['password']);
                                    $fullname = trim($_POST['fullname']);
                                    // kiểm tra
                                    // Username
                                    if ($username == "") {
                                        $usernameErr = "Vui lòng nhập username";
                                    } else {
                                        if (!checkUsername($username)) {
                                            $usernameErr = "Username không hợp lệ";
                                        } else {
                                            $qrCheckUsername = "SELECT * FROM users WHERE username = '$username'";
                                            $resultCheck = $conn->query($qrCheckUsername);
                                            if ($resultCheck->num_rows != 0) {
                                                $usernameErr = "username đã tồn tại";
                                            }
                                        }
                                    }
                                    // password
                                    if ($password == "") {
                                        $passwordErr = "Vui lòng nhập password";
                                    } else {
                                        if (!checkPassword($password)) {
                                            $passwordErr = "Password không hợp lệ (password có độ dài 6-32 ký tự,bao gồm số và chữ cái)";
                                        }
                                    }
                                    // fullname
                                    if ($fullname == "") {
                                        $fullnameErr = "Vui lòng nhập fullname";
                                    } else {
                                        if (!checkName($fullname)) {
                                            $fullnameErr = "fullname không hợp lệ";
                                        }
                                    }
                                    // add user
                                    if ($usernameErr == "" && $passwordErr == "" && $fullnameErr == "") {
                                        $password =md5($password);
                                        $qr = "INSERT INTO users(username,password,fullname,role) VALUES ('$username','$password','$fullname',1)";
                                        $result = $conn->query($qr);
                                        if ($result) {
                                            header('location:index.php?msg=Thêm thành công');
                                            die();
                                        } else {
                                            header('location:index.php?msg=Thêm thất bại');
                                            die();
                                        }
                                    }
                                }
                                ?>
                                <form role="form" method="post" action="" class="formAddUser">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" />
                                        <span class="error"><?php echo $usernameErr; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input_pass">
                                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" />
                                            <ion-icon class="icon" name="eye-outline"></ion-icon>
                                        </div>
                                        <span class="error"><?php echo $passwordErr; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>" />
                                        <span class="error"><?php echo $fullnameErr; ?></span>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>

                                </form>
                                <script type="text/javascript">
                                    var inp_pass = document.querySelector('input[name="password"]');
                                    var icon = document.querySelector('.icon');

                                    icon.onclick = function() {
                                        if (inp_pass.type === 'password') {
                                            inp_pass.type = 'text';
                                            icon.name = 'eye-off-outline';
                                        } else {
                                            inp_pass.type = 'password';
                                            icon.name = 'eye-outline';
                                        }
                                    }
                                </script>
                                <style>
                                    .error {
                                        color: red;
                                        font-style: italic;
                                        margin-left: 4px;
                                        margin-top: 4px;
                                        display: block;
                                        font-weight: normal !important;
                                    }

                                    .input_pass {
                                        position: relative;
                                    }

                                    .icon {
                                        position: absolute;
                                        right: 0;
                                        top: 7px;
                                        
                                        margin-right: 16px;
                                        cursor: pointer;
                                        font-weight: bold;
                                        font-size: 18px;
                                        color: rgb(138, 138, 138);
                                        transition: color 0.1s linear;
                                    }

                                    .icon:hover {
                                        color: #000;
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