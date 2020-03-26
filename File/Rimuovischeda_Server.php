<?php
session_start();

if(isset($_POST['rimuovi_animale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $schedaanimale=$_POST['schedaanimale'];

  
$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL rimuoviSpecieAnimale('$timestamp','$nome','$schedaanimale')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE ANIMALE RIMOSSA!!"); location.href="rimuovischeda.php"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE ANIMALE NON RIMOSSA!"); location.href="rimuovischeda.php"';
        echo '</script>';
      };
};

if(isset($_POST['rimuovi_vegetale'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $schedavegetale=$_POST['schedavegetale'];

 //siamo già connessi al db in questa pagina, non credo serva fare altre 2 connessioni 
//$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL rimuoviSpecieVegetale('$timestamp','$nome','$schedavegetale')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE VEGETALE RIMOSSA!!"); location.href="rimuovischeda.php"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("SPECIE VEGETALE NON RIMOSSA!"); location.href="rimuovischeda.php"';
        echo '</script>';
      };
};

if(isset($_POST['rimuovi_habitat'])) {
  $timestamp=date("Y-m-d H:i:s");
  $nome=$_SESSION['nome'];
  $schedahabitat=$_POST['schedahabitat'];

  
//$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL rimuoviHabitat('$timestamp','$nome','$schedahabitat')";

if(mysqli_query($db,$sql)) {
          
        echo '<script language="javascript">';
        echo 'alert("HABITAT RIMOSSO!!"); location.href="rimuovischeda.php"';
        echo '</script>';
} else {
          
        echo '<script language="javascript">';
        echo 'alert("HABITAT NON RIMOSSO!"); location.href="rimuovischeda.php"';
        echo '</script>';
      };
}
 ?>