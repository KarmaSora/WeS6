



<?php




if (isset($_SESSION['uid'])) {
    include_once '../../../model/dbFunctions.php';

    $db = connectToDb();
    $postRows = getAllPosts($db);

    foreach ($postRows as $row) {
        echo "<p><strong>" . $row['firstname'] . " " . $row['surname'] . "</strong></p>";
        echo "<p>" . $row['post_txt'] . "</p>";
        echo "<p class='time'><time>" . $row['date'] . "<time></p>";
        echo "<hr>";
        // Skapa funktionen getComments i dBFunctions.php.
        // $commentsRows = getComments($db, $row['pid']); 
        echo "<section>";
        /**
         * Kommentarer skall visas här
         * Varje kommentar skall inneslutas i ett article-element
         */
        echo "</section>";
        echo "</article>";
    }
}







//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------

/*

//kod från teori, innan MVC.... upp 1-4
    include '../../inc/db.inc.php';
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
        
       
         // Hämta kommentarer till detta pid från egytalk
         
     
        echo "<section>";
       
         //Kommentarer skall visas här
         // Varje kommentar skall inneslutas i ett article-element
       
        echo "</section>";
        echo "</article>";
        
        include '../../inc/commentForm.php';
    }

    */
?>