<?php    
    include_once('../../inc/db.inc.php');
    /* Bygger upp sql frågan */
    $sqlkod = "SELECT Name, Population FROM country WHERE Name LIKE 'Z%' ORDER BY Name";    
    
    /* Kör frågan mot databasen world och tabellen country */
    $stmt = $db->prepare($sqlkod);    
    $stmt->execute();
 
    /* Anger teckenkodningen för webbläsaren */
    header('Content-Type: text/html; charset=utf-8');
    
    /* skriver ut resultatet på webbsidan. */
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<strong>Land: </strong>".$row['Name'];
        echo " <strong>Antal invånare: </strong>".$row['Population'];
        echo "<br /><hr />";
    }
?>
