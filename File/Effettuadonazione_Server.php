<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'donatore'=>$_SESSION['nome'],'campagna'=>$_POST['campagna'], 'importo'=>$_POST['importo'], 'Note'=>$_POST['note'], 'azione' => 'Nuova donazione'];
     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}


if(isset($_POST['send_donazione'])) {
  $nome=$_SESSION['nome'];
  $campagna=$_POST['campagna'];
  $importo=$_POST['importo'];
  $note=$_POST['note'];
  
$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovaDonazione('$nome','$campagna','$importo','$note')";

if(mysqli_query($db,$sql)) {
  		
  		echo '<script language="javascript">';
        echo 'alert("DONAZIONE EFFETTUATA!"); location.href="fondi.php"';
        echo '</script>';
} else {
    		
  		echo '<script language="javascript">';
        echo 'alert("PROBLEMA DONAZIONE EFFETTUATA!"); location.href="fondi.php"';
        echo '</script>';
      };
}
 ?>
