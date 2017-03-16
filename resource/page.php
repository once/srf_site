<?php
session_start();

include ("config.php");
if (isset($_GET['id'])) {$id =$_GET['id']; } 
else
{ exit("Вы зашил на страницу без параметра!");}
if (!preg_match("|^[\d]+$|", $id)) {
exit("<p>Неверный формат запроса! Проверьте URL</p>");
}

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
$result = mysql_query("SELECT * FROM users WHERE id='$id'",$db); 
$myrow = mysql_fetch_array($result);

if (empty($myrow['login'])) { exit("Пользователя не существует! Возможно он был удален.");} ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h2>Пользователь "<?php echo $myrow['login']; ?>"</h2>


<?php
print <<<HERE

HERE;


if ($myrow['login'] == $login) {


print <<<HERE

<form action='resource/update_user.php' method='post'>
Ваш логин <strong>$myrow[login]</strong>. Изменить логин:<br>
<input name='login' type='text'>
<input type='submit' name='submit' value='изменить'>
</form>
<br>

<form action='resource/update_user.php' method='post'>
Изменить пароль:<br>
<input name='password' type='password'>
<input type='submit' name='submit' value='изменить'>
</form>
<br>

<form action='resource/update_user.php' method='post' enctype='multipart/form-data'>
Ваш аватар:<br>
<img alt='аватар' src='resource/$myrow[avatar]'><br>
Изображение должно быть формата jpg, gif или png. Изменить аватар:<br>
<input type="FILE" name="fupload">
<input type='submit' name='submit' value='изменить'>
</form>
<br>



HERE;
}


else
{

print <<<HERE
Аватар пользователя:<br>
<img alt='аватар' src='resource/$myrow[avatar]'><br>


HERE;
}

?>
</body>
</html>
