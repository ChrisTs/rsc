<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Panel Top θέματα</TITLE>




</head>
<body>
<FORM method="POST" action="panel_top_themata.php">
Τίτλος Κειμένου<INPUT type="text" name="title" maxlength="50" align="top"><br><br><br>
<textarea name="text" cols="100" rows="20"></textarea><br>
<INPUT type="submit" value="submit">
</FORM>

<?php
$con= mysql_connect("localhost","root","opeth666");
 if (!$con)
	{
	die('Δεν μπόρεσε να συνδεθεί:' . mysql_error());
	}
 mysql_select_db("bcastinfo", $con);
$result = mysql_query("INSERT INTO .top_themata ( ID_top, title, text, date) VALUES(NULL, \"".$_POST["title"]."\", \"".$_POST["text"]."\", NOW());");
IF (!$result)
 {
 die ('Δεν μπόρεσε να συνδεθεί' . mysql_error());
 }
?>








</body>
</html>