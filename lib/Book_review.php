<html>
<title>Library Management System | Book Review </title>
<head>

<script language="javascript">

function fun_cancel()
{
       document.review_form.action="book_info.php";
}

</script>

<style type="text/css">

<!--
.cell {
	text-align: left;

	color: #0080C0;
	font-weight:bold;
	
}
.cell_1 {
	text-align: left;

	color: #FD722F;
	font-weight:bold;
	
}
-->
</style>
</head>
<body>

<?php include ("header.php");

if(isset($_POST['book_id']) && isset($_SESSION['id']))
{
			$book_id=$_POST['book_id'];
			$book_title=$_POST['book_title']; 
			$author=$_POST['author'];
	
	$sql="select * from review_mast where lib_reg_no='".$_SESSION['id']."' and accno='$book_id'";
	$rs=odbc_exec($conn,$sql);
	$review_id=odbc_result($rs,"review_id");
	
	

?>

	<div align="left" class="div">
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>

		<br>
	<form name="review_form" action="review_write.php" method="POST" >
		<center><span class="h">Library Info System | Book Review</span>
		<hr>
		<table width="90%" border="0" >
			<tr>
				<td width="22%" align="right" >Book Accession No.:</td>
				<td width="28%"  class="cell" ><?php echo $book_id ?></td>
				<td>&nbsp;</td>
				<td width="18%" align="right">Book Name :</td>
				<td width="28%"  class="cell"><?php echo $book_title ?></td>
			</tr>
		</table>
		<hr>
		<span style="color:red; text-align: left;">Your review here....!</span>
		<input type="hidden" name="accno" value="<?php echo $book_id ?>">

<?php 	if($review_id)
		{	echo "<span style='color:green; text-align: left;'>Already reviewed by you</span>";
			$file="bookreview/".$review_id;
			$fh = fopen($file, "r") or die("Could not open file!"); 
			$data = fread($fh, filesize($file)) or die("Could not read file!"); 
			fclose($fh); 
			echo "<textarea name='reviewtxt' id='reviewtxt' cols='150' rows='20'  class='cl_box'>$data</textarea>";
		}
		else
		{	echo "<textarea name='reviewtxt' id='reviewtxt' cols='150' rows='20'  class='cl_box'></textarea>";
		}
?>		
		<hr>
		<table width="50%" border="0">
			<tr><td><input type="submit" name="submit" value="  Save  " /></td>
				<td align="right"><input type='submit' name='submit' value='Cancel' onclick="fun_cancel()"></td>
			</tr>	
		</table>
	    <hr>
	</form>	
	</div>
		
<?php
	
}	
else
{
	echo "<script>javascript:alert('You have not selected any Book ......')</script>";
	echo "<script>window.location.href='book_list.php'</script>";
}
?>


</body>
</html>