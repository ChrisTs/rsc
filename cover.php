<?php
include "config.php";
$auth = authsecure();
$user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);

//if ($bad_user = secure($_COOKIE["pcp"],0,$_POST["nick"],$_POST["pass"])){
    if (isset($_GET["start"])&&isset($_GET["day"])){
        
        $code = "<form style=\"background-color : yellow;\" action = \"cover.php\" method = \"post\">8es na anaplirwseis me thn ekpomph: <select name = \"id\">";
        $con = myconnect();
        $result = mysqli_query($con,"SELECT ekpompes.ID, ekpompes.Title FROM ekpompes, ekpomph_atoma WHERE ekpomph_atoma.hID = ".$user_id." AND ekpomph_atoma.ID = ekpompes.ID ;");
        while ($row = mysqli_fetch_array($result)){
            $code.= "<option value = ".$row["ID"].">".$row["Title"]."</option>\n";
        }
        $code.= "</select>\n<input type = \"hidden\" name = \"start\" value = \"".$_GET["start"]."\">\n<input type = \"hidden\" name = \"day\" value = \"".$_GET["day"]."\">\n<input type = \"submit\" value = \"ENHMEROSE\">\n</form>";
    }
    elseif (isset($_POST["start"])&&isset($_POST["day"])){
        if (cover_add($_POST["id"], $_POST["start"], $_POST["day"])){ $code= "<p style=\"background-color : yellow;\">epityxhs enhmerwsh</p>";}
        else {$code.= "<p style=\"background-color : red;\">MH KANEIS MALAKIES ZWO !!</p>";}
        
    }
    else {$code.= "<p style=\"background-color : red;\">EISAI KAI POLY MALAKAS E? TI DOULEIA EXEIS NA PEIRAZEIS TIS DIEYTHYNSEIS E?? !!</p>";}
    

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
    <br>
    LISTA ANAPLIRWTWN:
    <?= display_covers($_REQUEST["start"],$_REQUEST["day"],0)?>
    <br><?= $code?>
<?php
/*}
      else{
      ?>
      <!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
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

    
    */ ?>

