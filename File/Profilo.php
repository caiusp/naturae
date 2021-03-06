<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profilo</title>
    <link rel="stylesheet" type="text/css" href="css/Profilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body> 
    

     <a href="Logout.php"><button id="btnlogout" value="Logout"> Logout</button></a>
    <!-- The sidebar -->
  <div class="profilo">
        <?php
        if(isset($_SESSION['eseguita'])) ?>
        <div class="error success">
        <h3>
      </h3>
        </div>
      <!--se l'utente logga stampa le sue informazioni-->

      <?php if(isset($_SESSION['nome'])) : ?>

      <h1>Benvenuto <strong><?php echo $_SESSION['nome']; ?>!</strong></h1><br>

    <?php endif ?>

    <table id="info">
      <tr>
        <td rowspan="10"><img src="https://www.alacbrindisi.it/wp-content/uploads/2019/10/icona-dell-utente-di-vettore-7337510.jpg" alt="profiloImmagine" width="300" height="300"></td>
      </tr>
      <tr>
        <td><label for="nome">Nickname: </label></td>
        <td colspan="2"><?php echo $_SESSION['nome']; ?> </td>
      </tr>

      <tr>
        <td><label for="email">Email: </label></td>
        <td colspan="2"><?php echo $_SESSION['email']; ?> </td>

      </tr>
      <tr>
        <td><label for="annoNascita">Anno di nascita: </label></td>
        <td colspan="2"><?php echo $_SESSION['annoNascita']; ?></td>
      </tr>
      <tr>
        <td><label for="professione">Professione: </label></td>
        <td colspan="2"><?php echo $_SESSION['professione']; ?> </td>
      </tr>
      <tr>
        <td><label for="tipoUtente">Tipologia utente:</label></td>
        <td colspan="2"><?php echo $_SESSION['tipoUtente']; ?></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td><label for="classificazione"></label></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td><label for="classificazione"></label></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td><label for="classificazione"></label></td>
        <td colspan="2"></td>

      </tr>

  </table>

  </div>

    <div class="sidebar">

  <a href="Listautenti.php"><i class="fa fa-cloud"></i> Utenti della community</a>
  <a href="listaSpecieVegAn.php"><i class="fa fa-pagelines"></i> Schede vegetali e animali</a>
  <a href="listaSchedeHabitat.php"><i class="fa fa-map-signs"></i> Schede habitat</a>
  <a href="Aggiornaprofilo.html"><i class="fa fa-fw fa-cog"></i> Aggiorna profilo</a>


  <a href="Messaggio.html"><i class="fa fa-fw fa-envelope"></i> Invia messaggio</a>
  <a href="Avvistamento.php"><i class="fa fa-binoculars"></i> Avvistamento</a>
  <a href="ListaAvvistamenti.php"><i class="fa fa-camera"></i> Lista avvistamenti</a>
  <a href="Classificamenuaffidabilita.php"><i class="fa fa-fw fa-sort"></i> Classifica</a>
      <a href="Iscrizioneescursione.php"><i class="fa fa-fw fa-flag"></i> Iscrizione escursione</a>
  <a href="Effettuadonazione.php"><i class="fa fa-money"></i> Effettua donazione</a>
  <a href="Propostaclassificazione.html"><i class="fa fa-fw fa-bullhorn"></i> Proposta classificazione</a><hr>

  <label> <center> <b>Area riservata <br> solo agli utenti premium</b> </center></label><hr>
  <a href="Premiumclassifica.php"><i class="fa fa-user-circle-o"></i> La tua classifica</a>
  <a href="Escursione.php"><i class="fa fa-fw fa-trophy"></i>Crea escursione</a><hr>

  <label> <center> <b>Area riservata <br> solo agli utenti amministratori</b> </center></label><hr>
  <a href="inserisciSpecieVegetale.php"><i class="fa fa-fw fa-cog"></i>Nuova specie vegetale</a>
  <a href="inserisciSpecieAnimale.php"><i class="fa fa-fw fa-search"></i>Nuova specie animale</a>
  <a href="Paginahabitat.php"><i class="fa fa-snowflake-o"></i>  Nuovo habitat</a>
  <a href="Modificaspecieveg.php"><i class="fa fa-tree"></i> Modifica scheda vegetale</a>
  <a href="Modificaspeciean.php"><i class="fa fa-linux"></i> Modifica scheda animale</a>
  <a href="Modificaschedahabitat.php"><i class="fa fa-fw fa-flag"></i>Modifica scheda habitat</a>
  <a href="Modificaclassificazione.php"><i class="fa fa-arrow-up"></i> Modifica classificazione</a>
  <a href="Campagna.php"><i class="fa fa-fw fa-trophy"></i>Apri campagna</a>
  <a href="Rimuovischeda.php"><i class="fa fa-trash"></i> Elimina scheda</a><br>



</div>
    





  </body>
</html>
