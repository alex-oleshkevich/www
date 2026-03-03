<?
include('head.php');
include('config.php');
if($act=='')
{
 $data=date('d m Y');
 print "$data";
}

if($act=='addform'&$pass!=$addpass)
{
echo('
<form method=post action?act=addform>
<table>
<tr><input type=password name=pass></tr>
</table>
</form>
');
}

if($act=='addform'&$pass==$addpass)   
{
echo("<form action='?act=add' method=post>
<table>
<tr><td valign=top class=footmenu2>Тема:</td><td><input type=text name=topic></td></tr>
<tr><td valign=top class=footmenu2>Автор:</td><td><input type=text name=author></td></tr>
<tr><td valign=top class=footmenu2>Статья:</td><td><textarea name=text cols=80 rows=40></textarea></td></tr>
<tr><td><select name=faq id=faq>
  <option value=inc/delphiart.php>FAQ - Delphi</option>
  <option value=inc/pascalart.php>FAQ - Pascal</option>
  </select></td><td><input type=submit value=Добавить></td></tr>

</table>

</form>");
}

if($act=='add')
{
if($faq=='inc/delphiart.php')
{
 $razdel='delphi-';
 $faq2='delphifaq.php';
}
else
{
 $razdel='pascal-';
 $faq2='pascalfaq.php';

}
	$text=ereg_replace("<","&lt;",$text);
    $text=ereg_replace(">","&gt;",$text);
	$text=ereg_replace("\n","<br>",$text);
$rdata=date('d.m.Y  h:i');
$data=date('dmhis');
 $fh=fopen("article/$razdel$data.htm","w");
 fwrite($fh,"  <h5 align=center><font size=+1 class=footmenu2>$topic</font></h5><br> <font color=black>$text</font><br> <h5><font class=footmenu2>Автор: <i>$author</i></font>&nbsp;&nbsp;&nbsp;<font class=footmenu2>Добавлено: $rdata</font></h5>\n");
  fclose($fh);
$fh2=fopen($faq,'a+');
fwrite($fh2,"&nbsp;&nbsp;&nbsp;<a href=$faq2?id=$data>$topic</a><br>\n\n");
fclose($fh2);
print "Статья добавлена.<br><a href=javascript:history.back()>Назад</a>";
}
include('foot.php');
?>