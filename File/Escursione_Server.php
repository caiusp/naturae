<?php
session_start();

if(isset($_POST['send_escursione'])) {
  $nome=$_SESSION['nome'];
  $titolo=$_POST['titolo'];
  $data=$_POST['data'];
  $orarioP=$_POST['orarioP'];
  $orarioR=$_POST['orarioR'];
  $tragitto=$_POST['tragitto'];
  $descrizione=$_POST['descrizione'];
  $nrpart=$_POST['nrpart'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL creaNuovaEscursione('$titolo','$nrpart','$descrizione','$tragitto','$data','$orarioP','$orarioR','$nome')";

if(mysqli_query($db,$sql)) {
  $message = "ANDATA";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>