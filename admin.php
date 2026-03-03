<?
include('head.php');
$log_ip=getenv('REMOTE_ADDR');
$passw='myadmin';
$daten=date('d.m.Y   H:i:s');
if($act=='login')
{
$pass=ereg_replace("<",'',$pass);
$pass=ereg_replace(">",'',$pass);
   if($pass!=$passw)
	{
	echo("
	<form action=admin.php?act=login method=post>
	<table>
	<tr><td>Password:</td><td><input type=password name=pass maxlength=10 width=150></td></tr>
	<tr><td><input type=submit></td></tr>
	</table>
	");
	if($pass=='')
	{
	$pass='<font color=lime>не вводил</font>';
	}
	$fh=fopen("logs/pass.log","a+");
	fwrite($fh,"<tr><td><h5><font color=#329ae7 face=tahoma>admin.php</font></h5></td><td><h5><font face=tahoma>&nbsp; ::: &nbsp;</font></h5></td><td><h5><font face=tahoma>$daten</font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;   <font color=red>$log_ip</font></font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;</font></h5></td><td><h5><font face=tahoma>$pass</font></font></h5></td></tr>\n");
	fclose($fh);
	}
	else
	{
	$log_ip=getenv('REMOTE_ADDR');
	$entered='<font color=lime>вход выполнен</font>';
	$daten=date('d.m.Y   H:i:s');
	$fh=fopen("logs/pass.log","a+");
	fwrite($fh,"<tr><td><h5><font color=#329ae7 face=tahoma>admin.php</font></h5></td><td><h5><font face=tahoma>&nbsp; ::: &nbsp;</font></h5></td><td><h5><font face=tahoma>$daten</font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;   <font color=red>$log_ip</font></font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;</font></h5></td><td><h5><font face=tahoma>$entered</font></font></h5></td></tr>\n");
	fclose($fh);
//vars
$file="question/qst.php";
$text=join('',file($file));
$log_file=file('logs/user.log');


echo("<table>
<tr><td valign=top><b>Новые вопросы:</b>
&nbsp;&nbsp;&nbsp;
<a href=admin.php?act=edit&fname=question/qst.php>Править&nbsp;вопросы</a></td></tr>
<tr><td>$text</td></tr>
</table><br><br><br><br>
<table>
<tr><td valign=top>
<FORM >
<INPUT TYPE=button NAME=Button1 VALUE=Лог&nbsp;посещений   onClick=\"window.open ('logs/logs.php?id=user&label=Лог&nbsp;посещений', 'newWin','scrollbars=yes,status=no,width=750,height=400,resizable=no')\">
</FORM>
</td></tr>
<tr><td>
<FORM >
<INPUT TYPE=button NAME=Button1 VALUE=Лог&nbsp;паролей   onClick=\"window.open ('logs/logs.php?id=pass&label=Подбор&nbsp;паролей', 'newWin','scrollbars=yes,status=no,width=700,height=400,resizable=no')\">
</FORM>
</td></tr>
<tr><td>

</td></tr>
</table>
<table>
<tr><a href=?act=edit&fname=menu.php>Изменить меню</a></tr>
<tr><a href=?act=edit&fname=main.css>Изменить CSS</a></tr>
<tr><a href=?act=edit&fname=logs/bans.txt>Изменить бан-лист</a></tr>
<tr><a href=?act=edit&fname=logs/nick.txt>Изменить ник-лист</a></tr>

</table>
");
}
}
if($act=='clear')
{
$fh=fopen("logs/$fname.log","w");
fwrite($fh,'');
fclose($fh);
print "
<script>
alert('Файл $fname.log очищен');
window.close()
</script>
";
}

if($act=='edit')
{
$fname2=join('',file($fname));

echo("<form action=?act=write method=post>
<table>
<tr><td>
<textarea name=text cols=80 rows=20>$fname2</textarea>
</td></tr>
<tr><td><input type=submit value=Править></td></tr>
<tr><td><input type=hidden value=$fname name=hid></td></tr>
</table>");
}

if($act=='write')
{
$fh=fopen($hid,"w");
fwrite($fh,$text);
fclose($fh);
print "<script>
alert('Изменения приняты');
window.location.href=history.go(-2);
</script> ";
}
include('foot.php');
?>