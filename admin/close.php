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
										<h2><a>Доступность сайта</a></h2>
									</header>
<? include("../config.php"); 
$sqlsite = mysql_query("SELECT * FROM site WHERE id=1 LIMIT 1");
$rowsite = mysql_fetch_array($sqlsite);
?>									<form action="scriptclose.php" method="post">
<table cellspacing="10">
<script type="text/javascript" src="../resource/ckeditor/ckeditor.js"></script>
<script src="../resource/ckeditor/_samples/sample.js" type="text/javascript"></script>
<style>
textarea {
  resize: none;
}
</style>
<tr><td colspan="2"><a style="font-size:20px;text-decoration:none;" >Техническое сообщение:</a></td></tr><tr><td><textarea style="background-color:#e6e6e6; font-size:15px" cols="61" rows="10" class="ckeditor" name="mess" id="editor1"><?=htmlspecialchars(stripslashes($rowsite['CloseMess']));?></textarea></td></tr>
<script type="text/javascript">
			//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using the "bbcode" plugin, shaping some of the
			// editor configuration to fit BBCode environment.
			CKEDITOR.replace( 'editor1',
				{
					
					// Remove unused plugins.
					removePlugins : 'bidi,button,dialogadvtab,div,filebrowser,flash,format,forms,horizontalrule,iframe,indent,justify,liststyle,pagebreak,showborders,stylescombo,table,tabletools,templates',
					// Width and height are not supported in the BBCode format, so object resizing is disabled.
					disableObjectResizing : true,
					// Define font sizes in percent values.
					fontSize_sizes : "30/30%;50/50%;100/100%;120/120%;150/150%;200/200%;300/300%",
					toolbar :
					[
						['Source', '-', ,'NewPage','-','Undo','Redo'],
						['Find','Replace','-','SelectAll','RemoveFormat'],
						['Link', 'Unlink', 'Smiley','SpecialChar'],
						'/',
						['Bold', 'Italic','Underline'],
						['FontSize'],
						['TextColor'],
						['NumberedList','BulletedList','-','Blockquote'],
						['Maximize', 'Image']
					],
					// Strip CKEditor smileys to those commonly used in BBCode.
					smiley_images :
					[
						'regular_smile.gif','sad_smile.gif','wink_smile.gif','teeth_smile.gif','tounge_smile.gif',
						'embaressed_smile.gif','omg_smile.gif','whatchutalkingabout_smile.gif','angel_smile.gif','shades_smile.gif',
						'cry_smile.gif','kiss.gif'
					],
					smiley_descriptions :
					[
						'smiley', 'sad', 'wink', 'laugh', 'cheeky', 'blush', 'surprise',
						'indecision', 'angel', 'cool', 'crying', 'kiss'
					]
			} );

			//]]>
			</script>
			
<tr><td colspan="2"><a style="font-size:20px;text-decoration:none;" ><br>Заблокировать сайт:</a></td></tr><tr><td><input
<? if($rowsite['Close'] == "1"){ 
	echo("checked");
} ?>
 type="checkbox" name="block" value="1"></td></tr>
</table>

<input class="submit" type="submit" value="Отправить" name="edit"> 
</form>

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