<?php

session_start();

if(isset($_POST['send_aggiorna'])){
	$nome=$_SESSION['nome'];
	$email=$_POST['email'];
	$professione=$_POST['professione'];

$db=mysqli_connect('localhost','root','Nico1998','progetto')or die("Impossibile connetersi al server, controlla la configurazione");

$sql = "CALL aggiornaProfilo('$nome','$email','$professione')";


if(mysqli_query($db,$sql)){
	
        echo '<script language="javascript">';
        echo 'alert("PROFILO AGGIORNATO!"); location.href="aggiornaProfilo.html"';
        echo '</script>';

	} else {

		echo '<script language="javascript">';
        echo 'alert("ERRORE, CONTROLLA I DATI INSERITI"); location.href="aggiornaProfilo.html"';
        echo '</script>';
	};
}

?>