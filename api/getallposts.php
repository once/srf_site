<?php header('Access-Control-Allow-Origin: *'); ?>
<?
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
//$_GET['platform']

$server_name = "http://".$_SERVER['SERVER_NAME'];
	
$platform = "undefined";

if($_GET['platform']) {

	if ($platform != "") $platform = $_GET['platform'];
}
else {
	$platform = "undefined";

}
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
	include "../config.php"; //Файл конфигурации БД
	
	$array_types = array ("offers" => "1", "foods" => "8", "events"=> "3","news"=> "7","money"=> "6","cinema"=> "9","alcohol"=> "10");
	
	

	// DATE_ADD делается, т.к. system_date_to это Дата ПО
	
	if ($_GET['type'] == "foods") {
	// Продукты
	$strSQL = "SELECT f.id, f.name, f.date, f.metakeywords, CONCAT ('".$server_name."',f.img) as img, f.price_old, f.price_new, f.discount_size, DATE_FORMAT(f.system_date_from,'%d.%m') AS date_from, DATE_FORMAT(f.system_date_to,'%d.%m') AS date_to, f.order_category,f.order_section, fd.name AS distributor, f.advertiser_id AS category, f.pr_cat, f.exclusive, NULLIF(f.system_date_from,0) as system_date_from, NULLIF(f.system_date_to,0) as system_date_to, UNIX_TIMESTAMP(f.date1) AS modify_date  FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id LEFT JOIN cities c ON c.id = fd.city_id LEFT JOIN offercategories oc ON oc.id = f.offer_cat_id WHERE oc.section_id= ".$FOODS_SECTION_ID." AND f.offer_cat_id <> ".$ALCOHOL_CATEGORY_ID." AND f.draft=0 AND fd.draft=0 AND f.deleted=0 AND c.hidecitydata=0 AND ((DATE_ADD(f.system_date_to, INTERVAL 1 DAY) > NOW()) OR (ISNULL(f.system_date_to) or f.system_date_to = '0000-00-00')) AND (platform='".$platform."' OR platform='all') AND fd.city_id=" .$_GET['city']. " " . $limit . " ;";
	
	//ORDER BY f.date1 DESC
	
	}
	elseif ($_GET['type'] == "alcohol") {
	// Алкоголь
	$strSQL = "SELECT f.id, f.name, f.date, f.metakeywords, CONCAT ('".$server_name."',f.img) as img, f.price_old, f.price_new, f.discount_size, DATE_FORMAT(f.system_date_from,'%d.%m') AS date_from, DATE_FORMAT(f.system_date_to,'%d.%m') AS date_to, f.order_category,f.order_section, fd.name AS distributor, f.advertiser_id AS category, f.pr_cat, f.exclusive, NULLIF(f.system_date_from,0) as system_date_from, NULLIF(f.system_date_to,0) as system_date_to, UNIX_TIMESTAMP(f.date1) AS modify_date  FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id LEFT JOIN cities c ON c.id = fd.city_id WHERE f.offer_cat_id = ".$ALCOHOL_CATEGORY_ID." AND f.draft=0 AND fd.draft=0 AND f.deleted=0 AND c.hidecitydata=0 AND ((DATE_ADD(f.system_date_to, INTERVAL 1 DAY) > NOW()) OR (ISNULL(f.system_date_to) or f.system_date_to = '0000-00-00')) AND (platform='".$platform."' OR platform='all') AND fd.city_id=" .$_GET['city']. " " . $limit . " ;";
	
	//ORDER BY f.date1 DESC
	}
	else {
	// Остальное
	
		$strSQL = "SELECT b.id, b.name, b.date, b.metadescription,b.metakeywords, b.order_category, b.order_section,b.event_datetime,b.ext_link, b.offer_cat_id AS category, CONCAT ('".$server_name."',b.img) as img, b.discount_size, a.name as adv_name, b.pr_cat, b.exclusive, NULLIF(b.system_date_to,0) as system_date_to, UNIX_TIMESTAMP(b.date1) AS modify_date FROM blog b LEFT JOIN advertisers a ON a.id = b.advertiser_id LEFT JOIN cities c ON c.id = a.city_id WHERE b.draft=0 AND a.draft=0 AND b.deleted=0 AND c.hidecitydata=0 AND ((DATE_ADD(b.system_date_to, INTERVAL 1 DAY) > NOW()) OR (ISNULL(b.system_date_to) or b.system_date_to = '0000-00-00')) AND (platform='".$platform."' OR platform='all') AND b.cat_id=".$array_types[$_GET['type']]." ".$cityselector. " ".$categoryselector. " " . $limit .  " ;";	
		
		//ORDER BY b.date1 DESC
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

	// Getting priority categories
	$strSQL2 = "SELECT id, name, disp_order,class FROM priority_categories;";
	$objQuery2 = mysql_query($strSQL2);
	$intNumField2 = mysql_num_fields($objQuery2);
	$prCategoriesArray = array();
	while($obResult2 = mysql_fetch_array($objQuery2))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField2;$i++)
		{
			$arrCol[mysql_field_name($objQuery2,$i)] = $obResult2[$i];
		}
		array_push($prCategoriesArray,$arrCol);
	}
	
	
	mysql_close($db);
	
	echo '{
  "locations":';
	echo json_encode($resultArray);
	echo ', "prior_categories":';
	echo json_encode($prCategoriesArray);
	echo '}';
?>