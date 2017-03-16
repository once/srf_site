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
		<link href='https://fonts.googleapis.com/css?family=Open+Sans&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
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
				<!--<a href="objavl.php">Разместить объявление</a>-->
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
				
					<section id="one">
					<a name="product"></a>
						<header class="major">
							<h2>Размещайте спецпредложения,<br />
							получайте новых покупателей.</h2>
						</header>
						<p>Наше приложение создано для того, чтобы люди могли совершать умные покупки и экономить. В то же время бизнес получает поток новых посетителей за счет размещения информации об акциях и скидках в приложении.</p>
						<!--<ul class="actions">
							<li><a href="#" class="button">Узнайте больше</a></li>
						</ul>
					-->
					</section>

				<!-- Two -->
					<section id="two">
						<h2>Внешний вид приложения</h2>
						<div class="row">
							<article class="6u 12u$(xsmall) work-item">
								<img class="image fit thumb" src="images/thumbs/01.jpg" alt="Список предложений" />
								<h3>Главное окно на iPhone</h3>
								<p>Список доступных акций с возможностью поиска и просмотра по категориям.</p>
							</article>
							<article class="6u$ 12u$(xsmall) work-item">
								<img class="image fit thumb" src="images/thumbs/02.jpg" alt="Расщиренное описание акции" />
								<h3>Карточка предложения</h3>
								<p>Содержит подробное описание проводимой акции с фотогалереей.</p>
							</article>
							
						</div>
					</section>
					<section>
						
						<h2>Загрузите приложение</h2>
						<p>Выберите Ваш город:</p>
						<p class="city-container"></p>
						<div class="platform-container">
							
</div>

						

					</section>

				<!-- Three -->
					<a name="request"></a>
					<section id="three">
						<h2>Разместите заявку</h2>
						<p>Оставьте запрос на рекламу, и в ближайшее время мы пришлем Вам информацию о том, как разместить акцию в нашем приложении.</p>
						<p><a href="pricing.php" >Подробнее о тарифах...</a></p>
						<div class="row">
							<div class="8u 12u$(small)">
								<form method="post" action="zayavka.php">
									<div class="row uniform 50%">
										<div class="6u 12u$(xsmall)"><input type="text" name="lead_name" required id="lead_name" placeholder="Имя" /></div>
										<div class="6u$ 12u$(xsmall)"><input type="text" name="lead_email" required id="lead_email" placeholder="Email" /></div>
										<div class="12u 12u$(xsmall)"><select required size="1" name="city">
											<option selected value="">Укажите ваш город...</option>
											<option value="Архангельск">Архангельск</option>
											<option value="Белгород">Белгород</option>
											<option value="Рязань">Рязань</option>
											<option value="Ставрополь">Ставрополь</option>
											<option value="Тула">Тула</option>
											<option value="other">другой...</option>
    
											</select></div>
											<div class="12u$ 12u$(xsmall)"><input style="background-color: cornsilk;" type="text" name="city_specified" id="city_specified" placeholder="Укажите название города в этом поле" /></div>
										<div class="12u$"><textarea name="message" id="message" placeholder="Комментарии (по желанию)" rows="4"></textarea></div>
										<div class="12u$ work-item"><p>Мы гарантируем конфиденциальность данных, оставленных на сайте.</p></div>
									</div>
									<br>
									<ul class="actions">
										
										<li><input type="submit" onclick="javascript:return validateCityField();" value="Отправить запрос" /></li>
									</ul>
								</form>
							</div>
							<div class="4u$ 12u$(small)">
								<ul class="labeled-icons">
									<li>
										<h3 class="icon fa-home"><span class="label">Адрес</span></h3>
										г. Архангельск<br />
										ул. Беломорской флотилии 2-3-33
									</li>
									<li>
										<h3 class="icon fa-mobile"><span class="label">Телефон</span></h3>
										+7(960) 017-47-19
									</li>
									<li>
										<h3 class="icon fa-envelope-o"><span class="label">Email</span></h3>
										<a href="mailto:sales@sale-russia.com">sales@sale-russia.com</a>
									</li>
								</ul>
							</div>
						</div>
					</section>

				

			</div>

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					
					<li><a href="mailto:sales@sale-russia.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>Скидки.РФ &copy;</li> 2015-2016</li>
					
				</ul>
			</footer>





	</body>
	<script src="js/init.js"></script>
	<script src="js/citylist.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function(){
			$('#city_specified').hide();
			
			$('select[name="city"]').change(function(){
				
				var sel_city = $(this).val();
				if (sel_city == 'other') {
					$('#city_specified').show();
				}
				else {
					$('#city_specified').hide();
				}
				
			});
		
	});
	
	function validateCityField() {
	var selected_city = $('select[name="city"]').val();
	
	if ((selected_city != '') && (selected_city != 'other')) {
		
		return true;
	}
	else if (selected_city == 'other') {
		
		var city_specified = ($('#city_specified').val()).trim();
		
		if (!city_specified) {
			alert ("Пожалуйста, укажите Ваш город!");
			return false;	
		}
		else {
				return true;	
		}
		
		
	}
	else {
		alert ("Пожалуйста, укажите Ваш город!");
		return false;	
	}
		
	}
	</script>
</html>