<?
$REQUEST_URI = $HTTP_SERVER_VARS["REQUEST_URI"];
$HTTP_HOST = $HTTP_SERVER_VARS["HTTP_HOST"];
$server = "http://" ."$HTTP_HOST" ."$REQUEST_URI";
eregi ("(.*)/forum777", $server, $server_obr);
$HTTP_HOST = $server_obr[1]; 
$user_agent = $HTTP_SERVER_VARS["HTTP_USER_AGENT"];  
$query = $HTTP_SERVER_VARS["QUERY_STRING"];
$referer = $HTTP_SERVER_VARS["HTTP_REFERER"];
if($referer == ""){$referer = $server;}
$user_agent_abs_abs = broser ($user_agent); 
if ($user_agent_abs_abs == "Robot") { sleep(2); }
if(empty($user_ip)){if (getenv('HTTP_X_FORWARDED_FOR'))
{$user_ip=getenv('HTTP_X_FORWARDED_FOR'); }
else{$user_ip=getenv('REMOTE_ADDR'); }}
else{$user_ip=getenv('REMOTE_ADDR'); }
if(15 < strlen($user_ip)){
$user_ip_pass = split(", ", $user_ip);
for($i=0; $i < sizeof($user_ip_pass); $i++){
if(eregi("unknown", $user_ip_pass[$i]) or $user_ip_pass[$i] == ""){}
else {
if (ereg("[a-zA-Z]", $user_ip_pass[$i])){}
else{$user_ip = $user_ip_pass[$i]; break; }
}
if($i == sizeof($user_ip_pass)-1){$user_ip = "unknown";}
}
}
if (eregi("unknown", $user_ip)){if ($user_id!=""){$user_ip .= $user_id; } }
$ip = $user_ip;
$obrez_ip = obrez ($ip);
$general = FileArray("$dlogs/user_ip.dat");
$lines = count($general);   
for ( $i = $lines-1;  $i >= 0; $i--)
   {                                                    
    list($d_q,$user_ip_day,$g_q,$h_q,$j_q,$ref_q,$u_q,$query_abs) = explode("<>", $general[$i]);
    $user_ip_day_ob = obrez ( $user_ip_day);
    if($user_ip_day_ob == $obrez_ip  and  $query_abs == $query) { sleep(1);break;}
   }
if ($add != $add_b and $user_id != "") 
  {                
    $general = FileArray($user_id_dat);
    for ( $i = 0; $i <= count($general); $i++)
       {            
        list($user_id_abs,$t_id,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer_abs_id) = explode("<>", $general[$i]);
        if  ( $user_id_abs == $user_id )
             { $user_i = $i;  $user = "old";   break;  }
        else{ $user = "notold";  }
       }
    if ( $user == "notold")
      {                      
         $fp = OpenFile("$dlogs/user_id.dat","a+"); 
         @fputs($fp,"$user_id<>$time_stat<>$c_name<>$c_city<>$c_homepage<>$c_mail<>$referer<>\n"); 
         CloseFile ($fp, "$dlogs/user_id.dat"); 
      } 
    if (isset($name) or $name == ""){ $name = $c_name; }
    if (isset($mail) or $mail == ""){ $mail = $c_mail; }
 }
if ($add == $add_b)
  {
   if (isset($name) and $name != "" or $name == "") 
   { @setcookie("c_name",$name,time()+33333333); }
   if (isset($mail) and $mail != "" or $mail == "") 
   { @setcookie("c_mail",$mail,time()+33333333);  } 
  if($user_id != "")
   {         
    $general = FileArray($user_id_dat);
    for ( $i = 0; $i <= count($general); $i++)
       {            
        list($user_id_abs,$t_id,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer) = explode("<>", $general[$i]);
        if  ( $user_id_abs == $user_id )
             { $user_i = $i;  $user = "old";   break;  }
        else{ $user = "notold";  }
       }
     if ( $user == "old")
       {                
          $general = FileArray($user_id_dat);
          $fp = OpenFile("$dlogs/user_id.dat","w");  
          $lines = count($general);
          for ( $i = 0; $i < $lines; $i++ )
              {  
               if ($i != $user_i) { @fputs($fp,$general[$i]); }
               else  {  @fputs($fp,"$user_id<>$t_id<>$name<>$city<>$homepage<>$mail<>$referer<>\n"); }
              }
          CloseFile ($fp, "$dlogs/user_id.dat");  
       }
     }
   }
  $user_host = @gethostbyaddr("$user_ip");
  $general = FileArray("$dlogs/user_ip.dat");
  $lines = count($general);   
  $fp = OpenFile($user_ip_dat, "w");  
  for ( $i = 0;  $i < $lines; $i++)
     {                                                    
      list($user_id_day,$user_ip_day,$user_host_day,$user_agent_day,$hit_day,$referer_day,$user_date_day,$query_abs) = explode("<>", $general[$i]);
      $time_stat_ip = abs ($time_stat - $user_date_day);  
      if ($time_stat_ip < 86400){ @fputs ($fp,$general[$i]); }
      }
      CloseFile ($fp, $user_ip_dat);
  $general = FileArray("$dlogs/user_id.dat");
  $lines = count($general);   
  $fp = OpenFile($user_id_dat, "w"); 
  for ( $i = 0;  $i < $lines; $i++)
     {                                                    
      list($user_id_abs,$user_id_date_a,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer_abs_id) = explode("<>", $general[$i]);
      $time_stat_id =  abs ($time_stat - $user_id_date_a);   
      if ($time_stat_id < 86400){ @fputs ($fp,$general[$i]); }
      }
      CloseFile ($fp, $user_id_dat);
  $general = FileArray("$dlogs/user_ip.dat"); 
  $count_ip =  count($general); 
  for ( $i = $count_ip; $i >= 0; $i--)
     {       
      if ($break == "yes"){ break; }
      list($user_id_abs,$user_ip_abs,$user_host_abs,$user_agent_abs,$hit,$referer_abs,$user_date_abs,$query_abs) = explode("<>", $general[$i]);
      $us_date =  abs ($time_stat - $user_date_abs);
      if($user_ip == $user_ip_abs and $us_date < 86400)
        { 
         if(empty($user_id) or $user_id == "")
           {
            $user_id = substr ( $user_ip, 0, 3); $user_id .= time();
            @setcookie("user_id", $user_id, time()+33333333);
            $i_abs   =  $i;
             if($query == $query_abs) { $hit_abs = $hit; $agent = "old"; }
                else{ $hit_abs = $hit + 1;  $agent   = "old";  }   
            break;
           }
         else {          
              $gener = FileArray("$dlogs/user_id.dat");    
              $count_id =  count($gener);
              for ( $ii = 0; $ii <= $count_id; $ii++)
                  { 
                  list($user_id_abs,$t_id,$c_name_abs,$c_city_abs,$c_homepage_abs,$c_mail_abs,$referer_abs_id) = explode("<>", $gener[$ii]);
                  if($user_id_abs == $user_id)
                     {              
                      $i_abs   = $i;
                      if($query == $query_abs) { $hit_abs = $hit; $agent = "old"; }
                        else{ $hit_abs = $hit + 1;  $agent   = "old";  }   
                      $break   = "yes";
                      break;
                     }
                  if ($ii == $count_id)
                     {              
                      $i_abs      = $i;
                      if($query == $query_abs) { $hit_abs = $hit; $agent = "old"; }
                         else{ $hit_abs = $hit + 1;  $agent   = "old";  }   
                      $break = "yes";
                      break;
                     }
                 } 
            }      
         }
      if($user_ip == $user_ip_abs and $us_date >= 86400)
        {     
          if(empty($user_id) or $user_id == "")
            {                  
             $user_id = substr ( $user_ip, 0, 3); $user_id .= time();
             @setcookie("user_id", $user_id, time()+33333333);
             }
             $hit_abs = 1; 
             $agent   = "new";
             break;
        }
      if ($i == 0)
        {    
         if(empty($user_id) or $user_id == "")
            {        
             $user_id = substr ( $user_ip, 0, 3); $user_id .= time();
             @setcookie("user_id", $user_id, time()+33333333);
             }
          $hit_abs = 1;
          $agent="new";
        }
     }   
   if ( $agent == "new")         
     {       
       $user_file = OpenFile("$dlogs/user_ip.dat","a+");   
       @fputs ($user_file,"$user_id<>$user_ip<>$user_host<>$user_agent<>$hit_abs<>$referer<>$time_stat<>$query<>\n");
       CloseFile ($user_file, "$dlogs/user_ip.dat");  
      }
  if ( $agent == "old")
        {      
         $generaladd = FileArray($user_ip_dat);
         $fp = OpenFile("$dlogs/user_ip.dat","w");   
         $lines = count($generaladd);
         for ( $i = 0 ; $i <= $lines ; $i++ )
            {  
             if ($i != $i_abs) { @fputs($fp,$generaladd[$i]); }
            else  {  @fputs($fp,"$user_id<>$user_ip<>$user_host<>$user_agent<>$hit_abs<>$referer<>$time_stat<>$query<>\n"); }
            }
         CloseFile ($fp, "$dlogs/user_ip.dat");
        }
$time_st_abs = time();
$general = FileArray("$dlogs/user_ip.dat"); 
$count_ip =  count($general);                                                                              
  for ( $i = $count_ip-1; $i >= 0; $i--)
     {       
      list($user_id_abs_day,$user_ip_abs_day,$user_host_abs_day,$user_agent_abs_day,$hit_day,$referer_abs_day,$user_date_abs_day,$query_abs) = explode("<>", $general[$i]);
      if(eregi("unknown", $user_ip_abs_day) or $user_host_abs_day == "")
      {
      $razniza = $time_st_abs - $user_date_abs_day;
      if ($razniza < $time_sait){$user_online++;}
      }
      else{
          if (broser($user_agent_abs_day) == "Robot")  {}
          else{                                  
               $host_stat_day++;
               $hit_stat_day += $hit_day; 
               $razniza = $time_st_abs - $user_date_abs_day;
               if ($razniza < $time_sait){$user_online++;} 
              }
          }
      }    
if ($user_online ==""){$user_online = 1;}
if (eregi("unknown", $user_ip) and $ip_unknown != "yes"){ if ( $add == $add_b){ redirect ("error.htm"); exit;}}   

?>
