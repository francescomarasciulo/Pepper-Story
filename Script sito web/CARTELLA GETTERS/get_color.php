<?php

require "connection.php";

//$table = $_POST['table'] ?? '';
$table = $_POST["table"];

//$query = $conn->prepare("SELECT * FROM $table");
$query = $conn->prepare("SELECT Colore FROM `$table`");
//$query->bindParam(':table', $table);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
//$json = json_encode($resultArray);
echo json_encode($result);

$conn=null;
?>