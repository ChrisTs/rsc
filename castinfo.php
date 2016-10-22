<?php
include "config.php";
$auth = authsecure();
$user = $auth->getSessionUID($auth->getSessionHash());
//$user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);

//if ($user = secure($_COOKIE["pcp"],0,$_POST["nick"],$_POST["pass"])){
if (isset($_POST["reason"])) {
    akyrosi($_GET["id"],$user,$_POST["day"],$_POST["start"],$_POST["reason"]);
    $auth->mailToUsers("RSC - Ακύρωση εκπομπής","O χρήστης <b>".$auth->getNick($user)."</b> ακύρωσε την εκπομπή του. Επισκέψου το  <a href=\"https://rsc.badrat.gr\">RSC</a> για να κάνεις τη δική σου εκπομπή στην ώρα του. ",0); 
}
?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>BCastInfo</TITLE>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value===null||value==="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_required(reason,"Παρακαλούμε μια σύντομη ενημερωση για την ακύρωση")===false)
  {reason.focus();return false;}
  }
}
</script>
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
Πληροφορίες<br>
<?php
if(isset($_GET["id"])) $id=$_GET["id"];

$con = myconnect();
$result = mysqli_query($con,"SELECT ekpompes.Title, ekpompes.desc, ekpompes.fbpage,  ekpompes.bitrate, ekpompes.akyrwseis, eidos.cat FROM ekpompes, ekpomph_atoma, eidos  WHERE ekpompes.ID=".$id." AND ekpomph_atoma.ID = ekpompes.ID AND ekpomph_atoma.hID = ".$user." AND eidos.cID = ekpompes.cID ;");
$row1 = mysqli_fetch_array($result);
$result = mysqli_query($con,"SELECT nick, Name, LastName FROM paragwgoi, ekpomph_atoma WHERE paragwgoi.hID = ekpomph_atoma.hID AND ekpomph_atoma.ID=".$id.";");

?>
Τίτλος : <?=$row1["Title"] ?><br>
Παραγωγοί : <br>
<?php 
    while($row2 = mysqli_fetch_array($result)){
        echo("&nbsp&nbsp&nbsp&nbsp&nbsp ".$row2["nick"].", ".$row2["Name"].", ".$row2["LastName"]."<br>");
    }
    $result = mysqli_query($con,"SELECT day, start, end, keno, tempID FROM programma, ekpompes, ekpomph_atoma WHERE (programma.ID = ekpompes.ID OR programma.tempID = ekpompes.ID) AND ekpompes.ID =".$id." AND ekpomph_atoma.hID = ".$user." AND ekpomph_atoma.ID = ".$id." ;");
?>
Ώρες : <br>
<?php
    while($row2 = mysqli_fetch_array($result)){
        ?>
        <form action="castinfo.php?id=<?=$id?>" method="post" onsubmit="return validate_form(this)">
            &nbsp&nbsp&nbsp&nbsp&nbsp <?=day($row2["day"])." ".$row2["start"]." ".$row2["end"]?><?php if ($row2["keno"]||(!$row2["keno"]&&($row2["tempID"]!=""&&$row2["tempID"]!=$id))){?> ΑΚΥΡΩΘΗΚΕ <br><?php }else{ ?>
        
            <input type ="hidden" name="day" value="<?=$row2["day"]?>"/>
            <input type="hidden" name="start" value="<?=$row2["start"]?>"/>
            <input type="text" name="reason" placeholder="Λόγος ακύρωσης"/>
            <input type="submit" value="ΑΚΥΡΩΣΗ"/>
        
        <?php }
        echo "</form>";
    }//while loop
?>
Είδος : <?=$row1["cat"] ?><br>
Περιγραφή: <?=$row1["desc"] ?> <br>
FBPage : <?=$row1["fbpage"] ?> <a href="index.php?fbpage=<?=$row1["fbpage"] ?>">view here</a><br>
<a href="edit_desc.php?id=<?=$id?>" title="allagi perigrafis" rel="gb_page[500, 480]">Αλλαγή στοιχείων</a><br>
 <!--<?=$row1["akyrwseis"]?>-->
<br><br>
<table align="left" border="1" >
<?php 
    $result = mysqli_query($con,"SELECT spot FROM spots WHERE ID = ".$id." || ID = 0 ;");
    while ($row = mysqli_fetch_array($result)){
        echo "<tr><td>".$row["spot"]."</td></tr>";
    }
    ?>
</table>


<br>
<br>
<a href="index.php">Πίσω</a>
</div>
</div>
</body>
</html>
<?php
/*}
else{ ?>
<html>
    
    <head>
    <title>Please login</title>
    <meta http-equiv="Refresh" content="1; url=login.html"> 
    </head>
    <body>
    <br>
    <center>
    <br><br><a href="login.html">LOGIN SUCKER</a>    

</body>
</html>
<?php
}*/ ?>
