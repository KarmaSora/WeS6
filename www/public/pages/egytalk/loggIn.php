<?php
    session_start();
    
    if(isset($_POST['password'], $_POST['user'])){ 
   	 include_once '../../inc/db.inc.php';
   	 $user = filter_input(INPUT_POST, 'user', FILTER_UNSAFE_RAW);
   	 $pwd = $_POST['password'];
   	 
   	 /* Bygger upp sql frågan */
   	 $stmt= $db->prepare("SELECT * FROM user WHERE username = :user");
   	 $stmt->bindValue(":user", $user);
   	 
   	 $stmt->execute();
   	 
   	 /** Kontroll att resultat finns */
   	 if($stmt->rowCount() == 1){
   		 // Hämtar användaren, kan endast kunna vara 1 person
   		 $user = $stmt->fetch(PDO::FETCH_ASSOC);
   		 // Kontrollerar lösenordet, och allt ok.
   		 if(password_verify($pwd, $user['password'])){
   			 session_regenerate_id(true);
   			 
   			 $_SESSION['uid'] = $user['uid'];
   			 $_SESSION['username'] = $user['username'];
   			 $_SESSION['name'] = $user['surname']." ".$user['firstname'];

   			 header("Location: ../../index.php");
   			 exit();
   		 }
   	   }
     }
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8" >
    <title>Sessioner</title>
</head>

<body>
    <form method="post" >
   	 Username: <input type="text" name="user" size="20" /><br />
   	 Password: <input type="password" name="password" size="20" /><br />
   	 <input type="submit" value="Logga in" name="login"/>
    </form>
</body>
</html>
