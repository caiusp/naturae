<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
     $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'nome'=>$_SESSION['nome'], 'data'=>$_POST['data'], 'latitudine'=>$_POST['latitudine'], 'longitudine'=>$_POST['longitudine'], 'foto'=>$_POST['foto'], 'habitat'=>$_POST['habitat'], 'azione' => 'Nuovo avvistamento'];
     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}


if(isset($_POST['send_avvistamento'])) {
  $nome=$_SESSION['nome'];
  $data=$_POST['data'];
  $latitudine=$_POST['latitudine'];
  $longitudine=$_POST['longitudine'];
  $foto=$_POST['foto'];
  $habitat=$_POST['habitat'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL creaNuovoAvvistamento('$nome','$data','$latitudine','$longitudine','$foto','$habitat')";

if(mysqli_query($db,$sql)) {
      echo '<script language="javascript">';
      echo 'alert("AVVISTAMENTO INSERITO"); location.href="avvistamento.php"';
      echo '</script>';
} else {
  $message2 = "";
      echo '<script language="javascript">';
      echo 'alert("ERRORE: controlla i valori inseriti"); location.href="avvistamento.php"';
      echo '</script>';
      };
}
 ?>
