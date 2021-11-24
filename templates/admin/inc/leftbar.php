<?php
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $ar = explode('/', $scriptName);
    $page = $ar[2];
    $activeCat=$activeStory=$activeUser=$activeContact=$activeHome="";
    switch ($page) {
        case 'cat' :
            $activeCat = 'active-menu';
            break;
        case 'story' :
            $activeStory = 'active-menu';
            break;
        case 'user' :
            $activeUser = 'active-menu';
            break;
        case 'contact' :
            $activeContact = 'active-menu';
            break;
        default:
            $activeHome = 'active-menu';
    }   
?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="/templates/admin/assets/img/find_user.png" class="user-image img-responsive" />
            </li>

            <li>
                <a  class="nav_item <?php echo $activeHome; ?>" href="/admin"><i class="fa fa-home fa-2x"></i> Trang chủ</a>
            </li>
            <li>
                <a  class="nav_item <?php echo $activeCat; ?>" href="/admin/cat"><i class="fa fa-th-list fa-2x"></i> Quản lý danh mục</a>
            </li>
            <li>
                <a  class="nav_item <?php echo $activeStory; ?>" href="/admin/story"><i class="fa fa-book fa-2x"></i> Quản lý truyện</a>
            </li>
            <li>
                <a  class="nav_item <?php echo $activeUser; ?>" href="/admin/user"><i class="fa fa-users fa-2x"></i> Quản lý người dùng</a>
            </li>
            <li>
                <a  class="nav_item <?php echo $activeContact; ?>" href="/admin/contact"><i class="fa fa-envelope fa-2x"></i> Quản lý liên hệ</a>
            </li>

        </ul>

    </div>

</nav>
<!-- /. NAV SIDE  -->
<style>
    .nav li a{
        display: flex;
        align-items: center;
        gap:8px;
    }
   
</style>

