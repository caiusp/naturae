<?php

session_start();

if(isset($_POST['send_proposta'])){
	$nome=$_SESSION['nome'];
	$data=$_POST['data'];
	$codiceAvvistamento =$_POST['avvistamento'];
	$commento=$_POST['commento'];
	$nomeLatino=$_POST['nomeLatino'];

echo "input ricevuto correttamente su proposta.php";

$db=mysqli_connect('localhost','root','Nico1998','progetto')or die("Impossibile connetersi al server, controlla la configurazione");

//$sql="CALL creaNuovaProposta($data,$commento,$nome,$nomeLatino)";
$sql = "INSERT INTO propostaclassificazione(data,commento,nome,nomeLatino) VALUES($data,$commento,$nome,$nomeLatino)";


if(mysqli_query($db,$sql)){
	$message= "ANDATA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		$message2 = "NON E' ANDATA, CONTROLLA DI NUOVO IL CODICE";
		echo "<script type='text/javascript'>alert($message2);</script>";
	};
}

?>