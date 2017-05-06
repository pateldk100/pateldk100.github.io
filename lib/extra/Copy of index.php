  <?php
	include("header.php");
	include('conn.php');
?>
<body>
<?php

$i=1;
	$sql="SELECT * FROM news_mast order by id desc";
	$rs=odbc_exec($conn,$sql);
	
	while(odbc_fetch_row($rs))
	{ 
	   $news[$i]=odbc_result($rs,"news");
	   $i++;

	}

?>
<link rel="stylesheet" type="text/css" href="style.css">

<div align="center" style="border:solid 2px #F7F7F7; background: #69F; padding:0px; width:101%; height:520px; overflow:auto; position: absolute; top: 12.5%;  left: 0%; background-color: #E4E4E4;">

<marquee align="left" height="80" direction="up" scrolldelay="250" onMouseOver="stop"  class="cl_marquee">
&nbsp;&nbsp;Welcome<br>


<?php
	for($i=1; $i<=count($news); $i++)
	{ echo "<ul><li>$news[$i]</li></ul>";
	}
?>

</marquee>
</div>

<style type="text/css">
<!--
.cl_marquee {
	//font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	counter-reset:auto;
	font-size:12px;
	color: #F00;
-->
</style>
</body>
</html>