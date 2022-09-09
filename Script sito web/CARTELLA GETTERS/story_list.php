<?php

require "connection.php";

$query = $conn->prepare("SELECT * FROM Storie");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($resultArray);
echo json_encode($result);

$conn=null;

?>