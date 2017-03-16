<?
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Loutskiy CMS 6 Lucid Lynx</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
	<body class="left-sidebar">
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Content -->
					<div id="content">
						<div id="content-inner">
							<!-- Post -->
								<article class="is-post is-post-excerpt">
									<? require("login.php");?>
									<header>
										<h2><a>Установщик тем</a></h2>
									</header>
									<p>
									  <a href="theme.php"><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Назад" ></a><a href="http://store.loutskiy.ru/themes"><input hidden style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Загрузить из магазина" ></a><br>
									<?php
									function themeinstall(){
									require "../config.php";
									$uploaddir = '../tmp/';
									$apend=date('YmdHis').rand(100,1000).'.zip';
									$uploadfile="$uploaddir$apend";
									move_uploaded_file($_FILES['theme']['tmp_name'], $uploadfile);
									
									$zip = new ZipArchive;
									$res = $zip->open($uploadfile);
									if ($res === TRUE) {
									    $zip->extractTo('../tmp', array('info.php'));
									    $zip->close();
									} 
										if (file_exists("../tmp/info.php")){
											include "../tmp/info.php";
											if(file_exists("../themes/$template_dir")) {
												unlink("../tmp/info.php");
												unlink($uploadfile);
												exit("Тема $template_name уже установлена!");
											}
											mkdir("../themes/$template_dir", 0755,true);
												$zip = new ZipArchive;
												if ($zip->open($uploadfile) === TRUE) {
												    $zip->extractTo("../themes/$template_dir");
												    $zip->close();
												    $sql = mysql_query("INSERT INTO themes (dir) VALUES ('$template_dir')");
												    echo '<meta http-equiv="refresh" content="0; url=theme.php?status=1&name='.$template_name.'">';
												    unlink("../tmp/info.php");
												    unlink($uploadfile);
												} 
												else {
													unlink("../tmp/info.php");
												}
											}
										else {
											unlink("../tmp/info.php");
											unlink($uploadfile);
											exit ("ОШИБКА - В архиве отсутствуют нужные компоненты");
										}
									}
									function themeinstall2(){
									require "../config.php";
									$dir = $_POST['dir'];
									if(file_exists("../themes/$dir/info.php")){
										include "../themes/$dir/info.php";
										$sql = mysql_query("INSERT INTO themes (dir) VALUES ('$dir')");
										echo '<meta http-equiv="refresh" content="0; url=theme.php?status=1&name='.$template_name.'">';
									}
									else {
										exit("ОШИБКА - В теме отсутствуют нужные компоненты");
									}	
									}
									if($_POST['submit']) themeinstall();
									if($_POST['submit2']) themeinstall2();
									?>
									<fieldset><legend><h3>Автоматическая установка<a>*</a></h3></legend>
										<form action="" method="post" enctype="multipart/form-data">
										<input type="file" name="theme">
										<input type="submit" name="submit" value="Установить">
										<p><a>*</a>Выберите ZIP-архив с файлами темы для Loutskiy CMS 6</p>
										</form>
									</fieldset>
									<hr>
									<fieldset>
									<legend><h3>Ручная установка</h3></legend>
										<p>Загрузите папку с темой на сервер, в директорию "themes/" и введите в поле ниже название этой папки. Использовать слеши (/) не нужно.</p>
										<form action="" method="post">
										<input type="text" size="34" name="dir">
										<input type="submit" name="submit2" value="Установить">
										</form>
									</fieldset>
									</p>
								</article>
						</div>
					</div>
				<!-- Sidebar -->
					<div id="sidebar">
						<!-- Logo -->
						<center><a href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a href="post.php">Записи</a></li>
									<li><a href="categories.php">Категории</a></li>
									<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>
									<li><a href="user.php">Пользователи</a></li>
									<li class="current_page_item"><a href="pref.php">Настройки</a></li>
									<li><a href="exit.php">Выход</a></li>
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