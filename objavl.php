<!DOCTYPE HTML>
<!--
	Strata by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Скидки.РФ</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="Скидки.РФ" />
		<meta name="keywords" content="Скидки РФ скидки Архангельска скидки северодвинска скидки вологды скидки ярославля" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />

		</noscript>
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.poptrox.min.js"></script>
		<script src="js/skel.min.js"></script>
		
		
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
				<a href="objavl.php">Разместить объявление</a>
				
			</header>

		<!-- Main -->
			<div id="main">

					
					<section id="one">
						<h2>Разместите объявление</h2>
						<p>Шаг 1. Оплатите размещение объявления удобным вам способом через сервис Яндекс.Касса. <a href="#" >Перейти к оплате...</a></p>
						<p>Шаг 2. По электронной почте получите идентификатор размещения (Ad-ID)</p>
						<p>Шаг 3. Укажите свои контактные данные, текст объявления а также полученный идентификатор Ad-ID. Если все указано верно, через некоторое время объявление будет опубликовано в мобильном приложении.</p>
						<p><a href="pricing.php" >Подробнее о тарифах...</a></p>
						<div class="row">
							<div class="8u 12u$(small)">
								<form method="post" action="post_objavl.php">
									<div class="row uniform 50%">
										<div class="6u 12u$(xsmall)"><input type="text" name="lead_name" required id="lead_name" placeholder="Имя" /></div>
										<div class="6u$ 12u$(xsmall)"><input type="text" name="lead_email" required id="lead_email" placeholder="Email" /></div>
										<div class="12u$ 12u$"><input type="text" name="ad-id" required id="ad-id" placeholder="Идентификатор размещения (Ad-ID)" /></div>
										<div class="12u$"><textarea name="message" id="message" required placeholder="Текст объявления" rows="4"></textarea></div>
										<div class="12u$ work-item"><p>Мы гарантируем конфиденциальность данных, оставленных на сайте.</p></div>
									</div>
									
									<ul class="actions">
										
										<li><input type="submit" value="Разместить объявление" /></li>
									</ul>
								</form>
							</div>
							
						</div>
					</section>

				

			</div>

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					
					<li><a href="mailto:support@sale-russia.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>Скидки.РФ &copy;</li> 2015-2016</li>
					
				</ul>
			</footer>





	</body>
	<script src="js/init.js"></script>
</html>