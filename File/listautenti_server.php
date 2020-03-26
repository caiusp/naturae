<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Utenti</title>
    <link rel="stylesheet" type="text/css" href="css/listautenti.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    <div id="contenitore">
      <h1>Lista degli utenti iscritti</h1><br>
      <form class="" action="listautenti_server.php" method="post">
        
      <?php
      
        $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

        $result=mysqli_query($db,"SELECT nome,professione,annoNascita,tipoUtente FROM utente");
        // echo "<select name=''>";
        // while($riga=mysqli_fetch_array($result)){
        // echo "<option>".$riga["nome"]."</option>";
        // }
        // echo "</select>";
        //get results from database
        $tabellautenti = array();  //declare an array for saving habitat from the db

        //showing property
        echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
        while ($info = mysqli_fetch_field($result)) {
          echo '<td>' . $info->name . '</td>';  //get field name for header
          array_push($tabellautenti, $info->name);  //save those to array
        }
        echo '</tr>'; //end tr tag

        //showing all data
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($tabellautenti as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
              }
              echo '</tr>';
            }
        echo "</table>";

      ?>  


      </form>
      </div>


  </body>
</html>
