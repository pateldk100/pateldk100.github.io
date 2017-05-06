<html>
<title>Library Management System | View Review </title>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" >
<style type="text/css">
.div_s{border:solid 2px #999; background:#FBFBFB; color:#000000; size="19" padding:2px; width:90%; overflow:auto;}
<!--
.cell {
	text-align: left;

	color: #0080C0;
	font-weight:bold;
}
.cell_1 {
	text-align: left;

	color: #FD722F;
	font-weight:bold;
}

.div_sz {
	font-size: 16px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<body>

<?php include ("header.php");
	
if(isset($_POST['back']))
	$back=$_POST['back'];
else
	$back="index.php";

if(isset($_POST['book_id']))
	$book_id=$_POST['book_id'];
	
	
	$sql="select accno, lib_reg_no, review_id, review_date, name, design_class 
			from review_mast where accno='$book_id' order by review_date desc";
	$rs=odbc_exec($conn, $sql);

	
	$sql2="select book_title, author, publisher from book_mast where accno='$book_id'";
	$rs2=odbc_exec($conn, $sql2);
	$rec2=odbc_fetch_array($rs2);
	
	$i=0;	
?>



	<div align="left" class="div">
	<span><a href="index.php"><img src="images/close.png" alt="Close" width="16" height="16" border="0" align="right" /></a></span>
	<br>
	
	<form name="list" action="<?php echo $back ?>" method="POST">	
		<center><span class="h">Library Info System | Book Reviews</span>
		<p>
		<?php echo "<span style='color:red'>Book Name : </span><span style='color:blue'> ".$rec2['book_title']."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span style='color:red'>Author : </span><span style='color:blue'>".$rec2['author']."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span style='color:red'>Publisher :<span><span style='color:blue'> ".$rec2['publisher']."</span>"; 
		?>
		<hr>
		<div style="color:Red; padding:2px; width: 90%; height:360px; overflow:auto;">
<?php	

		while($rec=odbc_fetch_array($rs))
		{
?>			
			<p align="left">
			<div style="text-align: left; color:#3FF; padding:2px; width: 90%; background:#999; overflow:auto;">
				<?php echo ($i+1).".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
				<a href='#' id='showid<?php echo $i ?>' ><strong><?php echo $rec['name']."    [ ".$rec['design_class']." ]" ?></strong> <?php echo "  reviewed on dated ".date("d-m-Y",strtotime($rec['review_date']))?></a>
			</div>
			
			<div align="left" class="div_s" id = "id<?php echo $i ?>" style='display:none'>   
			<span class="div_sz">
			<?php $source="bookreview\\".$rec['review_id']; 
				  show_source($source); 
			?> 
			</span>
			</div>
			
<?php	
		$i++;
		}
?>
		</div>
<hr>		
<input type="submit" name="cancel_btn" value="  Cancel  ">
</form>
<script type='text/javascript'>
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
 
   if(this.elemIdx == i)
   {
       if(elems[ i ].style.display == "block") 
        elems[ i ].style.display = "none";
      else 
        elems[ i ].style.display = "block";
   }
 //  else
  // elems[ i ].style.display = "none";
     return false; 
 }
 
 function $( id ){ return document.getElementById( id ); }  
  
}
ShowOne( 'showid', 'id');


</script>
	

</body>
</html>