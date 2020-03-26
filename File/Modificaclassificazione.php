<?php
session_start();

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
if($_SESSION['tipoUtente']!="AMMINISTRATORE") {
  echo "NON TI E' POSSIBILE ACCEDERE A QUESTA PAGINA";
  header("location: Profilo.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modifica classificazione da utente amm</title>
    <link rel="stylesheet" type="text/css" href="css/Modificaclassificazione.css">
  </head>
  <body>

      <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>



<div id="contenitore">

  <h1>Modifica classificazione</h1><br>



      <form class="" action="Modificaclassificazione_Server.php" method="post">

      <label>Codice avvistamento: </label> <br> <input type="number" name="codiceA" ><br>
      <label>Nome latino: </label> <br> <input type="text" name="nomeLat" ><br>

      <input type="submit" name="send_edit" value="Invia">

      </form>



</div>




  </body>
</html>
