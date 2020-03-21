<?php if(count($errors)>0): ?>

	<div>

		<?php foreach($errors as $error) : ?>
			<p><?php echo $error ?></p>

		<?php endforeach ?>
	</div>
	<?php endif ?>

//index

	<?php 

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

if(isset($_POST['nome'])) {
  $uname=$_POST['nome'];
  $password=$_POST['password'];

  $sql="SELECT * FROM UTENTE WHERE nome='".$uname."'AND password='".$password."' LIMIT 1";

  $result=mysqli_query($db,$sql);

  if(mysqli_num_rows($result)==1){
    echo " Adesso sei loggato";
    exit();
  }
  else {
    echo " Nome o password sbagliati";
  }
}
?> 