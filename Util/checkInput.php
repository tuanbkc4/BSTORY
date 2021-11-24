<?php
function checkEmail($value){
    $pattern = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';
    $flag = preg_match($pattern,$value);    
    return $flag;
}
function checkUsername($value){
    $pattern = '#^[A-Za-z][A-Za-z0-9_\.]{0,31}$#';//
    $flag = preg_match($pattern,$value);    
    return $flag;
}
function checkName($value){
    $pattern = '#^[aAàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬbBcCdDđĐeEèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆ
    fFgGhHiIìÌỉỈĩĨíÍịỊjJkKlLmMnNoOòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢpPqQrRsStTu
    UùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰvVwWxXyYỳỲỷỶỹỸýÝỵỴzZ\s]{1,31}$#';//
    $flag = preg_match($pattern,$value);    
    return $flag;
}
function checkPassword($value){
    //$pattern = '#^(?=.*\d)(?=.*\W).{6,32}$#'; Password phải bao gồm số,chữ,các ký tự đặc biệt,có độ dài 6-32 ký tự
    $pattern = '#^(?=.*\d)(?=.*[a-z]).{6,32}$#';// Password phải bao gồm số,chữ,có độ dài 6-32 ký tự
    // $pattern = '#^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{6,32}$#';Password bao gồm số,chữ cái viết hoa, thường và các ký tự đặc biệt
        // $pattern = '#^(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{6,32}$#';
    $flag = preg_match($pattern,$value);    
    return $flag;
}
function checkWebsite($value){
    $pattern = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';
    $flag = preg_match($pattern,$value);    
    return $flag;
}
?>