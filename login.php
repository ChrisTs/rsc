<?php
    include "config.php";
    
    $auth = newauth();
    
         if(isset($_POST["email"])){
	     if(isset($_POST["remember"])) {
		$ret = $auth->login( filter_input(0, "email"), filter_input(0, "password"),filter_input(0, "remember")); 
	     }
        else {
	    $ret = $auth->login( filter_input(0, "email"), filter_input(0, "password"));
	}
        if(!$ret["error"]) setcookie( "rsc", $ret["hash"], $ret["expire"],'','',1,1 ); 
        echo $ret["message"];
        header("Location: index.php");
        exit();
             
    }
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
  </head>
<body bgcolor="aaaaaa"><center>
<br>

   <form action="login.php" method="post">
        <font color="FF0000">email: <input type="text" maxlength="50" name="email"><br>
        password: <input type="password" name="password"><br></font>
       <input type="checkbox" name="remember" value="1">remember me!  
       <input type="submit" value="login">
	
    </form> 
<br>
<a href="passreset.php">forgot password?</a>

  </body>
</html>
