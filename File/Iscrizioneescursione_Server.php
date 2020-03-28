<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'nome'=>$_SESSION['nome'],'codiceEscursione'=>$_POST['id'],'azione' => 'Nuovo iscrizione escursione'];
     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}


if(isset($_POST['send_iscrizioneEscursione'])) {
	$id=$_POST['id'];
	$nome=$_SESSION['nome'];
	

	$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

	$sql="CALL iscrizioneEscursione('$id','$nome')";

	if(mysqli_query($db,$sql)) {
		
		echo '<script language="javascript">';
		echo 'alert("ESCURSIONE INSERITA!!"); location.href="iscrizioneescursione.php"';
		echo '</script>';
	} else {
		
		echo '<script language="javascript">';
		echo 'alert("ESCURSIONE NON INSERITA!"); location.href="iscrizioneescursione.php"';
		echo '</script>';
	};
}
?>
