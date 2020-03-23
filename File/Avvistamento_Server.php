<?php
session_start();

if(isset($_POST['send_avvistamento'])) {
  $nome=$_SESSION['nome'];
  $data=$_POST['data'];
  $latitudine=$_POST['latitudine'];
  $longitudine=$_POST['longitudine'];
  $foto=$_POST['foto'];
  $habitat=$_POST['habitat'];

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

$sql="CALL creaNuovoAvvistamento('$nome','$data','$latitudine','$longitudine','$foto','$habitat')";

if(mysqli_query($db,$sql)) {
  $message = "AVVISTAMENTO INSERITO!";
  echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message2 = "ERRORE: controlla i valori inseriti";
  echo "<script type='text/javascript'>alert('$message2');</script>";
      };
}

//get results from database
$result = mysqli_query($db,"SELECT nome FROM habitat");
$all_habitat = array();  //declare an array for saving habitat from the db

//showing property
echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
while ($habitat = mysqli_fetch_field($result)) {
    //echo '<td>' . $habitat->name . '</td>';  //get field name for header
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


 ?>