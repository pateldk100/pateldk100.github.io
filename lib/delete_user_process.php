<?php
include("header.php");

if($_POST['delete']=='Delete')
{
	echo "<br><br>";
	echo "<div align='center' class='div' >";
	echo "<span><a href='cpanel.php'><img src='images/close.png' alt='Close' width='16' height='16' border='0' align='right' /></a></span><br>";
echo "<div class='h'>DELETION STATUS</div>";
	echo "<table border='1' width='60%' cellspacing='0' cellpadding='5' >";
		echo "<tr style='background:blue'><td style='color=white'>Sl.no.</td>";
			echo "<td width='40%' style='color=white'>Name</td>";
			echo "<td width='20%' style='color=white'>Design/Class</td>";
			echo "<td width='20%' style='color=white'>Action</td>";
			echo "<td width='10%' style='color=white'>Resion</td>";
		echo "</tr>";
	$i=0; $count=0;
	foreach ($_POST['lib_reg_no'] as $lib_reg_no)
	{	$i++;
		$s="select name, design, class, sec from reader_mast where lib_reg_no='$lib_reg_no'";
		$rs1=odbc_exec($conn,$s);
		$rec1=odbc_fetch_array($rs1);	

		$sql="select count(*) as chkissue from issue_mast where lib_reg_no='$lib_reg_no' and issued=1";
		$rs=odbc_exec($conn,$sql);
		$rec=odbc_fetch_array($rs);

		
		if($rec['chkissue']>0)
		{
			$s="select name, design, class, sec from reader_mast where lib_reg_no='$lib_reg_no'";
			$rs1=odbc_exec($conn,$s);
			$rec1=odbc_fetch_array($rs1);	
			
			echo "<tr style='background:#FCC'><td>".$i."</td>";
			echo "<td width='40%'>".$rec1['name']."</td>";
			echo "<td width='20%'>".$rec1['design'].$rec1['class']." ".$rec1['sec']."</td>";
			echo "<td width='20%'>Not Deleted</td>";
			echo "<td width='10%'>Dues</td>";
			echo "</tr>";
		}
		else
		{	$sql="delete from user_mast where lib_reg_no='$lib_reg_no'";
			$rs=odbc_exec($conn,$sql) or die("Sorry!  Unable to delete........");
			
			$sql="delete from reader_mast where lib_reg_no='$lib_reg_no'";
			$rs=odbc_exec($conn,$sql) or die("Sorry!  Unable to delete........");
			echo "<tr style='background:#CFC'><td>".$i."</td>";
			echo "<td width='40%' style='color:red'>".$rec1['name']."</td>";
			echo "<td width='20%' style='color:red'>".$rec1['design'].$rec1['class']." ".$rec1['sec']."</td>";
			echo "<td width='20%' style='color:red'>Deleted</td>";
			echo "<td width='10%'>&nbsp;</td>";
			echo "</tr>";
			$count++;
		}	
	}
	echo "</table>";
	echo "Total deleted : ".$count;

	echo "<big><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='delete_user.php'>Return</a>";
	echo "</div>";
}
?>