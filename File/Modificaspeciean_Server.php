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
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE ANIMALE INSERITA!!"); location.href="modificaspeciean.html"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE ANIMALE NON INSERITA!"); location.href="modificaspeciean.html"';
        echo '</script>';
      };
}
 ?>