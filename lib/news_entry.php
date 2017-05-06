<html>
<title>Library Management System | View Review </title>
<head>
<script language="javascript">

function cancel(){
        document.news_frm.action="cpanel.php";
}


</script>
</head>
<body>

<?php include ("header.php"); ?>
	
	<div align="left" class="div">
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
	<br>
	
	<form name="news_frm" action="" method="POST">	
		<center><span class="h">Library Info System | News Entry</span>
		<p><hr>
		<div>
<?php 
if(isset($_POST['save_btn']) && $_POST['save_btn']=="Save")
{
	$sql="delete from news_mast"; 
	$rs=odbc_exec($conn, $sql) or die("Sorry! unable to perform");
	for($a=1; $a<=10; $a++)
		{
			$n="news". $a;
			$n1=$_POST[$n];
			if(strlen($n1)>0)
			{	$sql="insert into news_mast(news) values( '$n1')"; 
				$rs=odbc_exec($conn, $sql) or die("Sorry! unable to save");
			}
			
		}	
}

		$sql="select * from news_mast";
		$rs=odbc_exec($conn, $sql) or die("Sorry! unable to perform");
	$i=1;
		echo "<table border='0' cellspacing='1' cellpadding='5'>";
		echo "<tr><th>Sl.</th>";
		echo "<th>News</th></tr>";
		while($rec=odbc_fetch_array($rs))
		{  

?>		
		<tr><td><?php echo $i ?></td>	
			<td><input type="text" name="news<?php echo $i ?>"  value="<?php echo $rec['news']; ?>" value size="150"/></td> 
		</tr>	
<?php	
		$i++;
		}
		
		for($x=$i; $x<=10; $x++)
		{
?>
		<tr><td><?php echo $x ?></td>	
			<td><input type="text" name="news<?php echo $x ?>"  value size="150"/></td> 
		</tr>	
<?php  
		}
?>		
		</table></div>

			
<hr>
<input type="submit" name="save_btn" value="Save">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
<input type="submit" name="cancel_btn" value="Cancel" onclick="cancel()">
</div>
</form>
</body>
</html>