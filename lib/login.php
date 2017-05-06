<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Library Info System | Login</title>
<?php
	include('index.php');
	include("validate_form.inc");

if(isset($_POST['username']) && isset($_POST['password']))
{
    $uname="";
	$pass="";
	$sql = "SELECT u.lib_reg_no,  u.usertype, u.password, r.cat, r.IDSR, r.name, r.design, r.class, r.sec, u.active_deactive FROM User_Mast u, reader_mast r WHERE u.lib_reg_no =Ucase('".$_POST['username']."') AND u.password ='".$_POST['password']."' and u.lib_reg_no=r.lib_reg_no";
	$rs=odbc_exec($conn,$sql);
		if($rec=odbc_fetch_array($rs))
		{
			if($rec['active_deactive']!=0)
			{
			$pass=$rec['password'];
			$name=$rec['name'];
			$class=$rec['class'];
			$sec=$rec['sec'];
			$design=$rec['design'];
			
			$_SESSION['id']=$rec['lib_reg_no'];
			$_SESSION['cat']=$rec['cat'];
			$_SESSION['utype']=$rec['usertype'];
			$_SESSION['IDSR']=$rec['IDSR'];
			$_SESSION['name']=$name." [ ".$class.$sec.$design."]";
			$_SESSION['logged']="Welcome....".$_SESSION['name'];

//			unset($_SESSION['action']);  making free created session.

//			$dt=date('Y-m-d');
			$qstr="update user_mast set login_date=date(), no_of_login=no_of_login+1 where lib_reg_no='".$_SESSION['id']."' and password ='$pass'";	
			odbc_exec($conn,$qstr);

			echo "<script>window.location.href='index.php'</script>";
			}
			else
			{
			 login_form();
			 echo "<font color=#ff0000><Center><b><small>Sorry! Your approval awaited<small></b></Center></font>";
			}
		}	
        else 
		{   login_form();
	        echo "<font color=#ff0000><Center><b><small>Wrong User name or Password<small></b></Center></font>";
			//	echo "<script>javascript:alert('Wrong User name/Password.........')</script>";
		}
}
else
{   login_form();
	echo "<font color=#00FF00><Center><b><small>Enter Lib.Reg.no. as User name<small></b></Center></font>";
}

function Login_form()
{
?>
</head>
<body>
<div align="center" valign="middle" class="3d" style="background-color: #A0BBDC; width:330px; height:190px; position: absolute; top: 28%; left: 34.5%;" >
	
      <form name="login_frm" method="post" action="" >
		<table width="94%" border="0">
			<tr>
				<td colspan="3" align="center"><h3><big><big><big>User Login</h3></td>
			</tr>
			<tr>
				<td width="25%" align="right">User Name :</label></strong></td>
				<td colspan="2" ><input name="username" type="text"  size="28" class="cl_box"/></td>
			</tr>
			<tr>
				<td width="20%" align="right">Password : </strong></td>
				<td colspan="2" ><label><input name="password" type="password" id="password" size="28" class="cl_box" /></label></td>
			</tr>
			<tr><td width="20%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
				<td width="20%">&nbsp;</td>
			</tr>
			<tr><td>&nbsp;</td>
				<td align="left"><input type="button" name="button" value="    Login    " onclick="validate_login_form()"/>
		</form></td><td align="right">
		<form name="cncl" method="POST" action="index.php">     
				<input type="submit" name="submit" value="  Cancel  "/>
		</form></td>
			</tr>
      </table>
<?php
}
?>
</body>
<script language="javascript">
document.login_frm.username.focus();
</script>
</html>