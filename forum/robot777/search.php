<?
$time1 = time();
$time_m1 = microtime();

include("config.inc.php");
include("function.php");

          
if(isset($_GET)){while(list($key,$value)=each($_GET)){ $$key=$value;}}
if(isset($HTTP_COOKIE_VARS)){foreach($HTTP_COOKIE_VARS as $key=>$value ){$$key=$value;}}
$PARAMS = (isset($HTTP_POST_VARS)) ? $HTTP_POST_VARS : $HTTP_GET_VARS;
foreach( $PARAMS as $key => $value ) {$$key=$value;}
$REQUEST_URI = $HTTP_SERVER_VARS["REQUEST_URI"];
$HTTP_HOST = $HTTP_SERVER_VARS["HTTP_HOST"];
$server = "http://" ."$HTTP_HOST" ."$REQUEST_URI";
eregi ("(.*)/forum777", $server, $server_obr);
$HTTP_HOST = $server_obr[1]; 
$user_agent = $HTTP_SERVER_VARS["HTTP_USER_AGENT"];  
$user_agent = broser ($user_agent);
if($user_agent == "Robot"){redirect("error.htm");exit;}


if($robot == "yes"){
list($a1,$filename)=explode("file=", $HTTP_SERVER_VARS["REQUEST_URI"]); 
list($file,$a1)=explode("&word_search=", $filename);
list($a1,$w_search)=explode("word_search=", $filename);
$w_search = decod ($w_search);
$w_sear = $w_search;
$nadpis1="вы искали:";
$nadpis2="на странице:";
if($kodir == "iso"){
  $w_search = convertIsoHtml($w_search);
  $nadpis1 = convertIsoHtml($nadpis1);
  $nadpis2 = convertIsoHtml($nadpis2);
  }
if($kodir == "koir"){
  $w_search = convertKoirHtml($w_search);
  $nadpis1 = convertKoirHtml($nadpis1);
  $nadpis2 = convertKoirHtml($nadpis2);
  }
$w_search = replace ($w_search);
$w_search = replace_html ($w_search);
$w_search = ereg_replace ("\#", "\#", $w_search);
$w_search = ereg_replace ("\,", "\,", $w_search);
$word_searcha = explode(" ", $w_search);

echo"
<table border=0 cellspacing=1 width=100% cellpadding=1>
<tr><td><b>$nadpis1 </b><font $word_s>$w_sear</font> $nadpis2 <a href=\"$file\">$file</a> <br>
</td></tr></table><br>";


if(isset($file)){                            
$file_name = @implode("",@file("$file"));
$file_n = explode("\n", $file_name);
if(isset($file_n)){
  $general = FileArray("$base_domen");
  for ( $i = 0;  $i < count($general); $i++){list($domen,$server)=explode("::", $general[$i]);}
  $server = eregi_replace("admin.php", "", $server);

   for ($i = 0; $i < sizeof($file_n); $i++){
   $file_n[$i] = replace_links ($file_n[$i]);

   if(eregi("body",$file_n[$i])){$body="1";}
    if($body>="1"){
       if(eregi("$w_search", $file_n[$i])){
         eregi("<[Aa][ \r\n\t]*[^>]*[Hh][Rr][Ee][Ff][^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array1);
       if(eregi("$w_search", $array1[1])){$f="no";}
         eregi("<[.]*[ \r\n\t]*[^>]*[Vv][Aa][Ll][Uu][Ee][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array2);
       if(eregi("$w_search", $array2[1])){$f="no";}
         eregi("<[.]*[ \r\n\t]*[^>]*[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array3);
       if(eregi("$w_search", $array3[1])){$f="no";}
         eregi("<[.]*[ \r\n\t]*[^>]*[Ss][Rr][Cc][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array4);
       if(eregi("$w_search", $array4[1])){$f="no";}
             eregi("<[.]*[ \r\n\t]*[^>]*[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>])*>","$file_n[$i]",$array5);
       if(eregi("$w_search", $array5[1])){$f="no";} 
          if($f!="no"){
          $file_n[$i] = eregi_replace ("$w_search", "<span style=\"background-color: FFFF00\"><b>$w_search</b></span>", $file_n[$i]); 
          $file_n[$i] = eregi_replace ("&\\\#37;", "&#37;", $file_n[$i]);
          $file_n[$i] = eregi_replace ("&\\\#33;", "&#33;", $file_n[$i]);
          }                                          
        }   
       else{
          for ($a = 0; $a < sizeof($word_searcha); $a++)  
             {
              if(strlen($word_searcha[$a]) > 2){
                $word_searcha[$a]= obrez_word($word_searcha[$a]);
                   eregi("<[Aa][ \r\n\t]*[^>]*[Hh][Rr][Ee][Ff][^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array6);
                 if(eregi("$word_searcha[$a]", $array6[1])){$f="no";}
                   eregi("<[.]*[ \r\n\t]*[^>]*[Vv][Aa][Ll][Uu][Ee][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array7);
                 if(eregi("$word_searcha[$a]", $array7[1])){$f="no";}
                   eregi("<[.]*[ \r\n\t]*[^>]*[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array8);
                 if(eregi("$word_searcha[$a]", $array8[1])){$f="no";}
                   eregi("<[.]*[ \r\n\t]*[^>]*[Ss][Rr][Cc][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array9);
                 if(eregi("$word_searcha[$a]", $array9[1])){$f="no";}
                   eregi("<[.]*[ \r\n\t]*[^>]*[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=([ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*)>","$file_n[$i]",$array10);
                 if(eregi("$word_searcha[$a]", $array10[1])){$f="no";} 
                 if($f!="no"){
                 $file_n[$i] = eregi_replace ("$word_searcha[$a]", "<span style=\"background-color: FFFF00\"><b>$word_searcha[$a]</b></span>", $file_n[$i]); 
                 $file_n[$i] = eregi_replace ("&\\\#37;", "&#37;", $file_n[$i]);
                 $file_n[$i] = eregi_replace ("&\\\#33;", "&#33;", $file_n[$i]);
                 }  
                }
             }
           }
         }
    echo"$file_n[$i]"; 
   }
 }
   else{echo"<font $word_s>Не смог открыть:</font> <a href=\"$file\">$file</a>";}
}
else{echo"<font $word_s>Не смог открыть:</font> <a href=\"$file\">$file</a>";}
echo"</body></html>";
exit;
}

if (isset($_POST["query"]))
{
  $titlel = "$title $titl";
  $general = FileArray("$base_domen");
  for ( $i = 0;  $i < count($general); $i++){list($domen,$server)=explode("::", $general[$i]);}

$t_mha = file("../$dtemplates/index_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%title%",$titlel,$t_mha[$mha]);
     $t_mha[$mha] = replace_links ($t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    }
$t_mha = file("../$dtemplates/forum_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%action%",$HTTP_HOST,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%title%",$title,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%titl%",$titl,$t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    }     
      
$search = trim($_POST["query"]);
$sear=replace($search);
if($sear ==""){$sear = "<font $word_s>вы ничего не ввели в строку запроса...</font>";}
echo"Вы искали: <b>$sear</b>";
if (strlen(trim($_POST["query"])) < 3)
{
echo "<BR><br>Слишком короткие запросы не обрабатываются. 
      <br><font $word>Используйте не менее 3 символов.</font><BR><BR>";
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
  
  echo "<br><p align=center><a href=\"../all.php?act=forum\">| На первую страницу $titlel |</a></p><br><br>";  
  
  $t_mha = @file("../$dtemplates/index_end.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = replace_links ($t_mha[$mha]);
     echo "$t_mha[$mha]";
     }
exit;
}
$searchstring = $sear;
$searchstring = ruLow($searchstring);
$searchword = explode (" ",$searchstring); 
$allwords = count($searchword); 
 
$FILE = FileArray("$base_page");
$count = count($FILE);

for ($x = 0; $x < $count; $x++) 
{

list($filename,$title,$kodir,$content) = explode("::",$FILE[$x]);
$temp = explode("<|>",$content);
$true = $find = $full_result = $long = 0;
		
foreach($temp as $key => $value) 
 {
  $value = ruLow($value);
  $value = "<font $word_a>$value</font>";
  if($allwords > 1) 
    {
	$new = str_replace($searchstring,"</font>".$searchstring."<font $word_a>",$value);
	if($new != $value)
	{
         $find++;
         $true = 1;
	 $show[$find] = $new;
	 $full_result++; 
	}
    }
   for ($all = 0; $all < $allwords; $all++) 
      {	
      $chekfull = explode(" ",$value);
       if(in_array($searchword[$all],$chekfull))
       $full_result++;	
    
        if(strlen($searchword[$all]) > 2){
          $searchword[$all]= obrez_word($searchword[$all]);
	  $new = str_replace($searchword[$all], "</font>".$searchword[$all]."<font $word_a>", $value);
	  if($new != $value)
	   {
	   $find++;
	   $true = 1;
	   $show[$find] = $new;
	   }
	}
     }
 }	

      if ($true !== 0)
	{
	$aaa++;
	if($full_result > 1){$fu_result = "<b>$full_result</b>";} else{$fu_result = "<font $word_a>$full_result</font>";}
	$fulltrue = 1;
	echo "\n<br><br>$aaa. <a href=\"$filename\">$title</a>\n<br><font $word_a> $find совпадений (точных -</font> $fu_result<font $word_a>):</font><br>";
	
	if ($find > $max_strok_abs) {$STROK = $max_strok_abs;} 
	else {	$STROK = $find; } 
	for ($a = 1; $a < $STROK+1; $a++) 
	{
	echo "\n...$show[$a]...";
	}
	if($prosmotr_word == "yes" ){
	$search = cod($search);
	echo"\n<br><a href=\"search.php?robot=yes&kodir=$kodir&file=$filename&word_search=$search\">Показать найденные слова</a>";
	}
	}
}

if(!isset($fulltrue)){echo "<br><br><font $word_s>К сожалению, по Вашему запросу ничего не найдено!</font>"; }

echo "<br><br>Всего обработано <font $word>$count файлов</font><br><br>";
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
  
echo "<br><p align=center><a href=\"../all.php?act=forum\">| На первую страницу $titlel |</a></p><br><br>";  
  $t_mha = @file("../$dtemplates/index_end_web.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = replace_links ($t_mha[$mha]);
     echo "$t_mha[$mha]";
     }
exit;
}
else{
$titlel = "$title $titl.";
$t_mha = file("../$dtemplates/index_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%title%",$titlel,$t_mha[$mha]);
     $t_mha[$mha] = replace_links ($t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    }
$t_mha = file("../$dtemplates/forum_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%action%",$HTTP_HOST,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%title%",$title,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%titl%",$titl,$t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    }    
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
echo "<br><p align=center><a href=\"../all.php?act=forum\">| На первую страницу $titlel |</a></p><br><br>";  
  $t_mha = @file("../$dtemplates/index_end_web.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = replace_links ($t_mha[$mha]);
     echo "$t_mha[$mha]";
     }    
}
?>   
