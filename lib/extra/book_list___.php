<html>
<title>Library Management System | Search </title><body>

<?php include ("header.php");
include ("conn.php");
$wcond=" where b.condeman<>1 and b.accno=l.accno ";

if(isset($_POST['txtsrch']))
	$wcond=$wcond." and b.book_title like '". trim($_POST['txtsrch'])."%' order by b.accno";	
else
$wcond=" order by b.accno";

?>

<div align="center" class="div">
<span><a href="index.php"><img src="images/close.png" alt="close" width="16" height="16" border="0" align="right" /></a></span>
<br>

<form name="list" action="" method="POST">
	<table width="100%" border="0" >
  
	<tr><td width="20%" align="center">	Area :
		<select name='classification_combo' size='1' value size='30' >

  <?php		
		$sql1="SELECT distinct classification FROM book_mast order by classification";
		$rs1=odbc_exec($conn,$sql1);

		while(odbc_fetch_row($rs1))
			{ 	$clsf=odbc_result($rs1,"Classification");
				echo "<option value='".$clsf."'>".$clsf."</option>";
			}
?>
      </select>
	  </td>
	  <td width="30%" align="center"> Author : 
      <select name='author_combo' size='1' value size='30' >
  <?php
		$sql2="SELECT distinct Author FROM book_mast  order by author";
		$rs2=odbc_exec($conn,$sql2);

		while(odbc_fetch_row($rs2))
			{ 	$author=odbc_result($rs2,"Author");
				echo "<option value='".$author."'>".$author."</option>";
			}
?>
      </select>
	  </td>
	  <td width="40%" align="right" >Publisher :
		<select name='publisher_combo' size='1' value size='30' >	
  <?php
		$sql3="SELECT distinct Publisher FROM book_mast order by publisher";
		$rs3=odbc_exec($conn,$sql3);

		while(odbc_fetch_row($rs3))
			{ 	$pub=odbc_result($rs3,"Publisher");
				echo "<option value='".$pub."'>".$pub."</option>";
			}
?>
      </select>	
      </td>
	  <td width="10%">
	      <input type="submit" name="submit" value="Search">
   	  </td></table>	
</form>
	
<form name="book_list_from" action="book_info.php" method="POST"> 
<div align="center" style=" background:#EAEDFC; color:Red; padding:2px; width:100%; height:380px; overflow:auto;">
    <table width="100%" border="0" cellspacing="0" cellpadding="5" align="left" border="0" style="font-size=12px; " >
         <tr align="left">
			<th>&nbsp;</th>
			<th>Acc.no.&nbsp;</th>
			<th>Book Title</th>
			<th>Author</th>
			<th>Publisher</th>
			<th>Edition Year </th>
		 </tr>
		 <tr>
			<td colspan="6" width="100%"><p align="center"><img height="2" src="images/line.gif" width="100%" border="0"></td>
		</tr>

<?php		
$i=0;
	if(isset($_POST['classification_combo']) && strlen($_POST['classification_combo'])>0 )
		$wcond=$wcond." and "."classification='". $_POST['classification_combo']."'";
		
	if(isset($_POST['author_combo']) && strlen($_POST['author_combo'])>0)
		$wcond=$wcond." and "."Author='". $_POST['author_combo']."'";	
	if(isset($_POST['publisher_combo']) && strlen($_POST['publisher_combo'])>0)
		$wcond=$wcond." and "."Publisher='". $_POST['publisher_combo']."'";	

//---------------------------------------------------------
	
	$sql="SELECT b.accno, b.book_title, b.Author, b.Publisher, b.Edition_year, l.locno FROM book_mast b, location_mast l " . $wcond;
		$rs=odbc_exec($conn,$sql);


		while(odbc_fetch_row($rs))
		{ $i++; 
		
		 $accno=odbc_result($rs,"AccNo");
		 $book_title=odbc_result($rs,"book_title");
		 $author=odbc_result($rs,"Author");
		 $publisher=odbc_result($rs,"Publisher");
		 $edition=odbc_result($rs,"Edition_year");
?>	
		<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
			<td width="5%"> <input TYPE="radio" NAME="book_id" value="<?php echo $accno ?>" ></td>
			<td width="5%"><?php echo $accno ?>
			<td width="40%"> <?php echo $book_title ?> </td>
			<td width="20%"> <?php echo $author ?> </td>
			<td width="25%"> <?php echo $publisher?> </td>
			<td width="10%"> <?php echo $edition ?> </td>
		</tr>
	
<?php			
		}
		echo "<tr>";
    	echo "<td colspan='6' width='100%'><p align='center'><img height='2' src='images/line.gif' width='100%' border='0'></td>";
		echo "</tr>";

?>

    </table></div>	<table align="Center" width ="50%" border="0">
		<tr></tr><tr></tr><tr></tr>
		<tr><td width="10%" align="left"><input type="submit" name="submit" id="submit" value="Show" ></td> 
</form> <form name="search_cancle_frm" action="index.php" method="POST">			     
			<td width="10%" align="right"><input type="submit" name="submit" id="submit" value="Cancel" ></td>
		</form>
		</tr>
    </table>

</div>

</body>