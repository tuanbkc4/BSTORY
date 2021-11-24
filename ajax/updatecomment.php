<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/timeAgo.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkLiked.php';

?>
<?php
$comment_id = $_POST['comment_id'];
$content = $_POST['content'];
$story_id = $_POST['story_id'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$datetime = date('Y:m:d H:i:s');
// truy vấn
if ($content != "") {
    $qrUpdateComment = "UPDATE comment SET content = '$content', create_at = '$datetime' WHERE comment_id = '$comment_id'";
    $result = $conn->query($qrUpdateComment);
}
?>
<!-- --------- -->
<hr />
<h2>Bình luận truyện</h2>
<ul class="main_comment">
    <?php
    $qrComment = "SELECT comment.*,users.fullname,users.avt FROM comment INNER JOIN users ON comment.user_id = users.user_id WHERE comment.story_id = '$story_id'";
    $resultComment = $conn->query($qrComment);
    if ($resultComment->num_rows > 0) {
        while ($arItemComment = $resultComment->fetch_assoc()) {
            $comment_id = $arItemComment['comment_id'];
    ?>
            <li>
                <?php
                if (isset($arItemComment['avt'])) {
                ?>
                    <img src="/files/avt/<?php echo $arItemComment['avt']; ?>" class="avt"></img>
                <?php
                } else {
                ?>
                    <img src="/files/avt/default.jpg ?>" class="avt"></img>
                <?php
                }
                ?>

                <div class="desc">
                    <div class="descComment">
                        <div class="contentMainComment">
                            <a href="#" class="nameUser"><?php echo $arItemComment['fullname']; ?></a>
                            <p class="content"><?php echo $arItemComment['content']; ?></p>
                            <?php
                            if (isset($_SESSION['arUser'])) {
                                if ($_SESSION['arUser']['user_id'] == $arItemComment['user_id']) {
                            ?>
                                    <div class="editcontentComment edit_comment">
                                        <div><i class="fa fa-ellipsis-v " aria-hidden="true"></i></div>
                                        <div class="menuEdit">
                                            <p class="del_Comment <?php echo $comment_id; ?>">Xoá</p>
                                            <p class="rewrite_Comment <?php echo $comment_id; ?>">Chỉnh sửa</p>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="interact interactComment-<?php echo $comment_id; ?>">
                            <?php
                            if (isset($_SESSION['arUser'])) {
                                if (checkLiked($_SESSION['arUser']['user_id'], $arItemComment['user_liked'])) {
                            ?>
                                    <button value="<?php echo $comment_id; ?>" class="like liked likeComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemComment['counter_like']; ?></i></button>
                                <?php
                                } else {
                                ?>
                                    <button value="<?php echo $comment_id; ?>" class="like likeComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemComment['counter_like']; ?></i></button>
                                <?php
                                }
                            } else {
                                ?>
                                <button value="<?php echo $comment_id; ?>" class="like likeComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemComment['counter_like']; ?></i></button>
                            <?php
                            }
                            ?>
                            <button value="<?php echo $comment_id; ?>" class="reply replyComment">Phản hồi</button>
                            <b class="time"><?php echo time_ago($arItemComment['create_at']); ?></b>
                        </div>
                    </div>
                    <div class="descSubComment">
                        <ul class="sub_comment sub_comment-<?php echo $arItemComment['comment_id']; ?>">
                            <?php
                            $qrSubComment = "SELECT sub_comment.*,users.fullname,users.avt FROM sub_comment INNER JOIN users ON sub_comment.user_id = users.user_id WHERE sub_comment.comment_id = '$comment_id'";
                            $resultSubComment = $conn->query($qrSubComment);
                            if ($resultSubComment->num_rows > 0) {
                                while ($arItemSubComment = $resultSubComment->fetch_assoc()) {
                                    $sub_comment_id = $arItemSubComment['sub_comment_id'];
                            ?>
                                    <li>
                                        <?php
                                        if (isset($arItemSubComment['avt'])) {
                                        ?>
                                            <img src="/files/avt/<?php echo $arItemSubComment['avt']; ?>" class="avt"></img>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="/files/avt/default.jpg ?>" class="avt"></img>
                                        <?php
                                        }
                                        ?>
                                        <div>
                                            <div class="contentSubComment">
                                                <a href="#" class="nameUser"><?php echo $arItemSubComment['fullname']; ?></a>
                                                <p class="content"><?php echo $arItemSubComment['content']; ?></p>
                                            </div>
                                            <div class="interact interactSubComment-<?php echo $sub_comment_id; ?>">
                                                <?php
                                                if (isset($_SESSION['arUser'])) {
                                                    if (checkLiked($_SESSION['arUser']['user_id'], $arItemSubComment['user_liked'])) {
                                                ?>
                                                        <button value="<?php echo $sub_comment_id; ?>" class="like liked likeSubComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemSubComment['counter_like']; ?></i></button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button value="<?php echo $sub_comment_id; ?>" class="like likeSubComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemSubComment['counter_like']; ?></i></button>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <button value="<?php echo $sub_comment_id; ?>" class="like likeSubComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemSubComment['counter_like']; ?></i></button>
                                                <?php
                                                }
                                                ?>
                                                <button value="<?php echo $comment_id; ?>" class="reply replyComment">Phản hồi</button>
                                                <b class="time"><?php echo time_ago($arItemSubComment['create_at']); ?></b>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['arUser'])) {
                                            if ($_SESSION['arUser']['user_id'] == $arItemSubComment['user_id']) {
                                        ?>
                                                <div class="editcontentComment edit_Subcomment">
                                                    <div><i class="fa fa-ellipsis-v  " aria-hidden="true"></i></div>
                                                    <div class="menuEdit ">
                                                        <p class="del_SubComment <?php echo $comment_id . '-' . $sub_comment_id; ?>">Xoá</p>
                                                        <p class="rewrite_SubComment <?php echo $comment_id . '-' . $sub_comment_id; ?>">Chỉnh sửa</p>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                            <li>
                                <form action="javascript:void(0)" class="form_comment sub formComment-<?php echo $comment_id; ?>" method="post">
                                    <?php
                                    if (isset($_SESSION['arUser']['avt'])) {
                                    ?>
                                        <img src="/files/avt/<?php echo $_SESSION['arUser']['avt']; ?>" class="avt"></img>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="/files/avt/default.jpg" class="avt"></img>
                                    <?php
                                    }
                                    ?>
                                    <input type="text" name="contentSub" id="" class="contentSubComment-<?php echo $comment_id; ?>" placeholder="Viết bình luận...">
                                    <input class="updateComment" type="submit" name="submit" value="<?php echo $comment_id; ?>">
                                </form>
                            </li>
                        </ul>

                    </div>

                </div>
            </li>
        <?php
        }
        ?>
    <?php
    }
    ?>

</ul>
<form action="javascript:void(0)" class="form_comment" method="post">
    <?php
    if (isset($_SESSION['arUser']['avt'])) {
    ?>
        <img src="/files/avt/<?php echo $_SESSION['arUser']['avt']; ?>" class="avt"></img>
    <?php
    } else {
    ?>
        <img src="/files/avt/default.jpg" class="avt"></img>
    <?php
    }
    ?>
    <input type="text" name="content" id="" class="contentComment mainComment" placeholder="Viết bình luận...">
    <input type="submit" name="submit" value="submit" onclick="getComment()">
</form>