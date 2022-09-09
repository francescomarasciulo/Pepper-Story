<?php

session_start();

require_once('connection.php');

$mySelectStatement = $conn->prepare("SELECT * FROM `Storie`");
$mySelectStatement->execute();
$userStoriesResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($userStoriesResult);

$conn=null;


?>