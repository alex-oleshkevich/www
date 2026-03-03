<?
$time1 = time();
$time_m1 = microtime();

include("config.inc.php");
include("function.php");

          
if(isset($_GET)){while(list($key,$value)=each($_GET)){ $$key=$value;}}
if(isset($HTTP_COOKIE_VARS)){foreach($HTTP_COOKIE_VARS as $key=>$value ){$$key=$value;}}
$PARAMS = (isset($HTTP_POST_VARS)) ? $HTTP_POST_VARS : $HTTP_GET_VARS;
foreach( $PARAMS as $key => $value ) {$$key=$value;}

if ($password_indexs == "$password_abs")
{              
$REQUEST_URI = $HTTP_SERVER_VARS["REQUEST_URI"];
$HTTP_HOST = $HTTP_SERVER_VARS["HTTP_HOST"];
$server = "http://" ."$HTTP_HOST" ."$REQUEST_URI";
eregi ("(.*/forum777)", $server, $server_obr);
$HTTP_HOST = $server_obr[1];
include("config.inc.php");

if($robot == "yes"){
list($a1,$file)=explode("file=", $HTTP_SERVER_VARS["REQUEST_URI"]); 

if(isset($file)){                            
$file_name = @implode("",@file("$file"));
$file_n = explode("\n", $file_name);
if(isset($file_n)){
  $general = FileArray("$base_domen");
  for ( $i = 0;  $i < count($general); $i++){list($domen,$server)=explode("::", $general[$i]);}
  $server = eregi_replace("admin.php", "", $server);

   for ($i = 0; $i < sizeof($file_n); $i++){
      $file_n[$i] = replace_links ($file_n[$i]);
         if($kodir == "iso"){$file_n[$i] = convertIso($file_n[$i]);  }
         if($kodir == "koir"){$file_n[$i] = convertKoir($file_n[$i]);}
      echo"$file_n[$i]"; 
   }
   }
else{echo"<font $word_s>Не смог открыть:</font> <a href=\"$file\">$file</a>";}
}
else{echo"<font $word_s>Не смог открыть:</font> <a href=\"$file\">$file</a>";}
echo"</body></html>";
exit;
}


echo"
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<HTML><HEAD><TITLE>Админ</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
</HEAD><body $color_body>
<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
   <tr><td align=center $color_td><font $word>Меню Админа</font></td></tr>
   <tr><td align=center $color_td>
<a href=\"robot.php?password_indexs=$password_indexs&action=index_link\" title=\"Искать все ссылки на сайте\">Индексировать ссылки</a> |
<a href=\"robot.php?password_indexs=$password_indexs&action=index_link&act=bad_link\" title=\"Эти ссылки не индексировать\">Плохие ссылки</a> |
<a href=\"robot.php?password_indexs=$password_indexs&action=index_page\" title=\"Индексировать найденные ссылки\">Индексировать страницы</a> |
<a href=\"robot.php?password_indexs=$password_indexs&action=index_page&act=index_point\" title=\"Настроить точки индексации\">Точки индексации</a> |
";

$log_admin = FileArray("$dlogs/admin.log");
if(count($log_admin) >= "1")  
  {echo" <font $word_s>[</font><a href=\"robot.php?password_indexs=$password_indexs&menu=logs\" title=\"Лог файл\">Xaker</a><font $word_s>]</font></td></tr></table><br>"; }
  else{echo" <a href=\"robot.php?password_indexs=$password_indexs&menu=logs\" title=\"Лог файл\">Лог файл</a></td></tr></table>"; }
   if ($logs == "Очистить лог файл")
       {
        $log_f = OpenFile("$dlogs/admin.log","w+");  
        fputs ($log_f,"");
        CloseFile ($log_f, "$dlogs/admin.log");
       }
if ($menu == "logs")
{
echo "<br><table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
<form action=robot.php method=post><input type=hidden name=menu value=logs><input type=hidden name=password_indexs value=\"$password_indexs\">";
$log_admin = FileArray("$dlogs/admin.log");
if(count($log_admin) < "1")  {  echo "<tr><td $color_td align=center><font $word_s>Лог файл пуст!</font></td></tr>";}
if(count($log_admin) == "1" or count($log_admin) > "1")
{
echo "<tr><td $color_td align=center colspan=4><font size=4 $word>Лог на панельку входа админа</td></tr>
      <tr><td $color_td align=center><font $word>IP адрес</td>
      <td align=center $color_td><font $word>Хост</td>
      <td $color_td align=center><font $word>Дата</td>
      <td $color_td align=center><font $word>Введённый пароль</td></tr>";
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
echo "<tr><td $color_td align=center colspan=4><input type=submit name=logs value=\"Очистить лог файл\"></td></tr>\n<tr><td $color_td align=center colspan=4><font $word>Попыток входа не админом: <font $word_s>$coal</font></font></td></tr>";
}
echo"</table></form>";
}

if($action == "index_link"){
if(($domen =="" or empty($domen) or !$domen) and $action!=""){
  $general = FileArray("$base_domen");
  for ( $i = 0;  $i < count($general); $i++){list($domen,$server)=explode("::", $general[$i]);}
  } 
  if($domen == ""){$domen = $HTTP_HOST; $query = "all.php";}
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
<form action=robot.php method=post><input type=hidden name=password_indexs value=\"$password_indexs\">
<input type=hidden name=action value=index_link>
<tr><td align=center $color_td> <font size=4 $word_s>Индексация всех ссылок сайта</font></td></tr>
<tr><td $color_td align=center>
     Домен: <input type=text name=\"domen\" value=\"$domen\" size=23>
     query: <input type=text name=\"query\" value=\"$query\" size=35>
            <input type=submit name=act value=войти>
    </td></tr><tr><td $color_td align=center>
     Циклы для робота: 
     <input type=text name=linkss size=5>
     <input type=submit name=act value=\"зациклить\"> 
     <input type=submit name=act value=\"убрать_повторы\">
     <input type=submit name=act value=\"очистить_базу\">
    </td></tr></table></form>";


if($act == "войти"){
if(isset($domen) and $domen !="" and ereg("\."  ,$domen )){
  if( eregi ("http://"  ,$domen )) {}
  else{   $domen = "http://". "$domen"; }
  if( ereg (  "/$" ,$domen )) {$domen = substr_replace($domen, "", -1);}
  }
  else{echo"
  <table align=center width=700><tr><td>
  Введите <font $word_s>правильное название сайта</font> в поле \"Домен\", например: 
   <br><font $word>a.ru</font>
   <br><font $word>http://a.ru</font>
   <br><font $word>http://a.ru/</font><br> 
   Нажмите \"Войти\"...
   </td></tr></table></body></html>";
   exit;}
  if(isset($query)){
  if(ereg ("$server"  ,$query)){$query = ereg_replace("$server", "", $query);}
  if(ereg ("(^|[^a-zA-Z0-9])$domen?(.*)"  ,$query, $array)){$query = $array[2];}
  if( ereg ("^/"  ,$query )) {$query = substr ($query, 1);}
}

  $fp = OpenFile ("$base_domen", "w");
  fputs ($fp,"$domen::$server::\n");
  CloseFile($fp, $base_domen);
}


if($redir != ""){list($a1,$pag)=explode("redir=", $HTTP_SERVER_VARS["REQUEST_URI"]);}
  else{ if($query !=""){$pag="$domen/$query";}
        else{ if($domen !=""){$pag="$domen/";}  }
           }


if($act =="войти" or $redir != ""){ striplinks(); }

if($act == "зациклить"){
      if(count(FileArray($base))< 1){
      echo"
      <table align=center width=700><tr><td>
      <font $word_s>В базе нет данных...</font><br>
      <font $word>Введите Ваш Url сайта (http://ваш_сайт.ru) в поле \"Домен\" и нажмите \"Войти\"</font> 
      </td></tr></table></body></html>";
      exit;
      }
      else{        
          if(ereg("[0-9]+",$linkss) and $linkss !=""){ }
          else{
              echo"
               <table align=center width=700><tr><td>
               Циклы для робота должны быть: <font $word_s> числами</font> 
               </td></tr></table></body></html>";
               exit;
              }  
     }
    $general = FileArray("$base_domen");
    for ( $i = 0;  $i < count($general); $i++){list($domen,$server)=explode("::", $general[$i]);}
    for ( $ii = 0;  $ii < $linkss; $ii++){        
    $general = FileArray ($base);
    $lines = count($general);
        for ( $i = 0;  $i < $lines; $i++)
           {        
            list($page,$fact)=explode("::", $general[$i]);
            if ($fact == ""){ 
            $pag = "$page";  
            striplinks(); 
            break; 
            }
           }
       
       }
   }

if($del !=""){
   $general = FileArray($base);
   $fp = OpenFile("$base","w"); 
   for ($i = 0; $i < count($general); $i++)
      {
       if ($del != $i) { fputs($fp,$general[$i]);  }
      }
   CloseFile ($fp, $base);
}

if($act =="убрать_повторы"){
   $general_abs = FileArray($base);
   for ($i = 0; $i < count($general_abs); $i++)
      {
       list($page_abs,$fact_abs)=explode("::", $general_abs[$i]);
       $gen = FileArray($base_tmp); 
       $fp = OpenFile("$base_tmp","a+");
          for ($ii = 0; $ii <= count($gen); $ii++)
            {
             list($page,$fact)=explode("::", $gen[$ii]);
             if ($page == $page_abs or $fact_abs == "bad") {break;}
             if ($ii == count($gen))
               { 
                $an_array[] = array ($general_abs[$i]);
                fputs($fp,$general_abs[$i]); 
                }
               
            }
       CloseFile ($fp, $base_tmp);
      }

   $fp = OpenFile("$base_tmp","w"); 
   fputs($fp,"");
   CloseFile ($fp, $base_tmp);
     
   if(is_array($an_array)){  
   $fp = OpenFile("$base","w");
    sort ($an_array);
    foreach($an_array as $temp){
       foreach($temp as $var){
          fputs($fp,$var);
          }
       }
  CloseFile ($fp, $base);
   }
}
if($act == "очистить_базу"){ $fp = OpenFile("$base","w"); fputs($fp,"");  CloseFile ($fp, $base);}

if($act != "bad_link"){
echo"\n<table align=center width=700>";
$general = FileArray($base);
for ( $i = 0; $i < count($general); $i++){
      $a++;
      list($page,$fact) = explode("::", $general[$i]);
      echo "<tr>\n<td>$a.<a href=\"robot.php?password_indexs=$password_indexs&action=index_link&del=$i\" title=\"удалить из базы\">delet</a> </td>";
      if($fact ==""){
echo"<td> <a href=\"robot.php?password_indexs=$password_indexs&robot=yes&file=$page\" target=_blank title=\"Посмотреть\">[url]</a></td>
<td width=100%><a href=\"robot.php?password_indexs=$password_indexs&action=index_link&redir=$page\" title=\"Найти ссылки на этой странице\">$page</a></td>\n";
      }
      else{echo"\n<td> <a href=\"robot.php?password_indexs=$password_indexs&robot=yes&file=$page\" target=_blank title=\"Посмотреть\">[url]</a></td>\n<td width=100%>$page";
          if($fact == "bad"){echo"<font color=ff0000> $fact </font>";}
             echo"</td>\n";
          }
      echo"</tr>\n";
       }
echo"</table>";
}


if($act == "bad_link"){
   if ($banan == "добавить")
       { 
        $opisanie = replace ($opisanie);
        $fp = OpenFile("$bad_link","a");  
        if(ereg("\?",$bad_links)){$bad_links = ereg_replace ("\?", "\?", $bad_links);}
        fputs($fp,"$bad_links::$opisanie::\n");
        CloseFile($fp, "$bad_link");
       }
   if ($banan == "изменить" or $banan == "удалить")
       {       
        $opisanie = replace ($opisanie);
        $general = FileArray($bad_link);
        $fp = OpenFile("$bad_link","w");  
        for ($i = 0; $i < count($general); $i++)
             {
               if ($i != $del_bed) { fputs($fp,$general[$i]);  }
               else
                    { if ($banan == "изменить")
                          {
                           if(ereg("\?",$bad_links)){$bad_links = ereg_replace ("\?", "\?", $bad_links);}
                           fputs($fp,"$bad_links::$opisanie::\n");
                          }
                     }
             }
        CloseFile($fp, "$bad_link");
       }

echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
<tr><td align=center $color_td colspan=3> <font size=4 $word_s>Плохие ссылки</font></td></tr>
<form action=robot.php method=post><input type=hidden name=password_indexs value=\"$password_indexs\">
<input type=hidden name=act value=bad_link><input type=hidden name=action value=index_link>
<tr><td $color_td align=center colspan=2><font $word>Если программа будет находить этот текст в ссылках на страницах, они не будут записаны в базу</td></tr>
<tr><td $color_td width=140>&nbsp;&nbsp; Ненужная ссылка</td>
<td $color_td>&nbsp;&nbsp;  Описание ненужной ссылки</td></tr>
<tr><td $color_td align=center><input type=text name=bad_links value=\"\" size=40></td>
<td $color_td align=center><input type=text name=opisanie value=\"\" size=55></td></tr>
<tr><td $color_td align=right colspan=2><input type=submit name=banan value=добавить></td></tr></form>";

$general = FileArray($bad_link);
for ( $i = 0; $i < count($general); $i++)
  {
   list($bad_links,$opisanie) = explode("::","$general[$i]");
   if(ereg("\\\?",$bad_links)){$bad_links = ereg_replace ("\\\?", "", $bad_links);}
   echo "<form action=robot.php method=post>
   <input type=hidden name=password_indexs value=\"$password_indexs\"><input type=hidden name=del_bed value=$i>
   <input type=hidden name=act value=bad_link><input type=hidden name=action value=index_link>
   <tr><td $color_td width=140>&nbsp;&nbsp;  Ненужная ссылка</td>
   <td $color_td>&nbsp;&nbsp; Описание ненужной ссылки</td></tr>
   <tr><td $color_td align=center><input type=text name=bad_links value=\"$bad_links\" size=40></td>
   <td $color_td align=center><input type=text name=opisanie value=\"$opisanie\" size=55></td></tr>
   <tr><td $color_td align=right colspan=2>
   <input type=submit name=banan value=изменить> 
   <input type=submit name=banan value=удалить></td></tr></form>";
  }
if (count($general) < "1") {echo "<tr><td $color_td align=center colspan=2>
<font $word_s>Лист плохих ссылок пуст!</font></td></tr></table>";}
else{echo"</table>";}
}
}

if($action == "index_page"){
echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
<form action=robot.php method=post><input type=hidden name=password_indexs value=\"$password_indexs\">
<input type=hidden name=action value=index_page>
<tr><td align=center $color_td> 
<font size=4 $word_s>Индексация найденных страниц сайта</font>
| <font $word>Кодировка: </font>";
     if($win!="" and $iso!="" and $koir!=""){
         echo"<font $word_s> больше двух кодировок выбирать нельзя...</font>
         </td></tr>
<tr><td $color_td align=center> Введите страницу:
<input type=text name=indexer_page size=35>
<input type=submit name=act value=\"индексировать_страницу\">
</td></tr>
<tr><td $color_td align=center>
      Циклы для робота: 
     <input type=text name=indexer_zikl size=5>                    
     <input type=submit name=act value=\"индексировать\">
     <input type=submit name=act value=\"стереть_повторы\">
     <input type=submit name=act value=\"стереть_базу\">
    </td></tr></table></form></body></html>"; exit;
        }
    else{
    if(($win !="" and $iso!="")  or
       ($win !="" and $koir!="") or
       ($iso !="" and $koir!="") ){
   $general = FileArray($kod);
   $fp = OpenFile("$kod","w");  
   for ($i = 0; $i < count($general); $i++)
      {
      list($kod_abs,$opis) = explode("::", $general[$i]); 
      if(($win !="" and $iso!="")){
         if ($kod_abs != "win" and $kod_abs == "iso"){
            $win="yes";  fputs($fp,"win::yes::"); $iso="no";
           } 
        else{$iso="yes";  fputs($fp,"iso::yes::");$win="no";}
       }
      if(($win !="" and $koir!="")){
         if ($kod_abs != "win" and $kod_abs == "koir"){
            $win="yes";  fputs($fp,"win::yes::"); $koir="no";
           } 
        else{$koir="yes";  fputs($fp,"koir::yes::"); $win="no";}
       }
      if(($iso !="" and $koir!="")){
         if ($kod_abs != "iso" and $kod_abs == "koir"){
            $iso="yes";  fputs($fp,"iso::yes::");  $koir="no";
           } 
        else{$koir="yes";  fputs($fp,"koir::yes::"); $iso="no";} 
       }
      CloseFile($fp, "$kod");
       }
    }   
  else{
        $fp = OpenFile("$kod","w");
         if($iso=="" and $koir==""){ $win="yes";  fputs($fp,"win::yes::"); }
          else{
             if($iso!=""){ $iso="yes";  fputs($fp,"iso::yes::"); }
             if($koir!=""){ $koir="yes";  fputs($fp,"koir::yes::"); }
             }    
       CloseFile($fp, "$kod");
     }
  }
      
if($win =="yes"){echo"<font $word_s> Win</font><input type=radio name=win value=yes checked> ";}
  else{echo" win<input type=radio name=win value=yes> ";}
if($iso =="yes"){echo"<font $word_s> Iso</font><input type=radio name=iso value=yes checked> ";}
  else{echo" iso<input type=radio name=iso value=yes> ";}
if($koir =="yes"){echo"<font $word_s> Koir</font><input type=radio name=koir value=yes checked> ";}
  else{echo" koir<input type=radio name=koir value=yes> ";}
  
echo"
</td></tr>
<tr><td $color_td align=center> Введите страницу:
<input type=text name=indexer_page size=35>
<input type=submit name=act value=\"индексировать_страницу\">
</td></tr>
<tr><td $color_td align=center>
      Циклы для робота: 
     <input type=text name=indexer_zikl size=5>                    
     <input type=submit name=act value=\"индексировать\">
     <input type=submit name=act value=\"стереть_повторы\">
     <input type=submit name=act value=\"стереть_базу\">
    </td></tr></table></form>";

if($act == "index_point"){
   if ($bananan == "изменить")
       {       
        $point1 = replace_html ($point1);
        $point2 = replace_html ($point2);
        $general = FileArray($point);
        $fp = OpenFile("$point","w");  
        for ($i = 0; $i < count($general); $i++) { fputs($fp,"$point1::$point2::"); }
        CloseFile($fp, "$point");
       }

  $general = FileArray($point);
  for ($i = 0; $i < count($general); $i++){

  list($point1,$point2) = explode("::","$general[$i]");
  $point1 = htmlentities($point1);   $point2 = htmlentities($point2);
  echo "<table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>
     <form action=robot.php method=post>
   <input type=hidden name=password_indexs value=\"$password_indexs\"><input type=hidden name=act value=index_point><input type=hidden name=action value=index_page>
   <tr><td $color_td colspan=2 align=center> <font size=4 $word_s>Точки индексации</font></td></tr>
   <tr><td $color_td colspan=2 align=center> <font $word>По умолчанию программа будет записывать в базу весь текст между тегами: &lt;body&gt;...&lt;/body&gt;</font></td></tr>
   <tr><td $color_td>&nbsp;&nbsp;  Начальная точка</td><td $color_td>&nbsp;&nbsp; Конечная точка</td></tr>
   <tr><td $color_td align=center><input type=text name=point1 value=\"$point1\" size=47>
   </td><td $color_td align=center><input type=text name=point2 value=\"$point2\" size=47></td></tr>
   <tr><td $color_td align=right colspan=2><input type=submit name=bananan value=изменить></td></tr></form></table>";
  }
  
}

if($act =="стереть_повторы"){
   $general_abs = FileArray($base_page);
   for ($i = 0; $i < count($general_abs); $i++)
      {
       list($page_abs,$title_abs,$text_abs)=explode("::", $general_abs[$i]);
       $gen = FileArray($base_tmp); 
       $fp = OpenFile("$base_tmp","a+");
          for ($ii = 0; $ii <= count($gen); $ii++)
            {
             list($page,$title,$text)=explode("::", $gen[$ii]);
             if ($page == $page_abs) {break;}
             if ($ii == count($gen))
               { 
                $an_array[] = array ($general_abs[$i]);
                fputs($fp,$general_abs[$i]); 
                }
               
            }
       CloseFile ($fp, $base_tmp);
      }
   $fp = OpenFile("$base_tmp","w"); 
   fputs($fp,"");
   CloseFile ($fp, $base_tmp);
     
   if(is_array($an_array)){  
   $fp = OpenFile("$base_page","w");
    sort ($an_array);
    foreach($an_array as $temp){
       foreach($temp as $var){
          fputs($fp,$var);
          }
       }
   CloseFile ($fp, $base_page);
   }
 }
  if($act == "стереть_базу"){
       $fp = OpenFile("$base_page","w");  
       fputs ($fp,"");
       CloseFile ($fp, "$base_page");
  }
  if($del_page !=""){
    $general = FileArray($base_page);
        $fp = OpenFile("$base_page","w");  
        for ($i = 0; $i < count($general); $i++)
             {
               if ($i != $del_page) { fputs($fp,$general[$i]);  }
             }
       CloseFile ($fp, "$base_page");      
  }


  if($act == "индексировать"){
      if(count(FileArray($base))< 1){
      echo"
      <table align=center width=700><tr><td>
      <font $word_s>Начинать надо с индексации ссылок...</font> 
      </td></tr></table></body></html>";
      exit;
      }
      else{  
           if(ereg("[0-9]+",$indexer_zikl) and $indexer_zikl !=""){ 
            if(ereg("[a-zA-Z]",$indexer_zikl) or ereg(" ",$indexer_zikl)){ 
                echo"
                <table align=center width=700><tr><td>
                Циклы для робота должны быть: <font $word_s> числами без пробелов</font> 
                </td></tr></table></body></html>";
                exit;
               }
             }  
            else{echo"
                <table align=center width=700><tr><td>
                Циклы для робота должны быть: <font $word_s> числами без пробелов</font> 
                </td></tr></table></body></html>";
                exit;}
          }

    $general = FileArray("$base");
    for ( $i = 0;  $i < $indexer_zikl; $i++)
       {
       list($pag,$s)=explode("::", $general[$i]);
       $general_page = FileArray("$base_page");
       for ( $ii = 0;  $ii < count($general_page); $ii++){
           list($page,$s,$t)=explode("::", $general_page[$ii]);
           if($page == $pag){$page_pro = "old"; break;}
          }
       if($page_pro != "old"){indexer();}
       else{            
           if(count($general) > $indexer_zikl){$indexer_zikl++;}
           }
        $page_pro = "";
       }
      }

if($act =="индексировать_страницу"){
  if(($domen =="" or empty($domen) or !$domen) and $action!=""){
     $general = FileArray("$base_domen");
     for ( $i = 0;  $i < count($general); $i++){list($domen,$server)=explode("::", $general[$i]);}
     }
      if($domen =="" or count(FileArray("$base"))< 1){
      echo"
      <table align=center width=700><tr><td>
      <font $word_s>Начинать надо с индексации ссылок</font> 
      </td></tr></table></body></html>";
      exit;                          
      }
    if($rr == "yes"){
     list($a1,$indexer_page)=explode("file=", $HTTP_SERVER_VARS["REQUEST_URI"]);
     }
  if(ereg ("$server"  ,$indexer_page)){$indexer_page = ereg_replace("$server", "", $indexer_page);}
  if(ereg ("(^|[^a-zA-Z0-9])$domen(.*)"  ,$indexer_page, $array)){$indexer_page = "$domen" ."$array[2]";}
  else{echo"
      <table align=center width=700><tr><td>
      Введите <font $word_s>правильное название страницы</font>, например: 
      <br><font $word>$domen/index.html</font>
      <br><font $word>$domen/index.php</font>
      <br><font $word>$domen/другая_страница.html</font>
      </td></tr></table></body></html>";
      exit;
      }
     $pag = $indexer_page;
     striplinks(); indexer();
  }


if($act != "index_point"){   
    $general = FileArray("$base_page");
    if(count($general)>=1){
    echo"\n<table align=center border=0 width=700>";
    for ( $i = 0;  $i < count($general); $i++)
       {
       list($pag,$tit,$kodir,$text)=explode("::", $general[$i]);
       $temp = explode("<|>",$text);
       $a=0;	$text_abs="";
       foreach($temp as $key => $value) 
	{
	$a++; 
	if($strok == ""){$max_strok = $max_strok_abs;}
	  else{$max_strok = sizeof($temp);}
	if($a > $max_strok){break;}
	$text_tmp = "\n<br>$value";
	$text_abs .= $text_tmp;
	}
       $b = 1+$i;
   $gen = FileArray($kod);
   for ($ii = 0; $ii < count($gen); $ii++)
      {
      list($kod_abs,$opis) = explode("::", $gen[$ii]);
       if($kod_abs=="win" ){$act_cod="win";} 
       if($kod_abs=="iso" ){$act_cod="iso";} 
       if($kod_abs=="koir"){$act_cod="koir";} 
       }
       if($strok == ""){
          echo"\n<tr><td>\n<br>$b. <a href=\"robot.php?password_indexs=$password_indexs&action=index_page&act=индексировать_страницу&rr=yes&$act_cod=yes&file=$pag\" title=\"индексировать по новому эту страницу\">$tit</a> |
          <a href=\"robot.php?password_indexs=$password_indexs&action=index_page&del_page=$i&$act_cod=yes\">Стереть</a>  $text_abs
          <br>\n<a href=\"robot.php?password_indexs=$password_indexs&robot=yes&file=$pag\" target=_blank title=\"Посмотреть\">$pag </a> |
          <a href=\"robot.php?password_indexs=$password_indexs&action=index_page&strok=$i&$act_cod=yes\"> Полный текст</a>\n</td></tr>";
          }
          else{
            if($strok == "$i"){
             echo"\n<tr><td>\n<br>$b. <a href=\"robot.php?password_indexs=$password_indexs&action=index_page&act=индексировать_страницу&rr=yes&$act_cod=yes&file=$pag\" title=\"индексировать по новому эту страницу\">$tit</a> |
             <a href=\"robot.php?password_indexs=$password_indexs&action=index_page&del_page=$i&$act_cod=yes\">Стереть</a>  $text_abs
             <br>\n<a href=\"robot.php?password_indexs=$password_indexs&robot=yes&file=$pag\" target=_blank title=\"Посмотреть\">$pag </a> |
             <a href=\"robot.php?password_indexs=$password_indexs&action=index_page&$act_cod=yes\"> Ко всей базе</a>\n</td></tr>";
             break;
            }
          }
       }
     echo"</table>";
    }
    else {echo"\n<table align=center border=0 width=700>\n<tr><td>\n<font $word_s>Нет данных в базе...</font>\n</td></tr>\n</table>";}
  }

}





  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";


echo " 
<br><table align=center width=700><tr><td>
Страничка сгенерирована за: <font $word_s> $mtime</font> секунд.
</td></tr></table></body></html>";

}                                        

if ($password_indexs != "$password_abs")  
   {
   if(empty($log_ip)){if (getenv('HTTP_X_FORWARDED_FOR'))  
   {$log_ip=getenv('HTTP_X_FORWARDED_FOR');} else  
   {$log_ip=getenv('REMOTE_ADDR');}} else  
   {$log_ip=getenv('REMOTE_ADDR');}
     $log_host=@gethostbyaddr("$log_ip");
     $log_date=date('d\.m\.Y, H:i:s');
     $log_file = OpenFile("$dlogs/admin.log","a+");   
     $password_indexs = eregi_replace("<","&lt;","$password_indexs");
     $password_indexs = eregi_replace(">","&gt;","$password_indexs");
     if($password_indexs == "") {  $password_indexs = "не вводил";  }
     fputs ($log_file,"$log_ip<>$log_host<>$log_date<>$password_indexs\n");
     CloseFile ($log_file, "$dlogs/admin.log");
     form();
     echo "</body></html>";
   }             
