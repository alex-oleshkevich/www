<?php
require_once __DIR__ . "/compat.php";

include('count.php');
$data=date('dmy');

$mypage = basename($PHP_SELF);
include "acounter.php";
$ani_counter = new acounter();
echo $ani_counter->create_output();



include('config.php');
/*--- Переменные для скрипта ---*/
$password="addnew";
$data="new.dat";
$news_num=5;

$passwd=ereg_replace("<",'',$passwd);
$passwd=ereg_replace(">",'',$passwd);
/*------------------------------*/

/*--- Режим администрирования ---*/
if($action=='admin')
{
  if($passwd==$password)
  {
    echo("
         <center><font size=+1>
         <a href=news.php?action=add&passwd=$password><font>Добавить новость</font></a><br>
         <a href=news.php?action=delete&passwd=$password><font>Удалить новость</font></a><br>
         <a href=index.php><font>Просмотреть последние новости</font></a><br>
         <a href=index.php?action=arc><font>Просмотреть архив новостей</font></a><br>
         </font><p><hr size=1 color=black></center>
         ");
    $log_ip=getenv('REMOTE_ADDR');
	$entered='<font color=lime>вход выполнен</font>';
	$daten=date('d.m.Y   H:i:s');
	$fh=fopen("logs/pass.log","a+");
	fwrite($fh,"<tr><td><h5><font color=#329ae7 face=tahoma>index.php</font></h5></td><td><h5><font face=tahoma>&nbsp; ::: &nbsp;</font></h5></td><td><h5><font face=tahoma>$daten</font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;   <font color=red>$log_ip</font></font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;</font></h5></td><td><h5><font face=tahoma>$entered</font></font></h5></td></tr>\n");
	fclose($fh);
  }
  else
  {
    echo("
          <center>
          <form action=index.php?action=admin method=post>
          <font color=black>Введите пароль:</font> <input type=password name=passwd maxlength=10>
          <input type=submit value=Отправить>
          </form>
          </center><p><hr size=1 color=black>
          ");
	if($passwd=='')
	{
	$passwd='<font color=lime>не вводил</font>';
	}
	$log_ip=getenv('REMOTE_ADDR');
	$daten=date('d.m.Y   H:i:s');
	$fh=fopen("logs/pass.log","a+");
	fwrite($fh,"<tr><td><h5><font color=#329ae7 face=tahoma>index.php</font></h5></td><td><h5><font face=tahoma>&nbsp; ::: &nbsp;</font></h5></td><td><h5><font face=tahoma>$daten</font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;   <font color=red>$log_ip</font></font></h5></td><td><h5><font face=tahoma>&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;</font></h5></td><td><h5><font face=tahoma>$passwd</font></font></h5></td></tr>\n");
	fclose($fh);
	}
}
/*--- Добавление новости ---*/
else if($action=="add" & $passwd==$password)
{
  echo("
        <center>
        <form action=index.php?action=done method=post>
        <table>
        <tr><td>Тема:</td><td><input type=text name=topic size=50 maxlength=255></td></tr>
        <tr><td>Ваше Имя:  </td><td><input type=text name=name size=50 maxlength=50></td></tr>
        <tr><td>Email:  </td><td><input type=text name=email size=50 maxlength=50></td></tr>
        </table>
        Сообщение:<br><textarea name=body rows=10 cols=50 wrap=virtual></textarea><br><br>
        <input type=hidden name=passwd value=\"$password\">
        <input type=submit value=Отправить>
        </form>
        </center>
       ");
  echo("<hr size=1 color=black><a href=index.php>[Просмотр]</a> <a href=index.php?action=admin&passwd=$password>[Администрирование]</a>");
}
/*--- Удаление новостей ---*/
else if($action=="delete" & $passwd==$password)
{
  $file=$data;
  $content=file($file);
  $content=array_reverse($content);
  for($i=0; $i<sizeof($content); $i++)
   echo("$content[$i]<p><a href=index.php?action=done&item=$i&passwd=$password>[Удалить]</a><hr size=1 color=black>");
  echo("<a href=index.php>[Просмотр]</a> <a href=index.php?action=admin&passwd=$password>[Администрирование]</a>");
}
/*--- Обработка результатов ---*/
else if($action=="done" & $passwd==$password)
{
  if($item!=NULL)
  {
    $file=$data;
    $content=file($file);
    $element_to_dell=sizeof($content)-$item-1;
    unset($content[$element_to_dell]);
    for($i=0; $i<sizeof($content); $i++) $content[$i]=chop($content[$i]);
    $content=implode("\n", $content);
    $content=$content."\n";
    $file=fopen($data, "w");
    fwrite($file, $content);
    fclose($file);
    echo("<b>Новость удалена.</b>");
  }
  else
  {
    $date=date("d/m/Y h:i ");
    $body=ereg_replace("\n", "<br>", $body);
    $message="<table border=0 width=100% cellspacing=0 cellpadding=1 align=center><tr><td class=big width=50%>:: $topic</td><td class=infohead width=50% align=right>Добавлено $date </td></tr><tr valign=top><td colspan=2 class=content><p>$body</p><p>&nbsp;</p></td></tr></table>";
    $message=stripslashes($message);
    $file = fopen($data, "a+");
    fwrite($file, "$message<br> \n");
    fclose($file);
    echo $message;
  }
  echo("<hr size=1 color=black><a href=index.php>[Просмотр]</a> <a href=index.php?action=admin&passwd=$password>[Администрирование]</a>");
}
/*--- Показ архива новостей ---*/
else if($action=="arc")
{
  $file=$data;
  $content=file($file);
  $content=array_reverse($content);
  $content_size=sizeof($content);
  for($i=0; $i<$content_size; $i++)
  {
    echo($content[$i]);
  }
  echo("<a href=index.php>[Последние новости]</a>");
}
/*--- Показ списка последних новостей ---*/
else
{
  $file=$data;
  $content=file($file);
  $content=array_reverse($content);
  if($news_num>sizeof($content)) $news_num=sizeof($content);
  for($i=0; $i<$news_num; $i++)
  {
    echo($content[$i]);
  }
   echo("<a href=index.php?action=arc>[Архив новостей]</a>");
}


?>