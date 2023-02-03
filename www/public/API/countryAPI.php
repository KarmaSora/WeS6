<?php
session_start();

//include("../inc/db.inc.php");
include("../../model/worldDbFunctions.php");


$db = connectToDb();
$SQLQuestionResult = getAllCountries($db);



header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');


echo json_encode($SQLQuestionResult);



