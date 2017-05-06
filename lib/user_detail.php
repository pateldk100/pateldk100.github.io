<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Search </title>
<link href="style.css" rel="stylesheet" type="text/css">
<head>
<script language="javascript">

function make_updatable(){
        document.user_entry.action="";
		document.user_entry.onsubmit="";
}


</script>
</head>
<body>

<?php include ("header.php");
include ("validate_form.inc");

if(isset($_SESSION['id']))
{ 
	if(isset($_POST['lib_reg_no']))
	{
		$ch=substr_replace($_POST['lib_reg_no'],'',1);
		if($ch=='S')
		{	$category="Student";
			$lbl_cat="SR No. :";
		} 
		else
		{	$category="Employee";
			$lbl_cat="Emp. no. :";
		} 
	}
	else
	{
		if($_SESSION['cat']=='STUDENT')
		{	$category="Student";
			$lbl_cat="SR No. :";
		} 
		else
		{	$category="Employee";
			$lbl_cat="Emp. no. :";
		}
	}
	
	if($_POST['update']=="Update")
		$enable_disable="";
	else
		$enable_disable="disabled";
	
}

		if($_SESSION['utype']=='A')
		{	
			$sq="select IDSR from reader_mast where lib_reg_no='".$_POST['lib_reg_no']."'";
			$rs=odbc_exec($conn,$sq);
			$v_IDSR=odbc_result($rs,"IDSR");
			
		    $sql="SELECT r.Lib_reg_no, r.cat, r.name, r.design, r.IDSR, r.class, r.Sec, r.f_name, r.add1, 
					u.password, u.phone, u.email, u.usertype FROM reader_mast r, user_mast u 
					where r.lib_reg_no='".$_POST['lib_reg_no']."' and r.IDSR='$v_IDSR' and r.lib_reg_no=u.lib_reg_no" ;
		}
		else
		{
			$sql="SELECT r.Lib_reg_no, r.cat, r.name, r.design, r.IDSR, r.class, r.Sec, r.f_name, r.add1, 
				u.password, u.phone, u.email, u.usertype FROM reader_mast r, user_mast u 
				where r.lib_reg_no='".$_SESSION['id']."' and r.IDSR='".$_SESSION['IDSR']."' and r.lib_reg_no=u.lib_reg_no" ;
		}
		
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
			$v_pass=odbc_result($rs,"password");		
			$v_phone=odbc_result($rs,"phone");	
			$v_email=odbc_result($rs,"email");	
			$v_utype=odbc_result($rs,"usertype");
			
		}
?>



<div align="left" class="div">
<?php if($_SESSION['utype']=='A') $back="lib_reg_list.php";  else $back="account_panel.php"; ?>

<span><a href="<?php echo $back ?>"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
<br>
	<center><div class="h">Library Info System | Update
	<br><small><?php echo $category;?> detail </small>
	
	</div></center>
<br><hr>
	<table width="90%" border="0" cellspacing="5" cellpadding="5" >
   
	
<form name="user_entry" action="user_manager.php?action=update"  onsubmit="return validate_user_entry_form()" method="POST" > 
	
     <tr>   	
    	<td   width="20%" align="left"> <?php echo $category ?>.....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type :</td>
		<td ><?php	if($v_utype=='U') echo "User"; else echo "Administrator";?></td>
		<td width="10%">&nbsp;</td>
		<td width="10%" align="right">Library Reg. No. :</td>	
    	<td width="10%" align="left"><?php echo $v_lib_reg_no;?>
			<input type="hidden" name="lib_reg_no" value="<?php echo $v_lib_reg_no;?> "/>
		</td>
    </tr>
	
<?php 

if($category=='Employee')
  { ?>   
	 <tr>
    	<td width="10%" align="right"><?php echo $lbl_cat; ?></td>	
    	<td width="10%" align="left"><?php echo $v_IDSR;?>
			<input type="hidden" name="IDSR" value="<?php echo $v_IDSR;?>"/>
		</td>
    
        <td width="10%">&nbsp;</td>
		<td align="right">Designation :</td>
		<td><select name="design" size="1"  id="design" value="" accesskey="d" tabindex="0" <?php echo $enable_disable;?>>	  
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

	  <td><select name="stud_class" size="1"  id="stud_class" value="" accesskey="c" tabindex="0"  class="cl_box" <?php echo $enable_disable;?>>	  
  <?php
		$sql="SELECT distinct class_val, class FROM class_mast";
		$rs=odbc_exec($conn,$sql);
		echo "<option value='0'>Passout</option>";
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
	  
	   <td><select name="sec" size="1"  id="sec" value="<?php echo $v_sec;?>" accesskey="s" tabindex="0" class="cl_box" <?php echo $enable_disable;?>>	  
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
          <td align="right"><input type="text" name="name" value="<?php echo $v_name;?>" value size="30"  class="cl_box"  <?php echo $enable_disable;?> ></td>
          <td>&nbsp;</td>
          <td width="15%" align="right">Father's Name :</td>
          <td align="right"><input type="text" name="fname" value="<?php echo $v_fname;?>" value size="30"  class="cl_box" <?php echo $enable_disable;?>></td>
     </tr>
	 <tr>
         <td align="right">Phone :</td>
         <td align="right"><input type="text" name="phone" value="<?php echo $v_phone;?>" value size="30" maxlength="10" class="cl_box" <?php echo $enable_disable;?>></td>
		 <td width="10%">&nbsp;</td>
	     <td align="right">e-mail :</td>
         <td align="right"><input type="text" name="email" value="<?php echo $v_email;?>" value size="30"  class="cl_box" <?php echo $enable_disable;?>></td>
	 </tr>
	 <tr>
        <td align="right"rowspan="2">Address :</td>
        <td align="right"rowspan="2"><textarea name="add" cols="32" rows="4" value=""  class="cl_box" <?php echo $enable_disable;?> ><?php echo $v_add1;?></textarea></td>
		<td>&nbsp;</td>
		
<?php if($_SESSION['utype']=='A')
      {
?>	  
		<td align="right" style="color:#00F">Password :</td>
		<td align="right"><input type="password" name="pass" value="<?php echo $v_pass;?>" value size="30"  class="cl_box" <?php echo $enable_disable;?>></td>
	</tr>
	 <tr><td>&nbsp;</td>
	    <td width="17%" align="right"style="color:#00F">Confirm Password :</td>
        <td align="right"><input type="password" name="conf_pass" value="" value size="30" maxlength="12"  class="cl_box" <?php echo $enable_disable;?>></td>
<?php
} else
{
?>
		<td>&nbsp;</td>
		<td align="right"><input type="hidden" name="pass" value="<?php echo $v_pass;?>"></td>
	</tr>
	 <tr><td>&nbsp;</td>
	    <td width="17%" align="right"style="color:#00F">Password :</td>
        <td align="right"><input type="password" name="conf_pass" value="" value size="30" maxlength="12"  class="cl_box" <?php echo $enable_disable;?>></td>
<?php
}
?>
	</table>  
	
 <input type="hidden" name='cat' value="<?php echo $v_cat ?>">
 <input type="hidden" name="idsr" value="<?php echo $v_IDSR;?>"/>
<br>  <hr>
	  <center>
	  <table border="0" width="70%">
	
         <tr><td width="20%" align="left"><input type="submit" name="save" id="save" value="  Save  " <?php echo $enable_disable;?>/></td>
		 <td width="20%" align="center"><input type="submit" name="update" id="update" value="Update" <?php if($enable_disable=="") echo "disabled" ;?> onclick="make_updatable()"/></td>
</form> 	<td width="20%" align="right">
				<form name="cncl" action="<?php echo $back ?>" method="POST">
					<input type="submit" name="cencel" id="cancel" value="Cancel" />
				</form>
			</td>
		</tr>		

	  </table>	
	    </center>		
       
<hr>
</center></div></center></div>

</body>