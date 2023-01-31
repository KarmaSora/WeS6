<?php
session_start();
 
if(isset($_POST['comment'], $_POST['pid'])){

  include("db.inc.php");
  $pid = filter_input(INPUT_POST, 'pid', FILTER_SANITIZE_NUMBER_INT);
  $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


  $stmt= $db->prepare("INSERT INTO comment(pid, uid, comment_txt, date) VALUES(:pid, :uid, :com, :date)");
  
  $stmt->bindValue(":pid", $pid);
  $stmt->bindValue(":uid", $_SESSION['uid']);
  $stmt->bindValue(":com", $comment);
  $stmt->bindValue(":date", date("Y-m-d h:i:s"));
  
  $stmt->execute();
}
/** Dirigerar om till index.php  */
header('Location: ../index.php');
?>