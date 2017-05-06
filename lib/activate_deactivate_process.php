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
		window.location.href='activate_deactivate.php';
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
	
		<center><span class="h">Library Info System | Activated and Deactivated</span>
		<p>

		<hr>
		<div style="color:Red; padding:2px; width: 90%; height:380px; overflow:auto;">
		<table width="100%" border="1" cellspacing="0" cellpadding="5" >
			<tr><th class="tbl" align="center" width="5%">Sl.No.</th>
				<th class="tbl" align="left" width="30%">Name</th>
				<th class="tbl" align="center" width="15%">Design/Class</th>
				<th class="tbl" align="left" width="25%">Father Name</th>
				<th class="tbl" align="center" width="18%">Status Date</th>
				<th class="tbl">Status</th>
			</tr>
		
<?php

		$i=0;
	//$today=date('Y-m-d');
	$sql=$_POST['sql_txt'];
	
			$rs=odbc_exec($conn, $sql);
			while($rec=odbc_fetch_array($rs))
			{	$regno=$rec['lib_reg_no'];
				$ut="utype".$regno;

				if($_POST[$regno]!=$rec['active_deactive'] || $rec['usertype']!=$_POST[$ut])
				  { 
					$sql2="update user_mast set usertype='".$_POST[$ut]."', active_deactive='".$_POST[$regno]."', active_deactive_date=date() where active_deactive_date is not null and lib_reg_no='$rec[lib_reg_no]'";
					odbc_exec($conn,$sql2) or die("Sorry! Unable to activate.......");
					if($_POST[$regno]==1)
						{
							$tick="images/green_tick.png";
							$alt="Activated";
						}	
					else
						{
							$tick="images/red_cross.png";
							$alt="Deactivated";
						}	
	?>	
				<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
					<td align="center" width="5%"><?php echo ($i+1);?></td>
					<td align="left" width="25%"><?php echo $rec['name']?></td>
					<td align="center" width="10%"><?php echo $rec['design'].$rec['class']." [ ".$rec['sec']." ]"; ?></td>
					<td align="left" width="25%"><?php echo $rec['f_name'] ?></td>
					<td align="center" width="18%"><?php echo date("M d 'Y",strtotime($rec['active_deactive_date'])) ?></td>
					<td align="center"><img src="<?php echo $tick ?>" width="32" height="32" alt="<?php echo $alt ?>"/></td>
				</tr>
				
<?php 
					}
			}	
?>
				
				
	</table>
	</div>
		<table width="60%" border="0" align="center">
		<tr><td><input type="button" name="cancel" value="Cancel" onclick="back()"></td>
			<td align="right"><input type="button" name="OK" value="cPanel" onclick="main_menu()"></td>
		<tr>
	</table>	
	</div>
</body>
</html>