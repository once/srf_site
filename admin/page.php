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

	</script>
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
										<h2><a>Страницы</a></h2>
									</header>
												<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM pages WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<script type="text/javascript" src="../resource/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../resource/ckfinder/ckfinder.js"></script>
<form action="" method="post"> 


<table cellpadding="10">
  <tr>  <a style="font-size:20px;text-decoration:none;" >Название страницы: </a> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="Name" value="<?=htmlspecialchars(stripslashes($row['Name']));?>"  class="enter" size="50"> <br><br></tr>
  <tr> <textarea name="body" class="ckeditor" cols="80" id="editor2" rows="10"> 
               
                <?=stripslashes($row['body']);?> 
      </textarea> <br></tr></table>
 <table><tr><td> <a style="font-size:20px;text-decoration:none;" >Ключевые слова:</a></td><td>     <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="metakeywords" class="enter" size="75" value="<?=htmlspecialchars(stripslashes($row['metakeywords']));?>"></td></tr> <tr></tr>
     <tr><td><a style="font-size:20px;text-decoration:none;" >Описание:</a></td> 
      <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="metadescription" class="enter" size="75" value="<?=htmlspecialchars(stripslashes($row['metadescription']));?>"> </td></tr><tr></tr>
       <tr><td><a style="font-size:20px;text-decoration:none;" >Разрешить комментирование:</a> </td><td><input type="checkbox" name="comments" value="1" <? if($row['comments'] == "1"){ 
	echo("checked");
} ?>></td></tr><tr></tr>
      <tr><td><a style="font-size:20px;text-decoration:none;" >Показывать в меню:</a> </td><td><input type="checkbox" name="disp" value="1" <? if($row['disp'] == "1"){ 
	echo("checked");
} ?>></td></tr><tr></tr>
      <tr><td><a style="font-size:20px;text-decoration:none;" >Позиция в меню:</td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="ord" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['ord']));?>"> (Введите цифрами) </td></tr>
      </table>
	<script type="text/javascript">

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
	document.write(
		'<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
		'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
		'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
		'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
		'value (line 32).' ) ;
}
else
{
	var editor = CKEDITOR.replace( 'editor2' );
	

	// Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
	// The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
	CKFinder.setupCKEditor( editor, '../resource/ckfinder/' ) ;

	// It is also possible to pass an object with selected CKFinder properties as a second argument.
	// CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
}

		</script>
<br>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <input class="submit" type="submit" value="Сохранить" name="edit"> 
  
</form> </body>
<? 
}  
function complete(){ 
       
      require '../config.php'; 

      
      $result = mysql_query("SELECT * FROM pages WHERE id = '".$_POST['id']."';", $db); 

       
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO pages 
                     (Name, 
                      body, 
                      metakeywords,                      
                      metadescription,
                      disp,
                      ord,
                      comments
                      ) 
                                      VALUES 
                            ('".mysql_real_escape_string($_POST['Name'])."',
                             '".mysql_real_escape_string($_POST['body'])."',
                             '".mysql_real_escape_string($_POST['metakeywords'])."',
                             '".mysql_real_escape_string($_POST['metadescription'])."',
                              '".mysql_real_escape_string($_POST['disp'])."',
                              '".mysql_real_escape_string($_POST['ord'])."',
                              '".mysql_real_escape_string($_POST['comments'])."')"; 
    
      else 
            $query = "UPDATE pages SET 
                                     Name = '".mysql_real_escape_string($_POST['Name'])."',
                                     body = '".mysql_real_escape_string($_POST['body'])."', 
                                     metakeywords = '".mysql_real_escape_string($_POST['metakeywords'])."', 
                                     metadescription = '".mysql_real_escape_string($_POST['metadescription'])."',
                                     disp = '".mysql_real_escape_string($_POST['disp'])."',
                                     ord = '".mysql_real_escape_string($_POST['ord'])."',
                                     comments = '".mysql_real_escape_string($_POST['comments'])."'  
                     WHERE id = '".$_POST['id']."';"; 

      mysql_query($query, $db); 

      echo "<meta http-equiv='Refresh' content='0; URL=page.php'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить страницу?")) 
     { 
                 parent.location='?del='+N; 
     } 
     else 
     { 
       return false; 
     } 
} 
--> 
</SCRIPT> 
<? 
        require '../config.php'; 
        echo ' 
 <a href="?id=new"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Новая страница" ></h3></a> '; 
        echo ' 
<table cellspacing="10" cellpadding="3" > 
<tr> 
  <td> 
   Название страницы
  </td> 
  <td>
  Ссылка на страницу
  </td>
  <td>
  Позиция в меню
  </td>
  <td>
  Удалить
  </td>
</tr>'; 
        $result = mysql_query("SELECT * FROM pages ORDER BY ord ASC;", $db); 
        while($row = mysql_fetch_array($result)){ 
               echo ' 
<tr> 
  <td> 
     <a href="?id='.$row['id'].'">'.stripslashes($row['Name']).'</a> 

  <td>
  <a href="http://'.$_SERVER['SERVER_NAME'].'/page.php?id='.$row['id'].'">http://'.$_SERVER['SERVER_NAME'].'/page.php?id='.$row['id'].'</a>
  </td>
  <td>
  '.$row['ord'].'
  </td>
  <td> 
     <a href="#" OnClick="Delete('.$row['id'].')">Удалить</a> 
  </td> 
</tr>'; 
        } 
        echo ' 
</table>'; 

} 
function delete_pages(){ 
        require '../config.php'; 
        $query = "DELETE FROM pages WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Страница удалена</h3>'; 
} 
if($_GET['del']) delete_pages(); 
if($_POST['edit']) complete();
if($_GET['id']) show_form(); 
else show_pages();
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
									<li class="current_page_item"><a href="page.php">Страницы</a></li>
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