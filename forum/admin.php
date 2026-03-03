<?
include("config.inc.php");
include("function.php");
if(isset($_GET)){while(list($key,$value)=each($_GET)){$$key=$value;}}
if(isset($HTTP_COOKIE_VARS)){foreach($HTTP_COOKIE_VARS as $key=>$value ){$$key=$value;}}
$PARAMS = (isset($HTTP_POST_VARS)) ? $HTTP_POST_VARS : $HTTP_GET_VARS; foreach( $PARAMS as $key => $value ) {$$key=$value;}

if ($p == "$password")
{
$gener = FileArray("$dlogs/user_ip.dat");
$all_hit = count($gener);
include("config.inc.php");
echo"
     <!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
     <HTML><HEAD><TITLE>Админ</TITLE>
     <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
     <link href=\"..\main.css\" rel=\"stylesheet\" type=\"text/css\">
     </HEAD>
     <body $color_body>
     <table align=center border=0 width=700 cellpadding=1 cellspacing=1 $color_table>
          <tr><td align=center $color_td><a href=all.php?act=forum>Зайти в форум</a></td></tr></table><br> 
     <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
<tr><td align=center $color_td><font $word>Меню Админа</font></td></tr>
<tr><td align=center $color_td>
<a href=\"admin.php?p=$p&forum=yes\" title=\"Смотреть Форум\">Смотреть Форум</a> |
<a href=\"admin.php?p=$p&menu=stat\">Посещений - $all_hit</a> |
<a href=\"admin.php?p=$p&menu=stat&actions=all_user\">Смотреть всех id_user</a> |
";

$log_admin = FileArray("$dlogs/admin.log");
if(count($log_admin) >= "1")  
  {echo" <font $word_s>[</font><a href=\"admin.php?p=$p&menu=logs\" title=\"Лог файл\">Xaker</a><font $word_s>]</font></td></tr></table><br>"; }
  else{echo" <a href=\"admin.php?p=$p&menu=logs\" title=\"Лог файл\">Лог файл</a></td></tr></table><br>"; }
   if ($logs == "Очистить лог файл")
       {
        $log_f = OpenFile("$dlogs/admin.log","w+");  
        fputs ($log_f,"");
        CloseFile ($log_f, "$dlogs/admin.log");
       }
   if ($action == "забаннить_ip")
      {
       $banf = OpenFile("$banlist","a");
       $banip = ereg_replace("\*",".*",$banip);
       $banip = ereg_replace("\.",".",$banip);
       fputs($banf,"$ip::Решение главного!::\n");
       CloseFile($banf, $banlist);
      }
   if ($action == "забаннить_id")
      {
       $banf = OpenFile("$banlist","a"); 
       $banip = ereg_replace("\*",".*",$banip);
       $banip = ereg_replace("\.",".",$banip);
       fputs($banf,"$user_id::Решение главного!::\n");
       CloseFile($banf, $banlist);
      }
   if ($ban == "добавить")
       {
        $bli = OpenFile("$banlist","a");  
        $banip = ereg_replace("\*",".*",$banip);
        $banip = ereg_replace("\.",".",$banip);
        fputs($bli,"$banip::$banmessage\n");
        CloseFile($bli, $banlist);
       }
   $bans = FileArray("$banlist");
   if ($ban == "изменить" or $ban == "удалить")
       {
        $bansf = OpenFile("$banlist","w");  
        for ($banc = 0; $banc < count($bans); $banc++)
             {
               if ($banc != $nb)
                    { fputs($bansf,$bans[$banc]);  }
               else
                    { if ($ban == "изменить")
                          {
                           $banip = ereg_replace("\*",".*",$banip);
                           $banip = ereg_replace("\.",".",$banip);
                           fputs($bansf,"$banip::$banmessage\n");
                          }
                     }
             }
        CloseFile($bansf, $banlist);
       }
   if ($auto == "добавить")
      {
       $auf = OpenFile("$autochange","a"); 
       $from = ereg_replace(":","&#58;",$from);
       $into = ereg_replace(":","&#58;",$into);
       fputs($auf,"$from::$into\n");
       CloseFile($auf, $autochange);
      }
   $autfi = FileArray("$autochange");
   if ($auto == "изменить" or $auto == "удалить")
      {
        $autfif = OpenFile("$autochange","w"); 
        for ($autc = 0; $autc < count($autfi); $autc++)
            {
               if ($autc != $an)
                   { fputs($autfif,$autfi[$autc]);  }
               else
                   { if ($auto == "изменить")
                        {
                          $from = ereg_replace(":","&#58;",$from);
                          $into = ereg_replace(":","&#58;",$into);
                          fputs($autfif,"$from::$into\n");
                        }
                   }
            }
       CloseFile($autfif, $autochange);
      }   
if ($menu == "stat"){ include("stat_admin.php");}

if ($forum == "yes")                  
{               
$general_file = $baseforum; $adres="forum=yes";

   $general = FileArray("$general_file");
   if (isset($action))
      {                
        if ($action == "удалить_все" or $action == "удалить_ответ" or $action == "изменить")
            { 
              $del_abs=$del;  $del_otvetabs=$del_otvet;  $nomer_abs = $nomer;  $message_abs = $message;
              $email_abs=$email;  $tema_abs=$tema;  $data_abs = $data;
             if ($action == "удалить_все")
             {
              $fp = OpenFile("$general_file","w");
               $lines = count($general);                                            
                for ( $i = 0; $i < $lines; $i++ )
                  {  
                   list($del,$del_otvet,$ip,$email,$ename,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$smiles)=explode("::", $general[$i]);
                   if ($nomer_abs != $del) { fputs ($fp,$general[$i]); } 
                  }
              CloseFile ($fp, $general_file);
             } 
             if ($action == "удалить_ответ")
             {
               $show_otvet = $show_otvet-1;
               $fp = OpenFile("$general_file","w");   
               $lines = count($general);                                            
                for ( $i = 0; $i < $lines; $i++ )
                  {  
                   list($del,$del_otvet,$ip,$email,$ename,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$smiles)=explode("::", $general[$i]);
                   if ($del_abs < $del) { fputs ($fp,$general[$i]); }
                   if ($del_abs == $del and $del_otvet == ""){ 
                   $otvets=$otvets-1; 
                   fputs ($fp,"$del::$del_otvet::$ip::$email::$ename::$nomer::$tema::$message::$data::$otvets::$prosmotr::$user_id::$smiles::\n"); }
                   if ($del_abs == $del and $del_otvet != "" and $del_otvetabs != $del_otvet){ 
                   fputs ($fp,$general[$i]); }
                   if ($del_abs > $del) { fputs ($fp,$general[$i]); }
                  }
              CloseFile ($fp, $general_file);
             }      
          if ($action == "изменить")
             {  
              $fp = OpenFile("$general_file","w");  
              $lines = count($general);                                            
              for ( $i = 0; $i < $lines; $i++ )
                {  
                 if ($i != $number) { fputs($fp,$general[$i]); }
                 else
                     {   
                        $message = replace($message_abs);
                        $message = rep($message);
                        $del = $del_abs;  $del_otvet = $del_otvetabs; $ip = $ip; 
                        $email = $email_abs; $ename = $ename;  $tema = $tema_abs; 
                        $data = $data_abs;  $otvets = $otvets;
                        $prosmotr = $prosmotr;  
                        if($smiles_abs!="yes"){$smiles_abs="";}
                        $smiles = $smiles_abs;
                        fputs($fp,"$del::$del_otvet::$ip::$email::$ename::$nomer::$tema::$message::$data::$otvets::$prosmotr::$user_id::$smiles::\n"); 
                      }
                }
             CloseFile ($fp, $general_file);
            }
         }
      }
    $general = FileArray("$general_file"); 
    $messages = count($general);
   for ( $i = 0; $i < $messages; $i++ )
      {                                    
        list($del,$del_otvet,$ip,$email,$ename,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$smiles)=explode("::", $general[$i]);
        if ( $nomer != "")   { $all_messages++;}
        if ( $del_otvet != "")  { $all_otvets ++;}
      }
   echo " <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
          <tr><td $color_td align=center> ";
          if ( $menu == "messages" )  { echo" <font $word_s>Сообщения </font> |";    } 
          else{echo"<a href=admin.php?p=$p&$adres&menu=messages&page=$page> Сообщения</a> | "; }
          if ( $menu == "banlist" )   { echo" <font $word_s>Лист запрета </font> |"; } else{ echo"<a href=admin.php?p=$p&forum=yes&menu=banlist> Лист запрета</a> |   ";  } 
          if ( $menu == "design" )    { echo" <font $word_s>Дизайн </font> |";       } else{ echo"<a href=admin.php?p=$p&forum=yes&menu=design> Дизайн </a> |         ";  }
          if ( $menu == "autochange" ){ echo" <font $word_s>Автозамена </font> |";   } else{ echo"<a href=admin.php?p=$p&forum=yes&menu=autochange> Автозамена</a>    ";  }
   echo " </td></tr></table><br>";      
   if ($p == $password and $menu == "messages" or $page != "")
     {
      if ($messages > "0") { echo " <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td align=center $color_td width=50%>Всего сообщений: <font $word_s>$all_messages</font></td><td align=center $color_td width=50%>Ответов на сообщения: <font $word_s>$all_otvets</font></td></tr></table><br>";}
      if ($page == "")  {$page ="0";}
      $line = "|";  
      $w=0;
      for ($i = 0; $i < $messages; $i++)
           {
            list($del,$del_otvet,$ip,$email,$ename,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$smiles) = explode("::", $general[$i]);
            if ($nomer != "")
                 {
           if ($i != $page) {$w++; if ($otvets != "0"){$line .=" <font $word>*</font>";} $line .=" <a href=\"admin.php?p=$p&$adres&page=$i&show_otvet=$otvets\" title=\"ответов - $otvets\">$w</a> |\n";  }
           if ($i == $page) {$w++; if ($otvets != "0"){$line .=" <font $word_s>*</font>";} $line .=" <font $word_s>$w</font> |\n"; }
                 }
         }        
     if ($messages > "0") { echo " <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td align=center $color_td><font face=verdana size=1>$line</font></td></tr></table><br>"; }
       
       for ($i = $page; $i <= $page; $i++)
          {
            list($del,$del_otvet,$ip,$email,$ename,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$smiles) = explode("::", $general[$i]);
            if ($nomer != "")
                 {
                   $message = str_replace("<br>","\n",$message);
                   $id = $i;
                   $show_otvet=$otvets;
                   echo " <form action=admin.php method=post>
                          <input type=hidden name=p value=$p><input type=hidden name=forum value=yes>";
                          echo"<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
                          <tr><td align=center $color_td colspan=2><font face=verdana size=1 $word>Номер строки в базе:</font><font face=verdana size=1 $word_s> $id</font> [<font face=verdana size=1 $word>Идетификационный номер в базе:</font> <font face=verdana size=1 $word_s>$del</font>]</td></tr>
                          <tr><td $color_td colspan=2>всего ответов: <font $word_s>$otvets</font>&nbsp;&nbsp; всего просмотров: <font $word_s>$prosmotr</font></td></tr>
                          <tr><td $color_td align=center><font $word>Имя:</font></td>
                              <td $color_td>&nbsp;<input type=text name=ename value=\"$ename\" size=25>&nbsp;&nbsp;&nbsp;<font $word>Email:</font>&nbsp;<input type=text name=email value=\"$email\" size=25>&nbsp;&nbsp;&nbsp;<font $word>Смайлики:</font>&nbsp;<input type=text name=smiles_abs value=\"$smiles\" size=5></td></tr>
                          <tr><td $color_td align=center><font $word>Ip:</font></td>
                              <td $color_td>&nbsp;<input type=text name=ip value=\"$ip\" size=20> <font $word>User_id:</font> <input type=text name=user_id value=\"$user_id\" size=20> <font $word>Дата:</font> <input type=text name=data value=\"$data\" size=18></td></tr>
                          <tr><td $color_td align=center><font $word>Вопрос:</font></td>
                              <td align=center $color_td><textarea rows=7 cols=77 name=message>$message</textarea></td></tr>
                          <tr><td align=center colspan=2 $color_td><input type=submit name=action value=удалить_все> <input type=submit name=action value=изменить> <input type=submit name=action value=забаннить_ip> <input type=submit name=action value=забаннить_id></td></tr>
                          <input type=hidden name=menu value=message>
                          <input type=hidden name=page value=$page><input type=hidden name=number value=$id>
                          <input type=hidden name=nomer value=$nomer><input type=hidden name=del value=$del>
                          <input type=hidden name=otvets value=$otvets><input type=hidden name=prosmotr value=$prosmotr>
                          <input type=hidden name=tema value=$tema><input type=hidden name=show_otvet value=$show_otvet></table></form>";
                }
          }
           if ($show_otvet != "")
           {  
               for ($i = $page+1; $i <= $page+$show_otvet; $i++)
                 {
                   $page_abs = $page;
                   list($del,$del_otvet,$ip,$email,$ename,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$smiles) = explode("::", $general[$i]);
                   $message = str_replace("<br>","\n",$message);
                   $id = $i;                      
                   echo " <form action=admin.php method=post>
                          <input type=hidden name=p value=$p><input type=hidden name=forum value=yes>";
                          echo"<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
                          <tr><td align=right $color_td colspan=2><font face=verdana size=1 $word>ID ответа $del_otvet</font></td></tr>
                          <tr><td $color_td align=center><font $word>Имя:</font></td>
                              <td $color_td>&nbsp;<input type=text name=ename value=\"$ename\" size=30>&nbsp;&nbsp;&nbsp; <font $word>Email:</font>&nbsp;<input type=text name=email value=\"$email\" size=25></td></tr>
                          <tr><td $color_td align=center><font $word>Ip:</font></td>
                              <td $color_td>&nbsp;<input type=text name=ip value=\"$ip\" size=20> <font $word>User_id:</font> <input type=text name=user_id value=\"$user_id\" size=20> <font $word>Дата:</font> <input type=text name=data value=\"$data\" size=19></td></tr>
                          <tr><td $color_td align=center><font $word>Ответ:</font>&nbsp;</td>
                              <td align=center $color_td><textarea rows=5 cols=77 name=message>$message</textarea></td></tr>
                          <tr><td align=center colspan=2 $color_td><input type=submit name=action value=удалить_ответ> <input type=submit name=action value=изменить> <input type=submit name=action value=забаннить_ip> <input type=submit name=action value=забаннить_id></td></tr>
                          <input type=hidden name=menu value=message><input type=hidden name=del value=$del>
                          <input type=hidden name=page value=$page_abs><input type=hidden name=del_otvet value=$del_otvet>
                          <input type=hidden name=number value=$id><input type=hidden name=show_otvet value=$show_otvet>
                          <input type=hidden name=tema value=$tema></table></form>";
                       }    
            }
           if ($messages < "1") { echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td align=center $color_td><font $word_s>Нет вопросов и ответов!</font></td></tr></table>";}
           if ($messages > "0") {
              echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td align=center $color_td>Всего записей в базе: <font $word_s>$messages</font></td></tr></table>";}
      }
if ($menu == "banlist")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td align=center $color_td colspan=3><font $word>Лист запрета</font></td></tr>";
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=\"banlist\"><tr><td $color_td align=center colspan=2><font face=verdana size=1 $word>Можете использовать звёздочку '<font $word_s>*</font>' в качестве маски</td></tr><tr><td $color_td align=center width=120><font $word>IP - ID адрес</font></td><td $color_td align=center><font $word>Причина</font></td></tr><tr><td $color_td align=center><input type=text name=banip value=\"$ban3\" size=12></td><td $color_td align=center><input type=text name=banmessage value=\"$ban4\" size=68></td></tr>";
echo "<tr><td $color_td align=right colspan=2><input type=submit name=ban value=добавить></td></tr></form>";
$ban1 = FileArray($banlist);
$ban2 = count($ban1);
for ( $b = $ban2 - 1; $b > - 1; $b--)
  {
   list($ban3,$ban4) = explode("::","$ban1[$b]");
   $ban3 = ereg_replace("\.",".",$ban3);
   $ban3 = ereg_replace("\.\*","*",$ban3);
   $ban3 = ereg_replace("\\\.",".",$ban3);
   echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=nb value=\"$b\"><input type=hidden name=menu value=\"banlist\"><tr><td $color_td align=center width=120><font $word>IP - ID адрес</font></td><td $color_td align=center><font $word>Причина</font></td></tr><tr><td $color_td align=center><input type=text name=banip value=\"$ban3\" size=12></td><td $color_td align=center><input type=text name=banmessage value=\"$ban4\" size=68></td></tr>";
   echo "<tr><td $color_td align=right colspan=2><input type=submit name=ban value=изменить> <input type=submit name=ban value=удалить></td></tr></form>";
  }
if ($ban3 < "1") {echo "<tr><td $color_td align=center colspan=2><font $word_s>Лист запрета пуст!</font></td></tr>";}
}
if ($menu == "design" and $template == "")
{                                  
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
<tr><td $color_td align=center><font $word_s>Выберите шаблон!</font></td></tr>
<tr><td $color_td>1. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=form\" target=\"_self\">Форма для нового сообщения</a></td></tr>
<tr><td $color_td>2. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=forumform\" target=\"_self\">Форма ответа на сообщение</a></td></tr>
<tr><td $color_td>3. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=center\" target=\"_self\">Верх навигации над сообщениями</a></td></tr>
<tr><td $color_td>4. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=message\" target=\"_self\">Внешний вид сообщения</a></td></tr>
<tr><td $color_td>5. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=message_otvet\" target=\"_self\">Внешний ответа на сообщение</a></td></tr>
<tr><td $color_td>6. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=bottom\" target=\"_self\">Место под сообщениями</a></td></tr>
<tr><td $color_td>7. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=error\" target=\"_self\">Ошибка при добавлении</a></td></tr>
<tr><td $color_td>8. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=top\" target=\"_self\">Верх шаблона всей страницы форума</a></td></tr>
<tr><td $color_td>9. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=end\" target=\"_self\">Низ шаблона всей страницы форума</a></td></tr>
<tr><td $color_td>10. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=forum_top\" target=\"_self\">Название форума и фома для поиска вверху странички</a></td></tr>
<tr><td $color_td>11. <a href=\"admin.php?p=$p&forum=yes&menu=design&template=forum_message_ot\" target=\"_self\">Форма необрезанного сообщения</a></td></tr>
</table>";
}
if ($template == "top")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ВЕРХ ВСЕЙ СТРАНИЦЫ ФОРУМА</font>\"</font></td></tr>";
$t_error = FileArray("$dtemplates/index_top.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($e = 0 ; $e < count($t_error); $e++)
{
$t_error[$e] = str_replace('<',"&lt;",$t_error[$e]);
$t_error[$e] = str_replace('>',"&gt;",$t_error[$e]);
echo $t_error[$e];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_top\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%title% - <font $word>$title / $titl (это ваши данные)</font></td></tr>
</table></form>";
}
if ($design_top == "Изменить @ Применить")
{
$u_t_error = OpenFile("$dtemplates/index_top.htm","w");  
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_error,$d_e_t);
CloseFile($u_t_error, "$dtemplates/index_top.htm");
}
if ($template == "forum_top")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>НАЗВАНИЕ ФОРУМА И ФОРМА ДЛЯ ПОИСКА, ВВЕРХУ СТРАНИЧКИ</font>\"</font></td></tr>";
$t_error = FileArray("$dtemplates/forum_top.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($e = 0 ; $e < count($t_error); $e++)
{
$t_error[$e] = str_replace('<',"&lt;",$t_error[$e]);
$t_error[$e] = str_replace('>',"&gt;",$t_error[$e]);
echo $t_error[$e];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_forum_top\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%action% - <font $word>Имя вашего ДОМЕНА, определяется автоматически</font></td></tr>
<tr><td $color_td>%title% - <font $word>Ваше название</font></td></tr>
<tr><td $color_td>%titl% - <font $word>Название форума</font></td></tr>
</table></form>";
}
if ($design_forum_top == "Изменить @ Применить")
{
$u_t_error = OpenFile("$dtemplates/forum_top.htm","w");  
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_error,$d_e_t);
CloseFile($u_t_error, "$dtemplates/forum_top.htm");
}

if ($template == "end")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>НИЗ ВСЕЙ СТРАНИЦЫ ФОРУМА</font>\"</font></td></tr>";
$t_error = FileArray("$dtemplates/index_end.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($e = 0 ; $e < count($t_error); $e++)
{
$t_error[$e] = str_replace('<',"&lt;",$t_error[$e]);
$t_error[$e] = str_replace('>',"&gt;",$t_error[$e]);
echo $t_error[$e];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_end\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%hit% - <font $word>Хитов за сутки на форуме</font></td></tr>
<tr><td $color_td>%host% - <font $word>Хостов за сутки на форуме</font></td></tr>
<tr><td $color_td>%user% - <font $word>Сейчас на форуме</font></td></tr>
<tr><td $color_td>%mtime% - <font $word>Время генерации странички сервером</font></td></tr>
</table></form>";
}
if ($design_end == "Изменить @ Применить")
{
$u_t_error = OpenFile("$dtemplates/index_end.htm","w");  
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_error,$d_e_t);
CloseFile($u_t_error, "$dtemplates/index_end.htm");
}
if ($template == "error")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ОШИБКА</font>\"</font></td></tr>";
$t_error = FileArray("$dtemplates/forum_error.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($e = 0 ; $e < count($t_error); $e++)
{
$t_error[$e] = str_replace('<',"&lt;",$t_error[$e]);
$t_error[$e] = str_replace('>',"&gt;",$t_error[$e]);
echo $t_error[$e];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_error\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%error1% - <font $word>$e1</font></td></tr>
<tr><td $color_td>%error6% - <font $word>$e6</font></td></tr>
<tr><td $color_td>%error7% - <font $word>$e7</font></td></tr>
<tr><td $color_td>%error8% - <font $word>$e8</font></td></tr>
<tr><td $color_td>%error9% - <font $word>$e9</font></td></tr>
</table></form>";
}
if ($design_error == "Изменить @ Применить")
{
$u_t_error = OpenFile("$dtemplates/forum_error.htm","w");  
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_error,$d_e_t);
CloseFile($u_t_error, "$dtemplates/forum_error.htm");
}
if ($template == "form")
{
echo "<table align=center border=0 width=600 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ФОРМА ДЛЯ НОВОГО СООБЩЕНИЯ</font>\"</font></td></tr>";
$t_form = FileArray("$dtemplates/forum_form.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($f = 0 ; $f < count($t_form); $f++)
{
$t_form[$f] = str_replace('<',"&lt;",$t_form[$f]);
$t_form[$f] = str_replace('>',"&gt;",$t_form[$f]);
echo $t_form[$f];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_form\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%mail% - <font $word>email взятый из cookies</font></td></tr>
<tr><td $color_td>%name% - <font $word>имя взятое из cookies</font></td></tr>
<tr><td $color_td>%add0% - <font $word>$add_b</font></td></tr>
</table></form>";
}
if ($design_form == "Изменить @ Применить")
{
$u_t_form = OpenFile("$dtemplates/forum_form.htm","w"); 
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);                  
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_form,$d_e_t);
CloseFile($u_t_form, "$dtemplates/forum_form.htm");
}
if ($template == "forumform")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ФОРМА ОТВЕТА НА СООБЩЕНИЕ</font>\"</font></td></tr>";
$t_form = FileArray("$dtemplates/forumform_otvet.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($f = 0 ; $f < count($t_form); $f++)
{
$t_form[$f] = str_replace('<',"&lt;",$t_form[$f]);
$t_form[$f] = str_replace('>',"&gt;",$t_form[$f]);
echo $t_form[$f];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_formotvet\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%mail% - <font $word>email взятый из cookies</font></td></tr>
<tr><td $color_td>%name% - <font $word>имя взятое из cookies</font></td></tr>
<tr><td $color_td>%add0% - <font $word>$add_b</font></td></tr>
<tr><td $color_td>%adres% - <font $word>адрес форума, берется из программы. На базе этого - можно сделать много форумов</font></td></tr>
<tr><td $color_td>%page_abs% - <font $word>страница в форуме, берется из программы</font></td></tr>
</table></form>";
}
if ($design_formotvet == "Изменить @ Применить")
{
$u_t_formotvet = OpenFile("$dtemplates/forumform_otvet.htm","w");
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);                  
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_formotvet,$d_e_t);
CloseFile($u_t_formotvet, "$dtemplates/forumform_otvet.htm");
}



if ($template == "forum_message_ot")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ВНЕШНИЙ ВИД НЕОБРЕЗАННОГО СООБЩЕНИЯ</font>\"</font></td></tr>";
$t_form = FileArray("$dtemplates/forum_message_ot.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($f = 0 ; $f < count($t_form); $f++)
{
$t_form[$f] = str_replace('<',"&lt;",$t_form[$f]);
$t_form[$f] = str_replace('>',"&gt;",$t_form[$f]);
echo $t_form[$f];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_forum_message_ot\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%data% - <font $word>дата сообщения</font></td></tr>
<tr><td $color_td>%name% - <font $word>имя, сделавшего сообщение</font></td></tr>
<tr><td $color_td>%linkemail% - <font $word>email, сделавшего сообщение</font></td></tr>
<tr><td $color_td>%message% - <font $word>само сообщение</font></td></tr>
</table></form>";
}
if ($design_forum_message_ot == "Изменить @ Применить")
{
$u_t_formotvet = OpenFile("$dtemplates/forum_message_ot.htm","w");
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);                  
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_formotvet,$d_e_t);
CloseFile($u_t_formotvet, "$dtemplates/forum_message_ot.htm");
}




if ($template == "center")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>Верх навигации над сообщениями</font>\"</font></td></tr>";
$t_center = FileArray("$dtemplates/forum_center.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($c = 0 ; $c < count($t_center); $c++)
{
$t_center[$c] = str_replace('<',"&lt;",$t_center[$c]);
$t_center[$c] = str_replace('>',"&gt;",$t_center[$c]);
echo $t_center[$c];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_center\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%line% - <font $word>навигация, |1|2|3| и т.д.</font></td></tr>
</table></form>";
}
if ($design_center == "Изменить @ Применить")
{
$u_t_center = OpenFile("$dtemplates/forum_center.htm","w"); 
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_center,$d_e_t);
CloseFile($u_t_center, "$dtemplates/forum_center.htm");
}

if ($template == "message")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ВНЕШНИЙ ВИД СООБЩЕНИЯ</font>\"</font></td></tr>";
$t_message = FileArray("$dtemplates/forum_message.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($m = 0 ; $m < count($t_message); $m++)
{
$t_message[$m] = str_replace('<',"&lt;",$t_message[$m]);
$t_message[$m] = str_replace('>',"&gt;",$t_message[$m]);
echo $t_message[$m];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_message\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%date% - <font $word>дата сообщения пользователя</font></td></tr>
<tr><td $color_td>%message% - <font $word>сообщение пользователя</font></td></tr>
<tr><td $color_td>%otvets% - <font $word>количество ответов на сообщение</font></td></tr>
<tr><td $color_td>%prosmotr% - <font $word>количество просмотров сообщения</font></td></tr>
<tr><td $color_td>%name% - <font $word>имя пользователя</font></td></tr>
<tr><td $color_td>%linkemail% - <font $word>email пользователя</font></td></tr>
</table></form>";
}
if ($design_message == "Изменить @ Применить")
{
$u_t_message = OpenFile("$dtemplates/forum_message.htm","w");  
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_message,$d_e_t);
CloseFile($u_t_message, "$dtemplates/forum_message.htm");
}

if ($template == "message_otvet")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>ВНЕШНИЙ ВИД СООБЩЕНИЯ ОТВЕТА НА СООБЩЕНИЕ</font>\"</font></td></tr>";
$t_message = FileArray("$dtemplates/forum_admmessage01.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($m = 0 ; $m < count($t_message); $m++)
{
$t_message[$m] = str_replace('<',"&lt;",$t_message[$m]);
$t_message[$m] = str_replace('>',"&gt;",$t_message[$m]);
echo $t_message[$m];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_messageotvet\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%date% - <font $word>дата сообщения пользователя</font></td></tr>
<tr><td $color_td>%message% - <font $word>сообщение пользователя</font></td></tr>
<tr><td $color_td>%tema% - <font $word>тема сообщения, у нас \"Re\" или \"new\" красным цветом</font></td></tr>
<tr><td $color_td>%linkemail% - <font $word>email пользователя</font></td></tr>
<tr><td $color_td>%name% - <font $word>имя пользователя</font></td></tr>
</table></form>";
}
if ($design_messageotvet == "Изменить @ Применить")
{
$u_t_messageot = OpenFile("$dtemplates/forum_admmessage01.htm","w");
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_messageot,$d_e_t);
CloseFile($u_t_messageot, "$dtemplates/forum_admmessage01.htm");
}

if ($template == "bottom")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center><font $word_s>Шаблон \"<font $word_s>МЕСТО ПОД СООБЩЕНИЯМИ</font>\"</font></td></tr>\n";
$t_bottom = FileArray("$dtemplates/forum_bottom.htm");
echo "<form action=admin.php method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=menu value=design>\n<tr><td $color_td align=center>";
echo "<textarea name=\"d_e_t\" cols=71 rows=15>";
for($b = 0 ; $b < count($t_bottom); $b++)
{
$t_bottom[$b] = str_replace('<',"&lt;",$t_bottom[$b]);
$t_bottom[$b] = str_replace('>',"&gt;",$t_bottom[$b]);
echo $t_bottom[$b];
}
echo "</textarea></font></td></tr>
<tr><td $color_td align=center><input type=\"submit\" name=\"design_bottom\" value=\"Изменить @ Применить\"></td></tr>
<tr><td $color_td align=center><font $word_s>Автоматическая замена</font></td></tr>
<tr><td $color_td>%all_messages% - <font $word>всего сообщений</font></td></tr>
<tr><td $color_td>%all_otvets% - <font $word>всего ответов на сообщения</font></td></tr>
</table></form>";
}
if ($design_bottom == "Изменить @ Применить")
{
$u_t_bottom = OpenFile("$dtemplates/forum_bottom.htm","w"); 
$d_e_t = ereg_replace("\\\'","'",$d_e_t);
$d_e_t = ereg_replace('\\\"','"',$d_e_t);
$d_e_t = str_replace('&lt;',"<",$d_e_t);
$d_e_t = str_replace('&gt;',">",$d_e_t);
fputs ($u_t_bottom,$d_e_t);
CloseFile($u_t_bottom, "$dtemplates/forum_bottom.htm");
}

if ($menu == "autochange")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table><tr><td $color_td align=center colspan=2><font $word>Автозамена слов...</font></td></tr>";
echo "<form action=\"admin.php\" method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=gost value=yes><input type=hidden name=menu value=\"autochange\"><tr><td $color_td align=center colspan=2><font face=verdana size=1 $word_s>Используйте, только латиницу, цифры и русские буквы!</td></tr><tr><td $color_td align=center colspan=2><font $word>Новая автозамена</td></tr><tr><td $color_td align=center width=50%><font $word>С..</font></td><td $color_td align=center><font $word>на...</font></td></tr><tr><td $color_td align=center><input type=text name=from value=\"\" size=40></td><td $color_td align=center><input type=text name=into value=\"\" size=40></td></tr>";
echo "<tr><td $color_td align=right colspan=2><input type=submit name=auto value=добавить></td></tr></form>";
$autochange1 = FileArray($autochange);
$autochange2 = count($autochange1);
for ( $au = $autochange2 - 1; $au > - 1; $au--)
{
$noaut = $au;
$noaut++;
list($from1,$into1) = explode("::","$autochange1[$au]");
echo "<form action=\"admin.php\" method=post><input type=hidden name=p value=\"$p\"><input type=hidden name=forum value=yes><input type=hidden name=an value=\"$au\"><input type=hidden name=menu value=\"autochange\"><tr><td $color_td align=center colspan=2><font $word>Автозамена номер $noaut</td></tr><tr><td $color_td align=center width=50%><font $word>С</font></td><td $color_td align=center><font $word>на...</font></td></tr><tr><td $color_td align=center><input type=text name=from value=\"$from1\" size=40></td><td $color_td align=center><input type=text name=into value=\"$into1\" size=40></td></tr>";
echo "<tr><td $color_td align=right colspan=2><input type=submit name=auto value=изменить> <input type=submit name=auto value=удалить></td></tr></form>";
}
if ($autochange2 == "0"){echo "<tr><td $color_td align=center colspan=2><font $word_s>Лист автозамены пуст!</font></td></tr>";}
}
}                                                 
if ($menu == "logs")
{
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>";
$log_admin = FileArray("$dlogs/admin.log");
if(count($log_admin) < "1")  {  echo "<tr><td $color_td align=center><font $word_s>Лог файл пуст!</font></td></td></tr>";}
if(count($log_admin) == "1" or count($log_admin) > "1")
{
echo "<tr><td $color_td align=center colspan=4><font $word_s>Лог на панельку входа админа</td></tr>";
echo "<tr><td $color_td align=center><font $word>IP адрес</td><td align=center $color_td><font $word>Хост</td><td $color_td align=center><font $word>Дата</td><td $color_td align=center><font $word>Введённый пароль</td></tr>";
}
for ($la = count($log_admin) - 1; $la > - 1; $la--)
{
list($log_ip,$log_host,$log_date,$log_password)=explode("<>", $log_admin[$la]);
echo "<tr><td $color_td align=center>$log_ip</td><td $color_td align=center>$log_host</td><td $color_td align=center>$log_date</td><td $color_td align=center>$log_password</td></tr>";
}
if(count($log_admin) == "1" or count($log_admin) > "1")
{
$coal2 = FileArray("$dlogs/admin.log");
$coal = count($coal2);
echo "<form action=admin.php method=post><input type=hidden name=menu value=logs><input type=hidden name=p value=\"$p\"><input type=hidden name=gost value=yes><tr><td $color_td align=center colspan=4><input type=submit name=logs value=\"Очистить лог файл\"></td></tr>\n<tr><td $color_td align=center colspan=4><font $word>Попыток входа не админом: <font $word_s>$coal</font></font></td></tr></form>";
}
echo "</table>";
}
echo "</body></html>";
}                                        

if ($p != "$password")  
   { if(empty($log_ip)){  if (getenv('HTTP_X_FORWARDED_FOR'))  {$log_ip=getenv('HTTP_X_FORWARDED_FOR'); } else  {$log_ip=getenv('REMOTE_ADDR'); }} else  {   $log_ip=getenv('REMOTE_ADDR'); }
     $log_host=gethostbyaddr("$log_ip");
     $log_date=date('d\.m\.Y, H:i:s');
     $log_file = OpenFile("$dlogs/admin.log","a+");   
     $p = eregi_replace("<","&lt;","$p");
     $p = eregi_replace(">","&gt;","$p");
     if($p == "") {  $p = "не вводил";  }
     fputs ($log_file,"$log_ip<>$log_host<>$log_date<>$p\n");
     CloseFile ($log_file, "$dlogs/admin.log");
     form();
     echo "</body></html>";
   }                                        
?>