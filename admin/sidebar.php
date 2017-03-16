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
        $result = mysql_query("SELECT * FROM themes WHERE active=1", $db); 
        $row = mysql_fetch_array($result); 
        include "../themes/$row[dir]/info.php";
?> 
									<header>
										<h2><a>Сайдбар</a></h2>
									</header>
										<? 
function show_form(){ 
        require '../config.php'; 

        $result = mysql_query("SELECT * FROM sidebar WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<style>
textarea {
  resize: none;
}

</style>
<form action="" method="post"> 

 <table cellspacing="10">
    <tr><td><a style="font-size:20px;text-decoration:none;" >Название виджета: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="Name" value="<?=htmlspecialchars(stripslashes($row['Name']));?>"  class="enter" size="25"> </td></tr>
 
     
 <tr><td colspan="2"> <a style="font-size:20px;text-decoration:none;" >Полное содержание:</a></td></tr><tr><td colspan="2">      <textarea style="padding:5px; background-color:#e6e6e6;font-size:12px;" rows="10" cols="110" name="body"  ><?=stripslashes($row['body']);?></textarea> </td></tr>
      <tr><td><a style="font-size:20px;text-decoration:none;" >Позиция:</td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="ord" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['ord']));?>"> (Введите цифрами) </td></tr>
      </table>

<br>
      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <input class="submit" type="submit" value="Отправить" name="edit"> 
  
</form> </body>
<? 
}
function complete(){ 
     
      require '../config.php'; 

      $result = mysql_query("SELECT * FROM sidebar WHERE id = '".$_POST['id']."';", $db); 

     
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO sidebar 
                     (Name, 
                      body, 
                      
                      ord
                      ) 
                                      VALUES 
                            ('".mysql_real_escape_string($_POST['Name'])."',
                             '".mysql_real_escape_string($_POST['body'])."',
                            
                              '".mysql_real_escape_string($_POST['ord'])."')"; 
      else 
            $query = "UPDATE sidebar SET 
                                     Name = '".mysql_real_escape_string($_POST['Name'])."',
                                     body = '".mysql_real_escape_string($_POST['body'])."', 
                                     
                                     ord = '".mysql_real_escape_string($_POST['ord'])."'  
                     WHERE id = '".$_POST['id']."';"; 

      mysql_query($query, $db); 

      echo "<meta http-equiv='Refresh' content='0; URL=sidebar.php'>"; 
} 
function show_pages() { 

?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить виджет?")) 
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
 <a href="?id=new"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Новый виджет" ></h3></a><br> '; 
        echo ' 
<table cellspacing="10" cellpadding="3" > 
<tr> 
  <td> 
   Название виджета
  </td> 
  
  <td>
  Позиция в сайдбаре
  </td>
  <td>
  Удалить
  </td>
</tr>'; 
        $result = mysql_query("SELECT * FROM sidebar ORDER BY Name ASC;", $db); 
        while($row = mysql_fetch_array($result)){ 
               echo ' 
<tr> 
  <td> 
     <a href="?id='.$row['id'].'">'.stripslashes($row['Name']).'</a> 
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
        $query = "DELETE FROM sidebar WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Виджет удален</h3>'; 
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
									<li><a href="page.php">Страницы</a></li>
									<li class="current_page_item"><a href="sidebar.php">Сайдбар</a></li>
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