<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/Util/checkUser.php'; ?>
<?php
  $id=$_GET['id'];
  $qr="DELETE FROM cat WHERE cat_id = $id ";
  $result = $conn->query($qr);
  if($result){
    header("location:index.php?msg=Xoá thành công");
    die();
  }else{
    header("location:index.php?msg=Xoá thất bại");
    die();
}

?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>