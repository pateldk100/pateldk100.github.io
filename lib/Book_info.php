<html>
<title>Library Management System | Book Info </title>
<head>
<script language="javascript">

function fun_cancel(){
        document.myform.action="book_list.php";

}
</script>

<link href="style.css" rel="stylesheet" type="text/css">
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
//include ("validate_form.inc");

if(isset($_POST['back']))
	$back=$_POST['back'];

if(isset($_POST['book_id']) && isset($_SESSION['id']))
{
	$book_id=$_POST['book_id'];
			$v_accno="";
			$v_purchase_date=""; 
			$v_classification="";
			$v_book_title=""; 
			$v_author="";
			$v_publisher="";
			$v_pages="";
			$v_print_price=""; 
			$v_locno="";
			$v_selfno="";
			
			$v_book_holder_id="";
			$v_issue_date="";
			$v_last_date="";
	
			$v_name="";
			$v_fname="";
			$v_add="";

	
		$sql="SELECT b.accno, b.purchase_date, b.classification, b.book_title, b.author, b.publisher, b.pages, b.print_price, l.locno, l.shelfno
			  FROM book_mast b, Location_Mast l
			  WHERE b.accno='$book_id' and b.accno=l.accno and Condeman<>1";

		$rs=odbc_exec($conn,$sql);	
		while($rec=odbc_fetch_array($rs))
		{
			$v_accno=$rec['accno'];
			$v_purchase_date=$rec['purchase_date']; 
			$v_classification=$rec['classification'];
			$v_book_title=$rec['book_title']; 
			$v_author=$rec['author'];
			$v_publisher=$rec['publisher'];
			$v_pages=$rec['pages'];
			$v_print_price=$rec['print_price']; 
			$v_locno=$rec['locno'];
			$v_shelfno=$rec['shelfno'];
		}
		
		$sql2="SELECT  lib_reg_no, issue_date, last_date FROM issue_mast
			  WHERE AccNo='$book_id' and issued=1 and returned=0";
		$rs2=odbc_exec($conn,$sql2);	
		$rec2=odbc_fetch_array($rs2);
		$v_book_holder_id=$rec2['lib_reg_no'];
			
		
			if(strlen($v_book_holder_id)>0)
			{
				$v_issue_date=$rec2['issue_date'];
				$v_last_date=$rec2['last_date'];

			  	$sql3="SELECT  * FROM reader_mast WHERE lib_reg_no='$v_book_holder_id'";
				$rs3=odbc_exec($conn,$sql3);	
					
				$v_name=odbc_result($rs3,"Name");
				$v_design=odbc_result($rs3,"design");
				$v_class=odbc_result($rs3,"class");
				$v_sec=odbc_result($rs3,"sec");
				$v_fname=odbc_result($rs3,"f_name");
				$v_add=odbc_result($rs3,"add1");
			}

?>

	

	<div align="left" class="div">
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>

<br><form name="myform" action="book_review.php" method="POST">
<input type="hidden" name="back" value="book_info.php"/>
	<center><span class="h">Library Info System | Book Information</span>
	<hr>
		<input type="hidden" name="book_id" value="<?php echo $v_accno ?>" >
		<input type="hidden" name="book_title" value="<?php echo $v_book_title ?>" >
		<input type="hidden" name="author" value="<?php echo $v_author ?>" >
		
		<table width="100%" border="0" cellspacing="12" cellpadding="12">
		<tr>
			<td width="18%" align="right" >Book Accession No.:</td>
			<td width="28%"  class="cell" ><?php echo $v_accno?></td>
			<td width="18%" align="right">Purchase Date :</td>
			<td width="28%"  class="cell"><?php echo date("d-M-Y",strtotime( $v_purchase_date)) ?></td>
		</tr>
		<tr>
			<td width="18%" align="right">Classification :</td>
			<td width="28%"  class="cell"><?php echo $v_classification?></td>
			<td width="18%" align="right">Book Title :</td>
			<td width="34%"  class="cell"><?php echo $v_book_title?></td>
		</tr>
		<tr>
			<td width="18%" align="right">Author :</td>
			<td width="28%"  class="cell"><?php echo $v_author?></td>
			<td width="18%" align="right">Publisher :</td>
			<td width="28%"  class="cell"><?php echo $v_publisher?></td>
		</tr>
		<tr>
			<td width="18%" align="right">Pages :</td>
			<td width="28%" class="cell"><?php echo $v_pages?></td>
			<td width="18%" align="right">Print Price :</td>
			<td width="28%" class="cell"><?php echo $v_print_price?></td>
		</tr>
		
<?php
	if($v_book_holder_id)
	{	 
?>
		<tr>
			<td width="18%" align="right">Issued to :</td>
			<td width="28%" class="cell_1"><?php echo $v_name." [ ".$v_design.$v_class." ".$v_sec." ]" ?></td>
			<td width="18%" align="right">Father's Name & Address :</td>
			<td width="34%"  class="cell_1"><?php echo $v_fname ?>
					<table width="100%">
						<tr><td class="cell_1"><?php echo $v_add ?></td></tr>
					</table>	</td>
		</tr>
		<tr>
			<td width="18%" align="right">Issing Date :</td>
			<td width="28%" class="cell_1"><?php echo date("d-m-Y",strtotime( $v_issue_date)) ?></td>
			<td width="18%" align="right">Returning Date :</td>
			<td width="28%" class="cell_1"><?php echo date("d-M-Y",strtotime($v_last_date)) ?></td>
	
		</tr>
<?php
	}
	else	
	{ 
?>
		<tr>
			<td width="18%" align="right">Book Location :</td>
			<td width="28%" rowspan="3" class="cell_1">Almirah no.&nbsp;&nbsp; <?php echo $v_locno?>,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Self no.&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v_shelfno?></td></tr>
		</tr>	
	
<?php
	}


} 
else
{
	//echo "<script>javascript:alert('You have not selected any Book ......')</script>";
	echo "<script>window.location.href='book_list.php'</script>";
}//end of first if
?>	

</table>
<hr>
<table width="50%" border="0">
	<tr><td><input type="submit" name="submit" value="Book Review"></td>
		<td align="right"><input type="submit" name="submit" id="submit" value="   Cancel   " onclick="fun_cancel()"></td>
	</tr>	
</table>
<hr>	
</form>	
</div>

</body>