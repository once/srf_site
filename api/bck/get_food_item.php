<?php header('Access-Control-Allow-Origin: *'); ?>

<?
	include "../config.php"; //Файл конфигурации БД
	$_GET['id'] = htmlspecialchars($_GET['id']); 
	$_GET['id'] = intval($_GET['id']);	
	if(empty($_GET['id'])) $_GET['id'] = 1; 
	
	$imgprefix = "http://".$_SERVER["SERVER_NAME"];
	
	$query_result = mysql_query("SELECT f.id, f.advertiser_id, f.body, f.name, f.img1, f.date_from, f.date_to,f.system_date_from, f.system_date_to, f.price_old, f.price_new, f.discount_size, f.add_info, f.can_complain, f.offer_cat_id ,fd.name AS distributor FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id  WHERE f.id = '".$_GET['id']."' LIMIT 1;"); 
	$query_row = mysql_fetch_array($query_result); 
	
	
	
	$data_array = array();
	
	$data_array['body'] = $query_row['body'];
	$data_array['name'] = $query_row['name'];
	$data_array['distributor_id'] =$query_row['advertiser_id'];
	$data_array['distributor'] =$query_row['distributor'];
	$data_array['img1'] = $query_row['img1'] ? $imgprefix . $query_row['img1'] : null;
	
	
	$data_array['date_from'] = $query_row['date_from'];
	$data_array['date_to'] = $query_row['date_to'];
	
	$data_array['price_old'] = $query_row['price_old'];
	$data_array['price_new'] = $query_row['price_new'];
	$data_array['discount_size'] = $query_row['discount_size'];
	
	$data_array['add_info'] = $query_row['add_info'];
	$data_array['can_complain'] = $query_row['can_complain'];
	$data_array['offer_cat_id'] = $query_row['offer_cat_id'];
	
	$data_array['system_date_from'] = $query_row['system_date_from'];
	$data_array['system_date_to'] = $query_row['system_date_to'];
	
	$addr_query_result = mysql_query("SELECT fda.address,fda.workhours FROM food_offers_addresses foa LEFT JOIN food_distributor_addresses fda ON foa.address_id = fda.id WHERE foa.offer_id = '".$query_row['id']."' AND fda.draft=0 AND fda.deleted=0 ORDER BY address;"); 
	
	//$addr_query_result = mysql_query("SELECT ba.address,ba.phone,ba.workhours FROM blog_offers_addresses boa LEFT JOIN blog_addresses ba ON boa.address_id = ba.id WHERE boa.offer_id = '".$query_row['id']."' AND ba.draft=0 AND ba.deleted=0 ORDER BY ba.disp_order;"); 
	
	
	$address_array = array();
	$intNumField = mysql_num_fields($addr_query_result);
	while($addr_query_row = mysql_fetch_array($addr_query_result))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[mysql_field_name($addr_query_result,$i)] = $addr_query_row[$i];
		}
		array_push($address_array,$arrCol);
	}
	
	
	$data_array['address_info'] = array();
	
	for ($i=0; $i < sizeof($address_array); $i++) {
		
		array_push($data_array['address_info'],$address_array[$i]);	
	}
	
	
	
	
	//$ipguest = $_SERVER["REMOTE_ADDR"];
	//$browserguest = $_SERVER['HTTP_USER_AGENT'];
	//$page = $_SERVER['REQUEST_URI'];
	//$query = mysql_query("INSERT INTO api_statistic (ip, browser, page) values ('$ipguest', '$browserguest', '$page')");

	mysql_close($db);
	
	echo '{
  "offer":';
	echo json_encode($data_array);
	echo '}';
?>