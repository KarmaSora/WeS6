<?php
/**
* Anluter till databasen och returnerar ett PDO-objekt
* @return PDO  Objektet som returneras
*/
function connectToDb(){
  // Definierar konstanter med användarinformation.
  define ('DB_USER', 'egytalk');
  define ('DB_PASSWORD', '12345');
  define ('DB_HOST', 'mariadb'); // mariadb om docker annars localhost
  define ('DB_NAME', 'egytalk');
 
  // Skapar en anslutning till MySql och databasen egytalk
  $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
  $db = new PDO($dsn, DB_USER, DB_PASSWORD);
 
  return $db;
}
 
/**
* Hämtar alla status-uppdateringar i tabellen post
*
* @param $db PDO-objekt
* @return array med alla status-uppdateringar
*/
function getAllPosts($db){
  $sqlkod = "SELECT post.*, user.firstname, user.surname, user.username FROM post NATURAL JOIN user ORDER BY post.date LIMIT 0,30";
 
  /* Kör frågan mot databasen egytalk och tabellen post */
  $stmt = $db->prepare($sqlkod);
  $stmt->execute();
 
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getPostsByUid($UID){
  $db = connectToDb();
  $sqlkod = "SELECT post.*, user.firstname, user.surname, user.username FROM post NATURAL JOIN user WHERE post.uid = :userID ORDER BY post.date LIMIT 0,30";
  /* Kör frågan mot databasen egytalk och tabellen post */
  $stmt = $db->prepare($sqlkod);
  $stmt->bindValue(':userID', $UID);
  $stmt->execute();
 
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getPostsAndCommnetsByUid($UID){
  $db = connectToDb();

//skapa en array genom att hämta alla posts och allt i user förutom password från egytalk tabellerna user och post. Söker efter uid och har limit på 30. 
//arrayen innehåller alla alla poster, när de skrivs och vilka skrev posterna. 
//kan behöva separera SQL koden so endast post txt syns här
  $sqlkod = "SELECT post.*,user.uid,user.firstname,user.surname,user.username  FROM post JOIN user WHERE user.uid = :userID ORDER BY post.date LIMIT 0,30  ";

  // Kör frågan mot databasen egytalk och tabellen post 
  $stmt = $db->prepare($sqlkod );
  $stmt->bindValue(':userID', $UID);
  $stmt->execute();
  $PostsFromUser = $stmt->fetchAll(PDO::FETCH_ASSOC);


  //skapar array av comments

 // $sqlkodGetComments = " SELECT comment_txt, pid FROM comment JOIN post WHERE comment.pid = post.pid LIMIT 0,30;";
 $sqlkodGetComments = "SELECT comment.comment_txt, comment.pid, post.pid FROM comment JOIN post WHERE comment.pid = post.pid LIMIT 0,30;";

  $stmt2 = $db->prepare($sqlkodGetComments);
  $stmt2->execute();
  $arrayOfComments = $stmt2->fetchAll(PDO::FETCH_ASSOC);      //arrayOfComments[] motsvarar en array med namnet posts som det skulle kallas enlgit uppgiften

  
    foreach ($PostsFromUser as $post) {
    $post['comments'] = [];
    foreach ($arrayOfComments as $comment) {
      if ($comment['pid'] == $post['pid']) {
        $post['comments'][] = $comment['comment_txt'];
      }
    }}

  

  // en array som lopar igenom Posts 
  



  //ersättning till koden den komenterade koden ovan
   // $PostsFromUser = getPostsByUid($UID);

 

  return $PostsFromUser ;     // har en säkerhets kopia av den funktionen innan ändringen, kopian finns i drive!
}


?>