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
          
        echo '<script language="javascript">';
        echo 'alert("MESSAGGIO INVIATO!!"); location.href="messaggio.html"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("MESSAGGIO NON INVIATO!"); location.href="messaggio.html"';
        echo '</script>';
      };
}
 ?>