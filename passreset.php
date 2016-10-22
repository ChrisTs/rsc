<?php
    include 'config.php';
    
    $auth = newauth();
    $result;
    if (isset($_POST["e-mail"])){
	$result = $auth->requestReset($_POST["e-mail"]);
    }
    if (isset($_POST["key"])){
	$result =  $auth->resetPass($_POST["key"], $_POST["pass1"], $_POST["pass2"]);
    if(!$result["error"]){
	header("Location: login.php");
	exit();
	
}
    
    }
    echo $result["message"];
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
  </head>
<body bgcolor="aaaaaa"><center>
<br>

<form action="passreset.php" method="post">
    <font color="FF0000">
	registered e-mail:<input type="text" name="e-mail"><br>
	<input type="submit" value="send me a key">
    </font>
    <br>
    <br>
	
</form>

   <form action="passreset.php" method="post">
        <font color="FF0000">key: <input type="text" maxlength="30" name="key"><br>
	    new password: <input type="password" name="pass1"><br>
	    repeat: <input type="password" name="pass2"><br></font>
       
        <input type="submit" value="reset password">
    </form> 

  </body>
</html>
