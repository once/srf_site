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
	<script type="text/javascript">

function validateForm() {
	
		var start_id = Number(document.getElementById("startid").value);
		var end_id = Number(document.getElementById("endid").value);
		var distributor_id = Number(document.getElementById("distributorid").value);
		
		if (start_id <= 0) {
			alert('Стартовый ID должен быть числом, большим 0 !');
			return false;
		}
		if (end_id <= 0) {
			alert('Конечный ID должен быть числом, большим 0 !');
			return false;
		}
		if (end_id < start_id) {
			alert('Конечный ID должен быть больше или равен Стартовому ID !');
			return false;
		}
		if (distributor_id <= 0) {
			alert('ID Торговой сети должно быть числом, большим 0 !');
			return false;
		}
		return true;
	
	
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
										<h2><a>Массовое копирование продуктов каталога</a></h2>
										
									</header>
								
									
<?									 
function init(){ 

		
?> 
<p>Функция позволяет быстро скопировать набор карточек продуктов (например импортированных) в другой город (с присвоением другого ИД торговой сети). В новые карточки будут перенесены ВСЕ значения полей исходных карточек.</p>
	<form action="" method="post"> 
		<p>Стартовый ID оффера: <input type="number" min="1" id="startid" name="startid" value="" class="enter" size="10" required ></p>
		<p>Конечный ID оффера: <input type="number" min="1" id="endid" name="endid" value="" class="enter" size="10" required ></p>
		<p>Целевой ID Торговой сети: <input type="number" min="1" id="distributorid" name="distributorid" value="" class="enter" size="10" required></p>
      
		<p><input class="submit" type="submit" onclick="javascript: return validateForm();" value="Начать копирование..." name="confirm"> </p>
  
</form>	
<? 
} 


function confirm(){ 

include "../config.php"; //Файл конфигурации БД

$query_result = mysql_query("SELECT fd.name as distributor_name, c.name as city_name FROM foods_distributors fd LEFT JOIN cities c ON fd.city_id=c.id WHERE fd.id = '".$_POST["distributorid"]."' LIMIT 1;"); 

if (!(mysql_num_rows($query_result) == 1)) {
	
	$target_distributor_data = '<span style="color: red;"> - Торговая сеть с таким ID не найдена.</span> Нажмите <b>Отмена</b>, чтобы откорректировать введенные данные.';	
	$target_distributor_valid = 0;
}
else {
	$query_row = mysql_fetch_array($query_result); 
		
	$target_distributor_data = " - " . $query_row['distributor_name'] . " (". $query_row['city_name']  .")";	
	$target_distributor_valid = 1;
}

mysql_close($db);

?>
<p style="font-weight: bold; font-size: 1.1em;">Пожалуйста проверьте введенные данные:</p>
<form action="" method="post" target="_blank"> 
		<p>Стартовый ID оффера: <b><? echo $_POST['startid'];?></b></p>
		<p>Конечный ID оффера: <b><? echo $_POST['endid'];?></b></p>
		<p>Целевая Торговая сеть: <b><? echo $_POST['distributorid'];?></b><? echo $target_distributor_data; ?></p>
      
		
		<? if ($target_distributor_valid) {
		?>
			<p><input class="submit" type="submit" value="Подтвердить" name="complete"> 
		<?		
		} ?>
		<input type="hidden" name="start_id" value="<?=$_POST['startid'];?>"> 
		<input type="hidden" name="end_id" value="<?=$_POST['endid'];?>"> 
		<input type="hidden" name="distributor_id" value="<?=$_POST['distributorid'];?>"> 
		
		<input class="submit" type="submit" onclick="javascript: window.history.back();" value="Отмена" name="cancel"> </p>
  
</form>	
<?
} 

function launch(){ 

		if(!$_POST['start_id']) {
			echo 'Не указан начальный ID';
			die();
			
		}
		if(!$_POST['end_id']) {
			echo 'Не указан конечный ID';
			die();
			
		}
		if(!$_POST['distributor_id']) {
			echo 'Не указан целевой ID торговой сети';
			die();
			
		}
		
		include "../config.php"; //Файл конфигурации БД

		//echo "<meta http-equiv='Refresh' content='0; URL=mass_copy.php?startid=".$_POST['start_id']."&endid=".$_POST['end_id']."&distributorid=".$_POST['distributor_id']."'>"; 
		$start_id = intval($_POST['start_id']);	
		$end_id = intval($_POST['end_id']);	
		$distributor_id = intval($_POST['distributor_id']);	

		$fields_nocopy = array("id","date1","advertiser_id");


		$query_result = mysql_query("SELECT * FROM foods_distributors WHERE id = '".$distributor_id."' LIMIT 1;"); 
		
		if (!(mysql_num_rows($query_result) == 1)) {
				ErrorInfo("Не найдена торговая сеть с ID " . $distributor_id);
				die();
	
		}

		for ($i=$start_id;$i <= $end_id ; $i++) {
			  
			  $query_result = mysql_query("SELECT * FROM food_offers WHERE id = '".$i."' LIMIT 1;"); 
			  $query_num_rows  = mysql_num_rows($query_result);
			  $query_num_fields = mysql_num_fields($query_result);
			  
			if ($query_num_rows> 0) { 
		
				$query_row = mysql_fetch_array($query_result); 
				
				$outstr_fields = "";
				$outstr_values = "";
				
				for ($f=0;$f <$query_num_fields ; $f++) {
			
					$field_name = mysql_field_name($query_result,$f);
			
					if (in_array($field_name,$fields_nocopy,true)) {
				
						if ($field_name == 'advertiser_id') {
					
							$outstr_fields .= $field_name . ',';			
							$outstr_values .= "'". $distributor_id . "',";				
						
						}
					}
					else {
				
						$outstr_fields .= $field_name . ',';			
						$outstr_values .= "'". mysql_real_escape_string($query_row[$field_name]) . "',";				
					}
			
				}

				$outstr_fields = rtrim($outstr_fields,",");
				$outstr_values = rtrim($outstr_values,",");
		
				$insert_query = "INSERT INTO food_offers ($outstr_fields) values ($outstr_values);";
		
				$insert_query_result = mysql_query($insert_query);
		
		
				if ($insert_query_result == 1) {	
		
					// bind offer to all addresses of food_distributor by default:
			
					$offer_created_id = mysql_insert_id($db);
					$query_addresses = mysql_query("SELECT id, address FROM food_distributor_addresses WHERE distributor_id = '".$distributor_id. "' AND deleted=0");

					while($rowc = mysql_fetch_array($query_addresses)){
						
				
						$query = "INSERT INTO food_offers_addresses (offer_id, address_id) VALUES (".$offer_created_id. ",".$rowc["id"].")";
						mysql_query($query, $db);   
					}  
			
					MessageInfo("Скопирован оффер ID ".$i);
				}
				else {
			
					ErrorInfo("Ошибка копирования оффера ID ".$i);
				}
		
		
			}
			else {
		
				WarnInfo('Оффер ID ' . $i . ' не найден' );
			}
	  
		}
  
  mysql_close($db);




} 


  
  function MessageInfo($str) {
	  
	  echo '<p style="color: green;">'.$str.'</p>';
  }
  function WarnInfo($str) {
	  
	  echo '<p style="color: blue;">'.$str.'</p>';
   }
   function ErrorInfo($str) {
	  
	  echo '<p style="color: red;">'.$str.'</p>';
  }
  


/* Main processing cycle:  */


if($_POST['confirm']) { 
	confirm(); 
}
elseif($_POST['complete']) { 
	launch(); 
}

else {
	init(); 	
}
	



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
									<li  style="margin-left:40px;" ><a class="modifiable-link" href="food_import.php">Импорт данных</a></li>
									<li  style="margin-left:40px;" class="current_page_item"><a class="modifiable-link" href="mass_copy_form.php">Массовое копирование</a></li>
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

</html>