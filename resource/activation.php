<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
include ("../config.php");
$result4 = mysql_query ("SELECT avatar FROM users WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 3600");
if (mysql_num_rows($result4) > 0) {
$myrow4 = mysql_fetch_array($result4);	
do
{

if ($myrow4['avatar'] == "avatars/net-avatara.jpg") {$a = "Ничего не делать";}
else {
	unlink ($myrow4['avatar']);
	}
}
while($myrow4 = mysql_fetch_array($result4));
}
mysql_query ("DELETE FROM users WHERE activation='0' AND UNIX_TIMESTAMP() - UNIX_TIMESTAMP(date) > 3600");



if (isset($_GET['code'])) {$code =$_GET['code']; } 
else
{ exit("Вы зашил на страницу без кода подтверждения!");} 

if (isset($_GET['login'])) {$login=$_GET['login']; } 
else
{ exit("Вы зашил на страницу без логина!");}

$result = mysql_query("SELECT id FROM users WHERE login='$login'",$db); 
$myrow = mysql_fetch_array($result); 

$activation = md5($myrow['id']).md5($login);
if ($activation == $code) {
	mysql_query("UPDATE users SET activation='1' WHERE login='$login'",$db);
	echo "Ваш Е-мейл подтвержден! Теперь вы можете зайти на сайт под своим логином! <a href='index.php'>Главная страница</a>";
	}
else {echo "Ошибка! Ваш Е-мейл не подтвержден! <a href='../index.php'>Главная страница</a>";
}

?>