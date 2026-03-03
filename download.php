<?
include('head.php');
if($id=='')
{
echo("
<table width=100% border=0 align=center>
  <tr>
    <td width=5%>&nbsp;</td>
    <td width=95%><a href=?id=component>Компоненты</a></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href=?id=our>Наши разработки</a></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href=?id=soft>Софт. Наш и не только.</a></font></td>
  </tr>
</table>");
}
else
{
 include("inc/$id.php");
}
include('foot.php');
?>