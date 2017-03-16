<?php
	header('Access-Control-Allow-Origin: *');
		
	if(!$_GET['id'] || !$_GET['type']) {
		echo 'Required parameters not specified.';
		die();
	}
	
	$offer_id = intval(htmlspecialchars($_GET['id'])); 
	$itemtype = htmlspecialchars($_GET['type']); 
			
	$data_array = getOfferData($offer_id, $itemtype);
		
	echo '{
		"offer":';
		echo json_encode($data_array);
	echo '}';
	
	
	
	
	function getOfferData($offer_id, $itemtype) {
		
		include "../../config.php"; //Файл конфигурации БД
		
		$server_name = "http://".$_SERVER['SERVER_NAME'];
		
		if ($itemtype == "foods") {
			
			
			$item_query_sql = "SELECT f.id, f.name, f.body, CONCAT ('".$server_name."',f.img) AS img, CONCAT ('".$server_name."',f.img1) AS img1, f.system_date_from, f.system_date_to, f.price_old, f.price_new, f.discount_size, f.add_info, f.can_complain,  c.id_name as sec_system_name, c.name as sec_name, f.offer_cat_id as category, oc.name as cat_name, oc.special_attribute, f.advertiser_id, fd.name AS advertiser FROM food_offers f LEFT JOIN foods_distributors fd ON fd.id = f.advertiser_id LEFT JOIN offercategories oc ON oc.id=f.offer_cat_id LEFT JOIN categories c ON c.id = oc.section_id WHERE f.id = '".$offer_id."' LIMIT 1;";
				
			$address_query_sql = "SELECT fda.address,fda.workhours FROM food_offers_addresses foa LEFT JOIN food_distributor_addresses fda ON foa.address_id = fda.id WHERE foa.offer_id = '".$offer_id."' AND fda.draft=0 AND fda.deleted=0 ORDER BY address;"; 
				
				
			$shouldAddImages = false;
		}
		else {
				
			$item_query_sql = "SELECT  b.id, b.name, b.body, NULLIF(b.system_date_to,0) AS system_date_to, b.discount_size, CONCAT ('".$server_name."',b.img) AS img, b.metakeywords, b.pr_cat, b.exclusive, UNIX_TIMESTAMP(b.date1) AS modify_date, b.add_info, b.can_complain, c.id_name as sec_system_name, c.name as sec_name, b.offer_cat_id as category, oc.name as cat_name, oc.special_attribute, b.advertiser_id,  a.name as advertiser, a.email, a.weblink1, a.weblink2, b.event_datetime FROM blog b LEFT JOIN advertisers a ON a.id = b.advertiser_id LEFT JOIN offercategories oc on oc.id=b.offer_cat_id LEFT JOIN categories c on c.id  = b.cat_id WHERE b.id = '".$offer_id."' LIMIT 1;"; 
			
			$address_query_sql = "SELECT ba.address,ba.phone,ba.workhours FROM blog_offers_addresses boa LEFT JOIN blog_addresses ba ON boa.address_id = ba.id WHERE boa.offer_id = '".$offer_id."' AND ba.draft=0 AND ba.deleted=0 ORDER BY ba.disp_order;";
			
			$shouldAddImages = true;
		}
		
			
		$objQuery = mysql_query($item_query_sql);
		$intNumField = mysql_num_fields($objQuery);
			
		$data_array = array();

		while($obResult = mysql_fetch_array($objQuery))
		{
			for($i=0;$i<$intNumField;$i++)
			{
				$data_array[mysql_field_name($objQuery,$i)] = $obResult[$i];
			}
			
		}
		
		// Add address info
		$address_array = array();
		$addr_query_result = mysql_query($address_query_sql); 
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
			
		$data_array['address_info'] = $address_array;
				
		// Add images
		if ($shouldAddImages) {
				

				$img_array = array();				
				$query_result = mysql_query("SELECT img1, img2, img3, img4, img5 FROM blog WHERE id = '".$offer_id."';"); 
				$intNumField = mysql_num_fields($query_result);
				while($query_row = mysql_fetch_array($query_result))
				{
					for($i=0;$i<$intNumField;$i++)
					{
						if ($query_row[$i]) array_push($img_array, $server_name . $query_row[$i]);
					}
					
				}
					
				$data_array['images'] = $img_array;
				
		}
				
					
		mysql_close($db);
	
		return $data_array;
	}
	
	
?>