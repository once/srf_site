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
		<!--<script type="text/javascript" src="../resource/ckfinder/ckfinder.js"></script>-->
		<script src="js/validation.js"></script>
		<script src="js/category_selector.js"></script>
	<script type="text/javascript">

function RecalculateDiscount() {
	
				var priceOld = Number(document.getElementById("value-old-price").value);
				var priceNew = Number(document.getElementById("value-new-price").value);
				
				
				if ((typeof priceOld != "undefined")  && ( priceOld > 0) && (typeof priceNew != "undefined")  && ( priceNew > 0) && (priceNew < priceOld)) {
				
					var discountSize = Math.round(((priceOld - priceNew)/(priceOld))*100);
					var discountSizeText = "- " + discountSize.toString() + " %";
					
					document.getElementById("value-discount-size").value = discountSizeText;
				}
}
function DiscountOnFocus(forceRecalc) {
	
	if (forceRecalc == true ) {
		
		RecalculateDiscount();
	}
	else {
		
			var currentDiscountValue = document.getElementById("value-discount-size").value;
	
				if ((currentDiscountValue == "") || (currentDiscountValue == null)) {
					
					RecalculateDiscount();
				
				}
	}
	
	
	 
}
function deleteOffer() {

		  if(confirm("Удалить продукт из таблицы импорта?")) 
     { 
                 
				 return true;
     } 
     else 
     { 
       return false; 
     } 
	
	
	
}

function validateOfferForm() {

		if (validateField("input","offer_cat_id","Категория")) {
		
		console.log('validateForm true');
		return true;
		
	}
	else {
		
		console.log('validateForm false');
		return false;
		
	}
	
	
	
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
									<? require("login.php");
								
								
									
									 
function show_form(){ 

		
        require '../config.php'; 
		$offer_cat_id = $_GET['last_cat_id'] ? $_GET['last_cat_id'] : 0;
		
		$res_count = mysql_query("SELECT count(id) FROM food_offers_import;", $db); 
		$products_count = mysql_result($res_count,0);
		
		
		
		echo '<h2><a>Импорт данных</a> ('.$products_count.')</h2><br/>';
		
		if ($products_count > 0) {
        $result = mysql_query("SELECT foi.id, foi.name,foi.body,foi.advertiser_id, foi.metakeywords, foi.img, foi.img1, foi.price_old, foi.price_new, foi.discount_size, foi.system_date_from, foi.system_date_to, c.name AS city_name, fd.name AS distributor_name FROM food_offers_import foi LEFT JOIN foods_distributors fd ON fd.id = foi.advertiser_id LEFT JOIN cities c  ON c.id = fd.city_id LEFT JOIN (SELECT MAX(id) AS maxima FROM food_offers_import) mt ON mt.maxima=foi.id;", $db); 
        $row = mysql_fetch_array($result); 
?> 
<body role="application">

<div>
	<div style="display:inline;">
		<img style="vertical-align:top; border: 1px solid lightgray; max-width:300px;" src="<?=htmlspecialchars(stripslashes($row['img1']));?>">
	</div>

	<div style="display:inline-block; margin-left:30px;">

<form action="" method="post"> 
<table class="importform">

	<tr><td><a style="font-size:20px;text-decoration:none;" >Город:</a> </td><td> <?=htmlspecialchars(stripslashes($row['city_name']));?></td></tr>
	<tr><td><a style="font-size:20px;text-decoration:none;" >Торговая сеть:</a> </td><td> <?=htmlspecialchars(stripslashes($row['distributor_name']));?></td></tr>
	 <tr>
		<td><a style="font-size:20px;text-decoration:none;" >Категория:</a> </td><td>
		
		<div id="category_selectors">
			</div>
			<input name="offer_cat_id" value="<? echo $offer_cat_id;?>" type="hidden"/>
			
			

		</td>
	</tr>
	

	
	<tr>
	<td> <a style="font-size:20px;text-decoration:none;" >Название : </a></td><td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="name" value="<?=htmlspecialchars(stripslashes($row['name']));?>"  class="enter" size="80" required></td></tr>
	<!--<tr>
	<td></td>
	<td>
	<input type="button" class="btn_copydown" style="font-weight: bold; font-size: 1em;" value="&darr;"/>
	<input type="button" class="btn_copyup" style="font-weight: bold; font-size: 1em;" value="&uarr;" />
	</td></tr>-->
	
    

      <tr><td> <a style="font-size:20px;text-decoration:none;" >Описание : </a></td><td> <br>   <textarea name="body" cols="70" rows="3"><?=stripslashes($row['body']);?></textarea><br> </td></tr>
	 
	  <tr><td><a style="font-size:20px;text-decoration:none;" >Старая цена:</a></td> <td> <input id="value-old-price" onblur="DiscountOnFocus();" style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="price_old" class="enter" size="8" value="<?=htmlspecialchars(stripslashes($row['price_old']));?>">
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a style="font-size:20px;text-decoration:none;" >Новая цена:</a>&nbsp;&nbsp;&nbsp;<input id="value-new-price" onblur="DiscountOnFocus();" style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="price_new" class="enter" size="8" value="<?=htmlspecialchars(stripslashes($row['price_new']));?>"></td></tr>
	  
	   <tr><td><a style="font-size:20px;text-decoration:none;" >Размер скидки:</a></td> 
      <td> <input  id="value-discount-size"  onfocus="DiscountOnFocus();" style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="discount_size" class="enter" size="37" value="<?=htmlspecialchars(stripslashes($row['discount_size']));?>"> <input onclick="DiscountOnFocus(true);" type="button" value="Пересчитать"/></td></tr>
	  <tr><td></td><td style="font-size: .8em;">(если указаны старая и новая цена - будет рассчитано автоматически. Можно заменить произвольным значением)</td></tr>
	  
	  <tr><td><a style="font-size:20px;text-decoration:none;" >Акция С:</a></td> <td> <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="date" name="system_date_from" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['system_date_from']));?>">
	 &nbsp;&nbsp;&nbsp; <a style="font-size:20px;text-decoration:none;">Акция ПО:</a>&nbsp;&nbsp;&nbsp;<input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="date" name="system_date_to" class="enter" size="5" value="<?=htmlspecialchars(stripslashes($row['system_date_to']));?>">
	  </td></tr>
	  
	  
	  
      <tr><td> <a style="font-size:20px;text-decoration:none;" >Ключевые слова (для поиска):</a></td><td>     <input style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="metakeywords" class="enter" size="75" value="<?=htmlspecialchars(stripslashes($row['metakeywords']));?>"></td></tr> 
			 <tr><td style="vertical-align:middle;"><a style="font-size:20px;text-decoration:none;" >Комментарий:</a></td> 
      <td><textarea rows="2" cols="70" style="padding:5px; background-color:#e6e6e6;font-size:15px;" type="text" name="comment" ><?=htmlspecialchars(stripslashes($row['comment']));?></textarea> </td></tr>

      </table>


<br>
<?
function russian_date(){
$date=explode(".", date("d.m.Y"));
switch ($date[1]){
case 1: $m='января'; break;
case 2: $m='февраля'; break;
case 3: $m='марта'; break;
case 4: $m='апреля'; break;
case 5: $m='мая'; break;
case 6: $m='июня'; break;
case 7: $m='июля'; break;
case 8: $m='августа'; break;
case 9: $m='сентября'; break;
case 10: $m='октября'; break;
case 11: $m='ноября'; break;
case 12: $m='декабря'; break;
}
$alldate = $date[0].'&nbsp;'.$m.'&nbsp;'.$date[2];
echo '<input type="hidden" name="date" value='.$alldate.'>';
}
russian_date(); ?>


      <input   type="hidden"  name="id" value="<?=$row['id'];?>">
  <input  type="hidden" name="advertiser_id" value="<?=$row['advertiser_id'];?>"> 	  
  <input  type="hidden" name="img" value="<?=htmlspecialchars(stripslashes($row['img']));?>"> 	  
  <input  type="hidden" name="img1" value="<?=htmlspecialchars(stripslashes($row['img1']));?>"> 	  
  
	 <input style="margin-left:520px; color: green; font-weight: bold;" type="submit" onclick="javascript: return validateOfferForm();" value="Опубликовать и перейти к следующему" name="edit">
	 <input type="submit" onclick="javascript: return deleteOffer();" value="Удалить" name="delete">
      
     

</form>
	</div>
</div>
<?		}

else {
	echo '<p>Новых импортированных офферов для обработки нет.</p>';
	
}
?>
 </body>
<? 
} 


function complete(){ 
    echo 'complete';
	
	
      require '../config.php'; 

        $query = "INSERT INTO food_offers 
                     (name,
					 advertiser_id,
					  img,
					  img1,
                      body, 
                      metakeywords,                      
                      price_old,
                      price_new,
					  discount_size,
                      system_date_from,
                      system_date_to,
					  offer_cat_id,
					  add_info,
					 date,
					   author,
					 comment
					  
                      ) 
                                      VALUES 
                            ('".trim(mysql_real_escape_string($_POST['name']))."',
							'".mysql_real_escape_string($_POST['advertiser_id'])."', 							
                             '".mysql_real_escape_string($_POST['img'])."', 
							 '".mysql_real_escape_string($_POST['img1'])."', 
                             '".mysql_real_escape_string($_POST['body'])."',
                             '".mysql_real_escape_string($_POST['metakeywords'])."',
                             '".mysql_real_escape_string($_POST['price_old'])."',
							 '".mysql_real_escape_string($_POST['price_new'])."',
                             '".mysql_real_escape_string($_POST['discount_size'])."',
							 '".(($_POST['system_date_from'] == NULL) ? 'NULL' : mysql_real_escape_string($_POST['system_date_from']))."',
							 '".(($_POST['system_date_to'] == NULL) ? 'NULL' : mysql_real_escape_string($_POST['system_date_to']))."',
							  '".mysql_real_escape_string($_POST['offer_cat_id'])."',
                             '".mysql_real_escape_string("Предложение не является публичной офертой")."',
						
							 '".mysql_real_escape_string($_POST['date'])."',
							 '".mysql_real_escape_string($_SESSION['loginadmin'])."',
							
							 '".mysql_real_escape_string($_POST['comment'])."'
                             )";


			
			
     

      mysql_query($query, $db); 
	  
	  $offer_created_id = mysql_insert_id($db);
	  
	   // Process selected addresses for this offer
	  // Clear existing records for this offer
	  $query = "DELETE FROM food_offers_addresses WHERE offer_id = " . $_POST['id'];
	  mysql_query($query, $db);   
	
	  
	  
	   // Insert new records on this offer	  
	  // If it's a new created offer, bind it to all advertiser's addresses
			
			$sqlc = mysql_query("SELECT id, address FROM food_distributor_addresses WHERE distributor_id = '".$_POST['advertiser_id']. "' AND deleted=0");

			while($rowc = mysql_fetch_array($sqlc)){
						
				
				$query = "INSERT INTO food_offers_addresses (offer_id, address_id) VALUES (".$offer_created_id. ",".$rowc["id"].")";
				mysql_query($query, $db);   
			}  
	  
	  
	// Remove offer from 'pending' table
	$query = "DELETE FROM food_offers_import WHERE id = " . $_POST['id'];
	
	  mysql_query($query, $db);   
      
	  echo "<meta http-equiv='Refresh' content='0; URL=food_import.php?last_cat_id=".$_POST["offer_cat_id"]."'>"; 
} 





function delete_pages(){ 
        require '../config.php'; 
        $query = "DELETE FROM food_offers_import WHERE id = " . $_POST['id'];
        mysql_query($query, $db); 
		
		
        
} 




//if($_GET['del']) delete_pages(); 
if($_POST['edit']) complete(); 
if($_POST['delete']) delete_pages(); 

	
show_form(); 


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
								<li><a class="modifiable-link" href="post.php">Товары и услуги</a></li>
									<li><a class="modifiable-link" href="food_offer.php">Продукты</a></li>
									<li  style="margin-left:40px;" class="current_page_item"><a class="modifiable-link" href="food_import.php">Импорт данных</a></li>
									<li  style="margin-left:40px;"><a class="modifiable-link" href="mass_copy_form.php">Массовое копирование</a></li>
									<!--<li><a class="modifiable-link" href="alco_offer.php">Алкоголь</a></li>-->
									<li><a class="modifiable-link" href="news_offer.php">Новости</a></li>
									<li><a class="modifiable-link" href="event_offer.php">События</a></li>
									<li><a class="modifiable-link" href="cinema_offer.php">Кино</a></li>
									<li><a class="modifiable-link" href="money_offer.php">Деньги</a></li>
									<li><a class="modifiable-link" href="advertisers.php">Рекламодатели</a></li>
									<li><a class="modifiable-link" href="foods_distributors.php">Торговые сети</a></li>
									<li><a class="modifiable-link" href="offercategories.php">Категории</a></li>
									<li><a  class="modifiable-link"  href="cities.php">Города</a></li>
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