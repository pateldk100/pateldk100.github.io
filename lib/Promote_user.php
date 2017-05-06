<html xmlns="http://www.w3.org/1999/xhtml">
<title>Library Management System | Sign-up </title>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<?php include ("header.php");

if(isset($_POST['promote']) && $_POST['promote']=="Promote")
{
	$sql="update reader_mast set class=val(class)+1 where class is not null and class <>'0'";
	$rs=odbc_exec($conn, $sql) or die("Sorry! unable to perform");

	if($rs)
	{	$sql1="update reader_mast set class=0 where class=(select max(class_val)+1 from class_mast)";
		$rs1=odbc_exec($conn, $sql1) or die("Sorry! unable to perform");
		
		$sql2="update user_mast set active_deactive=0 where lib_reg_no in(select lib_reg_no from reader_mast where class='0')";
		$rs2=odbc_exec($conn, $sql2) or die("Sorry! unable to perform");

		$sql3="update promotion set promotion_date=date(), promoted_by='".$_SESSION['name']."'";
		$rs2=odbc_exec($conn, $sql3) or die("Sorry! unable to perform");	
		
	}
	if($rs && $rs1 & $rs2)
		echo "<script>alert('Students promoted and deactivated successfully');</script>";
	else
		echo "Error......while promotion";
}	

if(isset($_POST['del_passouts']) && $_POST['del_passouts']=="Delete Pass-outs")
{
	$cnt1="select count(*) as before from reader_mast where class='0'";
	$r1=odbc_exec($conn, $cnt1) or die("Sorry! unable to perform");
	$count1=odbc_fetch_array($r1);
	
	$sql="delete from user_mast where lib_reg_no in (select lib_reg_no from reader_mast where class='0') and lib_reg_no not in (select lib_reg_no from issue_mast where issued=1)";
	$rs=odbc_exec($conn, $sql) or die("Sorry! unable to perform");

	$sql2="delete from reader_mast where class='0' and lib_reg_no not in (select lib_reg_no from issue_mast where issued=1)";
	$rs2=odbc_exec($conn, $sql2) or die("Sorry! unable to perform");

	
	$cnt2="select count(*) as after from reader_mast where class='0' and lib_reg_no in (select lib_reg_no from issue_mast where issued=1)";
	$r=odbc_exec($conn, $cnt2) or die("Sorry! unable to perform");
	$count2=odbc_fetch_array($r);

	
	if($rs && $rs2)
	{	$msg=$count1['before']-$count2['after']."/".$count1['before']." Pass-outs deleted successfully....... and ".$count2['after']."/".$count1['before']." remains due to some dues.";
		echo "<script>alert('$msg');</script>";
	}
	else
		echo "<script>alert('Unable to delete Pass-outs');</script>";
}		
	
	
?>

<div align="center" class="div">
<span><a href="index.php"><img src="images/close.png" alt="close" width="16" height="16" border="0" align="right" /></a></span>

<form name="promote_user" method="POST" onsubmit="return check_form()">  
<br>
	<center><div class="h">Library Info System | Promotion</div></center>
<br><br>
<div align="center" style="border:solid 2px #999; background:#F4F4F4; color:red; padding:2px;	width:50%;  overflow:auto;">
<br><br>
<?php 
	$sql="select session_ from system_mast";
	$rs=odbc_exec($conn, $sql) or die("Sorry! unable to perform");
	$rec=odbc_fetch_array($rs);

	$sql2="select year(promotion_date) as promotion_year, promotion_date, promoted_by  from promotion";
	$rs2=odbc_exec($conn, $sql2) or die("Sorry! unable to perform");
	$rec2=odbc_fetch_array($rs2);

	if($rec2['promotion_year']< substr($rec['session_'],0,4))
	{	
		if(date('m')>=4)
			echo "<strong><big><div style='color:green'>Welcome .....<br><br>Promote to Library users in next session ".$rec['session_']."</div>";
		else
			echo "<div>Sorry !.....\n this is not a correct time to promote</div>";	
			
		echo "<br><br><input type='submit' name='promote' value='Promote'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type='button' name='cancel' value='Cancel' onclick='cancel_form()'>";
	}
	else
	{	echo "<div><strong>Last promoted on ".date("M d 'Y",strtotime($rec2['promotion_date']))." by ".$rec2['promoted_by']."</strong></div>";	

		$sql4="select count(*) as count_passouts from reader_mast where class='0'";
		$rs4=odbc_exec($conn, $sql4) or die("Sorry! unable to perform");
		$rec4=odbc_fetch_array($rs4);	
		
		if($rec4['count_passouts']>0)
		{	$act_btn="";
			
			echo "<br>Delete Pass-outs from Library";
		}		
		else
			$act_btn="disabled";
		
		echo "<br><br><br><input type='submit' name='del_passouts' value='Delete Pass-outs' onclick='del_passouts()' ".$act_btn." >";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' name='cancel' value='Cancel' onclick='cancel_form()'>";
		
	}	
	
		$sql6="select lib_reg_no, idsr, name, sec from reader_mast where class='0'";
		$rs6=odbc_exec($conn, $sql6) or die("Sorry! unable to perform");
		$rec6=odbc_fetch_array($rs6);
		if(strlen($rec6['lib_reg_no'])>0)
		{
?>
		<hr><br>Passout List to be removed
		<table cellpadding="0" cellspacing="0">
		<tr style="background:gray">
			<th align='left' width='3%'>Sl</th>
			<th width="10%" align='left' >Lib.Reg.No.</th>
			<th width="10%" align='left'>Admn. no.</th>
			<th width="20%" align='left'>Name</th>
			<th width="10%" align='left'>Section</th>
			<th width="10%" align='left'>status</th>
		</tr>
<?php 		
		$i=0;
			do
			{ $i++;
			echo "<tr><td width='3%' align='left'>".$i."</td>";
			echo "<td width='10%' align='left'>".$rec6['lib_reg_no']."</td>";	
			echo "<td width='10%' align='left'>".$rec6['idsr']."</td>";
			echo "<td width='10%' align='left'>".$rec6['name']."</td>";
			echo "<td width='10%' align='left'>".$rec6['sec']."</td>";
			echo "<td width='10%' align='left'>Passout</td></tr>";
			}while($rec6=odbc_fetch_array($rs6));
		}
?>
		</table>	
			
	

<script type='text/javascript'>
function cancel_form()
{
	window.location.href="cpanel.php";
}


function check_form()
{ 
	if(document.promote_user.promote.value=="Promote")
		if(confirm("I am going to promote all the users to NEXT CLASS and CLASS XII student will be deactivated autometically")!=1)
			return false;
	
	if(document.promote_user.del_passouts.value=="Delete Pass-outs")
		if(confirm("Deleting all Pass-outs...........You must revert failiours before continue")!=1)
			return false;
	
}

</script>

</body>
</html>