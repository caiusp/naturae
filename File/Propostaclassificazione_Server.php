<?php

session_start();

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