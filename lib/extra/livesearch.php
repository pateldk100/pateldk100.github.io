<?php
	include('conn.php');

//$xmlDoc=new DOMDocument();
//$xmlDoc->load("links.xml");

//$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];


	$sql="SELECT book_title FROM system_mast where book_mast='".$q;
	$rs=odbc_exec($conn,$sql);
	
	/*while(odbc_fetch_row($rs))
	{ 
	   $school_name=odbc_result($rs,"School_name");
	   $add1=odbc_result($rs,"Add1");
	   $add2=odbc_result($rs,"Add2");
	}	
  */

echo $q;


//lookup all links from the xml file if length of q>0
if (strlen($q)>0)
{
$hint="";
for($i=0; $i<($x->length); $i++)
  {
  $y=$rs->item($i)->getElementsByTagName('book_title');
  //$z=$x->item($i)->getElementsByTagName('url');
  if ($y->item(0)->nodeType==1)
    {
    //find a link matching the search text
    if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
      {
      if ($hint=="")
        {
        $hint="<a href='" . 
        $z->item(0)->childNodes->item(0)->nodeValue . 
        "' target='_blank'>" . 
        $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      else
        {
        $hint=$hint . "<br /><a href='" . 
        $z->item(0)->childNodes->item(0)->nodeValue . 
        "' target='_blank'>" . 
        $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint=="")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?> 
