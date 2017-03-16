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
										<h2><a>Рекламодатели</a></h2>
										
									</header>
									<? 
function show_form(){ 
        require '../config.php'; 
        $result = mysql_query("SELECT * FROM advertisers WHERE id = '".$_GET['id']."';", $db); 
        $row = mysql_fetch_array($result); 
?> 
<script type="text/javascript">
function DeleteAddr(advid, N) 
{ 
     if(confirm("Удалить адрес?")) 
     { 
                 parent.location='?id='+advid+'&deladdr='+N; 
     } 
     else 
     { 
       return false; 
     } 
} 
</script>
<body role="application">
<form action="" method="post"> 

<table cellpadding="10">
<tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Название (отображаемое): </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="name" value="<?=htmlspecialchars(stripslashes($row['name']));?>"  class="enter" size="50" required></td></tr>
   <tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Название (системное): </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="system_name" value="<?=htmlspecialchars(stripslashes($row['system_name']));?>"  class="enter" size="50"></td></tr>
   <tr><td><a style="font-size:20px;text-decoration:none;" >Город:</a> </td><td>
<select name="city_id">
<? $sqlc = mysql_query("SELECT * FROM cities WHERE deleted=0 ORDER BY name ASC");
while($rowc = mysql_fetch_array($sqlc)){
	
	if ($row['city_id'] == $rowc['id']) {
		echo "<option selected=\"selected\" value=$rowc[id]>$rowc[name]</option>";
	}
	elseif (($_GET['id'] == "new") && ($_GET['city'] == $rowc['id'])) {
		
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
   <td> <a style="font-size:20px;text-decoration:none;" >E-mail: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="email" name="email" value="<?=htmlspecialchars(stripslashes($row['email']));?>"  class="enter" size="50"></td></tr>
   <tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Ссылка 1: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="weblink1" value="<?=htmlspecialchars(stripslashes($row['weblink1']));?>"  class="enter" size="50"></td></tr>
   <tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Ссылка 2: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="weblink2" value="<?=htmlspecialchars(stripslashes($row['weblink2']));?>"  class="enter" size="50"></td></tr>
   <tr>
   <td> <a style="font-size:20px;text-decoration:none;" >Где рекламируется: </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="advertising_channel" value="<?=htmlspecialchars(stripslashes($row['advertising_channel']));?>"  class="enter" size="50"> ( Директ / AdWords / 2GIS / и т.д...)</td></tr>
  <tr><td><a style="font-size:20px;text-decoration:none;" >Скрыть:</a> </td><td><input type="checkbox" name="draft" value="1" <? if($row['draft'] == "1"){ 
	echo("checked");
} ?>></td></tr>
<tr><td><a style="font-size:20px;text-decoration:none;" >Кем создано:</a> </td><td><? echo $row['author'];?></td></tr>
 <tr><td><a style="font-size:20px;text-decoration:none;" >Кем изменено:</a> </td><td><? echo $row['modifiedby'];?></td></tr>
 <tr></tr>
 <tr><td style="vertical-align:middle;"><a style="font-size:20px;text-decoration:none;" >Комментарий:</a></td> 
      <td><hr/> <textarea rows="6" cols="70" style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="comment" ><?=htmlspecialchars(stripslashes($row['comment']));?></textarea> </td></tr>
  
  
      </table>
		


      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
	  <input type="hidden" name="city_id_get" value="<?=$_GET['city'];?>"> 
      <input class="submit" type="submit" value="Сохранить" name="edit"> 
  
</form> 

<hr>
<h3>Адреса рекламодателя</h3>
<br>
<p>Можно добавить несколько адресов (+отдельный телефон для каждого адреса). Также возможно добавление телефона без адреса.</p>
<br>
<?
if ($_GET['id'] != "new") {
	
echo ' 
 <a  class="modifiable-link"  href="adv_addr.php?id=new&advid='.$_GET['id'].'"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Добавить адрес" ></h3></a><br> '; 
        echo ' 
<table border="1px solid black" cellspacing="10" cellpadding="3" > 
<tr class="table-head"> 
   
  <td> 
   Адрес
  </td>
  <td> 
   Телефон
  </td>
  
  <td> 
 Статус
  </td>
  <td> 
   Порядок сортировки
  </td>
  
  <td>
  Удалить
  </td>
</tr>'; 

 require '../config.php'; 
        $result = mysql_query("SELECT ba.id as addr_id, ba.address AS address, ba.phone as phone, ba.disp_order as disp_order, ba.draft AS draft, ba.deleted AS deleted FROM blog_addresses ba WHERE ba.advertiser_id=".  $_GET['id'] . "  AND ba.deleted=0 ORDER BY disp_order ASC;"); 
        
		while($row = mysql_fetch_array($result)){ 
        
		if ($row['draft'] == 0){$status = "Активно";  $status_style_class = "status-active";}
        if ($row['draft'] == 1){$status = "Скрыто"; $status_style_class = "status-hidden";}
		
		$address = empty($row['address']) ? "(без адреса)" : $row["address"];
        
               echo ' 
<tr> 
 
  <td> 
     <a class="modifiable-link"  href="adv_addr.php?id='.$row['addr_id'].'&advid='.$_GET['id'].'">'.stripslashes($address).'</a> 
  </td> 
   <td> 
     '.stripslashes($row['phone']).' 
  </td> 
   <td class="'.$status_style_class.'"> 
     '.$status.' 
  </td> 
  <td> 
     '.stripslashes($row['disp_order']).' 
  </td>
  <td> 
     <a href="#" OnClick="DeleteAddr('.$_GET['id'].','.$row['addr_id'].')">Удалить</a> 
  </td> 
</tr>'; 

        } 
        echo ' 
</table>'; 

}
else {
	
	echo 'Будут доступны для добавления после сохранения рекламодателя.';
}




?>

</body>
<? 
} 
function complete(){ 
    
	$weblink1_corr = '';
	$weblink2_corr = '';
	
	// Check if links contain http or https. They SHOULD conatin it
	if (strlen($_POST['weblink1']) > 0) {
	
		if ((strpos($_POST['weblink1'],'http://') !== false) || (strpos($_POST['weblink1'],'https://') !== false)) {
		 
		$weblink1_corr = $_POST['weblink1'];
	 }
	 else {
	 
		 $weblink1_corr = 'http://' . $_POST['weblink1'];
	 }
		
	}
	
	 
	if (strlen($_POST['weblink2']) > 0) {
		if ((strpos($_POST['weblink2'],'http://') !== false) || (strpos($_POST['weblink2'],'https://') !== false)) {
			 
			$weblink2_corr = $_POST['weblink2'];
		 }
		 else {
			 
			 $weblink2_corr = 'http://' . $_POST['weblink2'];
		 }
	}
	 /////////////////////////////
	 
	 
	 if  (($_POST['system_name'] == '0') || (strlen ($_POST['system_name']) == 0)) {
		 
			$system_name_corr = $_POST['name'];
	 }
	 else {
			$system_name_corr = $_POST['system_name'];
	 }
	 
	 
	 
      require '../config.php'; 

     
      $result = mysql_query("SELECT * FROM advertisers WHERE id = '".$_POST['id']."';", $db); 

     
      $row = mysql_fetch_array($result); 

      if(empty($row['id'])) 
            $query = "INSERT INTO advertisers 
                     (name,
					 system_name,
					 city_id,
					 email,
					 weblink1,
					 weblink2,
					 advertising_channel,
					 author,
					 created,
					 draft,
					 comment
					
                      ) 
                                      VALUES 
                            ('".trim(mysql_real_escape_string($_POST['name']))."', 
							'".trim(mysql_real_escape_string($system_name_corr))."',
							'".mysql_real_escape_string($_POST['city_id'])."',
							'".mysql_real_escape_string($_POST['email'])."',
							'".mysql_real_escape_string($weblink1_corr)."',
							'".mysql_real_escape_string($weblink2_corr)."',
							'".mysql_real_escape_string($_POST['advertising_channel'])."',
							'".mysql_real_escape_string($_SESSION['loginadmin'])."',
							NOW(),
							'".mysql_real_escape_string($_POST['draft'])."',
							'".mysql_real_escape_string($_POST['comment'])."'
                    
                             )"; 
      else 
            $query = "UPDATE advertisers SET 
                                     name = '".trim(mysql_real_escape_string($_POST['name']))."', 
									 system_name = '".trim(mysql_real_escape_string($system_name_corr))."', 
									 city_id = '".mysql_real_escape_string($_POST['city_id'])."',
									 email = '".mysql_real_escape_string($_POST['email'])."',
									 weblink1 = '".mysql_real_escape_string($weblink1_corr)."',
									 weblink2 = '".mysql_real_escape_string($weblink2_corr)."',
									 advertising_channel = '".mysql_real_escape_string($_POST['advertising_channel'])."',
									 modifiedby = '".mysql_real_escape_string($_SESSION['loginadmin'])."',
									 modified  = NOW(),
									 draft = '".mysql_real_escape_string($_POST['draft'])."',
									 comment = '".mysql_real_escape_string($_POST['comment'])."'
									
                                     
                     WHERE id = '".$_POST['id']."';"; 
//echo($query);
      mysql_query($query, $db); 

     
	 echo "<meta http-equiv='Refresh' content='0; URL=advertisers.php?city=".$_POST['city_id_get']."'>"; 
} 
function show_pages() { 
?> 
<script language='JavaScript1.1' type='text/javascript'> 
<!-- 
function Delete(N) 
{ 
     if(confirm("Удалить рекламодателя?")) 
     { 
                 
				 parent.location='?del='+N + '&scroll=' + window.scrollY + "&city=" + getParameterByName('city');
     } 
     else 
     { 
       return false; 
     } 
} 
--> 
</SCRIPT> 
<? 
        require '../config.php'; ?>
		 <a class="modifiable-link" href="?id=new"><h3><input style="border-radius: 0.4em;border: solid 1px #ddd;padding: 0.5em;" type="submit" value="Добавить рекламодателя" ></h3></a><br>
		<div class="city-selector-container">
		<p><b>Город:</b> <select class="city-selector" name="advertiser_id">
		<option value="0">Все города</option>
<?

$sqlc = mysql_query("SELECT id, name FROM cities WHERE deleted=0 ORDER BY name ASC");
while($rowc = mysql_fetch_array($sqlc)){
	
		echo "<option value=$rowc[id]>$rowc[name]</option>";
	
	
}
?>
</select> </p>

</div>

		<?
        
        echo ' 
<table border="1px solid black" cellspacing="10" cellpadding="3" > 
<tr class="table-head"> 
<td style="width:50px;">ID</td>
  <td> 
   Название
  </td>
  <td> 
   Отображаемое название
  </td>
  <td> 
  Город
  </td>
  <td> 
 Статус
  </td>
  <td>Кем создано</td>
  <td>Создано  </td>
  <td>Кем изменено</td>
   <td>Изменено</td>
  <td>
  Удалить
  </td>
</tr>'; 

if (($_GET['city']) && ($_GET['city'] > 0)) {
			
				$cityfilter = "AND a.city_id=".$_GET['city'];
		}
		else {
				$cityfilter ="";
		}
		
		
        $result = mysql_query("SELECT a.id AS adv_id, a.name AS adv_name, a.system_name as adv_sys_name, a.draft, a.created, a.modified, a.author, a.modifiedby, c.name AS  city_name FROM advertisers a LEFT JOIN cities c ON c.id = a.city_id WHERE a.deleted=0 ".$cityfilter." ORDER BY c.name, a.name ASC;", $db); 
		
		$result_hidden = mysql_query("SELECT a.id AS adv_id, a.name AS adv_name, a.system_name as adv_sys_name, a.draft, c.name AS  city_name FROM advertisers a LEFT JOIN cities c ON c.id = a.city_id WHERE a.draft=1 AND a.deleted=0 ".$cityfilter." ORDER BY c.name, a.name ASC;", $db); 
					
				
		$num_rows_total = mysql_num_rows($result);	
		$num_rows_hidden = mysql_num_rows($result_hidden);	
		
		$num_rows_active = $num_rows_total - $num_rows_hidden;
		
		
		echo '<div class="count-container"><span class="count-total">Всего: <b>'.$num_rows_total.'</b></span><span class="count-active">Активных:  <b>' .$num_rows_active.'</b></span><span class="count-hidden">Скрытых:  <b>' .$num_rows_hidden.' </b></span></div>';		
		

		
		
		
		
		
        
		while($row = mysql_fetch_array($result)){ 
		if ($row['draft'] == 0){$status = "Активно";  $status_style_class = "status-active";}
        if ($row['draft'] == 1){$status = "Скрыто"; $status_style_class = "status-hidden";}
        
        
               echo ' 
<tr> 
<td>'.stripslashes($row['adv_id']).'</td>
  <td> 
     <a class="modifiable-link" href="?id='.$row['adv_id'].'">'.stripslashes($row['adv_sys_name']).'</a> 
  </td> 

  <td> 
     '.stripslashes($row['adv_name']).' 
  </td> 
  <td> '.
     stripslashes($row['city_name'])
  .'</td> 
  <td class="'.$status_style_class.'"> '.
    $status
  .'</td> 
  <td>'.stripslashes($row['author']).'</td>
  <td>'.(($row['created'] == NULL) ? '':date_format(date_create($row['created']), 'd.m.Y')) .'</td>
  <td>'.stripslashes($row['modifiedby']).'</td>
  <td>'.(($row['modified'] == NULL) ? '':date_format(date_create($row['modified']), 'd.m.Y')) .'</td>
  <td> 
     <a href="#" OnClick="Delete('.$row['adv_id'].')">Удалить</a> 
  </td> 
</tr>'; 

        } 
        echo ' 
</table>'; 

?>
<script language='JavaScript1.1' type='text/javascript'>
function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

(function SetScrollTop () {
	
	var scroll_to = getParameterByName('scroll');
	if ((typeof(scroll_to) != "undefined") && (scroll_to > 0)) {
		window.scrollTo(0,scroll_to);
	}
})();




$('.city-selector').change(function() {
	
	
	parent.location= parent.location.protocol + '//' + parent.location.host + parent.location.pathname+"?city=" + this.value;
});
</script>
<?
}   
function delete_pages(){ 
        require '../config.php'; 
        $query = "UPDATE advertisers SET deleted='1' WHERE id = '".$_GET['del']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Рекламодатель удален</h3>'; 
} 

function delete_addr(){ 
        require '../config.php'; 
        $query = "UPDATE blog_addresses SET deleted='1' WHERE id = '".$_GET['deladdr']."';"; 
        mysql_query($query, $db); 
        echo '<h3>Адрес удален</h3>'; 
} 
if($_GET['deladdr']) delete_addr(); 

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
						<center><a class="modifiable-link"  href="index.php"><img width="150" src="../images/lwt.png"></a></center>
						<!-- Nav -->
							<nav id="nav">
								<ul>
								<li><a class="modifiable-link" href="post.php">Товары и услуги</a></li>
									<li><a class="modifiable-link" href="food_offer.php">Продукты</a></li>
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
									<li class="current_page_item"><a class="modifiable-link"  href="advertisers.php">Рекламодатели</a></li>
									
									<li><a class="modifiable-link"  href="foods_distributors.php">Торговые сети</a></li>
									<li ><a  class="modifiable-link" href="offercategories.php">Категории</a></li>
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