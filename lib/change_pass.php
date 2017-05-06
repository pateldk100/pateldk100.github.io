<?php
	include("account_panel.php"); 
	include("conn.php");

	include("validate_form.inc");
	include("style.css");

?>
<link rel="stylesheet" type="text/css" href="style.css">
<html>
<body> 
 
	     <br>
		 <div align="center" valign="middle" class="3d" style=" background-color: #A0BBDC; width:33%; height:190px; position: absolute; top: 28%; left: 34.5%;" >

		<p align="center"><big><strong>Change Passowrd</strong></p></big>
	  	<form name="change_pass_form" action="change_pass.php" method="post" onsubmit="return validate_change_pass_form()"> 	
		<table width="92%" border="0"  >
		   <tr width="100%">
			<td align="right" width="50%">Currect Password : </td>
			<td align="right" width="50%"><input type="password" name="cur_pass" class="cl_box"></td>
		   <tr>	

		   <tr>
			<td align="right">New Password : </td>
			<td align="left"><input type="password" name="new_pass" class="cl_box"></td>
		   <tr>	

		   <tr>
			<td align="right">Confirm Password : </td>
			<td ><input type="password" name="conf_pass" class="cl_box"></td>
		   </tr>
		</table>	
		  
		 
			<table width="80%" border="0" >
		   <tr>
			<td align="center"><input TYPE="submit" name="change" value="Change"  ></td>
	  	 </form> <form name="cancel" action="account_panel.php" method="post">
			<td align="center"><input type="submit" name="sumbit" value="Cancel"></td>
		   </form>	
		   </tr>	
		   </table> </div>
	</div>
  </div>

<?php 

	if(isset($_POST['cur_pass']) && isset($_POST['new_pass']) && isset($_POST['conf_pass']) && ($_POST['new_pass']==$_POST['conf_pass']))
		{ 
		
			$sql="select password from user_mast where lib_reg_no='".$_SESSION['id']."'";
			$rs=odbc_exec($conn,$sql);
			$result=odbc_result($rs,"password");

			if($result==$_POST['cur_pass'])
			{
					
					$updcall= change_password($_POST['cur_pass'], $_POST['new_pass'], $_SESSION['id'], $conn);
					if($updcall)
					{	echo "<script>javascript:alert('Password Changed successfully......')</script>";
						echo "<script>window.location.href='account_panel.php'</script>";	
					}
					else
						echo "<script>javascript:alert('Error! in Password updation......')</script>";	
			}
			else
				echo "<script>javascript:alert('Password athentication failed.....check current password...')</script>";			
						
		} 
function change_password($curPass, $newPass, $id, $conn)
{		
			$sql="update user_mast set password='$newPass' where password='$curPass' and lib_reg_no='$id'";	
			$rs=odbc_exec($conn,$sql);
			return $rs;
}	
?>