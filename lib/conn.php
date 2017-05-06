<?php
$database_tds=getcwd()."\lib.dll"; 
$username_tds=""; 
$password_tds="lib13574";

$conn = odbc_connect("Driver={Microsoft Access Driver (*.mdb)};Dbq=$database_tds", $username_tds,$password_tds);

?>