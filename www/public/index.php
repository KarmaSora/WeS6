<?php session_start(); ?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8" >
    <title>EGY Talk</title>
</head>
<body>    
   <h1>dgnk.safsnmgnck.</h1>
   <h1>se till att ändra i inc/db.inc.php !!!!</h1>
    <?php    

echo(password_hash("chess" , PASSWORD_DEFAULT));
   	 if(isset($_SESSION['uid'])){
   		 include 'inc/private.php';
   	 }else{
   		// include 'inc/public.php';
   		 include 'pages/egytalk/public.php';

        }
        
    ?>
    
</body>
</html>
