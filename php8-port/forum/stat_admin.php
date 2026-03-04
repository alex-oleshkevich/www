<?php
require_once __DIR__ . "/compat.php";
 
  $gener = FileArray("$dlogs/user_ip.dat");
  $all_hit = count($gener);
  for ( $i = $all_hit-1; $i >= 0; $i--)
     {       
      list($user_id_abs_day,$user_ip_abs_day,$user_host_abs_day,$user_agent_abs_day,$hit_day,$referer_abs_day,$user_date_abs_day,$query_abs) = explode("<>", $gener[$i]);
      if(eregi("unknown", $user_ip_abs_day)){++$dont_ip;}
      else{
          $user_agent_abs_day = broser ($user_agent_abs_day);
          if ($user_agent_abs_day == "Robot"){$robot++;}
          else{                                  
               $u_ip = obrez ( $user_ip_abs_day);
               for ( $ii = $all_hit-1; $ii >= 0; $ii--)
                  {       
                   list($u_id_i,$u_ip_i,$u_host_i,$u_agent_i,$hit_d_i,$ref_day_i,$u_date_i,$q_a_i) = explode("<>", $gener[$ii]);
                   $u_ip_i = obrez ( $u_ip_i);
                   if($u_ip == $u_ip_i){$hh++;  $h[$u_ip] = $hh;}
                  }
               $hh=0;
               if ($user_agent_abs_day == "Explore")  {$Explore_s++; } 
               if ($user_agent_abs_day == "Opera" )   {$Opera_s++;   }
               if ($user_agent_abs_day == "Netscape" ){$Netscape++;  }
              }
          }
     }
$host_lich = count ($h);
$hit_linch = $all_hit - $robot - $dont_ip;
if($Explore_s == ""){$Explore_s = 0;}
if($Netscape == ""){$Netscape = 0;}
if($Opera_s == ""){$Opera_s = 0;}
if($dont_ip == ""){$dont_ip = 0;}
if($robot == ""){$robot = 0;}
echo "<table align=center width=700 border=0 cellspacing=1 cellpadding=1 $color_table>
<tr><td $color_td align=center>Всего посещений: <font $word_s>$all_hit</font>, хостов - <font $word_s>$host_lich</font>, из них роботами: <font $word_s>$robot</font> </td></tr>
<tr><td $color_td align=center>Посетители: Explore - <font $word_s>$Explore_s</font>, Netscape - <font $word_s>$Netscape</font>, Opera - <font $word_s>$Opera_s</font> [не определен IP - <font $word_s>$dont_ip</font>]</td></tr>
</table><br>"; 
if( $actions == "all_user" ){
      if( $actionses == "user_id_del" ){
      $general = FileArray($user_id_dat);
      $user_file = OpenFile("$dlogs/user_id.dat","w"); 
      for ( $i = 0; $i < count($general); $i++) {  
      if ($i != $nomber) 
      $erg = fputs ($user_file,$general[$i]);   
      }
      CloseFile ($user_file, "$dlogs/user_id.dat");
     }
      if( $actionses == "user_id_del_all" ){
      $general = FileArray($user_id_dat);
      $user_file = OpenFile("$dlogs/user_id.dat","w");    
      fputs ($user_file, " ");  
      CloseFile ($user_file, "$dlogs/user_id.dat");
     }
     if( $actionses == "user_id_sort" ){
     echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>  
     <tr><td align=center $color_td>
          <a href=\"admin.php?p=$p&menu=stat&actionses=user_id_del_all&actions=all_user\" title=\"Очистить всех Id user\">Очистить</a>  |
         <a href=\"admin.php?p=$p&menu=stat&actionses=user_id_sort&actions=all_user\" title=\"Сортировать по дате Id user\">Сортировать по дате Id user</a></td>
        </tr></table><br>";
     echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>  
     <tr><td align=center $color_td><font $word>Del</font></td>
         <td align=center $color_td><font $word>ID user [первое вхождение]</font></td>
         <td align=center $color_td><font $word>Имя user</font></td>
         <td align=center $color_td><font $word>Город user</font></td>
         <td align=center $color_td><font $word>Url user</font></td>
         <td align=center $color_td><font $word>Email user</font></td></tr>";
       $general = FileArray($user_id_dat);
       $lines = count($general);
       for ( $i = 0;  $i < $lines; $i++)
        {                                                    
        list($user_id_abs,$t_id,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer_abs_id) = explode("<>", $general[$i]);
        $b_user = substr ( $user_id_abs, 3);
        $dada[$b_user] = array (user_id_abs => $user_id_abs, 
                              t_id => $t_id, 
                              c_name_abs => $c_name_abs, 
                              c_city_abs => $c_city_abs, 
                              c_homepage_abs => $c_homepage_abs, 
                              c_mail_abs => $c_mail_abs, 
                              referer_abs_id => $referer_abs_id);
        }   
      ksort($dada);
      foreach ( $dada as $key => $value ) 
         {
            foreach ($value as $key_s => $value_s ) 
                {
                 $$key_s=$value_s;
                }
               $a_user = substr ( $user_id_abs, 0, 3);
               $b_user = substr ( $user_id_abs, 3); 
               $b_user = date('d\.m\.Y, H:i',$b_user);
           if  ($a_user == "")        {$a_user         = "нет";}
           if  ($b_user == "")        {$b_user         = " ";  }
           if  ($c_name_abs == "")    {$c_name_abs     = "нет";}
           if  ($c_city_abs == "")    {$c_city_abs     = "нет";}
           if  ($c_homepage_abs == ""){$c_homepage_abs = "нет";}
           if  ($c_mail_abs == "")    {$c_mail_abs     = "нет";}
           if(!$referer_abs_id or empty($referer_abs_id))
           {$referer_abs_id = "нет referer";}
           $idi = $i+1;
        echo"<tr><td align=center $color_td><a href=\"admin.php?p=$p&menu=stat&actionses=user_id_del&nomber=$i&actions=all_user\" title=\"удалить из базы №$idi\">del</a></td>
                 <td align=center $color_td>IP - <font $word>$a_user</font> <font $word>[$b_user]</font></td>
                 <td align=center $color_td><a href=\"$referer_abs_id\" title=\"пришел со страницы: $referer_abs_id\" target=\"_new\">$c_name_abs</a></td>
                 <td align=center $color_td>$c_city_abs</td>
                 <td align=center $color_td>$c_homepage_abs</td>
                 <td align=center $color_td>$c_mail_abs</td></tr>"; 
          } 
         echo"</table><br>";
         }
      
   if( $actionses != "user_id_sort" ){
     echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>  
     <tr><td align=center $color_td>
          <a href=\"admin.php?p=$p&menu=stat&actionses=user_id_del_all&actions=all_user\" title=\"Очистить всех Id user\">Очистить</a>  |
         <a href=\"admin.php?p=$p&menu=stat&actionses=user_id_sort&actions=all_user\" title=\"Сортировать по дате Id user\">Сортировать по дате Id user</a></td>
        </tr></table><br>";
     echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>  
     <tr><td align=center $color_td><font $word>Del</font></td>
         <td align=center $color_td><font $word>ID user [первое вхождение]</font></td>
         <td align=center $color_td><font $word>Имя user</font></td>
         <td align=center $color_td><font $word>Город user</font></td>
         <td align=center $color_td><font $word>Url user</font></td>
         <td align=center $color_td><font $word>Email user</font></td></tr>";
    $general = FileArray($user_id_dat);
    for ( $i = 0; $i < count($general); $i++)
       {
         $delq++;
        list($user_id_abs,$t_id,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer_abs_id) = explode("<>", $general[$i]);
        
               $a_user = substr ( $user_id_abs, 0, 3);
               $b_user = substr ( $user_id_abs, 3); $b_user = date('d\.m\.Y, H:i',$b_user);
           if  ($a_user == "")        {$a_user         = "нет";}
           if  ($b_user == "")        {$b_user         = " ";  }
           if  ($c_name_abs == "")    {$c_name_abs     = "нет";}
           if  ($c_city_abs == "")    {$c_city_abs     = "нет";}
           if  ($c_homepage_abs == ""){$c_homepage_abs = "нет";}
           if  ($c_mail_abs == "")    {$c_mail_abs     = "нет";}
           if(!$referer_abs_id or empty($referer_abs_id))
           {$referer_abs_id = "нет referer";}
           $idi = $i+1;
        echo"<tr><td align=center $color_td><a href=\"admin.php?p=$p&menu=stat&actionses=user_id_del&nomber=$i&actions=all_user\" title=\"удалить из базы №$idi\">del</a></td>
                 <td align=center $color_td>IP - <font $word>$a_user</font> <font $word>[$b_user]</font></td>
                 <td align=center $color_td><a href=\"$referer_abs_id\" title=\"пришел со страницы: $referer_abs_id\" target=\"_new\">$c_name_abs</a></td>
                 <td align=center $color_td>$c_city_abs</td>
                 <td align=center $color_td>$c_homepage_abs</td>
                 <td align=center $color_td>$c_mail_abs</td></tr>"; 
      }
     echo"</table><br>";  
   }
}
if( $actions != "all_user"  ){
  if( $show_id != ""){
     echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>  
     <tr><td align=center $color_td><font $word>ID user [первое вхождение]</font></td>
         <td align=center $color_td><font $word>Имя user</font></td>
         <td align=center $color_td><font $word>Город user</font></td>
         <td align=center $color_td><font $word>Url user</font></td>
         <td align=center $color_td><font $word>Email user</font></td></tr>";
    $general = FileArray($user_id_dat);
    for ( $i = 0; $i < count($general); $i++)
       {
        list($user_id_abs,$t_id,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer_abs_id) = explode("<>", $general[$i]);
        if  ( $user_id_abs == $show_id ){
               $a_user = substr ( $user_id_abs, 0, 3);
               $b_user = substr ( $user_id_abs, 3); 
               $b_user = date('d\.m\.Y, H:i',$b_user);
           if  ($user_id_abs == "")   {$user_id_abs    = "нет";}
           if  ($c_name_abs == "")    {$c_name_abs     = "нет";}
           if  ($c_city_abs == "")    {$c_city_abs     = "нет";}
           if  ($c_homepage_abs == ""){$c_homepage_abs = "нет";}
           if  ($c_mail_abs == "")    {$c_mail_abs     = "нет";}
           if(!$referer_abs_id or empty($referer_abs_id)){$referer_abs_id = "нет referer";}
        echo"<tr><td align=center $color_td>
                  IP - <a name=\"$a_user\" title=\"$referer_abs_id\">$a_user</a> <font $word_s>[$b_user]</font></td>
                 <td align=center $color_td>$c_name_abs</td>
                 <td align=center $color_td>$c_city_abs</td>
                 <td align=center $color_td>$c_homepage_abs</td>
                 <td align=center $color_td>$c_mail_abs</td></tr>"; 
          break;       
          }
      if($i+1 == count($general)) {
           echo"<tr><td align=center $color_td>
                 <font $word_s>Данных Нет [отключено cookie]</font></td>
                 <td align=center $color_td></td>
                 <td align=center $color_td></td>
                 <td align=center $color_td></td>
                 <td align=center $color_td></td></tr>"; 
          }
      }
     echo"</table><br>";  
   }
echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1 $color_table>  
     <tr><td align=center $color_td>
     <a href=\"admin.php?p=$p&menu=stat&actions=очистить\">Очистить файл |</a> 
     <a href=\"admin.php?p=$p&menu=stat&actions=id\">Сортировать по ID |</a> 
     <a href=\"admin.php?p=$p&menu=stat&actions=data\">Сортировать по Дате | </a>
     <a href=\"admin.php?p=$p&menu=stat&actions=online\">Сейчас на форуме</a>
     </td></tr></table><br>"; 
echo" <table align=center border=0 width=700 cellpadding=1 cellspacing=1  $color_table>  
     <tr><td align=center $color_td><font $word>N</font></td>
         <td align=center $color_td><font $word>ID user</font></td>
         <td align=center $color_td><font $word>IP user</font></td>
         <td align=center $color_td><font $word>Host user</font></td>
         <td align=center $color_td><font $word>Дата выхода</font></td>
         <td align=center $color_td><font $word>Броузер</font></td>
         <td align=center $color_td><font $word>Хит</font></td></tr>";
if($actions == "online"){
$time_st_abs = time();
$general = FileArray("$dlogs/user_ip.dat"); 
$count_ip =  count($general); 
  for ( $i = $count_ip-1; $i >= 0; $i--)
     {       
      $delq++;
      list($user_id_abs_day,$user_ip_abs_day,$user_host_abs_day,$user_agent_abs_day,$hit_day,$referer_abs_day,$user_date_abs_day,$query_abs) = explode("<>", $general[$i]);
      $user_agent_abs_day = broser ($user_agent_abs_day);
      if ($user_host_abs_day == "" or eregi("unknown", $user_ip_abs_day)) 
           { $user_ip_abs_day = "Не оределен"; }
      $razniza = $time_st_abs - $user_date_abs_day;
      if ($razniza < $time_sait){
      $user_date_abs_day=date('d\.m\, H:i', $user_date_abs_day);
    echo" <tr>
           <td align=center $color_td>$delq</td>
           <td align=center $color_td>$user_id_abs_day</td>
           <td align=center $color_td><a href=\"$referer_abs_day\" target=_blank title=\"пришел с: $referer_abs_day\">$user_ip_abs_day</a></td>
           <td align=center $color_td><a href=\"$url_admin/all.php?$query_abs\" target=_blank title=\"последняя страница: $url_admin/all.php?$query_abs\">$user_host_abs_day</a></td>
           <td align=center $color_td>$user_date_abs_day</td>
           <td align=center $color_td>$user_agent_abs_day</td>
           <td align=center $color_td>$hit_day</td>
          </tr>";
            } 
     } 
echo"</table><br>";
}
if($actions != "online"){    
    if($actions == "очистить")
    {
     $user_file = OpenFile("$dlogs/user_ip.dat","w");   
     fputs ($user_file," ");
    }    
    if($actions == "del")                                  
    {
      $general = FileArray($user_ip_dat);
      $user_file = OpenFile("$dlogs/user_ip.dat","w");   
      for ( $i = 0; $i < count($general); $i++)
           {
             if ($i != $nomber) $erg = fputs ($user_file,$general[$i]);
           }
           CloseFile ($user_file, "$dlogs/user_ip.dat");
    }  
    if($actions == "data")
    {
      $general = FileArray($user_ip_dat);
      for ( $i = 0; $i < count($general); $i++)
         {
         list($user_id,$user_ip,$user_host,$user_agent,$hit,$referer_abs,$user_date,$query_abs)=explode("<>", $general[$i]); 
         $dada[$user_date] = array (
                              user_id => $user_id, 
                              user_ip => $user_ip, 
                              user_host => $user_host, 
                              user_agent => $user_agent, 
                              hit => $hit, 
                              referer_abs => $referer_abs,
                              user_date => $user_date,
                              query_abs => $query_abs
                              );
         }   
      ksort($dada);
      $fp = OpenFile($user_ip_dat, "w"); 
      foreach ( $dada as $key => $value ) 
         {
            foreach ($value as $key_s => $value_s ) 
                {
                 $$key_s=$value_s;
                }
         fputs ($fp,"$user_id<>$user_ip<>$user_host<>$user_agent<>$hit<>$referer_abs<>$user_date<>$query_abs<>\n");
        }
        CloseFile ($fp, $user_ip_dat);
    }    
   if($actions == "id")
    {
    $general = FileArray($user_ip_dat);
     for ( $i = 0; $i < count($general); $i++)
      {
       list($user_id,$user_ip,$user_host,$user_agent,$hit,$referer_abs,$user_date,$query_abs)=explode("<>", $general[$i]); 
       $dada[$user_id] = array (
                              user_id => $user_id, 
                              user_ip => $user_ip, 
                              user_host => $user_host, 
                              user_agent => $user_agent, 
                              hit => $hit, 
                              referer_abs => $referer_abs,
                              user_date => $user_date,
                              query_abs => $query_abs
                              );
         }   
      ksort($dada);
      $fp = OpenFile($user_ip_dat, "w");  
      foreach ( $dada as $key => $value ) 
         {
            foreach ($value as $key_s => $value_s ) 
                {
                 $$key_s=$value_s;
                }
         fputs ($fp,"$user_id<>$user_ip<>$user_host<>$user_agent<>$hit<>$referer_abs<>$user_date<>$query_abs<>\n");
        }
        CloseFile ($fp, $user_ip_dat);
    }  
   $gener = FileArray("$dlogs/user_ip.dat");
   for ( $i = count($gener)-1; $i >= 0; $i--)
     {
     $delq++;
     list($user_id,$user_ip,$user_host,$user_agent,$hit,$referer_abs,$user_date,$query_abs) = explode("<>", $gener[$i]);
     $user_date  = date('d\.m,H:i', $user_date); 
     $idi = $i+1;
     echo"<tr><td align=center $color_td><a href=\"admin.php?p=$p&menu=stat&actions=del&nomber=$i\" title=\"стереть из базы № $idi\">$delq</a></td>";
     if($show_id == $user_id){echo"<td align=center $color_td><font $word_s>$user_id</font></td>";}
     else {echo"<td $color_td><a href=\"admin.php?p=$p&menu=stat&show_id=$user_id\" title=\"Посмотреть есть ли cookie у: $user_id\">$user_id</a></td>";}
         echo"<td $color_td><a href=\"$referer_abs\" title=\"пришел со страницы: $referer_abs\" target=\"_new\">$user_ip</a></td>
              <td $color_td><a href=\"$url_admin/$query_abs\" title=\"последняя посещенная страница: $url_admin/$query_abs\" target=\"_new\">$user_host</a></td>
              <td align=center $color_td>$user_date</td>";
     $user_agent = broser($user_agent);
     if ($user_agent=="Explore") { echo"<td align=center $color_td><font $word_a>Explore</font></td>";  }
     if ($user_agent=="Opera")   { echo"<td align=center $color_td><font $word>Opera</font></td>";    }
     if ($user_agent=="Netscape"){ echo"<td align=center $color_td>Netscape</td>"; }
     if ($user_agent=="Robot"){ echo"<td align=center $color_td><font $word_s>Robot</font></td>"; }
     echo"<td align=center $color_td>$hit</td></tr>";
     }
   echo"</table>";
}
}
?>
