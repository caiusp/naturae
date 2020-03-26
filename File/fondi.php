<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Effettua donazione</title>
  <link rel="stylesheet" type="text/css" href="css/Effettuadonazione.css">

</head>
<body>
  <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>


  <div id="contenitore">
    <h1>Effettua la tua donazione! </h1><br>
    <form class="" action="Effettuadonazione_Server.php" method="post">

<?php
$host    = "localhost";
$user    = "root";
$pass    = "Nico1998";
$db_name = "progetto";

//create connection
$connection = mysqli_connect($host, $user, $pass, $db_name);

//test if connection failed
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");
}

//get results from database
$result = mysqli_query($connection,"SELECT * FROM campagnafondi");
$all_habitat = array();  //declare an array for saving habitat from the db

//showing property
echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
while ($habitat = mysqli_fetch_field($result)) {
    echo '<td>' . $habitat->name . '</td>';  //get field name for header
    array_push($all_habitat, $habitat->name);  //save those to array
}
echo '</tr>'; //end tr tag

//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_habitat as $item) {
        echo '<td>' . $row[$item] . '</td>'; //get items using property value
    }
    echo '</tr>';
}
echo "</table>";

$result=mysqli_query($connection,"SELECT nrProgr FROM campagnafondi");
//echo "seleziona campagna fondi";

echo "Seleziona la campagna a cui sei interessato:";
echo "<select name='campagna'>";
while($riga=mysqli_fetch_array($result)){
echo "<option>".$riga["nrProgr"]."</option>";
}
echo "</select>";

?>

    



    <label>Importo:</label><input type="number" name="importo"><label> €</label><br>
    <label for="note">Note: </label><br>
    <textarea name="note" rows="8" cols="50" maxlength="50"></textarea><br>



    <input type="submit" name="send_donazione" value="Invia">
  </form>
</div>

</body>
</html>
