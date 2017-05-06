<?php 
include('test01.txt');

$filename = "test01.txt";     //or $_GET['file_name'];
   
$newdata = $_POST['newd']; 

if ($newdata != '') { 

 
$fw = fopen($filename, 'w') or die('Could not open file!'); 

$fb = fwrite($fw,stripslashes($newdata)) or die('Could not write  
to file'); 

fclose($fw); 
} 

/*
  $fh = fopen($filename, "r") or die("Could not open file!"); 

  $data = fread($fh, filesize($filename)) or die("Could not read file!"); 

  fclose($fh); 

*/

?>

<h3>Contents of File</h3> 
<form action='' method= 'post' > 
<textarea name='newd' cols='100%' rows='50'> <?php include('test01.txt'); ?></textarea> 
<input type='submit' value='Change'> 
</form> 


