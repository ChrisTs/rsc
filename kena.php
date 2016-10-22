<?php
    include "config.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>kena</TITLE>



</head>


<body>
<?php 
    $day = day(0);
    
    echo program_day($day++,0,0);
    echo program_day($day,0,1);
    ?>
</body>