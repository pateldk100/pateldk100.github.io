<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Sign-up </title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<?php include ("header.php");
include ("conn.php");
?>

<div align="left" class="div">
<span><a href="index.php"><img src="images/close.png" alt="close" width="16" height="16" border="0" align="right" /></a></span>

<form name="user_type" action="signup.php" method="POST">  
<br>
	<center><div class="h">Library Info System | Sign Up</div></center>
<br>
<br>
<br><br><br>
	<div style="color:#039">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<center><u>Select your Category</u><br><br><br>
        <select name="cat_combo" size="1"  id="cat_combo" accesskey="c" tabindex="0" value size="30">
          <option value="STUDENT">STUDENT</option>
          <option value="EMPLOYEE">EMPLOYEE</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" id="submit" value=" OK " >
	</div>	
	
	</form>

</center></div></center>

</body>