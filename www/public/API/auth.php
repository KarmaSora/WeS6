<?php
session_start();

include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();

$response['auth'] = false;
$response['userdata'] = null;

// Om redan inlogggad skicka data
if (isset($_SESSION['uid'])) {
    $user = $db->getUserFromUid($_SESSION['uid']);
} else if (isset($_POST['username'], $_POST['pwd'])) {
    $user = $db->auth($_POST['username'], $_POST['pwd']);
}

if (isset($user) && !empty($user)) {
    $response['auth'] = true;
    $response['userdata'] = $user;
    session_regenerate_id();
    $_SESSION['uid'] = $user['uid'];
}

header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

echo json_encode($response);
