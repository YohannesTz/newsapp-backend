<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "id12998440_yohannes";
 $dbpass = "#kanatime";
 $db = "id12998440_news";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
{
 $conn -> close();
}
   
?>