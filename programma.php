<?php
    include "config.php";
  $auth = authsecure();
    
  $user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
           

	if (isset($_POST["start"])){ 
                if (isset($_POST["end"])){ add_2_prog($_POST["id"], $_POST["start"], $_POST["end"], $_POST["day"]);}
                else del_from_prog($_POST["start"], $_POST["day"]);
            }
            if (isset($_GET["resetcovers"])){
                reset_covers($_GET["resetcovers"]);
            }
            
            /*

        }
    }
    $bad_user;
	$pcp1="";
	if (isset($_COOKIE["pcp"])) $pcp1 = $_COOKIE["pcp"];
	$nick1 = "";
	$pass1 = "";
	if (isset($_POST["nick"]) && isset($_POST["pass"])) {
		$nick1 = $_POST["nick"];
		$pass1 = $_POST["pass"];
	}
		
    if ($bad_user = secure($pcp1,0,$nick1,$pass)||$adm){
		*/
    //$adm = true;//bypass------------------------------------------------------------------   
    $day = day(0);
    ?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Programma</TITLE>
<script type="text/javascript">
    var GB_ROOT_DIR = "../greybox/";
</script>
<script type="text/javascript" src="../greybox/AJS.js"></script>
<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<link REL="STYLESHEET" TYPE="text/css" HREF="RSC.css" Title="TOCStyle">

</head>

<body>
<div class="body">
<div class="header">
<H1>rAT sTATION cENTER (RSC)</H1>
</div>
<div class="left">
<?= menu($adm)?>
</div>
<div class="programma">
    <table border="1" style="width:100%">
    <tbody>
    <tr>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    <td valign="top" style="width:14%"><?= program_day($day++,$adm,0)?>
    </td>
    </tr>
    </tbody>
    </table>
    

</div>



    
    
</div>
</body>
</html>
<?php

/*
    }else{
        ?>
        <!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
    
    <head>
    <title>Please login</title>
    <meta http-equiv="Refresh" content="20; url=login.html"> 
    </head>
    <body>
    <br>
    <center>
    <br><br><a href="login.html">LOGIN SUCKER</a>    

</body>
</html>
<?php

} 
*/
?>
