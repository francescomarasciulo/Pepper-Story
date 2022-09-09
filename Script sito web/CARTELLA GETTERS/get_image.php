<?php 

require_once('connection.php');

$table = $_POST["table"];
$id = $_POST["id"];

$query = "SELECT * FROM `$table` WHERE id = $id+1";
$stmt = $conn->prepare($query);
$stmt->execute();
 
// to verify if a record is found
$num = $stmt->rowCount();
 
if ($num) {
    // if found
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // specify header with content type,
    // you can do header("Content-type: image/jpg"); for jpg,
    // header("Content-type: image/gif"); for gif, etc.
    header("Content-type: image/jpeg");
    
    //display the image data
    print $row['Immagine'];
    //echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Immagine']).'"/>';
    exit;
} else {
    //if no image found with the given id,
    //load/query your default image here
    echo "Nessun immagine trovata";
}

?>