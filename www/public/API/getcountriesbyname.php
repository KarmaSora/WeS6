<?php 

include("../../model/worldDbFunctions.php");

if(isset($_GET['name'])){
    $name = filter_input(INPUT_GET, 'name',FILTER_SANITIZE_SPECIAL_CHARS);
 

//$db = connectToDb();
$SQLQuestionResult = getSpecifiedCountry($name);

header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


echo json_encode($SQLQuestionResult);
 
}

?>