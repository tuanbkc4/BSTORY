<?php
session_start();
ob_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | VinaEnter Edu</title>
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
            height:100vh;
            background-image: linear-gradient(45deg, #46008B, #00D4FF);
            /* width:100vh; */
        }
        .form_login{
            width:350px;
            background-color: #fff;
            padding:  20px ;
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            border-radius:10px;
            border:1px solid #ccc;
            box-shadow: -2px 2px 20px #333;
        }
        .btn{
            display: block;
            margin: 30px auto 0;
            padding: 4px 24px;
            font-size: 16px;
        }
        .input_pass{
            position: relative;
        }
        .icon{
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            margin-right: 16px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            color: rgb(138, 138, 138);
            transition: color 0.1s linear;
        }
        .icon:hover{
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
                        <h2 class="text-center">LOGIN</h2>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (isset($_POST['submit'])) {
                            $username = trim($_POST['username']);
                            $password = md5(trim($_POST['password']));                            
                            $qr= "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = 1";
                            $result = $conn->query($qr);
                            $arUser = $result->fetch_assoc();

                           
                            if($result -> num_rows > 0) {
                                $_SESSION['UserAdmin'] = $arUser;
                                header("Location:../index.php");
                            }else{
                                $err =  "Sai username hoặc password";
                            }
                        }
                        ?>
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php if (isset($username)) {echo $username;} ?>" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input_pass">
                                    <input type="password" name="password" class="form-control" />
                                    <ion-icon class="icon" name="eye-outline"></ion-icon>
                                </div>
                                
                            </div>
                            <button type="submit" name="submit" class="btn btn-success btn-md submit">Login</button>
                            <span style="color:red;font-style:italic;display:block;text-align:center;margin-top:4px">
                                <?php if (isset($err)) {echo $err;} ?></span>
                        </form>
                        
                        <script type="text/javascript">
                            var inp_pass= document.querySelector('input[name="password"]');
                            var icon= document.querySelector('.icon');

                            icon.onclick=function(){
                                if(inp_pass.type==='password'){
                                    inp_pass.type='text';
                                    icon.name='eye-off-outline';
                                }else{
                                    inp_pass.type='password';
                                    icon.name='eye-outline';
                                }
                            }                           

                        </script>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>