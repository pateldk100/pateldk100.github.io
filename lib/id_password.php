<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Library Info System | Password</title>
<script language="javascript">
function back()
{ window.location.href="lib_reg_list.php";
}
</script>
<?php
	include('lib_reg_list.php');


if(isset($_POST['lib_reg_no']))
{
	$sql = "SELECT  lib_reg_no, password FROM User_Mast WHERE lib_reg_no ='".$_POST['lib_reg_no']."'";
	$rs=odbc_exec($conn,$sql);
		if($rec=odbc_fetch_array($rs))
		{
?>	
	<div align="center" valign="middle" class="3d" style="background-color: #A0BBDC; width:25%; height:150px; position: absolute; top: 28%; left: 34.5%;" >
<div align="right" style="background-color: #A0BBDC; width:20%; height:10px; position: absolute; top: 0%; left: 80%;">   
<input type="button" name="button" value=" x " onclick="back()"/></div>
<br><h1>Athentication</h1>	
<hr>
	<table width="94%" border="0">
			<tr>
				<td width="50%" align="right">User Name :</label></strong></td>
				<td colspan="2" style="font-size:14px; color:red"><?php echo $rec['lib_reg_no'] ?></td>
			</tr>
			<tr>
				<td width="50%" align="right">Password : </strong></td>
				<td colspan="2" style="font-size:14px; color:red" ><?php echo $rec['password'] ?></td>
			</tr>
	
      </table>
	 </div>	  
<?php
		}
}
?>
</body>
</html>