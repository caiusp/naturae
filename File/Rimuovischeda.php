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
    <title>Rimuovi scheda</title>
    <link rel="stylesheet" type="text/css" href="css/Rimuovischeda.css">

  </head>
  <body>



    <div class="col1">
      <div class="top">
        <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>


      </div>

      <div class="contenitore1">
        <form class="" action="Rimuovischeda_Server.php" method="post">
          <h1>Scheda animale: </h1><br><br>
          <label>Inserisci il nome latino corretto della scheda animale da eliminare: </label><br><input name="schedaanimale" placeholder= "Hystrix cristata"><br>

          <input type="submit" name="rimuovi_animale" value="Invio">


        </form>




      </div>

    </div>
    <div class="col2">
      <div class="contenitore2">
        <form class="" action="Rimuovischeda_Server.php" method="post">
          <h1>Scheda vegetale: </h1><br><br>
          <label>Inserisci il nome latino corretto della scheda vegetale da eliminare: </label><br><input name="schedavegetale" placeholder= "Galanthus nivalis"><br>

          <input type="submit" name="rimuovi_vegetale" value="Invio">


        </form>




      </div>


    </div>
    <div class="col3">
      <div class="contenitore3">
        <form class="" action="Rimuovischeda_Server.php" method="post">
          <h1>Scheda habitat: </h1><br><br>
          <label>Inserisci il nome corretto dell'habitat da eliminare: </label><br><input type="text" name="schedahabitat" placeholder="Laguna"><br>

          <input type="submit" name="rimuovi_habitat" value="Invio">


        </form>




      </div>

    </div>


  </body>
</html>
