<?php 
    session_start();  

    require_once('connection.php');
    $mySelectStatement = $conn->prepare("SELECT Titolo FROM `Storie` WHERE Username = :username");
    $mySelectStatement->bindParam(':username', $_SESSION["Username"]);
    $mySelectStatement->execute();
    $stories = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
    //Definisco una variabile di sessione che cicla per il numero di storie presenti nella tabella
    $n_stories=count($stories)-1;
    
    if( isset( $_SESSION['counter'] ) ) {
    	if( $_SESSION['counter'] < $n_stories) {
        	$_SESSION['counter'] += 1;
        }
        elseif( $_SESSION['counter'] >= $n_stories ){
        	$_SESSION['counter'] = 0;
        }
    }else {
        $_SESSION['counter'] = 0;
    }
    //Fine robe per la sessione
    $count=$_SESSION['counter'];
    $story= $stories[$count]['Titolo']; 
    $query = "SELECT * FROM `$story`";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	$id=1;
    while($id <= count($row)){    	
    	$query = "SELECT Immagine, nome FROM `$story` WHERE id= $id";
        $stmt = $conn->prepare($query);
    	$stmt->execute();
    	$result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['nome']!=null)break;
        else $id++;
    }
    //Provo a convertire in base 64
	$type = pathinfo($result, PATHINFO_EXTENSION);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($result['Immagine']);
    echo $base64;
    //echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Immagine']).'"/>';
    $conn=null;
?>


