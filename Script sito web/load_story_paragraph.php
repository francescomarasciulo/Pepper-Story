<?php
session_start();

require_once('connection.php');

$story = $_GET['name'];
$id_counter=1;
$endof_array=false;
do{
    $mySelectStatement = $conn->prepare("SELECT Testo, Immagine FROM `$story` WHERE id = $id_counter");
    //$mySelectStatement = $conn->prepare("SELECT * FROM `$story`");
    $mySelectStatement->execute();
    $result = $mySelectStatement->fetch(PDO::FETCH_ASSOC);
    if($result!=null){
    	if($result['Immagine']!=null){
            $type = pathinfo($result, PATHINFO_EXTENSION);
    		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($result['Immagine']);
        }else if($result['Immagine']==null)$base64=null;

   	 	if($paragraph==null) $paragraph= array(array($result['Testo'], $base64));
        else array_push($paragraph, array($result['Testo'], $base64));
    	$id_counter++;
    }else $endof_array=true;
}while($endof_array==false);
    $json = json_encode($resultArray);
    echo json_encode($paragraph);

$conn=null;
?>