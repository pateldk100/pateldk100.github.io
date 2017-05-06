<?php
//session_start();

include("conn.php");
include("header.php");

/*
if(isset($_POST['design']))
	$design=$_POST['design'];
else
	$design=" ";

if(isset($_POST['stud_class']))
	$stud_class=$_POST['stud_class'];
else
	$stud_class=" ";

if(isset($_POST['sec']))
	$sec=$_POST['sec'];
else
	$sec=" ";
*/	
if(isset($_POST['cat']) && $_POST['cat']=="EMPLOYEE")
{
	$design=$_POST['design'];
	$stud_class=" ";
	$sec=" ";
}
else
{
	$stud_class=$_POST['stud_class'];
	$sec=$_POST['sec'];
	$design=" ";
}
	
if(isset($_POST['idsr']) && $_GET['action']=="create")
{
  $chk="select count(*) from reader_mast where idsr='".$_POST['idsr']."'";
  $chkrs=odbc_exec($conn,$chk);
  if(odbc_result($chkrs,"Expr1000")==0)
  {
	$res=create_user($_POST['lib_reg_no'], $_POST['cat'], $_POST['name'], $design, $_POST['idsr'],  $stud_class, $sec, $_POST['fname'], $_POST['add'], $_POST['pass'], $_POST['phone'], $_POST['email'], $_POST['utype'], $conn);
		if($res)
		{ 	echo "<script>javascript: alert('User created Successfull........');</script>";  
			echo "<script>window.location.href='index.php'</script>";
		}	
		else
		{
			$sql3="delete from reader_mast where lib_reg_no='".$_POST['lib_reg_no']."'";
			odbc_exec($conn,$sql3);
			$sql4="delete from user_mast where lib_reg_no='".$_POST['lib_reg_no']."'";
			odbc_exec($conn,$sql4);
			echo "<script>javascript: alert('Sorry! ....Unable to create user........');</script>";
		}
  }
  else
  {
    echo "<script>javascript: alert('Sorry! User already exist........');</script>";
	echo "<script>window.location.href='index.php'</script>";	
  }	  
}
else if(isset($_POST['idsr']) && $_GET['action']=="update")
{
	$res=update_user( $_POST['lib_reg_no'], $_POST['name'], $_POST['idsr'], $design, $stud_class, $sec, $_POST['fname'], $_POST['add'], $_POST['pass'], $_POST['phone'], $_POST['email'], $conn);
	
	if($res)
		{ 	echo "<script>javascript: alert('User updated Successfull........');</script>";  
			
			if($_SESSION['utype']=='A')
			   echo "<script>window.location.href='lib_reg_list.php'</script>";
			else   
				echo "<script>window.location.href='account_panel.php'</script>";
		}	
		else
			echo "<script>javascript: alert('Sorry! ....Unable to update........');</script>";
}

else if(isset($_POST['idsr']) && $_GET['action']=="update2")
{
	$res=update_created_user($_POST['lib_reg_no'], $_POST['cat'], $_POST['name'], $design, $_POST['idsr'],  $stud_class, $sec, $_POST['fname'], $_POST['add'], $_POST['pass'], $_POST['phone'], $_POST['email'], $_POST['utype'], $conn);
	
	if($res)
		{ 	echo "<script>javascript: alert('User updated Successfull........');</script>";  
			
			echo "<script>window.location.href='index.php'</script>";
		}	
		else
			echo "<script>javascript: alert('Sorry! ....Unable to update........');</script>";
}



function create_user($reg_no, $cat, $name, $design, $idsr, $stud_class, $sec, $fname, $add, $pass, $phone, $email, $utype, $conn) 
{

		$sql="insert into reader_mast(Lib_reg_no, cat, name, design, IDSR, class, Sec, f_name, add1)
			values(ucase('$reg_no'), '$cat', ucase('$name'), '$design', '$idsr', '$stud_class', '$sec', ucase('$fname'), ucase('$add'))";
		$rs=odbc_exec($conn,$sql) or die("Unable to create......");	
		
		$reg_date=date('Y-m-d');
		
		$sql2="insert into user_mast(lib_reg_no, password, phone, email, reg_date, Active_deactive, usertype)
			values(ucase('$reg_no'), '$pass', '$phone', '$email', '$reg_date', 0, '$utype')";
		$rs2=odbc_exec($conn,$sql2) or die("Unable to create......");	
			
		if($rs && $rs2)
			return 1;
		else
			return 0;
					
}

function update_user($lib_reg_no, $name, $idsr, $design, $stud_class, $sec, $fname, $add, $pass, $phone, $email,  $conn)
{	
			$sql="update reader_mast set name=ucase('$name'), design='$design', class='$stud_class', sec='$sec', f_name=ucase('$fname'), add1=ucase('$add') 
				where lib_reg_no='$lib_reg_no' and IDSR='$idsr'";
			
			$rs=odbc_exec($conn,$sql) or die("Unable to update......");
		
			$sql="update user_mast set phone='$phone', email='$email' where lib_reg_no='$lib_reg_no'"; 
			$rs=odbc_exec($conn,$sql) or die("Unable to update......");

		return $rs; 
	
}


function update_created_user($reg_no, $cat, $name, $design, $IDSR, $stud_class, $sec, $fname, $add, $pass, $phone, $email, $utype, $conn) 
{

		$sql="update reader_mast set name=ucase('$name'), design='$design', class='$stud_class', sec='$sec', f_name=ucase('$fname'), add1=ucase('$add') 
				where lib_reg_no='$reg_no' and IDSR='$IDSR'";
			
			$rs=odbc_exec($conn,$sql) or die("Unable to update......");
		
		
		//$reg_date=date('Y-m-d');
		
		$sql2="insert into user_mast(lib_reg_no, password, phone, email, reg_date, Active_deactive, usertype)
			values(ucase('$reg_no'), '$pass', '$phone', '$email',  date(), 0, '$utype')";
		$rs2=odbc_exec($conn,$sql2) or die("Unable to update......");	
			
		if($rs && $rs2)
			return 1;
		else
			return 0;
					
}

/*
function delete_user($conn)
{
	$rs=odbc_exec($conn,"delete from user_mast where lib_reg_no='E10001'");
	return $rs;
			
}	
	*/	

?> 
