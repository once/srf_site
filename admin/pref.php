<?
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Скидки.РФ</title>
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
		<script type="text/javascript" src="../resource/ckfinder/ckfinder.js"></script>
	<script type="text/javascript">

function BrowseServer()
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.selectActionFunction = SetFileField;
	finder.popup();

	// It can also be done in a single line, calling the "static"
	// popup( basePath, width, height, selectFunction ) function:
	// CKFinder.popup( '../', null, null, SetFileField ) ;
	//
	// The "popup" function can also accept an object as the only argument.
	// CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl )
{
	document.getElementById( 'xFilePath' ).value = fileUrl;
}
function BrowseServer2()
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.selectActionFunction = SetFileField2;
	finder.popup();

	// It can also be done in a single line, calling the "static"
	// popup( basePath, width, height, selectFunction ) function:
	// CKFinder.popup( '../', null, null, SetFileField ) ;
	//
	// The "popup" function can also accept an object as the only argument.
	// CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField2( fileUrl )
{
	document.getElementById( 'xFilePath2' ).value = fileUrl;
}
function BrowseServer3()
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();
	finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.selectActionFunction = SetFileField3;
	finder.popup();

	// It can also be done in a single line, calling the "static"
	// popup( basePath, width, height, selectFunction ) function:
	// CKFinder.popup( '../', null, null, SetFileField ) ;
	//
	// The "popup" function can also accept an object as the only argument.
	// CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField3( fileUrl )
{
	document.getElementById( 'xFilePath3' ).value = fileUrl;
}

	</script>

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
									<? require("login.php");?>
									<header>
										<h2><a>Системные настройки</a></h2>
										
									</header>
									<? 
	function show_form(){ 
       
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM site WHERE id = 1;", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<script type="text/javascript" src="../resource/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../resource/ckfinder/ckfinder.js"></script>
<form action="" method="post"> 

<table cellspacing="10">
    <tr><td><a style="font-size:20px;text-decoration:none;" >Название сайта: </a></td> <td><input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="Name" value="<?=htmlspecialchars(stripslashes($row['Name']));?>"  class="enter" size="50"></td> </tr>
    <tr> <td><a style="font-size:20px;text-decoration:none;" >Описание сайта: </a></td> <td><input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="Description" value="<?=htmlspecialchars(stripslashes($row['Description']));?>"  class="enter" size="50"></td> </tr>
    <tr> <td><a style="font-size:20px;text-decoration:none;" >Количество постов на странице: </a></td> <td><input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="PageCount" value="<?=htmlspecialchars(stripslashes($row['PageCount']));?>"  class="enter" size="50"></td> </tr>
    <tr> <td><a style="font-size:20px;text-decoration:none;" >Ключевые слова: </a></td> <td><input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="Keywords" value="<?=htmlspecialchars(stripslashes($row['Keywords']));?>"  class="enter" size="50"></td> </tr>
    <tr> <td><a style="font-size:20px;text-decoration:none;" >Копирайт (Footer): </a></td> <td><input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="Footer" value="<?=htmlspecialchars(stripslashes($row['Footer']));?>"  class="enter" size="50"> </td></tr>
     <tr><td colspan="2"><a style="font-size:20px;text-decoration:none;" >О сайте: </a></td></tr><tr> <td colspan="2"><br><textarea style="background-color:#e6e6e6; font-size:15px" cols="61" rows="10" class="ckeditor" name="About" id="editor1"><?=htmlspecialchars(stripslashes($row['About']));?></textarea>
     
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
						['Bold', 'Italic','Underline'],
						
						['Find','Replace','-','SelectAll'],
						['Link', 'Unlink'],
						
						['FontSize'],
						['TextColor'],
						['NumberedList','BulletedList','-','Blockquote'],
						['Image'],
						['Source', '-', ,'NewPage','-','Undo','Redo']
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
			</script></td></tr>
			<tr><td><a style="font-size:20px;text-decoration:none;" ><br>Возможность регистрироваться:</a></td><td><br><input
<? if($row['users'] == "1"){ 
	echo("checked");
} ?>
 type="checkbox" name="users" value="1"></td></tr>
 <tr><td><a style="font-size:20px;text-decoration:none;" >Favicon: </a></td><td>		<input id="xFilePath" style="padding:5px; background-color:#e6e6e6;font-size:15px;" name="Favicon" type="text" size="40" value="<?=htmlspecialchars(stripslashes($row['Favicon']));?>" />
		<input type="button" value="Выбрать" onclick="BrowseServer();" /></td>
</tr>
 <tr><td><a style="font-size:20px;text-decoration:none;" >Logo сайта: </a></td><td>		<input id="xFilePath3" style="padding:5px; background-color:#e6e6e6;font-size:15px;" name="Logo" type="text" size="40" value="<?=htmlspecialchars(stripslashes($row['Logo']));?>" />
		<input type="button" value="Выбрать" onclick="BrowseServer3();" /></td>
</tr>
 <tr><td><a style="font-size:20px;text-decoration:none;" >iOS icon: </a></td><td>		<input id="xFilePath2" style="padding:5px; background-color:#e6e6e6;font-size:15px;" name="iOS" type="text" size="40" value="<?=htmlspecialchars(stripslashes($row['iOS']));?>" />
		<input type="button" value="Выбрать" onclick="BrowseServer2();" /></td>
</tr>

</table>

<br>
<input type="hidden" name="id" value="1"> 
<input class="submit" type="submit" value="Сохранить" name="edit"> 
  
</form> </body>
<? 
}  
function complete(){ 
     
      require '../config.php'; 

     
      $result = mysql_query("SELECT * FROM site WHERE id = 1;", $db); 
    
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO site 
                     (Name, 
                      Description, 
                      Keywords, 
                      Footer,                      
                      About,
                      users,
                      Favicon,
                      iOS,
                      Logo,
                      PageCount
                      ) 
                                      VALUES 
                            ('".mysql_real_escape_string($_POST['Name'])."', 
                             '".mysql_real_escape_string($_POST['Description'])."', 
                            
                             '".mysql_real_escape_string($_POST['Keywords'])."',
                             '".mysql_real_escape_string($_POST['Footer'])."',
                             '".mysql_real_escape_string($_POST['About'])."',
                             '".mysql_real_escape_string($_POST['users'])."',
                             '".mysql_real_escape_string($_POST['Favicon'])."',
                             '".mysql_real_escape_string($_POST['iOS'])."',
                             '".mysql_real_escape_string($_POST['Logo'])."',
                             '".mysql_real_escape_string($_POST['PageCount'])."'
                             )"; 
    
      else 
            $query = "UPDATE site SET 
                                     Name = '".mysql_real_escape_string($_POST['Name'])."', 
                                     Description = '".mysql_real_escape_string($_POST['Description'])."',                                     
                                     Keywords = '".mysql_real_escape_string($_POST['Keywords'])."', 
                                     Footer = '".mysql_real_escape_string($_POST['Footer'])."', 
                                     About = '".mysql_real_escape_string($_POST['About'])."',
                                     users = '".mysql_real_escape_string($_POST['users'])."',
                                     Favicon = '".mysql_real_escape_string($_POST['Favicon'])."',
                                     iOS = '".mysql_real_escape_string($_POST['iOS'])."',  
									 Logo = '".mysql_real_escape_string($_POST['Logo'])."',
									 PageCount = '".mysql_real_escape_string($_POST['PageCount'])."'

                     WHERE id = 1;"; 
      mysql_query($query, $db); 
} 
function show_pages() { 
?> 
<? 
        require '../config.php'; 
show_form();
} 
if($_POST['edit']) complete(); 
show_pages(); 
?> 
<? include("info.php"); ?>
<hr>
<h3><a href="close.php">Доступность сайта</a></h3>
<hr>
<h3><a href="update.php">Обновление системы</a></h3>
<hr>
<h1>Системная информация</h1>
<table cellpadding="5">
<tr><td><a>Вы вошли как:</a></td><td><? echo $login;?></td></tr>
<tr><td><a>Система:</a></td><td><? echo $productname;?></td></tr>
<tr><td><a>Версия Админ-панели:</a></td><td><? echo $adminpanelver;?></td></tr>
<tr><td><a>Адрес сайта:</a></td><td>http://<? echo $_SERVER['HTTP_HOST'];?></td></tr>
<tr><td><a>IP-сайта:</a></td><td><?
$site = $_SERVER['HTTP_HOST'];
$ip = gethostbyname($site); echo("$ip");
?></td></tr>
<tr><td><a>IP-администратора:</a></td><td><? echo $_SERVER['REMOTE_ADDR'];?></td></tr>
<tr><td><a>Дата на сервере:</a></td><td><? echo date('H:i:s d.m.Y');?></td></tr>
<?
$sqlsta = mysql_query("SELECT * FROM statistic ORDER BY id DESC LIMIT 1");
$rowsta = mysql_fetch_array($sqlsta);
$statistic = $rowsta['id'];
?>
<tr><td><a>Сайт просмотрели:</a></td><td><? echo $statistic;?> раз</td></tr>
<tr><td><a>Лицензионный ключ:</a></td><td><? echo $licensekey;?></td></tr>
<tr><td><a>Код активации:</a></td><td><? echo $key;?></td></tr>
<tr><td><a>Подробнее:</a></td><td><a href="phpinfo.php">Информация о системе</a></td></tr>
<tr><td><a>Лицензия:</a></td><td><a href="license.php">Лицензионное соглашение</a></td></tr>
</table>

									
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
								<li><a href="post.php">Товары и услуги</a></li>
									<li><a href="food_offer.php">Продукты</a></li>
									<li><a href="news_offer.php">Новости</a></li>
									<li><a href="event_offer.php">События</a></li>
									<li><a href="cinema_offer.php">Кино</a></li>
									<li><a href="money_offer.php">Деньги</a></li>
									
										
									<!--<li><a href="categories.php">Разделы</a></li>-->
								<!--	<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>-->
									<li><a href="advertisers.php">Рекламодатели</a></li>
								
									<li><a href="foods_distributors.php">Торговые сети</a></li>
									<li><a href="offercategories.php">Категории</a></li>
									<li><a href="cities.php">Города</a></li>
									<li><a href="user.php">Пользователи</a></li>
									<li class="current_page_item"><a href="pref.php">Настройки</a></li>
									<li><a href="exit.php">Выход</a></li>
								</ul>
							</nav>
							<!-- Version -->
							<!--<section class="is-text-style1">
								<div class="inner">
									<p><? include("info.php"); ?>
										<strong>Версия:</strong> <?=$bundle?>
									</p>
								</div>
							</section>-->
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