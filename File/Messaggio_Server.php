<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
     $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'mittente'=>$_SESSION['nome'],'destinatario'=>$_POST['destinatario'],'titolo'=>$_POST['titolo'], 'testo'=>$_POST['testo'],'azione' => 'Nuovo messaggio'];
     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}


if(isset($_POST['send_messaggio'])) {
	$timestamp=date("Y-m-d H:i:s");
	$nome=$_SESSION['nome'];
	$destinatario=$_POST['destinatario'];
	$titolo=$_POST['titolo'];
	$testo=$_POST['testo'];

	$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

	$sql="CALL nuovoMessaggio('$timestamp','$nome','$destinatario','$titolo','$testo')";

	$exists = "SELECT nome FROM utente WHERE(utente.nome = '$destinatario')";
	$result = mysqli_query($db,$exists);  //salvo dentro la result il risultato della query exists
	$num = mysqli_num_rows($result);  //ritorna il numero di righe di result

	if($num==0){
		echo '<script language="javascript">';
		echo 'alert("Destinatario sconosciuto, controlla di nuovo!"); location.href="messaggio.html"';
		echo '</script>';
	}
	else if(mysqli_query($db,$sql)) {

		echo '<script language="javascript">';
		echo 'alert("MESSAGGIO INVIATO!!"); location.href="messaggio.html"';
		echo '</script>';
	} 
}

?>
