<?php
include "config.php";

    
    phpinfo();
    $time_now = strtotime(date("G:i:s"));
    if ($time_now < strtotime("0:20:00")){
    
    $day= day(0);
    $day --;
    if ($day < 1) $day += 7;
    reset_covers($day);
    }
?>
