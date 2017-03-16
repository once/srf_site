<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!DOCTYPE HTML>
<html>
	<head>
		<title>Loutskiy CMS 6 Lucid Lynx</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
	</head>
	<!--
		Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
		Set it to "right-sidebar" to, you guessed it, position it on the right.
	-->
	<body class="left-sidebar">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div id="content-inner">
					
							<!-- Post -->
								<article class="is-post is-post-excerpt">
<?php
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную

if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} } //заносим введенный пользователем e-mail, если он пустой, то уничтожаем переменную

if (isset($login) and isset($email)) {//если существуют необходимые переменные  
	
	include ("../config.php");// файл config.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
	
	$result = mysql_query("SELECT id FROM users WHERE login='$login' AND email='$email' AND activation='1'",$db);//такой ли у пользователя е-мейл
	$myrow = mysql_fetch_array($result);
	if (empty($myrow['id']) or $myrow['id']=='') {
		//если активированного пользователя с таким логином и е-mail адресом нет
		exit ("Пользователя с таким e-mail адресом не обнаружено. <a href='../index.php'>Главная страница</a>");
		}
	//если пользователь с таким логином и е-мейлом найден, то необходимо сгенерировать для него случайный пароль, обновить его в базе и отправить на е-мейл
	$datenow = date('YmdHis');//извлекаем дату 
	$new_password = md5($datenow);// шифруем дату
	$new_password = substr($new_password, 2, 6);	//извлекаем из шифра 6 символов начиная со второго. Это и будет наш случайный пароль. Далее запишем его в базу, зашифровав точно так же, как и обычно.
	
$new_password_sh = strrev(md5($new_password))."b3p6f";//зашифровали
mysql_query("UPDATE users SET password='$new_password_sh' WHERE login='$login'",$db);// обновили в базе
	//формируем сообщение
	$headers = "Content-type:text/plane; Charset=utf-8\r\n"; 
	$subject = "Восстановление пароля";//тема сообщения
	$message = "Здравствуйте, ".$login."! Мы сгененриоровали для Вас пароль, теперь Вы сможете войти на сайт ".$_SERVER['SERVER_NAME'].", используя его. После входа желательно его сменить. Пароль:\n".$new_password;//текст сообщения
	mail($email, $subject, $message);//отправляем сообщение
	
	echo "<html><head><meta http-equiv='Refresh' content='5; URL=../index.php'></head><body>На Ваш e-mail отправлено письмо с паролем. Вы будете перемещены через 5 сек. Если не хотите ждать, то <a href='../index.php'>нажмите сюда.</a></body></html>";//перенаправляем пользователя
	}


else {//если данные еще не введены
echo '
<html>
<head>
</head>
<body>
<h2>Забыли пароль?</h2>
<form action="#" method="post">
Введите Ваш логин:<br> <input type="text" name="login"><br><br>
Введите Ваш E-mail: <br><input type="text" name="email"><br><br>
<input type="submit" name="submit" value="Отправить">
</form>
</body>
</html>';
}

?>
</article>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
					
						<!-- Logo -->
						<center><a href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<nav id="nav">
								<ul>
									<li><a href="index.php">Вход</a></li>
								</ul>
							</nav>
						<!-- Version -->
							<section class="is-text-style1">
								<div class="inner">
									<p><? include("info.php"); ?>
										<strong>Версия:</strong> <?=$bundle?>
									</p>
								</div>
							</section>
						<!-- Copyright -->
							<div id="copyright">
								<p>
									<?=$year.$copyright.$company?><br />
								</p>
							</div>
					</div>
			</div>
	</body>
</html>