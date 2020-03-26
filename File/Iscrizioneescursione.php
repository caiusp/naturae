  <?php

  session_start();
 
  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Iscrizione escursione</title>
      <link rel="stylesheet" type="text/css" href="css/Iscrizioneescursione.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    
    <div id="contenitoreEsc">
      <h1> LISTA ESCURSIONI ATTIVE  </h1><br>

        <form class="" action="Iscrizioneescursione_Server.php" method="post">

        <?php
          
          $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
          //get results from database
          $result = mysqli_query($db,"SELECT * FROM escursione WHERE stato='APERTO'");
          $tabellaescursione = array();  //declare an array for saving habitat from the db

          //showing property
          echo '<table class="data-table">
          <tr class="data-heading">';  //initialize table tag
          while ($info = mysqli_fetch_field($result)) {
            echo '<td>' . $info->name . '</td>';  //get field name for header
            array_push($tabellaescursione, $info->name);  //save those to array
          }
          echo '</tr>'; //end tr tag

          //showing all data
          while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            foreach ($tabellaescursione as $item) {
              echo '<td>' . $row[$item] . '</td>'; //get items using property value
                }
                echo '</tr>';
              }
          echo "</table>";

          echo "<h1> ISCRIVITI ALL'ESCURSIONE!  </h1><br>";

          $results=mysqli_query($db,"SELECT id FROM escursione WHERE stato='APERTO'");
          echo "Seleziona l'escursione a cui sei interessato:";
          echo "<select name='id'>";
            while($riga=mysqli_fetch_array($results)){
              echo "<option>".$riga["id"]."</option>";
            }
          echo "</select>";
      ?>

      
      <input type="submit" name="send_escursione" value="Invia">
    </form>
  </div>

  </body>
  </html>
