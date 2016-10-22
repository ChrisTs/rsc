<html>
    <head>
<link REL="STYLESHEET" TYPE="text/css" HREF="prog.css">


<?php

echo " <meta charset=\"UTF-8\"> ";//xreiazetai an emfanizei akatalavistika


include "config.php";//einai sto rsc.badrat.gr/config.php

/*
 * to program_day($day,$admin,$poster)
 * to kaloume me day (int) thn hmera pou 8eloume: 1-7 dld deytera mexri kyriakh h vazoume day(0) gia shmera
 * to $admin (boolean) vazoume 0
 * sto $poster (boolean) vazoume 1 gia poster, 0 gia kanonikh emfanish
 */
if (isset ($_GET["nowonly"])) { echo "<style> .progcast {display: none; } img{width:300px; height:150px;} body{padding:0;} .progcast_now{border:0px;}</style> " ;}
//else {echo "<style> .progcast_now {border:3px solid #34A853; }</style>";}
//aplh emfanish shmerinou prog
//echo program_day(day(0));
//echo "<hr>";

?>
	
    </head>
    <body  style="margin:0; padding:0;" >
<?php
//emfanizei poster shmerinou prog
echo program_day(day(0), 0, 1,0,1);



?>
    </body>
</html>