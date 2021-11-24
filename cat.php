<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/header.php'; ?>

<div class="content_resize">
  <div class="mainbar">
    <?php
    $cat_id = $_GET['id'];
    $qr1 = "SELECT * FROM cat WHERE cat_id = '$cat_id' ORDER BY cat_id DESC";
    $result1 = $conn->query($qr1);
    $arItem1 = $result1->fetch_assoc();

    //Phân trang
    //Tổng số dòng
    $qrStory = "SELECT * FROM story WHERE cat_id = '$cat_id'";
    $resultStory = $conn->query($qrStory);
    $Tsd = $resultStory->num_rows;
    //Số truyện trên 1 trang
    $row_count = ROW_COUNT;
    //Tổng số trang
    $Tst = ceil($Tsd / $row_count);
    //Trang hiện tại
    $current_page = 1;
    if (isset($_GET['page'])) {
      $current_page = $_GET['page'];
    }
    //offset
    $offset = ($current_page - 1) * $row_count;


    $qr2 = "SELECT * FROM story WHERE cat_id = '$cat_id' ORDER BY story_id DESC LIMIT {$offset},{$row_count}";
    $result2 = $conn->query($qr2);
    $countItem = $result2->num_rows;
    ?>
    <!-- Title -->
    <script type="text/javascript">
      document.title = "<?php echo $arItem1['name']; ?>";
    </script>
    <div class="article">
      <h1><?php echo $arItem1['name']; ?></h1>
      <?php
      if ($countItem > 0) {
        while ($arItem2 = $result2->fetch_assoc()) {
          $nameReplaceStory = convertUtf8ToLatin($arItem2['name']);
          $url = '/' . $nameReplaceStory . '-' . $arItem2['story_id'] . '.html';

      ?>
          <h2><a href="<?php echo $url; ?>" style="color:#4B4B4B;text-decoration:none"><?php echo $arItem2['name']; ?></a></h2>
          <p class="infopost">Ngày đăng: <?php echo $arItem2['created_at']; ?>. Lượt đọc: <?php echo $arItem2['counter']; ?></p>
          <div class="clr"></div>
          <?php
          if ($arItem2['picture']) {
          ?>
            <div class="img"><img src="/files/<?php echo $arItem2['picture']; ?>" style="object-fit:cover" width="161" height="192" alt="" class="fl" /></div>
          <?php
          }
          ?>

          <div class="post_content">
            <p><?php echo $arItem2['preview_text']; ?></p>
            <p class="spec"><a href="<?php echo $url; ?>" class="rm">Chi tiết</a></p>
          </div>
          <div class="clr"></div>
        <?php
        }
      } else {
        ?>
        <p style="font-size:15px">Không có truyện...</p>
      <?php
      }
      ?>

    </div>
    <?php
    if ($Tst >= 2) {
    ?>
      <p class="pages">
        <?php
        $nameReplace = convertUtf8ToLatin($arItem1['name']);
        if ($current_page > 2) {
          $first_page = 1;
          $url = '/' . $nameReplace . '-' . $cat_id . '-page-' . $first_page;
        ?>
          <a href="<?php echo $url; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
        <?php
        }
        ?>
        <?php
        if ($current_page > 1) {
          $pre_page = $current_page - 1;
          $url = '/' . $nameReplace . '-' . $cat_id . '-page-' . $pre_page;
        ?>
          <a href="<?php echo $url; ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a>

        <?php
        }
        ?>

        <?php
        for ($i = 1; $i <= $Tst; $i++) {
          $url = '/' . $nameReplace . '-' . $cat_id . '-page-' . $i;
          if ($i != $current_page) {
            if ($i > $current_page - 2 && $i < $current_page + 2) {
        ?>
              <a href="<?php echo $url; ?>"><?php echo $i; ?></a>
            <?php
            }
          } else {
            ?>
            <span><?php echo $i; ?></span>
        <?php
          }
        }
        ?>
        <?php
        if ($current_page < $Tst) {
          $next_page = $current_page + 1;
          $url = '/' . $nameReplace . '-' . $cat_id . '-page-' . $next_page;
        ?>
          <a href="<?php echo $url; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <?php
        }
        ?>
        <?php
        if ($current_page < $Tst - 1) {
          $end_page = $Tst;
          $url = '/' . $nameReplace . '-' . $cat_id . '-page-' . $end_page;          
        ?>
          <a href="<?php echo $url; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        <?php
        }
        ?>
        <small>Trang <?php echo $current_page; ?> / <?php echo $Tst; ?></small>
      </p>
    <?php
    }
    ?>
    <style>
      .pages {
        display: flex;
        align-items: center;
      }

      .pages small {
        flex: 1;
        text-align: right;
      }
    </style>
  </div>
  <div class="sidebar">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/footer.php'; ?>