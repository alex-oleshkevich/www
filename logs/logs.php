<?
include('ban.php');
?>
<html>
<head>
<? print "<title>$label</title>" ?>
<style>
body{color:white}
a{color:blue;text-decoration:none;font-family:tahoma;font-size=-1}
a:hover{color:red;text-decoration:none;font-family:tahoma;font-size=-1}
a:visited{color:blue;text-decoration:none;font-family:tahoma;font-size=-1}
a:visited:hover{color:red;text-decoration:none;font-family:tahoma;font-size=-1}
</style>
</head>
<body bgcolor=#2f3650>
<h5>
<table>
<?
$pass_file=file("$id.log");
$pass_file=array_reverse($pass_file);
for($i=0; $i<sizeof($pass_file); $i++)
{
echo($pass_file[$i]);
}
?>
</table>
<? include 'cl.php'?>
<h5>
</body>
</html>