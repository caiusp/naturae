<?php
session_start();

if(isset($_POST['send_specievegetale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $nomelat=$_POST['nomelat'];
  $lunghezza=$_POST['lunghezza'];
  $diametro=$_POST['diametro'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL aggiornaSpecieVegetale('$timestamp','$nome','$nomelat','$lunghezza','$diametro')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE VEGETALE INSERITA!!"); location.href="modificaspecieveg.html"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE VEGETALE NON INSERITA!"); location.href="modificaspecieveg.html"';
        echo '</script>';
      };
}
 ?>