<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Menu classifica affidabilità media</title>
    <link rel="stylesheet" type="text/css" href="css/Menuclassifica.css">

  </head>
  <body>
    <div class="sfondo">
      <div class="top">
        <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
      </div>
      <div class="menu">
        <nav>
          <ul>
            <li name="label">Classifica: </li><hr>
            <li><a href="Classificamenuaffidabilita.php">Affidabilità media</a></li><hr>
            <li><a href="Classificamenuspecie.php">Specie</a></li><hr>
            <li><a href="Classificamenuutentiattivi.php">Utenti più attivi</a></li>


          </ul>



        </nav>

      </div>
      <div class="contenitore1">
        <h1>Classifica della specie: </h1><br><br>
        <div class="lista">
                     <?php

     $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

     $result=mysqli_query($db,"SELECT NomeLatino, count(*) as Totale FROM PROPOSTACLASSIFICAZIONE GROUP BY NomeLatino ORDER BY count(*)");
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
        </div>

    </div>



  </body>
</html>
