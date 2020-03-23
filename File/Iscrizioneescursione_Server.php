<?php
session_start();

if(isset($_POST['send_escursione'])) {
  $id=$_POST['id'];
  $nome=$_SESSION['nome'];
 

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL iscrizioneEscursione('$id','$nome')";

if(mysqli_query($db,$sql)) {
  $message = "ISCRIZIONE ESEGUITA!";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>