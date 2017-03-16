<?php header('Access-Control-Allow-Origin: *'); ?>

<?
	include "../config.php"; //Файл конфигурации БД
	$_GET['id'] = htmlspecialchars($_GET['id']); 
	$_GET['id'] = intval($_GET['id']);	
	if(empty($_GET['id'])) $_GET['id'] = 1; 
	
	$imgprefix = "http://".$_SERVER["SERVER_NAME"];
	
	$query_result = mysql_query("SELECT oc.name as cat_name, c.name as sec_name, b.id, b.advertiser_id, b.body,b.name, b.img1,b.img2,b.img3,b.img4,b.img5,b.event_datetime,b.ext_link, b.add_info, b.discount_size, a.name as adv_name, a.email, a.weblink1, a.weblink2, b.can_complain  FROM blog b LEFT JOIN advertisers a ON a.id = b.advertiser_id LEFT JOIN offercategories oc on oc.id=b.offer_cat_id LEFT JOIN categories c on c.id  = b.cat_id WHERE b.id = '".$_GET['id']."' LIMIT 1;"); 
	$query_row = mysql_fetch_array($query_result); 
	
	
	
	$data_array = array();
	$data_array['body'] = $query_row['body'];
	$data_array['adv_id'] = $query_row['advertiser_id'];
	$data_array['adv_name'] = $query_row['adv_name'];
	$data_array['name'] = $query_row['name'];
	$data_array['cat_name'] = $query_row['cat_name'];
	$data_array['sec_name'] = $query_row['sec_name'];
	
	$images_array = array();
	
	if ($query_row['img1']) { array_push($images_array,$imgprefix . $query_row['img1']); }
	if ($query_row['img2']) { array_push($images_array,$imgprefix . $query_row['img2']); }
	if ($query_row['img3']) { array_push($images_array,$imgprefix . $query_row['img3']); }
	if ($query_row['img4']) { array_push($images_array,$imgprefix . $query_row['img4']); }
	if ($query_row['img5']) { array_push($images_array,$imgprefix . $query_row['img5']); }
	
	$data_array['images'] = array();
	
	$data_array['images']=$images_array;
	
	
	$data_array['event_datetime'] = $query_row['event_datetime'];
	$data_array['ext_link'] = $query_row['ext_link'];
	$data_array['add_info'] = $query_row['add_info'];
	$data_array['discount_size'] = $query_row['discount_size'];
	$data_array['email'] = $query_row['email'];
	$data_array['weblink1'] = $query_row['weblink1'];
	$data_array['weblink2'] = $query_row['weblink2'];
	$data_array['can_complain'] = $query_row['can_complain'];
	
	$addr_query_result = mysql_query("SELECT ba.address,ba.phone,ba.workhours FROM blog_offers_addresses boa LEFT JOIN blog_addresses ba ON boa.address_id = ba.id WHERE boa.offer_id = '".$query_row['id']."' AND ba.draft=0 AND ba.deleted=0 ORDER BY ba.disp_order;"); 
	
	
	
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