<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Search </title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>

<?php include ("header.php");
include ("validate_form.inc");

if(isset($_POST['cat_combo']))
{ 
	if($_POST['cat_combo']=='STUDENT')
		{$category="Student";
		 $lbl_cat="SR No. :";
		} 
	else
		{$category="Employee";
		 $lbl_cat="Emp. no. :";
		} 
}

				
		$sql="SELECT max(mid(lib_reg_no,2,len(lib_reg_no))) FROM reader_mast";
		$rs=odbc_exec($conn,$sql);	
	
		if($rs)
		{

			while(odbc_fetch_row($rs))
				$max_reg=odbc_result($rs,"Expr1000");
			$max_reg +=1;
			
			echo $max_reg;
			
			if($max_reg==1)
				$max_reg=10001;
		}
?>



<div align="left" class="div">
<span><a href="Usertype.php"><img src="images/close.png" alt="close" width="16" height="16" border="0" align="right" /></a></span>

<br>
	<center><div class="h">Library Info System | Sign Up
	<br><small><?php echo $category;?> detail </small>
	
	</div></center>
<br><hr>
	<table width="90%" border="0" cellspacing="5" cellpadding="5" >
   
	
<form name="user_entry" action="user_manager.php?action=create"  onsubmit="return validate_user_entry_form()" method="POST" > 
	
     <tr>
    	
    	<td   width="20%" align="left"> <?php echo $category ?>....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type :</td>
		 <td colspan="2">
          <label>User <input type="radio" name="utype" id="utype" value="U" checked="checked"/> </label>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		  <label>Administrator <input type="radio" name="utype" id="utype" value="A" /> </label></td>	
        <td width="10%" align="right">Library Reg. No. :</td>	
    	<td width="10%" align="right"><input type="text" name="lib_reg_no_show" value="<?php echo substr($_POST['cat_combo'],0,1).$max_reg;?>" value size="30" disabled>
		<input type="hidden" name="lib_reg_no" value="<?php echo substr_replace($_POST['cat_combo'],'',1).$max_reg;?>">
		
		</td>
    </tr>
	
<?php 	if($_POST['cat_combo']=='EMPLOYEE')
  { ?>   
	 <tr>
    	<td width="10%" align="right"><?php echo $lbl_cat; ?></td>	
    	<td width="10%" align="right"><input type="text" name="idsr" value="" value size="30" class="cl_box"></td>		    
        <td width="10%">&nbsp;</td>
		<td align="right">Designation :</td>
		<td><select name="design" size="1"  id="design" accesskey="d" tabindex="0" >	  
  <?php		
		$sql="SELECT * FROM design_mast" ;
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
			{ 	$dgn=odbc_result($rs,"design");
				echo "<option value='".$dgn."'>".$dgn."</option>";
			}
   ?>
         </select>
    </tr>
<?php 
  }
  else
  { ?>
    <tr>
      	<td width="10%" align="right"><?php echo $lbl_cat; ?></td>	
    	<td width="10%" align="right"><input type="text" name="idsr" value="" value size="30" class="cl_box"></td>		    
        <td width="10%">&nbsp;</td>
	</tr>
	<tr>
      <td align="right">Class :</td>

	  <td><select name="stud_class" size="1"  id="stud_class" accesskey="c" tabindex="0" >	  
  <?php		
		$sql="SELECT distinct class_val, class FROM class_mast";
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
			{ 	$cl=odbc_result($rs,"class");
				$cl_val=odbc_result($rs,"class_val");
				echo "<option value='".$cl_val."'>".$cl."</option>";
			}
   ?>
         </select>
 
	  

      <td>&nbsp;</td>
      <td align="right">Section :</td>
	  
	   <td><select name="sec" size="1"  id="sec" accesskey="s" tabindex="0" >	  
  <?php		
		$sql="SELECT distinct sec FROM class_mast";
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
		{
			$sec=odbc_result($rs,"sec");
			echo "<option value='".$sec."'>".$sec."</option>";
		}
   ?>
         </select>
    </tr>
  
<?php 
  } ?>  
  
	<tr>
          <td align="right">Name :</td>
          <td align="right"><input type="text" name="name" value="" value size="30" class="cl_box" ></td>
          <td>&nbsp;</td>
          <td width="15%" align="right">Father's Name :</td>
          <td align="right"><input type="text" name="fname" value="" value size="30" class="cl_box"></td>
     </tr>
	 <tr>
         <td align="right">Phone :</td>
         <td align="right"><input type="text" name="phone" value="" value size="30" maxlength="10" class="cl_box" ></td>
		 <td width="10%">&nbsp;</td>
	     <td align="right">e-mail :</td>
         <td align="right"><input type="text" name="email" value="" value size="30" class="cl_box" ></td>
	 </tr>
	 <tr>
        <td align="right"rowspan="2">Address :</td>
        <td align="right"rowspan="2"><textarea name="add" cols="32" rows="4" onfocus="entry_form_item_got_focus()" class="cl_box">Your address here.....!</textarea></td>
		<td>&nbsp;</td>
	    <td align="right" style="color:#00F">Password :</td>
        <td align="right"><input type="password" name="pass" value="" value size="30" class="cl_box"></td>
	 </tr>
	 <tr><td>&nbsp;</td>
	    <td width="17%" align="right"style="color:#00F">Confirm Password :</td>
        <td align="right"><input type="password" name="conf_pass" value="" value size="30" maxlength="12" class="cl_box"></td>
	 </table>  
	
 <input type="hidden" name='cat' value="<?php echo $_POST['cat_combo'] ?>">
 <hr>
	  <center>
	  <table border="0" width="60%">
	
         <tr><td width="20%" align="center"><input type="submit" name="submit" id="submit" value="Create" >
</form>      </td><td width="20%">&nbsp;</td>
			 <td width="20%" align="right">
			    <form name="user_cancel" action="index.php" method="POST"> 			
					<input type="submit" name="cancl" id="cancl" value="Cancel">
				</form>	
			 </td>
		</table>	
	    </center>		
           
<hr>
		<center><div style="color:#999">NOTE : You will not be able to use your account until the librarian  grants permission.	</div><center>
	
		</center></div></center></div>

</body>