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
									<?
        require '../config.php';
        $_GET['id'] = htmlspecialchars($_GET['id']); 
        if(empty($_GET['id'])) $_GET['id'] = 1; 
        $result = mysql_query("SELECT * FROM comments;", $db); 
        $row = mysql_fetch_array($result); 
?> 
									<header>
										<h2><a>Все комментарии</a></h2>
									</header>
									<center> <table cellpadding="4" cellspacing="10" width="890px"> <tr><td>Пользователь</td><td>Содержимое комментария</td><td>E-Mail</td><td>Адрес страницы</td><td>Время</td><td>Удалить</td></tr>
 <?
if(strlen($_GET['del']) !=0 ) 
{
  $sql = "DELETE FROM comments WHERE id=".$_GET['del'];
  $res=mysql_query($sql);

    if (!$res) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $sql;
    die($message);
  } else {
  echo "Комментарий удален!<br>";
  } }
 ?>
 <?php 


$resultMenu = mysql_query("SELECT * FROM comments ORDER BY id DESC", $db); 

           while($row = mysql_fetch_array($resultMenu)){
    echo '<tr><td><a>'.stripslashes($row['name'] ).'</a></td><td><a>'.stripslashes($row['body'] ).'</a></td><td><a>'.stripslashes($row['email'] ).'</a></td><td><a href="http://ijournaler.ru'.stripslashes($row['url'] ).'">'.stripslashes($row['url'] ).'</a></td><td><a>'.stripslashes($row['dt'] ).'</a></td><td><a href="comment.php?del='.$row['id'].'">Удалить</a></td></tr>';
                 }
                
           

        ?> </table> </center>

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
									<li class="current_page_item"><a href="comment.php">Комментарии</a></li>
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