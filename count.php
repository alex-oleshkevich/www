        <?
        $log_ip=getenv('REMOTE_ADDR');
        $browser=getenv('HTTP_USER_AGENT');
        //$remote_host=getenv('REMOTE_HOST');
        //$doc_root=getenv('DOCUMENT_ROOT');
        $data=date('d.m.Y  H:i:s',time());
        $fh=fopen("logs/user.log","a+");
        fwrite($fh,"<tr><td><h5><font face=tahoma>$data&nbsp;&nbsp;&nbsp;</font></h5></td><td><h5><font color=red face=tahoma>$log_ip&nbsp;&nbsp;&nbsp;</font></h5></td><td><h5><font face=tahoma color=#33CCFF>$browser</font></h5></td></tr>\n");
        fclose($fh);
        ?>