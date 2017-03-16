<?php header('Access-Control-Allow-Origin: *'); ?>
<?

	
	$imgprefix = "http://".$_SERVER["SERVER_NAME"];
	
include "../../../config_test.php"; //Файл конфигурации БД
		
/*		$strSQL = "(SELECT oc.id, oc.name, oc.icon, c.id_name AS section_id, oc.disp_order FROM offercategories oc LEFT JOIN categories c ON c.id = oc.section_id WHERE draft=0 AND deleted=0 ORDER BY disp_order ASC) UNION (SELECT id, name, NULL as icon, 'foods' as section_id, disp_order FROM foods_distributors WHERE draft=0 AND deleted=0 AND city_id=".$_GET['city']." ORDER BY disp_order ASC);";	
	
	
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
	
	mysql_close($db);*/
	
	$city = $_GET['city'];
	
	$platform = "undefined";

	if($_GET['platform']) {

		if ($platform != "") $platform = $_GET['platform'];
	}
	else {
		$platform = "undefined";

	}
	
	switch ($city) {
		
		//Архангельск
		case "1":

				$link = "offer_item.html?type=offers&id=1711";
				//$images = array($imgprefix .  "/content/images/banners/banner01.jpg",$imgprefix .  "/content/images/banners/banner02.jpg",$imgprefix .  "/content/images/banners/banner03.jpg");
				$images = array($imgprefix .  "/content/images/banners/bannergif03.gif");
				if ($platform == "ios") {
					$enabled = "0";
				}
				else {
	
					$enabled = "0";
					
				}
				break;
			

		
		//Северодвинск
		case "2":
			$link = "offer_item.html?type=offers&id=1711";
			$images = array($imgprefix .  "/content/images/banners/banner01.jpg",$imgprefix .  "/content/images/banners/banner02.jpg",$imgprefix .  "/content/images/banners/banner03.jpg");
			$enabled = "0";
			break;
		
		//Вологда
		case "3":
			$link = "offer_item.html?type=offers&id=1711";
			//$images = array($imgprefix .  "/content/images/banners/banner01.jpg",$imgprefix .  "/content/images/banners/banner02.jpg",$imgprefix .  "/content/images/banners/banner03.jpg");
			$images = array($imgprefix .  "/content/images/banners/bannergif03.gif");
			
			$enabled = "0";
			break;
		
		//Ярославль
		case "4":
			$link = "offer_item.html?type=offers&id=1711";
			$images = array($imgprefix .  "/content/images/banners/banner01.jpg",$imgprefix .  "/content/images/banners/banner02.jpg",$imgprefix .  "/content/images/banners/banner03.jpg");
			$enabled = "0";
			break;
			
		default:
			break;
	}

	
	echo '{
  "bannerdata":';
	echo '[{"link":"'.$link.'","imgs":';
	echo json_encode($images);
	echo ',"enabled":"'.$enabled.'"}]';
	echo '}';
?>