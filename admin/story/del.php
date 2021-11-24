<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Util/checkUser.php'; ?>
<?php
    $story_id = $_GET['story_id'];
    $qr1="SELECT picture FROM story WHERE story_id= $story_id";
    $result1 = $conn->query($qr1);
    $row = $result1->fetch_assoc();
    if($row['picture']){
        unlink($_SERVER['DOCUMENT_ROOT'] . '/files/'.$row['picture']);
    }
    $qr2 = "DELETE FROM story WHERE story_id= $story_id";
    $result2 = $conn->query($qr2);
    if($result2){
        header('location:index.php?msg=Xoá truyện thành công');
    }else {
        header('location:index.php?msgErr=Có lỗi khi xoá truyện');
    }
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>