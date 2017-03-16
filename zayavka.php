<!DOCTYPE HTML>
<html>
	<head>
		<title>Скидки.РФ</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Скидки.РФ" />
		<meta name="keywords" content="Скидки.РФ" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.poptrox.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />

		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header">
				<a href="/" class="image avatar"><img src="images/avatar.png" alt="" /></a>
				<h1><strong>Скидки.РФ</strong><br>
					 Рекламное приложение<br>
				для iOS и Android<br>
				</h1>
				<br/>
				<a href="index.php#product">О продукте</a><br/>
				<a href="pricing.php">Тарифы</a><br/>
				<a href="index.php#request">Разместить акцию</a><br/>
				<!--<a href="objavl.php">Разместить объявление</a>-->
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
						<header class="major">
							<?php
							if (isset($_POST['lead_name'])) {$lead_name = $_POST['lead_name'];}
							if (isset($_POST['lead_email'])) {$lead_email = $_POST['lead_email'];}
							if (isset($_POST['city'])) {$city_selected = $_POST['city'];}
							if (isset($_POST['city_specified'])) {$city_specified = $_POST['city_specified'];}
							if (isset($_POST['message'])) {$message = $_POST['message'];}
							
							if (($city_selected) && ($city_selected != 'other')) {
								
								$user_city = $city_selected;
							}
							elseif (($city_selected == 'other') && ($city_specified != '')) {
								$user_city = $city_specified;
								
							}
							else {
								
								$user_city = 'Не указан';
							}
							
							if (empty($lead_name))
								{
									echo "<p>Не указано имя!</p>";
									echo "<p>Вернуться на страницу <a href=index.php>заявки</a> и заполнить контактные данные</p>";
									exit;
								} 
								if (empty($lead_email))
									{
										echo "<p>Не указан email</p>";
										echo "<p>Вернуться на страницу <a href=index.php>заявки</a> и заполнить контактные данные</p>";
										exit;
									} 
									else 
									$to = "sales@sale-russia.com";
									$headers = "Content-type: text/plain; charset=utf-8";
									$subject = "Скидки.РФ, Запрос размещения в приложении";
									$message = "Имя: $lead_name \n
									Email: $lead_email\n
									Город: $user_city\n
									Сообщение: $message";
									$send = mail ($to, $subject, $message, $headers);
									if ($send == 'true')
										{
											echo "<h2>Запрос получен</h2>Спасибо за интерес к нашему предложению, мы скоро с Вами свяжемся!";
											echo "<p><b><a href='index.php'></a></b></p>";
										}
										else 
											{
												echo "<p><b>Ошибка. Сообщение не отправлено! Попробуйте написать напрямую на sales@sale-russia.com";
											}
											
											
								?>

						</header>
						<!--<ul class="actions">
							<li><a href="#" class="button">Узнайте больше</a></li>
						</ul>
					-->
					</section>

				

			</div>

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<!--<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
					<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>-->
					<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>Скидки.РФ &copy;</li> 2015-2016</li>
				</ul>
			</footer>

	</body>
</html>