<?php
session_start();
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkInput.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in | VinaEnter Edu</title>
    <!-- JQUERY SCRIPTS -->
    <script src="../templates/bstory/js/jquery-3.6.0.min.js"></script>
    <script src="../templates/bstory/js/jquery.validate.min.js"></script>
    <!-- BOOTSTRAP STYLES-->
    <link href="/templates/admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/templates/admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="/templates/admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .wrapper {
            height: 100vh;
            background-image: linear-gradient(45deg, #46008B, #00D4FF);
            /* width:100vh; */
        }

        .text-center {
            margin-top: 0;
        }

        .form_login {
            width: 350px;
            background-color: #fff;
            padding: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            border: 1px solid #ccc;
            box-shadow: -2px 2px 20px #333;
        }

        .btn {
            display: block;
            margin: 15px auto 0;
            padding: 4px 24px;
            font-size: 16px;
        }

        form p {
            font-size: 14px;
            text-align: center;
            padding-top: 10px;
        }

        .btn-label {
            margin-left: 8px;
            outline: none;
            font-weight: 500;
            padding: 0px 4px;
            border: .5px solid #ccc;
            border-radius: 5px;
            background-color: #eee;
            color: #000;
            cursor: pointer;
        }

        #preview-div {
            position: relative;
            margin-top: 6px;
            width: 50px;
            height: 50px;
            display: none;
            border-radius: 50%;
        }

        #preview-div #preview-img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 50px;
            height: 50px;
            object-fit: cover;
            display: block;
            border-radius: 50%;
        }

        #preview-div .icon_close_img {
            position: absolute;
            top: -5px;
            right: -5px;
            color: red;
            font-weight: 200;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        #preview-div .icon_close_img:hover {
            transform: rotate(180deg);
        }



        .active-preview {
            display: block !important;
        }

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
            top: 8px;
            margin-right: 16px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            color: rgb(138, 138, 138);
            transition: color 0.1s linear;
        }

        .icon:hover {
            color: #000;
        }
    </style>
</head>

<div class="wrapper">
    <div class="container ">
        <div class="row form_login ">
            <div class="col-md-12">
                <div class="row ">
                    <div class="col-md-12">
                        <h2 class="text-center">Create Account</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('.formSignup').validate({
                                    rules: {
                                        fullname: {
                                            required: true,
                                        },
                                        username: {
                                            required: true,
                                        },
                                        password: {
                                            required: true,
                                            minlength: 6,
                                            maxlength: 32,
                                        }
                                    },
                                    messages: {
                                        fullname: {
                                            required: "Vui lòng nhập fullname",
                                        },
                                        username: {
                                            required: "Vui lòng nhập username",
                                        },
                                        password: {
                                            required: "Vui lòng nhập mật khẩu",
                                            minlength: "Mật khẩu yếu!!!",
                                            maxlength: "VUi lòng nhập không quá 32 ký tự",

                                        }
                                    }
                                });
                            });
                        </script>
                        <?php
                        $username = $password = $fullname = "";
                        $usernameErr = $passwordErr = $fullnameErr = "";
                        if (isset($_POST['submit'])) {
                            $fullname = trim($_POST['fullname']);
                            $username = trim($_POST['username']);
                            $password = trim($_POST['password']);
                            $picture = $_FILES['avatar']['name'];
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
                                $password=md5($password);
                                if ($picture) {
                                    // Đăng ký user có avt
                                    // upload ảnh
                                    $tmp_name = $_FILES['avatar']['tmp_name'];
                                    $tmp = explode(".", $picture);
                                    $file_extension = end($tmp);
                                    $newName = "AVT - " . time() . '.' . $file_extension;
                                    $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/files/avt/' . $newName;
                                    move_uploaded_file($tmp_name, $path_upload);
                                    // thực hiên câu truy vấn
                                    $qrAddUser = "INSERT INTO users(username,password,fullname,avt,role) VALUES ('$username','$password','$fullname','$newName',0)";
                                    $resultAddUser = $conn->query($qrAddUser);
                                    if ($resultAddUser) {
                                        $_SESSION['username'] = $username;
                                        header('location:Login?msg=Đăng ký thành công');
                                        die();
                                    } else {
                                        echo '<span style="color:red;font-style:italic;">Có lỗi khi đăng ký</span>';
                                        unlink($path_upload);
                                    }
                                } else {
                                    // Đăng ký user không có avt
                                    // thực hiên câu truy vấn 
                                    $qrAddUser = "INSERT INTO users(username,password,fullname,role) VALUES ('$username','$password','$fullname',0)";
                                    $resultAddUser = $conn->query($qrAddUser);
                                    if ($resultAddUser) {
                                        $_SESSION['username'] = $username;
                                        header('location:Login?msg=Đăng ký thành công');
                                        die();
                                    } else {
                                        echo '<span style="color:red;font-style:italic;">Có lỗi khi đăng ký</span>';
                                        unlink($path_upload);
                                    }
                                }
                            }
                        }
                        ?>
                        <form role="form" method="post" action="" enctype="multipart/form-data" class="formSignup">
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" name="fullname" class="form-control" value="<?php if (isset($fullname)) {
                                                                                                    echo $fullname;
                                                                                                } ?>" />
                                <span class="error"><?php echo $fullnameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php if (isset($username)) {
                                                                                                    echo $username;
                                                                                                } ?>" />
                                <span class="error"><?php echo $usernameErr; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <label for="picture" class="btn-label">Tải ảnh lên</label>
                                <input type="file" name="avatar" id="picture" style="display:none" onchange="previewImage()" />
                                <div id="preview-div">
                                    <img src="" alt="" id="preview-img">
                                    <i class="fa fa-times icon_close_img" aria-hidden="true" onclick=removeImage()></i>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input_pass">
                                    <input type="password" name="password" class="form-control" value="<?php if (isset($password)) {
                                                                                                            echo $password;
                                                                                                        } ?>" />
                                    <ion-icon class="icon" name="eye-outline"></ion-icon>
                                    <span class="error"><?php echo $passwordErr; ?></span>
                                </div>

                            </div>

                            <button type="submit" name="submit" class="btn btn-success btn-md submit">Sign up</button>
                            <span class="error"> <?php if (isset($err)) {
                                                        echo $err;
                                                    } ?></span>
                            <p>Already have an account? <a href="Login">Login</a> </p>
                        </form>
                        <script type="text/javascript">
                            function previewImage() {
                                var file = document.getElementById("picture").files;
                                if (file.length > 0) {
                                    var fileReader = new FileReader();

                                    fileReader.onload = function(event) {
                                        document.getElementById("preview-img").setAttribute("src", event.target.result);
                                        document.getElementById("preview-div").classList.add("active-preview");
                                        document.querySelector("label[for='picture']").innerHTML = 'Thay đổi';
                                    };

                                    fileReader.readAsDataURL(file[0]);
                                }
                            }
                            // -------------------
                            function removeImage() {
                                document.getElementById("picture").value = "";
                                document.getElementById("preview-div").classList.remove("active-preview");
                                document.querySelector("label[for='picture']").innerHTML = 'Tải ảnh lên';

                            }

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


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<!-- icon -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>