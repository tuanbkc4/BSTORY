<?php
session_start();
ob_start();
$_SESSION['url']= $_SERVER['REQUEST_URI'];
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/constant.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkInput.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/Utf8ToLatinUtil.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/timeAgo.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkLiked.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>BStory | VinaEnter Edu</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="/templates/bstory/css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="/templates/bstory/css/coin-slider.css" />
  <script type="text/javascript" src="/templates/bstory/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="/templates/bstory/js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="/templates/bstory/js/script.js"></script>
  <script type="text/javascript" src="/templates/bstory/js/coin-slider.min.js"></script>
  <!-- icon -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link href="/templates/admin/assets/css/font-awesome.css" rel="stylesheet" />
  <style>
    .form_search {
      position: relative;
      /* margin-top: 12px; */
    }

    .search {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      font-weight: normal;
      cursor: pointer;
    }

    .header_story {
      /* margin-top: 12px; */
      display: flex;
      align-items: center;

    }

    .input_search {
      padding: 8px 12px 8px 48px;
      margin-right: 12px;
      width: 350px;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
      font-size: 16px;

    }

    .acount {
      position: relative;
      display: flex;
      justify-content: start;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      
    }

    .acount img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .acount b {
      font-size: 14px;
      flex: 1;
    }
    .acount .logout{
      position: absolute;
      width: 67px;
      top: 32px;
      left: 50px;
      padding: 6px 6px;
      background-color: #fff;
      display: flex;
      align-items: center;
      gap: 6px;
      box-shadow: 1px 1px 5px #878787;
      opacity: 0;
      visibility: hidden;
      transition: all 0.25s ease-in-out
    }
    .acount .logout::after{
      position: absolute;
      top: -5px;
      content: "";
      width: 10px;
      height: 10px;
      display:block;
      background-color: #fff;
      transform:rotate(45deg);
      z-index: 1;
      
    }
    .acount .logout a{
      font-size: 14px;
      color: #000;
      text-decoration:none;
    }
    .acount .logout a:hover{
      text-decoration:underline;
    }
    .acount:hover .logout{
      opacity: 1;
      visibility: visible;
    }
    .acount .icon_logout {
      color: #000;
      font-size: 18px;
    }
  </style>
</head>

<body>
  <div class="main">
    <div class="header">
      <div class="header_resize">
        <div class="menu_nav">
          <ul class="header_story">
            <?php
            $scriptName = $_SERVER['SCRIPT_NAME'];
            $ar = explode('/', $scriptName);
            $page = $ar[1];
            $activeIndex = $activeContact = "";
            switch ($page) {
              case 'index.php':
                $activeIndex = 'active';
                break;
              case 'contact.php':
                $activeContact = 'active';
                break;
            }
            ?>
            <li>
              <form method="get" action="tim-kiem" class="form_search">
                <input value="<?php if (isset($_GET['key'])) {
                                echo $_GET['key'];
                              } ?>" type="search" name="key" class="form-control input-sm input_search" placeholder="Tìm truyện..." />
                <label class="fa fa-search search"></label>
              </form>

            </li>
            <li class="<?php echo $activeIndex; ?>"><a href="/"><span>Trang chủ</span></a></li>
            <li class="<?php echo $activeContact; ?>"><a href="/lien-he"><span>Liên hệ</span></a></li>
            <?php
            if (!isset($_SESSION['arUser'])) {
            ?>
              <li><a href="Login"><span>Đăng nhập</span></a></li>
            <?php
            } else {
            ?>
              <div class="acount">
                <?php
                if (!isset($_SESSION['arUser']['avt'])) {
                ?>
                  <img src="/files/avt/default.jpg" alt="">
                <?php
                } else {
                ?>
                  <img src="/files/avt/<?php echo $_SESSION['arUser']['avt']; ?>" alt="">
                <?php
                }
                ?>
                <?php
                  $fullname = $_SESSION['arUser']['fullname'];
                  if(strlen($fullname)>16){
                    $fullname = substr($fullname,0,13);
                    $fullname = $fullname."...";
                  }                  
                ?>
                <b><?php echo $fullname; ?></b>
                <div class="logout">
                  <ion-icon name="log-out-outline" class="icon_logout"></ion-icon>
                  <a href="Logout">log out</a>
                </div>
              </div>
            <?php
            }
            ?>

          </ul>
        </div>

        <div class="logo">
          <h1><a href="/">BStory <small>Dự án khóa PHP tại VinaEnter Edu</small></a></h1>
        </div>
        <div class="clr"></div>

        <div class="slider">
          <div id="coin-slider">
            <a href="#"><img src="/templates/bstory/images/slide1.jpg" width="940" height="310" alt="" /></a>
            <a href="#"><img src="/templates/bstory/images/slide2.jpg" width="940" height="310" alt="" /></a>
            <a href="#"><img src="/templates/bstory/images/slide3.jpg" width="940" height="310" alt="" /></a>
          </div>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">