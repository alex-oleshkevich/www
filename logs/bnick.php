<?
$banmess='<font class=mes3>Вам закрыли доступ.<br></font>';
$file = fopen ("logs/nick.txt", 'r');
flock($file,1);
$data = @fread ($file, filesize("logs/nick.txt"));
flock($file,3);
fclose ($file);

/*if (stristr($data,$name))
{
setcookie('userid','1');
die ("$banmess");
}   */
if($userid=='1')
{
die ("$banmess");
}
?>