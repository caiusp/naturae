<?php
session_start();

if(isset($_POST['send_specieanimale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $nomelat=$_POST['nomelat'];
  $nomeita=$_POST['nomeita'];
  $classe=$_POST['classe'];
  $wiki=$_POST['wiki'];
  $vulnerabilita=$_POST['vulnerabilita'];
  $anno=$_POST['anno'];
  $peso=$_POST['peso'];
  $altezza=$_POST['altezza'];
  $prole=$_POST['prole'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovaSpecieAnimale('$timestamp','$nome','$nomelat','$nomeita','$classe','$wiki','$vulnerabilita','$anno','$peso','$altezza','$prole')";

if(mysqli_query($db,$sql)) {
  $message = "ANDATA";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>