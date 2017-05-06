<html>
<title>Library Management System | User List </title><body>
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

function fun_cancel(){
        document.user_list_form.action="cpanel.php";
}
function fun_list_user(){
        document.user_list_form.action="user_detail.php";
}
function fun_show_id_pass(){
        document.user_list_form.action="id_password.php";
}		
		
</script>
</head>

<?php include ("header.php");
include ("conn.php");
//include ("validate_form.inc");


$wcond="and (active_deactive=1 ";
$schk="checked='checked'";
$echk="checked='checked'";
$achk="";
$deact_newchk="";

if(isset($_POST['stud_chkbox']) || isset($_POST['emp_chkbox']))
{
	if($_POST['deact_new_chkbox']=='on')
	{	$wcond=$wcond." or  u.active_deactive=0) ";
		$deact_newchk="checked='checked'";
	}
	else
	$wcond=$wcond.")"; 

	if($_POST['stud_chkbox']=='on' && $_POST['emp_chkbox']=='on')
	{
		$wcond=$wcond." and (r.cat='STUDENT' or r.cat='EMPLOYEE') ";
		$schk="checked='checked'";
		$echk="checked='checked'";
	}
	else
	{
		if($_POST['stud_chkbox']=='on')
		{	$wcond=$wcond." and r.cat='STUDENT'";
			$schk="checked='checked'";
			$echk="";
		}	

		if($_POST['emp_chkbox']=='on')
		{	$wcond=$wcond." and r.cat='EMPLOYEE'";
			$echk="checked='checked'";
			$schk="";
		}

	}
	if($_POST['admn_chkbox']=='on')
	{	$wcond=$wcond." and u.usertype='A'";
		$achk="checked='checked'";
	}
	


}
else
{
	$wcond=$wcond.")"; 
}

if(isset($_POST['txtsrch']))
	$wcond=$wcond." and r.name like '". trim($_POST['txtsrch'])."%'";	

$wcond=$wcond." order by r.name";


?>

<div align="center" class="div">
<span><a href="cpanel.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
<br>
<form name="user_list_form" action="" method="POST" >
<div class="h">Library Info System | User List</div>

<hr>

<div>

	<label><input type="checkbox" name="stud_chkbox" id="stud_chkbox" tabindex="1" <?php echo $schk ?>/>Students</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="checkbox" name="emp_chkbox" id="emp_chkbox" tabindex="1" <?php echo $echk ?> />Employees</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="checkbox" name="admn_chkbox" id="admn_chkbox" tabindex="1" <?php echo $achk ?> />Administrators</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="checkbox" name="deact_new_chkbox" id="deact_new_chkbox" tabindex="1" <?php echo $deact_newchk ?> />Deactivated & New</label>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	
	Name :&nbsp;<input name="txtsrch" type="text" value=" <?php  if(isset($_POST['txtsrch'])) echo trim($_POST['txtsrch']); ?>" id="txtsrch" size="20" maxlength="20"/>
	<input type="submit" name="submit" value=" List "/>
	

</div>  

<input type="hidden" name="back" value="lib_reg_list.php"/>
<hr>
<div align="center" style="background:#F4F4F4; color:Red; padding:2px;	width:100%; height:335px; overflow:auto;">
    <table width="100%" border="0" cellspacing="0" cellpadding="5" align="left" border="0">
         <tr align="left"><strong>
			<th width="5%" class="tbl">&nbsp;</th>
			<th width="8%" class="tbl">Reg. No.&nbsp;</th>
			<th width="25%" class="tbl">Name</th>
			<th width="15%" align="center" class="tbl">Design./Class</th>
			<th width="20%" class="tbl">Father's Name</th>
			<th width="15%" class="tbl">User Type</th>
			<th width="15%" class="tbl">Last Login</th>
		 </tr>
		 <tr>
			<td colspan="7" width="100%"><p align="center"><img height="2" src="images/line.gif" width="100%" border="0"></td>
		</tr>
<?php
$i=0;	
	$sql="SELECT r.lib_reg_no, r.IDSR, r.name, r.design, r.class, r.sec, r.f_name, u.usertype, u.login_date 
			from reader_mast r, user_mast u  where r.lib_reg_no=u.lib_reg_no " . $wcond;

		$rs=odbc_exec($conn,$sql);


		while($rec=odbc_fetch_array($rs))
		{ $i++; 
		
		 $lib_reg_no=$rec['lib_reg_no'];
		 $idsr=$rec['IDSR'];
		 $name=$rec['name'];
		 $design=$rec['design'];
		 $class=$rec['class'];
		 $sec=$rec['sec'];
		 $fname=$rec['f_name'];
		 
		 if($rec['usertype']=='A')  $usertype="Administrator"; else  $usertype="User";
		 
		 $last_login= date("M d 'Y",strtotime($rec['login_date']));
?>	
		<tr bgcolor= <?php if($i%2==0) echo '#C5E8E1'; else echo '#E2EFD0'; ?>  >
			<td width="5%"> <input TYPE="radio" NAME="lib_reg_no" value="<?php echo $lib_reg_no ?>" ></td>
			<td width="8%"><?php echo $lib_reg_no ?>
			<td width="25%"> <?php echo $name ?> </td>
			<td width="15%" align="center"> <?php echo " [ ".$design.$class." ".$sec." ]" ?> </td>
			<td width="20%"> <?php echo $fname ?> </td>
			<td width="15%"> <?php echo $usertype ?> </td>
			<td width="15%"> <?php echo $last_login ?> </td>
		</tr>
	
<?php			
		}
?>		
		<tr>
			<td colspan='7' width='100%'><p align='center'><img height='2' src='images/line.gif' width='100%' border='0'></td>
		</tr>
	</table>
</div><hr>
	<table width="90%" border="0">	
		<tr>
			<td width="33%" align="left"><input type="submit" name="show_pass" value="Show Password" onclick="fun_show_id_pass()"/></td>
			<td width="33%" align="center"><input type="submit" name="detail" value="  Show Detail  " onclick="fun_list_user()"/></td>
			<td width="33%" align="right"><input type='submit' name='cancel' value='       Cancel       ' onclick="fun_cancel()"></td>
	</table>
<hr>	
</form>	

</div>


</body>