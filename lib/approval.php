<html>
<title>Library Management System | Approval </title>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" >
<style type="text/css">
.div_s{border:solid 2px #999; background:#FBFBFB; color:#000000; size="19" padding:2px; width:90%; overflow:auto;}
<!--
.tbl {
	color: white;
	background-color: #09F;
}
-->
</style>

<script language="javascript">
function back()
	{
		window.location.href="cpanel.php";
	}
</script>
</head>
<body>

<?php include ("header.php");
if((isset($_SESSION['utype'])) && $_SESSION['utype']=='A')
{
	
	$sql="select r.lib_reg_no, r.name, r.design, r.class, r.sec, r.f_name, u.phone, u.email, u.reg_date, u.usertype, u.Active_deactive 
		  from reader_mast r, user_mast u where r.lib_reg_no=u.lib_reg_no and Active_deactive<>1 and active_deactive_date is null";

  	$rs=odbc_exec($conn, $sql);

	$i=0;	
?>

	<div align="left" class="div" >
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
	<br>
	
	<form name="list" action="approve_process.php" method="POST">	
		<center><span class="h">Library Info System | Approval</span>
		<p>

		<hr>
		<div style="color:red; padding:2px; width: 90%; height:380px; overflow:auto;">
		<table width="100%" border="1" cellspacing="0" cellpadding="5" >
			<tr><th class="tbl" align="center" width="5%">Sl.No.</th>
				<th class="tbl"align="left" width="30%">Name</th>
				<th class="tbl" align="center" width="15%">Design/Class</th>
				<th class="tbl" align="left" width="25%">Father Name</th>
				<th class="tbl" align="center" width="18%">Registratin Date</th>
				<th class="tbl" align="center" width="18%">User Type</th>
				<th class="tbl" align="center" width="7%">Approve</th>

			</tr>
		
<?php	

		while($rec=odbc_fetch_array($rs))
		{ 
			$regno=$rec['lib_reg_no'];	
?>	
	<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
	
					<td align="center" width="5%"><?php echo ($i+1);?></td>
					<td align="left" width="25%"><?php echo $rec['name']?></td>
					<td align="center" width="10%"><?php echo $rec['design'].$rec['class']." [ ".$rec['sec']." ]"; ?></td>
					<td align="left" width="25%"><?php echo $rec['f_name'] ?></td>
					<td align="center" width="18%"><?php echo date("M d 'Y",strtotime($rec['reg_date']))  ?></td>
					<td align="center" width="18%">
				
										<?php 	if($rec['usertype']=='U')  
												{	$U_type=" selected='selected'"; 
													$A_type="";
												}	
												else 
												{	$A_type=" selected='selected'";
													$U_type="";
												}
										?>		
													<select name="<?php echo $rec['lib_reg_no'] ?>" size="1" >
														<option value='U' <?php echo $U_type ?> >User</option>
														<option value='A'<?php echo $A_type ?> >Administrator</option>
													</select></td>
																		
					<td align="center" width="7%" align="center"><input type="checkbox" name="approval[]" value="<?php echo $rec['lib_reg_no'] ?>"/></td>
				</tr>
	
<?php	
		$i++;
		}     

	
?></table>
</div>
	<table width="60%" border="0" align="center">
		<tr><td align="left"><input type="submit" name="approve" value="Approve"></td>
			<td align="right"><input type="button" name="cancel" value="Cancel" onclick="back()"></td>
		<tr>
	</table>	
<?php 
}//if session utype
else
echo "<P><p><P><p><p><span style='align:center; color:red;'> Sorry! You are not Authorised..........</span>";
?>	
</form></div>

</body>
</html>