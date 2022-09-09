<?php

session_start();

require_once('connection.php');

$mySelectStatement = $conn->prepare("SELECT * FROM `Storie` WHERE Username = :username");
$mySelectStatement->bindParam(':username', $_SESSION["Username"]);
$mySelectStatement->execute();
$userStoriesResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
//$json = json_encode($resultArray);
echo json_encode($userStoriesResult);

$conn=null;


?>