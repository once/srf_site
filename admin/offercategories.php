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
										<h2><a>Категории</a></h2>
										
									</header>
									<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM offercategories WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">
<form action="" method="post"> 

<table cellpadding="10">
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Название категории: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="name" value="<?=htmlspecialchars(stripslashes($row['name']));?>"  class="enter" size="50" required></td></tr>
   <tr><td><a style="font-size:20px;text-decoration:none;" >Раздел:</a> </td><td>
<select name="cat_id">
<? $sqlc = mysql_query("SELECT * FROM categories ORDER BY ord ASC");
while($rowc = mysql_fetch_array($sqlc)){
	
	if ($row['section_id'] == $rowc['id']) {
		echo "<option selected=\"selected\" value=$rowc[id]>$rowc[name]</option>";
	}
	else {
		echo "<option value=$rowc[id]>$rowc[name]</option>";
	}
}
?>
</select>
</td></tr>
   <tr><td><a style="font-size:20px;text-decoration:none;" >Родительская категория:</a> </td><td>
   
<select name="parent_id">
<?if (($row['parent_id'] == '') ||($row['parent_id'] == 0)){
		echo "<option selected=\"selected\" value=0>(не определена)</option>";
	}
	else {
		echo "<option value=0>(не определена)</option>";
	}
?>
<? $sqlc = mysql_query("SELECT * FROM offercategories WHERE deleted=0 AND section_id= ".$row['section_id']." AND id <> " . $row['id']. " ORDER BY name ASC");

while($rowc = mysql_fetch_array($sqlc)){
	
	if ($row['parent_id'] == $rowc['id']) {
		echo "<option selected=\"selected\" value=$rowc[id]>$rowc[name]</option>";
	}
	else {
		echo "<option value=$rowc[id]>$rowc[name]</option>";
	}
}
?>
</select>
</td></tr>
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Иконка: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" disabled="disabled" name="icon" value="<?=htmlspecialchars(stripslashes($row['icon']));?>"  class="enter" size="50"></td></tr>
  <tr><td><a style="font-size:20px;text-decoration:none;" >Порядок отображения:</td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="disp_order" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['disp_order']));?>"> (Введите цифрами) </td></tr>

   <tr><td><a style="font-size:20px;text-decoration:none;" >Скрыть:</a> </td><td><input type="checkbox" name="draft" value="1" <? if($row['draft'] == "1"){ 
	echo("checked");
} ?>></td></tr><tr></tr>
  
      </table>
		


      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
	  <input type="hidden" name="city_id_get" value="<?=$_GET['city'];?>"> 
      <input class="submit" type="submit" value="Сохранить" name="edit"> 
  
</form> </body>
<? 
} 
function complete(){ 
    
      require '../config.php'; 

     
      $result = mysql_query("SELECT * FROM offercategories WHERE id = '".$_POST['id']."';", $db); 

     
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO offercategories 
                     (name,
					 section_id,
					 parent_id,
                      disp_order,
                      draft
                      ) 
                                      VALUES 
                            ('".trim(mysql_real_escape_string($_POST['name']))."', 
							'".mysql_real_escape_string($_POST['cat_id'])."', 
							'".mysql_real_escape_string($_POST['parent_id'])."', 
                             '".mysql_real_escape_string($_POST['disp_order'])."', 
                             '".mysql_real_escape_string($_POST['draft'])."'
                             )"; 
      else 
            $query = "UPDATE offercategories SET 
                                     name = '".trim(mysql_real_escape_string($_POST['name']))."', 
									 section_id = '".mysql_real_escape_string($_POST['cat_id'])."', 
									 parent_id = '".mysql_real_escape_string($_POST['parent_id'])."', 
                                     disp_order = '".mysql_real_escape_string($_POST['disp_order'])."', 
                                     draft = '".mysql_real_escape_string($_POST['draft'])."'
                     WHERE id = '".$_POST['id']."';"; 

      mysql_query($query, $db); 

      
	  echo "<meta http-equiv='Refresh' content='0; URL=offercategories.php?city=".$_POST['city_id_get']."'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить категорию?")) 
     { 
                 
				 parent.location='?del='+N + "&city=" + getParameterByName('city');
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
 <a  class="modifiable-link" href="?id=new"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Добавить категорию" ></h3></a><br> '; 
        echo ' 
<table border="1px solid black" cellspacing="10" cellpadding="3" > 
<tr class="table-head"> 
  <td> 
   ID
  </td>
  <td> 
   Название категории
  </td>
  <td>Родительская категория</td>
  <td>
  Раздел
  </td>  
<td>
  Порядок
  </td>  
  <td>
  Активна
  </td>
  
  <td>
  Удалить
  </td>
</tr>'; 
        $result = mysql_query("SELECT oc.id,oc.section_id,oc.parent_id,oc.name,oc.disp_order,oc.draft, oc1.name as parent_name, c.name as section_name FROM offercategories oc LEFT JOIN offercategories oc1 ON oc.parent_id = oc1.id LEFT JOIN categories c ON c.id=oc.section_id WHERE oc.deleted=0 ORDER BY oc.section_id, oc.disp_order ASC;", $db); 
        
		while($row = mysql_fetch_array($result)){ 
        if ($row['draft'] == 0){$status = "Да";}
        if ($row['draft'] == 1){$status = "Нет";}
               echo ' 
<tr> 
  <td>'. $row['id'].'</td>
  <td> 
     <a  class="modifiable-link" href="?id='.$row['id'].'">'.stripslashes($row['name']).'</a> 
  </td> 
  <td> 
     '.$row['parent_id'].'_'.stripslashes($row['parent_name']).'
  </td> 
  <td>'.stripslashes($row['section_id']).'_'.stripslashes($row['section_name']).'</td>
  <td>'.stripslashes($row['disp_order']).'</td>
  <td>'.$status.'</td>
  
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
        $query = "UPDATE offercategories SET deleted='1' WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Категория удалена</h3>'; 
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
						<center><a  class="modifiable-link" href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a  class="modifiable-link" href="post.php">Товары и услуги</a></li>
									<li><a  class="modifiable-link" href="food_offer.php">Продукты</a></li>
									<!--<li><a class="modifiable-link" href="alco_offer.php">Алкоголь</a></li>-->
									<li><a  class="modifiable-link" href="news_offer.php">Новости</a></li>
									<li><a class="modifiable-link"  href="event_offer.php">События</a></li>
									<li><a  class="modifiable-link" href="cinema_offer.php">Кино</a></li>
									<li><a  class="modifiable-link" href="money_offer.php">Деньги</a></li>
									
									
									
									<!--<li><a href="categories.php">Разделы</a></li>-->
									<!--<li><a href="page.php">Страницы</a></li>
									<li><a href="sidebar.php">Сайдбар</a></li>
									<li><a href="theme.php">Темы</a></li>
									<li><a href="link.php">Ссылки</a></li>
									<li><a href="comment.php">Комментарии</a></li>-->
									<li><a  class="modifiable-link" href="advertisers.php">Рекламодатели</a></li>
									
									<li><a  class="modifiable-link" href="foods_distributors.php">Торговые сети</a></li>
									<li class="current_page_item"><a  class="modifiable-link" href="offercategories.php">Категории</a></li>
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