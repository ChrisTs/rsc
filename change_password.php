<?php
include "config.php";
$auth = authsecure();
    
  $user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);

if(isset($_POST["old"])) echo $auth->changePassword($user_id, $_POST["old"], $_POST["pass"], $_POST["pass1"])["message"];
           
?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>BCastInfo</TITLE>
</head>

<body bgcolor="aaaaaa">
<center>
<br>

    
   <form action="change_password.php" method="post">
        
        <font color="FF0000">
        
        old password: <input type="password" name="old"><br>
        new password: <input type="password" name="pass"><br>
        repeat new password: <input type="password" name="pass1"><br>
        </font>
        <input type="submit" value="change">
    </form>
    <br><br>


</body>
</html>


