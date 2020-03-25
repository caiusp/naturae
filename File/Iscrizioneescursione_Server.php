<?php
session_start();

if(isset($_POST['send_escursione'])) {
  $id=$_POST['id'];
  $nome=$_SESSION['nome'];
 

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL iscrizioneEscursione('$id','$nome')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("ESCURSIONE INSERITA!!"); location.href="iscrizioneescursione.html"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("ESCURSIONE NON INSERITA!"); location.href="iscrizioneescursione.html"';
        echo '</script>';
      };
}
 ?>