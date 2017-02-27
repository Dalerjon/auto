<?php
$uploaddir = './uploads/'; 
$file = $uploaddir .mb_strtolower(($_FILES['uploadfile']['name'])); 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}
?>