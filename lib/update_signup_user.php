<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Search </title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>

<?php include ("header.php");
include ("validate_form.inc");

 
if(isset($_POST['lib_reg_no']) && strlen($_POST['lib_reg_no'])>0)
{
		
		//$sql="SELECT count(*) as nos FROM user_mast u, reader_mast r where u.lib_reg_no='".$_POST['lib_reg_no']."' and u.lib_reg_no=r.lib_reg_no" ;
		$sql="SELECT count(*) as nos FROM reader_mast where lib_reg_no='".$_POST['lib_reg_no']."'" ;
		$rs=odbc_exec($conn,$sql);	
		$rec=odbc_fetch_array($rs);
		if($rec['nos']>0)
		{ 
			$sql2="SELECT count(*) as nos2 FROM user_mast where lib_reg_no='".$_POST['lib_reg_no']."'" ;
			$rs2=odbc_exec($conn,$sql2);	
			$rec2=odbc_fetch_array($rs2);
			if($rec2['nos2']>0)
			{
				echo "<script>javascript:alert('You are already registered for online....');</script>";
				echo "<script>window.location.href='index.php'</script>";
			}
		}
		else
		{
			echo "<script>javascript:alert('Wrong Library Registration no....');</script>";
			echo "<script>window.location.href='usertype.php'</script>";
		}
		



		$ch=substr($_POST['lib_reg_no'],0,1);
		if($ch=='S' || $ch='s' )
		{	$category="Student";
			$lbl_cat="SR No. :";
		} 
		else
		{	$category="Employee";
			$lbl_cat="Emp. no. :";
		} 
	
	
		$sql="SELECT lib_reg_no, cat, name, design, idsr, class, sec, f_name, add1
				FROM reader_mast where lib_reg_no='".$_POST['lib_reg_no']."'" ;
		$rs=odbc_exec($conn,$sql);	

		if($rs)
		{
			$v_lib_reg_no=odbc_result($rs,"Lib_reg_no");
			$v_cat=odbc_result($rs,"cat"); 
			$v_name=odbc_result($rs,"name");
			$v_design=odbc_result($rs,"design"); 
			$v_IDSR=odbc_result($rs,"IDSR");
			$v_clas=odbc_result($rs,"class");
			$v_sec=odbc_result($rs,"sec");
			$v_fname=odbc_result($rs,"f_name"); 
			$v_add1=odbc_result($rs,"add1");
			$v_pass="";		
			$v_phone="";
			$v_email="";	
			$v_utype="U";
			
		}
	

?>

<div align="left" class="div">
<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
<br>
	<center><div class="h">Library Info System | Update & Signup
	<br><small><?php echo $category;?> detail </small>
	
	</div></center>
<br><hr>
	<table width="90%" border="0" cellspacing="5" cellpadding="5" >
   
	
<form name="user_entry" action="user_manager.php?action=update2"  onsubmit="return validate_user_entry_form()" method="POST" > 
	
     <tr>
    	
    	<td   width="20%" align="left"> <?php echo $category ?>....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type :</td>
		 <td colspan="2">
          <label>User <input type="radio" name="utype" id="utype" value="U" checked="checked"/> </label>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		  <label>Administrator <input type="radio" name="utype" id="utype" value="A" /> </label></td>	
        <td width="10%" align="right">Library Reg. No. :</td>	
    	<td width="10%" align="right"><input type="text" name="lib_reg_no_show" value="<?php echo $v_lib_reg_no ?>" value size="30" disabled>
		<input type="hidden" name="lib_reg_no" value="<?php echo $v_lib_reg_no ?>">
		
		</td>
    </tr>
	
<?php 

if($category=='Employee')
  { ?>   
	 <tr>
    	<td width="10%" align="right"><?php echo $lbl_cat; ?></td>	
    	<td width="10%" align="left"><?php echo $v_IDSR;?></td>
    
        <td width="10%">&nbsp;</td>
		<td align="right">Designation :</td>
		<td><select name="design" size="1"  id="design" value="" accesskey="d" tabindex="0" >	  
  <?php		
		$sql="SELECT * FROM design_mast" ;
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
			{ 	$dgn=odbc_result($rs,"design");
				if($v_design==$dgn) $pst=$dgn."' selected"; else $pst=$dgn."'";
				echo "<option value='".$pst.">".$dgn."</option>";
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
		<td width="10%" align="left"><?php echo $v_IDSR;?></td>
		
        <td width="10%">&nbsp;</td>
	</tr>
	<tr>
      <td align="right">Class :</td>

	  <td><select name="stud_class" size="1"  id="stud_class" value="" accesskey="c" tabindex="0"  class="cl_box" >	  
  <?php
		$sql="SELECT distinct class_val, class FROM class_mast";
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
			{ 	$cl=odbc_result($rs,"class");
				$cl_val=odbc_result($rs,"class_val");
				if($v_clas==$cl_val) $pst= $cl_val."' selected"; else $pst=$cl_val."'";
				echo "<option value='".$pst.">".$cl."</option>";
			}
   ?>
         </select>
 
	  

      <td>&nbsp;</td>
      <td align="right">Section :</td>
	  
	   <td><select name="sec" size="1"  id="sec" value="<?php echo $v_sec;?>" accesskey="s" tabindex="0" class="cl_box">	  
  <?php		
		$sql="SELECT distinct sec FROM class_mast";
		$rs=odbc_exec($conn,$sql);
		while(odbc_fetch_row($rs))
		{
			$sec=odbc_result($rs,"sec");
			if($v_sec==$sec) $pst= $sec."' selected"; else $pst=$sec."'";
			
			echo "<option value='".$pst.">".$sec."</option>";
		}
   ?>
         </select>
    </tr>
  
<?php 
  } ?>  
  
	<tr>
          <td align="right">Name :</td>
          <td align="right"><input type="text" name="name" value="<?php echo $v_name;?>" value size="30"  class="cl_box"></td>
          <td>&nbsp;</td>
          <td width="15%" align="right">Father's Name :</td>
          <td align="right"><input type="text" name="fname" value="<?php echo $v_fname;?>" value size="30"  class="cl_box"></td>
     </tr>
	 <tr>
         <td align="right">Phone :</td>
         <td align="right"><input type="text" name="phone" value="<?php echo $v_phone;?>" value size="30" maxlength="10"  class="cl_box"></td>
		 <td width="10%">&nbsp;</td>
	     <td align="right">e-mail :</td>
         <td align="right"><input type="text" name="email" value="<?php echo $v_email;?>" value size="30"  class="cl_box"></td>
	 </tr>
	 <tr>
        <td align="right"rowspan="2">Address :</td>
        <td align="right"rowspan="2"><textarea name="add" cols="32" rows="4" value=""  class="cl_box" ><?php echo $v_add1;?></textarea></td>
		<td>&nbsp;</td>
	  
		<td align="right" style="color:#00F">Password :</td>
		<td align="right"><input type="password" name="pass" value="<?php echo $v_pass;?>" value size="30"  class="cl_box"></td>
	</tr>
	 <tr><td>&nbsp;</td>
	    <td width="17%" align="right"style="color:#00F">Confirm Password :</td>
        <td align="right"><input type="password" name="conf_pass" value="" value size="30" maxlength="12"  class="cl_box"></td>
	</table>  
	
 <input type="hidden" name='cat' value="<?php echo $v_cat ?>">
 <input type="hidden" name="idsr" value="<?php echo $v_IDSR;?>"/>
<br>  <hr>
	  <center>
	  <table border="0" width="50%">
	
         <tr><td width="20%" align="left"><input type="submit" name="submit" id="submit" value="Update" ></td>
 	<td width="20%" align="right">

					<input type="button" name="cencel" id="cancel" value="Cancel" onclick="cancel_action()">
				</form>
			</td>
		</tr>		

	  </table>	
	    </center>		
       
<hr>
</center></div></center></div>
<?php }
else
    {echo "<script>javascript:alert('Please enter your Library registration no.....');</script>";
	 echo "<script>window.location.href='usertype.php'</script>";	
	}
 ?>
<script language="javascript">
function cancel_action()
{window.location.href="index.php";
} 
 </script>
</body>