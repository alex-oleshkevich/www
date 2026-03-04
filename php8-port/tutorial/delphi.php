<?php
require_once __DIR__ . "/compat.php";
 
include('../config.php');
include('../head.php');
if($tut==''&$go==''&$page=='')
{
echo("
<table>
<tr><td><a href='?go=1'>Учебник программирования на делфи</a></td><td><a href=?tut=1>Описание</a></td></tr>
</table>
");
}

if($tut!='')
{
 switch($tut):
 case(1):$fname='1/about.php';
 break;
 endswitch;
 include($fname);
}

if($go!='')
{
 switch($go):
 case(1):$fname='1/start.htm';
 break;
 endswitch;
 include($fname);
}

if($page!='')
{
 include("1/$page.htm");
}
include('../foot.php');
?>