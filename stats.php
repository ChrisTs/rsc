<?php
    include "config.php";
 $auth = authsecure();
 $user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
            
          //  $adm = true;

    $bad_user;
   // if ($bad_user = secure($_COOKIE["pcp"],0,$_POST["nick"],$_POST["pass"])||$adm){
?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Shoutcast Stats</TITLE>
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
    <?php disp_Stats("full",$adm); ?>
</div>



    
    
</div>
</body>
</html>
<?php
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
} ?>