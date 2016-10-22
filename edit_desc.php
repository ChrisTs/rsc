<?php
    include "config.php";
    $auth = authsecure();
    $user = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user);
  //  $bad_user = filter_input(INPUT_GET, "hid")
$id = filter_has_var(INPUT_GET, "id") ? filter_input(INPUT_GET, "id") : "";
if (filter_has_var(INPUT_POST, "changeinfo")){
    //echo "sucess!";
    
     $message="O χρήστης <b>".$auth->getNick($user)."</b> θελει να ενημερωθει η εκπομπή του με τα παρακάτω στοιχεία:<br>";
    
    $message.= "Τιτλος:". filter_input(INPUT_POST, "title") . "<br> Περιγραφή:". filter_input(INPUT_POST, "desc")."<br> Είδος:".  filter_input(INPUT_POST, "genre")."<br> fbpage:".  filter_input(INPUT_POST, "page");
    $message.="<br> Παρακαλώ για τις ενέργειές σας (lol)!";
    
    $auth->mailToUsers("RSC - Αίτημα αλλαγής στοιχειων εκπομπής", $message, 1);
    
}


$con = myconnect();
$result = mysqli_query($con,"SELECT ekpompes.Title, ekpompes.desc, ekpompes.fbpage, eidos.cat FROM ekpompes, eidos  WHERE ekpompes.ID=".$id."  AND eidos.cID = ekpompes.cID ;");
$row1 = mysqli_fetch_array($result);

?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>BCastInfo</TITLE>
</head>

<body bgcolor="aaaaaa">

<br>

    
<form action="edit_desc.php" method="post">
        
        <font color="FF0000">
        <input type="hidden" name="changeinfo" value="lala">
        Τιτλος: <input type="text" name="title" value="<?=$row1["Title"]?>"><br>
        Περιγραφή: <input type="text" name="desc" value="<?=$row1["desc"]?>"><br>
        Είδος: <input type="text" name="genre" value="<?=$row1["cat"]?>"><br>
	FBpage:<input type="text" name="page" value="<?=$row1["fbpage"]?>"><br>
        </font>
	Τα στοιχεία θα αλλάξουν εντός το πολύ 24 ωρών απο τη στιγμή που θα σταλούν!<br>
	
        <input type="submit" value="change">
    </form>
    <br><br>


</body>
</html>