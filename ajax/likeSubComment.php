<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/timeAgo.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkLiked.php';
?>
<?php
$sub_comment_id = $_POST['sub_comment_id'];
$user_id = $_POST['user_id'];
// -- truy vấn--

$qrSubComment = "SELECT * FROM sub_comment WHERE sub_comment_id = '$sub_comment_id'";
$result = $conn->query($qrSubComment);
$arItemSubComment = $result->fetch_assoc();
$sample = $arItemSubComment['user_liked'];

if (checkLiked($user_id, $sample)) {
    $arSample = explode(",", $sample);
    foreach ($arSample as $key => $item) {
        if ($item == $user_id) {
            $index = $key;
        }
    };
    unset($arSample[$index]);
    $user_liked = implode(",", $arSample);
    $qrUpdateUserLiked = "UPDATE sub_comment SET user_liked = '$user_liked', counter_like = counter_like - 1 WHERE sub_comment_id = '$sub_comment_id'";
    $resultUpdateUserLiked = $conn->query($qrUpdateUserLiked);
} else {
    $arSample = explode(",", $sample);
    $arSample[] = $user_id;
    $user_liked = implode(",", $arSample);
    $qrUpdateUserLiked = "UPDATE sub_comment SET user_liked = '$user_liked', counter_like = counter_like + 1 WHERE sub_comment_id = '$sub_comment_id'";
    $resultUpdateUserLiked = $conn->query($qrUpdateUserLiked);
}

?>
<!-- ------ -->
<?php
$qrSubComment = "SELECT * FROM sub_comment WHERE sub_comment_id = '$sub_comment_id'";
$result = $conn->query($qrSubComment);
$arItemSubComment = $result->fetch_assoc();
$comment_id = $arItemSubComment['comment_id'];

?>
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