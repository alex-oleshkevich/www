
<?php
require_once __DIR__ . "/compat.php";
 
include('head.php');
//info
switch($info):
case (1):$text="Компонент позволяет изменять системные время и дату.";
$fname="DateTime.rar";
$pname="Change Date Time";
break;
case (2):$text="Кнопка запуска программ";
$fname="EXEbutton.rar";
$pname="EXEbutton";
break;
case (3):$text="Вставте URL вашего сайта в вашу программу!";
$fname="Grlink.rar";
$pname="Grlink";
break;
case (4):$text="Кoмпонент сворачивает программу в tray";
$fname="TrayComp.rar";
$pname="TrayComp";
break;
case (5):$text="см. TrayComp";
$fname="TryIcon.rar";
$pname="TryIcon";
break;



case (6):$text="утилита для создания *.bat файлов.(недоделаная beta).";
$fname="MakeBAT.rar";
$pname="MakeBAT";
break;
case (7):$text="	утилита, позволяющая общаться по IP адресу.";
$fname="ns.rar";
$pname="Net Sender";
break;
case (8):$text="	для локальной сети.";
$fname="chat.rar";
$pname="Чат для локальной сети";
break;
case (9):$text="	прикольный flash плеер.";
$fname="CoolFlash.rar";
$pname="Cool Flash";
break;
case (10):$text="	утилита для помещения програм в автозагрузку.";
$fname="rm.rar";
$pname="Red Master";
break;
case (11):$text="	утилита для переименования корзины.";
$fname="re.rar";
$pname="Rename Recicle Bin";
break;
case (12):$text="	\"Достань Витька\", программа-шутка, говорящий компьютер!";
$fname="dv.rar";
$pname="\"Достань Витька\"";
break;
case (13):$text="	еще одна программа-шутка, заменяет помещенный в буфер обнема тест(картинку) на встроенную в программу.";
$fname="ap.rar";
$pname="APClip";
break;
case (14):$text="	утилита, показывает сколько времени запущена Windows.";
$fname="to.rar";
$pname="Time On";
break;
case (15):$text="прога наглядно демонстрирующая работу с реестром.";
$fname="registry.rar";
$pname="Registry";
break;
case (16):$text="	еще одна прога-шутка с выключением монитора и огромной базой данных слов.";
$fname="twm.rar";
$pname="Talk With Me";
break;
case (17):$text="	прожка которая делает скриншоты в формате БМП.";
$fname="ScreenMaker.rar";
$pname="Screen Maker";
break;
case (18):$text="Очередная прога-шутка, на этот раз окрывает/закрывает дисковой привод... Пять минут и твой враг доведен до бешенства:)";
$fname="cd.rar";
$pname="Crazy CD-ROM";
break;

case (19):$text="Этой программой можно переименовать стандартные названия &quot;Моего компьютера&quot;, &quot;Корзины&quot; и т.д во что-нибудь более благозвучное!";
$fname="RenameW.rar";
$pname="Rename Your Windows";
$register=1;
break;
case (20):$text="Отличная вырезалка баннеров и рекламы на интернет-страницах";
$fname="admunch.rar";
$pname="Ad Muncher";
break;

endswitch;
//info end
if(is_file("files/$fname"))
{
$size=filesize("files/$fname")/1000;
$size=explode('.',$size);
if($register!='')
{
$reg="&nbsp;&nbsp;&nbsp;<a href=register.php?action=get>Регистрация!</a>";
}
echo("
<table align=center>
<tr><td width=20%><font color=#101842>Программа:</font></td><td><font color=#101842>$pname $m</font></td><tr>
<tr><td width=20%><font color=#101842>Файл:</font></td><td><font color=#101842>$fname</font></td><tr>
<tr><td width=20%><font color=#101842>Размер:</font></td><td><font color=#101842>");
print "$size[0] Kb";
echo("</font></td><tr>
<tr><td valign=top><font color=#101842>Info:</font></td><td><font color=#101842>$text</font></td><tr>
<tr><td>&nbsp;</td><td><a href=files/$fname>Скачать!</a>$reg</td></tr><tr><td>&nbsp;</td></tr>  </table> ");

if(is_file("img/progs/$pname.gif"))
{
echo(" <table>
<tr><td><img src=\"img/progs/$pname.gif\"></td><td><img src=\"img/progs/$pname 2.gif\"></td></tr>
</table>");
}
else
{
echo("");
}
}
else
{
mail("to_mariner@mail.ru","Site error #1","File $fname not exists");
print "<center><img src='img/error2.gif'> <font size=+1 class=footmenu2>Ошибка!</font></center><br><font color=#101842>Запрошенный файл &nbsp;&nbsp;&nbsp;<font color=red size=3><b>$fname</b>&nbsp;&nbsp;&nbsp;</font> не был найден на сервере.<br>Администратору было выслано сообщение о ошибке...</font>";
}
include('foot.php');
?>
