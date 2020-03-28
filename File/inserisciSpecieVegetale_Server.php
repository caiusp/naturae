<?php
session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
       $doc = ['_id' => new MongoDB\BSON\ObjectID(),'nome'=>$_SESSION['nome'], 'timestamp'=>$_POST['timestamp'], 'nomeLatino'=>$_POST['nomelat'], 'nomeItaliano'=>$_POST['nomeita'], 'classe'=>$_POST['classe'], 'wikipedia'=>$_POST['wiki'], 'vulnerabilita'=>$_POST['vulnerabilita'], 'anno'=>$_POST['anno'], 'lunghezza'=>$_POST['lunghezza'], 'diametro'=>$_POST['diametro'], 'azione' => 'Nuova specie vegetale'];

     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}

if(isset($_POST['send_specievegetale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $nomelat=$_POST['nomelat'];
  $nomeita=$_POST['nomeita'];
  $classe=$_POST['classe'];
  $wiki=$_POST['wiki'];
  $vulnerabilita=$_POST['vulnerabilita'];
  $anno=$_POST['anno'];
  $lunghezza=$_POST['lunghezza'];
  $diametro=$_POST['diametro'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovaSpecieVegetale('$timestamp','$nome','$nomelat','$nomeita','$classe','$wiki','$vulnerabilita','$anno','$lunghezza','$diametro')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE VEGETALE INSERITA!!"); location.href="inseriscispecievegetale.php"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE VEGETALE NON INSERITA!"); location.href="inseriscispecievegetale.php"';
        echo '</script>';
      };
}
 ?>
