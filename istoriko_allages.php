<?php
function date2int($date,$function)
	{
	$pieces =strtok($date,"-");
    if ($function=="month")
      {
      $pieces =strtok("-");
      }
RETURN $pieces;
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Ιστορικό Αλλαγών</TITLE>

<link rel="StyleSheet" type="text/css" href="RSC.css"/>



</head>


<body>
<div class="body">
<div class="header">
<H1>rAT sTATION cENTER (RSC)</H1>
</div>
<div class="left">
<ul>
<h4><strong>ΣΤΑΘΜΟΣ</strong></h4>
<LI><A class="perissotera" href="kena.php" target="_blank">Κενά σε εκπομπές</A></LI>
<li><A class="perissotera" href="allages.php" target="_blank">Αλλαγές</A></li>
<li><A class="perissotera" href="nees_thesis.php" target="_blank">Νέες Θέσεις</A></li>
<LI><A class="perissotera" href="top_themata.php" target="_blank">Top θέματα</A></LI>
<h4><strong>ΟΜΑΔΑ</strong> bad-rat</h4>
<LI><A class="perissotera" href="protaseis_idees.php" target="_blank">Προτάσεις/<BR>Ιδέες</A></LI>
<LI><A class="perissotera" href="genikes_suzhthseis.php" target="_blank">Γενικές Συζητήσεις</A></LI>
<LI><A class="perissotera" href="erwtisis.php" target="_blank">Ερωτήσεις</A></LI>
<h4><STRONG>ΠΛΗΡΟΦΟΡΙΕΣ</STRONG></h4>
<LI><A class="perissotera" href="upeuthunoi.php" target="_blank">Υπεύθυνοι</A></LI>
<LI><A class="perissotera" href="leptomeries.php" target="_blank">Λεπτομέριες Εκπομπών</A></LI>
<LI><A class="perissotera" href="epishmo e-mail.php" target="_blank">Επίσημο e-mail</A></LI>
</ul>
</div>

Διάλεξε μήνα
<FORM name= "form1" id= "form1" method= "GET" action= "istoriko_allages.php"> 
<SELECT name= "date">
<OPTION value="01">Ιανουάριος</OPTION>
<OPTION value="02">Φεβρουάριος</OPTION>
<OPTION value="03">Μάρτιος</OPTION>
<OPTION value="04">Απρίλιος</OPTION>
<OPTION value="05">Μάιος</OPTION>
<OPTION value="06">Ιούνιος</OPTION>
<OPTION value="07">Ιούλιος</OPTION>
<OPTION value="08">Αύγουστος</OPTION>
<OPTION value="09">Σεπτέμβριος</OPTION>
<OPTION value="10">Οκτώμβριος</OPTION>
<OPTION value="11">Νοέμβριος</OPTION>
<OPTION value="12">Δεκέμβριος</OPTION>
</SELECT>
χρόνο
<select name="year">
<OPTION value="2009">2009</OPTION>
<OPTION value="2010">2010</OPTION>
<OPTION value="2011">2011</OPTION>
<OPTION value="2012">2012</OPTION>
</select>
<input type="submit" value="ok">

</FORM>




<?php
$con = mysql_connect("localhost","root","opeth666");
if (!$con)
	{
        die ('de mpas na gamitheis re');
	}
mysql_select_db("bcastinfo", $con);
$result = mysql_query(" SELECT * FROM allages ORDER BY allages.DATE DESC ;");
WHILE ($row =mysql_fetch_array($result))
	{
	if ((date2int($row["DATE"],"month") == $_GET["date"]) && (date2int($row["DATE"],"year")== $_GET["year"]))
		{
		$allagestxt.="<p>&nbsp;&nbsp;&nbsp;<strong>".$row["title"]."</strong><br><br>&nbsp;&nbsp;&nbsp;".$row["text"]."</p><br>";
		}
	}
$row =mysql_fetch_array($result);
echo $allagestxt;

?>


</div>



</body>
</html>