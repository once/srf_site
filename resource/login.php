<?php
session_start();

include ("config.php");

if (isset($_COOKIE['auto']) and isset($_COOKIE['login']) and isset($_COOKIE['password']))
{
	if ($_COOKIE['auto'] == 'yes') { 
		  $_SESSION['password']=strrev(md5($_COOKIE['password']))."b3p6f"; 
		  $_SESSION['login']=$_COOKIE['login'];
		  $_SESSION['id']=$_COOKIE['id'];
		}	
	}

if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{

$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result = mysql_query("SELECT id,avatar FROM users WHERE login='$login' AND password='$password' AND activation='1'",$db); 
$myrow = mysql_fetch_array($result);
}
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<html>
<body>
<?php
if (!isset($myrow['avatar']) or $myrow['avatar']=='') {
print <<<HERE
<form action="resource/testreg.php" method="post">
<!-- testreg.php - это адрес обработчика. То есть, после нажатия на кнопку "Войти", данные из полей отправятся на страничку testreg.php методом "post"  -->
  <p>
   
    <input class="loginblock" placeholder="Ваш логин" name="login" type="text" size="15" maxlength="15"
HERE;

	
if (isset($_COOKIE['login'])) 
{
echo ' value="'.$_COOKIE['login'].'">';
}


print <<<HERE
  </p>
<!-- В текстовое поле (name="login" type="text") пользователь вводит свой логин -->  
  <p>
    <input class="loginblock" placeholder="Ваш пароль" name="password" type="password" size="15" maxlength="15"
HERE;

	
if (isset($_COOKIE['password']))
{
echo ' value="'.$_COOKIE['password'].'">';
}
	
print <<<HERE
  </p>
<!-- В поле для паролей (name="password" type="password") пользователь вводит свой пароль -->  
  <p>
    <input name="save" type="checkbox" value='1'> Запомнить меня.
  </p>

<p>
<input class="loginbutton" type="submit" name="submit" value="Войти">
<!-- Кнопочка (type="submit") отправляет данные на страничку testreg.php  --> 
<br>
<!-- ссылка на регистрацию, ведь как-то же должны гости туда попадать  --> 
<a href="registration.php">Зарегистрироваться</a> 

<br>
<!-- ссылка на восстановление пароля  --> 
<a href="forgotpass.php">Забыли пароль?</a> 

</p></form>

HERE;
}

else
{

print <<<HERE
Здравствуйте, $_SESSION[login]
<ul>
<li><a href='userpage.php?id=$_SESSION[id]'>Моя страница</a></li>
<li><a href='users.php'>Список пользователей</a></li>
<li><a href='resource/exit.php'>Выход</a></li><hr>
</ul>

<!-- Выше отображается аватар. Его адрес содержит переменная $myrow[avatar] -->

<!-- Именно здесь можно добавлять формы для отправки комментариев и прочего... -->

HERE;
}

?>
</body>
</html>
