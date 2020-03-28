<?php

session_start();

try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     if($_POST){
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'nome'=>$_SESSION['nome'],'avvistamento'=>$_POST['avvistamento'], 'commento'=>$_POST['commento'], 'Nomelatino'=>$_POST['nomeLatino'], 'password'=>$_POST['password'],'azione' => 'Nuova proposta classificazione'];
     $bulk->insert($doc);
     $mng->executeBulkWrite('Naturae.nat', $bulk);
   }
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice  errore".$e->getMessage()."<br>");
	}

if(isset($_POST['send_proposta'])){
	$nome=$_SESSION['nome'];
	$avvistamento=$_POST['avvistamento'];
	$commento=$_POST['commento'];
	$nomeLatino=$_POST['nomeLatino'];

$db=mysqli_connect('localhost','root','Nico1998','progetto')or die("Impossibile connetersi al server, controlla la configurazione");

$sql = "CALL creaNuovaProposta('$avvistamento','$commento','$nome','$nomeLatino')";


if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("PROPOSTA INSERITA!!"); location.href="propostaclassificazione.html"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("PROPOSTA NON INSERITA!"); location.href="propostaclassificazione.html"';
        echo '</script>';
      };
}

?>
