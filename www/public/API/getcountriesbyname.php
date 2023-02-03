<?php 

include("../../model/worldDbFunctions.php");

if(isset($_GET['countryName'])){
    $country = filter_input(INPUT_GET, 'countryName',FILTER_SANITIZE_SPECIAL_CHARS);
 

//$db = connectToDb();
$SQLQuestionResult = getSpecifiedCountry($country);

header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


echo json_encode($SQLQuestionResult);
 
}

?>