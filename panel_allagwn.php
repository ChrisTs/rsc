<?php
    include "config.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>panel Αλλαγ�?ν</TITLE>



</head>


<body>
<FORM method="POST" action="panel_allagwn.php">
Τίτλος �?ειμένου<INPUT type="text" name="title" maxlength="50" align="top"><br><br><br>
<textarea name="text" cols="100" rows="20"></textarea><br>
<INPUT type="submit" value="submit">
</FORM>

<?php
ECHO $_POST["title"];
$con= mysql_connect($host,$user,$pass);
 if (!$con)
	{
	die('Δεν μπ�?�?εσε να συνδεθεί:' . mysql_error());
	}
 mysql_select_db($db, $con);
$result = mysql_query("INSERT INTO .allages ( tID, title, text, date) VALUES(NULL, \"".$_POST["title"]."\", \"".$_POST["text"]."\", NOW());");
IF (!$result)
 {
 die ('mlkia' . mysql_error());
 }
?>

</body>
</html>