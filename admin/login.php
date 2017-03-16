<?php
session_start();

include ("../config.php");

if (isset($_COOKIE['autoadmin']) and isset($_COOKIE['loginadmin']) and isset($_COOKIE['passwordadmin']))
{
	if ($_COOKIE['autoadmin'] == 'yes') { 
		  $_SESSION['passwordadmin']=strrev(md5($_COOKIE['passwordadmin']))."b3p6f"; 
		  $_SESSION['loginadmin']=$_COOKIE['loginadmin'];
		  $_SESSION['idadmin']=$_COOKIE['idadmin'];
		}	
	}

if (!empty($_SESSION['loginadmin']) and !empty($_SESSION['passwordadmin']))
{

$login = $_SESSION['loginadmin'];
$password = $_SESSION['passwordadmin'];
$result = mysql_query("SELECT id,avatar FROM users WHERE login='$login' AND password='$password'  AND activation='1'",$db); 
$myrow = mysql_fetch_array($result);
}
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</header>
<?php
if (!isset($myrow['avatar']) or $myrow['avatar']=='') {
print <<<HERE
<header>
<h2><a>Добро пожаловать!</a></h2>
<span class="byline">Введите свой логин и пароль для входа в Админ-панель</span>
<form action="testreg.php" method="post">
<!-- testreg.php - это адрес обработчика. То есть, после нажатия на кнопку "Войти", данные из полей отправятся на страничку testreg.php методом "post"  -->
  <p>
    <label>Ваш логин:<br></label>
    <input name="login" type="text" style="width:100%"  maxlength="15"
HERE;

	
if (isset($_COOKIE['loginadmin'])) 
{
echo ' value="'.$_COOKIE['loginadmin'].'">';
}


print <<<HERE
  </p>
<!-- В текстовое поле (name="login" type="text") пользователь вводит свой логин -->  
  <p>
    <label>Ваш пароль:<br></label>
    <input name="password" type="password" style="width:100%" maxlength="15"
HERE;

	
if (isset($_COOKIE['passwordadmin']))
{
echo ' value="'.$_COOKIE['passwordadmin'].'">';
}
include("info.php");	
print <<<HERE
  </p>
<!-- В поле для паролей (name="password" type="password") пользователь вводит свой пароль -->  

<input type="hidden" value="$_SERVER[REQUEST_URI]" name="url">
<p>
<input type="submit" name="submit" value="Войти">
<!-- Кнопочка (type="submit") отправляет данные на страничку testreg.php  --> 
<br>
<br>
<!-- ссылка на восстановление пароля  --> 
<a href="send_pass.php">Забыли пароль?</a> 

</p></form>
		</article>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
						<center><a href="index.php"><img width="150" src="../images/lwt.png"></a></center>
					<!-- Version -->
							<section class="is-text-style1">
								<div class="inner">
									<p>
										<strong>Версия:</strong> $bundle
									</p>
								</div>
							</section>
					
						<!-- Copyright -->
							<div id="copyright">
								<p>
									$year$copyright$company<br />
								</p>
							</div>

					</div>
HERE;
die();
}


?>