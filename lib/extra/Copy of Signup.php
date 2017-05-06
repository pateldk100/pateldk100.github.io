<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Search </title><body>
<?php include ("header.php");
include ("conn.php");

?>

<div align="center" style="border:solid 5px #808080; background:#D6D6D6; color:#2A0000; padding:0px; width:100%; height:600px; overflow:auto; position: absolute; top: 17%; left: 1%; background-color: #C4D6F7;">


<form name="list" action="" method="POST">
	<table width="90%" border="1" >
    
	<tr>
	  <td colspan="5" align="center">&nbsp;</td>
	  <tr>
	  <td colspan="5" align="center"><h2>Library Info System | Sign Up</h2></td>
	  <tr>
	  <td align="left">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td align="left">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <tr>
    	<td width="10%" align="left">	Category :</td>
    	<td width="10%" align="center">
        <select name="cat_combo" size="1" id="cat_combo" accesskey="c" tabindex="1" value size="30">
          <option value="S">STUDENT</option>
          <option value="E">EMPLOYEE</option>
        </select></td>	
        <td>&nbsp;</td>
        <td width="10%" align="left">	Reg No. :</td>	
    	<td width="10%" align="center"><input type="text" name="reg_no" value="" value size="30">		</td>
     <tr>
    	<td width="10%" align="left">	Emp ID :</td>	
    	<td width="10%" align="center"><input type="text" name="emp_id" value="" value size="30"></td>		    
        <td width="10%">&nbsp;</td>
        <td width="10%" align="left">Student ID :</td>	
    	<td width="10%" align="center"><input type="text" name="st_id" value="" value size="30"></td>
       		
        </tr>
        <tr>
          <td align="left">Name :</td>
          <td align="center"><input type="text" name="name" value="" value size="30"></td>
          <td>&nbsp;</td>
          <td width="10%" align="left">Father's Name :</td>
          <td align="center"><input type="text" name="fname" value="" value size="30"></td>
        </tr>
       
        <tr>
      <td align="left">Class :</td>
      <td align="center"><input type="text" name="class" value="" value size="30"></td>
      <td>&nbsp;</td>
      <td align="left">Section :</td>
      <td align="center"><input type="text" name="sec" value="" value size="30"></td>
    </tr>
     <tr>
          <td align="left">Designation :</td>
       <td align="center"><input type="text" name="design" value="" value size="30"></td>
          <td>&nbsp;</td>
          <td align="left">Address :</td>
          <td align="center"><input type="text" name="add" value="" value size="30"></td>
      </tr>
        
		

      </table>

</center></div></center></div>

</body>