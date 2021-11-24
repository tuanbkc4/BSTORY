<?php
  function checkLiked($user_id,$sample){
    $arr = explode(",",$sample);
    foreach($arr as $item){
        if($user_id == $item){
            return true;
        }
    }
    return false;
    }
    // $a = 1;
    // $ar = ",1";
    
    // if(checkLiked($a,$ar)){
    //     echo "có";
    // }else{
    //     echo "không có";
    // }
