<?php

session_start();

if(isset($_POST['send_proposta'])){
	$nome=$_SESSION['nome'];
	$avvistamento=$_POST['avvistamento'];
	$commento=$_POST['commento'];
	$nomeLatino=$_POST['nomeLatino'];

	echo $nome;
	echo $avvistamento;
	echo $commento;
	echo $nomeLatino;
	
$db=mysqli_connect('localhost','root','Nico1998','progetto')or die("Impossibile connetersi al server, controlla la configurazione");

$sql = "CALL creaNuovaProposta('$avvistamento','$commento','$nome','$nomeLatino')";


if(mysqli_query($db,$sql)){
	$message= "ANDATA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		$message2 = "ERRORE, CONTROLLA DI NUOVO IL CODICE";
		echo "<script type='text/javascript'>alert($message2);</script>";
	};
}

?>