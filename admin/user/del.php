<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkLiked.php'; ?>
 
<?php

$user_id = $_GET['id'];

$qr1 = "SELECT * FROM users WHERE user_id = $user_id";
$result1 = $conn->query($qr1);
$row1 = $result1->fetch_assoc();
if ($row1['username'] == 'admin' && $_SESSION['UserAdmin']['username'] != 'admin') {
  header('Location:index.php?msg=Bạn không có quyền xoá admin');
  die();
}
// del comment
$qrDelComment = "DELETE FROM comment WHERE user_id = $user_id ";
$resultDelComment = $conn->query($qrDelComment);
// del subcomment
$qrDelComment = "DELETE FROM sub_comment WHERE user_id = $user_id ";
$resultDelComment = $conn->query($qrDelComment);
// del lượt like comment
$qr1 = "SELECT * FROM comment";
$result = $conn->query($qr1);
while ($row = $result->fetch_assoc()) {
  if (checkLiked($user_id, $row['user_liked'])) {
    $arComment_id[] = $row['comment_id'];
  }
}
if (isset($arComment_id)) {
  foreach ($arComment_id as $comment_id) {
    $qrComment = "SELECT * FROM comment WHERE comment_id = '$comment_id'";
    $result = $conn->query($qrComment);
    $arItemComment = $result->fetch_assoc();
    $sample = $arItemComment['user_liked'];

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
  }
}
// del lượt like Subcomment
$qr2 = "SELECT * FROM sub_comment";
$result = $conn->query($qr2);
while ($row = $result->fetch_assoc()) {
  if (checkLiked($user_id, $row['user_liked'])) {
    $arSubComment_id[] = $row['sub_comment_id'];
  }
}
if (isset($arSubComment_id)) {
  foreach ($arSubComment_id as $sub_comment_id) {
    $qrSubComment = "SELECT * FROM sub_comment WHERE sub_comment_id = '$sub_comment_id'";
    $result = $conn->query($qrSubComment);
    $arItemSubComment = $result->fetch_assoc();
    $sample = $arItemSubComment['user_liked'];

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
  }
}
// del user and avt
$qrGetUser = "SELECT * FROM users WHERE user_id = $user_id";
$result1 = $conn->query($qrGetUser);
$row = $result1->fetch_assoc();
if ($row['avt']) {
  unlink($_SERVER['DOCUMENT_ROOT'] . '/files/avt/' . $row['avt']);
}
$qr = "DELETE FROM users WHERE user_id = $user_id ";
$result = $conn->query($qr);
if($_SESSION['arUser']['user_id']==$user_id){
  unset($_SESSION['arUser']);
}
if ($result) {
  header("location:index.php?msg=Xoá thành công");
  die();
} else {
  header("location:index.php?msg=Xoá thất bại");
  die();
}

?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>