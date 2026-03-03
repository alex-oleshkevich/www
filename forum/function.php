<?
function error()
{  
include ("config.inc.php");
$t_error = @file("$dtemplates/forum_error.htm");
$tmp = @file("$dlogs/forumerrors.tmp");
for ($tm = 0; $tm < count($tmp); $tm++)
{ list($er1,$er6,$er7,$er8,$er9)=explode("::", $tmp[$tm]); }
for($e = 0 ; $e < count($t_error); $e++)
{ 
if ($er1 == "yes")  {$t_error[$e] = str_replace("%error1%","<font color=$error_color>$e1</font>",$t_error[$e]);}
if ($er1 == "")     {$t_error[$e] = str_replace("%error1%",$e1,$t_error[$e]);  }
if ($er6 == "yes")  {$t_error[$e] = str_replace("%error6%","<font color=$error_color>$e6</font>",$t_error[$e]); }
if ($er6 == "")     {$t_error[$e] = str_replace("%error6%",$e6,$t_error[$e]); }                                                                     
if ($er7 == "yes")  {$t_error[$e] = str_replace("%error7%","<font color=$error_color>$e7</font>",$t_error[$e]); }
if ($er7 == "")     {$t_error[$e] = str_replace("%error7%",$e7,$t_error[$e]); }
if ($er8 == "yes")  {$t_error[$e] = str_replace("%error8%","<font color=$error_color>$e8</font>",$t_error[$e]); }
if ($er8 == "")     {$t_error[$e] = str_replace("%error8%",$e8,$t_error[$e]);  }
if ($er9 == "yes")  {$t_error[$e] = str_replace("%error9%","<font color=$error_color>$e9</font>",$t_error[$e]); }
if ($er9 == "")     {$t_error[$e] = str_replace("%error9%",$e9,$t_error[$e]);  }
echo $t_error[$e];
}
} 
function form()
{
include("config.inc.php");
echo "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<HTML><HEAD>
   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
   <meta http-equiv=\"DESCRIPTION\" content=\"јдминистрирование\">
   <title>јдмин</title>
</head>
<body $color_body>
<form action=admin.php method=post>
<table border=0 width=700 align=center cellspacing=1 cellpadding=1 $color_table>
<tr><td align=center $color_td><a href=all.php?act=forum>«айти в форум</a></td></tr>
<tr><td align=center $color_td><font $word_s>¬ведите пароль</font></td></tr>
<tr><td align=center $color_td><input type=password name=p size=25></td></tr>
<tr><td align=center $color_td><input type=submit value=¬ойти></td></tr></table>
</form>
";
}  
function broser ($pass_br){
if (eregi("Opera", $pass_br))  {  $broser = "Opera";  }
  else { if (eregi("MSIE", $pass_br)){ $broser = "Explore"; }
         else { if (eregi("Gecko", $pass_br) or eregi("Netscape", $pass_br))
           { $broser = "Netscape"; } } }  
if($broser == ""){$broser = "Robot";} 
return $broser;
}  
$Lock_dir = "lock"; 
function touchString($file) { 
global $Lock_dir; 
$tmp = "$Lock_dir/".$file.".tmp"; 
while(1) { 
if (is_file($tmp)) 
{ 
while(file_exists($tmp)) 
{ 
$file_exist++; 
if($file_exist > 20){break;} 
clearstatcache(); 
sleep(1); 
} 
} 
return touch($tmp); 
} 
} 
function delString($file) { 
global $Lock_dir; 
$tmp = "$Lock_dir/".$file.".tmp"; 
return unlink($tmp); 
}                            
function FileArray($file) { 
if (!is_readable($file)) return FALSE; 
touchString($file); 
$bufer = file($file); 
delString($file); 
return $bufer; 
} 
function OpenFile($file, $mode) { 
touchString($file); 
return fopen($file, $mode); 
} 
function CloseFile($fido, $file) { 
$sito = fclose($fido); 
delString($file); 
return $sito; 
} 
function redirect($cmd){
echo"<SCRIPT language=JavaScript>
     document.location.href=\"$cmd\"
    </SCRIPT>";
  }
function obrez ($ip_pass){
if ( ereg("([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)", $ip_pass, $array)){
$array[3] = substr ( $array[3], 0, 1);
$ip_pass = "$array[1].$array[2].$array[3]"; 
}
else{$ip_pass = "unknown";}
return $ip_pass;
}
function vm($mail)  { if (eregi("^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]{2,4}", $mail)) { return true;} else { return false;} }

function p ($string){ 
 $string = ereg_replace("<br>",          "\n",$string);
 $string = ereg_replace("<b>",           " ",$string);
 $string = ereg_replace("<\/b>",         " ",$string);
 $string = ereg_replace("<i>",           " ",$string);
 $string = ereg_replace("<\/i>",         " ",$string);
 $string = ereg_replace("<u>",           " ",$string);
 $string = ereg_replace("<\/u>",         " ",$string);
 $string = ereg_replace("<ul>",          " ",$string);
 $string = ereg_replace("<\/ul>",        " ",$string);
 $string = ereg_replace("<ol>",          " ",$string);
 $string = ereg_replace("<\/ol>",        " ",$string);
 $string = ereg_replace("<blockquote>",  " ",$string);
 $string = ereg_replace("<\/blockquote>"," ",$string);
 $string = ereg_replace("<li>",          " ",$string);
 $string = ereg_replace("<\/li>",        " ",$string);
 $string = ereg_replace("<img border=0 src=im\/ulibka.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/podmig.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/nevseb.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/glaza.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/umnik.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/shutka.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/zuttt.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/ogorch.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/snob.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/slep.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/xaxa.gif>","",$string);  
 $string = ereg_replace("<img border=0 src=im\/gigi.gif>","",$string);  
 $string = ereg_replace("<img border=0 src=im\/rugat.gif>","",$string);  
 $string = ereg_replace("<img border=0 src=im\/tashus.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/zamech.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/kruto.gif>","",$string);  
 $string = ereg_replace("<img border=0 src=im\/up.gif>","",$string);  
 $string = ereg_replace("<img border=0 src=im\/down.gif>","",$string);
 $string = ereg_replace("<img border=0 src=im\/zlost.gif>","",$string);  
 $string = ereg_replace("<img border=0 src=im\/draznit.gif>","",$string);  
 for( $i=0; ereg("  ",$string); $i++){$string = ereg_replace("  "," ",$string);}
 if(eregi("<[Aa][ \r\n\t]*[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$string)){
 preg_match_all("/<[Aa][ \r\n\t]*[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>/",$string, $array);
  while(list($key, $val) = each ($array[0])){
      $array_p = preg_quote ($val);
      $string = ereg_replace("$array_p","",$string);
     }
 $string = ereg_replace("<\/a>","",$string);
 }   
return $string; 
}
function repl ($string)
{
 $string = ereg_replace("<","&lt;",$string);
 $string = ereg_replace(">","&gt;",$string);
 $string = ereg_replace("::","&#58;&#58;",$string);
return $string; 
}
function replace ($string)
{
 $string = ereg_replace("\"",  "&#34;",$string);
 $string = ereg_replace("\'",  "&#39;",$string);
 $string = ereg_replace("::",  "&#58;&#58;",$string);
 $string = ereg_replace("<",   "&lt;",$string);
 $string = ereg_replace(">",   "&gt;",$string);
 $string = ereg_replace("\\\\","&#92;",$string);
 $string = ereg_replace("\r\n","<br>",$string);
 $string = ereg_replace("\n","<br>",$string);
 return $string;
}

function rep ($string)
{
 $string = ereg_replace("&lt;b&gt;",           "<b>",$string);
 $string = ereg_replace("&lt;\/b&gt;",         "</b>",$string);
 $string = ereg_replace("&lt;i&gt;",           "<i>",$string);
 $string = ereg_replace("&lt;\/i&gt;",         "</i>",$string);
 $string = ereg_replace("&lt;u&gt;",           "<u>",$string);
 $string = ereg_replace("&lt;\/u&gt;",         "</u>",$string);
 $string = ereg_replace("&lt;ul&gt;",          "<ul>",$string);
 $string = ereg_replace("&lt;\/ul&gt;",        "</ul>",$string);
 $string = ereg_replace("&lt;ol&gt;",          "<ol>",$string);
 $string = ereg_replace("&lt;\/ol&gt;",        "</ol>",$string);
 $string = ereg_replace("&lt;blockquote&gt;",  "<blockquote>",$string);
 $string = ereg_replace("&lt;\/blockquote&gt;","</blockquote>",$string);
 $string = ereg_replace("&lt;li&gt;",          "<li>",$string);
 $string = ereg_replace("&lt;\/li&gt;",        "</li>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/ulibka.gif&gt;","<img border=0 src=im/ulibka.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/podmig.gif&gt;","<img border=0 src=im/podmig.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/nevseb.gif&gt;","<img border=0 src=im/nevseb.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/glaza.gif&gt;","<img border=0 src=im/glaza.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/umnik.gif&gt;","<img border=0 src=im/umnik.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/shutka.gif&gt;","<img border=0 src=im/shutka.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/zuttt.gif&gt;","<img border=0 src=im/zuttt.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/ogorch.gif&gt;","<img border=0 src=im/ogorch.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/snob.gif&gt;","<img border=0 src=im/snob.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/slep.gif&gt;","<img border=0 src=im/slep.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/xaxa.gif&gt;","<img border=0 src=im/xaxa.gif>",$string);  
 $string = ereg_replace("&lt;img border=0 src=im\/gigi.gif&gt;","<img border=0 src=im/gigi.gif>",$string);  
 $string = ereg_replace("&lt;img border=0 src=im\/rugat.gif&gt;","<img border=0 src=im/rugat.gif>",$string);  
 $string = ereg_replace("&lt;img border=0 src=im\/tashus.gif&gt;","<img border=0 src=im/tashus.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/zamech.gif&gt;","<img border=0 src=im/zamech.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/kruto.gif&gt;","<img border=0 src=im/kruto.gif>",$string);  
 $string = ereg_replace("&lt;img border=0 src=im\/up.gif&gt;","<img border=0 src=im/up.gif>",$string);  
 $string = ereg_replace("&lt;img border=0 src=im\/down.gif&gt;","<img border=0 src=im/down.gif>",$string);
 $string = ereg_replace("&lt;img border=0 src=im\/zlost.gif&gt;","<img border=0 src=im/zlost.gif>",$string);  
 $string = ereg_replace("&lt;img border=0 src=im\/draznit.gif&gt;","<img border=0 src=im/draznit.gif>",$string);  
 $string = ereg_replace("&lt;\/a&gt;",        "</a>",$string);
 $string = ereg_replace("&lt;a href=","<a href=",$string);
 $string = ereg_replace("&gt;",">",$string);
 return $string;
}

function replaces ($string)
{
 $string = ereg_replace("\&","&#38;",$string);
 $string = ereg_replace("!", "&#33;",$string);
 $string = ereg_replace("\"","&#34;",$string);
 $string = ereg_replace("\\\$","&#36;",$string);
 $string = ereg_replace("%", "&#37;",$string);
 $string = ereg_replace("\'","&#39;",$string);
 $string = ereg_replace("\(","&#40;",$string);
 $string = ereg_replace("\)","&#41;",$string);
 $string = ereg_replace("\*","&#42;",$string);
 $string = ereg_replace("\+","&#43;",$string);
 $string = ereg_replace("\,","&#44;",$string);
 $string = ereg_replace("-", "&#45;",$string);
 $string = ereg_replace("\.","&#46;",$string);
 $string = ereg_replace("\/","&#47;",$string);
 $string = ereg_replace(":", "&#58;",$string);
 $string = ereg_replace("<", "&#60;",$string);
 $string = ereg_replace("=", "&#61;",$string);
 $string = ereg_replace(">", "&#62;",$string);
 $string = ereg_replace("\?","&#63;",$string);
 $string = ereg_replace("@", "&#64;",$string);
 $string = ereg_replace("\[","&#91;",$string);
 $string = ereg_replace("\\\\","&#92;",$string);
 $string = ereg_replace("\]","&#93;",$string);
 $string = ereg_replace("\^","&#94;",$string);
 $string = ereg_replace("_", "&#95;",$string);
 $string = ereg_replace("`", "&#96;",$string);
 $string = ereg_replace("\{","&#123;",$string);
 $string = ereg_replace("\|","&#124;",$string);
 $string = ereg_replace("\}","&#125;",$string);
 $string = ereg_replace("~", "&#126;",$string);
 $string = ereg_replace("И", "&#128;",$string);
 $string = ereg_replace("Й", "&#137;",$string);
 $string = ereg_replace("Л", "&#139;",$string);        
 $string = ereg_replace("С", "&#145;",$string);
 $string = ereg_replace("Т", "&#146;",$string);
 $string = ereg_replace("У", "&#147;",$string);
 $string = ereg_replace("Ф", "&#148;",$string);          
 $string = ereg_replace("Х", "&#149;",$string);
 $string = ereg_replace("Ы", "&#155;",$string);
 $string = ereg_replace("¶", "&#166;",$string);
 $string = ereg_replace("І", "&#167;",$string);
 $string = ereg_replace("©", "&#169;",$string);
 $string = ereg_replace("Ђ", "&#171;",$string);
 $string = ereg_replace("ђ", "&#172;",$string);
 $string = ereg_replace("Ѓ", "&#174;",$string);
 $string = ereg_replace("ї", "&#187;",$string);
 $string = ereg_replace("1&#47;4","&#188;",$string);
 $string = ereg_replace("1&#47;2","&#189;",$string);
 $string = ereg_replace("3&#47;4","&#190;",$string);
 $string = ereg_replace("\r\n","<br>",$string);
 $string = ereg_replace("\n","<br>",$string);
 return $string;
}

function bbcod ($string)
{
  if(ereg("\(url\)", $string)){
    $string = ereg_replace("\(url\)","\n (url)",$string);
    preg_match_all("/\(url\)(.*)\(\/url\)/", $string, $array); 
       while(list($key, $val) = @each ($array[1])){ 
       $val_abs = ereg_replace("%ulibka%",       "",$val);  
       $val_abs = ereg_replace("%podmig%",   "",$val_abs);  
       $val_abs = ereg_replace("%nevseb%",   "",$val_abs);  
       $val_abs = ereg_replace("%glaza%",    "",$val_abs);  
       $val_abs = ereg_replace("%umnik%",    "",$val_abs);  
       $val_abs = ereg_replace("%shutka%",   "",$val_abs);  
       $val_abs = ereg_replace("%zamech%",   "",$val_abs);  
       $val_abs = ereg_replace("%ogorch%",   "",$val_abs);  
       $val_abs = ereg_replace("%snob%",     "",$val_abs);  
       $val_abs = ereg_replace("%xaxa%",     "",$val_abs);  
       $val_abs = ereg_replace("%gigi%",     "",$val_abs);  
       $val_abs = ereg_replace("%slep%",     "",$val_abs);  
       $val_abs = ereg_replace("%rugat%",    "",$val_abs);  
       $val_abs = ereg_replace("%tashus%",   "",$val_abs);  
       $val_abs = ereg_replace("%zuttt%",    "",$val_abs);  
       $val_abs = ereg_replace("%kruto%",    "",$val_abs);  
       $val_abs = ereg_replace("%up%",       "",$val_abs);  
       $val_abs = ereg_replace("%down%",     "",$val_abs);  
       $val_abs = ereg_replace("%fuck%",     "",$val_abs);  
       $val_abs = ereg_replace("%zlost%",    "",$val_abs);  
       $val_abs = ereg_replace("%draznit%",  "",$val_abs);  
       $val_abs = ereg_replace("\[b\]",      "",$val_abs);
       $val_abs = ereg_replace("\[\/b\]",    "",$val_abs);
       $val_abs = ereg_replace("\[i\]",      "",$val_abs);
       $val_abs = ereg_replace("\[\/i\]",    "",$val_abs);
       $val_abs = ereg_replace("\[u\]",      "",$val_abs);
       $val_abs = ereg_replace("\[\/u\]",    "",$val_abs);
       $val_abs = ereg_replace("\[q\]",      "",$val_abs);
       $val_abs = ereg_replace("\[\/q\]",    "",$val_abs);
       $val_abs = ereg_replace("\[list\]",   "",$val_abs);
       $val_abs = ereg_replace("\[\/list\]", "",$val_abs);
       $val_abs = ereg_replace("\[listn\]",  "",$val_abs);
       $val_abs = ereg_replace("\[\/listn\]","",$val_abs);
       $val_abs = ereg_replace(" ",          "",$val_abs);
       $array_p = preg_quote ($val);
       $string = ereg_replace("\(url\)$array_p\(\/url\)"," <a href=$val_abs target=_blank title=посмотреть> $val_abs </a> ",$string);
      }
   }                     
 $string = ereg_replace("%ulibka%", " <img border=0 src=im/ulibka.gif> ",$string);  
 $string = ereg_replace("%podmig%", " <img border=0 src=im/podmig.gif> ",$string);  
 $string = ereg_replace("%nevseb%", " <img border=0 src=im/nevseb.gif> ",$string);  
 $string = ereg_replace("%glaza%",  " <img border=0 src=im/glaza.gif> ",$string);  
 $string = ereg_replace("%umnik%",  " <img border=0 src=im/umnik.gif> ",$string);  
 $string = ereg_replace("%shutka%", " <img border=0 src=im/shutka.gif> ",$string);  
 $string = ereg_replace("%zamech%", " <img border=0 src=im/zamech.gif> ",$string);  
 $string = ereg_replace("%ogorch%", " <img border=0 src=im/ogorch.gif> ",$string);  
 $string = ereg_replace("%snob%",   " <img border=0 src=im/snob.gif> ",$string);  
 $string = ereg_replace("%xaxa%",   " <img border=0 src=im/xaxa.gif> ",$string);  
 $string = ereg_replace("%gigi%",   " <img border=0 src=im/gigi.gif> ",$string);  
 $string = ereg_replace("%slep%",   " <img border=0 src=im/slep.gif> ",$string);  
 $string = ereg_replace("%rugat%",  " <img border=0 src=im/rugat.gif> ",$string);  
 $string = ereg_replace("%tashus%", " <img border=0 src=im/tashus.gif> ",$string);  
 $string = ereg_replace("%zuttt%",  " <img border=0 src=im/zuttt.gif> ",$string);  
 $string = ereg_replace("%kruto%",  " <img border=0 src=im/kruto.gif> ",$string);  
 $string = ereg_replace("%up%",     " <img border=0 src=im/up.gif> ",$string);  
 $string = ereg_replace("%down%",   " <img border=0 src=im/down.gif> ",$string);  
 $string = ereg_replace("%zlost%",  " <img border=0 src=im/zlost.gif> ",$string);  
 $string = ereg_replace("%draznit%"," <img border=0 src=im/draznit.gif> ",$string);  
 $string = ereg_replace("\[b\]"," <b> ",$string);
 $string = ereg_replace("\[\/b\]"," </b> ",$string);
 $string = ereg_replace("\[i\]"," <i> ",$string);
 $string = ereg_replace("\[\/i\]"," </i> ",$string);
 $string = ereg_replace("\[u\]"," <u> ",$string);
 $string = ereg_replace("\[\/u\]"," </u> ",$string);
 $string = ereg_replace("\[q\]"," <blockquote> ",$string);
 $string = ereg_replace("\[\/q\]"," </blockquote> ",$string);
 if(ereg("\[list\].+\[\/list\]", $string, $array)){
 $array_p = preg_quote ($array[0]);
 $string = ereg_replace("$array_p"," <ul> $array[0] </ul> ",$string);
 $string = ereg_replace("\[list\]"," <li> ",$string);
 $string = ereg_replace("\[\/list\]"," </li> ",$string);
  }
 if(ereg("\[listn\].+\[\/listn\]", $string, $array)){
 $array_p = preg_quote ($array[0]);
 $string = ereg_replace("$array_p"," <ol> $array[0] </ol> ",$string);
 $string = ereg_replace("\[listn\]"," <li> ",$string);
 $string = ereg_replace("\[\/listn\]"," </li> ",$string);
  }
return $string;
}

function light ($str){ 
$a = "<font color=000000>"; $b = "<font color=0000ff>"; 
$c = "<font color=000080>"; $d = "<font color=ff0000>"; 
$tring="spliti preg_match_all Location elseif touch unlink split abs microtime else empty eregi_replace eregi trim strlen explode list int count ereg_replace substr break if echo date time function usort fclose fputs fopen foreach mail file_exists global sleep return is_file while getenv FALSE is_readable clearstatcache exit header array gethostbyaddr setcookie sizeof flock filesize str_replace include ereg file for each"; 
$cheng = explode (" ", $tring); 
$strok = explode (" ", $str);
$str="";
for($ii=0; $ii < sizeof($strok); $ii++){
       for($i=0; $i < sizeof($cheng); $i++){ 
          if(eregi("$cheng[$i]", $strok[$ii])){ 
          preg_match_all("/(^|[^a-zA-Z0-9_%\$])($cheng[$i])([^a-zA-Z0-9_]|$)/", $strok[$ii], $array); 
              while(list($key, $val) = each ($array[0])){ 
                   $strok[$ii] = eregi_replace ("$cheng[$i]","<b>$cheng[$i]</b>",$strok[$ii]); 
                   } 
          } 
       } 
$str .= " $strok[$ii]";
}
$str = eregi_replace ("\(",    "$b<b>(</b></font>",     $str);
$str = eregi_replace ("\)",    "$b<b>)</b></font>",     $str);
$str = eregi_replace ("\{",    "$b<b>{</b></font>",     $str);
$str = eregi_replace ("\}",    "$b<b>}</b></font>",     $str);
$str = eregi_replace ("&lt;\?","$d<b>&lt;?</b></font>", $str);
$str = eregi_replace ("\?&gt;","$d<b>?&gt;</b></font>", $str);
$str = eregi_replace ("&lt;html&gt;","$d&lt;html&gt;</font>", $str);
$str = eregi_replace ("&lt;\/html&gt;","$d&lt;/html&gt;</font>", $str);
$str = eregi_replace ("&lt;body&gt;","$d&lt;body&gt;</font>", $str);
$str = eregi_replace ("&lt;\/body&gt;","$d&lt;/body&gt;</font>", $str);
$str = eregi_replace ("\?>","$d<b>?&gt;</b></font>", $str);
$str = eregi_replace ("&lt;html>","$d&lt;html&gt;</font>", $str);
$str = eregi_replace ("&lt;\/html>","$d&lt;/html&gt;</font>", $str);
$str = eregi_replace ("&lt;body>","$d&lt;body&gt;</font>", $str);
$str = eregi_replace ("&lt;\/body>","$d&lt;/body&gt;</font>", $str);
$cheng = explode (" ", $str);
$str ="";
for($i=0; $i < sizeof($cheng); $i++){
if (eregi("(^|[^\w\W]*)(\\\${1,2}[\w]*)([^\W]*|$)", $cheng[$i])){ 
preg_match_all("/(^|[^\w\W]*)(\\\${1,2}[\w]*)([^\W]*|$)/", $cheng[$i], $array); 
while(list($key, $val) = each ($array[0])){ 
list($a1,$a2) = explode ("\$",$val); 
$val_sss = "\\" ."\$" ."$a2"; 
$val = "\$"."$a2"; 
$cheng[$i] = eregi_replace ("$val_sss", "$c$val</font>", $cheng[$i]); 
} 
}  
$str .= " $cheng[$i]";
}
return $str; 
} 
function chist ($message){
$message = trim($message);  
for( $i=0; eregi("\r\n\r\n",$message); $i++)
{$message = ereg_replace("\r\n\r\n","\r\n",$message);}
for( $i=0; eregi("\n\n",$message); $i++)
{$message = ereg_replace("\n\n","\n",$message);} 
for( $i=0; eregi("  ",$message); $i++)
{$message = ereg_replace("  "," ",$message);} 
return $message;
}
function razrez ($message){
global $mlwim;
$f = $mlwim;   
$e = explode(" ",$message);
for ($a = 0; $a < sizeof($e); $a++)  
  { 
   $o = strlen($e[$a]);  $b = 0;  $q = $o;
   while($q > 0)  { $s[$b] = substr ($e[$a], $f*$b, $f); $q = $q - $f;  $b++;  }
   for ($c=0; $c < sizeof($s); $c++)  { $h[] = $s[$c]; }
   $s="";
   }
   for ($d = 0; $d < sizeof($h); $d++) { $r .= $h[$d]." "; }    
return $r;
}
?>
