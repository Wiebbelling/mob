<?php
	
	$imagem = "images/".$_FILES["upload_file"]["name"];

	echo "Imagem que o usuario enviou: ".$_FILES["upload_file"]["name"];
	echo "<br>Nome da imagem no servidor: ".$_FILES["upload_file"]["tmp_name"];
	echo "<br>Nome da imagem que a gente quer que ela tenha ".$imagem;





  move_uploaded_file($_FILES["upload_file"]["tmp_name"], $imagem);
  



  //echo '<img src="'.$folder."".$_FILES["upload_file"]["name"].'">';

?>