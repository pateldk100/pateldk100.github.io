<html>
<title>Library Management System | Search </title><body>
<head>
<script language="javascript">

function fun_cancel(){
        document.book_list_form.action="index.php";

}
function fun_show_reviews(){
        document.book_list_form.action="view_reviews.php";
}
function fun_book_detail(){
        document.book_list_form.action="book_info.php";
}
</script>
<style type="text/css">
<!--
.tbl {
	color: white;
	background-color: #09F;
}
-->
</style>
</head>

<?php include ("header.php");
include ("conn.php");
include("validate_form.inc");
$wcond=" where b.condeman<>1 and b.accno=l.accno ";

if(isset($_POST['txtsrch']) && strlen(trim($_POST['txtsrch']))>0)
	$wcond=$wcond." and (b.book_title like '". trim($_POST['txtsrch'])."%' or b.accno like '". trim($_POST['txtsrch'])."%'
					or b.author like '". trim($_POST['txtsrch'])."%' or b.publisher like '". trim($_POST['txtsrch'])."%'
					or b.edition_year like '". trim($_POST['txtsrch'])."%')";	

?>

<div align="center" class="div">
<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
<br>

<form name="book_list_form" action="" method="POST">

	<table width="100%" border="0" >
  
	<tr><td width="20%" align="center">	Area :
		<select name='classification_combo' size='1' value size='30' >
			<option value=''></option>

  <?php		
		$sql1="SELECT distinct Classification FROM book_mast order by classification";
		$rs1=odbc_exec($conn,$sql1);

		while($rec1=odbc_fetch_array($rs1))
			{ 	$clsf=$rec1['Classification'];
				echo "<option value='".$clsf."'>".$clsf."</option>";
			}
?>
      </select>
	  </td>
	  <td width="30%" align="center"> Author : 
      <select name='author_combo' size='1' value size='30' >
		<option value=''></option>
  <?php
		$sql2="SELECT distinct Author FROM book_mast  order by author";
		$rs2=odbc_exec($conn,$sql2);

		while($rec2=odbc_fetch_array($rs2))
			{ 	$author=$rec2['Author'];
				echo "<option value='".$author."'>".$author."</option>";
			}
?>
      </select>
	  </td>
	  <td width="40%" align="right" >Publisher :
		<select name='publisher_combo' size='1' value size='30' >	
			<option value=''></option>
  <?php
		$sql3="SELECT distinct Publisher FROM book_mast order by publisher";
		$rs3=odbc_exec($conn,$sql3);

		while($rec3=odbc_fetch_array($rs3))
			{ 	$pub=$rec3['Publisher'];
				echo "<option value='".$pub."'>".$pub."</option>";
			}
?>
      </select>	
      </td>
	  <td width="10%">
	      <input type="submit" name="submit" value="Search">
   	  </td></table>	
	  
	
<hr>
<div align="center" style=" width:100%; height:380px; overflow:auto;">

<div id='wait' style="display:'block'; color:red;"><br><br><img src="images/search.gif" alt="Close" width="32" height="32" border="0" align="centre" /><br>Please wait.......... </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-size=12px; " >
         <tr  >
			<th width="5%" align="left" class="tbl">&nbsp;</th>
			<th width="10%" align="left" class="tbl">Acc.no.</th>
			<th width="34%" align="left" class="tbl">Book Title</th>
			<th width="18%" align="left" class="tbl">Author</th>
			<th width="20%" align="left" class="tbl">Publisher</th>
			<th width="15%" align="left" class="tbl">Edition Year</th>
		 </tr>

<input type="hidden" name="back" value="book_list.php"/>

<?php		
$i=0;
	if(isset($_POST['classification_combo']) && strlen($_POST['classification_combo'])>0 )
		$wcond=$wcond." and "."classification='". $_POST['classification_combo']."'";
		
	if(isset($_POST['author_combo']) && strlen($_POST['author_combo'])>0)
		$wcond=$wcond." and "."Author='". $_POST['author_combo']."'";	
		
	if(isset($_POST['publisher_combo']) && strlen($_POST['publisher_combo'])>0)
		$wcond=$wcond." and "."Publisher='". $_POST['publisher_combo']."'";	

	$wcond=$wcond." order by b.accno";	
//---------------------------------------------------------
	
	$sql="SELECT b.AccNo, b.Book_Title, b.Author, b.Publisher, b.Edition_year, l.locno FROM book_mast b, location_mast l " . $wcond;
		$rs=odbc_exec($conn,$sql);


		while($rec=odbc_fetch_array($rs))
		{ $i++; 
		
		 $accno=$rec['AccNo'];
		 $book_title=$rec['Book_Title'];
		 $author=$rec['Author'];
		 $publisher=$rec['Publisher'];
		 $edition=$rec['Edition_year'];
?>	



		<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
			<td width="5%" > <input TYPE="radio" NAME="book_id" value="<?php echo $accno ?>" ></td>
			<td width="10%" align="left"><?php echo $accno ?></td>
			<td width="35%" align="left"> <?php echo $book_title ?> </td>
			<td width="18%" align="left"> <?php echo $author ?> </td>
			<td width="20%" align="left"> <?php echo $publisher?> </td>
			<td width="15%" align="left"> <?php echo $edition ?> </td>
		</tr>
	
<?php			
		}
?>

    </table></div>	<hr>
	<table align="Center" width ="70%" border="0">

		<tr><td width="10%" align="left"><input type="submit" name="submit" id="submit" value="Show Detail" onclick="fun_book_detail()"></td>		
			<td width="10%" align="center"><input type="submit" name="submit" id="submit" value="Show Reviews" onclick="fun_show_reviews()"></td>
			<td width="10%" align="right"><input type="submit" name="submit" id="submit" value="   Cancel   " onclick="fun_cancel()"></td>
		</tr>
    </table>
</form>
</div>
<script language="javascript"> 
  var ele = document.getElementById("wait");
   ele.style.display = "none";
</script>   
</body>