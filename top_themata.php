<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Top θέματα</TITLE>

<link rel="StyleSheet" type="text/css" href="RSC.css"/>

</head>


<body>

<div class="body">
<div class="header">
<H1>rAT sTATION cENTER (RSC)</H1>
</div>
<div class="left">
<A class="perissotera" href="RSC.php" target="_parent">Αρχική σελίδα</A>
<ul>
<h4><strong>ΣΤΑΘΜΟΣ</strong></h4>
<LI><A class="perissotera" href="kena.php" target="_parent">Κενά σε εκπομπές</A></LI>
<li><A class="perissotera" href="allages.php" target="_parent">Αλλαγές</A></li>
<li><A class="perissotera" href="nees_thesis.php" target="_parent">Νέες Θέσεις</A></li>
<LI><A class="perissotera" href="top_themata.php" target="_parent">Top θέματα</A></LI>
<h4><strong>ΟΜΑΔΑ</strong> bad-rat</h4>
<LI><A class="perissotera" href="protaseis_idees.php" target="_parent">Προτάσεις/<BR>Ιδέες</A></LI>
<LI><A class="perissotera" href="genikes_suzhthseis.php" target="_parent">Γενικές Συζητήσεις</A></LI>
<LI><A class="perissotera" href="erwtisis.php" target="_parent">Ερωτήσεις</A></LI>
<h4><STRONG>ΠΛΗΡΟΦΟΡΙΕΣ</STRONG></h4>
<LI><A class="perissotera" href="upeuthunoi.php" target="_parent">Υπεύθυνοι</A></LI>
<LI><A class="perissotera" href="leptomeries.php" target="_parent">Λεπτομέριες Εκπομπών</A></LI>
<LI><A class="perissotera" href="epishmo e-mail.php" target="_parent">Επίσημο e-mail</A></LI>
</ul>
</div>
<p><H2>Top θέματα</H2></p>
<?php
$con =mysql_connect("localhost","root","opeth666");
if (!$con)
	{
	die ('Δεν μπόρεσε να συνδεθεί: ' . mysql_error());
	}
mysql_select_db("bcastinfo", $con);
$result= mysql_query("SELECT * FROM top_themata ORDER BY top_themata.date DESC ;");
$n=0;
WHILE(($row= mysql_fetch_array($result)) && $n<10)
	{
	$topthemata.= "<p><strong>".$row["title"]."</strong>&nbsp;&nbsp;".$row["date"]."</p><p>".$row["text"]."</p><br>";
	$n++;
	}

echo $topthemata;

?>

</div>

</body>
</html>