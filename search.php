<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/header.php'; ?>
<!-- Tìm kiếm -->
<?php
if (isset($_GET['key'])) {
    $find = trim($_GET['key']);
}
?>

<?php
//Tìm tổng số dòng
$qrTsd = "SELECT * FROM story WHERE name LIKE '%$find%' ";
$resultTsd = $conn->query($qrTsd);
$arItem1 = $resultTsd->fetch_assoc();
$Tsd = $resultTsd->num_rows;
// Số truyện trong 1 trang
$row_count = ROW_COUNT;
// Tổng số trang
$Tst = ceil($Tsd / $row_count);
// Trang hiện tại
$current_page = 1;
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
}
//offset
$offset = ($current_page - 1) * $row_count;
?>

<div class="content_resize">
    <?php
    if ($Tsd == 0) {
        echo "<p style='margin-left:24px;margin-top:32px;font-size:17px;display:inline-block;font-style:italic;'>Không tìm thấy kết quả nào phù hợp với từ khoá:  <strong>$find</strong> </p>";
    } else {
    ?>
        <div class="mainbar">
            <?php
            $qr = "SELECT * FROM story WHERE name LIKE '%$find%' ORDER BY story_id DESC LIMIT {$offset} , {$row_count}";
            $result = $conn->query($qr);
            while ($arItem = $result->fetch_assoc()) {
                $nameReplaceStory = convertUtf8ToLatin($arItem['name']);
                $url = '/' . $nameReplaceStory . '-' . $arItem['story_id'] . '.html';
            ?>
                <div class="article">
                    <h2><a href="<?php echo $url; ?>"><?php echo $arItem['name']; ?></a></h2>
                    <p class="infopost">Ngày đăng: <?php echo $arItem['created_at']; ?>. Lượt đọc: <?php echo $arItem['counter']; ?></p>
                    <div class="clr"></div>
                    <?php
                    if ($arItem['picture']) {
                    ?>
                        <div class="img">
                            <img src="/files/<?php echo $arItem['picture']; ?>" width="161" height="192" alt="" class="fl" />
                        </div>
                    <?php
                    }
                    ?>
                    <div class="post_content">
                        <p><?php echo $arItem['preview_text']; ?></p>
                        <p class="spec"><a href="<?php echo $url; ?>" class="rm">Chi tiết</a></p>
                    </div>
                    <div class="clr"></div>
                </div>

            <?php
            }
            ?>


            <?php
            if ($Tst >= 2) {
            ?>
                <p class="pages">
                    <?php
                    $nameReplace = convertUtf8ToLatin($arItem1['name']);
                    if ($current_page > 2) {
                        $first_page = 1;
                        $url = '/' . 'tim-kiem?key=' . $find . '&page=' . $first_page;

                    ?>
                        <a href="<?php echo $url; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page > 1) {
                        $pre_page = $current_page - 1;
                        $url = '/' . 'tim-kiem?key=' . $find . '&page=' . $pre_page;
                    ?>
                        <a href="<?php echo $url; ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a>

                    <?php
                    }
                    ?>

                    <?php
                    for ($i = 1; $i <= $Tst; $i++) {
                        $url = '/' . 'tim-kiem?key=' . $find . '&page=' . $i;
                        if ($i != $current_page) {
                            if ($i > $current_page - 2 && $i < $current_page + 2) {
                    ?>
                                <a href="<?php echo $url; ?>"><?php echo $i; ?></a>
                            <?php
                            }
                        } else {
                            ?>
                            <span href="<?php echo $url; ?>"><?php echo $i; ?></span>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if ($current_page < $Tst) {
                        $next_page = $current_page + 1;
                        $url = '/' . 'tim-kiem?key=' . $find . '&page=' . $next_page;
                    ?>
                        <a href="<?php echo $url; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page < $Tst - 1) {
                        $end_page = $Tst;
                        $url = '/' . 'tim-kiem?key=' . $find . '&page=' . $end_page;
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
    <?php
    }
    ?>
    <div class="sidebar">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/leftbar.php'; ?>

    </div>
    <div class="clr"></div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/footer.php'; ?>