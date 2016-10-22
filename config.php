<?php

//echo "test test";
/****************************************************************
 *  CODE BY CHRISTOFYLIS TSITSIMPIS (except shoutcast stats)
 ***************************************************************/

/*
   if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
 * 
 */
 
 

include 'auth/Config.php';
include 'auth/Authext.php';

//include("shoutcast.class.php");
//include ($_SERVER['DOCUMENT_ROOT'].'/cbparser/cbparser.php');

$host="db11.papaki.gr:3306";// mysql host
$user = "rscdbuser";   // mysql user
$pass = "Fvj12o6~";   // mysql pass          
$db = "rscdb";// mysql db name
//date_default_timezone_set ( "Etc/GMT+4" );

function httpssecure(){
         if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
}

function newauth(){
 httpssecure();
    
    $dbh = new PDO("mysql:host=db11.papaki.gr:3306;dbname=rscdb", "rscdbuser", "Fvj12o6~");

    $config = new PHPAuth\Config($dbh);
    return new PHPAuth\Authext($dbh, $config);
}

function authsecure(){
    
    $auth = newauth();
    
    

    
    if (!$auth->isLogged()) {
	
	echo "Forbidden.";
	header('Location: https://rsc.badrat.gr/login.php');
	exit();
    }
    return $auth;
    
}



function myconnect(){
 $host="db11.papaki.gr:3306";// mysql host
$user = "rscdbuser";   // mysql user
$pass = "Fvj12o6~";   // mysql pass          
$db = "rscdb";// mysql db name   


    $con = mysqli_connect($host,$user,$pass);
    if (!$con)
    {
        die ("error". mysqli_error());
    }
    mysqli_select_db($con,$db);
    return $con;
}
function day($d){
date_default_timezone_set ( "Europe/Athens" );//exei diplh leitourgia
    switch($d){
        
        case 1 : $day="Δευτέρα"; break;
        case 2 : $day="Τρίτη"; break;
        case 3 : $day="Τετάρτη"; break;
        case 4 : $day="Πεμπτη"; break;
        case 5 : $day="Παρασκευή"; break;
        case 6 : $day="Σάββατο"; break;
        case 7 : $day="Κυριακή"; break;
        default: switch(date('l')){
            case "Monday": $day=1;break;
            case "Tuesday": $day=2;break;
            case "Wednesday": $day=3;break;
            case "Thursday": $day=4;break;
            case "Friday": $day=5;break;
            case "Saturday": $day=6;break;
            case "Sunday": $day=7;break;
         }
         break;
    }
    return $day;
}
/*
function secure($cookie,$flag,$nick,$pass){
    echo "||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||";
    $judgement = false;
    $create_cookie = false;
    $con = myconnect();
    $hash = "gamiemai";
	$row["hash"] = 0;
	$hID = -1;
    if (strlen($cookie)>=33){
        echo"--------------------------------------------------------";
        $mixed = $cookie;//prin htan $_COOKIE["pcp"];
        $hID = substr($mixed, 32);
        $hash = substr ($mixed, 0, 32);
        $sql = "SELECT hash FROM paragwgoi WHERE hID = ".$hID." ;";
        if ($flag) $sql = "SELECT hash FROM officers WHERE hID = ".$hID." ;";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
    }
    elseif ($nick!=""){
        echo "******************************************************";
        $create_cookie = true;
        $hash = hash("md5",$pass);
        $sql = "SELECT hash, hID FROM paragwgoi WHERE nick = \"".$nick."\" ;";
        if ($flag) $sql = "SELECT hash, hID FROM officers WHERE nick = \"".$nick."\" ;";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        $hID = $row["hID"];
    }
    echo "hash: ".$hash;
    echo "basehash: ".$row["hash"];
    $judgement = ($hash === $row["hash"]);
    if ($judgement && $create_cookie) {
        if ($flag) setcookie("pca", $hash.$hID, time()+3600); 
        else  setcookie("pcp", $hash.$hID, time()+3600);
    
        
        echo" cookie created, ".$hash.$row["hID"];
    }
    //---------------8elei douleia to logout-------------------------------------------------------
//    if (!$judgement/*||isset($_GET["logout"])||isset($_GET["alogout"])) {
//        if (($flag && !isset( $_GET["logout"])) ||isset($_GET["alogout"])) setcookie ("pca", "", time() - 3600);
//        else setcookie ("pcp", "", time() - 3600);
//        
//    }//----------------------------------------------------------------------------------------
 //   else $judgement = $hID;
    echo $judgement;
    return $judgement;
}
*/

function akyrosi($id ,$hid, $day, $start, $reason){
    $con = myconnect();
    $result = mysqli_query($con,"UPDATE programma SET keno = 1 WHERE day =".$day." AND start = \"".$start."\" ;");
    mysqli_query($con,"UPDATE ekpompes SET akyrwseis = akyrwseis + 1 WHERE ID= ".$id." ;");
    mysqli_query($con,"INSERT INTO akyrwseis (ID ,hID, timestamp ,day, start, logos) VALUES ( ".$id.", ".$hid.", CURRENT_TIMESTAMP , ".$day.", \"".$start."\", \"".$reason."\") ;");
    
    //mailToAdmin($mailbody);
    
    //echo "functionsadfdsfdsaf";
}
function disp_kena(){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT ekpompes.Title, programma.day, programma.start, programma.end FROM ekpompes, programma WHERE programma.keno = 1 AND programma.ID = ekpompes.ID ;");
    $ret= "";
    while ($row = mysqli_fetch_array($result)){
        $ret .= "<li>".day($row["day"])." ".$row["start"]."-".$row["end"].", ".$row["Title"]."</li>";
    }
    return $ret;
}
function disp_allages(){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT * FROM allages ORDER BY allages.tID DESC ;");
    $n=0;
    WHILE (($row=mysqli_fetch_array($result)) && $n<4)
	{
	$allagestxt.= "<p>".$row["title"]."&nbsp;&nbsp;".$row["DATE"]."</p>";
	$n++;
	}
    return $allagestxt;
}
function disp_topthemata(){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT * FROM top_themata ORDER BY top_themata.ID_top DESC ;");
    $n=0;
    WHILE (($row=mysqli_fetch_array($result)) && $n<4)
	{
	$toptxt.= "<p>".$row["title"]."&nbsp;&nbsp;".$row["DATE"]."</p>";
	$n++;
	}
    return $toptxt;
}

/***
 * 1 for monday, 2 for tuesday ... 7 for sunday;
 */
function program_day($day,$adm=0,$poster=0,$plus=0,$noday=0){
    
if ($day > 7) {$day -= 7;}
$lastday = $day - 1;
if ($lastday < 1){$lastday += 7;}
    $dayspan ="";
    if(!$noday) $dayspan= day($day);
    //echo date("G:i:s");
    date_default_timezone_set ( "Europe/Athens" );
    $time_now = strtotime(date("G:i:s"));
   
	$today = false;
    if ($day == day(0)) {$today = true;}
    
    $con = myconnect();
    
    if ($today) {$sql = "SELECT ekpompes.ID, ekpompes.Title, ekpompes.desc, ekpompes.poster, eidos.cat,  TIME_FORMAT(start, '%H:%i') AS start , TIME_FORMAT(end, '%H:%i') AS end, keno, tempID, day FROM programma, ekpompes, eidos WHERE (programma.day = ".$day." AND ekpompes.ID = programma.ID AND ekpompes.cID = eidos.cID) OR (programma.day = ".$lastday." AND ekpompes.ID = programma.ID AND ekpompes.cID = eidos.cID AND (programma.start > programma.end)) ORDER BY day%7 , start ASC ;";}
    else { $sql = "SELECT ekpompes.ID, ekpompes.Title, ekpompes.desc, ekpompes.poster, eidos.cat, TIME_FORMAT(start, '%H:%i') AS start , TIME_FORMAT(end, '%H:%i') AS end, keno, tempID FROM programma, ekpompes, eidos WHERE programma.day = ".$day." AND ekpompes.ID = programma.ID AND ekpompes.cID = eidos.cID ORDER BY start ASC ;";}
    if ($plus){
        $sql = "SELECT ekpompes.ID, ekpompes.Title, ekpompes.desc, ekpompes.poster, eidos.cat,  TIME_FORMAT(start, '%H:%i') AS start , TIME_FORMAT(end, '%H:%i') AS end, keno, tempID FROM programma, ekpompes, eidos WHERE programma.day = ".$day." AND ekpompes.ID = programma.ID AND ekpompes.cID = eidos.cID AND programma.start < \"4:00:00\" ORDER BY start ASC ;";
    
    }
    $result = mysqli_query($con,$sql);
   //$firstloop = true;
    while ($row=mysqli_fetch_array($result)){
	
	
	
	
	
	
	$trans =  strtotime($row["start"]) > strtotime($row["end"]);// anhkei se 2 meres* 2 periptwseis
	$now1 = strtotime($row["end"]) > $time_now;//  eimai meta tis 12 kai mexri telos ekpomphs
	$now2 =  strtotime($row["start"]) < $time_now;// eimai prin tis 12 kai meta thn arxh ths ekpomphs
	$fromyestnow =  $trans && $now1;
	$lasttrans = $trans && $now2;
	
	if($today && $trans && !$now1  && $day != $row["day"]) {
	   // $firstloop = false;
	    continue;
	}
	//$firstloop = false;
	$border = "";
	$bkg = "";
	
    //if ($poster) $bkg = "background-image: url(".$row["poster"]."); "; fortwma tou background, akyro, to theloume san img
    $nowidentify="";
    $nowplaying = $time_now >= strtotime($row["start"]) && $time_now < strtotime($row["end"]);
        if ($today && ($nowplaying || $fromyestnow || $lasttrans) ) {
	    $border= "";//border:3px solid #000000; 
	    $nowidentify="_now";
	}
//edw fortonetai to background	
        $strt = "<div class=\"progcast".$nowidentify."\" style=\"".$border.$bkg."\">";//"<p style=\"".$border."\">";
	
	
        $end = "</div>";
		
	
	
	
	
	
	
	
	
	//load posters
	if($poster){
	    if ($row["tempID"] != ""){
		$result1 = mysqli_query($con,"SELECT ID, Title, ekpompes.poster FROM ekpompes WHERE ekpompes.ID = ".$row["tempID"]." ;");
		$row1 = mysqli_fetch_array($result1);
		$ret= "<div class=\"pposter\"> <img src=\"".$row1["poster"]."\"  style=\"max-width:100%\" ></div>";
		
	    }
	    else{
		$ret=	 "<img src=\"".$row["poster"]."\"  style=\"max-width:100%\" >"
			. "<div class=\"pposter\"> "
			. "<div class=\"ptime\">".$row["start"]." - ".$row["end"]."</div>"
			. "<div class=\"ptitle\">".$row["Title"]."</div>"
			. "</div>";
	    }
	    
	}
	else{
	

	
        if ($adm) $end = "<form style=\"background-color: black; text-align : center;\" action=\"programma.php\" method=\"post\"><input type = \"hidden\" name=\"day\" value=\"".$day."\"/><input type = \"hidden\" name=\"start\" value=\"".$row["start"]."\"/><input type=\"submit\" value=\"ΔΙΑΓΡΑΦΗ\"/></form></div>";
        
        $empty_strt = "<div class=\"progcast_canc\">";
        //$empty_end = "<input type = \"hidden\" name=\"day\" value=\"".$day."\"/><input type = \"hidden\" name=\"start\" value=\"".$row["start"]."\"/><input type=\"submit\" value=\"ANAPLHRWSE\"/></form></p><hr>";
        $empty_end = "";
        if (isset($_COOKIE["rsc"])) $empty_end = "<a href=\"cover.php?start=".$row["start"]."&day=".$day."\" title=\"Αναπλήρωση\" rel=\"gb_page[700, 480]\"><INPUT type=\"button\" value=\"Αναπλήρωσε\" size=\"4\" ></a>";
        $empty_end .= "</div>";
                
        $adm_empty_strt = "<div class=\"progcast_canc\">";
        $adm_empty_end = "<a href=\"select.php?start=".$row["start"]."&day=".$day."\" title=\"Επιλογή αναπλήρωσης\" rel=\"gb_page[700, 480]\"><INPUT type=\"button\" value=\"Επιλογή\" size=\"4\"> </a><form style=\"background-color: black; text-align : center;\" action=\"programma.php\" method=\"post\"><input type = \"hidden\" name=\"day\" value=\"".$day."\"/><input type = \"hidden\" name=\"start\" value=\"".$row["start"]."\"/><input type=\"submit\" value=\"ΔΙΑΓΡΑΦΗ\"/></form></div>";
        $cover_strt = "<div class=\"progcast_cover\">";
        $cover_end = "</div>";
        $ret= "<div class=\"ptime\">".$row["start"]." - ".$row["end"]."</div>";// apo .= to ekana =
        
//	////////////poster!
//	if($poster){
//	    $ret= "<div class=\"pposter\"> <img src=\"".$row["poster"]."\"  width=\"100\"><div>";
//	}
//	  
	 
        
        if ($row["tempID"] != "") {//to alla3a apo if se elseif gia na deixnei k tis akyrwmenes anaplirwseis(akyro)
            $strt = $cover_strt;
            $result1 = mysqli_query($con,"SELECT ID, Title, ekpompes.desc, ekpompes.poster, cat FROM ekpompes, eidos WHERE ekpompes.ID = ".$row["tempID"]." AND ekpompes.cID = eidos.cID ;");
            $row1 = mysqli_fetch_array($result1);
	    
            $ret.= "<div class=\"ptitle\">".$row1["Title"]."</div><div class=\"pcat\">Κατηγορία: ".$row1["cat"]."</div><div class=\"pdesc\">".$row1["desc"]."</div>";    
        }
        else $ret.= "<div class=\"ptitle\">".$row["Title"]."</div><div class=\"pcat\">Κατηγορία: ".$row["cat"]."</div><div class=\"pdesc\">".$row["desc"]."</div>";  
//	}
        if ($row["keno"]) {
            
            if($adm){
                $strt = $adm_empty_strt;
                $end = $adm_empty_end;
            }
            else{
                $strt = $empty_strt;
                $end = $empty_end;
            }
        }
        
        
        //needs check for keni ekpompi
    }
    $dayspan .=$strt.$ret.$end;
    
    }
    if ($adm) $dayspan.= add_prog_form($day)."<a href=\"programma.php?resetcovers=".$day."\">reset αναπληρώσεων</a>";
    return $dayspan;
}
function add_prog_form($day){//1 for monday, 2 for tuesday ... 7 for sunday;
    
    $html_code = "<form style=\"background-color : yellow; vertical-align: bottom;\" action=\"programma.php\" method = \"post\" >\n<b>ΠΡΟΣΘΗΚΗ:</b><br>Εκπομπή: <select name=\"id\">\n";
    
    $con = myconnect();
    $result = mysqli_query($con,"SELECT ID, Title FROM ekpompes ;");
    while ($row = mysqli_fetch_array($result)){
        $html_code .= "<option value=".$row["ID"].">".$row["Title"]."</option>\n";
    }
    $html_code .= "</select>\n<br>ΑΡΧΗ:<input type = \"text\" size = 8 name = \"start\" placeholder=\"ΩΩΛΛΔΔ\">\n<br>ΤΕΛΟΣ:<input type = \"text\" name = \"end\" size = 8 placeholder=\"ΩΩΛΛΔΔ\">\n<br><input type = \"hidden\" name = \"day\" value = \"".$day."\"><input type =\"submit\" value= \"add\">\n</form>";
    return $html_code;
}
function add_2_prog($id, $start, $end, $day){
    $con = myconnect();
    $sql = "INSERT INTO programma (ID, tempID, start, end, day, keno) VALUES (\"".$id."\", NULL, \"".$start."\", \"".$end."\", \"".$day."\", \"0\");";
    $result = mysqli_query($con,$sql);
    return $result;
}
function del_from_prog($start,$day){
    $con = myconnect();
    $result = mysqli_query($con,"DELETE FROM programma WHERE start = \"".$start."\" AND day = ".$day." ;");
    return $result;
}
function cover_add($id, $start, $day){
    $valid = false;
    $con = myconnect();
    $sql = "SELECT programma.keno FROM programma WHERE start = \"".$start."\" AND day = \"".$day."\" ;";
    $result = mysqli_query($con,$sql);
    if ($row = mysqli_fetch_array($result)){
        if ($row["keno"]) $valid= true;
    }
    if ($valid){
        $sql = "INSERT INTO anaplirwtes (ID, start, day, submitted) VALUES (\"".$id."\", \"".$start."\", \"".$day."\", CURRENT_TIMESTAMP);";
        $result = mysqli_query($con,$sql);
    }
    else $result = $valid;
    
    return $result;
}
function display_covers($start, $day, $adm){
    $con = myconnect();
    $sql = "SELECT ekpompes.Title, ekpompes.ID, anaplirwtes.submitted FROM ekpompes, anaplirwtes WHERE ekpompes.ID = anaplirwtes.ID AND anaplirwtes.start = \"".$start."\" AND anaplirwtes.day = \"".$day."\" ;";
    $result = mysqli_query($con,$sql);
    
    
    $ret = "";
    $but = $ton = $end = "";
    
    if ($adm) {
        $strt = "<form action= \"select.php\" method = \"post\">";
        $but = "<input type = \"radio\" name = \"id\" value = \"";
        $ton = "\">";
        $end = "<br><input type = \"hidden\" name=\"day\" value=\"".$day."\"/><input type = \"hidden\" name=\"start\" value=\"".$start."\"/><input type = \"submit\" value = \"EPILOGH EKPOMPHS ANAPLHRWSHS\"></form>";
        $ret.= $strt;
    }
    
    while ($row = mysqli_fetch_array($result)){
        $ret.= "<br>".$row["Title"]." submitted at: ".$row["submitted"].$but.$row["ID"].$ton;
    }
    if ($adm){
        $result2 = mysqli_query($con,"SELECT ID, Title FROM ekpompes ;");
        $ret.= "<br>ALLH (nazistikh methodos): <select name=\"id2\">\n";
        while ($row = mysqli_fetch_array($result2)){
            $ret .= "<option value=".$row["ID"].">".$row["Title"]."</option>\n";
        }
        $ret.=" </select>".$but."-1".$ton;
    }
    $ret.= $end;
    return $ret;
}
function update_program_cover($id, $start, $day, $id2){
    $con = myconnect();
    if ($id == -1) $id = $id2;
    $sql = "UPDATE programma SET tempID = \"".$id."\" ,keno = 0 WHERE start=\"".$start."\" AND day=\"".$day."\" ;";
    $result = mysqli_query($con,$sql);
    return $result;
    
}
function reset_covers($day){
    $con = myconnect();
    $sql = "UPDATE programma SET tempID = NULL ,keno = 0 WHERE day=\"".$day."\" ;";
    $sql2 = "DELETE FROM anaplirwtes WHERE day=\"".$day."\" ;";
    $reset = mysqli_query($con,$sql);
    $delete = mysqli_query($con,$sql2);
    return ($reset&&$delete);
}

function connInfo($edit,$address,$port,$password,$admpassword){
    $con = myconnect();
    if ($address != ""){
        $result = mysqli_query($con,"UPDATE conninfo SET Address = \"".$address."\", Port = \"".$port."\", Password = \"".$password."\", blank2 = \"".$admpassword."\" WHERE blank1 = 1 ;");
        
    }
    $result = mysqli_query($con,"SELECT Address, Port, Password, blank2 FROM conninfo ;");
    $row = mysqli_fetch_array($result);
    if ($edit) $ret =  "<form action = \"conn_info_upd.php\" method = \"post\"><input type=\"text\" name = \"addr\" value = \"".$row["Address"]."\"><br><input type=\"text\" name = \"port\" value = \"".$row["Port"]."\"><br><input type=\"text\" name = \"passwd\" value = \"".$row["Password"]."\"><br><input type=\"text\" name = \"admpasswd\" value = \"".$row["blank2"]."\"><br><input type=\"submit\" value = \"update\"></form>";
    else $ret = "Διέυθυνση Διακομιστή: ".$row["Address"]."<br>Θύρα: ".$row["Port"]."<br> Κωδικός: ".$row["Password"]."<br> Mount point: ".$row["blank2"];
    return $ret;
}

function usercp($bad_user){
if($bad_user){
$con = myconnect();
$result = mysqli_query($con," SELECT * FROM paragwgoi WHERE hID=".$bad_user.";");
$row =mysqli_fetch_array($result);

echo "<div class=\"cp_r\">";
echo "nick: ".$row["nick"]."<br>";
echo "Όνομα: ".$row["Name"]."<br>";
echo "Επώνυμο: ".$row["LastName"]."<br>";
echo "<a href=\"change_password.php\" title=\"change_password\" rel=\"gb_page[500, 480]\">Αλλαγή κωδικού</a><br>";
echo "E-mail: ".$row["e-mail"]."<br>";
echo "Skype: ".$row["msn"]."<br>";
echo "Κινητό: ".$row["mobile"]."<br>";
echo "</div><div class=\"cp_l\">";
//echo "<b>Απουσίες:</b> ".$row["apousies"]."<br>";
//echo "<b>Ακυρώσεις:</b> ".$row["akyrwseis"]."<br>";
echo "<br>";

    $result = mysqli_query($con,"SELECT ekpompes.ID, ekpompes.Title FROM ekpompes, ekpomph_atoma WHERE ekpomph_atoma.hID =".$bad_user." AND ekpomph_atoma.ID = ekpompes.ID ;");
    echo "Εκπομπές: <br>";
    while($row =mysqli_fetch_array($result)){
        echo "<a href=\"castinfo.php?id=".$row["ID"]."\" >".$row["Title"]."</a><br>";
    }

    
echo "</div>";//<br>Telos";
}
else echo "<br><a>no producer account logged in</a>";
}

function new_thema($title,$bbcode,$htmc,$admhID){
    $con = myconnect();
    if ($htmc =="true") $html = $bbcode;
    else { $html= bb2html($bbcode); }
    $result = mysqli_query($con,"INSERT INTO titles (Title, Main, bbcode, tID, hID) VALUES (\"".$title."\", \"".$html."\",\"".$htmc."\", NULL, '".$admhID."');");
}

function bb2html($text)
{
  $bbcode = array("<", ">",
                "[list]", "[*]", "[/list]", 
                "[img]", "[/img]", 
                "[b]", "[/b]", 
                "[u]", "[/u]", 
                "[i]", "[/i]",
                '[color="', "[/color]",
                "[size=\"", "[/size]",
                '[url="', "[/url]",
                "[mail=\"", "[/mail]",
                "[code]", "[/code]",
                "[quote]", "[/quote]",
                '"]');
  $htmlcode = array("&lt;", "&gt;",
                "<ul>", "<li>", "</ul>", 
                "<img src=\"", "\">", 
                "<b>", "</b>", 
                "<u>", "</u>", 
                "<i>", "</i>",
                "<span style=\"color:", "</span>",
                "<span style=\"font-size:", "</span>",
                '<a href="', "</a>",
                "<a href=\"mailto:", "</a>",
                "<code>", "</code>",
                "<table width=100% bgcolor=lightgray><tr><td bgcolor=white>", "</td></tr></table>",
                '">');
  $newtext = str_replace($bbcode, $htmlcode, $text);
  $newtext = nl2br($newtext);//second pass
  
  return $newtext;
}

function display_themata(){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT Title, Main, tID, nick FROM titles, paragwgoi WHERE titles.hID = paragwgoi.hID  ORDER BY tID DESC LIMIT 0,5 ;");
    
    $ret = "";
    //if ($comments){
      //  while(($row = mysqli_fetch_array($result))){
        //$ret .= $row["Title"]." by ".$row["nick"]."<br>".$row["Main"]."";
        /*
	$comments = mysqli_query($con,"SELECT nick, comment, datetime FROM comments, paragwgoi WHERE comment.tID = ".$row["tID"]." AND paragwgoi.hID = comment.hID ;");
        if ($comments){
            while ($row2 = mysqli_fetch_array($comments)){
                $ret .= $row2["nick"]." at ".$row2["datetime"]."<br>".$row2["comment"];
            }
        }
	 * 
	 */
        //$ret .= "<br><a href=\"comment.php\" rel=\"gb_page[700, 480]\">comment</a><hr>";
      //  }
   // }else{
        while($row = mysqli_fetch_array($result)){
            $ret .= $row["Title"]." by ".$row["nick"]."<br>".$row["Main"]."<hr>";
        }
  //  }
    return $ret;
}
function ConvertSeconds($seconds) {
	$tmpseconds = substr("00".$seconds % 60, -2);
	if ($seconds > 59) {
		if ($seconds > 3599) {
			$tmphours = substr("0".intval($seconds / 3600), -2);
			$tmpminutes = substr("0".intval($seconds / 60 - (60 * $tmphours)), -2);
			
			return ($tmphours.":".$tmpminutes.":".$tmpseconds);
		} else {
			return ("00:".substr("0".intval($seconds / 60), -2).":".$tmpseconds);
		}
	} else {
		return ("00:00:".$tmpseconds);
	}
}
/*
function disp_Stats($mode,$adm){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT Address, Port, Password FROM conninfo ;");
    $row = mysqli_fetch_array($result);
    
    $shoutcast = new ShoutCast();
    $shoutcast->host = $row["Address"];
    $shoutcast->port = $row["Port"];
    $shoutcast->passwd = $row["Password"];

    if ($shoutcast->openstats()) {
            // We got the XML, gogogo!..
            if ($shoutcast->GetStreamStatus()) {
                    if ($mode == "droid") {echo $shoutcast->GetCurrentSongTitle(); return;}
                    echo "<b>".$shoutcast->GetServerTitle()."</b> ";
                    if ($adm) echo "(".$shoutcast->GetCurrentListenersCount()." of ".$shoutcast->GetMaxListenersCount()." listeners, peak: ".$shoutcast->GetPeakListenersCount().")";//<p>\n\n";

                    echo "\n<table border=0 cellpadding=0 cellspacing=0>\n";
                    if ($mode == "full") echo "<tr><td width=\"180\"><b>Server Genre: </b></td><td>".$shoutcast->GetServerGenre()."</td></tr>\n";
                    echo "<tr><td><b>Server URL: </b></td><td><a href=\"".$shoutcast->GetServerURL()."\">".$shoutcast->GetServerURL()."</a></td></tr>\n";
                    echo "<tr><td><b>Server Title: </b></td><td>".$shoutcast->GetServerTitle()."</td></tr><tr>\n";//<td colspan=2>&nbsp;</td></tr>

                    echo "<tr><td><b>Current Song: </b></td><td>".$shoutcast->GetCurrentSongTitle()."</td></tr>\n";
                    if ($mode == "full"){
                        echo "<tr><td><b>BitRate: </b></td><td>".$shoutcast->GetBitRate()."</td></tr><tr><td colspan=2>&nbsp;</td></tr>\n";

                        echo "<tr><td><b>Average listen time: </b></td><td>".ConvertSeconds($shoutcast->GetAverageListenTime())."</td></tr><tr><td colspan=2>&nbsp;</td></tr>\n";

                        echo "<tr><td><b>IRC: </b></td><td>".$shoutcast->GetIRC()."</td></tr>\n";
                        echo "<tr><td><b>AIM: </b></td><td>".$shoutcast->GetAIM()."</td></tr>\n";
                        echo "<tr><td><b>ICQ: </b></td><td>".$shoutcast->GetICQ()."</td></tr><tr><td colspan=2>&nbsp;</td></tr>\n";

                        echo "<tr><td><b>WebHits Count: </b></td><td>".$shoutcast->GetWebHitsCount()."</td></tr>\n";
                        echo "<tr><td><b>StreamHits Count: </b></td><td>".$shoutcast->GetStreamHitsCount()."</td></tr>\n";
                        
                        echo "</table><p>";

                        echo "<b>Song history;</b><br>\n";
                        $history = $shoutcast->GetSongHistory();
                        if (is_array($history)) {
                                for ($i=0;$i<sizeof($history);$i++) {
                                        echo "[".$history[$i]["playedat"]."] - ".$history[$i]["title"]."<br>\n";
                                }
                        } else {
                                echo "No song history available..";
                        }
                        echo "<p>";
                        if($adm){
                            echo "<b>Listeners;</b><br>\n";
                            $listeners = $shoutcast->GetListeners();
                            if (is_array($listeners)) {
                                    for ($i=0;$i<sizeof($listeners);$i++) {
                                            echo "[".$listeners[$i]["uid"]."] - ".$listeners[$i]["hostname"]." using ".$listeners[$i]["useragent"].", connected for ".ConvertSeconds($listeners[$i]["connecttime"])."<br>\n";
                                    }
                            } else {
                                    echo "Noone listens right now..";
                            }
                        }
                    }
                    else echo "</table><p>";
            } else {
                    echo "Server is up, but no stream available..";
            }
    } else {
            // Ohhh, damnit..
            echo $shoutcast->geterror();
    }
}
 * 
 */
function disp_akyrwseis(){
    $con = myconnect();
    
    $result = mysqli_query($con,"SELECT timestamp, nick, Title, day, start, logos FROM akyrwseis, ekpompes, paragwgoi WHERE akyrwseis.ID = ekpompes.ID AND paragwgoi.hID = akyrwseis.hID ORDER BY timestamp DESC LIMIT 0,10 ;");
    $ret = "";
    while ($row = mysqli_fetch_array($result) ){
        $ret.= "<p>".$row["timestamp"].": ".$row["nick"].", ".$row["Title"].", ".day($row["day"]).", ".$row["start"].": ".$row["logos"]."</p>";
        
    }
    return $ret;
}
function new_paragwgos($hid,$nick,$Name,$LastName,$email,$msn,$mobile,$pass){
    $con = myconnect();
    $hash = hash("md5",$pass);
    $sql = 'INSERT INTO `paragwgoi` (`hID`, `nick`, `Name`, `LastName`, `e-mail`, `msn`, `mobile`, `apousies`, `akyrwseis`, `hash`) VALUES (\''.$hid.'\', \''.$nick.'\', \''.$Name.'\', \''.$LastName.'\', \''.$email.'\', \''.$msn.'\', \''.$mobile.'\', \'0\', \'0\', \''.$hash.'\');';
    mysqli_query($con,$sql);
    $sql = 'INSERT INTO `roloi` (`hID`, `admin`, `producer`) VALUES (\''.$hid.'\', \'0\', \'1\');';
    mysqli_query($con, $sql);
    
    //echo $sql;
    
    
}
function update_paragwgos($hid,$nick,$Name,$LastName,$msn,$mobile){
    $con = myconnect();
    $hash = hash("md5",$pass);
    //$sql = 'INSERT INTO `paragwgoi` (`hID`, `nick`, `Name`, `LastName`, `e-mail`, `msn`, `mobile`, `apousies`, `akyrwseis`, `hash`) VALUES (NULL, \''.$nick.'\', \''.$Name.'\', \''.$LastName.'\', \''.$email.'\', \''.$msn.'\', \''.$mobile.'\', \'0\', \'0\', \''.$hash.'\');';
    $sql = 'UPDATE `paragwgoi` SET `nick` = \''.$nick.'\', `Name` = \''.$Name.'\', `LastName` = \''.$LastName.'\', `msn` = \''.$msn.'\', `mobile` = \''.$mobile.'\' WHERE `paragwgoi`.`hID` = '.$hid.' ;';
    $result = mysqli_query($con,$sql);
    
}
function new_ekpomph($title,$cat,$bitrate,$desc,$fbpage,$poster,$newcat){
    $con = myconnect();
    if($cat<0){
        $sql = 'INSERT INTO `eidos` (`cID`, `cat`) VALUES (NULL, \''.$newcat.'\');';
        $result = mysqli_query($con,$sql);
        $result = mysqli_query($con,"SELECT cID FROM eidos WHERE cat=\"".$newcat."\" ;");
        $row = mysqli_fetch_array($result);
        $cat = $row["cID"];
        //echo "MALAKA:".$cat;
    }
    $sql = 'INSERT INTO `ekpompes` (`ID`, `Title`, `desc`, `fbpage` , `poster`, `cID`, `bitrate`, `akyrwseis`) VALUES (NULL, \''.$title.'\', \''.$desc.'\', \''.$fbpage.'\', \''.$poster.'\', \''.$cat.'\', \''.$bitrate.'\', \'0\');';
    $result = mysqli_query($con,$sql);
}
function update_ekpomph($id,$title,$cat,$bitrate,$desc,$fbpage,$poster,$newcat){
    //echo "papaaaaaaaaaaaaria".$id;
    $con = myconnect();
    if($cat<0){
        $sql = 'INSERT INTO `eidos` (`cID`, `cat`) VALUES (NULL, \''.$newcat.'\');';
        $result = mysqli_query($con,$sql);
        $result = mysqli_query($con,"SELECT cID FROM eidos WHERE cat=\"".$newcat."\" ;");
        $row = mysqli_fetch_array($result);
        $cat = $row["cID"];
        //echo "MALAKA:".$cat;
    }
    $sql = "UPDATE ekpompes SET Title = \"".$title."\", ekpompes.desc = \"".$desc."\", cID = ".$cat.", fbpage = \"$fbpage\" , poster = \"$poster\" , bitrate = \"".$bitrate."\" WHERE ID = ".$id." ;";
    $result = mysqli_query($con,$sql);
}
function ekpomph_form($id){
    $row = null;
    if ($id){
        $con = myconnect();
        $result = mysqli_query($con,"SELECT Title, ekpompes.desc, fbpage, poster, bitrate FROM ekpompes WHERE ID = ".$id." ;");
        $row = mysqli_fetch_array($result);
        $action = "nekpomph.php?id=".$id;
        $title = "EDIT STOIXEIA EKPOMPHS";
        $call = "edit";
    }
    else{
        $action = "nekpomph.php";
        $title = "NEA EKPOMPH";
        $call = "new";
    }
    $ret = "<form style=\"background-color : yellow;\" action=\"".$action."\" method=\"post\">
    <b>".$title."</b><br>
    <input type=\"hidden\" name=\"call\" value=\"".$call."\">
    Title: <input type=\"text\" name=\"Title\" value = \"".$row["Title"]."\" size=\"30\"><br>
    Eidos: <select name=\"cat\">".get_cat_options()."</select><input type=\"text\" name=\"newcat\" size=\"25\" value=\"nea kathgoria\"><br>
    Bitrate: <input type=\"text\" name=\"bitrate\" value = \"".$row["bitrate"]."\"size=\"3\"><br>
    Description: <textarea cols=\"60\" rows=\"3\" name=\"desc\">".$row["desc"]."</textarea><br>
    FBpage: <input type=\"text\" name=\"fbpage\" size=\"50\" value=\"".$row['fbpage']."\"><br>
    Poster: <input type=\"text\" name=\"poster\" size=\"50\" value=\"".$row['poster']."\"><br>
    <input type=\"submit\" value=\"submit\"><br>
    </form>";
    return $ret;
}
function prod_form($hid){
    
    $row = null;
    if ($hid){
        $con = myconnect();
        $result = mysqli_query($con,"SELECT * FROM paragwgoi WHERE hID = \"".$hid."\";");
        $row = mysqli_fetch_array($result);
        $action = "nparagwgos.php?hid=".$hid;
        $title = "EDIT STOIXEIA PARAGWGOU";
        $call = "edit";
	$mailreadonly = "readonly=\"readonly\" style=\"background-color: gray;\"";
    }
    else{
	$mailreadonly = "";
        $action = "nparagwgos.php";
        $title = "EISAGWGH NEOU PARAGWGOY";
        $password_field = "password: <input type=\"text\" name=\"password\" size=\"20\"><br>";
        $call = "new";
    }
    $ret = "<form style=\"background-color : yellow;\" action=\"".$action."\" method=\"post\">
    <b>".$title."</b><br>
    <input type=\"hidden\" name=\"call\" value=\"".$call."\">
    nick: <input type=\"text\" name=\"nick\" size=\"15\" value=\"".$row["nick"]."\"><br>
    Name: <input type=\"text\" name=\"Name\" size=\"20\" value=\"".$row["Name"]."\"><br>
    LastName: <input type=\"text\" name=\"LastName\" size=\"20\" value=\"".$row["LastName"]."\"><br>
    e-mail: <input type=\"text\" name=\"e-mail\" size=\"40\" value=\"".$row["e-mail"]."\" ".$mailreadonly."><br>
    skype: <input type=\"text\" name=\"msn\" size=\"40\" value=\"".$row["msn"]."\"><br>
    mobile: <input type=\"text\" name=\"mobile\" size=\"13\" value=\"".$row["mobile"]."\"><br>
    ".$password_field."
    <input type=\"submit\" value=\"submit\"><br>
    </form>";
    return $ret;
}
function disp_ekpompes($id){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT ekpompes.ID, ekpompes.Title, ekpompes.desc, ekpompes.fbpage, ekpompes.poster, ekpompes.bitrate, ekpompes.akyrwseis, eidos.cat FROM ekpompes, eidos  WHERE  eidos.cID = ekpompes.cID ;");
    
    //$result = mysqli_query($con,"SELECT nick, Name, LastName FROM paragwgoi, ekpomph_atoma WHERE paragwgoi.hID = ekpomph_atoma.hID AND ekpomph_atoma.ID=".$id.";");
    $res ="";// "eimai malakas";
    while ($row1 = mysqli_fetch_array($result)){
        $res .= "<form action =\"nekpomph.php?id=".$id."\" method = \"post\" style=\"background-color: aqua;\"> <b>".$row1["Title"]."</b>";
        if ($row1["ID"] == $id){
            $res .= " <a href=\"nekpomph.php?id=".$row1["ID"]."&editinfo\">edit Info<a><br> description: ".$row1["desc"]."<br> fbpage: ".$row1["fbpage"]."<br> poster: ".$row1["poster"]."<br>Bitrate: ".$row1["bitrate"]."<br>akyrwseis: ".$row1["akyrwseis"]."<br>cat: ".$row1["cat"]."<br>Paragwgoi:<br>";
            $result2 = mysqli_query($con,"SELECT paragwgoi.hID, nick, Name, LastName FROM paragwgoi, ekpomph_atoma WHERE paragwgoi.hID = ekpomph_atoma.hID AND ekpomph_atoma.ID=".$row1["ID"]." ;");
            $res .= "";
            while($row2 = mysqli_fetch_array($result2)){
                
                $res .= "\t".$row2["nick"].", ".$row2["Name"].", ".$row2["LastName"]."<input type=\"radio\" name=\"hid\" value =\"".$row2["hID"]."\">NA FYGEI! NA PAEI ALLOY!<br>";
            }
            $res.= "<select name=\"add\">";
            $result3 = mysqli_query($con,"SELECT hID, nick FROM paragwgoi ;");
            while ($row3 = mysqli_fetch_array($result3)){
                $res .= "<option value=\"".$row3["hID"]."\">".$row3["nick"]."</option>";
            }
            $res .="</select><input type=\"radio\" name=\"hid\" value =0>ΠΡΟΣΘΗΚΗ ΠΑΡΑΓΩΓΟΥ<br><input type=\"radio\" name=\"hid\" value =-1>ΔΙΑΓΡΑΦΗ ΕΚΠΟΜΠΗΣ<input type=\"hidden\" name=\"id\" value=".$id."><input type=\"submit\" value=\"submit\">";
            
            
        }
        else $res .= " <a href=\"nekpomph.php?id=".$row1["ID"]."\">more<a>";
        
        $res .= "</form>";
    }
    return $res;

}

function prod_list(){
      $con = myconnect();
    $result = mysqli_query($con,"SELECT * FROM paragwgoi , ekpompes , ekpomph_atoma WHERE paragwgoi.hID = ekpomph_atoma.hID AND ekpomph_atoma.ID = ekpompes.ID ORDER BY ekpompes.Title ;");
    $res = "<table class=\"prodlist\"><tr><td>Εκπομπή</td><td>Όνομα</td><td>Επώνυμο</td><td>e-mail</td><td>skype</td></tr>";
    
    while ($row1 = mysqli_fetch_array($result)){
	$res.= "<tr><td>".$row1["Title"]."</td><td>".$row1["Name"]."</td><td>".$row1["LastName"]."</td><td>".$row1["e-mail"]."</td><td>".$row1["msn"]."</td><td>".$row1["mobile"]."</td></tr>";
    }
    $res.="</table>";
    return $res;
    
    
}

function disp_producers($hid){
    $con = myconnect();
    $result = mysqli_query($con,"SELECT * FROM paragwgoi ;");
    $res = "";
    
    while ($row1 = mysqli_fetch_array($result)){
        $res .= "<div style=\"background-color: aqua;\"  > <b>".$row1["nick"]."</b>";
        if ($row1["hID"] == $hid){
            $res .= "<a href=\"nparagwgos.php?hid=".$row1["hID"]."&editinfo\">edit Info</a>
		    <br> Onoma: ".$row1["Name"]."<br>
		    Epwnymo: ".$row1["LastName"]."<br>
		    e-mail: ".$row1["e-mail"]."<br>
		    msn: ".$row1["msn"]."<br>
		    Kinito: ".$row1["mobile"]."<br>
		    Symmetexei stis Ekpompes:<br>";
            $result2 = mysqli_query($con,"SELECT ekpompes.Title, ekpompes.akyrwseis FROM ekpompes, ekpomph_atoma WHERE ekpompes.ID = ekpomph_atoma.ID AND ekpomph_atoma.hID=".$hid." ;");
            while($row2 = mysqli_fetch_array($result2)){
                
                $res .= "\t".$row2["Title"].", ".$row2["akyrwseis"]." akyrwseis<br>";
            }
            $res .= "<form action=\"nparagwgos.php\" method=\"post\">"
		    . "<input type=\"hidden\" name=\"hid\" value=".$hid.">"
		    . "<input type=\"radio\" name=\"act\" value =0>"
		    . "Reset Kwdikou: <input type =\"text\" name=\"adress\" size=30 value=\"".$row1["e-mail"]."\" readonly=\"readonly\" ><br>"
		    . "<input type=\"radio\" name=\"act\" value =1>ΔΙΑΓΡΑΦΗ ΛΟΓΑΡΙΑΣΜΟΥ<br>"
		    . "<input type=\"submit\" value=\"submit\">"
		    . "</form>";
        }
	else { $res .= " <a href=\"nparagwgos.php?hid=".$row1["hID"]."\">more</a>";}
        $res .= "</div>";
    }
    return $res;
    
}
function connect_producer($id,$hid){
    $con = myconnect();
    $sql = "INSERT INTO ekpomph_atoma (ID, hID) VALUES (".$id.", ".$hid.") ;";
     $result= mysqli_query($con,$sql);
    //echo "pipa#:".$id."|".$hid;
}
function disconnect_producer($id,$hid){
    $con = myconnect();
    $sql = 'DELETE FROM `ekpomph_atoma` WHERE `ekpomph_atoma`.`ID` = '.$id.' AND `ekpomph_atoma`.`hID` = '.$hid.' ;';
    $result = mysqli_query($con,$sql);
    //echo "pipa!:".$id."|".$hid;
}
function del_ekpomph($id){
    $con = myconnect();
    $sql = 'DELETE FROM `ekpompes` WHERE `ekpompes`.`ID` = '.$id.' ;';
    $result = mysqli_query($con,$sql);   
}
function menu($adm){
    
    $menu="<A class=\"perissotera\" href=\"index.php\" target=\"_parent\">ΑΡΧΙΚΗ ΣΕΛΙΔΑ</A>
	<ul>
            <h4><strong>ΣΤΑΘΜΟΣ</strong></h4>
            <!--<li><A class=\"perissotera\" href=\"#\" target=\"_parent\"></A></li>
            <li><A class=\"perissotera\" href=\"#\" target=\"_parent\">nees 8eseis</A></li>
            <LI><A class=\"perissotera\" href=\"#\" target=\"_parent\">top 8emata</A></LI>-->
            <LI><A class=\"perissotera\" href=\"programma.php\" target=\"_parent\">ΠΡΟΓΡΑΜΜΑ</A></LI>
            <LI><A class=\"perissotera\" href=\"uploads/\" target=\"_parent\">UPLOADS</A></LI>
            <!--<h4><strong>OMADA</strong> bad-rat</h4>
            <LI><A class=\"perissotera\" href=\"#\" target=\"_parent\">protaseis idees</A></LI>
            <LI><A class=\"perissotera\" href=\"#\" target=\"_parent\">genikes syzhthseis</A></LI>
            <LI><A class=\"perissotera\" href=\"#\" target=\"_parent\">perissotera</A></LI>-->
            <h4><STRONG>ΠΛΗΡΟΦΟΡΙΕΣ</STRONG></h4><!--
            <LI><A class=\"perissotera\" href=\"#\" target=\"_parent\">ypeythynoi</A></LI>-->
            
            <LI><A class=\"perissotera\" href=\"list.php\" target=\"_parent\">ΕΠΙΚΟΙΝΩΝΙΑ</A></LI>
	<LI><A class=\"perissotera\" href=\"usercp.php\" target=\"_parent\">ΕΚΠΟΜΠΕΣ ΜΟΥ</A></LI>
            <LI><A class=\"perissotera\" href=\"logout.php\" target=\"_parent\">LOGOUT</A></LI>";
    if ($adm) $menu .="
            <h4><STRONG>ADMIN</STRONG></h4>
            <LI><A class=\"perissotera\" href=\"thema.php\" target=\"_parent\">ΝΕΟ ΘΕΜΑ</A></LI>
            <LI><A class=\"perissotera\" href=\"nparagwgos.php\" target=\"_parent\">ΠΑΡΑΓΩΓΟΙ</A></LI>
            <LI><A class=\"perissotera\" href=\"nekpomph.php\" target=\"_parent\">ΕΚΠΟΜΠΕΣ</A></LI>
            <LI><A class=\"perissotera\" href=\"conn_info_upd.php\" rel=\"gb_page[700, 480]\">ICECAST DETAILS</A></LI>
            <LI><A class=\"perissotera\" href=\"akyrwseis.php\" target=\"_parent\">ΑΚΥΡΩΣΕΙΣ</A></LI>";

    $menu.="</ul>";
    return $menu;
}
function get_cat_options(){
    $ret = "";
    $con = myconnect();
    $result = mysqli_query($con,"SELECT * FROM eidos ;");
    while($row = mysqli_fetch_array($result)){
        $ret .= "<option value =".$row["cID"].">".$row["cat"]."</option>";
    }
    $ret .= "<option value =-1 >Nea Kathgoria -></option>";
    return $ret;
}
function upd_passwd($hid,$new){
    $con = myconnect();
    $new = hash("md5",$new);
    $result = mysqli_query($con,"UPDATE paragwgoi SET hash=\"".$new."\" WHERE hID=".$hid." ;");
}
function del_producer($hid){
    $con = myconnect();
    $sql = 'DELETE FROM `paragwgoi` WHERE `paragwgoi`.`hID` = '.$hid.' ;';
    $result = mysqli_query($con,$sql);   
}
function kicker($hid,$adm){
    if (has_show_now($hid,$adm)){
        if (!$adm) echo "EXEIS EKPOMPH <u>TWRA</u><br>";
        echo "<a href=\"index.php?kicksource\">Eleu8erwse ton server</a>";
    }
}
function has_show_now($hid,$adm){
    if ($adm) $ret = true;
    else {
        $ret = false;
        $day = day(0);//$day == day(0);

        $con = myconnect();
        $time_now = date("G:i:s");
        $sql = "SELECT ekpomph_atoma.hID FROM ekpomph_atoma, programma WHERE (ekpomph_atoma.ID = programma.tempID OR (ekpomph_atoma.ID = programma.ID AND programma.tempID IS NULL)) AND programma.day = ".day(0)." AND programma.start < \"".$time_now."\" AND programma.end > \"".$time_now."\" AND programma.keno = 0 ;";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_array($result)){
            if ($row["hID"] == $hid) $ret = true;
        }
    }
    return $ret;
}
// function kick_source(){
    // $con = myconnect();
    // $result = mysqli_query($con,"SELECT Address, Port, blank2 FROM conninfo ;");
    // $row = mysqli_fetch_array($result);
    // $timeout = 5;
    // $pass=$row["blank2"];
    // $ip=$row["Address"];
    // $port=$row["Port"];

    // $fp = @fsockopen($ip, $port, &$errno, &$errstr, $timeout);
    // if($fp) {
    // fputs($fp,"GET /admin.cgi?pass=".$pass."&mode=kicksrc  HTTP/1.0\r\nUser-Agent: XML Getter (Mozilla Compatible)\r\n\r\n");

// echo "Success, Source kicked. <a href='index.php'>Go Back</a>"; }
// }
//function force_covers($day){
//    $con = myconnect();
//    $sql = "SELECT programma.start FROM programma WHERE programma.keno = 1 ;";
//    $result = mysqli_query($con,$sql);
//    while($row = mysqli_fetch_array($result)){
//        
//    }
//}
/*
echo "test<br> date:";
echo day();
echo day(3);


*/
//echo "test test";

//echo program_day(1,$adm,$plus);

?>