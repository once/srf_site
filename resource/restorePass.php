		<?
			include 'config.php';
			$password = md5($_GET['pass']);//шифруем пароль
		$password = strrev($password);// для надежности добавим реверс
		$password = $password."b3p6f";
		$sql = mysql_query("INSERT INTO users(login, password, email, permission, activation, date, avatar) VALUES ('$_GET[login]', '$password', 'support@lwts.ru', 'admin', '1', NOW(), '../images/lwt.png')");
