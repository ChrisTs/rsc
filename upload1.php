<?php
    include "config.php";
    
    $auth = authsecure();
    $user_id = $auth->getSessionUID($auth->getSessionHash());
$adm = $auth->isAdmin($user_id);

    
    
    $bad_user;
  //  if ($adm){//echo $bad_user;
	
	?>
   
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>Όλοι οι αρουραίοι σ' ένα μέρος!</TITLE>

<link rel="StyleSheet" type="text/css" href="RSC.css"/>

</head>


<body>

<div class="body">
<div class="header">
<H1>rAT sTATION cENTER (RSC)</H1>
</div>
<div class="left">
<?= menu($adm)?>
</div>
<div class="programma">


<form action="upload.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>



</div>
</div>
</body>
</html>
<?php// } else echo "eisai malakas"; ?> 