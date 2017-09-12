<?php

$info = pathinfo($_FILES['userFile']['name']);
$ext = $info['extension']; // get the extension of the file
$newname = "newname.".$ext; 

echo $info;
echo "<br>";
echo $ext;
echo "<br>";
echo $newname;



$target = $newname;


move_uploaded_file( $_FILES['userFile']['tmp_name'], $target);

?>