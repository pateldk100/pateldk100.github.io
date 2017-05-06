<?php
include("header.php");

if ($_POST['reviewtxt'] != '') 
{ 
	$fo="BookReview/";
	$book_id=$_POST['accno'];

	$file=$book_id.$_SESSION['id'];           
	$filename=$fo.$file;

	$id=$_SESSION['id'];
	//$dt=date('Y-m-d');

	$sql2="select * from review_mast where lib_reg_no='$id' and accno='$book_id'";
	$rs=odbc_exec($conn,$sql2);
	$review_id=odbc_result($rs,"review_id");

	if($review_id)
	{
		$newdata = $_POST['reviewtxt'];
		$fw = fopen($filename, 'w') or die('Could not open file!'); 
		$fb = fwrite($fw,stripslashes($newdata)) or die('Could not write to file'); 
		fclose($fw); 
		
		$sql="update review_mast set review_date=date() where lib_reg_no='$id' and accno='$book_id'";
		$rs=odbc_exec($conn,$sql) or die ("Sorry! Unable to update.........");
		echo "<script>javascript:alert('Review updated successfully..............');</script>";
	}
	else
	{	
		$content = $_POST['reviewtxt'];  
		$strlength = strlen($content); 
		$create = fopen($filename, "w"); 
		$write = fwrite($create, $content, $strlength); 
		$close = fclose($create); 

		$sql2="select name, design, class, sec from reader_mast where lib_reg_no='$id'";
		$rs2=odbc_exec($conn,$sql2) or die ("Sorry! Unable to save.........");
		$rec2=odbc_fetch_array($rs2);
		$name=$rec2['name'];
		$design_class=$rec2['design'].$rec2['class']." ".$rec2['sec'];
		
		$sql="insert into review_mast(accno, lib_reg_no, name, design_class, review_id, review_date)
				values('$book_id','$id', '$name', '$design_class', '$file', date())";
		$rs=odbc_exec($conn,$sql) or die ("Sorry! Unable to save review.........");
		
		if($rs)
			echo "<script>javascript:alert('Review saved successfully..............');</script>";
		else
			echo "<script>javascript:alert('Error.....while saving');</script>";
		
		
	}
	echo "<script>window.location.href='book_list.php'</script>";
}
?>

	
	


