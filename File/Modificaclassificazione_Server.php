<?php
session_start();

if(isset($_POST['send_edit'])) {
  $codiceA=$_POST['codiceA'];
  $nomeLat=$_POST['nomeLat'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL correggiClassificazione('$codiceA','$nomeLat')";

if(mysqli_query($db,$sql)) {
      echo '<script language="javascript">';
      echo 'alert("CORREZIONE CLASSIFICAZIONE AVVISTAMENTO ESEGUITA"); location.href="Modificaclassificazione.php"';
      echo '</script>';
} else {
  $message2 = "";
      echo '<script language="javascript">';
      echo 'alert("ERRORE: controlla i valori inseriti"); location.href="Modificaclassificazione.php"';
      echo '</script>';
      };
}
?>