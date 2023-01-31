<?php
    include 'db.inc.php';
    echo "<p>user: " . $_SESSION['name'] . "</p>";
    echo "<p>username: " . $_SESSION['username'] . "</p>";
    echo "<p>user-id: " . $_SESSION['uid'] . "</p>";
    
    $sqlkod = "SELECT post.*, user.firstname, user.surname, user.username FROM post NATURAL JOIN user WHERE post.uid = :uid ORDER BY post.date DESC LIMIT 0,30";
    
    $stmt = $db->prepare($sqlkod);
    $stmt->bindValue(":uid",$_SESSION['uid']);
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<article>";
        echo "<p><strong>".$row['firstname'] . " " .$row['surname'] . "</strong></p>";
        echo "<p>" . $row['post_txt'] . "</p>";
        echo "<p class='time'><time>" . $row['date'] . "<time></p>";
        
        /**
         * Hämta kommentarer till detta pid från egytalk
         */
     
        echo "<section>";
        /**
         * Kommentarer skall visas här
         * Varje kommentar skall inneslutas i ett article-element
         */
        echo "</section>";
        echo "</article>";
        

    }
    include 'commentForm.php';
?>
<html>
    <a href="./inc/loggOut.php"> loggOut</a>
</html>