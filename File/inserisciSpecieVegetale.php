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
    <title>Scheda specie vegetale</title>
    <link rel="stylesheet" type="text/css" href="css/Specievegetale.css">

  </head>
    <body>
          <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
  </body>
  <div id="dati">

  <h1>Crea una nuova scheda per una specie vegetale</h1><br>

    <form class="" action="inserisciSpecieVegetale_Server.php" method="post">

    <label>Nome latino: </label><br><input type="text" name="nomelat" placeholder="Marsilea quadrifolia"><br>
    <label>Nome italiano: </label><br><input type="text" name="nomeita" placeholder="Trifoglio acquatico comune"><br>
    <label>Classe: </label><br><input type="text" name="classe" placeholder="Polypodiopsida"><br>
    <label>Wikipedia: </label><br><input type="url" name="wiki" placeholder="https://it.wikipedia.org/wiki/Marsilea_quadrifolia"><br>
    <label>Vulnerabilità: </label><br><input type="text" name="vulnerabilita" placeholder="Critico"><br>
    <label>Anno: </label><br><input type="number" name="anno" placeholder="1800"><br>
    <label>Lunghezza: </label><br><input type="number" name="lunghezza" placeholder="30"><br>
    <label>Diametro: </label><br><input type="number" name="diametro" placeholder="40"><br><br>

    <input type="submit" name="send_specievegetale" value="Invia">

    </form>
  </div>

</html>
