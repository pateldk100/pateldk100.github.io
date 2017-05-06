<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Account Panel </title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<?php 
include('header.php');

if(isset($_SESSION['id']) && $_SESSION['utype']=='A')
 {
?>
<div align="center" class="div">

<table width="100%" border="0">
    <tr align="center">
			<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>

	<td colspan="3" class="class_2">Control Panel

	</td>
    </tr>

    <tr align="center">
	<td width "33%" valign="bottom"><a href="lib_reg_list.php"><img src="images/update_user.png" alt="Update Profile" width="65" height="65" border="none"></a></td>
	<td width="33%">&nbsp;</td>
	<td width "33%" valign="bottom"><a href="delete_user.php"><img src="images/delete_user.png" alt="Delete User" width="65" height="65" border="none"></a></td>
    </tr>
    <tr align="center">
	<td width "33%"><a href='lib_reg_list.php' style="color: blue;" >Update Profile</a></td>
	<td width="33%">&nbsp;</td>
	<td width "33%"><a href='delete_user.php' style="color: blue;" >Delete User</a></td>
    </tr>
    
    <tr height="86">
	<td>&nbsp;</td>
    </tr>		

    <tr align="center">
	<td width "33%" valign="bottom"><a href="approval.php"><img src="images/personal.png" alt="Waiting for approval" width="65" height="65" border="none"></a></td>
	<td width="33%">&nbsp;</td>
	<td width "33%" valign="bottom"><a href="activate_deactivate.php"><img src="images/list.png" alt="Activate deactivate" width="65" height="65" border="none"></a></td>
    </tr>
    <tr align="center">
	<td width "33%"><a href='approval.php' style="color: blue;" >Approval Awaitings</a></td>
	<td width="33%">&nbsp;</td>
	<td width "33%"><a href='activate_deactivate.php' style="color: blue;" >Activate Deactivate</a></td>
    </tr>

	<tr height="86">
	<td>&nbsp;</td>
    </tr>
	
    <tr align="center">
	<td width "33%" valign="bottom"><a href="Promote_user.php"><img src="images/promote.png" alt="Promote Users to next class" width="65" height="65" border="none"></a></td>
	<td width="33%">&nbsp;</td>
	<td width="33%"valign="bottom"><a href="news_entry.php"><img src="images/news.png" alt="Update Library News" width="65" height="65" border="none"></a></td>
    </tr>
    <tr align="center">
	<td width "33%"><a href='Promote_user.php' style="color: blue;" >Promote Users</a></td>
	<td width="33%">&nbsp;</td>
	<td width="33%"><a href='news_entry.php' style="color: blue;" >Update Library News</a></td>
    </tr>
  	
  </table>
 </div>
<?php
 }
/*
 else
   { echo " <blockquote>
  	      <blockquote>
		<p align='Center'><font color = '#000080' size='6' face='Harlow Solid Italic'><strong> Please login first..... </font></strong>
		     <blockquote>
			 <p align='Center'><strong><a href='logout.php'> &lt; Login &gt;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						   <a href='javascript:history.go(-1)'>&lt; Back &gt;</a></p></font></strong>			
		     </blockquote> 	
  	      </blockquote>
	   </blockquote>";
   }
*/ 
?>	



</body>
</html>