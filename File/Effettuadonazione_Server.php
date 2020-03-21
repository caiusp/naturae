<?php
session_start();

if(isset($_POST['send_donazione'])) {
  $nome=$_SESSION['nome'];
  $campagna=$_POST['campagna'];
  $importo=$_POST['importo'];
  $note=$_POST['note'];
  
$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovaDonazione('$nome','$campagna','$importo','$note')";

if(mysqli_query($db,$sql)) {
  $message = "ANDATA";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "NON E' ANDATA";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}
 ?>