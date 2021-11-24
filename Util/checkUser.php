<?php
  if(!isset($_SESSION['UserAdmin'])){
      header('location:../auth/login.php');
  }
?>