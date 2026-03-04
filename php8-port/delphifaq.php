<?php
require_once __DIR__ . "/compat.php";
 
$max_mes=30;
$fdata='inc/delphiart.php';
include('head.php');
if($id=='')
{
print "<h4 align=center><font color=#101842>Delphi FAQ</font></h4>";
$other=file("$fdata");
$other=array_reverse($other);

//get size of array
if(sizeof($other)>$max_mes)
{
$size=sizeof($other);
$pages=$size/$max_mes;
for($a=1;$a<$pages;$a++)
	{
    if($pages>1)
    {
	print"<a href=delphifaq.php> Главная </a>";
    print "<a href=?page=1> $a </a>";
    $a++;
    }
    print "<a href=?page=$a> $a </a>";
	}
}
print "<br><br>";

//no pagging
if($page=='')
{
for ($i=1;$i<$max_mes;$i++)
{
echo("
<table><tr><td>$other[$i]</td></tr></table>
");
}
}

if($page!='')
{
$page=$max_mes*$page;
$rpage=$page+$max_mes;
for($i=$page;$i<$rpage;$i++)
{
 echo("<table><tr><td>$other[$i]</td></tr></table>");
}
}
}

if($id!='')
{
 include("article/delphi-$id.htm");
}


include('foot.php');
?>