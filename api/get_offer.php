<?php header('Access-Control-Allow-Origin: *'); ?>

<?
	include "../config.php"; //Файл конфигурации БД
	$_GET['id'] = htmlspecialchars($_GET['id']); 
	$_GET['id'] = intval($_GET['id']);	
	if(empty($_GET['id'])) $_GET['id'] = 1; 
	
	$imgprefix = "http://".$_SERVER["SERVER_NAME"];
	
	$query_result = mysql_query("SELECT advertiser_id, body,name, img1,img2,img3,img4,img5,event_datetime,ext_link, add_info FROM blog  WHERE id = '".$_GET['id']."'"); 
	$query_row = mysql_fetch_array($query_result); 
	
	
	
	$data_array = array();
	$data_array['body'] = $query_row['body'];
	$data_array['name'] = $query_row['name'];
	
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
	
	$addr_query_result = mysql_query("SELECT address,phone,workhours FROM blog_addresses WHERE advertiser_id = '".$query_row['advertiser_id']."' AND draft=0 AND deleted=0;"); 
	
	
	
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
	
	
	
	
	$ipguest = $_SERVER["REMOTE_ADDR"];
	$browserguest = $_SERVER['HTTP_USER_AGENT'];
	$page = $_SERVER['REQUEST_URI'];
	$query = mysql_query("INSERT INTO api_statistic (ip, browser, page) values ('$ipguest', '$browserguest', '$page')");

	mysql_close($db);
	
	echo '{
  "offer":';
	echo json_encode($data_array);
	echo '}';
?>