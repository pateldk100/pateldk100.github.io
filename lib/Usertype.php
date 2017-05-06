<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Sign-up </title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type='text/css'>

.div_1 { width:30%; height:120px; padding:1em
	border-top-width: medium;
	border-right-width: medium;
	border-bottom-width: medium;
	border-left-width: medium;
	border-top-style: outset;
	border-right-style: outset;
	border-bottom-style: outset;
	border-left-style: outset;	
	border: medium outset #CCCCCC;

}

</style>
<body>
<?php include ("header.php");
?>

<div align="left" class="div">
<span><a href="index.php"><img src="images/close.png" alt="close" width="16" height="16" border="0" align="right" /></a></span>

<form name="user_type" method="POST" onsubmit="return check_form()">  
<br>
	<center><div class="h">Library Info System | Sign Up</div></center>
<br>
<br>
<!-- id no must start from 0 !-->
<center><strong><font size="2" color="green">SELECT ONE</font>
<div style="background:gray"><strong>
<a href='#' id='showid0'>New Library Member</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:white">|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href='#' id='showid1'>Existing Library Member</a>
</div><br><br><br><br>

	<div  id="id0" class="div_1"  style='color:#039; display:none'>
		<center><u>Select your Category</u><br><br><br>
        <select name="cat_combo" size="1"  id="cat_combo" accesskey="c" tabindex="0" value size="30">
          <option value="STUDENT">STUDENT</option>
          <option value="EMPLOYEE">EMPLOYEE</option>
        </select>
        &nbsp;&nbsp;<input type="submit" name="submit1" id="submit1" value="OK" onclick="new_signup_form()">
	</div>	
	
	<div  id="id1" class="div_1" style='color:#039; display:none'>
		<center><u>Enter Registration No.</u><br><br><br>
        <input type="text" name="lib_reg_no"  value size="11" />
        &nbsp;&nbsp;<input type="submit" name="submit2" id="submit2" value="OK"  onclick="update_signup_form()">
	</div>



<script type='text/javascript'>
function update_signup_form()
{
	document.user_type.action="update_signup_user.php";
}

function new_signup_form()
{	document.user_type.lib_reg_no.value="new";
	document.user_type.action="signup.php";
}

function check_form()
{ 
	if(document.user_type.submit2.value=="OK" && document.user_type.lib_reg_no.value.length>0 )
		return true;
	else
		{  alert("Enter your Library Registration no.");
			return false;
		}	
		
}



function ShowOne( linkPrefix, divPrefix )
{
 var limit = 0, elems = [], i = 0, lnk, div;
  
 while( ( lnk = $( linkPrefix + i ) ) && ( div = $( divPrefix + i ) ) )
 {
  elems.push( div );
  lnk.onclick = scan;  
  lnk.elemIdx = i;
  limit = ++i;
 }
   
 function scan()
 {
  for( var i = 0; i < limit; i++ )  
   elems[ i ].style.display = ( this.elemIdx == i ? 'block' : 'none' ); 
   
  return false; 
 }
 
 function $( id ){ return document.getElementById( id ); }  
}

ShowOne( 'showid', 'id');

</script>

</body>
</html>