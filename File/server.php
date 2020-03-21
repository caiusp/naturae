<?php 

session_start();

//inizializzazione delle variabili 
$nome = "";
$errors = array();
//connessione al db
$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

//registrazione utente
if(isset($_POST['reg_user'])){
//if (isset($_POST['nome'])) {
$nome = mysqli_real_escape_string($db,$_POST['nome']); //}
//if (isset($_POST['annoNascita'])) {
$annoNascita = mysqli_real_escape_string($db,$_POST['annoNascita']);//}
//if (isset($_POST['professione'])) {
$professione =  mysqli_real_escape_string($db,$_POST['professione']);//}
//if (isset($_POST['email'])) {
$email = mysqli_real_escape_string($db,$_POST['email']);//}
//if (isset($_POST['password'])) {
$password = mysqli_real_escape_string($db,$_POST['password']);//}
//if (isset($_POST['foto'])) {
$foto = mysqli_real_escape_string($db,$_POST['foto']);//}

//form validation 

if(empty($nome)) {array_push($errors, "Il nome è richiesto");}
if(empty($professione)) {array_push($errors, "La professione è richiesta");}
//if(empty($foto)) {array_push($errors, "La foto è richiesta");}
if(empty($annoNascita)) {array_push($errors, "L'anno di nascita è richiesto");}
if(empty($email)) {array_push($errors, "L email è richiesta");}
if(empty($password)) {array_push($errors, "la password è richiesta");}
//controllo di utenti già esistenti
$controllo_utenti_esistenti="SELECT * FROM UTENTE WHERE nome='$nome' LIMIT 1";

$risultati=mysqli_query($db, $controllo_utenti_esistenti); //qua ci inserisce il risultato della query 
$utente=mysqli_fetch_assoc($risultati); //qua estrae i valori

if($utente) { //se $utente è true, quindi se c'è un valore all'interno (non dev'essere vuoto)
	if($utente['nome'] === $nome){echo("Nome utente gia' esistente");} //se c'è un valore controlla che non sia gia utilizzato nome e email
}

if(count($errors)==0) {
	$query="CALL creaNuovoUtenteSemplice('$nome','$annoNascita','$professione','$email','$password','$foto')";
	$message = "La registrazione è avvenuta con successo";
    echo "<script type='text/javascript'>alert('$message');</script>";
/*if(($utente['nome']!=$nome)&&($utente['email']!=$email)) {
	$password=md5($password);
	$query="INSERT INTO UTENTE (nome, email, password) VALUES ('$nome','$email','$password')";
	$query="INSERT INTO UTENTESEMPLICE (nome) VALUES ('$nome')";
*/
	mysqli_query($db,$query);
	$_SESSION['nome']=$nome;
	$_SESSION['eseguita']="Adesso sei connesso";
	
	header('location:../index.php');
}
}

//LOGIN USER
/*
if(isset($_POST['login_user'])) {
	$nome=mysqli_real_escape_string($db,$_POST['nome']);
	$password=mysqli_real_escape_string($db,$_POST['password']);

	if(empty($nome)) {
		array_push($errors,"Nome necessario");
	}
	if(empty($password)) {
		array_push($errors,"Password necessaria");
	}
	if(count($errors)==0) {
		$password=md5($password);
		$query="SELECT * FROM UTENTE WHERE nome = '$nome' AND password = '$password'";
		$risultati=mysqli_query($db,$query);
		$num=mysqli_num_rows($risultati);

		if($num ==1) {
			$_SESSION['nome']=$nome;
			$_SESSION['successo']="Adesso sei connesso";
			header('location:Profilo.html');
		} else{
			array_push($errors, "Nome utente o password sbagliati, riprova");
		}
	} 
}
*/




























?>