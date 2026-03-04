<?php
require_once __DIR__ . "/compat.php";
 
include('head.php');
if($id=='')
{
print "<h4 align=center><font color=#101842>Pascal FAQ</font></h4>";
include('inc/pascalart.php');
}

if($id!='')
{
 include("article/pascal-$id.htm");
}


include('foot.php');
?>