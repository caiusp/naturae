<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
       $doc = ['_id' => new MongoDB\BSON\ObjectID(),'nome'=>$_SESSION['nome'], 'titolo'=>$_POST['titolo'], 'data'=>$_POST['data'], 'orarioPartenza'=>$_POST['orarioP'], 'orarioRitorno'=>$_POST['orarioR'], 'tragitto'=>$_POST['tragitto'], 'descrizione'=>$_POST['descrizione'], 'numeroPartecipanti'=>$_POST['nrpart'], 'azione' => 'Nuova escursione'];

     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}
  
if(isset($_POST['send_escursione'])) {
  $nome=$_SESSION['nome'];
  $titolo=$_POST['titolo'];
  $data=$_POST['data'];
  $orarioP=$_POST['orarioP'];
  $orarioR=$_POST['orarioR'];
  $tragitto=$_POST['tragitto'];
  $descrizione=$_POST['descrizione'];
  $nrpart=$_POST['nrpart'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL creaNuovaEscursione('$titolo','$nrpart','$descrizione','$tragitto','$data','$orarioP','$orarioR','$nome')";

if(mysqli_query($db,$sql)) {
        
        echo '<script language="javascript">';
        echo 'alert("ESCURSIONE INSERITA!"); location.href="escursione.php"';
        echo '</script>';
} else {
  
        echo '<script language="javascript">';
        echo 'alert("PROBLEMA INSERIMENTO ESCURSIONE!"); location.href="escursione.php"';
        echo '</script>';
      };
}
 ?>
