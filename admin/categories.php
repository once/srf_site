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
										<h2><a>Разделы</a></h2>
										
									</header>
									<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM categories WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<form action="" method="post"> 

<table cellpadding="10">
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Название раздела: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="name" value="<?=htmlspecialchars(stripslashes($row['name']));?>"  class="enter" size="50"></td></tr>
      <tr><td><a style="font-size:20px;text-decoration:none;" >Показывать в меню:</a> </td><td><input type="checkbox" name="disp" value="1" <? if($row['disp'] == "1"){ 
	echo("checked");
} ?>></td></tr><tr></tr>
  <tr><td><a style="font-size:20px;text-decoration:none;" >Позиция в меню:</td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="ord" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['ord']));?>"> (Введите цифрами) </td></tr>
      </table>
		


      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <input class="submit" type="submit" value="Сохранить" name="edit"> 
  
</form> </body>
<? 
} 
function complete(){ 
    
      require '../config.php'; 

     
      $result = mysql_query("SELECT * FROM categories WHERE id = '".$_POST['id']."';", $db); 

     
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO categories 
                     (name,
                      disp,
                      ord
                      ) 
                                      VALUES 
                            ('".mysql_real_escape_string($_POST['name'])."', 
                             '".mysql_real_escape_string($_POST['disp'])."', 
                             '".mysql_real_escape_string($_POST['ord'])."'
                             )"; 
      else 
            $query = "UPDATE categories SET 
                                     name = '".mysql_real_escape_string($_POST['name'])."', 
                                     disp = '".mysql_real_escape_string($_POST['disp'])."', 
                                     ord = '".mysql_real_escape_string($_POST['ord'])."'
                     WHERE id = '".$_POST['id']."';"; 

      mysql_query($query, $db); 

      echo "<meta http-equiv='Refresh' content='0; URL=categories.php'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить раздел?")) 
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
 <a href="?id=new"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Новый раздел" ></h3></a><br> '; 
        echo ' 
<table border="1px solid black" cellspacing="10" cellpadding="3" > 
<tr> 
  <td> 
   Название раздела
  </td> 
  <td>
  Показ в меню
  </td>
  <td>
  Ссылка на раздел
  </td>
  <td>
  Удалить
  </td>
</tr>'; 
        $result = mysql_query("SELECT * FROM categories ORDER BY id DESC;", $db); 
        while($row = mysql_fetch_array($result)){ 
        if ($row['disp'] == 0){$status = "Не показывать";}
        if ($row['disp'] == 1){$status = "Показывать";}
               echo ' 
<tr> 
  <td> 
     <a href="?id='.$row['id'].'">'.stripslashes($row['name']).'</a> 
  </td> 
  <td>'.$status.'</td>
  <td>
  <a href="http://'.$_SERVER['SERVER_NAME'].'/categories.php?id='.$row['id'].'">http://'.$_SERVER['SERVER_NAME'].'/categories.php?id='.$row['id'].'</a>
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
        $query = "UPDATE categories SET deleted='1' WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Раздел удален</h3>'; 
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
									<li><a href="post.php">Предложения</a></li>
										
									<li class="current_page_item"><a href="categories.php">Разделы</a></li>
									<!--<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>-->
									<li><a href="advertisers.php">Рекламодатели</a></li>
									
									<li><a href="foods_distributors.php">Торговые сети</a></li>
									<li><a href="offercategories.php">Категории</a></li>
									<li><a href="cities.php">Города</a></li>
									<li><a href="user.php">Пользователи</a></li>
									<li><a href="pref.php">Настройки</a></li>
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
	<script language='JavaScript1.1' type='text/javascript'>
	function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}


	var city_selected = getParameterByName('city');

if ((typeof(city_selected) != "undefined") && (city_selected > 0)) {
	$('.city-selector').val(city_selected);	
	
	var par_prefix ="";
	$("a.modifiable-link").each(function() {
		if (this.href.indexOf("?") == -1) {
			par_prefix = "?";
			
		}
		else {
			par_prefix = "&";
		}
		this.href=this.href + par_prefix+"city=" + city_selected;
	});
}
</script>
</html>