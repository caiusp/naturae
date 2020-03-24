<?php

session_start();

if(isset($_POST['send_aggiorna'])){
	$nome=$_SESSION['nome'];
	$email=$_POST['email'];
	$professione=$_POST['professione'];

$db=mysqli_connect('localhost','root','Nico1998','progetto')or die("Impossibile connetersi al server, controlla la configurazione");

$sql = "CALL aggiornaProfilo('$nome','$email','$professione')";


if(mysqli_query($db,$sql)){
	$message= "PROFILO AGGIORNATO!";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		$message2 = "ERRORE, CONTROLLA I DATI INSERITI";
		echo "<script type='text/javascript'>alert($message2);</script>";
	};
}

?>