<?php
    include "config.php";
    $auth = authsecure();
    $user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
        $bad_user;
    if ($adm){//echo $bad_user;
    if (isset($_POST["call"])) {
	echo $_POST["title"].$_POST["bbcode"];
	new_thema($_POST["title"],$_POST["bbcode"],$_POST["htmc"],$user_id);
	$auth->mailToUsers("RSC - Νέα ανακοίνωση - ".filter_input(INPUT_POST, "title").".","Ο χρήστης <b>".$auth->getNick($user_id)."</b> δημοσίευσε μια νέα ανακοίνωση.",0); 
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
<?php 
/*if (isset($_POST['cvrt-text'])) { $text = ($_POST['cvrt-text']); } else { $text = ''; }
if (get_magic_quotes_gpc()) { $text = stripslashes($text); }

//	you posted some text..
if (isset($_POST['preview'])) {

	//	this is the main line. 
	//	this line is all you need for basic convertion jobs.
	$converted = bb2html($text);
	echo $converted;
	//	we can do some error checking, too..
	if ($converted == '') $converted = "tags don't balance!\n\nin other words, you have opened a tag, but not closed it, or something..\ngo back and try again!";

} else { $converted = 'write here'; }
do_bb_form($text,'', '', false, '', false, 'catgr', $catgr, 'cvrt', true, false, false);*/
?>
<form action="thema.php" method="post">
    <input type="hidden" name="call" value="new">
    <b>&#932;&#921;&#932;&#923;&#927;&#931;&#58;</b><br><textarea cols="60" rows="1" name="title"></textarea>
    <br>
    <b>&#922;&#917;&#921;&#924;&#917;&#925;&#927;&#58;</b><br><textarea cols="60" rows="10" name="bbcode"></textarea>
    <br>
    <!--<b>background (url ,please)</b><br><textarea cols="60" rows="1" name="background"></textarea>-->
    plain html code: (NOT recomended)<input type="checkbox" name="htmc" value="true" />
    <input type="hidden" name="adm" value="<?= $adm ?>">
    <input type="submit" value="&#913;&#928;&#927;&#920;&#919;&#922;&#917;&#933;&#931;&#919;">
    </form>
    
    Δείγμα bbcode<br>
 ------------<br>
 [img]http://badrat.gr/images/rat.gif[/img]<br>
[url="http://badrat.gr"]BAD RAT RADIO[/url]<br>
[mail="ctsitsibis@badrat.gr"]Bad Motherfucker[/mail]<br>
[size="25"]HUGE[/size]<br>
[color="red"]RED[/color]<br>
[b]bold[/b]<br>
[i]italic[/i]<br>
[u]underline[/u]<br>
[list][*]item[*]item[*]item[/list]<br>
[code]value="123";[/code]<br>
[quote]this is a quote[/quote]<br>


</div>

</body>
</html>
<?php } else echo "eisai malakas"; ?> 