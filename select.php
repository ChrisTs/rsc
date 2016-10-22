<?php
include "config.php";

$auth = authsecure();
$user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
    //$adm = true;
  
if ($adm){
    
    if (isset($_POST["day"])){
        if ( update_program_cover($_POST["id"],$_POST["start"],$_POST["day"],$_POST["id2"])) $code = "success!!!";
        else $code = "paparia";
    }

?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>select</TITLE>
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
    <br>
    LISTA ANAPLIRWTWN:
    <?= display_covers($_REQUEST["start"],$_REQUEST["day"],$adm)?>
    <br><?= $code?>
<?php }
      else{
      ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>prepei na kaneis login</TITLE>
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
    kane login leme
<?php }?>
</body>
</html>
