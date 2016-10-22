<?php
    include "config.php";
	
$auth = authsecure();
$user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
          

    //$bad_user;
    if ($adm){//echo $bad_user;
    if (isset($_POST["call"])) {
        if ($_POST["call"] == "new") {new_ekpomph($_POST["Title"],$_POST["cat"],$_POST["bitrate"],$_POST["desc"],$_POST["fbpage"],$_POST["poster"],$_POST["newcat"]);}
        if ($_POST["call"] == "edit") {update_ekpomph($_GET["id"],$_POST["Title"],$_POST["cat"],$_POST["bitrate"],$_POST["desc"],$_POST["fbpage"],$_POST["poster"],$_POST["newcat"]);}
    }
    if (isset ($_POST["hid"])){
        if ($_POST["hid"] == 0) {connect_producer($_POST["id"],$_POST["add"]);}
        elseif ($_POST["hid"] > 0) {disconnect_producer($_POST["id"],$_POST["hid"]);}
        elseif ($_POST["hid"] < 0) {del_ekpomph($_POST["id"]);}
    }
	
?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>neo thema</TITLE>

<link rel="StyleSheet" type="text/css" href="RSC.css"/>

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
<?php
    if (isset($_GET["editinfo"])) {echo ekpomph_form($_GET["id"]);}
    else {echo disp_ekpompes(filter_input( INPUT_GET,"id"));
    echo ekpomph_form(0);}
?>


</div>
</div>
</body>
</html>
<?php } else echo "eisai malakas";
 ?> 