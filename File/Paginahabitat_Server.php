<?php
session_start();

if(isset($_POST['send_habitat'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $habitat=$_POST['habitat'];
  $descrizione=$_POST['descrizione'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL nuovoHabitat('$timestamp','$nome','$habitat','$descrizione')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("HABITAT INSERITA!!"); location.href="paginahabitat.php"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("HABITAT NON INSERITO!"); location.href="paginahabitat.php"';
        echo '</script>';
      };
}
 ?>