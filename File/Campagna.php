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
    <title>Campagna</title>
    <link rel="stylesheet" type="text/css" href="css/Campagna.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>

    <div id="contenitore">


    <h1>Crea una nuova campagna</h1><br>

      <form class="" action="Campagna_Server.php" method="post">

      <label>Data inizio: </label><input type="date" name="data" ><br><br>
      <label>  <label>Descrizione: </label><br>
      <textarea name="descrizione" rows="5" cols="40"></textarea><br>
      <label>Importo max: € </label><input type="number" name="importo"><br><br>
      

      </select><br><br>



      <input type="submit" name="send_campagna" value="Invia">

      </form>
    </div>
  </body>
</html>
