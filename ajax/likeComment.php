<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/dbconnect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/timeAgo.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkLiked.php';
?>
<?php
$comment_id = $_POST['comment_id'];
$user_id = $_POST['user_id'];
// -- truy vấn--

$qrComment = "SELECT * FROM comment WHERE comment_id = '$comment_id'";
$result = $conn->query($qrComment);
$arItemComment = $result->fetch_assoc();
$sample = $arItemComment['user_liked'];
// echo $sample."a";
// echo $user_id."b";
// echo $comment_id;

if (checkLiked($user_id, $sample)) {
    $arSample = explode(",", $sample);
    foreach ($arSample as $key => $item) {
        if ($item == $user_id) {
            $index = $key;
        }
    };
    unset($arSample[$index]);
    $user_liked = implode(",", $arSample);
    $qrUpdateUserLiked = "UPDATE comment SET user_liked = '$user_liked', counter_like = counter_like - 1 WHERE comment_id = '$comment_id'";
    $resultUpdateUserLiked = $conn->query($qrUpdateUserLiked);
} else {
    $arSample = explode(",", $sample);
    $arSample[] = $user_id;
    $user_liked = implode(",", $arSample);
    $qrUpdateUserLiked = "UPDATE comment SET user_liked = '$user_liked', counter_like = counter_like + 1 WHERE comment_id = '$comment_id'";
    $resultUpdateUserLiked = $conn->query($qrUpdateUserLiked);
}

?>
<!-- ------ -->
<?php
  $qrComment = "SELECT * FROM comment WHERE comment_id = '$comment_id'";
  $result = $conn->query($qrComment);
  $arItemComment = $result->fetch_assoc();
?>
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