<?php 

include("../../model/worldDbFunctions.php");

if(isset($_GET['code'])){
    $code = filter_input(INPUT_GET, 'code',FILTER_SANITIZE_SPECIAL_CHARS);
 

//$db = connectToDb();
$SQLQuestionResult = getSpecifiedCities($code);

header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


echo json_encode($SQLQuestionResult);
 
}

?>