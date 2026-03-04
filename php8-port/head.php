<?php
require_once __DIR__ . "/compat.php";
  include ("config.php");
//include('logs/ban.php');
$current_date=date('D, d  F  Y'.' года'.' | G:i:s');
$current_date=ereg_replace('Mon','Понедельник',$current_date);
$current_date=ereg_replace('Tue','Вторник',$current_date);
$current_date=ereg_replace('Wed','Среда',$current_date);
$current_date=ereg_replace('Thu','Четверг',$current_date);
$current_date=ereg_replace('Fri','Пятница',$current_date);
$current_date=ereg_replace('Sat','Суббота',$current_date);
$current_date=ereg_replace('Sun','Воскресение',$current_date);

$current_date=ereg_replace('January','Января',$current_date);
$current_date=ereg_replace('February','Февраля',$current_date);
$current_date=ereg_replace('March','Марта',$current_date);
$current_date=ereg_replace('April','Апреля',$current_date);
$current_date=ereg_replace('May','Мая',$current_date);
$current_date=ereg_replace('June','Июня',$current_date);
$current_date=ereg_replace('July','Июля',$current_date);
$current_date=ereg_replace('August','Августа',$current_date);
$current_date=ereg_replace('September','Сентября',$current_date);
$current_date=ereg_replace('October','Октября',$current_date);
$current_date=ereg_replace('November','Ноября',$current_date);
$current_date=ereg_replace('December','Декабря',$current_date);
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php  print "$site_title"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<LINK href=main.css rel=stylesheet type=text/css>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>

<body bgcolor="#999999" text="#101842" link="#FFFFFF" vlink="#333333" alink="#FF0000">
<a name="top"></a>
<table width="750" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000" align="center">
 <tr bgcolor="#101842">
  <td colspan="3"><font face="Superkarcher"> <font color="#DEB500" size="6" face="Verdana, Arial, Helvetica, sans-serif"><b><font size="4">&gt;</font></b></font><font size="4"><b><font face="Verdana, Arial, Helvetica, sans-serif">
  <?php  print "$site_logo"; ?></font></b></font></font></td>
 </tr>
 <tr bgcolor="#354463">
  <td colspan="3"><font size="2" color="#CCCCCC"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#DEB500">
   <?php  print "$current_date"; ?> </font></b></font></td>
 </tr>
 <tr>
  <td bgcolor="#253047" valign="top" width="3">&nbsp;</td>
  <td valign="top" bgcolor="#CCCCCC"><b></b>
   <table width="100%" border="0" cellspacing="2" cellpadding="3">
    <tr>
     <td valign="top" class='table'>