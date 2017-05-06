
 <?php
	include("header.php");
	include('conn.php');
	include("cross_browser_marquee.js");
?>
<body>
<?php

$i=1;
	$sql="SELECT * FROM news_mast order by id desc";
	$rs=odbc_exec($conn,$sql);
	
	while($rec=odbc_fetch_array($rs))
	{ 
	   $news[$i]=$rec['news'];
	   $i++;

	}

?>
<div align="center" style="border:solid 2px #F7F7F7; padding:0px; width:100%; height:520px; overflow:auto; position: absolute; top: 12.5%; left: 1%;">
<?php
include("Glowing_text.dll");
include("text_image_scroll.dll");
?>


<body>

<div align="left" id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
<div id="vmarquee" style="position: absolute; width: 100%;">

<!--YOUR SCROLL CONTENT HERE-->
<span style="color:#0C0; font-size:16px; font-weight: bold;" >Library News........</span>

<?php 	for($i=1; $i<=count($news); $i++)
		{ 
				echo "<ul><li>$news[$i]</li></ul>";
	}?>

<!--YOUR SCROLL CONTENT HERE-->

</div>
</div>
</div>
</body>
</html>