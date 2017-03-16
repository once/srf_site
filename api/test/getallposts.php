<?php header('Access-Control-Allow-Origin: *'); ?>
<?
/* TEST VERSION!  Загружает все данные независимо от флагов deleted,draft !!! */
/*
1 - Товары и услуги
8 - Продукты
3 - События
7 - Новости
6 - Деньги
9 - Кино
10 - алкоголь
*/
//$_GET['type']
//$_GET['category']
//$_GET['city']
//$_GET['limit']

$server_name = "http://".$_SERVER['SERVER_NAME'];

if($_GET['limit']) {
	$limit = "LIMIT " . $_GET['limit'];
}
else {
	$limit = "";

}
if($_GET['category'] && $_GET['category'] != 0) {
	$categoryselector = " AND b.offer_cat_id=".$_GET['category'];
}
else {
	$categoryselector= "";

}
if($_GET['city'] && $_GET['city'] != 0) {
	$cityselector = " AND a.city_id=".$_GET['city'];
}
else {
	$cityselector= "";

}
	include "../../config.php"; //Файл конфигурации БД
	
	$array_types = array ("offers" => "1", "foods" => "8", "events"=> "3","news"=> "7","money"=> "6","cinema"=> "9","alcohol"=> "10");
	
	

	
	if ($_GET['type'] == "foods") {
	// Продукты
	$strSQL = "SELECT f.id, f.name, f.date, f.metakeywords, CONCAT ('".$server_name."',f.img) as img, f.price_old, f.price_new, f.discount_size, f.date_from, f.date_to, f.order_category,f.order_section, fd.name AS distributor, f.advertiser_id AS category FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id LEFT JOIN cities c ON c.id = fd.city_id WHERE f.offer_cat_id = 1 AND fd.city_id=" .$_GET['city']. " " . $limit . " ORDER BY f.date1 DESC;";
	
	
	}
	elseif ($_GET['type'] == "alcohol") {
	// Алкоголь
	$strSQL = "SELECT f.id, f.name, f.date, f.metakeywords, CONCAT ('".$server_name."',f.img) as img, f.price_old, f.price_new, f.discount_size, f.date_from, f.date_to, f.order_category,f.order_section, fd.name AS distributor, f.advertiser_id AS category FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id LEFT JOIN cities c ON c.id = fd.city_id WHERE f.offer_cat_id = 2 AND fd.city_id=" .$_GET['city']. " " . $limit . " ORDER BY f.date1 DESC;";
	}
	else {
	// Остальное
	
		$strSQL = "SELECT b.id, b.name, b.date, b.metadescription,b.metakeywords, b.order_category, b.order_section,b.event_datetime,b.ext_link, b.offer_cat_id AS category, CONCAT ('".$server_name."',b.img) as img, b.discount_size, a.name as adv_name FROM blog b LEFT JOIN advertisers a ON a.id = b.advertiser_id LEFT JOIN cities c ON c.id = a.city_id WHERE b.cat_id=".$array_types[$_GET['type']]." ".$cityselector. " ".$categoryselector. " " . $limit .  " ORDER BY b.date1 DESC;";	
	}
	
	
	
	
	$objQuery = mysql_query($strSQL);
	$intNumField = mysql_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysql_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	
	//$ipguest = $_SERVER["REMOTE_ADDR"];
	//$browserguest = $_SERVER['HTTP_USER_AGENT'];
	//$page = $_SERVER['REQUEST_URI'];
	//$query = mysql_query("INSERT INTO api_statistic (ip, browser, page) values ('$ipguest', '$browserguest', '$page')");

	
	
	mysql_close($db);
	echo '{
  "locations":';
	echo json_encode($resultArray);
	echo '}';
?>