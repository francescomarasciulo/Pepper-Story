<?php
	session_start();
	require_once('connection.php');    	
	
    $mySelectStatement = $conn->prepare("SELECT * FROM `Storie Temp`");
    $mySelectStatement->execute();
   	$storiesResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
   	echo json_encode($storiesResult);
   	
$conn=null;
?>