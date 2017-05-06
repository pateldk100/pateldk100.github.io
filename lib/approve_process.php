<html>
<head>
<style type="text/css">
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
		window.location.href='approval.php';
	}
function main_menu()
	{
		window.location.href='cpanel.php';
	}	
</script>
<body>
<?php include("header.php"); 
$i=0;	
?>
	<div align="left" class="div" >
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
	<br>
		<center><span class="h">Library Info System | Approved and Activated</span>
		<p>

		<hr>
		<div style="color:Red; padding:2px; width: 90%; height:380px; overflow:auto;">
		<table width="100%" border="1" cellspacing="0" cellpadding="5" >
			<tr><th class="tbl" align="center" width="5%">Sl.No.</th>
				<th class="tbl" align="left" width="30%">Name</th>
				<th class="tbl" align="center" width="15%">Design/Class</th>
				<th class="tbl" align="left" width="25%">Father Name</th>
				<th class="tbl" align="center" width="18%">Approval Date</th>
				<th class="tbl" align="center" width="18%">Approved As</th>
				<th class="tbl">Approved</th>
			</tr>
		
<?php
if(isset($_POST['approval']))
{
	//$today=date('Y-m-d');
	
	foreach ($_POST['approval'] as $aprchk) 
	    {	
			$sql1="select usertype from user_mast where lib_reg_no='$aprchk'";
			$rs = odbc_exec($conn,$sql1) or die("Sorry! Unable to Approve.......");
			$rec=odbc_fetch_array($rs);
	
			$sql2="update user_mast set active_deactive=1, usertype='".$_POST[$aprchk]."' ,  active_deactive_date=date() where lib_reg_no='$aprchk'";
			odbc_exec($conn,$sql2) or die("Sorry! Unable to Approve.......");
			
			$sql3="SELECT r.lib_reg_no, r.name, r.design, r.class, r.sec, r.f_name, u.reg_date, u.usertype, u.active_deactive_date FROM reader_mast AS r, user_mast AS u
				WHERE r.lib_reg_no=u.lib_reg_no and (active_deactive=1 and  active_deactive_date=date() and u.lib_reg_no='$aprchk')";
			$rs = odbc_exec($conn,$sql3);
		
			$rec=odbc_fetch_array($rs)
?>	
				<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
	
					<td align="center" width="5%"><?php echo ($i+1);?></td>
					<td align="left" width="25%"><?php echo $rec['name']?></td>
					<td align="center" width="10%"><?php echo $rec['design'].$rec['class']." [ ".$rec['sec']." ]"; ?></td>
					<td align="left" width="25%"><?php echo $rec['f_name'] ?></td>
					<td align="center" width="18%"><?php echo date("d/m/Y",strtotime($rec['active_deactive_date'])) ?></td>
					
					<?php if($rec['usertype']=='A') $uType="Administrator";  else $uType="User"; ?>
					<td align="center" width="18%" style="color:red"><?php echo $uType ?> </td>
					<td align="center"><img src="images/green_tick.png" width="32" height="32" alt="Approved"/></td>
				</tr>
<?php 
			
		$i++;
		}
		
}
else
	echo "No selection for approval......."; 
?>
				
				
	</table>
	</div>
		<table width="60%" border="0" align="center">
		<tr><td align="right"><input type="button" name="  OK  " value="cPanel" onclick="main_menu()"></td>
			<td><input type="button" name="cancel" value="Cancel" onclick="back()"></td>
		<tr>
	</table>	
	</div>
</body>
</html>