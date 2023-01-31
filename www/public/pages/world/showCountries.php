<?php    
include_once('../../inc/db.inc.php');    
 
if(isset($_POST['country'])){
    $country = filter_input(INPUT_POST, 'country',FILTER_SANITIZE_SPECIAL_CHARS);
    
    /**Kör frågan mot databasen world och tabellen country. 
     * ? ERSÄTTS I RADEN UNDER MED EN PARAMETER
     */
    $stmt= $db->prepare("SELECT Name, Population FROM country WHERE Name LIKE ? ORDER BY Name");
    $stmt->bindValue(1, "$country%", PDO::PARAM_STR);
    $stmt->execute();        
    
    /* Anger teckenkodningen för webbläsaren */
    header('Content-Type: text/html; charset=utf-8');
    
    /* skriver ut resultatet på webbsidan. */
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<strong>Land: </strong>".$row['Name'];
        echo " <strong>Antal invånare: </strong>".$row['Population'];
        echo "<br /><hr />";
    }
}
?>