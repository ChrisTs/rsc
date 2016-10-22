<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Προτασεις/Ιδέες</TITLE>

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
<p><H2>Νέα Πρόταση/Ιδέα</H2></p>

<FORM method="POST" action="nea_protash_idea.php">
Τίτλος Κειμένου<INPUT type="text" name="title" maxlength="50" align="top"><br><br><br>
<textarea name="text" cols="100" rows="20"></textarea><br>
<INPUT type="submit" value="submit">
</FORM>

<?php
ECHO $_POST["title"];
$con= mysql_connect("localhost","root","mysqlubuntu8.04");
 if (!$con)
	{
	die('Δεν μπόρεσε να συνδεθεί:' . mysql_error());
	}
 mysql_select_db("bcastinfo", $con);
$result = mysql_query("INSERT INTO \"".$_POST["value"]."\" ( IDtxt, title, text, date) VALUES(NULL, \"".$_POST["title"]."\", \"".$_POST["text"]."\", NOW());");
IF (!$result)
 {
 die ('mlkia' . mysql_error());
 }
?>









</div>
</body>
</html>