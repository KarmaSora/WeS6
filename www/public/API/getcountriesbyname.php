<!DOCTYPE html>
<html lang ='sv'>
<head>
  <meta charset="UTF-8">
  <title>Sök länder</title>
</head>
<body>
 
<form method="get">
    <label>Land: </label>
    <input type="text" name="countryName" size="20">
    
    <input type="submit" value="Submit" name="Sök">
</form>
 
</body>
</html>

<?php 

include("../../model/worldDbFunctions.php");

if(isset($_POST['countryName'])){
    $country = filter_input(INPUT_POST, 'countryName',FILTER_SANITIZE_SPECIAL_CHARS);
 

$db = connectToDb();
$SQLQuestionResult = getSpecifiedCountry($db, $country);



header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


echo json_encode($SQLQuestionResult);

}



?>