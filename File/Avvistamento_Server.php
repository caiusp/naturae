<?php
session_start();

if(isset($_POST['send_avvistamento'])) {
  $nome=$_SESSION['nome'];
  $data=$_POST['data'];
  $latitudine=$_POST['latitudine'];
  $longitudine=$_POST['longitudine'];
  $foto=$_POST['foto'];
  $habitat=$_POST['habitat'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL creaNuovoAvvistamento('$nome','$data','$latitudine','$longitudine','$foto','$habitat')";

if(mysqli_query($db,$sql)) {
  $message = "AVVISTAMENTO INSERITO!";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "ERRORE: controlla i valori inseriti";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
    
 

    }



 ?>