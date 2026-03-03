<?
function broser ($pass_br){
if (eregi("Opera", $pass_br))  {  $broser = "Opera";  }
  else { if (eregi("MSIE", $pass_br)){ $broser = "Explore"; }
         else { if (eregi("Gecko", $pass_br) or eregi("Netscape", $pass_br))
           { $broser = "Netscape"; } } }  
if($broser == ""){$broser = "Robot";} 
return $broser;
}  

function redirect($cmd){
echo"<SCRIPT language=JavaScript>
     document.location.href=\"$cmd\"
    </SCRIPT>";
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
function form()
{
include("config.inc.php");
echo "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<HTML><HEAD>
   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
   <meta http-equiv=\"DESCRIPTION\" content=\"Àäìèíèñòğèğîâàíèå\">
   <title>Àäìèí ïîèñê - ğîáîò 777</title>
</head>
<body $color_body>
<form action=robot.php method=post>
<table border=0 width=600 align=center cellspacing=1 cellpadding=1 $color_table>
<tr><td align=center $color_td><font $word_s>Ââåäèòå ïàğîëü</font></td></tr>
<tr><td align=center $color_td><input type=password name=password_indexs size=25></td></tr>
<tr><td align=center $color_td><input type=submit value=Âîéòè></td></tr></table>
</form>
";
}
function striplinks(){	
global $pag, $base, $domen, $bad_link, $server, $password_indexs;
echo"\n<table align=center width=700><tr><td>";
if(isset($pag)){
echo"\n Ïğîâåğèë ññûëêè: <a href=\"robot.php?password_indexs=$password_indexs&robot=yes&file=$pag\" target=_blank title=\"Ïîñìîòğåòü\">$pag</a></font> ";

$file_name = @implode("",@file("$pag"));
if(isset($file_name)){ 
preg_match_all("/<[Aa][ \r\n\t]{1}[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>/",$file_name,$url_list); 
  }      
if(isset($url_list)){
$a=0;
foreach ($url_list as $url_temp){foreach ($url_temp as $url){$a++;}}
}

$general = FileArray ($base);
$fp = OpenFile ($base, "w");

if($a != 0){ 
$general_bad_link = FileArray ($bad_link);
$lines_bad_link = count($general_bad_link);

foreach ($url_list as $url_temp){ 
        foreach ($url_temp as $url){ 
         if(eregi("href",$url) or eregi("javascript",$url) or eregi("mailto",$url) or eregi("#",$url)) {}
         else{
               for ( $i = 0;  $i < $lines_bad_link; $i++)
                  {
                   list($bad,$opis) =  explode("::", $general_bad_link[$i]);
                   if(eregi("$bad",$url)) { break;}
                   $bad = "";
                   }

               if($bad == ""){  
                    
                    for ( $i = 0;  $i <= count($general); $i++)
                       {          
                        list($page,$fact)=explode("::", $general[$i]);
                        if(eregi("^[http].*", $url)){if ($page == "$url"){ break; }}
                          else{if ($page == "$domen/$url"){ break; }} 
                        if ($i == count($general)){
                          $new++; 
                          if(eregi("^[http].*", $url)){fputs ($fp,"$url::::\n");}
                            else{ fputs ($fp,"$domen/$url::::\n"); }
                          }
                       }
                  }
             
             }
          }      
       }          
  if($new !=""){echo" <font color=ff0000> new: $new </font>";  }
            for ( $i = 0;  $i < count($general); $i++)
             {        
             $link = $page = "";
             list($page,$fact)=explode("::", $general[$i]);
             if($page != ""){
             if ($fact !=""){$link = "old";}
                if($link == "old")                 { fputs ($fp,"$page::$fact::\n");  }
                if($link != "old" and $page != $pag) { fputs ($fp,"$page::::\n");       }
                if($link != "old" and $page == $pag) { fputs ($fp,"$page::ok::\n");     }
                 }
             }
    }
 else{
            for ( $i = 0;  $i < count($general); $i++)
             {        
             list($page,$fact)=explode("::", $general[$i]);
             if ($page == $pag){ fputs ($fp,"$page::bad::\n"); }
             else{fputs ($fp,"$general[$i]");}
             }
  }                                   
CloseFile($fp, $base);
}
else{echo"Íåò ñòğàíèöû äëÿ îòîáğàæåíèÿ";}
echo"</td></tr></table>";
}

function indexer(){
global $pag, $base_page, $point, $title_line, $iso, $koir, $word_s, $password_indexs;
if(isset($pag)){                            
$file_name = @implode("",@file("$pag"));
echo"\n<table align=center border=0 width=700><tr><td>";

if(isset($file_name)){
 
@list($start,$end) = spliti("</title>",$file_name,2);
@list($recycle,$title) = spliti("<title>",$start,2);
if (isset($title)){
   $title= htmlspecialchars ($title); 
   $title= ereg_replace("\n"," ",$title);
   $title= ereg_replace("&quot;","\"",$title);
   if(strlen ($title)>$title_line){$title = substr($title, 0, $title_line);}
   if($iso == "yes"){$title = convertIso($title); $kodir="iso";}
   if($koir == "yes"){$title = convertKoir($title);$kodir="koir";}
   if($iso == "yes" or $koir == "yes") {
     $title = ruLow($title);
     $title = ucfirst ($title);
     }
  if(ereg("&quot;", $title)) {ereg_replace("&quot;", "\"", $title);}
  }
  else{$title = "Ñòğàíèöà áåç íàçâàíèÿ";}
   if($iso == "yes") {$kodir="iso";}
   if($koir == "yes"){$kodir="koir";}
   if($kodir=="" or !isset($kodir)){$kodir="win";}
  $general = FileArray($point);
  for ($i = 0; $i < count($general); $i++){
  list($point1,$point2) = explode("::","$general[$i]");
   }
   eregi("$point1(.*)$point2", $file_name, $regs);
   if(isset($regs[1])){
   $text = strip_tags($regs[1]);
   $text = preg_replace("/[><]+/"," ",$text);
   $text = preg_replace ("/[\s]+/", " ", $text);
   if($iso == "yes"){$text = convertIso($text);}
   if($koir == "yes"){$text = convertKoir($text);}
   $text = ruLow($text);
   $text = wordwrap ($text, 80, "<|>");
   if($text ==" "){$text ="Íåò òåêñòà äëÿ îòîáğàæåíèÿ...";}
    }
    else {$text ="Íåò òåêñòà äëÿ îòîáğàæåíèÿ...";}
      $general = FileArray($base_page);
      $lines = count($general);
      for ($i = 0; $i <= $lines; $i++){
       list($pag_abs,$title_abs,$kodir_abs,$text_abs) = explode("::","$general[$i]");
       if($pag_abs == $pag){
               $gen = FileArray($base_page);
               $fp = OpenFile($base_page, "w");
               for ($ii = 0; $ii <= $lines; $ii++){
                   if($ii == $i){fputs($fp, "$pag::$title::$kodir::$text::\n");}
                   else{fputs($fp, "$gen[$ii]");}
                  }
               CloseFile ($fp, $base_page);
               echo"\nÏğîâåğèë òåêñò:  <a href=\"robot.php?password_indexs=$password_indexs&robot=yes&kodir=$kodir&file=$pag\" target=_blank title=\"Ïîñìîòğåòü\">$title</a>";
               $ric=1;
         }
       if($i == $lines and $ric!="1"){
       $fp = OpenFile($base_page, "a+");
       fputs($fp, "$pag::$title::$kodir::$text::\n");
       CloseFile ($fp, $base_page);
       echo"\nÏğîâåğèë òåêñò: <a href=\"robot.php?password_indexs=$password_indexs&robot=yes&kodir=$kodir&file=$pag\" target=_blank title=\"Ïîñìîòğåòü\">$title</a>";
       }
      }
 }
 else{
     echo"\n<font $word_s>Íå ñìîã îòêğûòü:</font> <a href=\"robot.php?password_indexs=$password_indexs&robot=yes&kodir=$kodir&file=$pag\" target=_blank title=\"Ïîñìîòğåòü\">$pag</a>";
     }
}
echo"</td></tr></table>";
}

function replace ($string)
{
 $string = ereg_replace("!","&#33;",$string);
 $string = ereg_replace("%","&#37;",$string);
 $string = ereg_replace("<","&lt;",$string);
 $string = ereg_replace(">","&gt;",$string);
 $string = ereg_replace('\"','&quot;',$string);
 $string = ereg_replace("\r\n","<br>",$string);
 $string = ereg_replace("\n","<br>",$string);
 return $string;
}
        
function replace_html ($string){
 $string = preg_quote ($string, "/");
 return $string;
}

function ruLow($string)
{
$down = strtr($string,
'ÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÚÛÜİŞßQWERTYUIOPASDFGHJKLZXCVBNM',
'àáâãäå¸æçèéêëìíîïğñòóôõö÷øùúûüışÿqwertyuiopasdfghjklzxcvbnm');
return $down;
}

function convertIso($string)
{
$down = strtr($string,
'ÁÂ×ÇÄÅ¨ÖÚÉÊËÌÍÎÏĞÒÓÔÕÆÈÃŞÛİßÙØüÀÑáâ÷çäå¸öúéêëìíîïğòóôõæèãşûıÿùøÜàñ',
'àáâãäå¸æçèéêëìíîïğñòóôõö÷øùúûüışÿÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÚÛÜİŞß'); 
return $down;
}

function convertIsoHtml($string)
{
$down = strtr($string,
'àáâãäå¸æçèéêëìíîïğñòóôõö÷øùúûüışÿÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÚÛÜİŞß',
'ÁÂ×ÇÄÅ¨ÖÚÉÊËÌÍÎÏĞÒÓÔÕÆÈÃŞÛİßÙØÜÀÑáâ÷çäå¸öúéêëìíîïğòóôõæèãşûıÿùøüàñ'); 
return $down;
}
                                      
function convertKoir($string)
{
$down = strtr($string,
'ĞÑÒÓÔÕ¨Ö×ØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòó´õ¸ö÷øùúûüışÿÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏ',
'àáâãäå¸æçèéêëìíîïğñòóôõö÷øùúûüışÿÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÚÛÜİŞß');
return $down;
}

function convertKoirHtml($string)
{
$down = strtr($string,
'àáâãäå¸æçèéêëìíîïğñòóôõö÷øùúûüışÿÀÁÂÃÄÅ¨ÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÚÛÜİŞß',
'ĞÑÒÓÔÕ¨Ö×ØÙÚÛÜİŞßàáâãäåæçèéêëìíîïğñòóôõ¸ö÷øùúûüışÿÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏ');
return $down;
}

function cod($string)
{
$string = ereg_replace("à","%D0%B0",$string);
$string = ereg_replace("á","%D0%B1",$string);
$string = ereg_replace("â","%D0%B2",$string);
$string = ereg_replace("ã","%D0%B3",$string);
$string = ereg_replace("ä","%D0%B4",$string);
$string = ereg_replace("å","%D0%B5",$string);
$string = ereg_replace("¸","%D1%91",$string);
$string = ereg_replace("æ","%D0%B6",$string);
$string = ereg_replace("ç","%D0%B7",$string);
$string = ereg_replace("è","%D0%B8",$string);
$string = ereg_replace("é","%D0%B9",$string);
$string = ereg_replace("ê","%D0%BA",$string);
$string = ereg_replace("æ","%D0%B6",$string); 
$string = ereg_replace("ç","%D0%B7",$string); 
$string = ereg_replace("è","%D0%B8",$string); 
$string = ereg_replace("é","%D0%B9",$string); 
$string = ereg_replace("ê","%D0%BA",$string); 
$string = ereg_replace("ë","%D0%BB",$string); 
$string = ereg_replace("ì","%D0%BC",$string); 
$string = ereg_replace("í","%D0%BD",$string); 
$string = ereg_replace("î","%D0%BE",$string); 
$string = ereg_replace("ï","%D0%BF",$string); 
$string = ereg_replace("ğ","%D1%80",$string); 
$string = ereg_replace("ñ","%D1%81",$string); 
$string = ereg_replace("ò","%D1%82",$string); 
$string = ereg_replace("ó","%D1%83",$string); 
$string = ereg_replace("ô","%D1%84",$string); 
$string = ereg_replace("õ","%D1%85",$string); 
$string = ereg_replace("ö","%D1%86",$string); 
$string = ereg_replace("÷","%D1%87",$string); 
$string = ereg_replace("ø","%D1%88",$string); 
$string = ereg_replace("ù","%D1%89",$string); 
$string = ereg_replace("ú","%D1%8A",$string); 
$string = ereg_replace("û","%D1%8B",$string); 
$string = ereg_replace("ü","%D1%8C",$string); 
$string = ereg_replace("ı","%D1%8D",$string); 
$string = ereg_replace("ş","%D1%8E",$string); 
$string = ereg_replace("ÿ","%D1%8F",$string); 
$string = ereg_replace("À","%D0%90",$string); 
$string = ereg_replace("Á","%D0%91",$string); 
$string = ereg_replace("Â","%D0%92",$string); 
$string = ereg_replace("Ã","%D0%93",$string); 
$string = ereg_replace("Ä","%D0%94",$string); 
$string = ereg_replace("Å","%D0%95",$string); 
$string = ereg_replace("¨","%D0%81",$string);   
$string = ereg_replace("Æ","%D0%96",$string); 
$string = ereg_replace("Ç","%D0%97",$string); 
$string = ereg_replace("È","%D0%98",$string); 
$string = ereg_replace("É","%D0%99",$string); 
$string = ereg_replace("Ê","%D0%9A",$string); 
$string = ereg_replace("Ë","%D0%9B",$string); 
$string = ereg_replace("Ì","%D0%9C",$string); 
$string = ereg_replace("Í","%D0%9D",$string); 
$string = ereg_replace("Î","%D0%9E",$string); 
$string = ereg_replace("Ï","%D0%9F",$string); 
$string = ereg_replace("Ğ","%D0%A0",$string);
$string = ereg_replace("Ñ","%D0%A1",$string); 
$string = ereg_replace("Ò","%D0%A2",$string);         
$string = ereg_replace("Ó","%D0%A3",$string); 
$string = ereg_replace("Ô","%D0%A4",$string); 
$string = ereg_replace("Õ","%D0%A5",$string); 
$string = ereg_replace("Ö","%D0%A6",$string); 
$string = ereg_replace("×","%D0%A7",$string); 
$string = ereg_replace("Ø","%D0%A8",$string); 
$string = ereg_replace("Ù","%D0%A9",$string); 
$string = ereg_replace("Ú","%D0%AA",$string); 
$string = ereg_replace("Û","%D0%AB",$string); 
$string = ereg_replace("Ü","%D0%AC",$string); 
$string = ereg_replace("İ","%D0%AD",$string); 
$string = ereg_replace("Ş","%D0%AE",$string); 
$string = ereg_replace("ß","%D0%AF",$string); 
$string = ereg_replace("\\\%","&#37;",$string);
$string = ereg_replace("!","&#33;",$string);
$string = ereg_replace("@","%21",$string);
$string = ereg_replace("\#","%22",$string); 
$string = ereg_replace("\\\$","%23",$string);      
$string = ereg_replace("\^","%25",$string); 
$string = ereg_replace("&","%26",$string);
$string = ereg_replace("\*","%27",$string);
$string = ereg_replace("\(","%28",$string); 
$string = ereg_replace("\)","%29",$string);
$string = ereg_replace("\+","%30",$string); 
$string = ereg_replace("\|","%31",$string);
$string = ereg_replace("~","%32",$string);     
$string = ereg_replace("`","%33",$string); 
$string = ereg_replace("\=","%34",$string);
$string = ereg_replace("\\\\","%35",$string);
$string = ereg_replace("\/","%36",$string); 
$string = ereg_replace("\[","%37",$string);
$string = ereg_replace("\]","%38",$string);
$string = ereg_replace("\{","%39",$string); 
$string = ereg_replace("\}","%40",$string);
$string = ereg_replace(":","%41",$string);
$string = ereg_replace("\"","%42",$string);
$string = ereg_replace("'","%43",$string); 
$string = ereg_replace("<","%44",$string);
$string = ereg_replace(">","%45",$string);
$string = ereg_replace("\?","%46",$string);
$string = ereg_replace(" ","%47",$string);
return $string;
}                    

function decod($string)
{
$string = ereg_replace("%D0%B0","à",$string);
$string = ereg_replace("%D0%B1","á",$string);
$string = ereg_replace("%D0%B2","â",$string);
$string = ereg_replace("%D0%B3","ã",$string);
$string = ereg_replace("%D0%B4","ä",$string);
$string = ereg_replace("%D0%B5","å",$string);
$string = ereg_replace("%D1%91","¸",$string);
$string = ereg_replace("%D0%B6","æ",$string);
$string = ereg_replace("%D0%B7","ç",$string);
$string = ereg_replace("%D0%B8","è",$string);
$string = ereg_replace("%D0%B9","é",$string);
$string = ereg_replace("%D0%BA","ê",$string);
$string = ereg_replace("%D0%B6","æ",$string); 
$string = ereg_replace("%D0%B7","ç",$string); 
$string = ereg_replace("%D0%B8","è",$string); 
$string = ereg_replace("%D0%B9","é",$string); 
$string = ereg_replace("%D0%BA","ê",$string); 
$string = ereg_replace("%D0%BB","ë",$string); 
$string = ereg_replace("%D0%BC","ì",$string); 
$string = ereg_replace("%D0%BD","í",$string); 
$string = ereg_replace("%D0%BE","î",$string); 
$string = ereg_replace("%D0%BF","ï",$string); 
$string = ereg_replace("%D1%80","ğ",$string); 
$string = ereg_replace("%D1%81","ñ",$string); 
$string = ereg_replace("%D1%82","ò",$string); 
$string = ereg_replace("%D1%83","ó",$string); 
$string = ereg_replace("%D1%84","ô",$string); 
$string = ereg_replace("%D1%85","õ",$string); 
$string = ereg_replace("%D1%86","ö",$string); 
$string = ereg_replace("%D1%87","÷",$string); 
$string = ereg_replace("%D1%88","ø",$string); 
$string = ereg_replace("%D1%89","ù",$string); 
$string = ereg_replace("%D1%8A","ú",$string); 
$string = ereg_replace("%D1%8B","û",$string); 
$string = ereg_replace("%D1%8C","ü",$string); 
$string = ereg_replace("%D1%8D","ı",$string); 
$string = ereg_replace("%D1%8E","ş",$string); 
$string = ereg_replace("%D1%8F","ÿ",$string); 
$string = ereg_replace("%D0%90","À",$string); 
$string = ereg_replace("%D0%91","Á",$string); 
$string = ereg_replace("%D0%92","Â",$string); 
$string = ereg_replace("%D0%93","Ã",$string); 
$string = ereg_replace("%D0%94","Ä",$string); 
$string = ereg_replace("%D0%95","Å",$string); 
$string = ereg_replace("%D0%81","¨",$string);   
$string = ereg_replace("%D0%96","Æ",$string); 
$string = ereg_replace("%D0%97","Ç",$string); 
$string = ereg_replace("%D0%98","È",$string); 
$string = ereg_replace("%D0%99","É",$string); 
$string = ereg_replace("%D0%9A","Ê",$string); 
$string = ereg_replace("%D0%9B","Ë",$string); 
$string = ereg_replace("%D0%9C","Ì",$string); 
$string = ereg_replace("%D0%9D","Í",$string); 
$string = ereg_replace("%D0%9E","Î",$string); 
$string = ereg_replace("%D0%9F","Ï",$string); 
$string = ereg_replace("%D0%A0","Ğ",$string);
$string = ereg_replace("%D0%A1","Ñ",$string); 
$string = ereg_replace("%D0%A2","Ò",$string);         
$string = ereg_replace("%D0%A3","Ó",$string); 
$string = ereg_replace("%D0%A4","Ô",$string); 
$string = ereg_replace("%D0%A5","Õ",$string); 
$string = ereg_replace("%D0%A6","Ö",$string); 
$string = ereg_replace("%D0%A7","×",$string); 
$string = ereg_replace("%D0%A8","Ø",$string); 
$string = ereg_replace("%D0%A9","Ù",$string); 
$string = ereg_replace("%D0%AA","Ú",$string); 
$string = ereg_replace("%D0%AB","Û",$string); 
$string = ereg_replace("%D0%AC","Ü",$string); 
$string = ereg_replace("%D0%AD","İ",$string); 
$string = ereg_replace("%D0%AE","Ş",$string); 
$string = ereg_replace("%D0%AF","ß",$string); 
$string = ereg_replace("%21","@",$string);
$string = ereg_replace("%22","#",$string); 
$string = ereg_replace("%23","\$",$string);
$string = ereg_replace("%25","^",$string); 
$string = ereg_replace("%26","&",$string);
$string = ereg_replace("%27","*",$string);
$string = ereg_replace("%28","(",$string); 
$string = ereg_replace("%29",")",$string);
$string = ereg_replace("%30","+",$string); 
$string = ereg_replace("%31","|",$string);
$string = ereg_replace("%32","~",$string);
$string = ereg_replace("%33","`",$string); 
$string = ereg_replace("%34","=",$string);
$string = ereg_replace("%35","\\",$string);
$string = ereg_replace("%36","/",$string); 
$string = ereg_replace("%37","[",$string);
$string = ereg_replace("%38","]",$string);
$string = ereg_replace("%39","{",$string); 
$string = ereg_replace("%40","}",$string);
$string = ereg_replace("%41",":",$string);
$string = ereg_replace("%42","\"",$string);
$string = ereg_replace("%43","'",$string); 
$string = ereg_replace("%44","<",$string);
$string = ereg_replace("%45",">",$string);
$string = ereg_replace("%46","?",$string);
$string = ereg_replace("%47"," ",$string);
return $string;
}

function replace_links ($string){
global $domen;
if(eregi("<[Aa][ \r\n\t]*[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$string)){
preg_match_all("/(<[Aa][ ]*[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*>)/",$string,$url_list); 
foreach ($url_list as $url_temp){ 
        foreach ($url_temp as $url){  
            if(eregi ("omsk-777", $url) or eregi ("mailto", $url) or eregi ("javascript", $url)){}
                 else{
            $urla = preg_quote ($url);
            
            if(eregi ("$urla", $string)){ 
              
                    eregi("<[Aa][ \r\n\t]{1}[^>]*[Hh][Rr][Ee][Ff][^=]*=[ '\"\n\r\t]*(.*)",$url, $urla_abs_abs);
                        $string = ereg_replace ("$urla", "<a href=\"$domen/$urla_abs_abs[1]", $string);
                  }
                  }
              }
          } 
       }

if(eregi("<[.]*[ \r\n\t]*[^>]*[Ss][Rr][Cc][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$string)){    
preg_match_all("/<[.]*[ \r\n\t]*[^>]*[Ss][Rr][Cc][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>/",$string,$url_picture);
foreach ($url_picture as $url_temp){ 
   foreach ($url_temp as $url){
    if(eregi ("http", $url)){}
                 else{
     $urla = preg_quote ($url);            
        eregi("<[.]*[ \r\n\t]*[^>]*[Ss][Rr][Cc][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$urla, $urla_abs);
        eregi("<[.]*[^>]*[Ss][Rr][Cc][ ]*[^=]*=[ '\"]*(.*)[^>]*>",$url, $urla_end);
        eregi("(<[.]*[ \r\n\t]*[^>]*)[Ss][Rr][Cc][ ]*[^=]*=[ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*",$url, $urla_top);
    $string = ereg_replace ("$urla_abs[0]", "$urla_top[1]src=\"$domen/$urla_end[1]>", $string);
                }
            } 
        }       
      }         

if(eregi("<[.]*[ \r\n\t]*[^>]*[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$string)){    
preg_match_all("/<[.]*[ \r\n\t]*[^>]*[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>/",$string,$url_background);
foreach ($url_background as $url_temp){ 
   foreach ($url_temp as $url){
    if(eregi ("http", $url)){}
                 else{
     $urla = preg_quote ($url);            
        eregi("<[.]*[ \r\n\t]*[^>]*[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$urla, $urla_abs);
        eregi("<[.]*[^>]*[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=[ '\"]*(.*)[^>]*>",$url, $urla_end);
        eregi("(<[.]*[ \r\n\t]*[^>]*)[Bb][Aa][Cc][Kk][Gg][Rr][Oo][Uu][Nn][Dd][ ]*[^=]*=[ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*",$url, $urla_top);
    $string = ereg_replace ("$urla_abs[0]", "$urla_top[1]background=\"$domen/$urla_end[1]>", $string);
                }
            } 
        }       
      } 

if(eregi("<[.]*[ \r\n\t]*[^>]*[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$string)){    
preg_match_all("/<[.]*[ \r\n\t]*[^>]*[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>/",$string,$url_action);
foreach ($url_action as $url_temp){ 
   foreach ($url_temp as $url){
    if(eregi ("http", $url)){}
                 else{
     $urla = preg_quote ($url);            
        eregi("<[.]*[ \r\n\t]*[^>]*[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[^>]*>",$urla, $urla_abs);
        eregi("<[.]*[^>]*[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=[ '\"]*(.*)[^>]*>",$url, $urla_end);
        eregi("(<[.]*[ \r\n\t]*[^>]*)[Aa][Cc][Tt][Ii][Oo][Nn][ ]*[^=]*=[ '\"\n\r\t]*[^ \"'>\r\n\t#]+[^>]*",$url, $urla_top);
    $string = ereg_replace ("$urla_abs[0]", "$urla_top[1]action=\"$domen/$urla_end[1]>", $string);
                }
            } 
        }       
      }
return $string;
}

function obrez_word ($word){
$long = strlen($word);
if ($long > 5)
{
if(preg_match("/(ó|û|à|î|ÿ|å|è)$/", $word)){$long = -1;}
if(preg_match("/(èå|èÿ|åì|èì|èş|èé|èè|îé|îâ|àì|èõ|ûé|ûõ|àÿ|àé|àå|óş)$/", $word)){$long = -2; }
$word = substr($word,0,$long);
}
return $word;
}


?>
