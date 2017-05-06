<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">

<!--
@import url("style.css");
body {
	background-image: url(images/background3.png);
	background-repeat: repeat-x;
	
}
body,td,th {
	font-size: 14px;
	color: #2A0000;
	top: 10%;
	
}
-->
</style>
</head>

<body>
  <?php
	session_start();
	include('conn.php');
	include('style.css');
	$sql="SELECT * FROM system_mast";
	$rs=odbc_exec($conn,$sql);
	
	while(odbc_fetch_row($rs))
	{ 
	   $school_name=odbc_result($rs,"School_name");
	   $add1=odbc_result($rs,"Add1");
	   $add2=odbc_result($rs,"Add2");
	}	
	echo "<title>Library Info System | ".$school_name.", ". $add1." ". $add2."</title>";
	
	if(isset($_SESSION['id']))  $enbl_dsbl="";   else  $enbl_dsbl="disabled";
?>

<table width="100%" border="0">
  <tr>
    <td width="60%" align="left" valign="middle"></td>
    <td height="26" align="left" valign="middle" class="simple"><?php if(isset($_SESSION['id'])) echo $_SESSION['logged']; ?>&nbsp;</td>
    <td width="8%" align="right" valign="middle"><font size='2'><?php if(isset($_SESSION['id'])) { if($_SESSION['utype']=="A") echo "<a href='cpanel.php'>cPanel</a>"; else echo "<a href='account_panel.php'>Account</a>";} else echo "<a href='usertype.php'>Sign-up</a>"; ?></font></td>
    <td width="8%" align="right" valign="middle"><font size='2'><?php if(isset($_SESSION['id'])) echo "<a href='logout.php'>Logout</a>"; else echo "<a href='login.php'>Login</a>";?></font></td>
    
    <td valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td width="60%" align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;<font size="3" color="white" ><?php echo $school_name.","; echo " <small> ".$add1." ".$add2."</small>"; ?></font></td>
    <td width="8%" align="right" valign="baseline">
    
    	<form id="Serch_frm" name="Serch_frm" method="post" action="book_list.php">
		    <input name="txtsrch" type="text" value=" <?php  if(isset($_POST['txtsrch'])) echo trim($_POST['txtsrch']); ?>" id="txtsrch" size="30" <?php echo $enbl_dsbl ?> />
    </td>
    <td align="right" valign="top">
       	<input type="submit" name="button" id="button" value="Search" <?php echo $enbl_dsbl ?> /></td>
    <td width="15%" align="right" valign="middle">&nbsp;</td>
   	<td width="1%" valign="top">&nbsp;</td>
        </form>
  </tr>
</table>


</body>
</html>