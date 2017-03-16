<?
	include "../config.php"; //Файл конфигурации БД
	$_GET['id'] = htmlspecialchars($_GET['id']); 
	$_GET['id'] = intval($_GET['id']);	
	if(empty($_GET['id'])) $_GET['id'] = 1; 
	$resultBlog = mysql_query("SELECT * FROM blog WHERE id = '".$_GET['id']."'"); 
	$rowBlog = mysql_fetch_array($resultBlog); 
	
	if (empty($rowBlog['name'])){
		echo '<meta http-equiv="refresh" content="0;URL=404.php">';
		exit();
	} 

	$blogname		= $rowBlog['name'];
	define('BLOG_TITLE', $blogname);
	$blogdate		= $rowBlog['date'];
	define('BLOG_DATE', $blogdate);
	$blogimg		= $rowBlog['img'];
	define('BLOG_IMG', $blogimg);
	$blogbody		= stripslashes($rowBlog['body']);
	define('BLOG_BODY', $blogbody);
	$blogkey		= $rowBlog['metakeywords'];
	define('BLOG_KEY', $blogkey);
	$views = $rowBlog['views'] + 1;
	$sql = mysql_query("UPDATE blog SET views=$views WHERE id=$rowBlog[id]");
	$ipguest = $_SERVER["REMOTE_ADDR"];
	$browserguest = $_SERVER['HTTP_USER_AGENT'];
	$page = $_SERVER['REQUEST_URI'];
	$query = mysql_query("INSERT INTO statistic (ip, browser, page) values ('$ipguest', '$browserguest', '$page')");
?>
<html>
	<head>
	    <meta charset="UTF-8">
		<style>
			body{
				font-family: 'HelveticaNeue', sans-serif;
				font-weight: lighter;
				font-size: 11pt;
				text-align: left;
				
			}
			img{
			    width: auto !important;
			    max-width: 100% !important;
			    height: auto !important;
				padding-top: 20px;
				padding-bottom: 20px;
			}
			hr{
				border:1px dashed #e3e3e3;
			}
			p, ol, ul
			{
				margin-top: 0px;
			}
			
			p
			{
			font-family: 10pt;
			}
			#page
			{
				overflow: hidden;
				padding: 10px 0px;
			}
			button 
			{
                background: #2E8CE3; /* Цвет фона */
                padding: 7px 30px; /* Поля вокруг текста */
                font-size: 13px; /* Размер шрифта */ 
                font-weight: bold; /* Насыщенность шрифта */
                color: #FFFFFF; /* Цвет шрифта */
                text-align: center; /* Надпись на кнопке по центру */
                border: solid 1px #73C8F0; /* Параметры рамки кнопки */ 
                cursor: pointer; /* Изменение вида курсора при наведении*/
            }
            input
            {
                padding:3px;
                margin-bottom:5px;
                font-size:16px;
            }
		</style>
	</head>
	<body>
	<div id="page">
	<center><a style="font-size:15pt;"><b><?=BLOG_TITLE?></b></a><br>
		<!-- Дата объявления
		<a style="color:grey;font-size:9pt;"><?=BLOG_DATE?></a></center>-->
		
		<p align="center"><!--<img height="260" src="<?=BLOG_IMG?>">--> <?=BLOG_BODY?>
		
		</p>
	</div>
<br>
<hr>
<center>
Нужны подробности?<br>
<form action="http://jumbo-capital.com/order.php" method="post">
<input type="hidden" name="page" value="<?php
$a = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
echo $a;
?>">
<input type="text" size="25" name="name" placeholder="Имя"><br>
<input type="text" size="25" name="phone" placeholder="Телефон"><br>
<button type="submit">Перезвоните мне</button>
</form>
</center>


<center>
<!--
<a  href="http://vk.com/share.php?url=http://vk.com/get29" target="_blank">Сделать нам хорошо!</a><br>
-->
<span style="visibility:hidden">
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.1;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,80))+";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet-->
</span>
</center>
<!--<hr>
		<table height="40"><tr><td> <a style="color:#B30100;font-size:13px;">Метки:</a> <a style="font-size:13px;color:grey;"><?=BLOG_KEY?></a></td></tr></table>
				<hr><br>
				<div align="center" class="share42init"></div>
-->
<script type="text/javascript" src="../resource/share42.js"></script><br>
	</body>
</html>