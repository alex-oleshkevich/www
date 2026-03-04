<?php
require_once __DIR__ . "/compat.php";
 
$ip=$_SERVER['REMOTE_ADDR'];
$banmess='<font class=mes3>Вы были забанены администратором сайта.<br></font>';

$file = fopen ("logs/bans.txt", 'r');
flock($file,1);
$data = @fread ($file, filesize("logs/bans.txt"));
flock($file,3);
fclose ($file);

/*if (stristr($data,$ip))
{
setcookie('userid','1');
die ("$banmess");
}   */

if($userid=='1')
{
die ("$banmess");
}
?>