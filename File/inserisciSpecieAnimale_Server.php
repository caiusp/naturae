<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
       $doc = ['_id' => new MongoDB\BSON\ObjectID(),'nome'=>$_SESSION['nome'], 'timestamp'=>$_POST['timestamp'], 'nomeLatino'=>$_POST['nomelat'], 'nomeItaliano'=>$_POST['nomeita'], 'classe'=>$_POST['classe'], 'wikipedia'=>$_POST['wiki'], 'vulnerabilita'=>$_POST['vulnerabilita'], 'anno'=>$_POST['anno'], 'peso'=>$_POST['peso'], 'altezza'=>$_POST['altezza'], 'prole'=>$_POST['prole'], 'azione' => 'Nuova specie animale'];

     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}

if(isset($_POST['send_specieanimale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $nomelat=$_POST['nomelat'];
  $nomeita=$_POST['nomeita'];
  $classe=$_POST['classe'];
  $wiki=$_POST['wiki'];
  $vulnerabilita=$_POST['vulnerabilita'];
  $anno=$_POST['anno'];
  $peso=$_POST['peso'];
  $altezza=$_POST['altezza'];
  $prole=$_POST['prole'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovaSpecieAnimale('$timestamp','$nome','$nomelat','$nomeita','$classe','$wiki','$vulnerabilita','$anno','$peso','$altezza','$prole')";

if(mysqli_query($db,$sql)) {
        
        echo '<script language="javascript">';
        echo 'alert("SPECIE ANIMALE INSERITA!"); location.href="inseriscispecieanimale.php"';
        echo '</script>';
} else {
        
        echo '<script language="javascript">';
        echo 'alert("NON INSERITA!"); location.href="inseriscispecieanimale.php"';
        echo '</script>';
      };
}
 ?>
