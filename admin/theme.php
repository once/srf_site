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
										<h2><a>Темы</a></h2>
									</header>
									<?
									if($_GET['status']==1)echo("<h3>Тема $_GET[name] успешно установлена</h3>");?>
									<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM themes WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
        include "../themes/$row[dir]/info.php";
?> 
<body role="application">
<form action="" method="post" name="form1"> 
<table cellpadding="10">
<img width="256" src="../themes/<?=$row['dir']?>/<?=$template_preview?>">
<tr><td><a style="font-size:20px;text-decoration:none;" >Название темы: </a></td><td> <?=$template_name?></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Версия: </a></td><td><?=$template_version?></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Разработчик: </a></td><td><?=$template_developer?></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Лицензия: </a></td><td><?=$template_license?></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Кодовое имя: </a></td><td><?=$template_codename?></td></tr>
</table>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <a href="theme.php"><input class="submit" type="submit" value="Назад" name="back"></a>

      <input class="submit" type="submit" value="Активировать" name="edit"> 

</form> 


</body>
<? 
} 
function complete(){ 
     
      require '../config.php'; 
      $result = mysql_query("SELECT * FROM themes WHERE id = '".$_POST['id']."';", $db); 
      $row = mysql_fetch_array($result); 
      $query1 = "UPDATE themes SET 
                                     
                                     active = '0'  
                     WHERE active = 1";
      if(empty($row['id'])) 
            $query = "INSERT INTO themes 
                     (active                      ) 
                                      VALUES 
                            (                              '1')"; 
      else 
            $query = "UPDATE themes SET 
                                     
                                     active = '1'  
                     WHERE id = '".$_POST['id']."';"; 
      mysql_query($query1, $db); 
      mysql_query($query, $db); 
      
      echo "<meta http-equiv='Refresh' content='0; URL=theme.php'>"; 
} 
function active(){ 
     
      require '../config.php'; 
      $result = mysql_query("SELECT * FROM themes WHERE id = '".$_GET['active']."';", $db); 
      $row = mysql_fetch_array($result); 
      include "../themes/$row[dir]/info.php";
      $query1 = "UPDATE themes SET 
                                     
                                     active = '0'  
                     WHERE active = 1";
      if(empty($row['id'])) 
            $query = "INSERT INTO themes 
                     (active, dir                      ) 
                                      VALUES 
                            (                              '1', '$template_dir')"; 
      else 
            $query = "UPDATE themes SET 
                                     dir = '$template_dir',
                                     active = '1'  
                     WHERE id = '".$_GET['active']."';"; 
      mysql_query($query1, $db); 
      mysql_query($query, $db); 
      
      echo "<meta http-equiv='Refresh' content='0; URL=theme.php'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить тему?")) 
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
     $sql = mysql_query("SELECT * FROM themes");
     $count = mysql_num_rows($sql); 
    
         $result = mysql_query("SELECT * FROM themes WHERE active=1", $db); 
        $row = mysql_fetch_array($result);
include"../themes/$row[dir]/info.php";
        echo ' 
        <a href="themeinstall.php"><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Установить" ></a><a href="http://store.loutskiy.ru/themes"><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" hidden type="submit" value="Загрузить из магазина" ></a><br>'; 
        echo ' 
<br><table cellspacing="10" cellpadding="2" > 
<tr> 
 
  <td valign="middle">
  <b>Название темы
  </td>
  <td valign="middle">
  <b>Состояние
  </td>
  <td valign="middle">
 <b> Действия
  </td>
  
</tr>'; 
        $result = mysql_query("SELECT * FROM themes", $db); 
        while($row = mysql_fetch_array($result)){ 
        if($row['active']==1){$status="<b style=color:green;>Активна</b>";}
         if($count != 1){ $delete = "Delete('$row[id]')"; $delete2 = "href='#'";}
        	include "../themes/$row[dir]/info.php";
               echo ' 
			<tr  valign="middle"> 

	
						  <td valign="middle"> <br>
			   '.$template_name.'
			</td>
			<td  valign="middle">
			<br> '.$status.'
			</td>
			    <td  valign="top">
			  <a href="?active='.$row['id'].'">Активировать</a> <br> <a href="?id='.$row['id'].'">Параметры</a> <br>  <a '.$delete2.' OnClick="'.$delete.'">Удалить</a>
			  </td>
			</tr>';         } 
        echo ' 
</table>'; 

} 
function delete_pages(){ 
        require '../config.php'; 
        $query = "DELETE FROM themes WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Тема удалена</h3>'; 
} 
if($_GET['del']) delete_pages(); 
if($_POST['edit']) complete();
if($_POST['back']) echo"<meta http-equiv='refresh' content='0; url=theme.php'>";
if($_GET['active']) active();
if($_GET['id']) show_form();
else show_pages();
?> 			</article>
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