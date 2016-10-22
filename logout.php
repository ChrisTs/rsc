<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'config.php';

$auth = authsecure();

$success = $auth->logout($auth->getSessionHash());
$msg = 'fail';
if($success) {
      header("Location: index.php");
        exit();
             
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>logout</TITLE>



</head>


<body>
    <?=$msg?>
</body>
</html>