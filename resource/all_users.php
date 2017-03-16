<?php
session_start();

include ("config.php");

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h2>Список пользователей</h2>

<table cellspacing="10">
<tr><td>Аватар</td><td>Логин</td><td>Дата регистрации</td></tr>
<?php

print <<<HERE
HERE;

$result = mysql_query("SELECT login,id, avatar, date FROM users WHERE activation=1 ORDER BY login",$db);
$myrow = mysql_fetch_array($result);
do
{

printf("<tr><td><img style='width:24px;' src=resource/$myrow[avatar]></td><td><a href='userpage.php?id=%s'>%s</a></td><td>$myrow[date]</td></tr>",$myrow['id'],$myrow['login']);
}
while($myrow = mysql_fetch_array($result));

?></table>
</body>
</html>
