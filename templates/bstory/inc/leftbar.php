<style>
  .sb_menu li .active {
    color: #0B9100;
    font-weight: bold;
  }
</style>
<div class="gadget">
  <h2 class="star">Danh mục truyện</h2>
  <div class="clr"></div>
  <ul class="sb_menu">
    <?php
    $qr = "SELECT * FROM cat";
    $result = $conn->query($qr);

    // $ = $_SERVER['SCRIPT_NAME']."?id={$arItem['cat_id']}";
    if (isset($_GET['id'])) {
    }
    while ($arItem = $result->fetch_assoc()) {
      $cat_id = $arItem['cat_id'];
      $name = $arItem['name'];
      $nameReplace = convertUtf8ToLatin($name);
      $url = '/' . $nameReplace . '-' . $cat_id;
      if ($_SERVER['SCRIPT_NAME'] == '/cat.php') {
        if ($_GET['id'] == $arItem['cat_id']) {
    ?>
          <li><a class="active" href="<?php echo $url; ?>"><?php echo $arItem['name']; ?></a></li>
        <?php
        } else {
        ?>
          <li><a href="<?php echo $url; ?>"><?php echo $arItem['name']; ?></a></li>
        <?php
        }
      } else {
        ?>
        <li><a href="<?php echo $url; ?>"><?php echo $arItem['name']; ?></a></li>
    <?php
      }
    }
    ?>
  </ul>
</div>

<div class="gadget">
  <h2 class="star"><span>Truyện mới</span></h2>
  <div class="clr"></div>
  <ul class="ex_menu">
    <?php
    $qr2 = "SELECT * FROM story ORDER BY story_id DESC LIMIT 3";
    $result2 = $conn->query($qr2);
    while ($arItem = $result2->fetch_assoc()) {
      $nameReplaceStory = convertUtf8ToLatin($arItem['name']);
      $url = '/' . $nameReplaceStory . '-' . $arItem['story_id'] . '.html';

    ?>
      <li>
        <a href="<?php echo $url; ?>"><?php echo $arItem['name']; ?></a>
        <br />
        <?php echo $arItem['preview_text']; ?>
      </li>
    <?php
    }
    ?>

  </ul>
</div>