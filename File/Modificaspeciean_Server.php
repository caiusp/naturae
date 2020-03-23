<?php
session_start();

if(isset($_POST['send_specieanimale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $nomelat=$_POST['nomelat'];
  $peso=$_POST['peso'];
  $altezza=$_POST['altezza'];
  $prole=$_POST['prole'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL aggiornaSpecieAnimale('$timestamp','$nome','$nomelat','$peso','$altezza','$prole')";

if(mysqli_query($db,$sql)) {
  $message = "SPECIE ANIMALE AGGIORNATA CON SUCCESSO!";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>