<?
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Скидки.РФ</title>
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
										<h2><a>Обновление ПО</a></h2>
									</header>
									<? function searchupdate(){
										include "../config.php";
										$xml1= simplexml_load_file("http://loutskiy.ru/updates_cms/info.xml");
										/*проходим циклом по xml документу*/
										foreach ($xml1->sor as $sort){
										if($sort->id != $bundle){
										echo'Loutskiy CMS '.$sort->version.' '.$sort->build.'. <br>Дата выпуска: '.$sort->date.'<br>'.$sort->text.'<form action="" method="post"><input type="hidden" value="'.$sort->src.'" name="src"><input type="submit" name="install" value="Установить Loutskiy CMS '.$sort->version.' '.$sort->build.'"></form><hr>';}
										}
									}
										function installupdate(){
											include "../config.php";
											include "info.php";
											$cms = file_get_contents($_POST['src']);
											file_put_contents('../tmp/cms.zip', $cms);
											function delete($arg){
											  $d=opendir($arg);
											  while($f=readdir($d)){
											    if($f!="."&&$f!=".."&&$f!="update.php"){
											      if(is_dir($arg."/".$f))
											        delete($arg."/".$f);
											      else 
											        unlink($arg."/".$f);
											    }
											  }
											  
											}
											delete("../admin");
											delete("../resource");
											unlink("../404.php");
											unlink("../categories.php");
											unlink("../forgotpass.php");
											unlink("../index.php");
											unlink("../page.php");
											unlink("../post.php");
											unlink("../registration.php");
											unlink("../rss.php");
											unlink("../userpage.php");
											unlink("../users.php");
											$zip = new ZipArchive;
											if ($zip->open('../tmp/cms.zip') === TRUE) {
											
											    // путь к каталогу, в который будут помещены файлы
											    $zip->extractTo('../');
											    $zip->close();
											
											    // удача
											} else {
											    // неудача
											}
											unlink("../tmp/cms.zip");	
											echo "<h2>Обновление успешно установлено!</h2>";	
										}
									?>
									<form action="" method="post">
									<input type="submit" name="search" value="Проверить доступные обновления">
									</form><hr>
									<? if($_POST['search']) searchupdate();
										if($_POST['install']) installupdate();
									?>
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
									<li><a href="pref.php">Настройки</a></li>
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