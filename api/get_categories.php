<?php header('Access-Control-Allow-Origin: *'); ?>
<?
/*
1 - Товары и услуги
8 - Продукты
3 - События
7 - Новости
6 - Деньги
9 - Кино
10 - Алкоголь
*/
$server_name = "http://".$_SERVER['SERVER_NAME'];

$city = $_GET['city'] ? $_GET['city'] : 0;

	include "../config.php"; //Файл конфигурации БД
		
		// не забыть убрать - WHERE id_name='offers' при переходе на категории продуктов
		
		$strSQL = "(SELECT oc.id, oc.name, oc.icon, NULL as img, c.id_name AS section_id, oc.disp_order FROM offercategories oc LEFT JOIN categories c ON c.id = oc.section_id WHERE id_name='offers' AND draft=0 AND deleted=0 ORDER BY disp_order ASC) UNION (SELECT fd.id, fd.name, NULL as icon,  CONCAT ('".$server_name."',fd.img) as img, 'foods' as section_id, fd.disp_order FROM foods_distributors fd WHERE fd.draft=0 AND fd.deleted=0 AND fd.city_id=".$city." ORDER BY fd.disp_order ASC) UNION (SELECT fd.id, fd.name, NULL as icon, CONCAT ('".$server_name."',fd.img) as img, 'alcohol' as section_id, fd.disp_order FROM foods_distributors fd WHERE fd.draft=0 AND fd.deleted=0 AND fd.city_id=".$city." ORDER BY fd.disp_order ASC);";	
	
	
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
	
	mysql_close($db);
	echo '{
  "categories":';
	echo json_encode($resultArray);
	echo '}';
?>