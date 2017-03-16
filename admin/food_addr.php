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
										<h2><a>Торговые сети / Адреса</a></h2>
										
									</header>
									<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM food_distributor_addresses WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<form action="" method="post"> 

<table cellpadding="10">
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Торговая сеть: </a></td>
   
   <td> 
    <? 


 $result2 = mysql_query("SELECT a.name, c.name as city_name FROM foods_distributors a LEFT JOIN cities c ON c.id = a.city_id WHERE a.id = ".$_GET['advid']." LIMIT 1", $db); 
 $row2 = mysql_fetch_array($result2); 

?>
   <?echo $row2["name"] . " (".$row2["city_name"] .")";?>
   </td></tr>
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Адрес: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="address" value="<?=htmlspecialchars(stripslashes($row['address']));?>"  class="enter" size="50" required></td></tr>
   <tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Часы работы: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="workhours" value="<?=htmlspecialchars(stripslashes($row['workhours']));?>"  class="enter" size="50"></td></tr>
  
   <tr><td><a style="font-size:20px;text-decoration:none;" >Скрыть:</a> </td><td><input type="checkbox" name="draft" value="1" <? if($row['draft'] == "1"){ 
	echo("checked");
} ?>></td></tr><tr></tr>
  
      </table>
		


      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
	  <input type="hidden" name="advertiser_id" value="<?=$_GET['advid'];?>"> 
	  <input type="hidden" name="city_id_get" value="<?=$_GET['city'];?>"> 
      <input class="submit" type="submit" value="Сохранить" name="edit"> 
  
</form> </body>
<? 
} 
function complete(){ 
    
      require '../config.php'; 

     
      $result = mysql_query("SELECT * FROM food_distributor_addresses WHERE id = '".$_POST['id']."';", $db); 

     
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO food_distributor_addresses 
                     (
					 distributor_id,
					 address,
					 workhours,
					 draft
					 
                      ) 
                                      VALUES 
                            ('".mysql_real_escape_string($_POST['advertiser_id'])."', 
							'".mysql_real_escape_string($_POST['address'])."',
							'".mysql_real_escape_string($_POST['workhours'])."',
						  '".mysql_real_escape_string($_POST['draft'])."'
							
                    
                             )"; 
      else 
            $query = "UPDATE  food_distributor_addresses SET 
                                    distributor_id = '".mysql_real_escape_string($_POST['advertiser_id'])."', 
									 address = '".mysql_real_escape_string($_POST['address'])."', 
									 workhours = '".mysql_real_escape_string($_POST['workhours'])."',
									
									 draft = '".mysql_real_escape_string($_POST['draft'])."'
									
                                     
                     WHERE id = '".$_POST['id']."';"; 

      mysql_query($query, $db); 

      echo "<meta http-equiv='Refresh' content='0; URL=foods_distributors.php?id=".$_POST['advertiser_id']."&city=".$_POST['city_id_get']."'>"; 
	  
} 


     


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
						<center><a class="modifiable-link"  href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<!-- Nav -->
							<nav id="nav">
								<ul>
								<li><a class="modifiable-link"  href="post.php">Товары и услуги</a></li>
									<li><a class="modifiable-link"  href="food_offer.php">Продукты</a></li>
									<!--<li><a class="modifiable-link" href="alco_offer.php">Алкоголь</a></li>-->
									<li><a class="modifiable-link"  href="news_offer.php">Новости</a></li>
									<li><a class="modifiable-link"  href="event_offer.php">События</a></li>
									<li><a class="modifiable-link"  href="cinema_offer.php">Кино</a></li>
									<li><a class="modifiable-link"  href="money_offer.php">Деньги</a></li>
									

									
									<!--<li><a href="categories.php">Разделы</a></li>-->
									<!--<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>-->
									<li><a class="modifiable-link"  href="advertisers.php">Рекламодатели</a></li>
									
									<li  class="current_page_item"><a class="modifiable-link"  href="foods_distributors.php">Торговые сети</a></li>
									<li ><a class="modifiable-link"  href="offercategories.php">Категории</a></li>
									<li><a  class="modifiable-link" href="cities.php">Города</a></li>
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