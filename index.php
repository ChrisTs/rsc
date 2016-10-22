<?php


    include "config.php";



$auth = authsecure();
$user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
$username = $auth->getNick($user_id);

	

    //header('HTTP/1.0 403 Forbidden');
    //echo "Forbidden";

    //exit();
/*   $adm = false;
    if(isset ($_COOKIE["pca"])){ $pca1 = $_COOKIE["pca"];}
        if ($admi = secure($pca1,1,$_POST["nick"],$_POST["pass"])){
            
            $adm = true;
        }
    
    $user_id;
	$pcp1="";
	if (isset($_COOKIE["pcp"])) $pcp1 = $_COOKIE["pcp"];
        
    if (($user_id = secure($pcp1,0,$_POST["nick"],$_POST["pass"]))||$adm){//echo $user_id;
        
        //if (isset($_GET["kicksource"]) && has_show_now($user_id,$adm)) kick_source();
*/
 //   $adm = true;//bypass--------------------------------------------------------------
    
    
    
?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>RSC</TITLE>
<script type="text/javascript">
    var GB_ROOT_DIR = "../greybox/";
</script>
<script type="text/javascript" src="../greybox/AJS.js"></script>
<script type="text/javascript" src="../greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../greybox/gb_scripts.js"></script>
<link href="../greybox/gb_styles.css" rel="stylesheet" type="text/css" />
<link REL="STYLESHEET" TYPE="text/css" HREF="RSC.css" Title="TOCStyle">

</head>


<BODY>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_PI/sdk.js#xfbml=1&version=v2.5&appId=994608307243867";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="body">
<div class="header">
<H1>rAT sTATION cENTER (RSC)</H1>
</div>
<div class="left">
    <?= menu($adm)?>
</div>


<div class="lefttop" style="overflow: auto;"><B class="B">ΣΗΜΕΡΑ</B>

   <?php if(isset($_GET["fbpage"])){
       ?>
    <div class="fb-page" data-href="<?=$_GET["fbpage"]?>" data-tabs="timeline" data-width="475" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"></div>
   <?php 
	}
	else echo program_day(day(0),$adm,1); 
	?>

<A class="perissotera" href="programma.php" target="_parent">ΠΡΟΓΡΑΜΜΑ</A>
</div>
<!--
<div class="leftbottom"><b class="B">Top</b><i>needs work</i><br>
<?= "empty"//display_themata(0) ?>
</div>-->
<div class="centertop" style="overflow: auto;">
<table>
<tr align="justify">
<td>
<!--Πληροφορίες σύνδεσης Icecast:<br>-->
<?= connInfo(0,"","","","") ?>
</td>
<td align="right">
<!--<script src="http://www.clocklink.com/embed.js"></script><script type="text/javascript" language="JavaScript">obj=new Object;obj.clockfile="5005-red.swf";obj.TimeZone="EET";obj.width=120;obj.height=40;obj.wmode="transparent";showClock(obj);</script>-->
</td>
<td>
<?php  //kicker($user_id,$adm); ?>    
</td>
</tr>
</table>
<?php //disp_Stats("min",$adm); ?>
</div>
<div class="centerbottom"><B class="B">Ανακοινώσεις</B><br>
<?php// usercp($user_id); ?>
    <?php echo display_themata(); ?>
</div>
<div class="chatbox">
    <?php 
    $pathToShoutBox = "shoutbox";
     include("$pathToShoutBox/shoutbox.inc.php");
     ?>
</div>




</div>

</BODY>
</html>

