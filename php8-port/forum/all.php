<?php
require_once __DIR__ . "/compat.php";
 
$time1 = time();
$time_m1 = microtime();
$time_stat = time();
include("config.inc.php");
include("function.php");

if(isset($_GET)){while(list($key,$value)=each($_GET)){$$key=$value;}}
if(isset($HTTP_COOKIE_VARS)){foreach($HTTP_COOKIE_VARS as $key=>$value ){$$key=$value;}}
$PARAMS = (isset($HTTP_POST_VARS)) ? $HTTP_POST_VARS : $HTTP_GET_VARS; foreach( $PARAMS as $key => $value ) {$$key=$value;}

if($name != ""){$name = trim($name);}
if($mail != ""){$mail = trim($mail);}
include("stat.php");
if($message != ""){
$message = chist($message);
$message = replace($message);
$message_abs = ereg_replace("<br>","\n",$message);
$message = bbcod  ($message);
$message = razrez ($message);
$message = chist($message);
}

$general_file=$baseforum; 
$adres="act=forum";
if($user_agent_abs_abs == "Netscape"){$cols="35"; $colses="12";}
else{$cols="60"; $colses="20";}

if($smiles == "yes"){
$smileses_ot = "<SCRIPT language=JavaScript>ibsmiles();</SCRIPT><br>";
$smileses = "<SCRIPT language=JavaScript>ibsmiles();</SCRIPT><br><INPUT CHECKED name=psmile type=checkbox value=yes>Вы хотите <B>разрешить</B> смайлики в этом сообщении?<br>";
       }
      else{ $smileses_ot = ""; $smileses = ""; }

if($prosm!=""){
if($icon!="yes"){$smileses_ot = "";}
$titlel =  "$title $titl";    
$t_mha = @file("$dtemplates/index_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%title%",$titlel,$t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    } 
echo"<p align=center><b>Проверка введенных данных</b></p><br><br>";
$name = repl($name);
if($name==""){$name="Аноним";}
$mail = repl($mail);
   if($mail != ""){ $linkemail = " <a href=\"mailto:$mail\"><img border=0 src=\"img/email_forum.gif\" width=14 height=10 alt=$mail></a> ";}
   if ($prosmotr == "") {$prosmotr = 0;}
   if ($otvets == "")   {$otvets = 0;}
   $i=time();  $data= date("d m Y",$i) ." г.";
include ("config.inc.php");
if ($message == "")                              {  $error = "yes"; $er1 = "yes"; }
if (strlen($message) > $mmessageforum)           {  $error = "yes"; $er6 = "yes"; }                                               
if ($mail != "")   {  if (vm($mail))  { }  else  {  $error = "yes"; $er7 = "yes"; } }
if ($error == "yes")  
   { 
    $tmp_gb = @fopen("$dlogs/forumerrors.tmp","w+"); 
    @fputs ($tmp_gb,"$er1::$er6::$er7::$er8::$er9::\n");
    @fclose ($tmp_gb);
    echo"<br><table width=100%><tr><td>";
    error(); 
    echo"</td></tr><tr><td><br>";
    if($nomer!=""){
       $t_mha = @file("$dtemplates/forumform_otvet.htm");
       $smi = $smileses_ot;
       }
    else{
       $t_mha = @file("$dtemplates/forum_form.htm"); 
       $smi = $smileses;
        }
	  for($mha = 0 ; $mha < count($t_mha); $mha++)
            {                                                            
             $t_mha[$mha] = str_replace("%icon%",$icon,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%smileses%",$smi,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%nom%",$nomer,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%page_abs%",$page,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%message_abs%",$message_abs,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%mail%",$mail,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
             echo "$t_mha[$mha]"; 
            }  
    echo" </td></tr></table> ";
echo" <br><br><br><table width=100%><tr><td align=center>
     <a href=\"javascript:history.back(1)\" title=\"вернуться\"> Вернуться </a> |
     <a href=\"all.php?$adres\"> На первую страницу \"$title $titl\" </a>
     </td></tr></table><br>";
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
  $t_mha = @file("$dtemplates/index_end.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     echo "$t_mha[$mha]";
     }    
    exit;
   }
if($podsvet == "yes"){$message = light ($message);}
   
echo"<table width=100%>";
    if($nomer!=""){$t_mha = @file("$dtemplates/forum_admmessage01.htm");}
         else{$t_mha = @file("$dtemplates/forum_message_ot.htm"); }
      for($mha = 0 ; $mha < count($t_mha); $mha++)
        {                                                            
         $t_mha[$mha] = str_replace("%message%",$message,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%linkemail%",$linkemail,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%nomer%",$nomer,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%tema%",$tema,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%data%",$data,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%otvets%",$otvets,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%prosmotr%",$prosmotr,$t_mha[$mha]);
         echo "$t_mha[$mha]";  
        } 
echo" </table><br><br>";  
    if($nomer!=""){
       $t_mha = @file("$dtemplates/forumform_otvet.htm");
       $smil = $smileses_ot;
       }
    else{
       $t_mha = @file("$dtemplates/forum_form.htm"); 
       $smil = $smileses;
        }

	  for($mha = 0 ; $mha < count($t_mha); $mha++)
            {                                                            
            $t_mha[$mha] = str_replace("%icon%",$icon,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%smileses%",$smil,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%nom%",$nomer,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%page_abs%",$page,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%message_abs%",$message_abs,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%mail%",$mail,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
             echo "$t_mha[$mha]"; 
            }  
echo" <br><br><br><table width=100%><tr><td align=center>
     <a href=\"javascript:history.back(1)\" title=\"вернуться\"> Вернуться </a> |
     <a href=\"all.php?$adres\"> На первую страницу \"$title $titl\" </a>
     </td></tr></table><br>";
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
  $t_mha = @file("$dtemplates/index_end.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     echo "$t_mha[$mha]";
     }    
    exit;
}

$titlel =  "$title $titl";    
$t_mha = @file("$dtemplates/index_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%title%",$titlel,$t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    }  
$t_mha = file("$dtemplates/forum_top.htm");
    for($mha = 0 ; $mha < count($t_mha); $mha++)
    {       
     $t_mha[$mha] = str_replace("%colses%",$colses,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%action%",$HTTP_HOST,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%title%",$title,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%titl%",$titl,$t_mha[$mha]);
     echo "$t_mha[$mha]"; 
    }    


if ($form == "yes")
{ 
$name = repl($name);
$mail = repl($mail);
$nomer = $nomer;
$page = $page;
$tema = $tema;
include ("config.inc.php");
if ($message == "")                              {  $error = "yes"; $er1 = "yes"; }
if (strlen($message) > $mmessageforum)           {  $error = "yes"; $er6 = "yes"; }                                               
if ($mail != "")   {  if (vm($mail))  { }  else  {  $error = "yes"; $er7 = "yes"; } }
$autof = @file("$autochange");
for ($au=0; $au < count($autof); $au++)
{
list($autochange3,$autochange2)=explode("::", $autof[$au]);
if ($auchname == "yes")   {$name   = eregi_replace("$autochange3","$autochange2","$name"  );}
if ($auchmessage == "yes"){$message = eregi_replace("$autochange3","$autochange2","$message");}
$name = ereg_replace("\r\n","","$name"); $message = ereg_replace("\r\n","","$message");
$name = ereg_replace("\n","","$name"); $message = ereg_replace("\n","","$message");
}
$ban = @file("$banlist");
for ($fbo = 0; $fbo < count($ban); $fbo++)
  {
   $ban[$fbo] = ereg_replace("\n","",$ban[$fbo]);
   list($banip,$banmessage)= spliti ("\::",$ban[$fbo]);
   if (ereg("^$banip$",$ip)) { $error = "yes"; $er9 = "yes"; }
   if (ereg("^$banip$",$user_id)) { $error = "yes"; $er9 = "yes"; }
  }
$general=FileArray($general_file); 
$lines=count($general);
$all_messages = $lines;
for ($i=0; $i < $lines; $i++)
  {
   list($t1,$t2,$t3,$t4,$t5,$t6,$t7,$messageold,$t8,$t9,$t10)=explode("::", $general[$i]);
   if ($messageold == "$message") {  $error = "yes"; $er8 = "yes"; }
  }
if ($error == "yes")  
   { 
    $tmp_gb = @fopen("$dlogs/forumerrors.tmp","w+"); 
    @fputs ($tmp_gb,"$er1::$er6::$er7::$er8::$er9::\n");
    @fclose ($tmp_gb);
    echo"<br><table width=100%><tr><td>";
    error(); 
    echo"</td></tr><tr><td><br>";
          $t_mha = @file("$dtemplates/forum_form.htm");
	  for($mha = 0 ; $mha < count($t_mha); $mha++)
             {                                                            
              $t_mha[$mha] = str_replace("%smileses%",$smileses,$t_mha[$mha]);
              $t_mha[$mha] = str_replace("%message_abs%","",$t_mha[$mha]);
              $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
              $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
              $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
              $t_mha[$mha] = str_replace("%mail%",$mail,$t_mha[$mha]);
              $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
              echo "$t_mha[$mha]";
            }  
    echo" </td></tr></table> ";
echo" <br><table width=100%><tr><td align=center>
     <a href=\"all.php?$adres\">| На первую страницу \"$title $titl\" |</a>
     </td></tr></table><br>";
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
  $t_mha = @file("$dtemplates/index_end.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     echo "$t_mha[$mha]";
     }    
    exit;
   }
   $del_otvet = "";
   if ($mail == "") {$mail = "нет";}
   if ($prosmotr == "") {$prosmotr = 0;}
   if ($otvets == ""){$otvets = 0;}
   if ($name == "") {$name = "Аноним";} 
   if ($tema == "") {$tema = "---";}      
   $i=time(); 
   $data= date("d m Y",$i) ." г.";   
   $general=FileArray($general_file); 
   $lines = count($general);
   for ( $i = 0; $i <= $lines; $i++)
         {
          list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t)=explode("::", $general[$i]);
          if ($nomer_x > $nomer_t ){$a = $nomer_x + 1; } else{$nomer_x = $nomer_t;}
          }   
   if($a==""){$a=1;}
   $nomer = $a;
   $del = $a; 
   $adres_mail = "$url_admin/all.php?$adres&nomer=$nomer&show=yes";
     if ($iwe == "yes")
     {
      $message = str_replace("<img border=0 src=","<img border=0 src=$url_admin/",$message);
      $body = $nmig_forum;
      $body = str_replace("%titl%","$titlel",$body);
      $body = str_replace("%adres_mail%","$adres_mail",$body);
      $body = str_replace("%name%","$name",$body);
      $body = str_replace("%mail%","$mail",$body); 
      $body = str_replace("%date%","$data",$body);
      $body = str_replace("%message%","$message",$body);
      $body = str_replace("%ip%","$ip",$body);
      $from="\"$titlel\"  <$titlel>";
      $headers="Content-Type: text/html; charset=windows-1251\n";
      $headers.="From: $from";
      $newm = "Сообщение. $titlel";
      if($moa == "777@omskmail.ru"){$newm.=" $server";}
      @mail($moa,$newm,$body,$headers); 
     }
    $general=FileArray($general_file); 
    $fp = OpenFile($general_file, "w"); 
    @fputs ($fp,"$del::$del_otvet::$ip::$mail::$name::$nomer::$tema::$message::$data::$otvets::$prosmotr::$user_id::$psmile::\n");
    if($del!="1"){
    $lines = count($general);
    for ( $i = 0; $i < $lines; $i++)
       {
        list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
        @fputs ($fp,"$del_t::$del_otvet_t::$ip_t::$mail_t::$name_t::$nomer_t::$tema_t::$message_t::$data_t::$otvets_t::$prosmotr_t::$user_id_t::$psmile_t::\n");
       }      
    }
    CloseFile ($fp, $general_file); 
}
if ($show == "yes" and $add == "$add_b")      
{                                 
$name = repl($name);
$mail = repl($mail);

$nom = $nomer;
$page_abs = $page;
$user_id = $user_id;
include ("config.inc.php");
if ($message == "")                          {  $error = "yes"; $er1 = "yes"; }
if (strlen($message) > $mmessageforum)       {  $error = "yes"; $er6 = "yes"; }
if ($mail != ""){  if (vm($mail))  { } else  {  $error = "yes"; $er7 = "yes"; } }
$autof = @file("$autochange");
for ($au=0; $au < count($autof); $au++)
{
list($autochange3,$autochange2)=explode("::", $autof[$au]);
if ($auchname == "yes")   {$name   = eregi_replace("$autochange3","$autochange2","$name"  );}
if ($auchmessage == "yes"){$message = eregi_replace("$autochange3","$autochange2","$message");}
$name = ereg_replace("\r\n","","$name"); $message = ereg_replace("\r\n","","$message");
$name = ereg_replace("\n","","$name");   $message = ereg_replace("\n","","$message");
}
$general=FileArray($general_file); 
$lines=count($general);
$all_messages = $lines;
$ban = @file("$banlist");
for ($fbo = 0; $fbo < count($ban); $fbo++)
  {
   $ban[$fbo] = ereg_replace("\n","",$ban[$fbo]);
   list($banip,$banmessage)= spliti ("\::",$ban[$fbo]);
   if (ereg("^$banip$",$ip)) { $error = "yes"; $er9 = "yes"; }
   if (ereg("^$banip$",$user_id)) { $error = "yes"; $er9 = "yes"; }
  }
for ($i=0; $i < $lines; $i++)
  {
   list($t1,$t2,$t3,$t4,$t5,$t6,$t7,$messageold,$t8,$t9,$t10)=explode("::", $general[$i]);
   if ($messageold == "$message") {  $error = "yes"; $er8 = "yes"; }
  }
if ($error == "yes")  
   { 
    $tmp_gb = @fopen("$dlogs/forumerrors.tmp","w+"); 
    @fputs ($tmp_gb,"$er1::$er6::$er7::$er8::$er9::\n");
    @fclose ($tmp_gb);
    echo"<br><table width=100%><tr><td>";
    error(); 
    echo"</td></tr><tr><td><br>";
          $t_mha = @file("$dtemplates/forumform_otvet.htm");
	  for($mha = 0 ; $mha < count($t_mha); $mha++)
            {                                                            
             $t_mha[$mha] = str_replace("%smileses%",$smileses_ot,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%message_abs%","",$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%nom%",$nom,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%page_abs%",$page_abs,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%name%",$name_abs,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%mail%",$mail_abs,$t_mha[$mha]);
             $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
             echo "$t_mha[$mha]";
            }  
    echo" </td></tr></table> ";
     echo" <br><table width=100%><tr><td align=center>
     <a href=\"all.php?$adres&page=$page_abs\">| На первую страницу \"$titlel\" |</a>
     </td></tr></table><br>";
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
     $t_mha = @file("$dtemplates/index_end.htm");
     for($mha = 0 ; $mha < count($t_mha); $mha++)
      { 
      $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
      $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
      $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
      $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
      $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
      $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
      echo "$t_mha[$mha]";
      }  
    exit;
   }
       $general=FileArray($general_file); 
       $lines = count($general);
       for ( $i = 0; $i <= $lines; $i++ )
       {  
          list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
          if ($nomer_t == $nom) 
            { 
             $name_absolut = $name_t;
             $mail_absolut = $mail_t;
             $message_absolut = $message_t;
             $data_absolut = $data_t;
             $x = $i+1;
             break; 
            }
        }
    $general=FileArray($general_file);
    $lines = count($general);
    for ( $i = 0; $i <= $lines; $i++ )
       {  
          list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
          if ($i == $x){ $del_otvet_abs = $del_otvet+1; break;}
        }
      $del = $nom;
      $del_otvet = $del_otvet_abs;
      $tema = "Re";
      if( $mail == "") {$mail = "нет";}
      if ($name == "") {$name = "Аноним";}  
      $n =  "";
      $ot = "";
      $pr = "";
      $i=time(); 
      $data= date("d m Y",$i) ." г.";
   $adres_mail = "$url_admin/all.php?$adres&nomer=$nom&show=yes";
     if ($iwe == "yes")
     {
      $message = str_replace("<img border=0 src=","<img border=0 src=$url_admin/",$message);
      $body = $nmig_forum_otvet;
      $body = str_replace("%titl%","$titlel",$body);
      $body = str_replace("%adres_mail%","$adres_mail",$body);
      $body = str_replace("%name_absolut%","$name_absolut",$body);
      $body = str_replace("%mail_absolut%","$mail_absolut",$body); 
      $body = str_replace("%date_absolut%","$data_absolut",$body);
      $body = str_replace("%message_absolut%","$message_absolut",$body);
      $body = str_replace("%name%","$name",$body);
      $body = str_replace("%date%","$data",$body);
      $body = str_replace("%message%","$message",$body);
      $body = str_replace("%ip%","$ip",$body);
      $from="\"Ответ. $titlel\"  <$titlel>";
      $headers="Content-Type: text/html; charset=windows-1251\n";
      $headers.="From: $from";
      $newm = "Ответ. $titlel";
      if($moa == "777@omskmail.ru"){$newm.=" $server";}
      @mail($moa,$newm,$body,$headers);
      if  ($mail_absolut != "" and $mail_absolut != "нет" and $mail_absolut != $mail){
      @mail($mail_absolut,$newm,$body,$headers);
      }
     }
   $general=FileArray($general_file);
   $lines = count($general);
   for ( $i = 0; $i < $lines; $i++ )
    {  
     list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
     if ($nomer_t == $nom) { $b = $otvets_t+1;  $mmm = $i; $strok=$i+$otvets_t+1; break;}
    }
   $general=FileArray($general_file); 
   $fp = OpenFile($general_file, "w"); 
   $lines = count($general);                                            
      for ( $i = 0; $i < $lines; $i++ )
       {  
        list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
        if ($mmm == $i) {@fputs ($fp,"$del_t::$del_otvet_t::$ip_t::$mail_t::$name_t::$nomer_t::$tema_t::$message_t::$data_t::$b::$prosmotr_t::$user_id_t::$psmile_t::\n");}
        }
      for ( $i = 0; $i < $lines; $i++ )
       {
       list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
       if ($mmm < $i and $strok > $i)  
          {
          $del_otvet_b = $del_otvet_t+1; 
          @fputs ($fp,"$del_t::$del_otvet_t::$ip_t::$mail_t::$name_t::::$tema_t::$message_t::$data_t::$b::$prosmotr_t::$user_id_t::$psmile_t::\n"); 
          }
       }
      if ($del_otvet_b ==""){$del_otvet_b=1;}
      @fputs ($fp,"$del::$del_otvet_b::$ip::$mail::$name::::$tema::$message::$data::$otvets::$prosmotr::$user_id::$psmile_t::\n");
      for ( $i = 0; $i < $lines; $i++ )            
       {  
        list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$i]);
          if ($mmm > $i)    { @fputs ($fp,$general[$i]); } 
          if ($strok <= $i) { @fputs ($fp,$general[$i]); }
        }       
    CloseFile ($fp, $general_file); 
}       
if ($show == "yes")                              
{
$user_id_abs = $user_id;
$ip_abs = $ip;
$nom = $nomer; 
$page_abs = $page;
$general=FileArray($general_file);
$lines = count($general);                                            
echo"<table width=100%>";
      for ( $i = 0; $i <= $lines; $i++ )
       {  
       list($del,$del_otvet,$ip,$mail,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
       if ($nomer == $nom)
         { 
          if($psmile == "yes"){$icon="yes";} else{$smileses_ot="";}
          $message = ereg_replace("<br>","\n<br>",$message);
          $message_temp ="";
          $mess = explode("\n", $message);
          for($i=0; $i < sizeof($mess); $i++){
          if($podsvet == "yes"){$mess[$i] = light ($mess[$i]); }
          $message_temp .= "\n$mess[$i]";
           }
          $message = $message_temp;
          if ($mail != "нет") { $linkemail = " <a href=\"mailto:$mail\"><img border=0 src=\"img/email_forum.gif\" width=14 height=10 alt=$mail></a> ";}
          else { $linkemail = "" ;}
          if ($tema == "---") {$tema = "<font color=000080>Сообщение: </font>";}
                $t_mha = @file("$dtemplates/forum_message_ot.htm");
	         for($mha = 0 ; $mha < count($t_mha); $mha++)
                   { 
                     $t_mha[$mha] = str_replace("%linkemail%",$linkemail,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%nomer%",$nomer,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%tema%",$tema,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%message%",$message,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%data%",$data,$t_mha[$mha]);
                     echo "$t_mha[$mha]"; 
                   } 
          break;
          }
       if($i == $lines){ 
          echo"<tr><td><br><br><p align=center><font color=ff0000>Это объявление было удалено из базы...</font></p><br><br></td></tr>";
         }     
       }                                   
       echo"</table>";
      $general=FileArray($general_file);
      $lines = count($general);                                            
      for ( $i = 0; $i < $lines; $i++ )
       {  
          list($del,$del_otvet,$ip,$mail,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
          if ($nomer == $nom) 
          { 
            if($ip != $ip_abs and $user_id != $user_id_abs){$b = $prosmotr+1;}else{$b = $prosmotr;}
            $mmm = $i; $otvets_abs = $otvets;  break;
          }
       }
        $general=FileArray($general_file); 
        $fp = OpenFile($general_file, "w"); 
        $lines = count($general);                                            
        for ( $i = 0; $i < $lines; $i++ )
           {  
            list($del,$del_otvet,$ip,$mail,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
            if ($mmm > $i)  { @fputs ($fp,$general[$i]); } 
            if ($mmm == $i) { @fputs ($fp,"$del::$del_otvet::$ip::$mail::$name::$nomer::$tema::$message::$data::$otvets::$b::$user_id::$psmile::\n"); }
            if ($mmm < $i)  { @fputs ($fp,$general[$i]); } 
           }
        CloseFile ($fp, $general_file); 
if ($otvets_abs != 0)
   {                                          
$i=time(); $data_abs = date("d m Y",$i) ." г.";
      $general=FileArray($general_file);
      $lines = count($general);                                            
      for ( $i = 0; $i < $lines; $i++ )
       {  
          list($del,$del_otvet,$ip,$mail,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
          if ($nomer == $nom)    { $str_one = $i+1;  $str_end = $str_one+$otvets; break;}
        }        
      echo"<table width=100%>";
      for ( $i = $str_one; $i < $str_end; $i++ )
          {  
          list($del,$del_otvet,$ip,$mail,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
          if ($data_abs == $data){$tema = "new:";}
          if ($mail != "нет") { $linkemail = " <a href=\"mailto:$mail\"><img border=0 src=\"img/email_forum.gif\" width=14 height=10 alt=$mail></a> ";}
          else { $linkemail = "" ;}
          $message = ereg_replace("<br>","\n<br>",$message);
          if($podsvet == "yes"){$message = light ($message);}
                $t_mha = @file("$dtemplates/forum_admmessage01.htm");
	         for($mha = 0 ; $mha < count($t_mha); $mha++)
                   { 
                     $t_mha[$mha] = str_replace("%linkemail%",$linkemail,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%nomer%",$nomer,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%tema%",$tema,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%message%",$message,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%data%",$data,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%otvets%",$otvets,$t_mha[$mha]);
                     $t_mha[$mha] = str_replace("%prosmotr%",$prosmotr,$t_mha[$mha]);
                     echo "$t_mha[$mha]"; 
                   } 
          }
       echo"</table>";
       }   
  if ($add == $add_b)
    { 
     echo"<br><table width=100%><tr><td> ";
      $t_mha = @file("$dtemplates/forumform_otvet.htm");
	for($mha = 0 ; $mha < count($t_mha); $mha++)
          {                                                            
           $t_mha[$mha] = str_replace("%icon%",$icon,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%smileses%",$smileses_ot,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%message_abs%","",$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%page_abs%",$page,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%nom%",$nom,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%name%",$name_abs,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%mail%",$mail_abs,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
           echo "$t_mha[$mha]";  
          } 
      echo"</td></tr></table>"; 
    }
  if ($add != $add_b)
    { 
     echo"<br><table width=100%><tr><td> ";
     $t_mha = @file("$dtemplates/forumform_otvet.htm");
	for($mha = 0 ; $mha < count($t_mha); $mha++)
          {                                                            
           $t_mha[$mha] = str_replace("%icon%",$icon,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%smileses%",$smileses_ot,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%message_abs%","",$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%page_abs%",$page,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%nom%",$nom,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%name%",$name_abs,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%mail%",$mail_abs,$t_mha[$mha]);
           $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
           echo "$t_mha[$mha]";  
          } 
    echo"</td></tr></table>";              
    }
     echo" <br><table width=100%><tr><td align=center>
     <a href=\"all.php?$adres\">| На первую страницу \"$titlel\" |</a>
     </td></tr></table><br>";
}
if ($show != "yes")                              
{                                      
if ($act="forum" or $page != "" or $adpage == "yes" or $adpage == "no" or $form == "yes")
{
$general=FileArray($general_file);
$lines = count($general);
for ( $i = 0; $i < $lines; $i++ )
      {                                    
        list($del,$del_otvet,$ip,$email,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
        if ( $nomer != "")   { $pmessages++;}
        if ( $del_otvet != "")  { $all_otvets++;} else{$all_messagess++;}
      }
if ($page == "") { $page = 1;  }
$first = $onlygforum * ($page - 1);
$second = $onlygforum * $page;
if ($second < 1)  { $second = 1; }
$pages = (int) (($pmessages + $onlygforum) / $onlygforum);
if ($addpage_abs == 0)    {$addpage_abs = $addpage; }
if ($adpage == "yes")     {$addpage_abs = $addpage_abs + $addpage;}
if ($adpage == "no")      {$addpage_abs = $addpage_abs - $addpage;}
$addpageno_abs = $addpage_abs - $addpage;
$line = "Страницы: ";
if ($addpageno_abs >= $addpage){ $line .= " <a href=\"all.php?$adres&page=$addpageno_abs&adpage=no&addpage_abs=$addpage_abs&addpageno_abs=$addpageno_abs\" title=\"назад\"> << </a>";}
$line .= "|";
for ($onlygforum = 1; $onlygforum <= $pages; $onlygforum++)
    {
     if ($addpage_abs >= $onlygforum and $addpageno_abs < $onlygforum)
      {
       if ($onlygforum != $page) { $line .= " <a href=\"all.php?$adres&page=$onlygforum&addpage_abs=$addpage_abs&addpageno_abs=$addpageno_abs\" title=\"$perp $onlygforum\">$onlygforum</a> |"; }
       if ($onlygforum == $page) { $line .= " <font color=FF0000>$onlygforum</font> |"; }
      }
   }
if ($addpage_abs < $onlygforum-1){$adp=$addpage_abs+1; $line .= " <a href=\"all.php?$adres&page=$adp&adpage=yes&addpage_abs=$addpage_abs&addpageno_abs=$addpageno_abs\" title=\"Еще\"> >> </a>";}
if ($all_messages != "0")
   {
     $t_center = @file("$dtemplates/forum_center.htm");
      for($c = 0 ; $c < count($t_center); $c++)
       {
        $t_center[$c] = str_replace("%line%",$line,$t_center[$c]);
        $t_center[$c] = str_replace("%page%",$page,$t_center[$c]);
        echo $t_center[$c];
       }
   }
$i=time(); $data_abs = date("d m Y",$i) ." г.";
$ia=-1;                              
$general=FileArray($general_file);
$lines = count($general);
if($lines<="1" and strlen($general[0])<="2" ){echo"<br><br><p align=center><font color=ff0000>В базе нет сообщений...</font></p><br><br>"; }
else{
for ( $i = 0; $i <= $lines; $i++ )
 {                                  
  list($del,$del_otvet,$ip,$mail,$name,$nomer,$tema,$message,$data,$otvets,$prosmotr,$user_id,$psmile)=explode("::", $general[$i]);
  if($nomer != "")
    {
    if($otvets != "" and $data_abs != $data)
      {
       for ( $ii = $i; $ii <= $i+$otvets; $ii++ )
          {
           list($del_t,$del_otvet_t,$ip_t,$mail_t,$name_t,$nomer_t,$tema_t,$message_t,$data_t,$otvets_t,$prosmotr_t,$user_id_t,$psmile_t)=explode("::", $general[$ii]);
           if ($data_abs == $data_t){$otvets = "$otvets<font color=ff0000>&nbsp;new</font>"; break;}
          }
      }
     echo"<table width=100%>";
     if ($data_abs == $data){$data = "$data<font color=ff0000>&nbsp;new</font>";}
  if ($message != "")
    {
    $message = $amessage = p($message);
    if ($obrez_cons_title < strlen ($amessage)){$amessage = substr($amessage, 0, $obrez_cons_title);}
    if ($obrez_cons < strlen ($message)) 
      {   
       $message = substr ( $message, 0, $obrez_cons);
       $message = "&nbsp;<a href=\"all.php?$adres&nomer=$nomer&page=$page&show=yes\" title=\"$amessage\">$message...</a>";   
      }
    else { 
          $message = "&nbsp;<a href=\"all.php?$adres&nomer=$nomer&page=$page&show=yes\" title=\"$amessage\">$message...</a>"; 
          }
   if ($nomer != ""){$ia++;}      
   if ($nomer != "" and  $ia < $second and  $ia >= $first)
      {   
      if ($mail != "нет") { $linkemail = " <a href=\"mailto:$mail\"><img border=0 src=\"img/email_forum.gif\" width=14 height=10 alt=$mail></a> ";}
      else { $linkemail = "" ;}
      if ($name == "нет") {$name = "";}
      if ($tema == "---") {$tema = "Новое сообщение: ";}
      $t_mha = @file("$dtemplates/forum_message.htm");
      for($mha = 0 ; $mha < count($t_mha); $mha++)
        {                                                            
         $t_mha[$mha] = str_replace("%linkemail%",$linkemail,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%name%",$name,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%nomer%",$nomer,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%tema%",$tema,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%message%",$message,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%data%",$data,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%otvets%",$otvets,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%prosmotr%",$prosmotr,$t_mha[$mha]);
         echo "$t_mha[$mha]";  
        } 
       }
     }
 echo"</table>";
 }
}
}
if ($all_messagess != 0)
    {
     $t_bottom = @file("$dtemplates/forum_bottom.htm");
     for($b = 0 ; $b < count($t_bottom); $b++)
         {
            $t_bottom[$b] = str_replace("%all_messages%",$all_messagess,$t_bottom[$b]);
            $t_bottom[$b] = str_replace("%all_otvets%",$all_otvets,$t_bottom[$b]);
            echo $t_bottom[$b];
         }
     }                   
if ($add == $add_b)
 { 
     echo"<br><table width=100%><tr><td> ";
      $t_mha = @file("$dtemplates/forum_form.htm");
      for($mha = 0 ; $mha < count($t_mha); $mha++)
        {                                                            
         $t_mha[$mha] = str_replace("%smileses%",$smileses,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%message_abs%","",$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%name%",$name_abs,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%mail%",$mail_abs,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
         echo "$t_mha[$mha]";  
        } 
  echo"  </td></tr></table> ";
 }
if ($add != $add_b)
 {
     echo"<br><table width=100%><tr><td> ";
      $t_mha = @file("$dtemplates/forum_form.htm");
      for($mha = 0 ; $mha < count($t_mha); $mha++)
        {                                                            
         $t_mha[$mha] = str_replace("%smileses%",$smileses,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%message_abs%","",$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%cols%",$cols,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%adres%",$adres,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%name%",$name_abs,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%mail%",$mail_abs,$t_mha[$mha]);
         $t_mha[$mha] = str_replace("%add0%",$add_b,$t_mha[$mha]);
         echo "$t_mha[$mha]";  
        } 
  echo"  </td></tr></table> ";
 }  
}   
}
  $time2 = time();
  $mtime = abs ($time2 - $time1);
  $time_m2 = microtime();
  $mtime_m = abs ($time_m2 - $time_m1);
  $mtime_m = substr($mtime_m, 2, 3);
  $mtime .= "." ."$mtime_m";
  $t_mha = @file("$dtemplates/index_end.htm");
  for($mha = 0 ; $mha < count($t_mha); $mha++)
    { 
     $t_mha[$mha] = str_replace("%mtime%",$mtime,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_name%",$c_name,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%c_mail%",$c_mail,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%host%",$host_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%hit%",$hit_stat_day,$t_mha[$mha]);
     $t_mha[$mha] = str_replace("%user%",$user_online,$t_mha[$mha]);
     echo "$t_mha[$mha]";
     }    
exit;
?>
