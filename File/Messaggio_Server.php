<?php
session_start();

if(isset($_POST['send_messaggio'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $destinatario=$_POST['destinatario'];
  $titolo=$_POST['titolo'];
  $testo=$_POST['testo'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovoMessaggio('$timestamp','$nome','$destinatario','$titolo','$testo')";

if(mysqli_query($db,$sql)) {
  $message = "ANDATA";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>