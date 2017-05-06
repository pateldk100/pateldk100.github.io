<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Account Panel </title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<?php 
include('header.php');

if(isset($_SESSION['id']) && $_SESSION['utype']=='U')
 {
?>
<div align="center" class="div">

<table width="100%" border="0">
    <tr align="center">
			<span><a href="index.php"><img src="images/close.png" alt="close" width="16" height="16" border="0" align="right" /></a></span>

	<td colspan="3" class="class_2">My Account

	</td>
    </tr>

    <tr align="center">
	<td width "33%" valign="bottom"><a href="user_detail.php"><img src="images/profile.png" alt="Update Profile" width="65" height="65" border="none"></a></td>
	<td width="33%">&nbsp;</td>
	<td width "33%" valign="bottom"><a href="change_pass.php"><img src="images/change_pass.png" alt="Change Password" width="65" height="65" border="none"></a></td>
    </tr>
    <tr align="center">
	<td width "33%"><a href='user_detail.php' style="color: blue;" >Update Profile</a></td>
	<td width="33%">&nbsp;</td>
	<td width "33%" ><a href='change_pass.php'  style="color: blue;">Change Password</a></td>
    </tr>
    
    <tr height="86">
	<td>&nbsp;</td>
    </tr>		

    <tr align="center">
	<td width "33%" >&nbsp;</td>
	<td width="33%">&nbsp;</td>
	<td width "33%" >&nbsp;</td>
    </tr>
    <tr align="center">
	<td width "33%">&nbsp;</td>
	<td width="33%">&nbsp;</td>
	<td width="33%">&nbsp;</td>
    </tr>

    <tr height="86">
	<td></td>
	<td align="center" valign="bottom" class="class_1"><a href="home.php"></a></td>
    </tr>
    <tr height="86">
      <td></td>
      <td align="center">&nbsp; </td>
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