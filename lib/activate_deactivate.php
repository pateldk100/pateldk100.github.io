<html>
<title>Library Management System | Activate-Deactivate </title>
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
		window.location.href='cpanel.php';
	}

function act_deact_process()
	{
		if(confirm("Going to proceed........")==1)
			document.act_deact_frm.action='activate_deactivate_process.php';
	}
</script>
</head>
<body>

<?php include ("header.php");
if((isset($_SESSION['utype'])) && $_SESSION['utype']=='A')
{

$wcond="";
$actchk="checked='checked'";
$deactchk="checked='checked'";

if(isset($_POST['active_chkbox']) || isset($_POST['deactive_chkbox']))
{
	if($_POST['active_chkbox']=='on' && $_POST['deactive_chkbox']=='on')
	{
		$wcond=$wcond." and (u.active_deactive=1 or u.active_deactive=0) ";
		$actchk="checked='checked'";
		$deacchk="checked='checked'";
	}
	else
	{
		if($_POST['active_chkbox']=='on')
		{	$wcond=$wcond." and u.active_deactive=1";
			$actchk="checked='checked'";
			$deactchk="";
		}	

		if($_POST['deactive_chkbox']=='on')
		{	$wcond=$wcond." and u.active_deactive=0";
			$deactchk="checked='checked'";
			$actchk="";
		}	
	}
}
if(isset($_POST['txtsrch']))
	$wcond=$wcond." and r.name like '". trim($_POST['txtsrch'])."%'";	

$wcond=$wcond." order by r.name";

	$sql="select r.lib_reg_no, r.name, r.design, r.class, r.sec, r.f_name, u.reg_date, u.usertype, u.active_deactive, u.active_deactive_date 
		  from reader_mast r, user_mast u where r.lib_reg_no=u.lib_reg_no and u.active_deactive_date is not null 
		  and u.lib_reg_no<>'".$_SESSION['id']."' ".$wcond;

  	$rs=odbc_exec($conn, $sql);

	$i=0;	
	
?>
	
	<div align="left" class="div" >
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
	<br>
	
	<form name="act_deact_frm" action="" method="POST">	
		<center><span class="h">Library Info System | Activate Deactivate</span>
		<hr>
<div>
	<label><input type="checkbox" name="active_chkbox" id="active_chkbox" tabindex="1" <?php echo $actchk ?>/>Active</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="checkbox" name="deactive_chkbox" id="deactive_chkbox" tabindex="1" <?php echo $deactchk ?> />Deactive</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Name :&nbsp;<input name="txtsrch" type="text" value=" <?php  if(isset($_POST['txtsrch'])) echo trim($_POST['txtsrch']); ?>" id="txtsrch" size="30" />
	<input type="submit" name="submit" value=" List "/>
</div>  
		<hr>
	<div style="color:red; width: 95%; height:348px; overflow:auto;">
		<table width="100%" border="1" cellspacing="0" cellpadding="5" >
			<tr><th class="tbl" align="center" width="2%">SN.</th>
				<th class="tbl"align="left" width="25%">Name</th>
				<th class="tbl" align="center" width="10%">Design/Class</th>
				<th class="tbl" align="left" width="15%">Father Name</th>
				<th class="tbl" align="center" width="15%">Registratin Date</th>
				<th class="tbl" align="center" width="15%">Status Date</th>
				<th class="tbl" align="center" width="10%">User Type</th>				
				<th class="tbl" align="center" width="5%">Active</th>
				<th class="tbl" align="center" width="5%">Deactive</th>

			</tr>
<?php	
		while($rec=odbc_fetch_array($rs))
		{  
?>	
	<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
	
					<td align="center" 	width="2%"><?php echo ($i+1);?></td>
					<td align="left" 	width="25%"><?php echo $rec['name']?></td>
					<td align="center" 	width="10%"><?php echo $rec['design'].$rec['class']." [ ".$rec['sec']." ]"; ?></td>
					<td align="left" 	width="20%"><?php echo $rec['f_name'] ?></td>
					<td align="center" 	width="15%"><?php echo date("M d 'Y",strtotime($rec['reg_date']))  ?></td>
					<td align="center" 	width="15%"><?php echo date("M d 'Y",strtotime($rec['active_deactive_date']))  ?></td>
					<td align="center" 	width="10%">
					<?php 	if($rec['usertype']=='U')  
							{	$U_type=" selected='selected'"; 
								$A_type="";
							}	
							else 
							{	$A_type=" selected='selected'";
								$U_type="";
							}
					?>		
					
							<select name="utype<?php echo $rec['lib_reg_no'] ?>" size="1" >
								<option value='U' <?php echo $U_type ?> >User</option>
								<option value='A'<?php echo $A_type ?> >Admin</option>
							</select></td>
	
					
					<?php $a_status="";  $d_status="";  if($rec['active_deactive']==1) $a_status="checked='checked'"; else  $d_status="checked='checked'"; ?>
					<td align="center"	width="5%" align="center"><input type="radio" name="<?php echo $rec['lib_reg_no'] ?>" value="1" <?php echo $a_status ?> /></td>
					<td align="center"	width="5%" align="center"><input type="radio" name="<?php echo $rec['lib_reg_no'] ?>" value="0" <?php echo $d_status ?> /></td>

					</tr>
	
<?php	
		$i++;
		}     
?>		</table>
	</div><hr><input type="hidden" name="sql_txt" value="<?php echo $sql ?>"> 
	<table width="60%" border="0" align="center">
		<tr><td align="left"><input type="submit" name="done" value=" Done " onclick="act_deact_process()"></td>
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