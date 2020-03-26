<?php
session_start();

if(isset($_POST['send_campagna'])) {
  $nome=$_SESSION['nome'];
  $data=$_POST['data'];
  $descrizione=$_POST['descrizione'];
  $importo=$_POST['importo'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL creaNuovaCampagna('$importo','$descrizione','$data','$nome')";

if(mysqli_query($db,$sql)) {
  		
  		echo '<script language="javascript">';
        echo 'alert("INSERITA CON SUCCESSO!"); location.href="campagna.php"';
        echo '</script>';
} else {
  		
  		echo '<script language="javascript">';
        echo 'alert("Qualcosa è andato storto, riprova!!"); location.href="campagna.php"';
        echo '</script>';
      };
}
 ?>