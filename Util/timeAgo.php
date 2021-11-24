<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
function time_ago($timestamp)
{
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes      = round($seconds / 60);           // value 60 is seconds  
    $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
    $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
    $weeks          = round($seconds / 604800);          // 7*24*60*60;  
    $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
    $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
    if ($seconds <= 60) {
        return "Vừa xong";
    } else if ($minutes <= 60) {
        return "$minutes phút";
    } else if ($hours <= 24) {
        return "$hours giờ";
    } else if ($days <= 7) {
        return "$days ngày";
    } else if ($weeks <= 4.3) {
        //4.3 == 52/12
        return "$weeks tuần";
    } else if ($months <= 12) {
        return "$months tháng";
    } else {
        return "$years năm";
    }
}
