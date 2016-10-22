<?php
    include "config.php";
    
    $auth = authsecure();
    $user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);

    
    
    $bad_user;
    if ($adm){//echo $bad_user;
    if (isset($_POST["call"])){
        if ($_POST["call"] == "new"){ 
	$result =  $auth->register($_POST["e-mail"],$_POST["password"],$_POST["password"]);
            if(!$result["error"]){
                
                new_paragwgos($auth->getUID($_POST["e-mail"]),$_POST["nick"],$_POST["Name"],$_POST["LastName"],$_POST["e-mail"],$_POST["msn"],$_POST["mobile"],$_POST["password"]);
            
            }
	    echo $result["message"];
            
        }
        if ($_POST["call"] == "edit") {
	    /*
	    $newm  = $auth->getUser($user_id)["email"];
	    if($_POST["e-mail"] != $newm ){
		if(!$auth->isEmailTaken($_POST["e-mail"])){
		    $auth->changeEmail($uid, $email, $password)
		}
	    }
	     * 
	     */
	    
	    update_paragwgos($_GET["hid"],$_POST["nick"],$_POST["Name"],$_POST["LastName"],$_POST["msn"],$_POST["mobile"]);}
    }
    if (isset($_POST["act"])){
        if ($_POST["act"]) {/*del_producer($_GET["hid"]);*/
	   echo $auth->hardDeleteUser($_POST["hid"])["message"];
	   // echo "hello";
	    
	}
        else {
	    //upd_passwd($_GET["hid"],$_POST["pass"]);
	    echo $auth->requestReset($_POST["adress"])["message"];
	   // echo "hello2";
	    
	}
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
    if (isset($_GET["editinfo"])) echo prod_form($_GET["hid"]);
    else {
        if (isset ($_GET["hid"])){echo disp_producers($_GET["hid"]);}else {echo disp_producers(0);}
    echo prod_form(0);
    }
?>

</div>
</div>
</body>
</html>
<?php } else echo "eisai malakas"; ?> 