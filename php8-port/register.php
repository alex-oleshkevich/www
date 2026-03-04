<?php
require_once __DIR__ . "/compat.php";
 
include('head.php');
if ($action==get)
{
echo("
<table align=center>
<tr><form action=register.php?action=done></tr>
<tr><td class=footmenu2>Ваше имя :</td><td><input type=text name=name  style=\"border-style:solid;border-color:#000000;border-width: 1px;background: #ffffff;\"><br></td></tr>
<tr><td class=footmenu2>Ваш ID:</td><td><input type=text name=id  style=\"border-style:solid;border-color:#000000;border-width: 1px;background: #ffffff;\"><br></td></tr>
<tr><td><input type=submit value=Go! style=\"border-style:solid;border-color:#000000;border-width: 1px;background: #ffffff;\"></td></tr>
<tr></form></tr>
</table>
");
}
else
if($action=done)
{
        if(($id=='')or($name=='')){
        die("Заполните все графы!");
        }
$reg=((($id*19)+545485)*2)+1;

        $fname = "pages/user.txt";
        $f = fopen($fname, "a+");
        fwrite($f,"$name\n"."$id\n\n");
        fclose($f);
print ("<table><tr>");
print ("<td class=footmenu2>Ваш ID:</td><td class=footmenu2> &nbsp;&nbsp;&nbsp;&nbsp;$id</td></tr>");
print "<tr><td class=footmenu2>Ваш регистрационный ключ:</td><td class=footmenu2>&nbsp;&nbsp;&nbsp;<b> $reg</b></td>";
print ("</tr></table>");
}
include('foot.php');
?>