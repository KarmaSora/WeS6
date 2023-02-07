<?php
include_once('../../model/dbFunctions.php');



//$userID =  "5b5c84fe-9caf-11ed-ab68-0242ac130004";        testkörning! ta bort if satsen

if(isset($_GET['userID'])){

    $userID = $_GET['userID'];
    
    //filter_input(INPUT_GET, 'userID',FILTER_SANITIZE_SPECIAL_CHARS);

$result = getPostsAndCommnetsByUid($userID);

// Behövs för session-cookies och anger att formatet är json
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

// Gör om arrayen till en array med json-objekt
echo json_encode($result);


}

