<?php
session_start();

if(isset($_POST['send_specievegetale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $nomelat=$_POST['nomelat'];
  $nomeita=$_POST['nomeita'];
  $classe=$_POST['classe'];
  $wiki=$_POST['wiki'];
  $vulnerabilita=$_POST['vulnerabilita'];
  $anno=$_POST['anno'];
  $lunghezza=$_POST['lunghezza'];
  $diametro=$_POST['diametro'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovaSpecieVegetale('$timestamp','$nome','$nomelat','$nomeita','$classe','$wiki','$vulnerabilita','$anno','$lunghezza','$diametro')";

if(mysqli_query($db,$sql)) {
  $message = "ANDATA";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>