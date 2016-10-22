<?php
include "config.php";
$auth = authsecure();
$user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);
     
   
    //$bad_user;
    if ($adm){
?>
<!-- COPYRIGHT CHRISTOFYLIS TSITSIMPIS FUCKERS! -->
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1253">
  </head>
<body bgcolor="aaaaaa"><center>
<br>

   <?= connInfo(1,$_POST["addr"],$_POST["port"],$_POST["passwd"],$_POST["admpasswd"]) ?>

  </body>
</html>
<?php } else echo "eimai malakas"; ?>