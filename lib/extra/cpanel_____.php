<html>
<body>
<?php 
session_start();
include('header.inc');
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div align='center' class="div2">

<?php
	if(isset($_SESSION['username']) && $_SESSION['usertype']=='A')
	{
?>

	<table width="100%" border="0" class="class_1">
		<tr align="center">
			<td colspan="3" class="class_2">Control Panel</td>
		</tr>
		<tr align="center">
			<td width "33%" valign="bottom"><a href="create_user.php"><img src="images/create_user.png" alt="Create User" width="65" height="65" border="none"></a></td>
			<td width="33%"></td>
			<td width "33%" valign="bottom"><a href="user_list.php"><img src="images/update_user.png" alt="Update User" width="65" height="65" border="none"></a></td>
		</tr>
		<tr align="center">
			<td width "33%"><a href='create_user.php'>Create User</a></td>
			<td width="33%"></td>
			<td width "33%"><a href='user_list.php'>Update User</a></td>
		</tr>
    
		<tr height="86">
			<td></td>
		</tr>		

		<tr align="center">
			<td width "33%" ><a href="user_list.php?id=del"><img src="images/delete_user.png" alt="Delete User" width="65" height="65" border="none"></a></td>
			<td width="33%"></td>
			<td width "33%" ><a href="user_list.php"><img src="images/list.png" alt="List User" width="65" height="65" border="none"></a></td>

		</tr>
		<tr align="center">
			<td width "33%"><a href="user_list.php?id=del" >Delete User</a></td>
			<td width="33%"></td>
			<td width "33%"><a href='user_list.php'>List User</a></td>
		</tr>

		<tr height="86">
			<td></td>
			<td align="center">&nbsp; </td>
			
		</tr>		
	</table>
<?php
 }
?>	

</div>
	
     <?php include('footer.inc'); ?>



</body>
</html>